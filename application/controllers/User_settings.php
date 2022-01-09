<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Settings extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");

		if (!$this->user->loggedin){
            redirect('login');
		}
		
		$this->template->loadData("activeLink", 
			array("settings" => array("general" => 1)));
		$this->template->set_error_view("error/client_error.php");
		// $this->template->set_layout("layout/client_layout2.php");
	}

	public function index() 
	{
		$fields = $this->user_model->get_custom_fields_answers(array(
			"edit" => 1
			), $this->user->info->ID);
             
		$this->template->loadContent("user_settings/index.php", array(
			"fields" => $fields
			)
		);
	}

	public function pro() 
	{
		$this->load->model("register_model");
		$fields = $this->user_model->get_custom_fields_answers(array(
			"edit" => 1
			), $this->user->info->ID);
		
		$this->load->helper('email');
		$this->load->library("upload");
		$email = $this->common->nohtml($this->input->post("email"));
		$first_name = $this->common->nohtml($this->input->post("first_name"));
		$last_name = $this->common->nohtml($this->input->post("last_name"));
		$aboutme = $this->common->nohtml($this->input->post("aboutme"));

		$this->load->helper('email');

		if (empty($email)) $this->template->error(lang("error_18"));

		if (!valid_email($email)) {
			$this->template->error(lang("error_47"));
		}

		if($email != $this->user->info->email) {
			if (!$this->register_model->checkEmailIsFree($email)) {
				$this->template->error(lang("error_20"));
			}
		}

		$enable_email_notification = 
			intval($this->input->post("enable_email_notification"));
		if($enable_email_notification > 1 || $enable_email_notification < 0) 
			$enable_email_notification = 0;

		if ($this->settings->info->avatar_upload) {
			if ($_FILES['userfile']['size'] > 0) {

				if(!$this->settings->info->resize_avatar) {
					$settings = array(
						"upload_path" => $this->settings->info->upload_path,
						"overwrite" => FALSE,
						"max_filename" => 300,
						"encrypt_name" => TRUE,
						"remove_spaces" => TRUE,
						"allowed_types" => $this->settings->info->file_types,
						"max_size" => $this->settings->info->file_size,
					);
					if($this->settings->info->avatar_width > 0) {
						$settings['max_width'] = $this->settings->info->avatar_width;
					}
					if($this->settings->info->avatar_height > 0) {
						$settings['max_height'] = $this->settings->info->avatar_height;
					}
					$this->upload->initialize($settings);

				    if (!$this->upload->do_upload()) {
				    	$this->template->error(lang("error_21")
				    	.$this->upload->display_errors());
				    }

				    $data = $this->upload->data();

				    $image = $data['file_name'];
				} else {
					$this->upload->initialize(array( 
				       "upload_path" => $this->settings->info->upload_path,
				       "overwrite" => FALSE,
				       "max_filename" => 300,
				       "encrypt_name" => TRUE,
				       "remove_spaces" => TRUE,
				       "allowed_types" => "gif|png|jpg|jpeg",
				       "max_size" => $this->settings->info->file_size,
				    ));

				    if (!$this->upload->do_upload()) {
				    	$this->template->error(lang("error_21")
				    	.$this->upload->display_errors());
				    }

				    $data = $this->upload->data();

				    $image = $data['file_name'];

					$config['image_library'] = 'gd2';
					$config['source_image'] =  $this->settings->info->upload_path . "/" . $image;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width']         = $this->settings->info->avatar_width;
					$config['height']       = $this->settings->info->avatar_height;

					$this->load->library('image_lib', $config);

					if ( ! $this->image_lib->resize()) {
					       $this->template->error(lang("error_21") . 
					       	$this->image_lib->display_errors());
					}
				}
			} else {
				$image= $this->user->info->avatar;
			}
		} else {
			$image= $this->user->info->avatar;
		}

		// Custom Fields
		// Process fields
		$answers = array();
		foreach($fields->result() as $r) {
			$answer = "";
			if($r->type == 0) {
				// Look for simple text entry
				$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

				if($r->required && empty($answer)) {
					$this->template->error(lang("error_78") . $r->name);
				}
				// Add
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer
				);
			} elseif($r->type == 1) {
				// HTML
				$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

				if($r->required && empty($answer)) {
					$this->template->error(lang("error_78") . $r->name);
				}
				// Add
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer
				);
			} elseif($r->type == 2) {
				// Checkbox
				$options = explode(",", $r->options);
				foreach($options as $k=>$v) {
					// Look for checked checkbox and add it to the answer if it's value is 1
					$ans = $this->common->nohtml($this->input->post("cf_cb_" . $r->ID . "_" . $k));
					if($ans) {
						if(empty($answer)) {
							$answer .= $v;
						} else {
							$answer .= ", " . $v;
						}
					}
				}

				if($r->required && empty($answer)) {
					$this->template->error(lang("error_78") . $r->name);
				}
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer
				);

			} elseif($r->type == 3) {
				// radio
				$options = explode(",", $r->options);
				if(isset($_POST['cf_radio_' . $r->ID])) {
					$answer = intval($this->common->nohtml($this->input->post("cf_radio_" . $r->ID)));
					
					$flag = false;
					foreach($options as $k=>$v) {
						if($k == $answer) {
							$flag = true;
							$answer = $v;
						}
					}
					if($r->required && !$flag) {
						$this->template->error(lang("error_78") . $r->name);
					}
					if($flag) {
						$answers[] = array(
							"fieldid" => $r->ID,
							"answer" => $answer
						);
					}
				}

			} elseif($r->type == 4) {
				// Dropdown menu
				$options = explode(",", $r->options);
				$answer = intval($this->common->nohtml($this->input->post("cf_" . $r->ID)));
				$flag = false;
				foreach($options as $k=>$v) {
					if($k == $answer) {
						$flag = true;
						$answer = $v;
					}
				}
				if($r->required && !$flag) {
					$this->template->error(lang("error_78") . $r->name);
				}
				if($flag) {
					$answers[] = array(
						"fieldid" => $r->ID,
						"answer" => $answer
					);
				}
			}
		}


		$this->user_model->update_user($this->user->info->ID, array(
			"email" => $email, 
			"first_name" => $first_name, 
			"last_name" => $last_name,
			"email_notification" => $enable_email_notification,
			"avatar" => $image,
			"aboutme" => $aboutme		)
		);

		// Update CF
		// Add Custom Fields data
		foreach($answers as $answer) {
			// Check if field exists
			$field = $this->user_model->get_user_cf($answer['fieldid'], $this->user->info->ID);
			if($field->num_rows() == 0) {
				$this->user_model->add_custom_field(array(
					"userid" => $this->user->info->ID,
					"fieldid" => $answer['fieldid'],
					"value" => $answer['answer']
					)
				);
			} else {
				$this->user_model->update_custom_field($answer['fieldid'], 
					$this->user->info->ID, $answer['answer']);
			}
		}

		
		$this->session->set_flashdata("globalmsg", lang("success_22"));
		redirect(site_url("user_settings"));
	}


	public function change_password() 
	{
		$this->template->loadContent("user_settings/change_password.php", array(
			)
		);
	}

	/* check current password*/
	public function checkCurrentPassword($param){
        $current_password = $this->user->getPassword();

        if (!empty($current_password))
        {
        	$phpass = new PasswordHash(12, false);
	    	if (!$phpass->CheckPassword($param, $current_password)) {
	    		$this->form_validation->set_message("checkCurrentPassword", lang("error_59"));
                return false;
	    	}else{
	    		return true;
	    	}      
        } else {
        	$this->form_validation->set_message("checkCurrentPassword", lang("error_59"));
            return false;
        }
    }

	public function change_password_pro($id=null) 
	{
        $this->form_validation->set_rules('current_password', lang('current_password'), 'trim|required|min_length[5]|callback_checkCurrentPassword');
		$this->form_validation->set_rules('new_pass1', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('new_pass2', 'Confirm Password', 'required|matches[new_pass1]');

        if($this->form_validation->run() == false)
        {
            $this->template->loadContent("user_settings/change_password.php", array());
        }else{
        	$current_password = $this->common->nohtml($this->input->post("current_password"));
			$new_pass1 = $this->common->nohtml($this->input->post("new_pass1"));
			$new_pass2 = $this->common->nohtml($this->input->post("new_pass2"));

            $pass = $this->common->encrypt($new_pass1);
			$this->user_model->update_user($this->user->info->ID, array("password" => $pass));
			$this->session->set_flashdata("success", lang("success_23"));
			redirect(site_url("user_settings"));
        }    	
	}

	public function social_networks() 
	{
		$this->template->loadContent("user_settings/social_networks.php", array(
			)
		);
	}

	public function deauth($hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		// Check user has a pw
		if(empty($this->user->getPassword())) {
			$this->template->error(lang("error_146"));
		}
		$config = $this->config->item("cookieprefix");
		$this->load->helper("cookie");
		delete_cookie($config. "provider");
		delete_cookie($config. "oauthid");
		delete_cookie($config. "oauthtoken");
		delete_cookie($config. "oauthsecret");
		delete_cookie($config. "acc");

		$this->user_model->update_user($this->user->info->ID, array(
			"oauth_provider" => "",
			"oauth_id" => "",
			"oauth_token" => "",
			"oauth_secret" => "",
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_90"));
		redirect(site_url("user_settings/social_networks"));
	}

}

?>