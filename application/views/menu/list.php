
<?php if(!empty($this->session->flashdata('success'))){ ?>
<div class="row" id="alert-success">
    <div class="col-md-12">
        <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('success') ?></div>
    </div>
</div>
<?php } ?>

<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("menu_management") ?></div>
        <div class="db-header-extra">
        </div>
    </div>

    <ol class="breadcrumb">
        <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li><a href="<?php echo site_url("admin/members") ?>"><?php echo lang("ctn_21") ?></a></li>
        <li class="active"><?php echo lang("ctn_22") ?></li>
    </ol>

    <!-- <p><?php echo "Here you can manage the menu of your site." ?></p> -->
    


    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="text-left" id="nestable_list_menu">
                <button type="button" class="btn btn-blue btn-sm waves-effect mb-3 waves-light" data-action="expand-all">Expand All</button>
                <button type="button" class="btn btn-pink btn-sm waves-effect mb-3 waves-light" data-action="collapse-all">Collapse All</button>
            </div>
        </div>
    </div><hr> -->
    <!-- End row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <!-- form -->
                    <div class="col-md-6" style="display: none;">
                        <h4 class="header-title mt-3 mt-md-0">Form Create Menu</h4>
                        <p class="sub-header">
                            Provide a unique menu for access to your system
                        </p>

                        <div class="custom-dd dd" id="nestable_list_2">
                            <ol class="dd-list">
                                <li class="dd-item" data-id="11">
                                    <div class="dd-handle">
                                        Item 11
                                    </div>
                                </li>
                                <li class="dd-item" data-id="12">
                                    <div class="dd-handle">
                                        Item 12
                                    </div>
                                </li>
                                <li class="dd-item" data-id="13">
                                    <div class="dd-handle">
                                        Item 13
                                    </div>
                                </li>
                                <li class="dd-item" data-id="14">
                                    <div class="dd-handle">
                                        Item 14
                                    </div>
                                </li>
                                <li class="dd-item" data-id="15">
                                    <div class="dd-handle">
                                        Item 15
                                    </div>
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="16">
                                            <div class="dd-handle">
                                                Item 16
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="17">
                                            <div class="dd-handle">
                                                Item 17
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="18">
                                            <div class="dd-handle">
                                                Item 18
                                            </div>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div> <!-- end col -->
                    <!-- end form -->

                    <!-- form -->
                    <div class="col-md-5">
                        <h4 class="header-title mt-3 mt-md-0">Form Create Menu</h4>
                        <p class="sub-header">
                            Provide a unique menu for access to your system</p>
                        <button type="button" onclick="location.reload();" class="btn btn-blue btn-sm waves-effect mb-3 waves-light pull-right"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                        <div>
                            <?php echo form_open_multipart(site_url("menu/create"), array("class" => "form-horizontal")) ?> 
                            <!-- <form action="<?php// echo site_url("menu/create"); ?>" method="post" class="form-horizontal"> -->
                                <!-- menu name en -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="menu_name_en"><?php echo lang('menu_name_en') ?></label>
                                    <input type="text" name="menu_name_en" value="<?php echo set_value('menu_name_en') ?>" class="form-control" minlength="1" max="100" id="menu_name_en" required>
                                    <span class="text-danger"><?php echo form_error('menu_name_en'); ?></span>
                                  </div>
                                </div>
                                <!-- menu_name_kh -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="menu_name_kh"><?php echo lang('menu_name_kh') ?></label>
                                    <input type="text" name="menu_name_kh" value="<?php echo set_value('menu_name_kh') ?>" class="form-control" minlength="1" max="100" id="menu_name_kh" required>
                                    <span class="text-danger"><?php echo form_error('menu_name_kh'); ?></span>
                                  </div>
                                </div>
                                <!-- menu_url -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="menu_url"><?php echo lang('menu_link') ?></label>
                                    <select class="form-control select2" name="menu_url" id="menu_url" required>
                                        <option value="">--- select link ---</option>
                                            <?php if(isset($modules) && !empty($modules)): ?>
                                                <?php foreach ($modules as $module):?>
                                                    <option value="<?php echo $module['module_id']; ?>"><?php echo $module['module_name']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                    </select>
                                    <!-- <input type="text" name="menu_url" class="form-control" value="<?php echo set_value('menu_url') ?>" minlength="1" max="100" id="menu_url" required> -->
                                    <span class="text-danger"><?php echo form_error('menu_url'); ?></span>
                                  </div>
                                </div>
                                <!-- menu_icon -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="menu_icon"><?php echo lang('menu_icon').' (glyphicon)' ?></label>
                                    <input type="text" name="menu_icon" minlength="9" value="<?php echo set_value('menu_icon') ?>" max="100" class="form-control" id="menu_icon" placeholder="glyphicon-ok-circle" required>
                                    <span class="text-danger"><?php echo form_error('menu_icon'); ?></span>
                                  </div>
                                </div>
                                <!-- icon color -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="icon_color"><?php echo lang('icon_color'); ?></label>
                                    <select class="form-control select2" name="icon_color" id="icon_color" required>
                                        <option value="">--- select color ---</option>
                                        <option value="red"> Red </option>
                                        <option value="blue"> Blue </option>
                                        <option value="brown"> Brown </option>
                                        <option value="orange"> Orange </option>
                                        <option value="green"> Green </option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('icon_color'); ?></span>
                                  </div>
                                </div>
                                <!-- active -->
                                <div class="col-md-12">
                                  <div class="checkbox">
                                    <label><input type="checkbox" value="0" name="status" id="status"> <?php echo lang('active') ?></label>
                                  </div>
                                </div>
                                <textarea id="nestable-output" name="menu_orderable" style="display: none;"></textarea>
                                <!-- active -->
                                <div class="col-md-12 text-right" id="btn-action">
                                    <button type="submit" class="btn btn-success btn-sm" id="btn-submit"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang('btn_save') ?></button>
                                    <a href="<?php echo base_url('menu'); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
                                </div>
                            </form>
                        </div>
                    </div> <!-- end col -->
                    <!-- end form -->

                    <div class="col-md-1"></div>
                    
                    <!-- list menu -->
                    <div class="col-md-6">
                        <h4 class="header-title">Lists Menu System</h4>
                        <p class="sub-header">
                            Drag & drop menu list with mouse and touch compatibility (Order Menu).
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-left" id="nestable_list_menu">
                                        <button type="button" class="btn btn-blue btn-sm waves-effect mb-3 waves-light" data-action="expand-all">Expand All</button>
                                        <button type="button" class="btn btn-pink btn-sm waves-effect mb-3 waves-light" data-action="collapse-all">Collapse All</button>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </p>

                        <!-- list menu drag drop  -->
                        <div class="custom-dd dd" id="nestable_list_1">
                            <?php 
                                if(!empty($menuOrderable))
                                {
                                    $menuItem = json_decode($menuOrderable[0]['orderable']);

                                    echo '<ol class="dd-list">';

                                    foreach ($menuItem as $parent) 
                                    {   //parent
                                        if(isset($parent->id) && !empty($parent->id)){
                                            echo '<li class="dd-item" data-id="'.$parent->id.'">
                                                <div class="dd-handle" data-id="'.$parent->id.'">'.getMenuNameEN($parent->id);

                                                    if($this->authorization->hasPermission($moduleName, "delete")){
                                                    echo '<a href="'.base_url().'" data-btn="btn-delete" data-id="'.$parent->id.'"><span class="glyphicon glyphicon-remove pull-right text-danger" aria-hidden="true"></span></a>';
                                                    }

                                                    if($this->authorization->hasPermission($moduleName, "update")){
                                                        echo '<a href="'.base_url().'" data-btn="btn-edit" data-id="'.$parent->id.'"><span class="glyphicon glyphicon-edit pull-right text-warning" aria-hidden="true"></span></a>';
                                                    }
                                            echo '</div>';  
                                        }

                                            // sub1
                                            if(isset($parent->children)){

                                                if(isset($parent->id) && !empty($parent->id)){
                                                    echo '<ol class="dd-list">';
                                                }

                                                foreach ($parent->children as $sub1) 
                                                {
                                                    if(isset($sub1->id) && !empty($sub1->id)){
                                                        echo '<li class="dd-item" data-id="'.$sub1->id.'">
                                                            <div class="dd-handle" data-id="'.$sub1->id.'">' .getMenuNameEN($sub1->id);

                                                            if($this->authorization->hasPermission($moduleName, "delete")){
                                                                echo '<a href="'.base_url().'" data-btn="btn-delete" data-id="'.$sub1->id.'"><span class="glyphicon glyphicon-remove pull-right text-danger" aria-hidden="true"></span></a>';
                                                            }

                                                            if($this->authorization->hasPermission($moduleName, "update")){
                                                                echo '<a href="'.base_url().'" data-btn="btn-edit" data-id="'.$sub1->id.'"><span class="glyphicon glyphicon-edit pull-right text-warning" aria-hidden="true"></span></a>';
                                                            }
                                                        echo '</div>';
                                                    } 

                                                    // sub2
                                                    if(isset($sub1->children)){

                                                        if(isset($sub1->id) && !empty($sub1->id)){
                                                            echo '<ol class="dd-list">';
                                                        }

                                                        foreach ($sub1->children as $sub2) 
                                                        {
                                                            if(isset($sub2->id) && !empty($sub2->id)){
                                                                echo '<li class="dd-item" data-id="'.$sub2->id.'">
                                                                    <div class="dd-handle" data-id="'.$sub2->id.'">' .getMenuNameEN($sub2->id);

                                                                    if($this->authorization->hasPermission($moduleName, "delete")){
                                                                     echo '<a href="'.base_url().'" data-btn="btn-delete" data-id="'.$sub2->id.'"><span class="glyphicon glyphicon-remove pull-right text-danger" aria-hidden="true"></span></a>';
                                                                    }

                                                                    if($this->authorization->hasPermission($moduleName, "update")){ 
                                                                     echo '<a href="'.base_url().'" data-btn="btn-edit" data-id="'.$sub2->id.'"><span class="glyphicon glyphicon-edit pull-right text-warning" aria-hidden="true"></span></a>';
                                                                    }

                                                                echo '</div>';
                                                            } 

                                                            // sub3
                                                            if(isset($sub2->children)){

                                                                if(isset($sub2->id) && !empty($sub2->id)){
                                                                    echo '<ol class="dd-list">';
                                                                }

                                                                foreach ($sub2->children as $sub3) 
                                                                {
                                                                    if(isset($sub3->id) && !empty($sub3->id)){
                                                                        echo '<li class="dd-item" data-id="'.$sub3->id.'">
                                                                            <div class="dd-handle" data-id="'.$sub3->id.'">'.getMenuNameEN($sub3->id);

                                                                            if($this->authorization->hasPermission($moduleName, "delete")){
                                                                               '<a href="'.base_url().'" data-btn="btn-delete" data-id="'.$sub3->id.'"><span class="glyphicon glyphicon-remove pull-right text-danger" aria-hidden="true"></span></a>';
                                                                            }

                                                                            if($this->authorization->hasPermission($moduleName, "update")){
                                                                               echo '<a href="'.base_url().'" data-btn="btn-edit" data-id="'.$sub3->id.'"><span class="glyphicon glyphicon-edit pull-right text-warning" aria-hidden="true"></span></a>';
                                                                            }
                                                                        echo '</div>';
                                                                    }
                                                                        //sub4
                                                                        if(isset($sub3->children)){

                                                                            if(isset($sub3->id) && !empty($sub3->id)){
                                                                                echo '<ol class="dd-list">';
                                                                            }

                                                                            foreach ($sub3->children as $sub4) 
                                                                            {
                                                                                if(isset($sub4->id) && !empty($sub4->id)){
                                                                                    echo '<li class="dd-item" data-id="'.$sub4->id.'">
                                                                                        <div class="dd-handle" data-id="'.$sub4->id.'">'.getMenuNameEN($sub4->id);

                                                                                        if($this->authorization->hasPermission($moduleName, "delete")){
                                                                                            echo '<a href="'.base_url().'" data-btn="btn-delete" data-id="'.$sub4->id.'"><span class="glyphicon glyphicon-remove pull-right text-danger" aria-hidden="true"></span></a>';
                                                                                        }
                                                                                        if($this->authorization->hasPermission($moduleName, "update")){
                                                                                            echo '<a href="'.base_url().'" data-btn="btn-edit" data-id="'.$sub4->id.'"><span class="glyphicon glyphicon-edit pull-right text-warning" aria-hidden="true"></span></a>';
                                                                                        }
                                                                                    echo '</div></li>';
                                                                                }
                                                                            }

                                                                            if(isset($sub3->id) && !empty($sub3->id)){
                                                                                echo '</ol>';
                                                                            }
                                                                        }//end sub4

                                                                    if(isset($sub3->id) && !empty($sub3->id)){
                                                                        echo '</li>';
                                                                    }
                                                                }

                                                                if(isset($sub2->id) && !empty($sub2->id)){
                                                                    echo '</ol';
                                                                }
                                                            }//end sub3

                                                            if(isset($sub2->id) && !empty($sub2->id)){
                                                            echo '</li>';}//end sub2
                                                        }

                                                        if(isset($sub1->id) && !empty($sub1->id)){
                                                            echo '</ol>';
                                                        }
                                                    }//end sub2

                                                    if(isset($sub1->id) && !empty($sub1->id)){
                                                        echo '</li>';//end sub1
                                                    }
                                                }

                                                //end ol
                                                if(isset($parent->id) && !empty($parent->id)){
                                                    echo '</ol>';
                                                }

                                            }//end sub1 

                                        //end parent 
                                        if(isset($parent->id) && !empty($parent->id)){
                                            echo '</li>';
                                        }
                                    }

                                    echo '</ol>';
                                }
                                else{
                                    if(!empty($data)){
                                        echo '<ol class="dd-list">';
                                        foreach ($data as $menu){
                                            echo '<li class="dd-item" data-id="'.$menu['menu_id'].'">
                                                    <div class="dd-handle">'.$menu['menu_name_en'].'</div></li>'; 
                                        }
                                        echo '</ol>';
                                    }
                                } 
                            ?>
                        </div>
                        <!-- end list menu drag drob -->
                    </div><!-- end col -->

                </div> <!-- end row -->
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!-- end Row -->

