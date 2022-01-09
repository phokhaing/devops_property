<script src="<?php echo base_url(); ?>scripts/custom/get_usernames.js"></script>
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<div class="white-area-content">

    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-send"></span> Form Request User Move</div>
        <div class="db-header-extra"> 
        </div>
    </div>

        <?php echo form_open_multipart(site_url("userMoveRequest/create/"), array("class" => "form-horizontal")) ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <legend id="label-cusinfo">For Staff</legend>
                    <!--List users-->
                    <div class="form-group">
                        <label for="user_id" class="col-md-3 label-heading">Select User</label>
                        <div class="col-md-9 ui-front">
                            <select name="user_id" id="user_id" class="form-control select2" style='width:100%' data-live-search="true" required>
                                <option value="">--- Please select staff ---</option>
                                <?php foreach ($listUsers as $key => $value) : ?>
                                    <option value="<?php echo $value->ID; ?>"><?php echo $value->first_name.' '.$value->last_name; ?></option>
                                <?php endforeach ?>
                                <input type="hidden" id="username" class="form-control" name="username" value="" required>
                            </select>
                        </div>
                    </div>
                    <!-- phone number -->
                    <div class="form-group">
                        <label for="phone" class="col-md-3 label-heading">Phone Number</label>
                        <div class="col-md-9 ui-front">
                            <input type="number" id="phone" class="form-control" name="phone" value="" required>
                        </div>
                    </div>                    
                    <!-- BM/Manager's ID* -->
                    <div class="form-group">
                        <label for="manager_id" class="col-md-3 label-heading">BM/Manager's ID*</label>
                        <div class="col-md-9 ui-front">
                            <input type="text" id="manager_id" class="form-control" name="manager_id" value="" readonly>
                        </div>
                    </div>
                    <!-- BM/Manager's Name* -->
                    <div class="form-group">
                        <label for="manager_name" class="col-md-3 label-heading">BM/Manager's Name*</label>
                        <div class="col-md-9 ui-front">
                            <input type="text" id="manager_name" class="form-control" name="manager_name" value="" readonly>
                        </div>
                    </div>
                    <!-- branch-->
                    <div class="form-group">
                        <label for="branch" class="col-md-3 label-heading">Select branch</label>
                        <div class="col-md-9 ui-front">
                            <select name="branch" id="branch" class="form-control select2" required>
                                <option value="">--- Please select branch ---</option>
                                <?php foreach ($listBranchs as $key => $value) : ?>
                                    <option value="<?php echo $value->id_branch; ?>"><?php echo $value->branch_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!-- department-->
                    <div class="form-group">
                        <label for="department" class="col-md-3 label-heading">Select Department</label>
                        <div class="col-md-9 ui-front">
                            <select name="department" id="department" class="form-control select2" required>
                                <option value="">--- Please select department ---</option>
                                <?php foreach ($listDepartments as $key => $value) : ?>
                                    <option value="<?php echo $value->id_department; ?>"><?php echo $value->department_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!--List job title-->
                    <div class="form-group">
                        <label for="position" class="col-md-3 label-heading">Select Position</label>
                        <div class="col-md-9 ui-front">
                            <select name="position" id="position" class="form-control select2" required>
                                <option value="">--- Please select position ---</option>
                                <?php foreach ($listPositions as $key => $value) : ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->position_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!-- ext -->
                    <div class="form-group">
                        <label for="ext" class="col-md-3 label-heading">Ext</label>
                        <div class="col-md-9 ui-front">
                            <input type="text" id="ext" class="form-control" name="ext" value="">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Duration move -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- duration move-->
                    <div class="form-group">
                        <label for="duration_move" class="col-md-3 label-heading">Duration Move*</label>
                        <div class="col-md-9 ui-front">
                            <select name="duration_move" id="duration_move" class="form-control select2" required>
                                <option value="">--- Please select duration move ---</option>
                                    <option value="temporary">Temporary Move</option>
                                    <option value="permanent">Permanent Move</option>
                            </select>
                        </div>
                    </div>

                    <!-- move from date-->
                    <div class="form-group">
                        <label for="from_date" class="col-md-3 label-heading">Move From Date</label>
                        <div class="col-md-9 ui-front">
                            <input class='form-control' type="text" id="from_date" name="from_date" value="" placeholder="yyyy-mm-dd" disabled/>
                            <span style="color:red" class="show_error2"></span>
                        </div>
                    </div>

                    <!-- move from date-->
                    <div class="form-group">
                        <label for="from_date" class="col-md-3 label-heading">Move To Date</label>
                        <div class="col-md-9 ui-front">
                            <input class='form-control' type="text" id="to_date" name="to_date" placeholder="yyyy-mm-dd" value="" disabled/>
                            <span style="color:red" class="show_error2"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end duration move -->

            <!-- Move From -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <legend id="label-cusinfo">Move From</legend>
                    <!-- move from branch-->
                    <div class="form-group">
                        <label for="from_branch" class="col-md-3 label-heading">Branch</label>
                        <div class="col-md-9 ui-front">
                            <select name="from_branch" id="from_branch" class="form-control select2" required>
                                <option value="">--- Please select branch ---</option>
                                <?php foreach ($listBranchs as $key => $value) : ?>
                                    <option value="<?php echo $value->id_branch; ?>"><?php echo $value->branch_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!-- move from department-->
                    <div class="form-group">
                        <label for="from_" class="col-md-3 label-heading">Department</label>
                        <div class="col-md-9 ui-front">
                            <select name="from_department" id="from_department" class="form-control select2" required>
                                <option value="">--- Please select department ---</option>
                                <?php foreach ($listDepartments as $key => $value) : ?>
                                    <option value="<?php echo $value->id_department; ?>"><?php echo $value->department_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!--from_position-->
                    <div class="form-group">
                        <label for="from_position" class="col-md-3 label-heading">Position</label>
                        <div class="col-md-9 ui-front">
                            <select name="from_position" id="from_position" class="form-control select2" required>
                                <option value="">--- Please select position ---</option>
                                <?php foreach ($listPositions as $key => $value) : ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->position_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!-- more application request -->
                    <div class="append-form-from">
                        <!-- move from main application-->
                            <div class="form-group">
                                <label for="from_main_app" class="col-md-3 label-heading">Main Application</label>
                                <div class="col-md-9 ui-front">
                                    <select name="from_main_app[]" id="from_main_app" class="form-control select2" onchange="changeMainAppFrom('')" required>
                                        <option value="">--- Please select main application ---</option>
                                        <?php foreach ($listRequestTypes as $key => $value) : ?>
                                            <option value="<?php echo $value->id_request_type; ?>"><?php echo $value->request_type_name; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <!-- move from staff_profile_type-->
                            <div class="form-group">
                                <label for="from_staff_profile_type" class="col-md-3 label-heading">Staff Profile Type</label>
                                <div class="col-md-9 ui-front">
                                    <select name="from_staff_profile_type[]" id="from_staff_profile_type" class="form-control select2" required>
                                    </select>
                                </div>
                            </div>
                            <!-- move from function-->
                            <div class="form-group">
                                <label for="from_function" class="col-md-3 label-heading">Select function</label>
                                <div class="col-md-9 ui-front">
                                    <select name="from_function[][0]" id="from_function" multiple class="form-control select2" required>
                                    </select>
                                </div>
                            </div>
                            <!-- show button remove and add form -->
                            <div class="form-group" id="addMainAppFrom">
                                <label for="function" class="col-md-3 label-heading"></label>
                                <div class="col-md-9 ui-front">
                                    <!-- button add form -->
                                    <!-- button remove form -->
                                    <a href="javascript:void(0)" title="Add Form" onclick="addMainAppFrom();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- End move from -->
            
            <!-- Move To -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <legend id="label-cusinfo">Move To</legend>
                    <!-- move to branch-->
                    <div class="form-group">
                        <label for="to_branch" class="col-md-3 label-heading">Branch</label>
                        <div class="col-md-9 ui-front">
                            <select name="to_branch" id="to_branch" class="form-control select2" required>
                                <option value="">--- Please select branch ---</option>
                                <?php foreach ($listBranchs as $key => $value) : ?>
                                    <option value="<?php echo $value->id_branch; ?>"><?php echo $value->branch_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!-- move to department-->
                    <div class="form-group">
                        <label for="to_" class="col-md-3 label-heading">Department</label>
                        <div class="col-md-9 ui-front">
                            <select name="to_department" id="to_department" class="form-control select2" required>
                                <option value="">--- Please select department ---</option>
                                <?php foreach ($listDepartments as $key => $value) : ?>
                                    <option value="<?php echo $value->id_department; ?>"><?php echo $value->department_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!--to_position-->
                    <div class="form-group">
                        <label for="to_position" class="col-md-3 label-heading">Position</label>
                        <div class="col-md-9 ui-front">
                            <select name="to_position" id="to_position" class="form-control select2" required>
                                <option value="">--- Please select position ---</option>
                                <?php foreach ($listPositions as $key => $value) : ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->position_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!-- move to main application-->
                    <div class="form-group">
                        <label for="to_main_app" class="col-md-3 label-heading">Main Application</label>
                        <div class="col-md-9 ui-front">
                            <select name="to_main_app[]" id="to_main_app" class="form-control select2" required onchange="changeMainAppTo('');">
                                <option value="">--- Please select main application ---</option>
                                <?php foreach ($listRequestTypes as $key => $value) : ?>
                                    <option value="<?php echo $value->id_request_type; ?>"><?php echo $value->request_type_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <!-- move to staff_profile_type-->
                    <div class="form-group">
                        <label for="to_staff_profile_type" class="col-md-3 label-heading">Staff Profile Type</label>
                        <div class="col-md-9 ui-front">
                            <select name="to_staff_profile_type[]" id="to_staff_profile_type" class="form-control select2" required>
                            </select>
                        </div>
                    </div>
                    <!-- move to function-->
                    <div class="form-group">
                        <label for="to_function" class="col-md-3 label-heading">Select function</label>
                        <div class="col-md-9 ui-front">
                            <select name="to_function[][0]" id="to_function" multiple class="form-control select2" required>
                            </select>
                        </div>
                    </div>
                    <!-- show button remove and add form -->
                    <div class="form-group" id="addMainAppTo">
                        <label for="function" class="col-md-3 label-heading"></label>
                        <div class="col-md-9 ui-front">
                            <!-- button add form -->
                            <!-- button remove form -->
                            <a href="javascript:void(0)" title="Add Form" onclick="addMainAppTo();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                    </div>

                    <!-- append main app to here -->
                    <div class="append-form-to"></div>
                </div>
            </div>
            <!-- End Move To -->

            <!-- upload files -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <legend id="label-cusinfo"><?php echo lang("ctn_436") ?></legend>
                    <div id="file_block">
                        <div class="form-group">
                            <label for="p-in" class="col-md-3 label-heading">Select Files</label>
                            <div class="col-md-9">
                                <input type="file" name="files[]" class="form-control" multiple>
                                <mark id="emailHelp" class="form-text text-muted"><kbd>Allow: <?php echo $this->settings->info->file_types; ?></kbd></mark>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="description" class="col-md-3 label-heading"> Description </label>
                                <div class="col-md-9 ui-front">
                                    <textarea name="description" class="form-control" id="description"></textarea>
                                </div>
                            </div>
                    </div>
                    <hr>
                </div>
            </div>
            <!-- end upload files -->

            <!-- approval blog  -->                   
               <?php $this->load->view('approval/form_request'); ?>
            <!-- end approval  -->

            <!-- button action -->
            <div class="text-center">
                <?php if($this->authorization->hasPermission($moduleName, "create")): ?>
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("save") ?></button> 
                <?php endif; ?>
                <a href="<?php echo base_url('userMoveRequest'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
            </div>
            <!-- end button -->
            
        <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $('.select2').select2();
    var baseURL = "<?php echo site_url(); ?>userMoveRequest";
    var allfilesname =  'file';

    // SELECT USER ID THAN APPEND THE SUB
    $('#user_id').on('change', function(){
        var userID = $(this).val();

        if (userID){
            $.ajax({
                type: 'get',
                url: global_base_url+'/userMoveRequest/findUser',
                data: 'userID=' + userID,
                dataType: 'Json',
                success: function (response)
                {
                    $('#phone').val(response['phone_number']);
                    $('#username').val(response['first_name'] + " " + response['last_name']);
                    $('select[name="branch"]').val(response['branch']).trigger('change');
                    $('select[name="department"]').val(response['department_id']).trigger('change');
                    $('select[name="position"]').val(response['position_id']).trigger('change');

                    /* move from */
                    $('select[name="from_branch"]').val(response['branch']).trigger('change');
                    $('select[name="from_department"]').val(response['department_id']).trigger('change');
                    $('select[name="from_position"]').val(response['position_id']).trigger('change');
                    
                    var manager_id = response['manager_id'];
                    $.ajax({
                        type: 'get',
                        url: global_base_url+'/userMoveRequest/findUser',
                        data: 'userID=' + manager_id,
                        dataType: 'Json',
                        success: function (data){
                            if(data){
                                $('#manager_name').val(data['first_name'] + " " + data['last_name']);
                                $('#ext').val(data['phone_number']);
                                $('#manager_id').val(data['staff_id']);
                            }else{
                                $('#manager_name').val('');
                                $('#ext').val('');
                                $('#manager_id').val('');
                            }
                        }
                    });

                    $.ajax({
                        type: 'get',
                        url: global_base_url+'/userMoveRequest/findUserMainApp',
                        data: 'userID=' + userID,
                        dataType: 'Json',
                        success: function (response){
                            $('.append-form-from').html('');
                            if(response.length > 0){
                                $.each(response,function(i, data){
                                    $.ajax({
                                        type: 'get',
                                        url: global_base_url+'/userMoveRequest/findRequestType',
                                        data:{
                                            'request_type': data.request_type_id,
                                            'profile_type': data.staff_profile_type_id,
                                            'functionalities': data.functionalities
                                        },
                                        dataType: 'Json',
                                        success: function (output){
                                            if(output){
                                                var requestType = output.request_type;
                                                var staffProfileType = output.profile_type;
                                                var funcs = output.functions;
                                                var option = '';

                                                $.each(funcs, function(j, funs){
                                                    option += '<option value="'+funs.id+'" selected>'+funs.name+'</option>';
                                                });

                                                var hr = '';
                                                if(i>0){
                                                    hr = '<hr/>';
                                                }

                                                var formFrom = hr+'<!-- move from main application-->'+
                                                '<div class="form-group">'+
                                                    '<label for="from_main_app'+i+'" class="col-md-3 label-heading">Main Application</label>'+
                                                    '<div class="col-md-9 ui-front">'+
                                                        '<select name="from_main_app[]" id="from_main_app'+i+'" class="form-control select2" onchange="changeMainAppFrom('+i+')" required>'+
                                                            '<option value="'+data.request_type_id+'">'+requestType+'</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<!-- move from staff_profile_type-->'+
                                                '<div class="form-group">'+
                                                    '<label for="from_staff_profile_type'+i+'" class="col-md-3 label-heading">Staff Profile Type</label>'+
                                                    '<div class="col-md-9 ui-front">'+
                                                        '<select name="from_staff_profile_type[]" id="from_staff_profile_type'+i+'" class="form-control select2" required>'+
                                                            '<option value="'+data.staff_profile_type_id+'">'+staffProfileType+'</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<!-- move from function-->'+
                                                '<div class="form-group">'+
                                                    '<label for="from_function'+i+'" class="col-md-3 label-heading">Select function</label>'+
                                                    '<div class="col-md-9 ui-front">'+
                                                        '<select name="from_function[][0]" id="from_function'+i+'" multiple class="form-control select2" required>'+
                                                        option+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>';
                                                $('.append-form-from').append(formFrom);
                                                $('.select2').select2();
                                            }
                                        }
                                    });
                                });
                            }else{
                                var len = 0;
                                var formFrom = '<!-- move from main application-->'+
                                                '<div class="form-group">'+
                                                    '<label for="from_main_app'+len+'" class="col-md-3 label-heading">Main Application</label>'+
                                                    '<div class="col-md-9 ui-front">'+
                                                        '<select name="from_main_app[]" id="from_main_app'+len+'" class="form-control select2" onchange="changeMainAppFrom('+len+')" required>'+
                                                            '<option value="">--- Please select main application ---</option>'+
                                                            '<?php foreach ($listRequestTypes as $key => $value) : ?>'+
                                                                '<option value="<?php echo $value->id_request_type; ?>"><?php echo $value->request_type_name; ?></option>'+
                                                            '<?php endforeach ?>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<!-- move from staff_profile_type-->'+
                                                '<div class="form-group">'+
                                                    '<label for="from_staff_profile_type'+len+'" class="col-md-3 label-heading">Staff Profile Type</label>'+
                                                    '<div class="col-md-9 ui-front">'+
                                                        '<select name="from_staff_profile_type[]" id="from_staff_profile_type'+len+'" class="form-control select2" required>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<!-- move from function-->'+
                                                '<div class="form-group">'+
                                                    '<label for="from_function'+len+'" class="col-md-3 label-heading">Select function</label>'+
                                                    '<div class="col-md-9 ui-front">'+
                                                        '<select name="from_function[][0]" id="from_function'+len+'" multiple class="form-control select2" required>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<!-- show button remove and add form -->'+
                                                '<div class="form-group" id="addMainAppFrom">'+
                                                    '<label for="function" class="col-md-3 label-heading"></label>'+
                                                    '<div class="col-md-9 ui-front">'+
                                                        '<!-- button add form -->'+
                                                        '<!-- button remove form -->'+
                                                        '<a href="javascript:void(0)" title="Add Form" onclick="addMainAppFrom();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>'+
                                                    '</div>'+
                                                '</div>';
                                $('.append-form-from').append(formFrom);
                                $('.select2').select2();
                            }
                        }
                    });
                }
            });
        }
    });

    /* On change duration move */
        $('#duration_move').on('change',function(){
            var duration = $(this).val();
            if(duration == 'temporary'){
                $('#from_date').removeAttr('disabled');
                $('#to_date').removeAttr('disabled');
            }else{
                $('#from_date').attr('disabled','disabled');
                $('#to_date').attr('disabled','disabled');
            }
        });
        // datepicker
          $(function () {
            $("#from_date").datepicker({ 
              dateFormat: 'yy-mm-dd',
              onClose: function(dfr){
                // set minDate to from
                $("#to_date").datepicker("option", "minDate", dfr);
              }
            });
          });
          $(function () {
            $("#to_date").datepicker({ 
              dateFormat: 'yy-mm-dd',
            });
          });
    /* End on change duration move */
