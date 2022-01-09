<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<style>
            @media print {
                a[href]:after {
                  content: none !important;
                }
              }
              table{
                  font-family: serif;
                  font-size: 14px;
              }
          </style>
<div class="white-area-content">
    <div id="printablediv" style="width: 100%; margin-top: : 0 auto;">
        <p style="text-align: center;"><img src="<?php echo base_url();?>images/ftblogo.png" width="120px"/><br/><br/>
            <b><?php echo lang('usermoverequest'); ?></b>
        </p>
        <?php 
        if(!empty($data)): ?>
            <table class="table well" border='1'>
                <tr>
                    <td colspan="4" style="text-align: center;" width="20%"><b>***Term Condition of System Access Right Request***</b><br/>
                        All system access is provided for official business of FTB Bank only. Any other use of this information may violate. 
                        Granted user must follow the IT Security Policy on Users Action and Responsibilities, Data Protection Procedure and 
                        any training guidelines. Unauthorized distribution, reproduction, modification or deletion of any applicant, employee 
                        or customer information outside the intended and approved use is strictly prohibited. Direct manager or supervisor need 
                        to fill-in this application form to request the user account for their subordinating staff who passed probation period 
                        and FTB Bank System Training. Any special condition upon acceptable reason and needed.<br/>
                        <b>Request No: <?php echo $data[0]->move_id;?></b>
                        <div id="spinningSquaresG" style="display: none">
                            <div id="spinningSquaresG_1" class="spinningSquaresG"></div>
                            <div id="spinningSquaresG_2" class="spinningSquaresG"></div>
                            <div id="spinningSquaresG_3" class="spinningSquaresG"></div>
                            <div id="spinningSquaresG_4" class="spinningSquaresG"></div>
                            <div id="spinningSquaresG_5" class="spinningSquaresG"></div>
                            <div id="spinningSquaresG_6" class="spinningSquaresG"></div>
                            <div id="spinningSquaresG_7" class="spinningSquaresG"></div>
                            <div id="spinningSquaresG_8" class="spinningSquaresG"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>BM or Manager's Name</b></td>
                    <?php $manager = getUserByStaffID($data[0]->manager_id); ?>
                    <td colspan="2">: <?php echo (!empty($manager) ? $manager->first_name.' '.$manager->last_name : 'NULL'); ?></td>
                    <td><b>Ext:</b> <?php echo (!empty($manager) ? $manager->ext : 'NULL'); ?></td>
                </tr>
                <tr>
                    <td><b>Branch</b></td>
                    <td colspan="2">: <?php echo getBranchName((!empty($manager) ? $manager->branch : 'NULL'));?></td>
                    <td><b>Department:</b> <?php echo getDepartmentName((!empty($manager) ? $manager->department_id : 'NULL')); ?></td>
                </tr>
                <tr>
                    <td><b>Duration Move</b></td>
                    <?php if($data[0]->duration_move == 'temporary'):?>
                        <td colspan="3">: <?php echo ucfirst($data[0]->duration_move);?> <span> &nbsp &nbsp <i class='glyphicon glyphicon-time'></i> From Date: <?php echo $data[0]->from_date;?> To date: <?php echo $data[0]->to_date;?></span></td>
                    <?php else: ?>
                        <td colspan="3">: <?php echo $data[0]->duration_move; ?></td>
                    <?php endif; ?>
                </tr>

                <!-- move from -->
                <tr>
                    <td><b>Move From</b></td>
                    <td colspan="3">
                        <table class="table borderless table-hover table-striped" style="border: none;">
                            <tr>
                                <td><b>Branch:</b> <?php echo getBranchName((!empty($data[0]) ? $data[0]->from_branch : 'NULL')); ?></td>
                                <td><b>Department:</b> <?php echo getDepartmentName((!empty($data[0]) ? $data[0]->from_department : 'NULL')); ?></td>
                                <td><b>Position:</b> <?php echo getPositionName((!empty($data[0]) ? $data[0]->from_position : 'NULL')); ?></td>
                            </tr>
                            <tr>
                                <th>Application Name</th>
                                <th>Role</th>
                                <th>Function Name</th>
                            </tr>
                            <?php     
                                if(!empty($data['appfrom'])){    
                                    foreach ($data['appfrom'] as $row){ ?>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-ok"></span> 
                                                <?php echo getRequestTypeName($row->request_type_id);?>
                                            </td>
                                            <td>    
                                                <?php echo getRequestTypeProfileName($row->staff_profile_type_id); ?>    
                                            </td>
                                            <td>
                                                <?php 
                                                    $funcs = explode(",", $row->functonalities);
                                                    if(!empty($funcs)):
                                                    foreach($funcs as $func){ ?>

                                                    :&nbsp &nbsp<span class="glyphicon glyphicon-check"></span>
                                                    <?php echo getFunctionName($func); ?><br/>

                                                 <?php }
                                                    endif;
                                                ?>
                                                
                                            </td>
                                        </tr>
                                    <?php
                                    }               
                                }
                            ?>
                        </table>
                    </td>
                </tr>
                <!-- end move from -->

                <!-- move to -->
                <tr>
                    <td><b>Move To</b></td>
                    <td colspan="3">
                        <table class="table borderless table-hover table-striped" style="border: none;">
                            <tr>
                                <td><b>Branch:</b> <?php echo getBranchName((!empty($data[0]) ? $data[0]->to_branch : 'NULL')); ?></td>
                                <td><b>Department:</b> <?php echo getDepartmentName((!empty($data[0]) ? $data[0]->to_department : 'NULL')); ?></td>
                                <td><b>Position:</b> <?php echo getPositionName((!empty($data[0]) ? $data[0]->from_position : 'NULL')); ?></td>
                            </tr>
                            <tr>
                                <th>Application Name</th>
                                <th>Role</th>
                                <th>Function Name</th>
                            </tr>
                            <?php     
                                if(!empty($data['appto'])){    
                                    foreach ($data['appto'] as $row){ ?>
                                    
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-ok"></span> 
                                                <?php echo getRequestTypeName($row->request_type_id);?>
                                            </td>
                                            <td>    
                                                <?php echo getRequestTypeProfileName($row->staff_profile_type_id); ?>    
                                            </td>
                                            <td>
                                                <?php 
                                                    $funcs = explode(",", $row->functonalities);
                                                    if(!empty($funcs)):
                                                    foreach($funcs as $func){ ?>

                                                    :&nbsp &nbsp<span class="glyphicon glyphicon-check"></span>
                                                    <?php echo getFunctionName($func); ?><br/>

                                                 <?php }
                                                    endif;
                                                ?>
                                                
                                            </td>
                                        </tr>
                                    <?php
                                    }               
                                }
                            ?>
                        </table>
                    </td>
                </tr>
                <!-- end move to -->

                <!-- request for -->
                <?php 
                    if(!empty($data[0])):
                        $user = getUserByID($data[0]->user_id);
                    endif;
                 ?>
                <tr>
                    <td rowspan="3"><b>Request For</b><br/>(Those users must kept their username and password in the most confident)</td>
                    <td colspan="3"> Name: <?php echo (!empty($user) ? $user->first_name.' '.$user->last_name : 'NULL'); ?></td>
                </tr>
                <tr>
                    <td width="35%"> Job title: <?php echo getPositionName((!empty($user) ? $user->position_id : 'NULL'));?></td>
                    <td width="35%" colspan="2"> Phone No: <?php echo (!empty($user) ? $user->phone_number : 'NULL');?></td>
                </tr>
                <tr>
                    <td colspan="3"> Description: <?php echo $data[0]->description;?></td>
                </tr>
                <!-- end request for -->

                <!-- files -->
                <tr>
                    <td>Attached File</td>
                    <td colspan="3">
                        <div class="col-md-9 ui-front">
                            <output id="list">

                                <?php if(!empty($data['files'])){ 
                                    foreach ($data['files'] as $key => $file) { 
                                        $path = $file->file_path.'/'.$file->upload_file_name;
                                        $extension = $file->extension;?>
                                        <!-- show file word -->
                                        <?php if($extension == '.doc' || $extension == '.docx'){ ?>
                                        <span>
                                            <a href="<?php echo base_url().$path; ?>" target="_blank">
                                                <img id="file-<?php echo $file->id; ?>" class="thumb" id="doc-" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/word.png'); ?>" title="<?php echo $file->original_name ?>"/>
                                            </a>
                                        </span>

                                        <!-- show file excel -->
                                        <?php }else if($extension == '.xls' || $extension == '.xlsx' || $extension == '.csv'){ ?>
                                        <span>
                                            <a href="<?php echo base_url().$path; ?>" target="_blank">
                                                <img id="file-<?php echo $file->id; ?>" class="thumb" id="doc-" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/excel.ico'); ?>" title="<?php echo $file->original_name ?>"/>
                                            </a>
                                        </span>

                                        <!-- show file pdf -->
                                        <?php }else if($extension == '.pdf'){ ?>
                                        <span>
                                            <a href="<?php echo base_url().$path; ?>" target="_blank">
                                                <img id="file-<?php echo $file->id; ?>" class="thumb" id="doc-" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/pdf.png'); ?>" title="<?php echo $file->original_name ?>"/>
                                            </a>
                                        </span>

                                        <!-- show photos, gif.. -->
                                        <?php }else{ ?>
                                        <span>
                                            <a href="<?php echo base_url().$path; ?>" target="_blank">
                                                <img id="file-<?php echo $file->id; ?>" class="thumb" id="doc-" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url().$path; ?>" title="<?php echo $file->original_name ?>"/>
                                            </a>
                                        </span>
                                        <?php } ?>
                                <?php } 
                                }?>
                            </output>
                        </div>
                    </td>
                </tr>
                <!-- end files -->

                <!-- show status approval -->
                <?php 
                    $result['data'] = array('module_id'=>$data[0]->module_id, 'record_id'=>$data[0]->record_id); 
                    $this->load->view('approval/signature', $result); 
                ?>
                <!-- end status approval -->
            </table>
        <?php endif; ?>
    </div>

    <!-- approval blog  -->  
        <?php 
            $hasApproval = $this->approval->hasApproval($data[0]->authorize_id);
            if($hasApproval):    
                $output['approval'] = $hasApproval;
                $this->load->view('approval/form_approve', $output); 
            else: ?>
                <div class="text-center">
                    <!-- button print -->
                    <button class="btn btn-primary" onclick="javascript:printDiv('printablediv')"><i class="glyphicon glyphicon-print"></i> Print</button>
                    <!-- button cancel -->
                    <a href="<?php echo base_url('userMoveRequest'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
                </div>
        <?php endif; ?>
    <!-- end approval  -->
    
</div>

<script>    
    $('.select2').select2();

    function authorize(status){
        var accessId = "<?php echo $_GET['id']; ?>";
        if(confirm('Are you sure you want to authorize this form request?'))
        {
            $.ajax({
                url : global_base_url+'/userMoveRequest/authorize/'+status,
                type: 'GET',  
                data : {'id' : accessId},  
                dataType: 'json',
                beforeSend: function () {
                    $('#btn-authorize').attr('disabled','disabled');
                    $('#btn-authorize').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                },
                success: function(response){
                    // alert('Congratulation, your transaction has been successful!');
                    $("#alert-success").fadeTo(8000, 8000).slideUp(500, function(){
                        $("#alert-success").alert('close');
                        window.location.href = '<?php echo base_url();?>userMoveRequest'; 
                    });                
                },
                error: function(data){
                   $("#alert-error").fadeTo(10000, 10000).slideUp(500, function(){
                        $("#alert-error").alert('close');
                    });
                }
            });
        }
    }

</script>
<script language="javascript" type="text/javascript">
    $('.select2').select2();
    function printDiv(divID) {
        var accessId = "<?php echo $_GET['id']; ?>";
        window.open(global_base_url+'/userMoveRequest/print?id='+accessId, '_blank');
    }

    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>
