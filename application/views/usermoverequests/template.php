<html>
    <head>
        <title>Access Right Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
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
        <style type="text/css">
    #spinningSquaresG{
        position:relative;
        width:234px;
        height:28px;
        margin:auto;
    }
    input.invalid, textarea.invalid{
        border: 2px solid red;
    }
    .spinningSquaresG{
        position:absolute;
        top:0;
        background-color:rgb(0,0,0);
        width:28px;
        height:28px;
        animation-name:bounce_spinningSquaresG;
        -o-animation-name:bounce_spinningSquaresG;
        -ms-animation-name:bounce_spinningSquaresG;
        -webkit-animation-name:bounce_spinningSquaresG;
        -moz-animation-name:bounce_spinningSquaresG;
        animation-duration:1.5s;
        -o-animation-duration:1.5s;
        -ms-animation-duration:1.5s;
        -webkit-animation-duration:1.5s;
        -moz-animation-duration:1.5s;
        animation-iteration-count:infinite;
        -o-animation-iteration-count:infinite;
        -ms-animation-iteration-count:infinite;
        -webkit-animation-iteration-count:infinite;
        -moz-animation-iteration-count:infinite;
        animation-direction:normal;
        -o-animation-direction:normal;
        -ms-animation-direction:normal;
        -webkit-animation-direction:normal;
        -moz-animation-direction:normal;
        transform:scale(.3);
        -o-transform:scale(.3);
        -ms-transform:scale(.3);
        -webkit-transform:scale(.3);
        -moz-transform:scale(.3);
    }

    #spinningSquaresG_1{
        left:0;
        animation-delay:0.6s;
        -o-animation-delay:0.6s;
        -ms-animation-delay:0.6s;
        -webkit-animation-delay:0.6s;
        -moz-animation-delay:0.6s;
    }

    #spinningSquaresG_2{
        left:29px;
        animation-delay:0.75s;
        -o-animation-delay:0.75s;
        -ms-animation-delay:0.75s;
        -webkit-animation-delay:0.75s;
        -moz-animation-delay:0.75s;
    }

    #spinningSquaresG_3{
        left:58px;
        animation-delay:0.9s;
        -o-animation-delay:0.9s;
        -ms-animation-delay:0.9s;
        -webkit-animation-delay:0.9s;
        -moz-animation-delay:0.9s;
    }

    #spinningSquaresG_4{
        left:88px;
        animation-delay:1.05s;
        -o-animation-delay:1.05s;
        -ms-animation-delay:1.05s;
        -webkit-animation-delay:1.05s;
        -moz-animation-delay:1.05s;
    }

    #spinningSquaresG_5{
        left:117px;
        animation-delay:1.2s;
        -o-animation-delay:1.2s;
        -ms-animation-delay:1.2s;
        -webkit-animation-delay:1.2s;
        -moz-animation-delay:1.2s;
    }

    #spinningSquaresG_6{
        left:146px;
        animation-delay:1.35s;
        -o-animation-delay:1.35s;
        -ms-animation-delay:1.35s;
        -webkit-animation-delay:1.35s;
        -moz-animation-delay:1.35s;
    }

    #spinningSquaresG_7{
        left:175px;
        animation-delay:1.5s;
        -o-animation-delay:1.5s;
        -ms-animation-delay:1.5s;
        -webkit-animation-delay:1.5s;
        -moz-animation-delay:1.5s;
    }

    #spinningSquaresG_8{
        left:205px;
        animation-delay:1.64s;
        -o-animation-delay:1.64s;
        -ms-animation-delay:1.64s;
        -webkit-animation-delay:1.64s;
        -moz-animation-delay:1.64s;
    }



    @keyframes bounce_spinningSquaresG{
        0%{
            transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            transform:scale(.3) rotate(90deg);
            background-color:rgb(255,255,255);
        }
    }

    @-o-keyframes bounce_spinningSquaresG{
        0%{
            -o-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -o-transform:scale(.3) rotate(90deg);
            background-color:rgb(255,255,255);
        }
    }

    @-ms-keyframes bounce_spinningSquaresG{
        0%{
            -ms-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -ms-transform:scale(.3) rotate(90deg);
            background-color:rgb(255,255,255);
        }
    }

    @-webkit-keyframes bounce_spinningSquaresG{
        0%{
            -webkit-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -webkit-transform:scale(.3) rotate(90deg);
            background-color:rgb(255,255,255);
        }
    }

    @-moz-keyframes bounce_spinningSquaresG{
        0%{
            -moz-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -moz-transform:scale(.3) rotate(90deg);
            background-color:rgb(255,255,255);
        }
    }
</style>
        <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
    </script>
    </head>
    <body>
    <div id="printablediv" style="width: 100%; margin-top: : 0 auto;">
        <p style="text-align: center;"><img src="<?php echo base_url();?>images/ftblogo.png" width="120px"/><br/><br/>
            <b><?php echo lang('usermoverequest'); ?></b>
        </p>
        <?php 
        if(!empty($data)){ ?>
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
                        <table class="table borderless table-hover table-striped" style="border: none;width: 100%">
                            <tr>
                                <td><b>Branch:</b> <?php echo getBranchName((!empty($data[0]) ? $data[0]->from_branch : 'NULL')); ?></td>
                                <td><b>Department:</b> <?php echo getDepartmentName((!empty($data[0]) ? $data[0]->from_department : 'NULL')); ?></td>
                                <td><b>Position:</b> <?php echo getPositionName((!empty($data[0]) ? $data[0]->from_position : 'NULL')); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align:left">Application Name</th>
                                <th style="text-align:left">Role</th>
                                <th style="text-align:left">Function Name</th>
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
                        <table class="table borderless table-hover table-striped" style="border: none;width: 100%">
                            <tr>
                                <td><b>Branch:</b> <?php echo getBranchName((!empty($data[0]) ? $data[0]->to_branch : 'NULL')); ?></td>
                                <td><b>Department:</b> <?php echo getDepartmentName((!empty($data[0]) ? $data[0]->to_department : 'NULL')); ?></td>
                                <td><b>Position:</b> <?php echo getPositionName((!empty($data[0]) ? $data[0]->to_position : 'NULL')); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align:left">Application Name</th>
                                <th style="text-align:left">Role</th>
                                <th style="text-align:left">Function Name</th>
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
                
                <!-- show status approval -->
                <?php 
                    $result['data'] = array('module_id'=>$data[0]->module_id, 'record_id'=>$data[0]->record_id); 
                    $this->load->view('approval/signature', $result); 
                ?>
                <!-- end status approval -->
            </table>
        <?php } ?>
    </div>
        
    <div class="text-center" style="width: 85%; margin: 20 auto; text-align: center;">
        <input type="button" class="btn btn-primary" value="Print" onclick="javascript:printDiv('printablediv')" />
    </div>
    </body>
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
</html>
<script type="text/javascript">
    window.onafterprint=function(){
        var moveId = "<?php echo $_GET['id']; ?>";
        window.location.href = global_base_url+'/usermoverequest/print?id='+moveId;
    };
</script>