<ul class="newnav nav nav-sidebar">
    <?php
    if ($this->user->loggedin && isset($this->user->info->user_role_id) &&
            ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment || $this->user->info->admin_announcements)
    ) :
        ?>
        <li id="admin_sb">
            <a data-toggle="collapse" data-parent="#admin_sb" href="#admin_sb_c" class="collapsed <?php if (isset($activeLink['admin'])) echo "active" ?>" >
                <span class="glyphicon glyphicon-wrench sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_157") ?>
                <span class="plus-sidebar"><span class="glyphicon <?php if (isset($activeLink['admin'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="admin_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['admin'])) echo "in" ?>">
                <ul class="inner-sidebar-links">
                    <li class="<?php if (isset($activeLink['admin']['general'])) echo "active" ?>"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_523") ?></a></li>
                    <?php if ($this->user->info->admin || $this->user->info->admin_settings) : ?>
                        <li class="<?php if (isset($activeLink['admin']['settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/settings") ?>"> <?php echo lang("ctn_158") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['social_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/social_settings") ?>"> <?php echo lang("ctn_159") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['ticket_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/ticket_settings") ?>"> <?php echo lang("ctn_524") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['section'])) echo "active" ?>"><a href="<?php echo site_url("admin/section_settings") ?>"> <?php echo lang("ctn_747") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin || $this->user->info->admin_members) : ?>
                        <li class="<?php if (isset($activeLink['admin']['members'])) echo "active" ?>"><a href="<?php echo site_url("admin/members") ?>"> <?php echo lang("ctn_160") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['custom_fields'])) echo "active" ?>"><a href="<?php echo site_url("admin/custom_fields") ?>"> <?php echo lang("ctn_346") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin) : ?>
                        <li class="<?php if (isset($activeLink['admin']['user_roles'])) echo "active" ?>"><a href="<?php echo site_url("admin/user_roles") ?>"> <?php echo lang("ctn_316") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin || $this->user->info->admin_announcements) : ?>
                        <li class="<?php if (isset($activeLink['admin']['announcements'])) echo "active" ?>"><a href="<?php echo site_url("admin/announcements") ?>"> <?php echo lang("ctn_525") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin || $this->user->info->admin_members) : ?>
                        <li class="<?php if (isset($activeLink['admin']['user_groups'])) echo "active" ?>"><a href="<?php echo site_url("admin/user_groups") ?>"> <?php echo lang("ctn_161") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['ipblock'])) echo "active" ?>"><a href="<?php echo site_url("admin/ipblock") ?>"> <?php echo lang("ctn_162") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin) : ?>
                        <li class="<?php if (isset($activeLink['admin']['email_templates'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_templates") ?>"> <?php echo lang("ctn_163") ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->user->info->admin || $this->user->info->admin_members) : ?>
                        <li class="<?php if (isset($activeLink['admin']['email_members'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_members") ?>"> <?php echo lang("ctn_164") ?></a></li>
                    <?php endif; ?>
                        
                    <!--Hide payment menu-->
                    <?php // if ($this->user->info->admin || $this->user->info->admin_payment) : ?>
                    <!-- <li class="<?php if (isset($activeLink['admin']['payment_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/payment_settings") ?>"> <?php echo lang("ctn_246") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['payment_plans'])) echo "active" ?>"><a href="<?php echo site_url("admin/payment_plans") ?>"> <?php echo lang("ctn_258") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['payment_logs'])) echo "active" ?>"><a href="<?php echo site_url("admin/payment_logs") ?>"> <?php echo lang("ctn_288") ?></a></li>
                        <li class="<?php if (isset($activeLink['admin']['premium_users'])) echo "active" ?>"><a href="<?php echo site_url("admin/premium_users") ?>"> <?php echo lang("ctn_325") ?></a></li>-->
                    <?php // endif; ?>
                    <!--end hide payment menu-->
                    
                    <?php if ($this->user->info->admin) : ?>
                        <li class="<?php if (isset($activeLink['admin']['tools'])) echo "active" ?>"><a href="<?php echo site_url("admin/tools") ?>"> <?php echo lang("ctn_686") ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($this->common->has_permissions(array("admin", "ticket_manager", "ticket_worker", "knowledge_manager"), $this->user)) : ?>
        <li class="<?php if (isset($activeLink['home']['general'])) echo "active" ?>"><a href="<?php echo site_url("home") ?>"><span class="glyphicon glyphicon-home sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_526") ?> <span class="sr-only">(current)</span></a></li>
    <?php endif; ?>
    <?php if ($this->common->has_permissions(array("admin", "ticket_manager", "ticket_worker"), $this->user)) : ?>
        <li id="ticket_sb">
            <a data-toggle="collapse" data-parent="#ticket_sb" href="#ticket_sb_c" class="collapsed <?php if (isset($activeLink['ticket'])) echo "active" ?>" >
                <span class="glyphicon glyphicon-send sidebar-icon sidebar-icon-green"></span> <?php echo lang("ctn_527") ?>
                <span class="plus-sidebar"><span class="glyphicon <?php if (isset($activeLink['ticket'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="ticket_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['ticket'])) echo "in" ?>">
                <ul class="inner-sidebar-links">
                    <?php if ($this->common->has_permissions(array("admin", "ticket_manager"), $this->user)) : ?>
                        <li class="<?php if (isset($activeLink['ticket']['general'])) echo "active" ?>"><a href="<?php echo site_url("tickets") ?>"> <?php echo lang("ctn_528") ?></a></li>
                    <?php endif; ?>
                    <li class="<?php if (isset($activeLink['ticket']['your'])) echo "active" ?>"><a href="<?php echo site_url("tickets/your") ?>"> <?php echo lang("ctn_529") ?></a></li>
                    <li class="<?php if (isset($activeLink['ticket']['ass'])) echo "active" ?>"><a href="<?php echo site_url("tickets/assigned") ?>"> <?php echo lang("ctn_530") ?></a></li>
                    <li class="<?php if (isset($activeLink['ticket']['archived'])) echo "active" ?>"><a href="<?php echo site_url("tickets/archived") ?>"> <?php echo lang("ctn_790") ?></a></li>
                    <?php if ($this->common->has_permissions(array("admin", "ticket_manager"), $this->user)) : ?>
                        <li class="<?php if (isset($activeLink['ticket']['cats'])) echo "active" ?>"><a href="<?php echo site_url("tickets/categories") ?>"> <?php echo lang("ctn_531") ?></a></li>
                        <li class="<?php if (isset($activeLink['ticket']['custom'])) echo "active" ?>"><a href="<?php echo site_url("tickets/custom_fields") ?>"> <?php echo lang("ctn_532") ?></a></li>
                        <li class="<?php if (isset($activeLink['ticket']['canned'])) echo "active" ?>"><a href="<?php echo site_url("tickets/canned_responses") ?>"> <?php echo lang("ctn_533") ?></a></li>
                        <li class="<?php if (isset($activeLink['ticket']['custom_statuses'])) echo "active" ?>"><a href="<?php echo site_url("tickets/custom_statuses") ?>"> <?php echo lang("ctn_791") ?></a></li>
                    <?php endif; ?>
                    <li class="<?php if (isset($activeLink['ticket']['custom_view'])) echo "active" ?>"><a href="<?php echo site_url("tickets/custom_views") ?>"> <?php echo lang("ctn_627") ?></a></li>

                </ul>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($this->settings->info->enable_knowledge && $this->common->has_permissions(array("admin", "knowledge_manager"), $this->user)) : ?>
        <li id="knowledge_sb">
            <a data-toggle="collapse" data-parent="#knowledge_sb" href="#knowledge_sb_c" class="collapsed <?php if (isset($activeLink['knowledge'])) echo "active" ?>" >
                <span class="glyphicon glyphicon-book sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_534") ?>
                <span class="plus-sidebar"><span class="glyphicon <?php if (isset($activeLink['knowledge'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="knowledge_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['knowledge'])) echo "in" ?>">
                <ul class="inner-sidebar-links">
                    <li class="<?php if (isset($activeLink['knowledge']['general'])) echo "active" ?>"><a href="<?php echo site_url("knowledge") ?>"> <?php echo lang("ctn_535") ?></a></li>
                    <li class="<?php if (isset($activeLink['knowledge']['cats'])) echo "active" ?>"><a href="<?php echo site_url("knowledge/categories") ?>"> <?php echo lang("ctn_536") ?></a></li>
                </ul>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($this->settings->info->enable_faq && $this->common->has_permissions(array("admin", "faq_manager"), $this->user)) : ?>
        <li id="faq_sb">
            <a data-toggle="collapse" data-parent="#faq_sb" href="#faq_sb_c" class="collapsed <?php if (isset($activeLink['faq'])) echo "active" ?>" >
                <span class="glyphicon glyphicon-info-sign sidebar-icon sidebar-icon-orange"></span> <?php echo lang("ctn_776") ?>
                <span class="plus-sidebar"><span class="glyphicon <?php if (isset($activeLink['faq'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="faq_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['faq'])) echo "in" ?>">
                <ul class="inner-sidebar-links">
                    <li class="<?php if (isset($activeLink['faq']['general'])) echo "active" ?>"><a href="<?php echo site_url("FAQ") ?>"> <?php echo lang("ctn_776") ?></a></li>
                    <li class="<?php if (isset($activeLink['faq']['cats'])) echo "active" ?>"><a href="<?php echo site_url("FAQ/categories") ?>"> <?php echo lang("ctn_536") ?></a></li>
                </ul>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($this->settings->info->enable_documentation && $this->common->has_permissions(array("admin", "documentation_manager"), $this->user)) : ?>
        <li id="report_sb">
            <a data-toggle="collapse" data-parent="#documentation_sb" href="#documentation_sb_c" class="collapsed <?php if (isset($activeLink['documentation'])) echo "active" ?>" >
                <span class="glyphicon glyphicon-file sidebar-icon sidebar-icon-blue"></span> <?php echo lang("ctn_810") ?>
                <span class="plus-sidebar"><span class="glyphicon <?php if (isset($activeLink['documentation'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="documentation_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['documentation'])) echo "in" ?>">
                <ul class="inner-sidebar-links">
                    <li class="<?php if (isset($activeLink['documentation']['general'])) echo "active" ?>"><a href="<?php echo site_url("documentation") ?>"><?php echo lang("ctn_810") ?></a></li>
                    <li class="<?php if (isset($activeLink['documentation']['order'])) echo "active" ?>"><a href="<?php echo site_url("documentation/order") ?>"><?php echo lang("ctn_838") ?></a></li>
                    <li class="<?php if (isset($activeLink['documentation']['projects'])) echo "active" ?>"><a href="<?php echo site_url("documentation/projects") ?>"><?php echo lang("ctn_839") ?></a></li>
                </ul>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($this->common->has_permissions(array("admin", "ticket_manager"), $this->user)) : ?>
        <li id="report_sb">
            <a data-toggle="collapse" data-parent="#report_sb" href="#report_sb_c" class="collapsed <?php if (isset($activeLink['report'])) echo "active" ?>" >
                <span class="glyphicon glyphicon-list-alt sidebar-icon sidebar-icon-red"></span> <?php echo lang("ctn_537") ?>
                <span class="plus-sidebar"><span class="glyphicon <?php if (isset($activeLink['report'])) : ?>glyphicon-menu-down<?php else : ?>glyphicon-menu-right<?php endif; ?>"></span></span>
            </a>
            <div id="report_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if (isset($activeLink['report'])) echo "in" ?>">
                <ul class="inner-sidebar-links">
                    <li class="<?php if (isset($activeLink['report']['general'])) echo "active" ?>"><a href="<?php echo site_url("reports") ?>"> <?php echo lang("ctn_538") ?></a></li>
                    <li class="<?php if (isset($activeLink['report']['ratings'])) echo "active" ?>"><a href="<?php echo site_url("reports/ratings") ?>"> <?php echo lang("ctn_539") ?></a></li>
                    <li class="<?php if (isset($activeLink['report']['users'])) echo "active" ?>"><a href="<?php echo site_url("reports/users") ?>"> <?php echo lang("ctn_540") ?></a></li>
                </ul>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($this->common->has_permissions(array("admin", "ticket_manager", "ticket_worker", "knowledge_manager"), $this->user)) : ?>
        <li class="<?php if (isset($activeLink['members']['general'])) echo "active" ?>"><a href="<?php echo site_url("members") ?>"><span class="glyphicon glyphicon-user sidebar-icon sidebar-icon-brown"></span> <?php echo lang("ctn_155") ?></a></li>
    <?php endif; ?>


    <!-- list menu as orderable -->
    <?php if(!empty(getAllMenuOrderable())): ?>
        <?php $menuItem = json_decode(getAllMenuOrderable());?>

        <?php foreach ($menuItem as $parent): ?>
            <?php 
                $uri = $this->uri->segment(1); 
                $uri2 = $this->uri->segment(1).'/'.$this->uri->segment(2); 
                if(isset($parent->id) && !empty($parent->id)){
                    $menuName = strtolower(str_replace(' ', '', getMenuNameEN($parent->id)));
                }else{
                    $menuName = 'NULL';
                }

                $active = '';
                $in = '';
                $glyphicon_menu_down = 'glyphicon-menu-right';

                if(isset($parent->children) && !empty($parent->children)){
                    foreach ($parent->children as $value)
                    {   
                        if((isset($value->id)) && ($value->id == getMenuIdbyUrl($uri) || $value->id == getMenuIdbyUrl($uri2))){
                            $active = 'active';
                            $in = 'in';
                            $glyphicon_menu_down = 'glyphicon-menu-down';
                            break;
                        }
                        // sub1
                        if(isset($value->children) && !empty($value->children)){
                            foreach ($value->children as $sub1) {
                                if((isset($sub1->id)) && ($sub1->id == getMenuIdbyUrl($uri) || $sub1->id == getMenuIdbyUrl($uri2))){
                                    $active = 'active';
                                    $in = 'in';
                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                    break;
                                }
                                // sub2
                                if(isset($sub1->children) && !empty($sub1->children)){
                                    foreach ($sub1->children as $sub2) {
                                        if((isset($sub2->id)) && ($sub2->id == getMenuIdbyUrl($uri) || $sub2->id == getMenuIdbyUrl($uri2))){
                                            $active = 'active';
                                            $in = 'in';
                                            $glyphicon_menu_down = 'glyphicon-menu-down';
                                            break;
                                        }
                                        // sub3
                                        if(isset($sub2->children) && !empty($sub2->children)){
                                            foreach ($sub2->children as $sub3) {
                                                if((isset($sub3->id)) && ($sub3->id == getMenuIdbyUrl($uri) || $sub3->id == getMenuIdbyUrl($uri2))){
                                                    $active = 'active';
                                                    $in = 'in';
                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                    break;
                                                }
                                                // sub4
                                                if(isset($sub3->children) && !empty($sub3->children)){
                                                    foreach ($sub3->children as $sub4) {
                                                        if((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2))){
                                                            $active = 'active';
                                                            $in = 'in';
                                                            $glyphicon_menu_down = 'glyphicon-menu-down';
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }elseif ((isset($parent->id)) && ($parent->id == getMenuIdbyUrl($uri) || $parent->id == getMenuIdbyUrl($uri2))) {
                    $active = 'active';
                    $in = 'in';
                    $glyphicon_menu_down = 'glyphicon-menu-down';
                }
            ?>
            <!-- start parent -->
            <?php if(isset($parent->id) && !empty($parent->id)): ?>
            <li id="<?php echo $menuName; ?>">
            <?php endif; ?>

                <!-- show parent -->
                <?php if(!isset($parent->children) || empty($parent->children)): ?>
                    <?php if(isset($parent->id) && !empty($parent->id)): ?>
                        <li class="<?php echo $active;?>">
                            <a href="<?php echo site_url().strtolower(getMenuURL($parent->id)); ?>"><span class="glyphicon <?php echo getMenuIcon($parent->id); ?> sidebar-icon-<?php echo getMenuIconColor($parent->id); ?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getMenuNameEN($parent->id); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- end parent -->

                <!-- show parent child -->
                <?php if(isset($parent->children) || !empty($parent->children)): ?>
                    <?php if(isset($parent->id) && !empty($parent->id)): ?>
                        <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>">
                            <span class="glyphicon <?php echo getMenuIcon($parent->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($parent->id); ?>"></span> <?php echo getMenuNameEN($parent->id); ?>
                            <span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                        </a>
                        <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                            <ul class="inner-sidebar-links">
                    <?php endif; ?>

                                    <!-- sub1 -->
                                    <?php foreach ($parent->children as $sub1): ?>
                                            <?php 
                                                $uri = $this->uri->segment(1);
                                                if(isset($sub1->id) && !empty($sub1->id)){
                                                    $menuName = strtolower(str_replace(' ', '', getMenuNameEN($sub1->id)));
                                                }else{
                                                    $menuName = 'NULL';
                                                }

                                                $active = '';
                                                $in = '';
                                                $glyphicon_menu_down = 'glyphicon-menu-right';

                                                if(isset($sub1->children) && !empty($parent->children)){
                                                    foreach ($sub1->children as $value)
                                                    {
                                                        if((isset($value->id)) && ($value->id == getMenuIdbyUrl($uri) || $value->id == getMenuIdbyUrl($uri2))){
                                                            $active = 'active';
                                                            $in = 'in';
                                                            $glyphicon_menu_down = 'glyphicon-menu-down';
                                                            break;
                                                        }
                                                        // sub2
                                                        if(isset($value->children) && !empty($value->children)){
                                                            foreach ($value->children as $sub2) {
                                                                if((isset($sub2->id)) && ($sub2->id == getMenuIdbyUrl($uri) || $sub2->id == getMenuIdbyUrl($uri2))){
                                                                    $active = 'active';
                                                                    $in = 'in';
                                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                    break;
                                                                }
                                                                // // sub3
                                                                // if(isset($sub2->children) && !empty($sub2->children)){
                                                                //     foreach ($sub2->children as $sub3) {
                                                                //         if((isset($sub3->id)) && ($sub3->id == getMenuIdbyUrl($uri) || $sub3->id == getMenuIdbyUrl($uri2))){
                                                                //             $active = 'active';
                                                                //             $in = 'in';
                                                                //             $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                //             break;
                                                                //         }
                                                                //         // sub4
                                                                //         if(isset($sub3->children) && !empty($sub3->children)){
                                                                //             foreach ($sub3->children as $sub4) {
                                                                //                 if((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2))){
                                                                //                     $active = 'active';
                                                                //                     $in = 'in';
                                                                //                     $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                //                     break;
                                                                //                 }
                                                                //             }
                                                                //         }
                                                                //     }
                                                                // }
                                                            }
                                                        }
                                                    }
                                                }elseif ((isset($sub1->id)) && ($sub1->id == getMenuIdbyUrl($uri) || $sub1->id == getMenuIdbyUrl($uri2))) {
                                                    $active = 'active';
                                                    $in = 'in';
                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                }
                                            ?>
                                            <!-- start parent -->
                                            <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                            <li id="<?php echo $menuName; ?>">
                                            <?php endif; ?>
                                                <!-- show parent -->
                                                <?php if(!isset($sub1->children) || empty($sub1->children)): ?>
                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                    <li class="<?php echo $active;?>">
                                                        <a href="<?php echo site_url().strtolower(getMenuURL($sub1->id)); ?>"> <span class="glyphicon <?php echo getMenuIcon($sub1->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub1->id); ?>"></span> <?php echo getMenuNameEN($sub1->id); ?></a>
                                                    </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <!-- end parent -->

                                                <!-- show parent child -->
                                                <?php if(isset($sub1->children) || !empty($sub1->children)): ?>
                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                    <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>"><span class="glyphicon <?php echo getMenuIcon($sub1->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub1->id); ?>"></span> <?php echo getMenuNameEN($sub1->id); ?>
                                                        <span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                                                    </a>
                                                    <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                                                        <ul class="inner-sidebar-links">
                                                    <?php endif; ?>

                                                                    <!-- sub2 -->
                                                                    <?php foreach ($sub1->children as $sub2): ?>
                                                                            <?php 
                                                                                $uri = $this->uri->segment(1); 
                                                                                if(isset($sub2->id) && !empty($sub2->id)){
                                                                                    $menuName = strtolower(str_replace(' ', '', getMenuNameEN($sub2->id)));
                                                                                }else{
                                                                                    $menuName = 'NULL';
                                                                                }

                                                                                $active = '';
                                                                                $in = '';
                                                                                $glyphicon_menu_down = 'glyphicon-menu-right';

                                                                                if(isset($sub2->children) && !empty($sub2->children)){
                                                                                    foreach ($parent->children as $value)
                                                                                    {
                                                                                        if((isset($value->id)) && ($value->id == getMenuIdbyUrl($uri) || $value->id == getMenuIdbyUrl($uri2))){
                                                                                            $active = 'active';
                                                                                            $in = 'in';
                                                                                            $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                            break;
                                                                                        }
                                                                                        // // sub3
                                                                                        // if(isset($value->children) && !empty($value->children)){
                                                                                        //     foreach ($value->children as $sub3) {
                                                                                        //         if((isset($sub3->id)) && ($sub3->id == getMenuIdbyUrl($uri) || $sub3->id == getMenuIdbyUrl($uri2))){
                                                                                        //             $active = 'active';
                                                                                        //             $in = 'in';
                                                                                        //             $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                        //             break;
                                                                                        //         }
                                                                                        //         // sub4
                                                                                        //         if(isset($sub3->children) && !empty($sub3->children)){
                                                                                        //             foreach ($sub3->children as $sub4) {
                                                                                        //                 if((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2))){
                                                                                        //                     $active = 'active';
                                                                                        //                     $in = 'in';
                                                                                        //                     $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                        //                     break;
                                                                                        //                 }
                                                                                        //             }
                                                                                        //         }
                                                                                        //     }
                                                                                        // }
                                                                                    }
                                                                                }elseif ((isset($sub2->id)) && ($sub2->id == getMenuIdbyUrl($uri) || $sub2->id == getMenuIdbyUrl($uri2))) {
                                                                                    $active = 'active';
                                                                                    $in = 'in';
                                                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                }
                                                                            ?>
                                                                            <!-- start parent -->
                                                                            <?php if(isset($sub2->id) && !empty($sub2->id)): ?>
                                                                            <li id="<?php echo $menuName; ?>">
                                                                            <?php endif; ?>
                                                                                <!-- show parent -->
                                                                                <?php if(!isset($sub2->children) || empty($sub2->children)): ?>
                                                                                    <?php if(isset($sub2->id) && !empty($sub2->id)): ?>
                                                                                    <li class="<?php echo $active;?>"> <a href="<?php echo site_url().strtolower(getMenuURL($sub2->id)); ?>"> <span class="glyphicon <?php echo getMenuIcon($sub2->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub2->id); ?>"></span><?php echo getMenuNameEN($sub2->id); ?></a>
                                                                                    </li>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                                <!-- end parent -->

                                                                                <!-- show parent child -->
                                                                                <?php if(isset($sub2->children) || !empty($sub2->children)): ?>
                                                                                    <?php if(isset($sub2->id) && !empty($sub2->id)): ?>
                                                                                    <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>"><span class="glyphicon <?php echo getMenuIcon($sub2->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub2->id); ?>"></span> <?php echo getMenuNameEN($sub2->id); ?><span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                                                                                    </a>
                                                                                    <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                                                                                        <ul class="inner-sidebar-links">
                                                                                    <?php endif; ?>

                                                                                                <!-- sub3 -->
                                                                                                <?php foreach ($sub2->children as $sub3): ?>
                                                                                                        <?php 
                                                                                                            $uri = $this->uri->segment(1);
                                                                                                            if(isset($sub3->id) && !empty($sub3->id)){
                                                                                                                $menuName = strtolower(str_replace(' ', '', getMenuNameEN($sub3->id)));
                                                                                                            }else{
                                                                                                                $menuName = 'NULL';
                                                                                                            }

                                                                                                            $active = '';
                                                                                                            $in = '';
                                                                                                            $glyphicon_menu_down = 'glyphicon-menu-right';

                                                                                                            if(isset($sub3->children) && !empty($sub3->children)){
                                                                                                                foreach ($parent->children as $value)
                                                                                                                {
                                                                                                                    if((isset($value->id)) && ($value->id == getMenuIdbyUrl($uri) || $value->id == getMenuIdbyUrl($uri2))){
                                                                                                                        $active = 'active';
                                                                                                                        $in = 'in';
                                                                                                                        $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                                        break;
                                                                                                                    }
                                                                                                                }
                                                                                                            }elseif ((isset($sub3->id)) && ($sub3->id == getMenuIdbyUrl($uri) || $sub3->id == getMenuIdbyUrl($uri2))) {
                                                                                                                $active = 'active';
                                                                                                                $in = 'in';
                                                                                                                $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                            }
                                                                                                        ?>
                                                                                                        <!-- start parent -->
                                                                                                        <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                        <li id="<?php echo $menuName; ?>">
                                                                                                        <?php endif; ?>
                                                                                                            <!-- show parent -->
                                                                                                            <?php if(!isset($sub3->children) || empty($sub3->children)): ?>
                                                                                                                <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                                <li class="<?php echo $active;?>">
                                                                                                                    <a href="<?php echo site_url().strtolower(getMenuURL($sub3->id)); ?>"><span class="glyphicon <?php echo getMenuIcon($sub3->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub3->id); ?>"></span>  <?php echo getMenuNameEN($sub3->id); ?></a>
                                                                                                                </li>
                                                                                                                <?php endif; ?>
                                                                                                            <?php endif; ?>
                                                                                                            <!-- end parent -->

                                                                                                            <!-- show parent child -->
                                                                                                            <?php if(isset($sub3->children) || !empty($sub3->children)): ?>
                                                                                                                <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                                <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>"><span class="glyphicon <?php echo getMenuIcon($sub3->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub3->id); ?>"></span> <?php echo getMenuNameEN($sub3->id); ?>
                                                                                                                    <span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                                                                                                                </a>
                                                                                                                <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                                                                                                                    <ul class="inner-sidebar-links">
                                                                                                                <?php endif; ?>

                                                                                                                                <!-- sub4 -->
                                                                                                                                <?php foreach ($sub3->children as $sub4): ?>
                                                                                                                                        <?php 
                                                                                                                                            $uri = $this->uri->segment(1);
                                                                                                                                            if(isset($sub4->id) && !empty($sub4->id)){
                                                                                                                                                    $menuName = strtolower(str_replace(' ', '', getMenuNameEN($sub4->id)));
                                                                                                                                                }else{
                                                                                                                                                    $menuName = 'NULL';
                                                                                                                                                }

                                                                                                                                            $active = '';
                                                                                                                                            $in = '';
                                                                                                                                            $glyphicon_menu_down = 'glyphicon-menu-right';

                                                                                                                                            if(isset($sub4->children) && !empty($sub4->children)){
                                                                                                                                                foreach ($parent->children as $value)
                                                                                                                                                {
                                                                                                                                                    if((isset($value->id)) && ($value->id == getMenuIdbyUrl($uri) || $value->id == getMenuIdbyUrl($uri2))){
                                                                                                                                                        $active = 'active';
                                                                                                                                                        $in = 'in';
                                                                                                                                                        $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                                                                        break;
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            }elseif ((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2))) {
                                                                                                                                                $active = 'active';
                                                                                                                                                $in = 'in';
                                                                                                                                                $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                                                            }
                                                                                                                                        ?>
                                                                                                                                        <!-- start parent -->
                                                                                                                                        <li id="<?php echo $menuName; ?>">
                                                                                                                                            <!-- show parent -->
                                                                                                                                            <?php if(!isset($sub4->children) || empty($sub4->children)): ?>
                                                                                                                                                <?php if(isset($sub4->id) && !empty($sub4->id)): ?>
                                                                                                                                                <li class="<?php echo $active;?>">
                                                                                                                                                    <a href="<?php echo site_url().strtolower(getMenuURL($sub4->id)); ?>"><span class="glyphicon <?php echo getMenuIcon($sub4->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub4->id); ?>"></span>  <?php echo getMenuNameEN($sub4->id); ?></a>
                                                                                                                                                </li>
                                                                                                                                                <?php endif; ?>
                                                                                                                                            <?php endif; ?>
                                                                                                                                            <!-- end parent -->
                                                                                                                                        </li>
                                                                                                                                        <!-- end parent -->
                                                                                                                                <?php endforeach; ?>
                                                                                                                                <!-- sub4 -->

                                                                                                                <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                                <?php endif; ?>
                                                                                                            <?php endif; ?>
                                                                                                            <!-- end show parent child -->
                                                                                                        </li>
                                                                                                        <!-- end parent -->
                                                                                                <?php endforeach; ?>
                                                                                                <!-- sub3 -->

                                                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                                <!-- end show parent child -->
                                                                            <?php if(isset($sub2->id) && !empty($sub2->id)): ?>
                                                                            </li>
                                                                            <?php endif; ?>
                                                                            <!-- end parent -->
                                                                    <?php endforeach; ?>
                                                                    <!-- sub2 -->

                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                        </ul>
                                                    </div>
                                                     <?php endif; ?>
                                                <?php endif; ?>
                                                <!-- end show parent child -->
                                            <?php if(isset($sub1->id) && !empty($sub1->id)):?>
                                            </li>
                                            <?php endif; ?>
                                            <!-- end parent -->
                                    <?php endforeach; ?>
                                    <!-- sub1 -->


                    <?php if(isset($parent->id) && !empty($parent->id)): ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>
                <!-- end show parent child -->

            <?php if(isset($parent->id) && !empty($parent->id)): ?>
            </li>
            <?php endif; ?>

            <!-- end parent -->
        <?php endforeach; ?>
    <?php endif;?>
    <!-- end list menu as orderable -->

</ul>

<script>
    // function clickMenu(parentId, remClass){
    //     if(remClass == 'glyphicon-menu-down'){
    //         var adClass = 'glyphicon-menu-right';
    //     }
    //     if(remClass == 'glyphicon-menu-right'){
    //         var adClass = 'glyphicon-menu-down';
    //     }
    //     $("#"+parentId+'_span').removeClass(remClass).addClass(adClass);
    // }
</script>
