<ul class="newnav nav nav-sidebar">

    <!-- list menu as orderable -->
    <?php if(!empty(getAllMenuOrderable())): ?>
        <?php $menuItem = json_decode(getAllMenuOrderable());?>
        <?php foreach ($menuItem as $a => $parent): ?>
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
                $hasModule = false;

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

                if((isset($parent->id)) && ($parent->id == getMenuIdbyUrl($uri))){
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
                        <?php if($this->authorization->hasModule(getModuleId($parent->id))){ ?>
                        <li class="<?php echo $active;?>">
                            <a href="<?php echo site_url().strtolower(getMenuURL($parent->id)); ?>"><span class="glyphicon <?php echo getMenuIcon($parent->id); ?> sidebar-icon-<?php echo getMenuIconColor($parent->id); ?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getMenuNameEN($parent->id); ?></a>
                        </li>
                        <?php } ?>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- end parent -->

                <!-- show parent child -->
                <?php if(isset($parent->children) || !empty($parent->children)): ?>
                    <?php if(isset($parent->id) && !empty($parent->id)): ?>
                        <?php if($this->authorization->hasModule(getModuleId($parent->id))){ ?>

                            <!-- check each children of parent hasModule access or not -->
                            <!-- if hasModule access will show include children menu else show only parent menu -->
                            <?php 
                                foreach ($parent->children as $value){   
                                    if((isset($value->id)) && ($this->authorization->hasModule(getModuleId($value->id)) == true)){
                                        $hasModule = true;
                                        break;
                                    }
                                    // sub1
                                    if(isset($value->children) && !empty($value->children)){
                                        foreach ($value->children as $sub1) {
                                            if((isset($sub1->id)) && ($this->authorization->hasModule(getModuleId($sub1->id)) == true)){
                                                $hasModule = true;
                                                break;
                                            }
                                            // sub2
                                            if(isset($sub1->children) && !empty($sub1->children)){
                                                foreach ($sub1->children as $sub2) {
                                                    if((isset($sub2->id)) && ($this->authorization->hasModule(getModuleId($sub2->id)) == true)){
                                                        $hasModule = true;
                                                        break;
                                                    }
                                                    // sub3
                                                    if(isset($sub2->children) && !empty($sub2->children)){
                                                        foreach ($sub2->children as $sub3) {
                                                            if((isset($sub3->id)) && ($this->authorization->hasModule(getModuleId($sub3->id)) == true)){
                                                                $hasModule = true;
                                                                break;
                                                            }
                                                            // sub4
                                                            if(isset($sub3->children) && !empty($sub3->children)){
                                                                foreach ($sub3->children as $sub4) {
                                                                    if((isset($sub4->id)) && ($this->authorization->hasModule(getModuleId($sub4->id)) == true)){
                                                                        $hasModule = true;
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
                            ?>

                            <?php if($hasModule == true){ ?>
                                <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>">
                                    <span class="glyphicon <?php echo getMenuIcon($parent->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($parent->id); ?>"></span> <?php echo getMenuNameEN($parent->id); ?>
                                    <span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                                </a>
                                <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                                    <ul class="inner-sidebar-links">
                            <?php }else{ ?>
                                <li class="<?php echo $active;?>">
                                    <a href="<?php echo site_url().strtolower(getMenuURL($parent->id)); ?>"><span class="glyphicon <?php echo getMenuIcon($parent->id); ?> sidebar-icon-<?php echo getMenuIconColor($parent->id); ?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getMenuNameEN($parent->id); ?></a>
                                </li>
                            <?php } ?>

                        <?php } ?>
                    <?php endif; ?>

                                    <!-- sub1 -->
                                    <?php foreach ($parent->children as $b => $sub1): ?>
                                            <?php 
                                                $uri = $this->uri->segment(1);
                                                if(isset($sub1->id) && !empty($sub1->id)){
                                                    $menuName = strtolower(str_replace(' ', '', getMenuNameEN($sub1->id)));
                                                }else{
                                                    $menuName = 'NULL';
                                                }

                                                $active = '';
                                                $sub1HasModule = false;
                                                $in = '';
                                                $glyphicon_menu_down = 'glyphicon-menu-right';

                                                if(isset($sub1->children) && !empty($parent->children)){
                                                    foreach ($sub1->children as $sub2)
                                                    {
                                                        if((isset($sub2->id)) && ($sub2->id == getMenuIdbyUrl($uri) || $sub2->id == getMenuIdbyUrl($uri2))){
                                                            // $active = 'active';
                                                            $in = 'in';
                                                            $glyphicon_menu_down = 'glyphicon-menu-down';
                                                            break;
                                                        }
                                                        // sub3
                                                        if(isset($sub2->children) && !empty($sub2->children)){
                                                            foreach ($sub2->children as $sub3) {
                                                                if((isset($sub3->id)) && ($sub3->id == getMenuIdbyUrl($uri) || $sub3->id == getMenuIdbyUrl($uri2))){
                                                                    // $active = 'active';
                                                                    $in = 'in';
                                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                    break;
                                                                }
                                                                // sub4
                                                                if(isset($sub3->children) && !empty($sub3->children)){
                                                                    foreach ($sub3->children as $sub4) {
                                                                        if((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2))){
                                                                            // $active = 'active';
                                                                            $in = 'in';
                                                                            $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                            break;
                                                                        }
                                                                        
                                                                        if(isset($sub4->children) && !empty($sub4->children)){
                                                                            foreach ($sub4->children as $sub5) {
                                                                                if((isset($sub5->id)) && ($sub5->id == getMenuIdbyUrl($uri) || $sub5->id == getMenuIdbyUrl($uri2))){
                                                                                    // $active = 'active';
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
                                                // }elseif ((isset($sub1->id)) && ($sub1->id == getMenuIdbyUrl($uri) || $sub1->id == getMenuIdbyUrl($uri2))) {
                                                //     $active = 'active';
                                                //     $in = 'in';
                                                //     $glyphicon_menu_down = 'glyphicon-menu-down';
                                                }
                                                elseif ((isset($sub1->id)) && ($sub1->id == getMenuIdbyUrl($uri2))) {
                                                    $active = 'active';
                                                    $in = 'in';
                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                }elseif(empty($this->uri->segment(2)) && $sub1->id == getMenuIdbyUrl($uri)){
                                                    $active = 'active';
                                                    $in = 'in';
                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                }
                                            ?>
                                            <!-- start parent -->
                                            <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                            <?php if($this->authorization->hasModule(getModuleId($sub1->id))){ ?>
                                            <li id="<?php echo $menuName; ?>">
                                            <?php } ?>
                                            <?php endif; ?>
                                                <!-- show parent -->
                                                <?php if(!isset($sub1->children) || empty($sub1->children)): ?>
                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                    <?php if($this->authorization->hasModule(getModuleId($sub1->id))){ ?>
                                                    <li class="<?php echo $active;?>">
                                                        <a href="<?php echo site_url().strtolower(getMenuURL($sub1->id)); ?>"> <span class="glyphicon <?php echo getMenuIcon($sub1->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub1->id); ?>"></span> <?php echo getMenuNameEN($sub1->id); ?></a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <!-- end parent -->

                                                <!-- show parent child -->
                                                <?php if(isset($sub1->children) || !empty($sub1->children)): ?>
                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                    <?php if($this->authorization->hasModule(getModuleId($sub1->id))){ ?>

                                                        <!-- check each children of sub1 hasModule access or not -->
                                                        <!-- if hasModule access will show include children menu else show only sub1 menu -->
                                                        <?php 
                                                            foreach ($sub1->children as $sub2) {
                                                                if((isset($sub2->id)) && ($this->authorization->hasModule(getModuleId($sub2->id)) == true)){
                                                                    $sub1HasModule = true;
                                                                    break;
                                                                }
                                                                // sub3
                                                                if(isset($sub2->children) && !empty($sub2->children)){
                                                                    foreach ($sub2->children as $sub3) {
                                                                        if((isset($sub3->id)) && ($this->authorization->hasModule(getModuleId($sub3->id)) == true)){
                                                                            $sub1HasModule = true;
                                                                            break;
                                                                        }
                                                                        // sub4
                                                                        if(isset($sub3->children) && !empty($sub3->children)){
                                                                            foreach ($sub3->children as $sub4) {
                                                                                if((isset($sub4->id)) && ($this->authorization->hasModule(getModuleId($sub4->id)) == true)){
                                                                                    $sub1HasModule = true;
                                                                                    break;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                        <?php if($sub1HasModule == true){ ?>
                                                            <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>"><span class="glyphicon <?php echo getMenuIcon($sub1->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub1->id); ?>"></span> <?php echo getMenuNameEN($sub1->id); ?>
                                                                <span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                                                            </a>
                                                            <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                                                                <ul class="inner-sidebar-links">
                                                        <?php }else{ ?>
                                                                <li class="<?php echo $active;?>">
                                                                    <a href="<?php echo site_url().strtolower(getMenuURL($sub1->id)); ?>"> <span class="glyphicon <?php echo getMenuIcon($sub1->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub1->id); ?>"></span> <?php echo getMenuNameEN($sub1->id); ?></a>
                                                                </li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php endif; ?>

                                                                    <!-- sub2 -->
                                                                    <?php foreach ($sub1->children as $c => $sub2): ?>
                                                                            <?php 
                                                                                $uri = $this->uri->segment(1); 
                                                                                if(isset($sub2->id) && !empty($sub2->id)){
                                                                                    $menuName = strtolower(str_replace(' ', '', getMenuNameEN($sub2->id)));
                                                                                }else{
                                                                                    $menuName = 'NULL';
                                                                                }

                                                                                $active = '';
                                                                                $sub2HasModule = false;
                                                                                $in = '';
                                                                                $glyphicon_menu_down = 'glyphicon-menu-right';

                                                                                if(isset($sub2->children) && !empty($sub2->children)){
                                                                                    foreach ($sub2->children as $sub3) {
                                                                                        if((isset($sub3->id)) && ($sub3->id == getMenuIdbyUrl($uri) || $sub3->id == getMenuIdbyUrl($uri2))){
                                                                                            // $active = 'active';
                                                                                            $in = 'in';
                                                                                            $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                            break;
                                                                                        }
                                                                                        // sub4
                                                                                        if(isset($sub3->children) && !empty($sub3->children)){
                                                                                            foreach ($sub3->children as $sub4) {
                                                                                                if((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2))){
                                                                                                    // $active = 'active';
                                                                                                    $in = 'in';
                                                                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                    break;
                                                                                                }
                                                                                                
                                                                                                if(isset($sub4->children) && !empty($sub4->children)){
                                                                                                    foreach ($sub4->children as $sub5) {
                                                                                                        if((isset($sub5->id)) && ($sub5->id == getMenuIdbyUrl($uri) || $sub5->id == getMenuIdbyUrl($uri2))){
                                                                                                            // $active = 'active';
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
                                                                                elseif ((isset($sub2->id)) && ($sub2->id == getMenuIdbyUrl($uri2))) {
                                                                                    $active = 'active';
                                                                                    $in = 'in';
                                                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                }elseif(empty($this->uri->segment(2)) && $sub2->id == getMenuIdbyUrl($uri)){
                                                                                    $active = 'active';
                                                                                    $in = 'in';
                                                                                    $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                }
                                                                            ?>
                                                                            <!-- start parent -->
                                                                            <?php if(isset($sub2->id) && !empty($sub2->id)): ?>
                                                                            <?php if($this->authorization->hasModule(getModuleId($sub2->id))){ ?>
                                                                            <li id="<?php echo $menuName; ?>">
                                                                            <?php } ?>
                                                                            <?php endif; ?>
                                                                                <!-- show parent -->
                                                                                <?php if(!isset($sub2->children) || empty($sub2->children)): ?>
                                                                                    <?php if(isset($sub2->id) && !empty($sub2->id)): ?>
                                                                                    <?php if($this->authorization->hasModule(getModuleId($sub2->id))){ ?>
                                                                                    <li class="<?php echo $active;?>"> <a href="<?php echo site_url().strtolower(getMenuURL($sub2->id)); ?>"> <span class="glyphicon <?php echo getMenuIcon($sub2->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub2->id); ?>"></span><?php echo getMenuNameEN($sub2->id); ?></a>
                                                                                    </li>
                                                                                    <?php } ?>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                                <!-- end parent -->

                                                                                <!-- show parent child -->
                                                                                <?php if(isset($sub2->children) || !empty($sub2->children)): ?>
                                                                                    <?php if(isset($sub2->id) && !empty($sub2->id)): ?>

                                                                                    <!-- check each children of sub2 hasModule access or not -->
                                                                                    <!-- if hasModule access will show include children menu else show only sub2 menu -->
                                                                                    <?php 
                                                                                        foreach ($sub2->children as $sub3){
                                                                                            if((isset($sub3->id)) && ($this->authorization->hasModule(getModuleId($sub3->id)) == true)){
                                                                                                $sub2HasModule = true;
                                                                                                break;
                                                                                            }
                                                                                            // sub4
                                                                                            if(isset($sub3->children) && !empty($sub3->children)){
                                                                                                foreach ($sub3->children as $sub4) {
                                                                                                    if((isset($sub4->id)) && ($this->authorization->hasModule(getModuleId($sub4->id)) == true)){
                                                                                                        $sub2HasModule = true;
                                                                                                        break;
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                    <?php if($this->authorization->hasModule(getModuleId($sub2->id))){ ?>
                                                                                        <?php if($sub2HasModule == true){ ?>
                                                                                            <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>"><span class="glyphicon <?php echo getMenuIcon($sub2->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub2->id); ?>"></span> <?php echo getMenuNameEN($sub2->id); ?><span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                                                                                            </a>
                                                                                            <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                                                                                                <ul class="inner-sidebar-links">
                                                                                        <?php }else{ ?>
                                                                                            <li class="<?php echo $active;?>"> <a href="<?php echo site_url().strtolower(getMenuURL($sub2->id)); ?>"> <span class="glyphicon <?php echo getMenuIcon($sub2->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub2->id); ?>"></span><?php echo getMenuNameEN($sub2->id); ?></a>
                                                                                            </li>
                                                                                        <?php } ?>
                                                                                    <?php } ?>
                                                                                    <?php endif; ?>

                                                                                                <!-- sub3 -->
                                                                                                <?php foreach ($sub2->children as $d => $sub3): ?>
                                                                                                        <?php 
                                                                                                            $uri = $this->uri->segment(1);
                                                                                                            if(isset($sub3->id) && !empty($sub3->id)){
                                                                                                                $menuName = strtolower(str_replace(' ', '', getMenuNameEN($sub3->id)));
                                                                                                            }else{
                                                                                                                $menuName = 'NULL';
                                                                                                            }

                                                                                                            $active = '';
                                                                                                            $sub3HasModule = false;
                                                                                                            $in = '';
                                                                                                            $glyphicon_menu_down = 'glyphicon-menu-right';
                                                                                                            
                                                                                                            if(isset($sub3->children) && !empty($sub3->children)){
                                                                                                                foreach ($sub3->children as $sub4) {
                                                                                                                    if((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2))){
                                                                                                                        // $active = 'active';
                                                                                                                        $in = 'in';
                                                                                                                        $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                                        break;
                                                                                                                    }
                                                                                                                    
                                                                                                                    if(isset($sub4->children) && !empty($sub4->children)){
                                                                                                                        foreach ($sub4->children as $sub5) {
                                                                                                                            if((isset($sub5->id)) && ($sub5->id == getMenuIdbyUrl($uri) || $sub5->id == getMenuIdbyUrl($uri2))){
                                                                                                                                // $active = 'active';
                                                                                                                                $in = 'in';
                                                                                                                                $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                                                break;
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }elseif((isset($sub3->id)) && ($sub3->id == getMenuIdbyUrl($uri2))) {
                                                                                                                $active = 'active';
                                                                                                                $in = 'in';
                                                                                                                $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                            }elseif(empty($this->uri->segment(2)) && $sub3->id == getMenuIdbyUrl($uri)){
                                                                                                                $active = 'active';
                                                                                                                $in = 'in';
                                                                                                                $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                            }
                                                                                                        ?>
                                                                                                        <!-- start parent -->
                                                                                                        <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                        <?php if($this->authorization->hasModule(getModuleId($sub3->id))){ ?>
                                                                                                        <li id="<?php echo $menuName; ?>">
                                                                                                        <?php } ?>
                                                                                                        <?php endif; ?>
                                                                                                            <!-- show parent -->
                                                                                                            <?php if(!isset($sub3->children) || empty($sub3->children)): ?>
                                                                                                                <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                                <?php if($this->authorization->hasModule(getModuleId($sub3->id))){ ?>
                                                                                                                <li class="<?php echo $active;?>">
                                                                                                                    <a href="<?php echo site_url().strtolower(getMenuURL($sub3->id)); ?>"><span class="glyphicon <?php echo getMenuIcon($sub3->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub3->id); ?>"></span>  <?php echo getMenuNameEN($sub3->id); ?></a>
                                                                                                                </li>
                                                                                                                <?php } ?>
                                                                                                                <?php endif; ?>
                                                                                                            <?php endif; ?>
                                                                                                            <!-- end parent -->

                                                                                                            <!-- show parent child -->
                                                                                                            <?php if(isset($sub3->children) || !empty($sub3->children)): ?>
                                                                                                                <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                                <?php if($this->authorization->hasModule(getModuleId($sub3->id))){ ?>

                                                                                                                    <?php 
                                                                                                                    foreach ($sub3->children as $sub4) {
                                                                                                                        if((isset($sub4->id)) && ($this->authorization->hasModule(getModuleId($sub4->id)) == true)){
                                                                                                                            $sub3HasModule = true;
                                                                                                                            break;
                                                                                                                        }
                                                                                                                    }
                                                                                                                     ?>
                                                                                                                    <?php if($sub3HasModule == true){ ?>
                                                                                                                        <a data-toggle="collapse" data-parent="#<?php echo $menuName; ?>" href="#<?php echo $menuName; ?>_sub" class="collapsed <?php echo $active; ?>"><span class="glyphicon <?php echo getMenuIcon($sub3->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub3->id); ?>"></span> <?php echo getMenuNameEN($sub3->id); ?>
                                                                                                                            <span class="plus-sidebar"><span class="glyphicon <?php echo $glyphicon_menu_down; ?>"></span></span>
                                                                                                                        </a>
                                                                                                                        <div id="<?php echo $menuName;?>_sub" class="panel-collapse collapse sidebar-links-inner <?php echo $in; ?>">
                                                                                                                            <ul class="inner-sidebar-links">
                                                                                                                    <?php }else{ ?>
                                                                                                                        <li class="<?php echo $active;?>">
                                                                                                                            <a href="<?php echo site_url().strtolower(getMenuURL($sub3->id)); ?>"><span class="glyphicon <?php echo getMenuIcon($sub3->id); ?> sidebar-icon sidebar-icon-<?php echo getMenuIconColor($sub3->id); ?>"></span>  <?php echo getMenuNameEN($sub3->id); ?></a>
                                                                                                                        </li>
                                                                                                                    <?php } ?>
                                                                                                                <?php } ?>
                                                                                                                <?php endif; ?>

                                                                                                                                <!-- sub4 -->
                                                                                                                                <?php foreach ($sub3->children as $e => $sub4): ?>
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
                                                                                                                                            }elseif ((isset($sub4->id)) && ($sub4->id == getMenuIdbyUrl($uri2))) {
                                                                                                                                                $active = 'active';
                                                                                                                                                $in = 'in';
                                                                                                                                                $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                                                            }elseif(empty($this->uri->segment(2)) && $sub4->id == getMenuIdbyUrl($uri)){
                                                                                                                                                $active = 'active';
                                                                                                                                                $in = 'in';
                                                                                                                                                $glyphicon_menu_down = 'glyphicon-menu-down';
                                                                                                                                            }
                                                                                                                                        ?>
                                                                                                                                        <!-- start parent -->
                                                                                                                                        <?php if($this->authorization->hasModule(getModuleId($sub4->id))){ ?>
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
                                                                                                                                        <?php } ?>
                                                                                                                                        <!-- end parent -->
                                                                                                                                <?php endforeach; ?>
                                                                                                                                <!-- sub4 -->

                                                                                                                <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                                  <?php if($this->authorization->hasModule(getModuleId($sub3->id))){ ?>
                                                                                                                    <?php if($sub3HasModule == true){ ?>
                                                                                                                            </ul>
                                                                                                                        </div>
                                                                                                                    <?php } ?>
                                                                                                                  <?php } ?>
                                                                                                                <?php endif; ?>
                                                                                                            <?php endif; ?>
                                                                                                            <!-- end show parent child -->
                                                                                                        <?php if(isset($sub3->id) && !empty($sub3->id)): ?>
                                                                                                            <?php if($this->authorization->hasModule(getModuleId($sub3->id))){ ?>
                                                                                                            </li>
                                                                                                            <?php } ?>
                                                                                                        <?php endif; ?>
                                                                                                        <!-- end parent -->
                                                                                                <?php endforeach; ?>
                                                                                                <!-- sub3 -->

                                                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                                                      <?php if($this->authorization->hasModule(getModuleId($sub2->id))){ ?>
                                                                                        <?php if($sub2HasModule == true){ ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                      <?php } ?>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                                <!-- end show parent child -->
                                                                            <?php if(isset($sub2->id) && !empty($sub2->id)): ?>
                                                                            <?php if($this->authorization->hasModule(getModuleId($sub2->id))){ ?>
                                                                            </li>
                                                                            <?php } ?>
                                                                            <?php endif; ?>
                                                                            <!-- end parent -->
                                                                    <?php endforeach; ?>
                                                                    <!-- sub2 -->

                                                    <?php if(isset($sub1->id) && !empty($sub1->id)): ?>
                                                        <?php if($this->authorization->hasModule(getModuleId($sub1->id))){ ?>
                                                            <?php if($sub1HasModule == true){ ?>
                                                                    </ul>
                                                                 </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <!-- end show parent child -->
                                            <?php if(isset($sub1->id) && !empty($sub1->id)):?>
                                            <?php if($this->authorization->hasModule(getModuleId($sub1->id))){ ?>
                                            </li>
                                            <?php } ?>
                                            <?php endif; ?>
                                            <!-- end parent -->
                                    <?php endforeach; ?>
                                    <!-- sub1 -->


                    <?php if(isset($parent->id) && !empty($parent->id)): ?>
                        <?php if($this->authorization->hasModule(getModuleId($parent->id))){ ?>
                            <?php if($hasModule == true){ ?>
                                </ul>
                              </div>
                            <?php } ?>
                        <?php } ?>
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
