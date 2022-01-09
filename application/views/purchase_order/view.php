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
            ref no: <b><?php echo $data->po_no; ?></b>
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
                            <th>ឈ្មោះហាង/Name Shop<span class="pull-right">:</span></th>
                            <td><?php echo findSupplierName($data->name_shop); ?></td>
                            <!-- po_no -->
                            <th>លេខរៀង/PO No<span class="pull-right">:</span></th>
                            <td><?php echo $data->po_no; ?></td>
                        </tr>
                        <tr>
                            <!-- address -->
                            <th>អាសយដ្ឋាន/Address<span class="pull-right">:</span></th>
                            <td><?php echo $data->address; ?></td>
                            <!-- date -->
                            <th>ថ្ងៃធ្វើឯកសារ/Date<span class="pull-right">:</span></th>
                            <td><?php echo date('d-m-Y', strtotime($data->date)); ?></td>
                        </tr>
                        <tr>
                            <!-- contact -->
                            <th>អ្នកទំនាក់ទំនង/Conntact<span class="pull-right">:</span></th>
                            <td><?php echo $data->contact; ?></td>
                            <!-- deadline -->
                            <th>ថ្ងៃកំណត់/Deadline<span class="pull-right">:</span></th>
                            <td><?php echo date('d-m-Y', strtotime($data->deadline)); ?></td>
                        </tr>
                        <tr>
                            <!-- phone_number -->
                            <th>លេខទូរស័ព្ទ/Phone<span class="pull-right">:</span></th>
                            <td><?php echo $data->phone_number; ?></td>
                            <!-- pr_no -->
                            <th>លេខសំណើរ/PR No.<span class="pull-right">:</span></th>
                            <td><?php echo $data->pr_no; ?></td>
                        </tr>
                        <tr>
                            <!-- cheque -->
                            <th>ឈ្មោះសែក/Cheque.<span class="pull-right">:</span></th>
                            <td><?php echo $data->cheque; ?></td>
                            <!-- cheque_date -->
                            <th>ថ្ងៃធ្វើឯកសារ/Date<span class="pull-right">:</span></th>
                            <td><?php echo date('d-m-Y', strtotime($data->cheque_date)); ?></td>
                        </tr>
                        <tr>
                            <!-- payment_term -->
                            <th>ការទូទាត់/Payment Term<span class="pull-right">:</span></th>
                            <td><?php echo $data->payment_term; ?></td>
                            <!-- project -->
                            <th>ឈ្មោះគំរោង/Project<span class="pull-right">:</span></th>
                            <td><?php echo findProjectName($data->project); ?></td>
                        </tr>
                        <tr>
                            <!-- warranty -->
                            <th>ការធានា/Warranty<span class="pull-right">:</span></th>
                            <td><?php echo $data->warranty; ?></td>
                            <!-- warranty_contact -->
                            <th>អ្នកទំនាក់ទំនង/Contact<span class="pull-right">:</span></th>
                            <td><?php echo $data->warranty_contact; ?></td>
                        </tr>
                        <tr>
                            <!-- delivery -->
                            <th>ការដឹកជញ្ជូន/Delivery<span class="pull-right">:</span></th>
                            <td><?php echo $data->delivery; ?></td>
                            <!-- delivery_phone_number -->
                            <th>អលេខទូរស័ព្ទ/Phone<span class="pull-right">:</span></th>
                            <td><?php echo $data->delivery_phone_number; ?></td>
                        </tr>
                        <tr>
                            <!-- warranty -->
                            <th>ទីតាំង/Location<span class="pull-right">:</span></th>
                            <td><?php echo $data->location; ?></td>
                            <!-- warranty_contact -->
                            <th>អលេខអ្នកទទួល/Reciever<span class="pull-right">:</span></th>
                            <td><?php echo $data->reciever; ?></td>
                        </tr>
                        <tr>
                            <!-- reference -->
                            <th><?php echo lang('reference');?><span class="pull-right">:</span></th>
                            <td><?php echo $data->reference; ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- show item -->
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-center" width="50px;">លរ<br>NO</br></th>
                            <th class="text-center">ពិពណ៍នាសម្ភារៈ <br>DESCRIPTION</th>
                            <th class="text-center" width="150px;">ខ្នាត/ឯកតា <br>UOM</th>
                            <th class="text-center" width="150px;">ចំនួន <br>QUANTITY</th>
                            <th class="text-center" width="150px;">តម្លៃ <br>PRICE</th>
                            <th class="text-center" width="250;">តម្លៃសរុប <br>TOTAL AMOUNT</th>
                        </tr>

                        <?php 
                        // exist data
                        if(!empty($items) && set_value('description[0]') == false):
                            $num=1;
                            foreach ($items as $key => $item): ?>
                        <tr id="removeItem<?php echo $key;?>">
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td><?php echo $item->description; ?></td>
                            <td><?php echo findMeasurementName($item->uom); ?></td>
                            <td class="text-center"><?php echo $item->quantity; ?></td>
                            <td><?php echo currency_format(1, $item->price); ?></td>
                            <td><?php echo currency_format(1, $item->total); ?></td>
                        </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <!-- total -->
                        <tr class="append-items">
                            <td class="text-right" colspan="5">សរុប/Sub Total:</td>
                            <td id="show_sub_total_amount"><?php echo currency_format(1, $data->sub_total_amount); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5">តម្លៃបញ្ចុះ/Discount:</td>
                            <td><?php echo currency_format(1, $data->discount); ?></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5">ចំនួនប្រាក់កក់/Deposit:</td>
                            <td><?php echo currency_format(1, $data->deposit); ?></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="5">តម្លៃសរុបក្រោយពេលបញ្ចុះតម្លៃ និងកក់/Grand Total After
                                Discount and Deposit:</td>
                            <td id="show_total_amount"><?php echo currency_format(1, $data->total_amount);?></td>
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

                <table class="table borderless" style="border-spacing: 0 0px;">
                    <thead>
                        <tr>
                            <td width="300px;"><b><u>សម្រាប់អ្នកផ្គត់ផ្គង់ (For Vendor
                                        Only)</u></b><br>ទទួលការកម្មង់ដោយ៖<br>Recieved and confirmed order by</td>
                            <th class="text-center">ស្នើសុំដោយ<br>Requested By</br></th>
                            <th class="text-center">ពិនិត្យដោយ <br>Checked By</th>
                            <th class="text-center">អនុម័តដោយ <br>Approved By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $data->order_by;?></td>
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
                            <td>Date: <?php echo date('d/m/Y', strtotime($data->order_date));?></td>
                            <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->created_at)); ?>
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
    window.open(global_base_url + '<?php echo $link;?>/print?id=' + accessId);
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