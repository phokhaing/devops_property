<?php

class Tickets_Model extends CI_Model {

    public function get_categories() {
        return $this->db->get("ticket_categories");
    }

    public function get_user_categories($userid) {
        return $this->db->select("ticket_categories.name, ticket_categories.ID")
                        ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                        ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                        ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                        ->where("user_group_users.userid", $userid)
                        ->group_by("ticket_categories.ID")
                        ->get("ticket_categories");
    }
    public function get_user_categories_no_parent($userid) {
        return $this->db->select("ticket_categories.name, ticket_categories.ID")
                        ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                        ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                        ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                        ->where("user_group_users.userid", $userid)
                        ->where("ticket_categories.cat_parent", 0)
                        ->group_by("ticket_categories.ID")
                        ->get("ticket_categories");
    }

    public function get_category($id) {
        return $this->db->where("ID", $id)
                        ->order_by("ticket_categories.cat_parent")
                        ->get("ticket_categories");
    }

    public function add_category($data) {
        $this->db->insert("ticket_categories", $data);
        return $this->db->insert_id();
    }

    public function delete_category($id) {
        $this->db->where("ID", $id)->delete("ticket_categories");
    }

    public function update_category($id, $data) {
        $this->db->where("ID", $id)->update("ticket_categories", $data);
    }

    public function get_categories_total() {
        $s = $this->db->select("COUNT(*) as num")->get("ticket_categories");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_categories_dt($datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "ticket_categories.name",
            "t_c.name",
                )
        );

        return $this->db
                        ->select("ticket_categories.ID, ticket_categories.name, 
				ticket_categories.image, ticket_categories.description,
				ticket_categories.cat_parent,
				t_c.name as name2")
                        ->join("ticket_categories as t_c", "t_c.ID = ticket_categories.cat_parent", "left outer")
                        ->limit($datatable->length, $datatable->start)
                        ->get("ticket_categories");
    }

    public function add_custom_field($data) {
        $this->db->insert("ticket_custom_fields", $data);
        return $this->db->insert_id();
    }

    public function update_custom_field($id, $data) {
        $this->db->where("ID", $id)->update("ticket_custom_fields", $data);
    }

    public function add_field_cats($data) {
        $this->db->insert("ticket_custom_field_cats", $data);
    }

    public function get_custom_fields_total() {
        $s = $this->db->select("COUNT(*) as num")->get("ticket_custom_fields");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_custom_fields($datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "ticket_custom_fields.name"
                )
        );

