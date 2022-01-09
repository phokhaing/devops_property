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
                            <!-- received_from -->
                            <th>Received From<span class="pull-right">:</span></th>
                            <td><?php echo findSupplierName($data->received_from); ?></td>
                            <!-- grn_no -->
                            <th>GRN No.<span class="pull-right">:</span></th>
                            <td><?php echo $data->grn_no; ?></td>
                        </tr>
                        <tr>
                            <!-- address -->
                            <th>Address<span class="pull-right">:</span></th>
                            <td><?php echo $data->address; ?></td>
                            <!-- date -->
                            <th>Date<span class="pull-right">:</span></th>
                            <td><?php echo date('d/m/Y', strtotime($data->date)); ?></td>
                        </tr>
                        <tr>
                            <!-- phone -->
                            <th>Phone<span class="pull-right">:</span></th>
                            <td><?php echo $data->phone; ?></td>
                            <!-- ordered_no -->
                            <th>Ordered No.<span class="pull-right">:</span></th>
                            <td><?php echo $data->ordered_no; ?></td>
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
                            <th class="text-center" width="50px;">No.</br></th>
                            <th class="text-center" width="100px;">Item No.</th>
                            <th class="text-center">Description</th>
                            <th class="text-center" width="100px;">Ref. No.</th>
                            <th class="text-center">UOM</th>
                            <th class="text-center" width="100px;">Price</th>
                            <th class="text-center" width="250px">Remarks</th>
                        </tr>

                        <?php 
                        // exist data
                        if(!empty($items) && set_value('description[0]') == false):
                            $num=1;
                            foreach ($items as $key => $item): ?>
                        <tr id="removeItem<?php echo $key;?>">
                            <td class="text-center"><?php echo $num++; ?></td>
                            <td><?php echo $item->item_no; ?></td>
                            <td><?php echo $item->description; ?></td>
                            <td><?php echo $item->ref_no; ?></td>
                            <td><?php echo findMeasurementName($item->uom); ?></td>
                            <td><?php echo currency_format(1, $item->price); ?></td>
                            <td><?php echo $item->remark; ?></td>
                        </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <!-- total -->
                        <tr class="append-items">
                            <td class="text-right" style="border: none !important;" colspan="5"><b>Total:</b></td>
                            <td style="border: none !important;" id="sum_total">
                                <?php echo currency_format(1, $data->total_amount); ?></td>
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
                            <th class="text-center">Received By</br></th>
                            <th class="text-center">Checked By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-center"><?php echo getUserFullName($data->created_by); ?></td>
                            <?php if($data->checked_at != null): ?>
                            <td class="text-center"><?php echo getUserFullName($data->checked_by); ?></td>
                            <?php else: ?>
                            <td class="text-center">...........................</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->created_at)); ?>
                            </td>
                            <?php if($data->checked_at != null): ?>
                            <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->checked_at)); ?>
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
                        onclick="approveConfirm('<?php echo base_url($link); ?>/authorize/<?php echo $data->id ?>/checked/<?php echo $data->created_by; ?>');"
                        class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Agree to check"
                        data-original-title="Agree to check"><i class="glyphicon glyphicon-ok-circle"></i> Check</a>

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