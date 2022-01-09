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
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>ប័ណ្ណបញ្ជាទិញ</label></h4>
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>PURCHASE ORDER</label></h4>
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
                        <td id="show_sub_total_amount"><?php echo currency_format(1, $data->sub_total_amount); ?></td>               
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
                        <td class="text-right" colspan="5">តម្លៃសរុបក្រោយពេលបញ្ចុះតម្លៃ និងកក់/Grand Total After Discount and Deposit:</td> 
                        <td id="show_total_amount"><?php echo currency_format(1, $data->total_amount);?></td> 
                    </tr>
                </tbody>
            </table>

            <!-- authorize -->
            <table class="table borderless" style="border-spacing: 0 0px;">
                <thead>
                    <tr>
                        <td width="200px;"><b><u>សម្រាប់អ្នកផ្គត់ផ្គង់ (For Vendor Only)</u></b><br>ទទួលការកម្មង់ដោយ៖<br>Recieved and confirmed order by</td>
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
                        <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->created_at)); ?></td>
                        <?php if($data->checked_at != null): ?>
                            <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->checked_at)); ?></td>
                        <?php else: ?>
                            <td class="text-center">Date: ..../..../......</td>
                        <?php endif; ?>
                        <?php if($data->approved_at != null): ?>
                        <td class="text-center">Date: <?php echo date('d/m/Y', strtotime($data->approved_at)); ?></td>
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
            debug: false,               // show the iframe for debugging
            importCSS: true,            // import parent page css
            importStyle: false,         // import style tags
            printContainer: false,       // print outer container/$.selector
            loadCSS: "<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css",
            pageTitle: "",              // add title to print page
            removeInline: false,        // remove inline styles from print elements
            removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
            printDelay: 333,            // variable print delay
            header: null,               // prefix to html
            footer: null,               // postfix to html
            base: false,                // preserve the BASE tag or accept a string for the URL
            formValues: true,           // preserve input/form values
            canvas: false,              // copy canvas content
            doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
            removeScripts: false,       // remove script tags from print content
            copyTagClasses: false,      // copy classes from the html & body tag
            beforePrintEvent: null,     // callback function for printEvent in iframe   
            beforePrint: null,          // function called before iframe is filled
            afterPrint: null,           // function called before iframe is removed
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