        return $this->db
                        ->limit($datatable->length, $datatable->start)
                        ->get("ticket_custom_fields");
    }

    public function get_custom_field($id) {
        return $this->db->where("ID", $id)->get("ticket_custom_fields");
    }

    public function delete_custom_field($id) {
        $this->db->where("ID", $id)->delete("ticket_custom_fields");
    }

    public function get_field_cats($fieldid) {
        return $this->db
                        ->select("ticket_categories.ID, ticket_categories.name, ticket_custom_field_cats.ID as cid")
                        ->join("ticket_custom_field_cats", "ticket_custom_field_cats.catid = ticket_categories.ID AND ticket_custom_field_cats.fieldid = " . $fieldid, "left outer")
                        ->get("ticket_categories");
    }

    public function delete_custom_fields_cats($id) {
        $this->db->where("fieldid", $id)->delete("ticket_custom_field_cats");
    }

    public function get_category_no_parent() {
        return $this->db->where("cat_parent", 0)->get("ticket_categories");
    }
    
    /*
     * get Environment Production or Testing
     */
    public function get_environment() {
        return $this->db->where("Active", 'Y')
                ->where('Deleted',"N")
                ->get("ticket_environment");
    }    

    public function get_sub_cats($parentid) {
        return $this->db->where("cat_parent", $parentid)->get("ticket_categories");
    }

    public function get_custom_fields_all_cats() {
        return $this->db->where("all_cats", 1)->get("ticket_custom_fields");
    }

    public function get_custom_fields_for_cat($catid) {
        return $this->db
                        ->select("ticket_custom_fields.ID, ticket_custom_fields.name,
				ticket_custom_fields.type, ticket_custom_fields.options,
				ticket_custom_fields.help_text, ticket_custom_fields.required,
				ticket_custom_fields.all_cats, ticket_custom_fields.hide_clientside")
                        ->where("ticket_custom_field_cats.catid", $catid)
                        ->join("ticket_custom_fields", "ticket_custom_fields.ID = ticket_custom_field_cats.fieldid")
                        ->get("ticket_custom_field_cats");
    }

    public function add_ticket($data){
        $this->db->insert("tickets", $data);
        return $this->db->insert_id();
    }

    public function add_custom_field_data($data){
        $this->db->insert("ticket_user_custom_fields", $data);
    }

    public function add_attached_files($data) {
        $this->db->insert("ticket_files", $data);
    }

    public function get_tickets_rating_total() {


        $s = $this->db
                ->where("rating >", 0)
                ->select("COUNT(*) as num")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_rating_tickets($datatable) {

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string"
                )
        );

        return $this->db
                        ->where("tickets.rating >", 0)
                        ->select("tickets.ID, tickets.rating, tickets.title, tickets.userid,
				 tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				ticket_categories.name as cat_name")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_user_ratings_total() {
        $s = $this->db
                ->where("tickets.rating >", 0)
                ->select("COUNT(*) as num")
                ->join("tickets", "tickets.assignedid = users.ID")
                ->group_by("users.ID")
                ->get("users");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_user_ratings($datatable) {

        $datatable->db_order();

        $datatable->db_search(array(
            "users.username"
                )
        );

        return $this->db
                        ->where("tickets.rating >", 0)
                        ->select("users.username, users.avatar, users.online_timestamp,
			 AVG(tickets.rating) as avgrating, COUNT(tickets.ID) as total")
                        ->join("tickets", "tickets.assignedid = users.ID")
                        ->limit($datatable->length, $datatable->start)
                        ->group_by("users.ID")
                        ->get("users");
    }

    public function get_tickets_total($catid, $view, $datatable) {
        // $datatable->db_search(array(
        //     "tickets.title",
        //     "users.username",
        //     "u2.username",
        //     "tickets.guest_email",
        //     "tickets.last_reply_string",
        //     "tickets.ID"
        //         )
        // );

        // if ($view->num_rows() > 0) { 
        //     $view = $view->row();
        //     $catid = $view->categoryid;

        //     if ($view->status != -1) {
        //         $this->db->where("tickets.status", $view->status);
        //     }
        // }
        // if ($catid > 0) {
        //     $this->db->where("tickets.categoryid", $catid);
        // }

        // $s = $this->db
        //         ->where("tickets.archived", 0)
        //         ->select("COUNT(*) as num")
        //         ->join("users", "users.ID = tickets.userid", "left outer")
        //         ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
        //         ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
        //         ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
        //         ->get("tickets");
                
                /*
         * -------------------------------------------------------
         * if user has permission list_all, so user can view all tickets.
         * but if user has only permission list_own_department, 
         * user can view the records that related to own department only.
         * -------------------------------------------------------
         */         
        if(!$this->authorization->hasPermission("TICKETS", "LIST_ALL")){
            if($this->authorization->hasPermission("TICKETS", "LIST_OWN_DEPARTMENT")){
                $this->db->where_in('tickets.userid', getUserIdByDepId($this->user->info->department_id));
            }else{
                $this->db->where('tickets.userid', $this->user->info->ID);
            }
        }

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }

                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        if(isset($_GET['start_date']) && $_GET['start_date'] !=null){
            $this->db->where('tickets.timestamp >=', strtotime($_GET['start_date']));
        }
        if(isset($_GET['end_date']) && $_GET['end_date'] !=null){
            $this->db->where('tickets.timestamp <=', strtotime($_GET['end_date']));
        }
        $this->db->where("tickets.archived", 0);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }
        
        return   $this->db
                    ->select("*")
                    ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                    ->join("users", "users.ID = tickets.userid", "left outer")
                    ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                    ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid", "left outer")
                    ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                    ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                    ->join("branch", "branch.id_branch = users.branch", "left outer")
                    ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                    ->group_by('tickets.ID') 
                    ->get("tickets")
                    ->num_rows();
    }

    public function count_ticket_close(){
        $r =   $this->db
                    ->where('custom_statuses.close', 1)
                    ->where("tickets.archived", 0)
                    ->select("COUNT(*) as num")
                    ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                    ->join("users", "users.ID = tickets.userid", "left outer")
                    ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                    ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid", "left outer")
                    ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                    ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                    ->join("branch", "branch.id_branch = users.branch", "left outer")
                    ->get("tickets")
                    ->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }
    public function count_ticket_progress(){
        $r =   $this->db
                    ->where('custom_statuses.close', 0)
                    ->where("tickets.archived", 0)
                    ->select("COUNT(*) as num")
                    ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                    ->join("users", "users.ID = tickets.userid", "left outer")
                    ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                    ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid", "left outer")
                    ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                    ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                    ->join("branch", "branch.id_branch = users.branch", "left outer")
                    ->get("tickets")
                    ->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }
    public function count_ticket_your_progress($userid){
        $s = $this->db
                ->where('custom_statuses.close', 0)
                ->where("tickets.archived", 0)
                ->select("COUNT(*) as num")
                ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                ->where("user_group_users.userid", $userid)
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }
    public function count_ticket_your_close($userid){
        $s = $this->db
                ->where('custom_statuses.close', 1)
                ->where("tickets.archived", 0)
                ->select("COUNT(*) as num")
                ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                ->where("user_group_users.userid", $userid)
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }
    public function count_ticket_assigned_progress($userid){
        $s = $this->db
                ->where('custom_statuses.close', 0)
                ->where("tickets.archived", 0)
                ->where("tickets.assignedid", $userid)
                ->select("COUNT(*) as num")
                ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }
    public function count_ticket_assigned_close($userid){
        $s = $this->db
                ->where('custom_statuses.close', 1)
                ->where("tickets.archived", 0)
                ->where("tickets.assignedid", $userid)
                ->select("COUNT(*) as num")
                ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }
    public function count_ticket_archived_progress(){
        $s = $this->db
                ->where('custom_statuses.close', 0)
                ->where("tickets.archived", 1)
                ->select("COUNT(*) as num")
                ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }
    public function count_ticket_archived_close(){
        $s = $this->db
                ->where('custom_statuses.close', 1)
                ->where("tickets.archived", 1)
                ->select("COUNT(*) as num")
                ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_tickets_total_no_view($catid) {
        if ($catid > 0) {
            $this->db->where("tickets.categoryid", $catid);
        }

        $s = $this->db
                ->select("COUNT(*) as num")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }


    /**
      *--------------------------------------
      * START BLOG EXPORT TICKETS
      *--------------------------------------
      */

    /**
      *@author: Mr.Khaing
      *@param: retrieve all ticket for export 
      */
    public function get_tickets_export($catid, $datatable, $view){
        
        /*
         * -------------------------------------------------------
         * if user has permission list_all, so user can view all tickets.
         * but if user has only permission list_own_department, 
         * user can view the records that related to own department only.
         * -------------------------------------------------------
         */
        if(!$this->authorization->hasPermission("TICKETS", "LIST_ALL")){
            if($this->authorization->hasPermission("TICKETS", "LIST_OWN_DEPARTMENT")){
                $this->db->where_in('tickets.userid', getUserIdByDepId($this->user->info->department_id));
            }else{
                $this->db->where('tickets.userid', $this->user->info->ID);
            }
        }

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }
                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        if(isset($_GET['start_date']) && $_GET['start_date'] !=null){
            $this->db->where('tickets.timestamp >=', strtotime($_GET['start_date']));
        }
        if(isset($_GET['end_date']) && $_GET['end_date'] !=null){
            $this->db->where('tickets.timestamp <=', strtotime($_GET['end_date']));
        }

        $this->db->where("tickets.archived", 0);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
                tickets.timestamp, tickets.categoryid, tickets.status,
                tickets.priority,tickets.ticket_date, tickets.last_reply_timestamp,
                tickets.close_timestamp,
                tickets.last_reply_userid, tickets.message_id_hash, 
                tickets.guest_email,
                users.username as client_username, users.avatar as client_avatar,
                users.online_timestamp as client_online_timestamp,
                users.first_name as client_first_name, 
                users.last_name as client_last_name,
                u2.username, u2.avatar, u2.online_timestamp, users.first_name,
                users.last_name,
                                
                                branch.branch_name as department,
                                
                                ticket_environment.Environment_name as evironment,
                                
                u3.username as lr_username, u3.avatar as lr_avatar, 
                u3.online_timestamp as lr_online_timestamp,
                ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                custom_statuses.name as status_name, custom_statuses.color as status_color,
                custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID')  
                        ->get("tickets");
    }
    public function get_tickets_export_your($userid, $catid, $datatable, $view) {
        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }
                
                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 0);
        $this->db->where("user_group_users.userid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
                tickets.timestamp, tickets.categoryid, tickets.status,
                tickets.priority, tickets.ticket_date,tickets.last_reply_timestamp,
                tickets.last_reply_userid, tickets.message_id_hash, 
                tickets.close_timestamp,
                tickets.guest_email,
                users.username as client_username, users.avatar as client_avatar,
                users.online_timestamp as client_online_timestamp,
                u2.username, u2.avatar, u2.online_timestamp,
                u3.username as lr_username, u3.avatar as lr_avatar, 
                u3.online_timestamp as lr_online_timestamp,
                ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                branch.branch_name as department,
                                ticket_environment.Environment_name as evironment,
                                
                custom_statuses.name as status_name, custom_statuses.color as status_color,
                custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                
                        ->join("branch", "branch.id_branch = users.branch","left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                        ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                        ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by("tickets.ID")
                        ->get("tickets");
    }
    public function get_tickets_export_assigned($userid, $catid, $datatable, $view) {
        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }
                
                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 0);
        $this->db->where("tickets.assignedid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }


        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
                tickets.timestamp, tickets.categoryid, tickets.status,
                tickets.priority,tickets.ticket_date, tickets.last_reply_timestamp,
                tickets.close_timestamp,
                tickets.last_reply_userid, tickets.message_id_hash, 
                tickets.guest_email,
                users.username as client_username, users.avatar as client_avatar,
                users.online_timestamp as client_online_timestamp,
                u2.username, u2.avatar, u2.online_timestamp,
                u3.username as lr_username, u3.avatar as lr_avatar, 
                u3.online_timestamp as lr_online_timestamp,
                ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                
                                branch.branch_name as department,
                                ticket_environment.Environment_name as evironment,
                                
                custom_statuses.name as status_name, custom_statuses.color as status_color,
                custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        // ->join("branch", "branch.id_branch = users.branch")
                        ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID') 
                        ->get("tickets");
    }
    public function get_tickets_export_archived($catid, $datatable, $view) {

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }
                
                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }
        
        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 1);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
                tickets.timestamp, tickets.categoryid, tickets.status,
                tickets.priority, tickets.ticket_date,tickets.last_reply_timestamp,
                tickets.close_timestamp,
                tickets.last_reply_userid, tickets.message_id_hash, 
                tickets.guest_email,
                users.username as client_username, users.avatar as client_avatar,
                users.online_timestamp as client_online_timestamp,
                users.first_name as client_first_name, 
                users.last_name as client_last_name,
                u2.username, u2.avatar, u2.online_timestamp, users.first_name,
                users.last_name,
                u3.username as lr_username, u3.avatar as lr_avatar, 
                u3.online_timestamp as lr_online_timestamp,
                ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                
                                branch.branch_name as department,
                                ticket_environment.Environment_name as evironment,
                                 
                custom_statuses.name as status_name, custom_statuses.color as status_color,
                custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                // ->join("branch", "branch.id_branch = users.branch")
                ->join("branch", "branch.id_branch = users.branch", "left outer")
                ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID')  
                        ->get("tickets");
    }
    public function get_tickets_export_user($userid, $datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 0);
        $this->db->where("tickets.userid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
                tickets.timestamp, tickets.categoryid, tickets.status,
                tickets.priority, tickets.last_reply_timestamp,tickets.ticket_date,
                tickets.last_reply_userid, tickets.message_id_hash, 
                tickets.close_timestamp,
                tickets.guest_email,
                users.username as client_username, users.avatar as client_avatar,
                users.online_timestamp as client_online_timestamp,
                users.first_name as client_first_name, 
                users.last_name as client_last_name,
                u2.username, u2.avatar, u2.online_timestamp, users.first_name,
                users.last_name,
                u3.username as lr_username, u3.avatar as lr_avatar, 
                u3.online_timestamp as lr_online_timestamp,
                ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                ticket_environment.Environment_name as evironment,
                                branch.branch_name as department,
                                
                custom_statuses.name as status_name, custom_statuses.color as status_color,
                custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        // ->join("branch", "branch.id_branch = users.branch")
                        ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer") 
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")        
                        ->group_by('tickets.ID') 
                        ->get("tickets");
    }
    /**
      *--------------------------------------
      * END BLOG EXPORT TICKETS
      *--------------------------------------
      */
    public function get_ticket_cc_by_userid($userID){
        return $this->db
                    ->where('user_id', $userID)
                    ->get('ticket_cc')
                    ->result();
    }

    public function get_tickets($catid, $datatable, $view) {

        /*
         * -------------------------------------------------------
         * if user has permission list_all, so user can view all tickets.
         * but if user has only permission list_own_department, 
         * user can view the records that related to own department only.
         * -------------------------------------------------------
        */
        if(!$this->authorization->hasPermission("TICKETS", "LIST_ALL")){
            if($this->authorization->hasPermission("TICKETS", "LIST_OWN_DEPARTMENT")){
                $this->db->where_in('tickets.userid', getUserIdByDepId($this->user->info->department_id));
            }else{
                $this->db->where('tickets.userid', $this->user->info->ID);
            }
        }

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }

                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        if(isset($_GET['start_date']) && $_GET['start_date'] !=null){
            $this->db->where('tickets.timestamp >=', strtotime($_GET['start_date']));
        }
        if(isset($_GET['end_date']) && $_GET['end_date'] !=null){
            $this->db->where('tickets.timestamp <=', strtotime($_GET['end_date']));
        }
        
        $this->db->where("tickets.archived", 0);

        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority,tickets.ticket_date, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				users.first_name as client_first_name, 
				users.last_name as client_last_name,
				u2.username, u2.avatar, u2.online_timestamp, users.first_name,
				users.last_name,
                                
                                branch.branch_name as department,
                                
                                ticket_environment.Environment_name as evironment,
                                
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID')              
// //                ticket_environment.Environment_name as evironment,            
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_tickets_archived_total($catid, $view, $datatable){
        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
            )
        );

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }
        if ($catid > 0) {
            $this->db->where("tickets.categoryid", $catid);
        }


        $this->db->where("tickets.archived", 1);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                ->select("*")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                ->group_by('tickets.ID')  
                ->get("tickets")
                ->num_rows();
    }

    public function get_tickets_archived($catid, $datatable, $view) {

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }
                
                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 1);

        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.ticket_date,tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				users.first_name as client_first_name, 
				users.last_name as client_last_name,
				u2.username, u2.avatar, u2.online_timestamp, users.first_name,
				users.last_name,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                
                                branch.branch_name as department,
                                ticket_environment.Environment_name as evironment,
                                 
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                // ->join("branch", "branch.id_branch = users.branch")
                ->join("branch", "branch.id_branch = users.branch", "left outer")
                ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID') 
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_tickets_user_total($userid, $datatable) {
        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email", 
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $s = $this->db
                ->where("tickets.archived", 0)
                ->where("tickets.userid", $userid)
                ->select("COUNT(*) as num")
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_tickets_user($userid, $datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 0);
        $this->db->where("tickets.userid", $userid);

        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,tickets.ticket_date,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				users.first_name as client_first_name, 
				users.last_name as client_last_name,
				u2.username, u2.avatar, u2.online_timestamp, users.first_name,
				users.last_name,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                ticket_environment.Environment_name as evironment,
                                branch.branch_name as department,
                                
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        // ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID')  
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_tickets_assigned_total($userid, $catid, $view, $datatable) {
        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }
        if ($catid > 0) {
            $this->db->where("tickets.categoryid", $catid);
        }

        $this->db->where("tickets.archived", 0);
        $this->db->where("tickets.assignedid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                ->select('*')
                ->join("users", "users.ID = tickets.userid", "left outer")
                ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                ->group_by('tickets.ID') 
                ->get("tickets")
                ->num_rows();
    }

    public function get_tickets_assigned_total_no_view($userid, $catid) {
        if ($catid > 0) {
            $this->db->where("tickets.categoryid", $catid);
        }

        $s = $this->db
                ->where("tickets.archived", 0)
                ->where("assignedid", $userid)
                ->select("COUNT(*) as num")
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_tickets_assigned($userid, $catid, $datatable, $view) {
        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }
                
                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 0);
        $this->db->where("tickets.assignedid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority,tickets.ticket_date, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                
                                branch.branch_name as department,
                                ticket_environment.Environment_name as evironment,
                                
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        // ->join("branch", "branch.id_branch = users.branch")
                        ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID') 
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_client_tickets_total($userid) {
        $this->db->where("userid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }
        return $this->db
                ->select("*")
                ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                ->group_by('tickets.ID') 
                ->get("tickets")
                ->num_rows();
    }

    public function get_client_tickets($userid, $datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title"
                )
        );

        $this->db->where("tickets.userid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,ticket_categories.cat_parent,
                            branch.branch_name as department,
                            ticket_environment.Environment_name as evironment,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                ->join("branch", "branch.id_branch = users.branch", "left outer")
                ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID')  
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_public_tickets_total() {
        $this->db->where("public", 1);
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }
        return $this->db
                ->select("*")
                ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
                        ->group_by('tickets.ID')  
                ->get("tickets")
                ->num_rows();
    }

    public function get_public_tickets($datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title"
                )
        );

        $this->db->where("tickets.public", 1);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }
        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,ticket_categories.cat_parent,
                                branch.branch_name as department,
                            ticket_environment.Environment_name as evironment,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("branch", "branch.id_branch = users.branch", "left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")
                        ->group_by('tickets.ID')  
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_recent_public_tickets($limit) {

        return $this->db
                        ->where("tickets.public", 1)
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email, tickets.body,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->limit($limit)
                        ->get("tickets");
    }

    public function get_tickets_your_total($userid, $catid, $view, $datatable) {
        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }
        if ($catid > 0) {
            $this->db->where("tickets.categoryid", $catid);
        }

        $this->db->where("tickets.archived", 0);
        $this->db->where("user_group_users.userid", $userid);
        // get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                    ->select(' *')
                    ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                    ->join("users", "users.ID = tickets.userid", "left outer")
                    ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                    ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                    ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
            
                    ->join("branch", "branch.id_branch = users.branch","left outer")
                    ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                    ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                    ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                    ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                    ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")  
                    ->group_by("tickets.ID")
                    ->get("tickets")
                    ->num_rows();

        // return $this->db
        //         ->select("*")
        //         ->join("users", "users.ID = tickets.userid", "left outer")
        //         ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
        //         ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
        //         ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
        //         ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
        //         ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
        //         ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")     
        //         ->group_by('tickets.ID') 
        //         ->where("user_group_users.userid", $userid)
        //         ->get("tickets")
        //         ->num_rows();
    }

    public function get_tickets_your($userid, $catid, $datatable, $view) {
        // var_dump($datatable);
        if ($view->num_rows() > 0) {
            $view = $view->row();
            $catid = $view->categoryid;

            if ($view->status != -1) {
                $this->db->where("tickets.status", $view->status);
            }
        }

        $where = null;
        $where_in = array();
        if ($catid > 0){
            $cat_parent = $this->db->select('cat_parent')
              ->where('ID', $catid)
              ->get('ticket_categories')
              ->row();
                if(!empty($cat_parent)){
                    if($cat_parent->cat_parent == 0){
                        $where = $this->db->select('*')
                            ->where('cat_parent', $catid)
                            ->get('ticket_categories')
                            ->result();
                    }
                }
                
                if(!empty($where)){
                    foreach ($where as $catsub){
                        // $this->db->or_where("tickets.categoryid", $catsub->ID);
                        $where_in[] = (int) $catsub->ID;
                    }
                }

            $where_in[] = (int) $catid;
            $this->db->where_in("tickets.categoryid", $where_in);
        }

        // check status 0 is progress and status 1 is close
        if((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where_in('custom_statuses.close', array(0,1)); 
            // $this->db->or_where('custom_statuses.close', 1); 
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'true') && (isset($_GET['close']) && $_GET['close'] == 'false')){
            $this->db->where('custom_statuses.close', 0); // status 0 is progress
        }
        elseif((isset($_GET['progress']) && $_GET['progress'] == 'false') && (isset($_GET['close']) && $_GET['close'] == 'true')){
            $this->db->where('custom_statuses.close', 1); 
        }

        $datatable->db_order();

        $datatable->db_search(array(
            "tickets.title",
            "users.username",
            "u2.username",
            "tickets.guest_email",
            "tickets.last_reply_string",
            "tickets.ID"
                )
        );

        $this->db->where("tickets.archived", 0);
        $this->db->where("user_group_users.userid", $userid);
        //get ticket that cc to user
        $user_id = $this->user->info->ID;
        if($user_id != null || $user_id != ''){
            $this->db->or_where('ticket_cc.user_id', $user_id);
        }

        return $this->db
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.ticket_date,tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
                                branch.branch_name as department,
                                ticket_environment.Environment_name as evironment,
                                
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                
                        ->join("branch", "branch.id_branch = users.branch","left outer")
                        ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                        ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                        ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                        ->join("ticket_cc","tickets.ID = ticket_cc.ticket_id","left outer")  
                        ->group_by("tickets.ID")
                        ->limit($datatable->length, $datatable->start)
                        ->get("tickets");
    }

    public function get_tickets_your_limit($userid, $catid, $limit) {
        if ($catid > 0) {
            $this->db->where("tickets.categoryid", $catid);
        }

        return $this->db
                        ->where("tickets.archived", 0)
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				ticket_categories.name as cat_name,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->join("ticket_category_groups", "ticket_category_groups.catid = ticket_categories.ID", "left outer")
                        ->join("user_groups", "user_groups.ID = ticket_category_groups.groupid", "LEFT OUTER")
                        ->join("user_group_users", "user_group_users.groupid = user_groups.ID", "LEFT OUTER")
                        ->where("user_group_users.userid", $userid)
                        ->group_by("tickets.ID")
                        ->limit($limit)
                        ->get("tickets");
    }

    public function get_tickets_assigned_limit($userid, $catid, $limit) {
        if ($catid > 0) {
            $this->db->where("tickets.categoryid", $catid);
        }

        // status 0 is progress
        return $this->db
                        ->where('custom_statuses.close', 0)
                        ->where("tickets.archived", 0)
                        ->where("tickets.assignedid", $userid)
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,tickets.ticket_date,tickets.close_timestamp,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp,
				u2.username, u2.avatar, u2.online_timestamp,
				ticket_categories.name as cat_name,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
                                ticket_environment.Environment_name as evironment,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                ->join("ticket_environment", "ticket_environment.id_environment = tickets.environmentid")
                        ->limit($limit)
                        ->get("tickets");
    }

    public function get_ticket($id) {
        return $this->db
                        ->where("tickets.ID", $id)
                        ->select("tickets.ID, tickets.environmentid, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email, tickets.guest_password, tickets.public,
				tickets.notes, tickets.body, tickets.rating, tickets.archived,
				tickets.close_timestamp,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp, users.email as 
				client_email, users.email_notification as client_email_notification,
				users.first_name, users.last_name,
				u2.username, u2.avatar, u2.online_timestamp, u2.email, 
				u2.email_notification,
				ticket_categories.name as cat_name, ticket_categories.cat_parent,ticket_categories.ID as cat_ID,ticket_categories.cat_parent as cat_parent,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color, custom_statuses.close as status_close")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->get("tickets");
    }

    public function get_guest_ticket($email, $pass) {
        return $this->db
                        ->where("tickets.guest_email", $email)
                        ->where("tickets.guest_password", $pass)
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email, tickets.notes, tickets.body,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp, users.email as 
				client_email, users.first_name, users.last_name,
				u2.username, u2.avatar, u2.online_timestamp,
				ticket_categories.name as cat_name, ticket_categories.cat_parent,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->get("tickets");
    }

    public function delete_ticket($id) {
        $this->db->where("ID", $id)->delete("tickets");
    }

    public function update_ticket($id, $data) {
        $this->db->where("ID", $id)->update("tickets", $data);
    }

    public function get_custom_fields_for_cat_ticket($ticketid, $catid) {
        return $this->db
                        ->select("ticket_custom_fields.ID, ticket_custom_fields.name,
				ticket_custom_fields.type, ticket_custom_fields.options,
				ticket_custom_fields.help_text, ticket_custom_fields.required,
				ticket_custom_fields.all_cats, 
				ticket_custom_fields.hide_clientside,
				ticket_user_custom_fields.value,
				ticket_user_custom_fields.itemname,
				ticket_user_custom_fields.support,
				ticket_user_custom_fields.error")
                        ->where("ticket_custom_field_cats.catid", $catid)
                        ->join("ticket_custom_fields", "ticket_custom_fields.ID = ticket_custom_field_cats.fieldid")
                        ->join("ticket_user_custom_fields", "ticket_user_custom_fields.fieldid = ticket_custom_fields.ID AND ticket_user_custom_fields.ticketid = " . $ticketid, "left outer")
                        ->get("ticket_custom_field_cats");
    }

    public function get_custom_fields_all_cats_ticket($ticketid) {
        return $this->db
                        ->select("ticket_custom_fields.ID, ticket_custom_fields.name,
				ticket_custom_fields.type, ticket_custom_fields.options,
				ticket_custom_fields.help_text, ticket_custom_fields.required,
				ticket_custom_fields.all_cats,
				ticket_custom_fields.hide_clientside,
				ticket_user_custom_fields.value,
				ticket_user_custom_fields.itemname,
				ticket_user_custom_fields.support,
				ticket_user_custom_fields.error")
                        ->where("ticket_custom_fields.all_cats", 1)
                        ->join("ticket_user_custom_fields", "ticket_user_custom_fields.fieldid = ticket_custom_fields.ID AND ticket_user_custom_fields.ticketid = " . $ticketid, "left outer")
                        ->get("ticket_custom_fields");
    }

    public function get_ticket_files($ticketid) {
        return $this->db->where("ticketid", $ticketid)->get("ticket_files");
    }

    public function get_ticket_file($id) {
        return $this->db->where("ID", $id)->get("ticket_files");
    }

    public function delete_ticket_file($id) {
        $this->db->where("ID", $id)->delete("ticket_files");
    }

    public function delete_custom_field_data($id) {
        $this->db->where("ticketid", $id)->delete("ticket_user_custom_fields");
    }

    public function add_ticket_reply($data) {
        $this->db->insert("ticket_replies", $data);
        return $this->db->insert_id();
    }

    public function get_ticket_replies($id) {
        return $this->db
                        ->where("ticket_replies.ticketid", $id)
                        ->select("ticket_replies.ID, ticket_replies.body, 
				ticket_replies.timestamp, ticket_replies.files, ticket_replies.last_reply,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp")
                        ->join("users", "users.ID = ticket_replies.userid", "left outer")
                        ->order_by("ticket_replies.ID")
                        ->get("ticket_replies");
    }

    public function get_ticket_reply($id) {
        return $this->db->where("ID", $id)->get("ticket_replies");
    }

    public function update_ticket_reply($id, $data) {
        $this->db->where("ID", $id)->update("ticket_replies", $data);
    }

    public function delete_ticket_reply($id) {
        $this->db->where("ID", $id)->delete("ticket_replies");
    }

    public function get_custom_fields_for_ticket($ticketid) {
        return $this->db
                        ->select("ticket_custom_fields.ID, ticket_custom_fields.name,
				ticket_custom_fields.type, ticket_custom_fields.options,
				ticket_custom_fields.help_text, ticket_custom_fields.required,
				ticket_custom_fields.all_cats,
				ticket_custom_fields.hide_clientside,
				ticket_user_custom_fields.value,
				ticket_user_custom_fields.itemname,
				ticket_user_custom_fields.support,
				ticket_user_custom_fields.error")
                        ->join("ticket_user_custom_fields", "ticket_user_custom_fields.fieldid = ticket_custom_fields.ID AND ticket_user_custom_fields.ticketid = " . $ticketid)
                        ->get("ticket_custom_fields");
    }

    public function add_category_group($data) {
        $this->db->insert("ticket_category_groups", $data);
    }

    public function get_category_groups($catid) {
        return $this->db->where("catid", $catid)->get("ticket_category_groups");
    }

    public function delete_category_groups($catid) {
        $this->db->where("catid", $catid)->delete("ticket_category_groups");
    }

    public function get_cat_groups($catid) {
        return $this->db
                        ->select("user_groups.ID, user_groups.name, ticket_category_groups.ID as cid")
                        ->join("ticket_category_groups", "ticket_category_groups.groupid = user_groups.ID AND ticket_category_groups.catid = " . $catid, "left outer")
                        ->get("user_groups");
    }

    public function get_user_groups($groupids, $userid) {
        $this->db->group_start();
        foreach ($groupids as $groupid) {
            $this->db->or_where("groupid", $groupid);
        }
        $this->db->group_end();
        return $this->db->where("userid", $userid)->get("user_group_users");
    }

    public function add_canned_response($data) {
        $this->db->insert("canned_responses", $data);
    }

    public function update_canned_response($id, $data) {
        $this->db->where("ID", $id)->update("canned_responses", $data);
    }

    public function delete_canned_response($id) {
        $this->db->where("ID", $id)->delete("canned_responses");
    }

    public function get_canned_response($id) {
        return $this->db->where("ID", $id)->get("canned_responses");
    }

    public function get_canned_total() {
        $s = $this->db->select("COUNT(*) as num")->get("canned_responses");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_canned_responses($datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "canned_responses.title",
                )
        );

        return $this->db
                        ->limit($datatable->length, $datatable->start)
                        ->get("canned_responses");
    }

    public function get_all_canned_responses() {
        return $this->db->get("canned_responses");
    }

    public function get_reply_files($replyid) {
        return $this->db->where("replyid", $replyid)->get("ticket_files");
    }

    public function get_users_from_groups($categoryid) {
        return $this->db
                        ->select("users.ID, users.username, users.avatar, users.online_timestamp,
				users.email, users.email_notification,
				user_groups.name")
                        ->join("users", "users.ID = user_group_users.userid")
                        ->join("user_groups", "user_groups.ID = user_group_users.groupid")
                        ->join("ticket_category_groups", "ticket_category_groups.groupid = user_groups.ID AND ticket_category_groups.catid = " . $categoryid)
                        ->group_by("users.ID")
                        ->get("user_group_users");
    }

    public function get_tickets_today($date) {
        $s = $this->db->select("COUNT(*) as num")->where("ticket_date", $date)
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_tickets_for_month($month, $year) {
        $string = "-" . $month . "-" . $year;

        $s = $this->db->select("COUNT(*) as num")->like("ticket_date", $string)
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_tickets_for_day($date) {

        $s = $this->db->select("COUNT(*) as num")->where("ticket_date", $date)
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_tickets_for_day_closed($date) {

        $s = $this->db->select("COUNT(*) as num")->where("close_ticket_date", $date)
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_tickets_for_month_closed($month, $year) {
        $string = "-" . $month . "-" . $year;

        $s = $this->db->select("COUNT(*) as num")->like("close_ticket_date", $string)
                ->get("tickets");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function add_history($data) {
        $this->db->insert("ticket_history", $data);
    }

    public function get_ticket_history_limit($ticketid, $limit) {
        return $this->db
                        ->where("ticket_history.ticketid", $ticketid)
                        ->select("ticket_history.ID, ticket_history.message,
				ticket_history.userid, ticket_history.ticketid,
				ticket_history.timestamp,
				users.avatar, users.username, users.online_timestamp")
                        ->join("users", "users.ID = ticket_history.userid", "left outer")
                        ->limit($limit)
                        ->order_by("ticket_history.ID", "DESC")
                        ->get("ticket_history");
    }

    public function get_ticket_history_count($ticketid) {
        $s = $this->db->select("COUNT(*) as num")
                ->where("ticket_history.ticketid", $ticketid)
                ->get("ticket_history");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_ticket_history($ticketid, $datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "users.username",
            "ticket_history.message"
                )
        );

        return $this->db
                        ->where("ticket_history.ticketid", $ticketid)
                        ->select("ticket_history.ID, ticket_history.message,
				ticket_history.userid, ticket_history.ticketid,
				ticket_history.timestamp,
				users.avatar, users.username, users.online_timestamp")
                        ->join("users", "users.ID = ticket_history.userid", "left outer")
                        ->limit($datatable->length, $datatable->start)
                        ->order_by("ticket_history.ID", "DESC")
                        ->get("ticket_history");
    }

    public function get_custom_views($userid) {
        return $this->db->where("userid", $userid)->get("custom_views");
    }

    public function get_custom_view($id, $userid){
        return $this->db->where("ID", $id)->where("userid", $userid)->get("custom_views");
    }

    public function add_custom_view($data) {
        $this->db->insert("custom_views", $data);
    }

    public function delete_custom_view($id) {
        $this->db->where("ID", $id)->delete("custom_views");
    }

    public function update_custom_view($id, $data) {
        $this->db->where("ID", $id)->update("custom_views", $data);
    }

    public function get_custom_views_total($userid) {
        $s = $this->db->where("userid", $userid)
                        ->select("COUNT(*) as num")->get("custom_views");
        $r = $s->row();
        if (isset($r->num))
            return $r->num;
        return 0;
    }

    public function get_custom_views_dt($userid, $datatable) {
        $datatable->db_order();

        $datatable->db_search(array(
            "custom_views.name",
                )
        );

        return $this->db
                        ->where("custom_views.userid", $userid)
                        ->select("custom_views.ID, custom_views.name, custom_views.status,
				custom_views.categoryid, custom_views.order_by, 
				custom_views.order_by_type,
				ticket_categories.name as cat_name,
				custom_statuses.name as status_name")
                        ->join("custom_statuses", "custom_statuses.ID = custom_views.status", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = custom_views.categoryid", "left outer")
                        ->limit($datatable->length, $datatable->start)
                        ->get("custom_views");
    }

    public function get_recent_tickets($limit){
        return $this->db
                        ->limit($limit)
                        ->order_by("ID", "DESC")
                        ->get("tickets");
    }

    public function get_tickets_id($id) {
        return $this->db->where("ID", $id)->get("tickets");
    }

    public function update_all_ticket_replies($ticketid, $data) {
        $this->db->where("ticketid", $ticketid)->update("ticket_replies", $data);
    }

    public function update_all_ticket_history($ticketid, $data) {
        $this->db->where("ticketid", $ticketid)->update("ticket_history", $data);
    }

    public function update_all_ticket_files($ticketid, $data) {
        $this->db->where("ticketid", $ticketid)->update("ticket_files", $data);
    }

    public function update_all_ticket_cf($ticketid, $data) {
        $this->db->where("ticketid", $ticketid)
                ->update("ticket_user_custom_fields", $data);
    }

    public function get_custom_statuses() {
        return $this->db->get("custom_statuses");
    }

    public function get_custom_status($id) {
        return $this->db->where("ID", $id)->get("custom_statuses");
    }

    public function delete_custom_status($id) {
        $this->db->where("ID", $id)->delete("custom_statuses");
    }

    public function update_custom_status($id, $data) {
        $this->db->where("ID", $id)->update("custom_statuses", $data);
    }

    public function add_custom_status($data) {
        $this->db->insert("custom_statuses", $data);
    }

    public function get_tickets_not_closed() {
        return $this->db
                        ->where("custom_statuses.close", 0)
                        ->select("tickets.ID, tickets.title, tickets.userid, tickets.assignedid,
				tickets.timestamp, tickets.categoryid, tickets.status,
				tickets.priority, tickets.last_reply_timestamp,
				tickets.last_reply_userid, tickets.message_id_hash, 
				tickets.guest_email,
				users.username as client_username, users.avatar as client_avatar,
				users.online_timestamp as client_online_timestamp, users.email as client_email,
				users.first_name, users.last_name,
				u2.username, u2.avatar, u2.online_timestamp,
				u3.username as lr_username, u3.avatar as lr_avatar, 
				u3.online_timestamp as lr_online_timestamp,
				ticket_categories.name as cat_name,
				custom_statuses.name as status_name, custom_statuses.color as status_color,
				custom_statuses.text_color as status_text_color")
                        ->join("custom_statuses", "custom_statuses.ID = tickets.status", "left outer")
                        ->join("users", "users.ID = tickets.userid", "left outer")
                        ->join("users as u2", "u2.ID = tickets.assignedid", "left outer")
                        ->join("users as u3", "u3.ID = tickets.last_reply_userid", "left outer")
                        ->join("ticket_categories", "ticket_categories.ID = tickets.categoryid")
                        ->get("tickets");
    }

    public function get_close_custom_status() {
        return $this->db->where("close", 1)->get("custom_statuses");
    }
    public function get_users(){
        return $this->db->get('users');
    }

    public function addTicketCC($data){
        $this->db->insert('ticket_cc', $data);
        return $this->db->affected_rows();
    }

    public function getTicketCCById($ticketID){
        return $this->db
             ->select('user_id')
             ->where('ticket_id', $ticketID)
             ->get('ticket_cc')
             ->result();
    }

    public function getTicketCCGroupById($ticketID){
        return $this->db
             ->select('group_id')
             ->where('ticket_id', $ticketID)
             ->where('group_id !=', 0)
             ->group_by('group_id')
             ->get('ticket_cc')
             ->result();
    }

    public function checkExsitingTicket($userID, $ticketID){
        return $this->db
             ->select('user_id')
             ->where('ticket_id', $ticketID)
             ->where('user_id', $userID)
             ->get('ticket_cc')
             ->row();
    }

    public function deleteTicketCC($ticketID){
        $this->db
             ->where('ticket_id', $ticketID)
             ->delete('ticket_cc');
        return $this->db->affected_rows();
    }

    public function getTicketByID($ticketID){
        return $this->db
             ->where('ID', $ticketID)
             ->get('tickets')
             ->row();
    }

    public function getUsersByTicketCategoryID($categoryID){
        return $this->db
        ->select('tc.ID as catid, 
          tc.`name` as catname, 
          ug.ID as groupid,
          ug.`name` as group_name,
          u.ID as userid,
          u.first_name,
          u.last_name,
          u.email')
        ->where('tc.ID', $categoryID)
        ->join('ticket_category_groups tcg','tc.ID=tcg.catid', 'inner')
        ->join('user_groups ug', 'ug.ID = tcg.groupid', 'inner')
        ->join('user_group_users ugu','ugu.groupid=tcg.groupid', 'inner')
        ->join('users u','u.ID=ugu.userid', 'inner')
        ->get('ticket_categories tc')
        ->result();
    }

}

?>