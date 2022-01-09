<!-- from add$link.  -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<div class="white-area-content animate-bottom">
    <!-- label header -->
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("float_advance").' '.lang("form"); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal")) ?>
                    <style type="text/css">
                        .borderless td, .borderless th {
                            border: none !important;
                        }
                    </style>
                    <table class="table borderless" style="border-spacing: 0 0px;">
                        <tbody>
                            <tr>
                                <!-- name -->
                                <th>
                                    <div class="col-md-12">
                                    <label class="label-heading" for="name">ឈ្មេាះ/Name: <sup class="text-danger">*</sup></label>
                                </div>
                                </th>
                                <td>
                                    <input class='form-control' type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" placeholder="<?php echo lang('name'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </td>
                                <!-- cell_phone -->
                                <th>
                                    <div class="col-md-12">
                                    <label class="label-heading" for="cell_phone">ទូរស័ព្ទដៃ/Cell Phone: <sup class="text-danger">*</sup></label>
                                </div>
                                </th>
                                <td>
                                    <div class="col-md-12">
                                    <input class='form-control' type="text" name="cell_phone" id="cell_phone" value="<?php echo set_value('cell_phone'); ?>" placeholder="<?php echo lang('cell_phone'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('cell_phone'); ?></span>
                                </div>
                                </td>
                                <!-- ref_no -->
                                <th>
                                    <div class="col-md-12">
                                    <label class="label-heading" for="ref_no">លេខរៀង/Ref No: <sup class="text-danger">*</sup></label>
                                </div>
                                </th>
                                 <td>
                                    <div class="col-md-12">
                                    <input class='form-control' type="text" name="ref_no" id="ref_no" value="<?php echo set_value('ref_no'); ?>" placeholder="<?php echo lang('ref_no'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('ref_no'); ?></span>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <!-- position -->
                                <th>
                                    <label class="label-heading" for="position">តួនាទី/Position: <sup class="text-danger">*</sup></label>
                                </th>
                                <td>
                                    <input class='form-control' type="text" name="position" id="position" value="<?php echo set_value('position'); ?>" placeholder="<?php echo lang('position'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('position'); ?></span>
                                </td>
                                <!-- div -->
                                <th>
                                    <label class="label-heading" for="div">ផ្នែក/Div: <sup class="text-danger">*</sup></label>
                                </th>
                                <td>
                                    <input class='form-control' type="text" name="div" id="div" value="<?php echo set_value('div'); ?>" placeholder="<?php echo lang('div'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('div'); ?></span>
                                </td>
                                <!-- r_id -->
                                <th>
                                    <label class="label-heading" for="r_id">កាលបរិច្ឆេទស្នើសុំ/R.Date: <sup class="text-danger">*</sup></label>
                                </th>
                                 <td>
                                    <input class='form-control' type="text" name="r_id" id="r_id" value="<?php echo set_value('r_id'); ?>" placeholder="<?php echo lang('r_id'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('r_id'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <!-- staff_id -->
                                <th>
                                    <label class="label-heading" for="staff_id">អត្តលេខ/ID: <sup class="text-danger">*</sup></label>
                                </th>
                                <td>
                                    <input class='form-control' type="text" name="staff_id" id="staff_id" value="<?php echo set_value('staff_id'); ?>" placeholder="<?php echo lang('ID'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('staff_id'); ?></span>
                                </td>
                                <!-- branch -->
                                <th>
                                    <label class="label-heading" for="branch">សាខា/Branch: <sup class="text-danger">*</sup></label>
                                </th>
                                <td>
                                    <input class='form-control' type="text" name="branch" id="branch" value="<?php echo set_value('branch'); ?>" placeholder="<?php echo lang('branch'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('branch'); ?></span>
                                </td>
                                <!-- deadline -->
                                <th>
                                    <label class="label-heading" for="deadline">កាលបរិច្ឆេទយក/Deadline: <sup class="text-danger">*</sup></label>
                                </th>
                                 <td>
                                    <input class='form-control' type="text" name="deadline" id="deadline" value="<?php echo set_value('deadline'); ?>" placeholder="<?php echo lang('deadline'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('deadline'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <!-- department -->
                                <th>
                                    <label class="label-heading" for="department">នាយកដ្ឋាន/Department: <sup class="text-danger">*</sup></label>
                                </th>
                                <td>
                                    <input class='form-control' type="text" name="department" id="department" value="<?php echo set_value('department'); ?>" placeholder="<?php echo lang('ID'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('department'); ?></span>
                                </td>
                                <!-- project -->
                                <th>
                                    <label class="label-heading" for="project">គំរោង/Project: <sup class="text-danger">*</sup></label>
                                </th>
                                <td>
                                    <input class='form-control' type="text" name="project" id="project" value="<?php echo set_value('project'); ?>" placeholder="<?php echo lang('project'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('project'); ?></span>
                                </td>
                                <!-- location -->
                                <th>
                                    <label class="label-heading" for="location">ទីតាំង/location: <sup class="text-danger">*</sup></label>
                                </th>
                                 <td>
                                    <input class='form-control' type="text" name="location" id="location" value="<?php echo set_value('location'); ?>" placeholder="<?php echo lang('location'); ?>" required/>
                                    <span class="text-danger"><?php echo form_error('location'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <!-- purpose -->
                                <th>
                                    <label class="label-heading" for="purpose">គោលបំណង/Purpose: <sup class="text-danger">*</sup></label>
                                </th>
                                <td>
                                    <textarea class="form-control" name="purpose" id="purpose" rows="1" required></textarea>
                                    <span class="text-danger"><?php echo form_error('purpose'); ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <!-- End  info  -->

                    <!-- attachement file -->
                    <legend><?php echo lang("attachment").' '.lang("files"); ?></legend>
                    <div id="file_block">
                        <div class="form-group">
                            <!-- files upload -->
                            <label class="col-md-2 label-heading" for="files">Attachment Files</label>
                            <div class="col-md-4 ui-front cover_attachment_files">
                                <input class='form-control files' type="file" id='attachment_files' name="attachment_files[]" value="<?php echo set_value('attachment_files[]'); ?>" onchange="files_input('attachment_files','')" multiple/>
                                <span class="text-danger"><?php echo form_error('attachment_files[]'); ?></span>       
                                <!-- name muse be like input file above -->
                                <input type="hidden" id="attachment_files_deleted" value="" name="attachment_files_deleted" class="form-control">
                            </div>   
                            <!-- file description -->
                            <label class="col-md-2 label-heading" for="attachment_files_description">Description: </label>
                            <div class="col-md-4 ui-front">
                                <textarea class="form-control" id="attachment_files_description" name="attachment_files_description" rows="1"><?php echo set_value('attachment_files_description'); ?></textarea>
                            </div>  
                        </div>
                        <!-- preview files -->
                        <style type="text/css">
                            .img-wrap {
                                position: relative;
                                display: inline-block;
                                /*border: 1px red solid;*/
                                font-size: 0;
                            }
                            .img-wrap .close {
                                position: absolute;
                                top: 2px;
                                right: 2px;
                                z-index: 100;
                                background-color: #FFF;
                                padding: 5px 2px 2px;
                                /*color: #000;*/
                                color: #d54d49;
                                font-weight: bold;
                                cursor: pointer;
                                opacity: .2;
                                text-align: center;
                                font-size: 22px;
                                line-height: 10px;
                                border-radius: 50%;
                            }
                            .img-wrap:hover .close {
                                opacity: 1;
                            }
                        </style>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <output id="list_attachment_files">
                                <?php var_dump($this->session->userdata('attachment_files_catch')); ?>
                                    <!-- if validation form false -->
                                    <?php 
                                        if($this->session->has_userdata('attachment_files_catch')):
                                            $pdf=0;$doc=0;$xls=0;
                                            $p=0;$d=0;$x=0;$kk=0;$jj=0;
                                            foreach ($this->session->userdata('attachment_files_catch') as $key => $file):
                                                $ext = substr($file['extension'], 0, 4);

                                                if ($ext == '.doc'):?>
                                                    <div class="img-wrap" id="catch_attachment_files-doc-<?php echo $doc++; ?>">
                                                        <span class="close" title="Delete" onclick="remove_file('catch_attachment_files-doc-<?php echo $d++; ?>','<?php echo $file['original_name']; ?>')">&times</span>
                                                        <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/word.png'); ?>" title="<?php echo $file['upload_file_name']; ?>"/>
                                                    </div>
                                                <?php elseif ($ext == '.xls'):?>
                                                    <div class="img-wrap" id="catch_attachment_files-xls-<?php echo $xls++; ?>">
                                                        <span class="close" title="Delete" onclick="remove_file('catch_attachment_files-xls-<?php echo $x++; ?>', '<?php echo $file['original_name']; ?>')">&times</span>
                                                        <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/excel.ico'); ?>" title="<?php echo $file['upload_file_name']; ?>"/>
                                                    </div>
                                                <?php elseif ($ext == '.pdf'):?>
                                                    <div class="img-wrap" id="pdf-<?php echo $pdf++; ?>">
                                                        <span class="close" title="Delete" onclick="remove_file('pdf-<?php echo $p++; ?>', '<?php echo $file['upload_file_name']; ?>')">&times</span>
                                                        <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/pdf.png'); ?>" title="<?php echo $file['upload_file_name']; ?>"/>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="img-wrap" id="catch_attachment_files-pic-<?php echo $kk++; ?>">
                                                        <span class="close" title="Delete" onclick="remove_file('catch_attachment_files-pic-<?php echo $jj++; ?>', '<?php echo $file['original_name']; ?>')">&times</span>
                                                        <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url().$file['file_path'].'/'.$file['upload_file_name']; ?>" title="<?php echo $file['upload_file_name']; ?>"/>
                                                    </div>
                                                <?php endif; 
                                            endforeach;
                                        endif;
                                    ?> 
                                </output>
                            </div>
                        </div>
                    </div>
                    <!-- end attachment file --> 
                                     
                    
                    <!-- button action -->
                    <div class="text-right">                    
                        <!-- button cancel -->
                        <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
                        <!-- button submit -->
                        <span id="submit_loader" style="display:none;"></span>
                        <button type="submit" id="btn-submit" class="btn btn-success" onclick="getElementById('submit_loader').style.display = 'block'"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_save") ?></button> 
                    </div>                
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/modal_confirm'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/address.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/simple.money.format.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/file_upload.js"></script>

<!-- preview files -->
<script type="text/javascript">
    document.getElementById('attachment_files').addEventListener('change', handleFileSelect, false);
</script>
<!-- co borrower -->
<script type="text/javascript">
    var num = <?php echo (!empty($this->input->post('co_borrower')) ? count($this->input->post('co_borrower'))-1 : 0); ?>;
    function addCoborrower(num=null) {
        num += 1;
        if (num <= 10) {
            var coborrower = '<div id="removeCoborrower'+num+'">'+
                            '<div class="form-group">'+
                                '<!-- co_borrower -->'+
                                '<label class="col-md-2 label-heading" for="co_borrower"><?php echo lang('customer'); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<select class="form-control select2" style="width:100%"data-live-search="true" name="co_borrower[]" id="co_borrower" required>'+
                                        '<option value="">--- select customer ---</option>'+
                                        '<?php if(!empty($customers)): ?>
                                            <?php foreach($customers as $customer):?>
                                                <option value="<?php echo $customer->id?>" <?php echo set_select('co_borrower', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('co_borrower'); ?></span>'+
                                '</div>'+
                                '<!-- relation_id -->'+
                                '<label class="col-md-2 label-heading" for="co_borrower_relation"><?php echo lang('relation_indicator'); ?></label>'+
                                '<div class="col-md-3 ui-front">'+
                                   '<select class="form-control select2" style="width:100%" data-live-search="true" name="co_borrower_relation[]" id="co_borrower_relation" required>'+
                                        '<option value="">--- select relation ---</option>'+
                                        '<?php if(!empty($relations)): ?>
                                            <?php foreach($relations as $row):?>
                                                <option value="<?php echo $row->id?>" <?php echo set_select('co_borrower_relation', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('co_borrower_relation'); ?></span>'+  
                                '</div>'+
                                '<label class="col-md-1 label-heading">'+
                                    '<!-- button add form -->'+
                                    '<a href="javascript:void(0)" title="Remove Form" onclick="removeCoborrower('+num+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                '</label>'+
                            '</div>'+
                        '</div>';

            $('.append-coborrower').append(coborrower);
            $('.select2').select2();
                
        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE REQUEST TYPE THAT APPENDED
    function removeCoborrower(num){
        $('#removeCoborrower'+num).remove();
    }    
</script>

<!-- guantor -->
<script type="text/javascript">
    var g = <?php echo (!empty($this->input->post('guarantor')) ? count($this->input->post('guarantor'))-1 : 0); ?>;
    function addGuarantor(g=null) {
        g += 1;
        if (g <= 10) {
            var coborrower = '<div id="removeGuarantor'+g+'">'+
                            '<div class="form-group">'+
                                '<!-- guarantor -->'+
                                '<label class="col-md-2 label-heading" for="guarantor"><?php echo lang('customer'); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<select class="form-control select2" style="width:100%"data-live-search="true" name="guarantor[]" id="guarantor'+g+'">'+
                                        '<option value="">--- select customer ---</option>'+
                                        '<?php if(!empty($customers)): ?>
                                            <?php foreach($customers as $customer):?>
                                                <option value="<?php echo $customer->id?>" <?php echo set_select('guarantor', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('guarantor'); ?></span>'+
                                '</div>'+
                                '<!-- relation_id -->'+
                                '<label class="col-md-2 label-heading" for="guarantor_relation"><?php echo lang('relation_indicator'); ?></label>'+
                                '<div class="col-md-3 ui-front">'+
                                   '<select class="form-control select2" style="width:100%" data-live-search="true" name="guarantor_relation[]" id="guarantor_relation">'+
                                        '<option value="">--- select relation ---</option>'+
                                        '<?php if(!empty($relations)): ?>
                                            <?php foreach($relations as $row):?>
                                                <option value="<?php echo $row->id?>" <?php echo set_select('guarantor_relation', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('guarantor_relation'); ?></span>'+  
                                '</div>'+
                                '<label class="col-md-1 label-heading">'+
                                    '<!-- button add form -->'+
                                    '<a href="javascript:void(0)" title="Remove Form" onclick="removeGuarantor('+g+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                '</label>'+
                            '</div>'+
                        '</div>';

            $('.append-guarantor').append(coborrower);
            $('.select2').select2();                

        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE REQUEST TYPE THAT APPENDED
    function removeGuarantor(g){
        $('#removeGuarantor'+g).remove();
    } 
</script>

<!-- fee charge -->
<script type="text/javascript">
    function feeOption(id){
        if($('#fee_option'+id).val() == 'YES'){            
            $('#fee_amount'+id).removeAttr('readonly').val('');
            $('#fee_description'+id).removeAttr('readonly').val('');
        }else{
            $('#fee_amount'+id).attr('readonly','readonly').val('');
            $('#fee_description'+id).attr('readonly','readonly').val('');
        }
    }
</script>

<!-- on change customer_id -->
<script type="text/javascript">
    $('#customer_id').on('change', function(){
        var customer_id = $(this).val();

        if(customer_id){
            // show collateral
            $.ajax({
                url: 'getCollateralByCustomerID/'+customer_id,
                type: 'get',
                success: function(collateral){
                    if(collateral){
                        $('#active-collateral').show();
                        $('#append_collateral_id').html('<!-- collateral_id -->'+
                            '<div class="form-group">'+
                                '<label class="col-md-2 label-heading" for="collateral_id"><?php echo lang('collateral'); ?></label>'+
                                '<div class="col-md-10 ui-front">'+
                                   '<select class="form-control select2" style="width:100%" data-live-search="true" name="collateral_id[]" id="collateral_id" multiple>'+
                                        '<option value="">--- select collateral ---</option>'+
                                        collateral+
                                    '</select>'+ 
                                '</div>'+
                            '</div>');
                        $('.select2').select2();
                    }else{
                        $('#active-collateral').hide();
                        $('#append_collateral_id').html('');
                    }
                }
            });

            // show spouse info
            $.ajax({
                url: 'findSpouseByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(spouse){ 
                    if(spouse){
                        $('#active-spouse').show();
                        $('#append_spouse').html('<!-- spouse info -->'+
                                    '<input class="form-control" type="hidden" name="spouse_id" value="'+spouse.spouse_id+'"/>'+
                                    '<fieldset id="spouse-info">'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_firstname_kh -->'+
                                    '                <label class="col-md-2 label-heading" for="spouse_firstname_kh"><?php echo lang("firstname_kh"); ?></label>'+
                                    '                <div class="col-md-4 ui-front">'+
                                    '                    <input class="form-control" type="text" value="'+spouse.spouse_firstname_kh+'"/>'+
                                    '                </div>'+
                                    '                <!-- spouse_lastname_kh -->'+
                                    '                <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang("lastname_kh"); ?></label>'+
                                    '                <div class="col-md-4 ui-front">'+
                                    '                    <input class="form-control" type="text" value="'+spouse.spouse_lastname_kh+'"/>'+
                                    '                </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_firstname_en -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_firstname_en"><?php echo lang("firstname_en"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control" type="text" value="'+spouse.spouse_firstname_en+'"/>'+
                                    '            </div>'+
                                    '            <!-- spouse_lastname_en -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_lastname_en"><?php echo lang("lastname_en"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control" type="text" value="'+spouse.spouse_lastname_en+'"/>'+
                                    '            </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_dob -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_dob"><?php echo lang("dob"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">                                    '+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_dob+'"/>   '+
                                    '            </div>'+
                                    '            <!-- spouse_nationality -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_nationality"><?php echo lang("nationality"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input type="text" class="form-control" value="'+spouse.nation_name_kh+'"/>    '+
                                    '            </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_occupation -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_occupation"><?php echo lang("occupation"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_occupation+'"/> '+
                                    '            </div>'+
                                    '            <!-- spouse_id_type -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_id_type"><?php echo lang("id_type"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input type="text" class="form-control" value="'+spouse.iden_name_kh+'"/>'+
                                    '                        '+
                                    '            </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_id_code -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_id_code"><?php echo lang("id_code"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_id_code+'"/>     '+
                                    '            </div> '+
                                    '            <!-- spouse_issue_date -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_issue_date"><?php echo lang("issue_date"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">                                    '+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_issue_date+'"/>     '+
                                    '            </div> '+
                                    '        </div>'+
                                    '</fieldset>'+
                                    '<!-- end spouse info -->');
                    }else{
                        $('#active-spouse').hide();
                        $('#append_spouse').html('');
                    }
                }
            });

            // show identification
            $.ajax({
                url: 'findIdentificationByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(identification){
                    if(identification){
                        var formIdentification = '';
                        $.each(identification, function(key, iden){
                            formIdentification += '<div id="removeIdentification">' +
                                        '<div class="form-group">'+
                                            '<!-- identification_type -->'+
                                            '<label class="col-md-2 label-heading" for="identification_type"><?php echo lang("id_type"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.iden_name_kh+'"/>'+
                                            '</div>'+
                                            '<!-- identification_code -->'+
                                            '<label class="col-md-2 label-heading" for="identification_code"><?php echo lang("id_code"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_code+'"/>'+
                                            '</div> '+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<!-- identification_issue_place -->'+
                                            '<label class="col-md-2 label-heading" for="identification_issue_place"><?php echo lang("issue_place"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_issue_place+'"/>'+
                                            '</div> '+
                                            '<!-- identification_issue_date -->'+
                                            '<label class="col-md-2 label-heading" for="identification_issue_date"><?php echo lang("issue_date"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_issue_date+'"/>'+
                                            '</div> '+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<!-- identification_expiry_date -->'+
                                            '<label class="col-md-2 label-heading" for="identification_expiry_date"><?php echo lang("expiry_date"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_expiry_date+'"/>'+
                                            '</div>'+
                                        '</div><hr>'+
                                    '</div>';
                        });
                        $('#active-identification').show();
                        $('#append_identification').html(formIdentification);
                    }else{
                        $('#active-identification').hide();
                        $('#append_identification').html('');
                    }
                }
            });

            // show contact address
            $.ajax({
                url: 'findContactByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(contact){
                    if(contact){
                        var formContact = '';
                        $.each(contact, function(key, con){
                            formContact += '<div id="removeContact">' +
                                                '<div class="form-group">'+
                                                    '<!-- country_id -->'+
                                                    '<label class="col-md-2 label-heading" for="country_id"><?php echo lang("country"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.country_name_kh+'"/>'+
                                                    '</div>'+
                                                    '<!-- province_id -->'+
                                                    '<label class="col-md-2 label-heading" for="province_id"><?php echo lang("province"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.province_name_kh+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- district_id -->'+
                                                    '<label class="col-md-2 label-heading" for="district_id"><?php echo lang("district"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.district_name_kh+'"/>'+
                                                    '</div>'+
                                                    '<!-- commune_id -->'+
                                                    '<label class="col-md-2 label-heading" for="commune_id"><?php echo lang("commune"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.commune_name_kh+'"/>'+
                                                    '</div>                            '+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- village_id -->'+
                                                    '<label class="col-md-2 label-heading" for="village_id"><?php echo lang("village"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.village_name_kh+'"/>'+
                                                    '</div>'+
                                                    '<!-- city -->'+
                                                    '<label class="col-md-2 label-heading" for="city"><?php echo lang("city"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.city+'"/>'+
                                                    '</div> '+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- house_no -->'+
                                                    '<label class="col-md-2 label-heading" for="house_no"><?php echo lang("house_no"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.house_no+'"/>'+
                                                    '</div> '+
                                                    '<!-- street -->'+
                                                    '<label class="col-md-2 label-heading" for="street"><?php echo lang("street"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.street+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- phone1 -->'+
                                                    '<label class="col-md-2 label-heading" for="phone1"><?php echo lang("phone1"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.phone1+'"/>'+
                                                    '</div> '+
                                                    '<!-- phone2 -->'+
                                                    '<label class="col-md-2 label-heading" for="phone2"><?php echo lang("phone2"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.phone2+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- email -->'+
                                                    '<label class="col-md-2 label-heading" for="email"><?php echo lang("email"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.email+'"/>'+
                                                    '</div> '+
                                                    '<!-- map_latitude -->'+
                                                    '<label class="col-md-2 label-heading" for="map_latitude"><?php echo lang("map_latitude"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.map_latitude+'"/>'+
                                                    '</div>                            '+
                                                '</div> '+
                                                '<div class="form-group">'+
                                                    '<!-- map_longitude -->'+
                                                    '<label class="col-md-2 label-heading" for="map_longitude"><?php echo lang("map_longitude"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.map_longitude+'"/>'+
                                                    '</div> '+
                                                '</div><hr>'+
                                            '</div>';
                        });
                        $('#active-contact').show();
                        $('#append_contact').html(formContact);
                    }else{
                        $('#active-contact').hide();
                        $('#append_contact').html('');
                    }
                }
            });

            // show contact address
            $.ajax({
                url: 'findEmploymentByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(employment){
                    console.log(employment);
                    if(employment){
                        var formEmployment = '';
                        $.each(employment, function(key, emp){
                            var emp_type = '';
                            if(emp.employment_type == 'C'){
                                emp_type = 'Current';
                            }else{
                                emp_type = 'Previouse';
                            }
                            var self_emp = '';
                            if(emp.self_employee == 'Y'){
                                self_emp = 'YES';
                            }else{
                                self_emp = 'NO';
                            }
                            formEmployment = '<div id="removeEmployment">' +
                                                    '<div class="form-group">'+
                                                        '<!-- employment_type -->'+
                                                        '<label class="col-md-2 label-heading" for="employment_type"><?php echo lang("employment_type"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp_type+'"/>'+
                                                        '</div>'+
                                                        '<!-- self_employee -->'+
                                                        '<label class="col-md-2 label-heading" for="self_employee"><?php echo lang("self_employee"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+self_emp+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- company_name -->'+
                                                        '<label class="col-md-2 label-heading" for="company_name"><?php echo lang("company_name"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.company_name+'"/>'+
                                                        '</div> '+
                                                        '<!-- empbusiness_type_id -->'+
                                                        '<label class="col-md-2 label-heading" for="empbusiness_type_id"><?php echo lang("business_type"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<select class="form-control">'+
                                                                '<option>'+emp.business_type_name_kh+'</option>'+
                                                            '</select>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- employer_name -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_name"><?php echo lang("employer_name"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_name+'"/>'+
                                                        '</div> '+
                                                        '<!-- emp_occupation -->'+
                                                        '<label class="col-md-2 label-heading" for="emp_occupation"><?php echo lang("occupation"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.emp_occupation+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- length_of_service -->'+
                                                        '<label class="col-md-2 label-heading" for="length_of_service"><?php echo lang("length_of_service"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.length_of_service+'"/>'+
                                                        '</div> '+
                                                        '<!-- employer_address_type -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_address_type"><?php echo lang("employer_address_type"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_address_type+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- employer_id -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_id"><?php echo lang("employer_id"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_id+'"/>'+
                                                        '</div>'+
                                                        '<!-- employer_country -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_country"><?php echo lang("country"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.country_name_kh+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">     '+
                                                        '<!-- employer_province -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_province"><?php echo lang("province"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.province_name_kh+'"/>'+
                                                        '</div>                       '+
                                                        '<!-- employer_district -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_district"><?php echo lang("district"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.district_name_kh+'"/>'+
                                                        '</div>                           '+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- employer_commune -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_commune"><?php echo lang("commune"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.commune_name_kh+'"/>'+
                                                        '</div> '+
                                                        '<!-- employer_village -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_village"><?php echo lang("village"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.village_name_kh+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">                            '+
                                                        '<!-- employer_houseno -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_houseno"><?php echo lang("house_no"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_houseno+'"/>'+
                                                        '</div> '+
                                                        '<!-- employer_street -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_street"><?php echo lang("street"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_street+'"/>'+
                                                        '</div>                           '+
                                                    '</div>    '+
                                                    '<div class="form-group">    '+
                                                        '<!-- employed_year -->'+
                                                        '<label class="col-md-2 label-heading" for="employed_year"><?php echo lang("employed_year"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employed_year+'"/>'+
                                                        '</div>                          '+
                                                        '<!-- employee_currency -->'+
                                                        '<label class="col-md-2 label-heading" for="employee_currency"><?php echo lang("currency"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.currency_name_kh+' ('+emp.currency_code+')"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- emplyee_salary -->'+
                                                        '<label class="col-md-2 label-heading" for="emplyee_salary"><?php echo lang("emplyee_salary"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input id="emplyee_salary" class="form-control"  type="text" value="'+emp.emplyee_salary+'"/>'+
                                                        '</div>'+
                                                    '</div><hr>'+
                                                '</div>';
                        });
                        $('#active-employment').show();
                        $('#append_employment').html(formEmployment);
                        $('#emplyee_salary').val($('#emplyee_salary').val().replace(".00", ''));
                        $('#emplyee_salary').simpleMoneyFormat();
                    }else{
                        $('#active-employment').hide();
                        $('#append_employment').html('');
                    }
                }
            });

        }else{
            var text = '<center>Please select customer first</center>';
            // hide collateral
            $('#active-collateral').hide();
            $('#append_collateral_id').html(text);
            // hide spouse info
            $('#active-spouse').hide();
            $('#append_spouse').html(text);
            // hide identification
            $('#active-identification').hide();
            $('#append_identification').html(text);
            // hide contact
            $('#active-contact').hide();
            $('#append_contact').html(text);
        }
        
    });
    $('#currency').on('change', function(){
        $.ajax({
            url: 'getCurrnecySign/'+$(this).val(),
            type: 'get',
            success: function(output){
                $('.currencysign').html(output);
            }
        });
        
    });
    $('#set_applied_amount').simpleMoneyFormat();
    $('#set_loan_amount').simpleMoneyFormat();
    $('#set_applied_amount').on({
        keyup: function(){
            $('#applied_amount').val($(this).val().replace(",", ''));
        }
    });
    $('#set_loan_amount').on({
        keyup: function(){
            $('#loan_amount').val($(this).val().replace(",", ''));
        }
    });

    $(function () {
        $("#application_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });

    $('.select2').select2();
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>

<!-- required form -->
<script type="text/javascript">
    $(document).ready(function(){
        //  check all field input that required
        $('form').find('input').each(function(){
            if ($(this).prop('required') && $(this).val() == "") {
               $('#btn-submit').prop('disabled', true);
               return false;
            }
        });
        //  check all field select required
        $('form').find('select').each(function(){
            if ($(this).prop('required') && $(this).val() == "") {
               $('#btn-submit').prop('disabled', true);
               return false;
            }
        });
        // check all fiedl required and remove text error element
        $('input').on({
            mouseleave: function(){
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all input
                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                // check all select option
                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""   ){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            },
            keyup: function(){
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });

                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            }
        });
        $('select').on('change', function(){
            $(this).next('span.text-danger').remove();
            $('#btn-submit').prop('disabled', false);
            // check all field input required
            $("input").each(function(){
               if ($(this).prop('required') && $(this).val() == ""){
                   $('#btn-submit').prop('disabled', true);
                   return false;
               }
            });
            // check all field select required
            $("select").each(function(){
                if($(this).prop('required') && $(this).val() == ''){
                    $('#btn-submit').prop('disabled', true);
                   return false;
                }
            });
        });
    });
</script>