</div>
<script>
$(document).ready(function()
{

    var updateOutput = function(e)
    {    
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));  

            // update menu orderable
            $.ajax({
                url: global_base_url + "menu/orderMenuItem",
                type: "get",
                dataType: 'json',
                data: 'menuItems='+ output.val(),
                success: function (response){
                    console.log(response);
                }
            });

        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable_list_1').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable_list_1').data('output', $('#nestable-output')));
    // updateOutput($('#nestable2').data('output', $('#nestable2-output')));

    // $('#nestable_list_menu').on('click', function(e)
    // {
    //     var target = $(e.target),
    //         action = target.data('action');
    //     if (action === 'expand-all') {
    //         $('.dd').nestable('expandAll');
    //     }
    //     if (action === 'collapse-all') {
    //         $('.dd').nestable('collapseAll');
    //     }
    // });

    // view menu
    // $('.dd-handle').on('click', function(event) 
    // {
    //     event.stopPropagation();
    //     event.preventDefault();
    //     var menuId = $(this).data('id');

    //     $.ajax({
    //         url: global_base_url + "menu/view",
    //         type: "get",
    //         dataType: 'json',
    //         data: 'id='+ menuId,
    //         success: function (response){
    //             $('#menu_name_en').val(response.menu_name_en);
    //             $('#menu_name_kh').val(response.menu_name_kh);
    //             $('#menu_url').val(response.menu_url);
    //             $('#menu_icon').val(response.menu_icon);
    //             $('#status').val(response.status);
    //             $('#status').attr("checked");
    //             if(response.status == 1){
    //                 $('#status').attr('checked', true);
    //             }else{
    //                 $('#status').attr('checked', false);
    //             }
    //             $('form').attr('action','<?php echo site_url("menu/update?id="); ?>'+menuId);
    //             $('#btn-submit').html('<i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang('btn_update') ?>');
    //         }
    //     });
    // });

    // mousedown prevent nestable click
    $('.dd-handle a').on('mousedown', function(event) 
    {   
        event.stopPropagation();
        event.preventDefault();
        var action = $(this).data('btn');
        var menuId = $(this).data('id');
        
        // action delete menu
        if(action == 'btn-delete'){
            if(confirm("Are you sure you want to delete this menu?")){
                $.ajax({
                    url: global_base_url + "menu/delete",
                    type: "get",
                    dataType: 'json',
                    data: 'id='+ menuId,
                    success: function (response){
                       location.reload();
                    }
                });
            }
        }

        // action edit menu
        if(action == 'btn-edit'){
            if(confirm("Are you sure you want to update this menu?")){
                $.ajax({
                    url: global_base_url + "menu/edit",
                    type: "get",
                    dataType: 'json',
                    data: 'id='+ menuId,
                    success: function (response){
                        $('#menu_name_en').val(response.menu_name_en);
                        $('#menu_name_kh').val(response.menu_name_kh);
                        $('#menu_url').val(response.menu_url).trigger('change');;
                        $('#menu_icon').val(response.menu_icon);
                        $('#icon_color').val(response.icon_color).trigger('change');
                        $('#status').val(response.status);
                        $('#status').attr("checked");
                        if(response.status == 1){
                            $('#status').attr('checked', true);
                        }else{
                            $('#status').attr('checked', false);
                        }
                        $('form').attr('action','<?php echo site_url("menu/update?id="); ?>'+menuId);
                        $('#btn-submit').html('<i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang('btn_update') ?>');
                    }
                });
            }
        }
    });

    $('#status').change(function(){
        this.checked ? $(this).val(1) : $(this).val(0);
    });

    // $('#nestable3').nestable();

});
</script>
<script>
    $('.select2').select2();
    $("#alert-success").fadeTo(8000, 8000).slideUp(500, function(){
        $("#alert-success").alert('close');
    });
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>

