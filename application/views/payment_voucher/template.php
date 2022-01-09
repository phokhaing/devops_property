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
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>ប័ណ្ណចំណាយ</label></h4>
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>PAYMENT VOUCHER</label></h4>
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
                        <!-- date -->
                        <th>កាលបរិច្ឆេទស្នើសុំ/R.Date<span class="pull-right">:</span></th>
                        <td><?php echo date('d-m-Y', strtotime($data->date)); ?></td>
                    </tr>
                    <tr>
                        <!-- staff_id -->
                        <th>អត្តលេខ/ID<span class="pull-right">:</span></th>
                        <td><?php echo $data->staff_id; ?></td>
                        <!-- branch -->
                        <th>សាខា/Branch<span class="pull-right">:</span></th>
                        <td><?php echo getBranchName($data->branch); ?></td>
                        <!-- department -->
                        <th>នាយកដ្ឋាន/Department<span class="pull-right">:</span></th>
                        <td><?php echo getDepartmentName($data->department); ?></td>
                    </tr>
                    <tr>
                        <!-- project -->
                        <th>គំរោង/Project<span class="pull-right">:</span></th>
                        <td><?php echo findProjectName($data->project); ?></td>
                        <!-- location -->
                        <th>ទីតាំង/location<span class="pull-right">:</span></th>
                            <td colspan="2"><?php echo $data->location; ?></td>
                    </tr>
                    <tr>
                        <!-- supplier_to -->
                        <th>អ្នកផ្គត់ផ្គង់/ Supplier To<span class="pull-right">:</span></th>
                        <td><?php echo findSupplierName($data->supplier_to); ?></td>
                        <!-- telephone -->
                        <th>អទូរស័ព្ទ/ Telephone<span class="pull-right">:</span></th>
                        <td colspan="2"><?php echo $data->telephone; ?></td>
                    </tr>
                    <tr>
                        <!-- address -->
                        <th>អាសយដ្ឋាន/ Address<span class="pull-right">:</span></th>
                        <td colspan="3"><?php echo $data->address; ?></td>
                    </tr>
                    <tr>
                        <!-- paid_to -->
                        <th>បង់ប្រាក់ទៅឈ្មោះ/ Paid To<span class="pull-right">:</span></th>
                        <td><?php echo $data->paid_to; ?></td>
                        <!-- bank_account -->
                        <th>Bank Account<span class="pull-right">:</span></th>
                        <td colspan="2"><?php echo $data->bank_account; ?></td>
                    </tr>
                    <tr>
                        <!-- purpose -->
                        <th>គោលបំណង/Purpose<span class="pull-right">:</span></th>
                        <td><?php echo $data->purpose; ?></td>
                        <!-- purpose -->
                        <th><?php echo lang('reference');?><span class="pull-right">:</span></th>
                        <td colspan="2"><?php echo $data->reference; ?></td>
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
                        <th class="text-center" colspan="2">Account USD<br><span class="text-left">Debit</span> | <span class="text-right"> Credit</span></th>
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
                    <tr>
                        <td style="border: none !important;" class="text-right" colspan="3"><b>សរុប/ Total Amount</b></td> 
                        <td style="border: none !important;" id="show_total_debit"><?php echo currency_format(1, $data->total_debit); ?></td>
                        <td style="border: none !important;"></td>
                        <td style="border: none !important;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- approval blog -->
            <table class="table borderless" style="border-spacing: 0 0px;">
                <tbody>
                    <tr>
                        <th class="text-center">រៀបចំដោយ <br>Prepared By</th>
                        <th class="text-center">ពីនិត្យដោយ <br>Checked By</th>
                        <th class="text-center">ផ្ទៀងផ្ទាត់ដោយ <br>Verrified By</th>
                        <th class="text-center">អនុម័តដោយ <br>Approved By</th>
                    </tr>
                    <!-- authorize by -->
                    <tr>
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
                    <tr>
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

