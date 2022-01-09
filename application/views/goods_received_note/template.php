<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

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
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>បង្កាន់ដៃទទួលទំនិញ</label></h4>
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>GOODS RECEIVED NOTE</label></h4>
                </div>
                <div class="col-xs-4"></div>
            </div>
            <!-- show data -->
            <style type="text/css">
                .borderless td, .borderless th {
                    border: none !important;
                    font-size: 11px;
                    font-family: Khmer OS Content;
                }
                .table-bordered td, .table-bordered th {
                    font-size: 11px;
                    font-family: Khmer OS Content;
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
                        <th class="text-center" width="100px;">Remarks</th>
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
                        <td style="border: none !important;" id="sum_total"><?php echo currency_format(1, $data->total_amount); ?></td>
                        <td style="border: none !important;"></td>                                    
                    </tr>
                </tbody>
            </table>

            <!-- authorize -->
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
                        <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->created_at)); ?></td>
                        <?php if($data->checked_at != null): ?>
                            <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->checked_at)); ?></td>
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