<script type="text/javascript">

    // var menuItem = JSON.parse('<?php //echo $menuOrderable[0]['orderable']; ?>');
            // var menu = '';
            // // LOOP ALL EXISTING MENU ITEMS
            // for (a in menuItem) 
            // {
            //     //parent
            //     menu += '<ol class="dd-list">'+
            //                     '<li class="dd-item" data-id="'+menuItem[a].id+'">';
            //                     menu += '<div class="dd-handle"> menu:' +menuItem[a].id+ '</div>';

            //         // sub1 start 
            //         if(menuItem[a].children){
            //             for(b in menuItem[a].children){
            //                     menu += '<ol class="dd-list">'+
            //                              '<li class="dd-item" data-id="'+menuItem[a].children[b].id+'"><div class="dd-handle"> sub1:' +menuItem[a].children[b].id+ '</div>';

            //                     // start sub2
            //                     if(menuItem[a].children[b].children){ 
            //                         for(c in menuItem[a].children[b].children){
            //                                 menu += '<ol class="dd-list">'+
            //                                           '<li class="dd-item" data-id="'+menuItem[a].children[b].children[c].id+'">'+
            //                                         '<div class="dd-handle"> sub2:' +menuItem[a].children[b].children[c].id+ '</div>';

            //                                 // start sub3
            //                                 if(menuItem[a].children[b].children[c].children){
            //                                     for(d in menuItem[a].children[b].children[c].children){
            //                                             menu += '<ol class="dd-list">'+
            //                                                       '<li class="dd-item" data-id="'+menuItem[a].children[b].children[c].children[d].id+'">'+
            //                                                     '<div class="dd-handle"> sub3:' +menuItem[a].children[b].children[c].children[d].id+ '</div>';

            //                                             // start sub4
            //                                             if(menuItem[a].children[b].children[c].children[d].children){
            //                                                 for(e in menuItem[a].children[b].children[c].children[d].children){
            //                                                     menu += '<ol class="dd-list">'+
            //                                                               '<li class="dd-item" data-id="'+menuItem[a].children[b].children[c].children[d].children[e].id+'">'+
            //                                                             '<div class="dd-handle"> sub4:' +menuItem[a].children[b].children[c].children[d].children[e].id+ '</div>';
            //                                                     menu += '</li></ol>';
            //                                                 }
            //                                             }//end sub4

            //                                         menu += '</li></ol>';
            //                                     }
            //                                 }//end sub

            //                             menu += '</li></ol>';
            //                         }
            //                     }//end sub2

            //                 menu += '</li></ol>';
            //             }
            //         }//end sub1

            //     menu += '</li></ol>';
            // }//end menu

            // // APPEND MENU TO VIEW
            // $('#nestable_list_1').html(menu);   
</script>