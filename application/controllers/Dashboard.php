<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $moduleName = null;

    public function __construct() {
        parent::__construct();
        $this->load->model("admin_model");
        $this->load->model("user_model");
        $this->load->model("home_model");
        $this->load->model("RoleModel",'roleModel');
        $this->load->helper('accessright');
        $this->load->helper('dashboard');
        $this->load->helper('accessright');
        $this->load->helper('currency');
        
        if (!$this->user->loggedin){
            redirect('login');
        }

        // if (!$this->user->loggedin)
        //     $this->template->error(lang("error_1"));
        // if (!$this->common->has_permissions(array("admin", "admin_settings",
        //             "admin_members", "admin_payment", "admin_announcements"), $this->user)) {
        //     $this->template->error(lang("error_2"));
        // }

        $this->data['moduleName'] = strtolower(get_class());
        $this->moduleName = strtolower(get_class());
    }

    public function index(){
        $this->template->loadData("activeLink", array("admin" => array("general" => 1)));
        $new_members = $this->user_model->get_new_members(5);
        $months = array();

        // Graph Data
        $current_month = date("n");
        $current_year = date("Y");

        // First month
        for ($i = 6; $i >= 0; $i--) {
            // Get month in the past
            $new_month = $current_month - $i;
            // If month less than 1 we need to get last years months
            if ($new_month < 1) {
                $new_month = 12 + $new_month;
                $new_year = $current_year - 1;
            } else {
                $new_year = $current_year;
            }
            // Get month name using mktime
            $timestamp = mktime(0, 0, 0, $new_month, 1, $new_year);
            $count = $this->user_model
                    ->get_registered_users_date($new_month, $new_year);
            $months[] = array(
                "date" => date("F", $timestamp),
                "count" => $count
            );
        }


        $javascript = 'var data_graph = {
                        labels: [';
        foreach ($months as $d) {
            $javascript .= '"' . $d['date'] . '",';
        }
        $javascript .= '],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [';
        foreach ($months as $d) {
            $javascript .= $d['count'] . ',';
        }
        $javascript .= ']
                }
            ]
        };';


        $stats = $this->home_model->get_home_stats();
        if ($stats->num_rows() == 0) {
            $this->template->error(lang("error_24"));
        } else {
            $stats = $stats->row();
            if ($stats->timestamp < time() - 3600 * 5) {
                $stats = $this->get_fresh_results($stats);
                // Update Row
                $this->home_model->update_home_stats($stats);
            }
        }


        $javascript .= ' var social_data = {
                labels:[
                    "Google","Local","Facebook","Twitter"
                ],
                datasets:[
                {
                    data:[' . $stats->google_members . ',' . ($stats->total_members - ($stats->google_members +
                $stats->facebook_members + $stats->twitter_members)) . ',' . $stats->facebook_members . ',' . $stats->twitter_members . '],
                    backgroundColor: [
                        "#F7464A",
                        "#39bc2c",
                        "#2956BF",
                        "#5BACD4"
                    ],
                    hoverBackgroundColor: [
                        "#FF5A5E",
                        "#5AD3D1",
                        "#FFC870",
                        "#7db864"
                    ]
                }
                ]
        };';

        $online_count = $this->user_model->get_online_count();
        $online_user = $this->user_model->get_online_user();
                    
                    
        $this->template->loadExternal(
                '<script type="text/javascript" src="'
                . base_url() . 'scripts/libraries/Chart.min.js" /></script>
            <script type="text/javascript">' . $javascript . '</script>
            <script type="text/javascript" src="'
                . base_url() . 'scripts/custom/home.js" /></script>'
        );

            $online_count = $this->user_model->get_online_count();

            $this->template->loadContent("admin/index.php", array(
                "new_members" => $new_members,
                "stats" => $stats,
                "online_count" => $online_count,
                "online_user" =>$online_user
                    )
            );

    }

}
?>