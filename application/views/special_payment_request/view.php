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
            <div class="col-xs-12" style="border-bottom: 1px solid #bfbfbf;">
                    <div class="col-xs-4">
                        <?php if(!empty($this->settings->info->site_logo)) : ?>
                            <img src="<?php echo base_url().$this->settings->info->upload_path_relative . "/" . $this->settings->info->site_logo ?>" class="img-rounded img-responsive">
                        <?php endif; ?>
                    </div> 
                    <div class="col-xs-4" style="text-align: center;">
                        <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>លិខិតស្នើសុំបង់ប្រាក់ខុសលក្ខខណ្ឌ</label></h4>
                    </div>
                    <div class="col-xs-4"></div>
                </div>

                <!-- show data -->
                <style type="text/css">
                    .borderless td, .borderless th {
                        border: none !important;
                        /* font-size: 11px; */
                        font-family: Khmer OS Content;
                    }
                    .table-bordered td, .table-bordered th {
                        /* font-size: 11px; */
                        font-family: Khmer OS Content;
                    }
                </style>

                <table class="table borderless" style="border-spacing: 0 0px;">
                    <tbody>
                        <tr>
                            <td>ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ</td>
                            <td><?php echo $data->fullname;?></td>
                            <td>ភេទ</td>
                            <td><?php echo $data->gender;?></td>
                            <td>មានតួនាទីជា</td>
                            <td><?php echo $data->position;?></td>
                        </tr>
                        <tr>
                            <td>ស្ថិតនៅក្រុម</td>
                            <td><?php echo $data->division;?></td>
                            <td>អត្តលេខ</td>
                            <td><?php echo $data->staff_id;?>។</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table borderless" style="border-spacing: 0 0px;">
                    <tbody>
                        <tr><th colspan="3" class="text-center"><u>សូមគោរពជូន</u></th></tr>
                        <tr>
                           <td></td>
                           <td width="500px;"><span><b>លោក</b> <?php echo getUserFullNameKH($data->approved_by);?></span></td>
                           <td><span><b>តួនាទី</b> <?php echo getPositionNameKhByUserId($data->approved_by);?></span></td>
                        </tr>
                        <tr>
                            <td>កម្មវត្ថុ៖</td>
                            <td colspan="2"><?php echo $data->subject;?></td>
                        </tr>
                        <tr>
                            <td width="100px;">សម្របសម្រូួល៖</td>
                            <td colspan="2"><?php echo $data->content;?></td>
                        </tr>
                        <tr>
                            <td>មូលហេតុ៖</td>
                            <td colspan="2"><?php echo $data->reason;?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><?php echo $data->reference;?></td>
                        </tr>
                    </tbody>
                </table>

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
                            <td class="text-center"><?php echo getUserFullNameKH($data->created_by); ?></td>
                            <?php if($data->checked_at != null): ?>
                            <td class="text-center"><?php echo getUserFullNameKH($data->checked_by); ?></td>
                            <?php else: ?>
                            <td class="text-center">...........................</td>
                            <?php endif; ?>
                            <?php if($data->approved_at != null): ?>
                            <td class="text-center"><?php echo getUserFullNameKH($data->approved_by); ?></td>
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
                                <td><b>Rejected by:</b>  <?php echo getUserFullNameKH($data->rejected_by);?></td>
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