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
            <?php echo lang("view").' '.lang($title); ?></div>
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
                            <td><?php echo $data->bank_account; ?></td>
                            <!-- reference -->
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
                            <th class="text-center">លរ<br>NO</br></th>
                            <th class="text-center">កូដគណនេយ្យ <br>Account Code/Name</th>
                            <th class="text-center">បរិយាយ <br>DESCRIPTION</th>
                            <th class="text-center" colspan="2">Account USD<br><span class="text-left">Debit</span> |
                                <span class="text-right"> Credit</span>
                            </th>
                            <th class="text-center">កំណត់សម្គាល់ <br>REMARK</th>
                        </tr>

                        <?php 
                        // exist data
                        if(!empty($items) && set_value('description[0]') == false):
                            $num=1;
                            foreach ($items as $key => $item): ?>
                        <tr id="removeItem<?php echo $key;?>">
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td><?php echo findAccountName($item->account); ?></td>
                            <td><?php echo $item->description; ?></td>
                            <td><?php echo currency_format(1, $item->debit); ?></td>
                            <td><?php echo currency_format(1, $item->credit); ?></td>
                            <td><?php echo $item->remark; ?></td>
                        </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <!-- total -->
                        <tr class="append-items">
                            <td style="border: none !important;" class="text-center" colspan="2" rowspan="3">
                                សូមភ្ជាប់ឯកសារយោងទាំងអស់មកជាមួយ<br>All supporting documents are attached</td>
                            <td class="text-right">សរុបចំណាយ<br>Total Expense</td>
                            <td id="show_total_debit"><?php echo currency_format(1, $data->total_debit); ?></td>
                            <td style="border: none !important;"></td>
                            <td style="border: none !important;"></td>
                        </tr>
                        <tr>
                            <td class="text-right">សរុបបុរេប្រទាន<br>Float/advance</td>
                            <td id="total_float_advance"><?php echo currency_format(1, $data->advance_amount); ?></td>
                            <td style="border: none !important;"></td>
                            <td style="border: none !important;"></td>
                        </tr>
                        <tr>
                            <td class="text-right">ចំណាយលើស/ក្រោមការចំណាយ<br>Over/under spend</td>
                            <td id="show_spend_amount"><?php echo currency_format(1, $data->spend_amount); ?></td>
                            <td style="border: none !important;"></td>
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
                                <td><?php echo $attach->description;?></td>
                                <td><?php echo $attach->file_size ?>kb <a href="javascript:void(0);"
                                        class="btn btn-danger btn-xs pull-right"
                                        onclick="removeAttachmentFile('<?php echo $key; ?>','<?php echo $attach->id; ?>','<?php echo $attach_path; ?>');"><span
                                            class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <!-- approval blog  -->
                <style type="text/css">
                .berderless tr td,
                .berderless tr th {
                    border: none !important;
                }
                </style>
                <table class="table berderless" style="border-spacing: 0 0px;">
                    <tbody>
                        <tr>
                            <th class="text-center">អ្នកទូទាត់ដោយ <br>Settlement By</th>
                            <th class="text-center">រៀបចំដោយ <br>Prepared By</th>
                            <th class="text-center">ពីនិត្យដោយ <br>Checked By</th>
                            <th class="text-center">ផ្ទៀងផ្ទាត់ដោយ <br>Verrified By</th>
                            <th class="text-center">អនុម័តដោយ <br>Approved By</th>
                        </tr>
                        <!-- authorize by -->
                        <tr class="append-items">
                            <td class="text-center">
                                <?php if($data->settlement_at != null): ?>
                                <?php echo getUserFullName($data->settlement_by); ?></td>
                            <?php else: ?>
                            ...........................
                            <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->created_at != null): ?>
                                <?php echo getUserFullName($data->created_by); ?></td>
                            <?php else: ?>
                            ...........................
                            <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->checked_at != null): ?>
                                <?php echo getUserFullName($data->checked_by); ?></td>
                            <?php else: ?>
                            ...........................
                            <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->verified_at != null): ?>
                                <?php echo getUserFullName($data->verified_by); ?></td>
                            <?php else: ?>
                            ...........................
                            <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->approved_at != null): ?>
                                <?php echo getUserFullName($data->approved_by); ?></td>
                            <?php else: ?>
                            ...........................
                            <?php endif; ?>
                            </td>
                        </tr>
                        <!-- authorize at -->
                        <tr class="append-items">
                            <td class="text-center">
                                <?php if($data->settlement_at != null): ?>
                                Date: <?php echo date('d/m/Y', strtotime($data->settlement_at)); ?>
                                <?php else: ?>
                                Date: ..../..../......
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->created_at != null): ?>
                                Date: <?php echo date('d/m/Y', strtotime($data->created_at)); ?>
                                <?php else: ?>
                                Date: ..../..../......
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->checked_at != null): ?>
                                Date: <?php echo date('d/m/Y', strtotime($data->checked_at)); ?>
                                <?php else: ?>
                                Date: ..../..../......
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->verified_at != null): ?>
                                Date: <?php echo date('d/m/Y', strtotime($data->verified_at)); ?>
                                <?php else: ?>
                                Date: ..../..../......
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($data->approved_at != null): ?>
                                Date: <?php echo date('d/m/Y', strtotime($data->approved_at)); ?>
                                <?php else: ?>
                                Date: ..../..../......
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end approval  -->

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

                    <?php if($data->authorize_status == 'requesting' && $data->settlement_by == $this->user->info->ID): ?>
                    <!-- btn settlement -->
                    <a href="javascript:void(0)"
                        onclick="approveConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/settlement/<?php echo $data->checked_by; ?>');"
                        class="btn btn-success" data-toggle="tooltip" data-placement="bottom"
                        title="Agree to settlement" data-original-title="Agree to settlement"><i
                            class="glyphicon glyphicon-ok-circle"></i> Settlement</a>
                    <!-- btn reject -->
                    <a href="javascript:void(0)" onclick="rejectConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/rejected/<?php echo $data->created_by;?>');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Agree to reject"
                        data-original-title="Agree to reject"><i class="glyphicon glyphicon-ok-circle"></i> Reject</a>

                    <?php elseif($data->authorize_status == 'settlement' && $data->checked_by == $this->user->info->ID): ?>
                    <!-- button check -->
                    <a href="javascript:void(0)"
                        onclick="approveConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/checked/<?php echo $data->verified_by;?>')"
                        class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="agree to check"
                        data-original-title="Agree to check"><i class="glyphicon glyphicon-ok-circle"></i> Check </a>
                        <!-- btn reject -->
                        <a href="javascript:void(0)" onclick="rejectConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/rejected/<?php echo $data->created_by;?>');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Agree to reject"
                        data-original-title="Agree to reject"><i class="glyphicon glyphicon-ok-circle"></i> Reject</a>

                    <?php elseif($data->authorize_status == 'checked' && $data->verified_by == $this->user->info->ID): ?>
                    <!-- button verify -->
                    <a href="javascript:void(0)"
                        onclick="approveConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/verified/<?php echo $data->approved_by;?>')"
                        class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="agree to verify"
                        data-original-title="Agree to verify"><i class="glyphicon glyphicon-ok-circle"></i> Verify </a>
                    <!-- btn reject -->
                    <a href="javascript:void(0)" onclick="rejectConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/rejected/<?php echo $data->created_by;?>');" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Agree to reject"
                        data-original-title="Agree to reject"><i class="glyphicon glyphicon-ok-circle"></i> Reject</a>

                    <?php elseif($data->authorize_status == 'verified' && $data->approved_by == $this->user->info->ID): ?>
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
        <div class="panel-footer"><b>created by:</b> <?php echo getUserFullName($data->created_by); ?> <b>| created
                at:</b> <?php echo $data->created_at; ?>
            <?php if($data->updated_by != null): ?>
            | <b>updated by:</b> <?php echo getUserFullName($data->updated_by); ?> <b>| updated at:</b>
            <?php echo $data->updated_at; ?> </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('layout/modal_confirm'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/address.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/simple.money.format.js"></script>
<script>
$('#btn-print').on('click', function() {
    var accessId = "<?php echo $_GET['id']; ?>";
    window.open(global_base_url + 'advance_clearing/print?id=' + accessId);
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