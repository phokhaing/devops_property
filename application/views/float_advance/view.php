<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b>
            <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

</style>
<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span>
            <?php echo lang("view").' '.lang('float_advance'); ?></div>
        <div class="db-header-extra">
        </div>
    </div>
    <div class="panel panel-default">
        <!-- <div class="panel-heading">
            ref no: <b><?php echo $data->ref_no; ?></b>
        </div>  -->
        <div class="panel-body" id="print_content">
            <div class="form-horizontal" id="change_content">
                <!-- show data -->
                <style type="text/css">
                .borderless td,
                .borderless th {
                    border: none !important;
                }
                </style>
                <table class="table borderless" style="border-spacing: 0 0px;">
                    <tbody>
                        <tr>
                            <!-- name -->
                            <th>ឈ្មេាះ/Name<span class="pull-right">:</span></th>
                            <td><?php echo getUserFullName($data->name); ?></td>
                            <!-- cell_phone -->
                            <th>ទូរស័ព្ទដៃ/Cell Phone<span class="pull-right">:</span></th>
                            <td><?php echo $data->cell_phone; ?></td>
                            <!-- ref_no -->
                            <th>លេខរៀង/Ref No<span class="pull-right">:</span></th>
                            <td><?php echo $data->ref_no; ?></td>
                        </tr>
                        <tr>
                            <!-- position -->
                            <th>តួនាទី/Position<span class="pull-right">:</span></th>
                            <td><?php echo getPositionName($data->position); ?></td>
                            <!-- div -->
                            <th>ផ្នែក/Div<span class="pull-right">:</span></th>
                            <td><?php echo getDivisionName($data->div); ?></td>
                            <!-- r_id -->
                            <th>កាលបរិច្ឆេទស្នើសុំ/R.Date<span class="pull-right">:</span></th>
                            <td><?php echo date('d-m-Y', strtotime($data->r_date)); ?></td>
                        </tr>
                        <tr>
                            <!-- staff_id -->
                            <th>អត្តលេខ/ID<span class="pull-right">:</span></th>
                            <td><?php echo $data->staff_id; ?></td>
                            <!-- branch -->
                            <th>សាខា/Branch<span class="pull-right">:</span></th>
                            <td><?php echo getBranchName($data->branch); ?></td>
                            <!-- deadline -->
                            <th>កាលបរិច្ឆេទយក/Deadline<span class="pull-right">:</span></th>
                            <td><?php echo date('d-m-Y', strtotime($data->deadline)); ?></td>
                        </tr>
                        <tr>
                            <!-- department -->
                            <th>នាយកដ្ឋាន/Department<span class="pull-right">:</span></th>
                            <td><?php echo getDepartmentName($data->department); ?></td>
                            <!-- project -->
                            <th>គំរោង/Project<span class="pull-right">:</span></th>
                            <td><?php echo findProjectName($data->project); ?></td>
                            <!-- location -->
                            <th>ទីតាំង/location<span class="pull-right">:</span></th>
                            <td><?php echo $data->location; ?></td>
                        </tr>
                        <tr>
                            <!-- staff_request -->
                            <th>បុគ្គលិកស្នើសុំ/Staff Request<span class="pull-right">:</span></th>
                            <td><?php echo getUserFullName($data->staff_request); ?></td>
                            <!-- bank_account -->
                            <th>Bank Account<span class="pull-right">:</span></th>
                            <td><?php echo $data->bank_account; ?></td><!-- reference -->
                            <th><?php echo lang('reference');?><span class="pull-right">:</span></th>
                            <td><?php echo $data->reference; ?></td>
                        </tr>
                        <tr>
                            <!-- purpose -->
                            <th>គោលបំណង/Purpose<span class="pull-right">:</span></th>
                            <td colspan="5"><?php echo $data->purpose; ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- show item -->
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-center" width="50px;">លរ<br>NO</br></th>
                            <th class="text-center">ពិពណ៍នាសំណើរ <br>DESCRIPTION</th>
                            <th class="text-center" width="150px;">សរុប <br>TOTAL</th>
                            <th class="text-center" width="270px;">កំណត់សម្គាល់ <br>REMARK</th>
                        </tr>

                        <?php 
                        // exist data
                        if(!empty($items) && set_value('description[0]') == false):
                            $num=1;
                            foreach ($items as $key => $item): ?>
                                <tr id="removeItem<?php echo $key;?>">
                                    <td class="text-center"><?php echo $num++; ?></td>
                                    <td><?php echo $item->description; ?></td>
                                    <td><?php echo currency_format(1, $item->total); ?></td>
                                    <td><?php echo $item->remark; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                        <!-- total -->
                        <tr class="append-items">
                            <td class="text-right" style="border: none !important;" colspan="2"><b>Total:</b></td>
                            <td style="border: none !important;" id="sum_total">
                                <?php echo currency_format(1, $data->total_amount); ?></td>
                            <input type="hidden" name="total_amount" id="total_amount">
                            <td style="border: none !important;"></td>
                        </tr>
                    </tbody>
                </table>

                <!-- files -->
                <?php if(!empty($attachments)): ?>
                <input type="hidden" id="attachment_file_deleted" name="attachment_file_deleted"
                    value="<?php echo set_value('attachment_file_deleted'); ?>">
                <input type="hidden" id="attachment_file_path" name="attachment_file_path"
                    value="<?php echo set_value('attachment_file_path'); ?>">
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="show_file">
                            <tr>
                                <th>File Name</th>
                                <th>File Description</th>
                                <th>File Size</th>
                            </tr>
                            <?php foreach ($attachments as $key => $attach) : ?>
                            <tr id="list_attachment_file<?php echo $key; ?>">
                                <td>
                                    <?php $attach_path = $attach->file_path.'/'.$attach->upload_file_name;?>
                                    <a href="<?php echo base_url().$attach_path; ?>"
                                        target="_blank"><?php echo $attach->original_name; ?></a>
                                </td>
                                <td><?php echo $attach->description; ?></td>
                                <td><?php echo $attach->file_size ?>kb<a href="javascript:void(0);"
                                        class="btn btn-danger btn-xs pull-right"
                                        onclick="removeAttachmentFile('<?php echo $key; ?>','<?php echo $attach->id; ?>','<?php echo $attach_path; ?>');"><span
                                            class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <table class="table borderless" style="border-spacing: 0 0px;">
                    <thead>
                        <tr>
                            <th class="text-center">ស្នើសុំដោយ<br>Requested By</br></th>
                            <th class="text-center">ពិនិត្យដោយ <br>Checked By</th>
                            <th class="text-center">អនុម័តដោយ <br>Approved By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><?php echo getUserFullName($data->created_by); ?></td>
                            <?php if($data->checked_at != null): ?>
                            <td class="text-center"><?php echo getUserFullName($data->checked_by); ?></td>
                            <?php else: ?>
                            <td class="text-center">...........................</td>
                            <?php endif; ?>
                            <?php if($data->approved_at != null): ?>
                            <td class="text-center"><?php echo getUserFullName($data->approved_by); ?></td>
                            <?php else: ?>
                            <td class="text-center">...........................</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-center">Date: <?php echo date('d-m-Y', strtotime($data->created_at)); ?>
                            </td>
                            <?php if($data->checked_at != null): ?>
                            <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->checked_at)); ?>
                            </td>
                            <?php else: ?>
                            <td class="text-center">Date: ..../..../......</td>
                            <?php endif; ?>
                            <?php if($data->approved_at != null): ?>
                            <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->approved_at)); ?>
                            </td>
                            <?php else: ?>
                            <td class="text-center">Date: ..../..../......</td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>

                <!-- show reject -->
                <?php if($data->authorize_status == 'rejected'):?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Rejected by:</b>  <?php echo getUserFullName($data->rejected_by);?></td>
                                <td><b>Rejected at:</b> <?php echo date('d-m-Y h:i:s A', strtotime($data->rejected_at));?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Reason:</b> <?php echo $data->reject_comment;?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif;?>

                <!-- button action -->
                <div class="text-right">
                    <span id="submit_loader" style="display:none;"></span>
                    <?php if($data->authorize_status == 'requesting' && $data->checked_by == $this->user->info->ID): ?>
                        <!-- button check -->
                        <a href="javascript:void(0)"
                        onclick="approveConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/checked/<?php echo $data->approved_by; ?>');"
                        class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Agree to check"
                        data-original-title="Agree to check"><i class="glyphicon glyphicon-ok-circle"></i> Check</a>

                        <!-- btn reject -->
                        <a href="javascript:void(0)" onclick="rejectConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/rejected/<?php echo $data->created_by;?>');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Agree to reject"
                        data-original-title="Agree to reject"><i class="glyphicon glyphicon-ok-circle"></i> Reject</a>

                    <?php elseif($data->authorize_status == 'checked' && $data->approved_by == $this->user->info->ID): ?>
                        <!-- button approve -->
                        <a href="javascript:void(0)"
                            onclick="approveConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/approved/<?php echo $data->created_by;?>')"
                            class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="agree to approve"
                            data-original-title="Agree to approve"><i class="glyphicon glyphicon-ok-circle"></i> Approve
                        </a>
                        <!-- btn reject -->
                        <a href="javascript:void(0)" onclick="rejectConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/rejected/<?php echo $data->created_by;?>');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Agree to reject"
                            data-original-title="Agree to reject"><i class="glyphicon glyphicon-ok-circle"></i> Reject</a>
                    <?php endif; ?>
                    
                    <!-- btn print -->
                    <a href="javascript:void(0);" id="btn-print" class="btn btn-primary" data-toggle="tooltip"
                        data-placement="bottom" title="Preview template" data-original-title="Preview Print Template"><i
                            class="glyphicon glyphicon-remove-circle"></i> Print Template</a>

                    <!-- btn close -->
                    <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip"
                        data-placement="bottom" title="Cancel" data-original-title="Cancel"><i
                            class="glyphicon glyphicon-remove-circle"></i> Cancel</a>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <b>created by:</b> <?php echo getUserFullName($data->created_by); ?> <b>
            | created at:</b> <?php echo $data->created_at; ?>
            <?php if($data->updated_by != null): ?>
            | <b>updated by:</b> <?php echo getUserFullName($data->updated_by); ?> <b>| updated at:</b>
            <?php echo $data->updated_at; ?> 
            <?php endif; ?>
            | <a href="#show_approval_log" data-toggle="collapse">Show Approval Log</a> <span class="show_process_time pull-right"></span>
        </div>
    </div>

    <!-- show approval log -->
    <div class="panel panel-default collapse" id="show_approval_log">
        <div class="panel-heading"><label class="label-heading">APPROVAL TRANSACTION LOG</label><span class="show_process_time pull-right"></span></div>
        <div class="panel-body">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Authorization Log</div> -->
                <div class="panel-body">
                    <table class="table borderless table-hover table-striped" style="border: none;">
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Process Time</th>
                        </tr>      

                        <?php    
                        $time_end = 0; // default 0
                        // $time_start = ($created_at != null ? strtotime($created_at) : 0); 
                        $time_start = ($start_created_at != null ? strtotime($start_created_at) : 0);
                        $transferFrom = $this->approval->findApprovalLog($approval->module_id, $approval->record_id);
                        if($transferFrom):
                            $last_status_for = '';
                            foreach ($transferFrom as $key => $status): ?>
                                <tr>
                                    <td class="text-left"><span class="glyphicon glyphicon-user"></span>
                                            <?php echo getUserFullName($status->from_user); 
                                            // if($status->log_id != $risk_vs_credit_log || $user_risk_status == 1){ 
                                            if($status->log_id != $risk_vs_credit_log || $status->to_user == $user_credit && $status->to_status == 4 || $user_risk_status == 1){
                                                // if not the credit_user approve after user_risk agreement or user_risk agreed, show approval status
                                                if($status->status == 'approve' && $approve_with_condition == 1){ // show approve with condition
                                                    echo '<span class="pull-right label label-success">Approved with Condition</span>';
                                                }else{
                                                    echo '<span class="pull-right">'.$this->approval->didApprovalStatus($status->from_status).'</span>';
                                                }
                                            }
                                            ?>
                                    </td>
                                    <td class="text-left">
                                        <!-- show user_risk -->
                                        <?php if($status->to_user == $user_credit && $status->to_status == 4): ?>
                                            <!-- if the user approve = user_credit approve after user_risk agreement 
                                            & status transfer for approve, show user_risk-->
                                            :&nbsp &nbsp<span class="glyphicon glyphicon-user"></span>
                                            <?php echo getUserFullName($user_risk); ?><br/>
                                            <?php endif; ?>  

                                        <?php 
                                        if(!empty($status->to_user)):
                                            $users = explode(",", $status->to_user);
                                            foreach($users as $u): ?>
                                                :&nbsp &nbsp<span class="glyphicon glyphicon-user"></span>
                                                <?php echo getUserFullName($u); ?><br/>
                                                <?php 
                                            endforeach;
                                        endif; 
                                        ?>                                      
                                    </td>
                                    <td class="text-left">
                                        <?php 
                                            echo $this->approval->showApprovalStatus($status->to_status); 
                                            $last_status_for = $this->approval->showApprovalStatus($status->to_status);
                                        ?>
                                    </td>
                                    <td class="text-left"><?php echo $status->comment; ?></td>
                                    <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($status->date)); ?></td>
                                    <td>
                                        <?php 
                                            $time_end = ($status->date != null ? strtotime($status->date) : 0);
                                            $time = $time_end - $time_start;
                                            echo count_process_time($this->common->convert_simple_time_fixed($time));
                                            $time_start = $time_end;
                                        ?>
                                    </td>
                                </tr>
                                
                                <?php 
                                    // show resubmit log if existing
                                    $resutmit_log = find_resubmit_log($status->record_id, $status->log_id);
                                    if(!empty($resutmit_log)):
                                        foreach($resutmit_log as $resubmit):?>
                                            <?php if(strtotime($user_risk_date) < strtotime($resubmit->returned_at)): ?>
                                                    <!-- show user_risk agreement-->
                                                    <!-- status 4 is approve -->
                                                    <?php if($status->to_user == $user_credit && $status->to_status == 4 && $user_risk_status != null): ?>
                                                        <!-- if the user approve = user_credit approve after user_risk agreement 
                                                            & status transfer for approve & user_risk_status agreed or disagreed, 
                                                            show user_risk status-->
                                                        <tr>
                                                            <td class="text-left">
                                                                <span class="glyphicon glyphicon-user"></span>
                                                                <?php echo getUserFullName($user_risk); ?>
                                                                <span class="pull-right">
                                                                <?php if($user_risk_status == 1):?>
                                                                    <span class="label label-primary">Agreed</span>
                                                                <?php elseif($user_risk_status == 2):?>
                                                                    <span class="label label-primary">Agreed with Condition</span>
                                                                <?php elseif($user_risk_status == 0):?>
                                                                    <span class="label label-danger">Disagreed</span>
                                                                <?php endif;?>
                                                                </span>
                                                            </td>
                                                            <td colspan="2">
                                                                <?php 
                                                                    if(!empty($risk_files)){
                                                                    $i=1;
                                                                    foreach ($risk_files as $key => $file) {
                                                                        $path = $file->file_path.'/'.$file->upload_file_name;
                                                                        echo ($i>1 ? str_repeat("&nbsp;", 11) : 'Files: ').$i++.'. <a href="'.base_url().$path.'" target="_blank" title="Click to open">'.$file->original_name.'</a><br>';
                                                                    }
                                                                    echo str_repeat("&nbsp;", 3).$risk_files[0]->description;
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="text-left"><?php echo $user_risk_comment; ?></td>
                                                            <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($user_risk_date)); ?></td>
                                                            <td>
                                                                <?php 
                                                                    $time_end = ($user_risk_date != null ? strtotime($user_risk_date) : 0);
                                                                    $time = $time_end - $time_start;
                                                                    echo count_process_time($this->common->convert_simple_time_fixed($time));
                                                                    $time_start = $time_end;
                                                                ?>
                                                            </td>
                                                        </tr> 
                                                    <?php endif;?>
                                                    <!-- show returned -->
                                                    <tr>
                                                        <td class="text-left">
                                                            <span class="glyphicon glyphicon-user"></span>
                                                            <?php echo getUserFullName($resubmit->returned_by); ?>
                                                            <span class="pull-right">
                                                                <span class="label label-default">Returned</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if(!empty($resubmit->users)){
                                                                    $return_users = explode(",", $resubmit->users);
                                                                    foreach($return_users as $return_user){
                                                                        echo ':&nbsp &nbsp<span class="glyphicon glyphicon-user"></span> ';
                                                                        echo getUserFullName($return_user).'<br/>';
                                                                    }
                                                                }
                                                            ?>  
                                                        </td>
                                                        <td class="text-left"><span class="label label-default">Update & Resubmit</span></td>
                                                        <td class="text-left"><?php echo $resubmit->comment; ?></td>
                                                        <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($resubmit->returned_at)); ?></td>
                                                        <td>
                                                            <?php 
                                                                $time_end = ($resubmit->returned_at != null ? strtotime($resubmit->returned_at) : 0);
                                                                $time = $time_end - $time_start;
                                                                echo count_process_time($this->common->convert_simple_time_fixed($time));
                                                                $time_start = $time_end;
                                                            ?>
                                                        </td>
                                                    </tr> 
                                                    <!-- show resubmitted -->
                                                    <?php if($resubmit->resubmit_status == 1):?>
                                                        <tr>
                                                            <td class="text-left">
                                                                <span class="glyphicon glyphicon-user"></span>
                                                                <?php echo getUserFullName($resubmit->resubmitted_by); ?>
                                                                <span class="pull-right">
                                                                    <span class="label label-default">Resubmitted</span>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    echo ':&nbsp &nbsp<span class="glyphicon glyphicon-user"></span> ';
                                                                    echo getUserFullName($resubmit->returned_by).'<br/>';
                                                                ?>
                                                            </td>
                                                            <td class="text-left"><?php echo $last_status_for; ?></td>
                                                            <td class="text-left">Updated & Resubmitted</td>
                                                            <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($resubmit->resubmitted_at)); ?></td>
                                                            <td>
                                                                <?php 
                                                                    $time_end = ($resubmit->resubmitted_at != null ? strtotime($resubmit->resubmitted_at) : 0);
                                                                    $time = $time_end - $time_start;
                                                                    echo count_process_time($this->common->convert_simple_time_fixed($time));
                                                                    $time_start = $time_end;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif;?>

                                            <?php elseif(strtotime($user_risk_date) > strtotime($resubmit->returned_at)): ?>
                                                
                                                    <!-- show returned -->
                                                    <tr>
                                                        <td class="text-left">
                                                            <span class="glyphicon glyphicon-user"></span>
                                                            <?php echo getUserFullName($resubmit->returned_by); ?>
                                                            <span class="pull-right">
                                                                <span class="label label-default">Returned</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if(!empty($resubmit->users)){
                                                                    $return_users = explode(",", $resubmit->users);
                                                                    foreach($return_users as $return_user){
                                                                        echo ':&nbsp &nbsp<span class="glyphicon glyphicon-user"></span> ';
                                                                        echo getUserFullName($return_user).'<br/>';
                                                                    }
                                                                }
                                                            ?>  
                                                        </td>
                                                        <td class="text-left"><span class="label label-default">Update & Resubmit</span></td>
                                                        <td class="text-left"><?php echo $resubmit->comment; ?></td>
                                                        <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($resubmit->returned_at)); ?></td>
                                                        <td>
                                                            <?php 
                                                                $time_end = ($resubmit->returned_at != null ? strtotime($resubmit->returned_at) : 0);
                                                                $time = $time_end - $time_start;
                                                                echo count_process_time($this->common->convert_simple_time_fixed($time));
                                                                $time_start = $time_end;
                                                            ?>
                                                        </td>
                                                    </tr> 
                                                    <!-- show resubmitted -->
                                                    <?php if($resubmit->resubmit_status == 1):?>
                                                        <tr>
                                                            <td class="text-left">
                                                                <span class="glyphicon glyphicon-user"></span>
                                                                <?php echo getUserFullName($resubmit->resubmitted_by); ?>
                                                                <span class="pull-right">
                                                                    <span class="label label-default">Resubmitted</span>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    echo ':&nbsp &nbsp<span class="glyphicon glyphicon-user"></span> ';
                                                                    echo getUserFullName($resubmit->returned_by).'<br/>';
                                                                ?>
                                                            </td>
                                                            <td class="text-left"><?php echo $last_status_for; ?></td>
                                                            <td class="text-left">Updated & Resubmitted</td>
                                                            <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($resubmit->resubmitted_at)); ?></td>
                                                            <td>
                                                                <?php 
                                                                    $time_end = ($resubmit->resubmitted_at != null ? strtotime($resubmit->resubmitted_at) : 0);
                                                                    $time = $time_end - $time_start;
                                                                    echo count_process_time($this->common->convert_simple_time_fixed($time));
                                                                    $time_start = $time_end;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif;?>
                                                    <!-- show user_risk agreement-->
                                                    <!-- status 4 is approve -->
                                                    <?php if($status->to_user == $user_credit && $status->to_status == 4 && $user_risk_status != null): ?>
                                                        <!-- if the user approve = user_credit approve after user_risk agreement 
                                                            & status transfer for approve & user_risk_status agreed or disagreed, 
                                                            show user_risk status-->
                                                        <tr>
                                                            <td class="text-left">
                                                                <span class="glyphicon glyphicon-user"></span>
                                                                <?php echo getUserFullName($user_risk); ?>
                                                                <span class="pull-right">
                                                                <?php if($user_risk_status == 1):?>
                                                                    <span class="label label-primary">Agreed</span>
                                                                <?php elseif($user_risk_status == 2):?>
                                                                    <span class="label label-primary">Agreed with Condition</span>
                                                                <?php elseif($user_risk_status == 0):?>
                                                                    <span class="label label-danger">Disagreed</span>
                                                                <?php endif;?>
                                                                </span>
                                                            </td>
                                                            <td colspan="2">
                                                                <?php 
                                                                    if(!empty($risk_files)){
                                                                    $i=1;
                                                                    foreach ($risk_files as $key => $file) {
                                                                        $path = $file->file_path.'/'.$file->upload_file_name;
                                                                        echo ($i>1 ? str_repeat("&nbsp;", 11) : 'Files: ').$i++.'. <a href="'.base_url().$path.'" target="_blank" title="Click to open">'.$file->original_name.'</a><br>';
                                                                    }
                                                                    echo str_repeat("&nbsp;", 3).$risk_files[0]->description;
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td class="text-left"><?php echo $user_risk_comment; ?></td>
                                                            <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($user_risk_date)); ?></td>
                                                            <td>
                                                                <?php 
                                                                    $time_end = ($user_risk_date != null ? strtotime($user_risk_date) : 0);
                                                                    $time = $time_end - $time_start;
                                                                    echo count_process_time($this->common->convert_simple_time_fixed($time));
                                                                    $time_start = $time_end;
                                                                ?>
                                                            </td>
                                                        </tr> 
                                                    <?php endif;?>

                                            <?php endif;?>
                                        
                                        <?php endforeach;
                                    else:
                                        // end show resubmit log if existing
                                        ?>
            
                                            <!-- show user_risk agreement-->
                                            <!-- status 4 is approve -->
                                            <?php if($status->to_user == $user_credit && $status->to_status == 4 && $user_risk_status != null): ?>
                                                <!-- if the user approve = user_credit approve after user_risk agreement 
                                                    & status transfer for approve & user_risk_status agreed or disagreed, 
                                                    show user_risk status-->
                                            <tr>
                                                <td class="text-left">
                                                    <span class="glyphicon glyphicon-user"></span>
                                                    <?php echo getUserFullName($user_risk); ?>
                                                    <span class="pull-right">
                                                    <?php if($user_risk_status == 1):?>
                                                        <span class="label label-primary">Agreed</span>
                                                    <?php elseif($user_risk_status == 2):?>
                                                        <span class="label label-primary">Agreed with Condition</span>
                                                    <?php elseif($user_risk_status == 0):?>
                                                        <span class="label label-danger">Disagreed</span>
                                                    <?php endif;?>
                                                    </span>
                                                </td>
                                                <td colspan="2">
                                                    <?php 
                                                        if(!empty($risk_files)){
                                                        $i=1;
                                                        foreach ($risk_files as $key => $file) {
                                                            $path = $file->file_path.'/'.$file->upload_file_name;
                                                            echo ($i>1 ? str_repeat("&nbsp;", 11) : 'Files: ').$i++.'. <a href="'.base_url().$path.'" target="_blank" title="Click to open">'.$file->original_name.'</a><br>';
                                                        }
                                                        echo str_repeat("&nbsp;", 3).$risk_files[0]->description;
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-left"><?php echo $user_risk_comment; ?></td>
                                                <td class="text-left"><?php echo date('d/m/Y h:i:s A', strtotime($user_risk_date)); ?></td>
                                                <td>
                                                    <?php 
                                                        $time_end = ($user_risk_date != null ? strtotime($user_risk_date) : 0);
                                                        $time = $time_end - $time_start;
                                                        echo count_process_time($this->common->convert_simple_time_fixed($time));
                                                        $time_start = $time_end;
                                                    ?>
                                                </td>
                                            </tr> 
                                            <?php endif;

                                    endif;

                            endforeach;
                        endif;?>
                    </table>
                </div>
            </div>
        </div> 
    </div> 
</div>

<?php $this->load->view('layout/modal_confirm'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/address.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/simple.money.format.js"></script>
<script>
$('#btn-print').on('click', function() {
    var accessId = "<?php echo $_GET['id']; ?>";
    window.open(global_base_url + 'float_advance/print?id=' + accessId);
});
</script>
<script type="text/javascript">
$('#set_applied_amount').simpleMoneyFormat();
$('#set_loan_amount').simpleMoneyFormat();

$(function() {
    $("#application_date").datepicker({
        dateFormat: 'dd-mm-yy',
    });
});
$('.select2').select2();
$("#alert-error").fadeTo(9000, 9000).slideUp(500, function() {
    $("#alert-error").alert('close');
});
</script>