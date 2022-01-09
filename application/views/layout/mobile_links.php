<div id="responsive-menu-links">
    <?php 
        $uri = $this->uri->segment(1); 
        $uri2 = $this->uri->segment(1).'/'.$this->uri->segment(2); 
        $selected = "";
     ?>
    <select name='link' OnChange="window.location.href = $(this).val();" class="form-control selectpicker">
        <option value='<?php echo site_url("home") ?>'><?php echo lang("ctn_154") ?></option>
        
        <?php if(!empty(getAllMenuOrderable())): ?>
            <?php $menuItem = json_decode(getAllMenuOrderable());?>
            <?php foreach ($menuItem as $a => $parent): ?>
                
                <?php 
                    $selected = "";
                    if($parent->id == getMenuIdbyUrl($uri) || $parent->id == getMenuIdbyUrl($uri2)){
                        $selected = "selected";
                    }
                 ?>
                <!-- show parent -->
                <?php if(isset($parent->id) && !empty($parent->id) && isset($parent->children) && !empty($parent->children)){ ?>
                <optgroup label="<?php echo getMenuNameEN($parent->id); ?>">
                    
                    <!-- show sub1 -->
                    <?php if(isset($parent->children) && !empty($parent->children)):
                        foreach ($parent->children as $sub1):?>
                            <?php 
                                $selected = "";
                                if($sub1->id == getMenuIdbyUrl($uri) || $sub1->id == getMenuIdbyUrl($uri2)){
                                    $selected = "selected";
                                }
                             ?>

                            <?php if(isset($sub1->id) && !empty($sub1->id) && isset($sub1->children) && !empty($sub1->children)){ ?>
                                <optgroup label="<?php echo getMenuNameEN($sub1->id); ?>">

                                    <!-- show sub2 -->
                                    <?php if(isset($sub1->children) && !empty($sub1->children)):
                                        foreach ($sub1->children as $sub2):?>
                                            <?php 
                                                $selected = "";
                                                if($sub2->id == getMenuIdbyUrl($uri) || $sub2->id == getMenuIdbyUrl($uri2)){
                                                    $selected = "selected";
                                                }
                                             ?>
                                            <?php if(isset($sub2->id) && !empty($sub2->id) && isset($sub2->children) && !empty($sub2->children)){ ?>
                                                <optgroup label="<?php echo getMenuNameEN($sub2->id); ?>">
                                                    
                                                    <!-- show sub3 -->
                                                    <?php if(isset($sub2->children) && !empty($sub2->children)):
                                                        foreach ($sub2->children as $sub3):?>
                                                            <?php 
                                                                $selected = "";
                                                                if($sub3->id == getMenuIdbyUrl($uri) || $sub3->id == getMenuIdbyUrl($uri2)){
                                                                    $selected = "selected";
                                                                }
                                                             ?>
                                                            <?php if(isset($sub3->id) && !empty($sub3->id) && isset($sub3->children) && !empty($sub3->children)){ ?>
                                                                <optgroup label="<?php echo getMenuNameEN($sub3->id); ?>">

                                                                    <!-- show sub4 -->
                                                                    <?php if(isset($sub3->children) && !empty($sub3->children)):
                                                                        foreach ($sub3->children as $sub4):?>
                                                                            <?php 
                                                                                $selected = "";
                                                                                if($sub4->id == getMenuIdbyUrl($uri) || $sub4->id == getMenuIdbyUrl($uri2)){
                                                                                    $selected = "selected";
                                                                                }
                                                                             ?>
                                                                            <?php if(isset($sub4->id) && !empty($sub4->id)){ ?>
                                                                                <option value="<?php echo site_url().strtolower(getMenuURL($sub4->id)); ?>" <?php echo $selected;?>><?php echo getMenuNameEN($sub4->id); ?></option>
                                                                            <?php } ?>
                                                                    <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                    <!-- end sub3 -->

                                                                </optgroup>
                                                            <?php }else{ ?>
                                                                <option value="<?php echo site_url().strtolower(getMenuURL($sub3->id)); ?>" <?php echo $selected;?>><?php echo getMenuNameEN($sub3->id); ?></option>
                                                            <?php } ?>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <!-- end sub3 -->

                                                </optgroup>
                                            <?php }else{ ?>
                                                <option value="<?php echo site_url().strtolower(getMenuURL($sub2->id)); ?>" <?php echo $selected;?>><?php echo getMenuNameEN($sub2->id); ?></option>
                                            <?php } ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <!-- end sub2 -->

                                </optgroup>

                            <?php }else{ ?>
                                <option value="<?php echo site_url().strtolower(getMenuURL($sub1->id)); ?>" <?php echo $selected;?>><?php echo getMenuNameEN($sub1->id); ?></option>
                            <?php } ?>

                    <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- end sub1 -->
            
                </optgroup>
                <?php }else{ ?>
                    <option value="<?php echo site_url().strtolower(getMenuURL($parent->id)); ?>" <?php echo $selected;?>><?php echo getMenuNameEN($parent->id); ?></option>
                <?php } ?>
            <?php endforeach; ?>
            <!-- end show parent -->

        <?php endif; ?>

    </select> 
</div>