</script>

<!-- FILE -->
<script>
    //----- UPLOAD MUTIPLE FILES------
    function handleFileSelect(evt){
        var files = evt.target.files; // FileList object
        var pdf = 0, doc = 0, xls = 0;
        var p = 0, d = 0, x = 0;
        for (var k = 0; k < files.length; k++) {//Preview only file extension
            var extension = files[k]['name'].substr(files[k]['name'].length - 4, 3);
            var url = '<?php echo base_url(); ?>';
            var span = document.createElement('span');
            if (extension == 'doc') {//preview file word
                span.innerHTML = ['<img class="thumb" id="doc-' + doc++ + '" onclick="remove_file(' + "'doc-" + d++ + "'" + ',' + "'" + escape(files[k]['name']) + "'" + ')" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', url + 'images/word.png',
                    '" title="', escape(files[k]['name']), '"/>'].join('');
            } else if (extension == 'csv') {//preview file excel
                span.innerHTML = ['<img class="thumb" id="xls-' + xls++ + '" onclick="remove_file(' + "'xls-" + x++ + "'" + ',' + "'" + escape(files[k]['name']) + "'" + ')" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', url + 'images/excel.ico',
                    '" title="', escape(files[k]['name']), '"/>'].join('');
            } else if (extension == '.pd') {//preview file pdf
                span.innerHTML = ['<img class="thumb" id="pdf-' + pdf++ + '" onclick="remove_file(' + "'pdf-" + p++ + "'" + ',' + "'" + escape(files[k]['name']) + "'" + ')" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', url + 'images/pdf.png',
                    '" title="', escape(files[k]['name']), '"/>'].join('');
            }
            document.getElementById('list').insertBefore(span, null);
        }
        // Loop through the FileList and render image files as thumbnails.
        var kk = 0;
        var jj = 0;
        for (var i = 0, f; f = files[i]; i++) {//Preview only Image extension
            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" id="pic-' + kk++ + '" onclick="remove_file(' + "'pic-" + jj++ + "'" + ',' + "'" + escape(theFile.name) + "'" + ')" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);
            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
    //Append multiple input type file
    function files_input(classname, num) {
        $('#' + classname).hide();
        var no = num + 1;
        var files = 'files' + no;
        $('.cover-filename').append('<input type="file" placeholder="Attached Name" id="' + files + '"' +
                'name="files[]" class="form-control" onchange="files_input(' + "'" + files + "'" + ',' + no + ')" autocomplete="off" multiple="multiple">');
        document.getElementById(files).addEventListener('change', handleFileSelect, false);
    }
    //Remove specifig file while upload 
    var data_num = 0;
    function remove_file(idname, filename){
        if (confirm('Are you sure remove this file?')) {
            var num = data_num += 1;
            $('.thumb').attr('data' + num, filename);
            var allfiles = new Array();
            var no = 1;
            for (var i = 0; i < num; i++) {
                allfiles[i] = $('.thumb').attr('data' + no++);
            }
            var s = "";
            for (var ss in allfiles) {
                s += allfiles[ss] + "___";
            }
            allfilesname = s;//pass allfilename to function save()
            $("#file_deleted").val(allfilesname);
            console.log($('input[name="file_deleted"]').val());
            $('#' + idname).remove();
        }
    }

    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>

<script>
    /**** MAIN APP FROM *****/
    // CHANGE RQUEST TYPE AND RELOAD SUB
    function changeMainAppFrom(num){
        var appid = $('#from_main_app'+num).val();
        if (appid) {
            $.ajax({
                url: global_base_url+'userMoveRequest/getFunctions',
                type: 'get',
                data: 'app_id=' + appid,
                success: function (response) {
                    $('#from_function'+num).html(response);
                }
            });
        } else {
            $("#from_function").html("<option value=''>---Select Functionalities---</option>");
        }
        if(appid){
            $.ajax({
                type: 'get',
                url: global_base_url+'userMoveRequest/getStaffProfileType',
                data: 'app_id=' + appid,
                success: function (html) {
                    $('#from_staff_profile_type'+num).html(html);
                }
            });
        }else {
            $("#from_staff_profile_type"+num).html("<option value=''>---Select Staff Profile Type*---</option>");
        }
    }
    // APPEND MULITPLE MAIN APP TO
    var numfrom = 0;
    function addMainAppFrom() {
        numfrom += 1;
        if (numfrom <= 10) {
            var formMoveFrom = '<hr><div id="removeAppendFrom'+numfrom+'">' +
                            '<!-- move to main application-->'+
                            '<div class="form-group">'+
                                '<label for="from_main_app'+numfrom+'" class="col-md-3 label-heading">Main Application</label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<select name="from_main_app[]" onchange="changeMainAppFrom('+numfrom+')" id="from_main_app'+numfrom+'" class="form-control select2" required>'+
                                        '<option value="">--- Please select main application ---</option>'+
                                        '<?php foreach ($listRequestTypes as $key => $value) : ?>'+
                                        '<option value="<?php echo $value->id_request_type; ?>"><?php echo $value->request_type_name; ?></option>'+
                                        '<?php endforeach ?>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                            '<!-- move to staff_profile_type-->'+
                            '<div class="form-group">'+
                                '<label for="from_staff_profile_type'+numfrom+'" class="col-md-3 label-heading">Staff Profile Type</label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<select name="from_staff_profile_type[]" id="from_staff_profile_type'+numfrom+'" class="form-control select2" required>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                            '<!-- move to function-->'+
                            '<div class="form-group">'+
                                '<label for="from_function" class="col-md-3 label-heading">Select function</label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<select name="from_function[]['+numfrom+']" id="from_function'+numfrom+'" multiple class="form-control select2" required>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+

                            '<!-- show button remove and add form -->'+
                            '<div class="form-group">'+
                                '<label for="function" class="col-md-3 label-heading"></label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<!-- button add form -->'+
                                    '<a href="javascript:void(0)" title="Remove Form" onclick="removeAppendFrom('+numfrom+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                    '<!-- button remove form -->'+
                                    ' <a href="javascript:void(0)" title="Add Form" onclick="addMainAppFrom();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

            $('.append-form-from').append(formMoveFrom);
            $('.select2').select2();
        } else {
            alert("You can add only 10 main application ! Please contact administrator to add more");
        }
    }
    // REMOVE REQUEST TYPE THAT APPENDED
    function removeAppendFrom(num){
        $('#removeAppendFrom'+num).remove();
    }
</script>

<script>
    /**** MAIN APP TO *****/
    // CHANGE RQUEST TYPE AND RELOAD SUB
    function changeMainAppTo(num){
        $(this).remove();
        var appid = $('#to_main_app'+num).val();
        if (appid) {
            $.ajax({
                url: global_base_url+'userMoveRequest/getFunctions',
                type: 'get',
                data: 'app_id=' + appid,
                success: function (response) {
                    $('#to_function'+num).html(response);
                }
            });
        } else {
            $("#to_function").html("<option value=''>---Select Functionalities---</option>");
        }
        if(appid){
            $.ajax({
                type: 'get',
                url: global_base_url+'userMoveRequest/getStaffProfileType',
                data: 'app_id=' + appid,
                success: function (html) {
                    $('#to_staff_profile_type'+num).html(html);
                }
            });
        }else {
            $("#to_staff_profile_type"+num).html("<option value=''>---Select Staff Profile Type*---</option>");
        }
    }
    // APPEND MULITPLE MAIN APP TO
    var numto = 0;
    function addMainAppTo(){
        numto += 1;
        if (numto <= 10) {
            var formMoveTo = '<hr><div id="removeAppendTo'+numto+'">' +
                            '<!-- move to main application-->'+
                            '<div class="form-group">'+
                                '<label for="to_main_app'+numto+'" class="col-md-3 label-heading">Main Application</label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<select name="to_main_app[]" onchange="changeMainAppTo('+numto+')" id="to_main_app'+numto+'" class="form-control select2" required>'+
                                        '<option value="">--- Please select main application ---</option>'+
                                        '<?php foreach ($listRequestTypes as $key => $value) : ?>'+
                                        '<option value="<?php echo $value->id_request_type; ?>"><?php echo $value->request_type_name; ?></option>'+
                                        '<?php endforeach ?>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                            '<!-- move to staff_profile_type-->'+
                            '<div class="form-group">'+
                                '<label for="to_staff_profile_type'+numto+'" class="col-md-3 label-heading">Staff Profile Type</label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<select name="to_staff_profile_type[]" id="to_staff_profile_type'+numto+'" class="form-control select2" required>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                            '<!-- move to function-->'+
                            '<div class="form-group">'+
                                '<label for="to_function" class="col-md-3 label-heading">Select function</label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<select name="to_function[]['+numto+']" id="to_function'+numto+'" multiple class="form-control select2" required>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+

                            '<!-- show button remove and add form -->'+
                            '<div class="form-group">'+
                                '<label for="function" class="col-md-3 label-heading"></label>'+
                                '<div class="col-md-9 ui-front">'+
                                    '<!-- button add form -->'+
                                    '<a href="javascript:void(0)" title="Remove Form" onclick="removeAppendTo('+numto+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                    '<!-- button remove form -->'+
                                    ' <a href="javascript:void(0)" title="Add Form" onclick="addMainAppTo();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

            $('.append-form-to').append(formMoveTo);
            $('.select2').select2();
        } else {
            alert("You can add only 10 main application ! Please contact administrator to add more");
        }
    }
    // REMOVE REQUEST TYPE THAT APPENDED
    function removeAppendTo(num){
        $('#removeAppendTo'+num).remove();
    }
</script>


