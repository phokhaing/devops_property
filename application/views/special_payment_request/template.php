<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<style>
@page {
  margin-top: 0mm;
}
</style>


<div class="panel panel-default">   
    <!-- <div class="panel-heading">
        ref no: <b><?php echo $data->ref_no; ?></b>
    </div>  -->  
    <div class="panel-body">
        <div class="form-horizontal print_content">
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
                            <td><b>កម្មវត្ថុ៖</b></td>
                            <td colspan="2"><?php echo $data->subject;?></td>
                        </tr>
                        <tr>
                            <td width="100px;"><b>សម្របសម្រូួល៖</b></td>
                            <td colspan="2"><?php echo $data->content;?></td>
                        </tr>
                        <tr>
                            <td><b>មូលហេតុ៖</b></td>
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
        </div>
        <!-- button action -->
        <div class="text-right">
            <!-- btn print -->
            <a href="javascript:void(0);" id="btn-print" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Print" data-original-title="Print"><i class="glyphicon glyphicon-remove-circle"></i> Print</a> 

            <!-- btn close -->
            <a href="<?php echo base_url($link); ?>/view?id=<?php echo $_GET['id']; ?>" id="btn-cancel" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Close" data-original-title="Close"><i class="glyphicon glyphicon-remove-circle"></i> Close</a>  
        </div> 
    </div>
</div>

<?php $this->load->view('layout/modal_confirm'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/address.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/simple.money.format.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/libs/printThis/printThis.js"></script>
<script>
    $('#btn-print').on('click', function(){
        $('.print_content').printThis({
            importCSS: true,            // import parent page css
            importStyle: false,         // import style tags
            loadCSS: "<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css",
        });
    });

    window.onafterprint=function(){
        window.location.reload(true);
    };
</script>
<script type="text/javascript">
    $('#set_applied_amount').simpleMoneyFormat();
    $('#set_loan_amount').simpleMoneyFormat();

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

