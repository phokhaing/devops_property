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
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>ទម្រង់ស្នើសុំទិញសម្ភារៈ/សេវាកម្ម</label></h4>
                    <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>PURCHASE REQUEST NOTE</label></h4>
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
                        <!-- reference -->
                        <th><?php echo lang('reference');?><span class="pull-right">:</span></th>
                        <td><?php echo $data->reference; ?></td>
                        <!-- purpose -->
                        <th>គោលបំណង/Purpose<span class="pull-right">:</span></th>
                        <td colspan="3"><?php echo $data->purpose; ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- show item -->
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="text-center" width="50px;">លរ<br>NO</br></th>
                        <th class="text-center">ពិពណ៍នាសម្ភារៈ <br>DESCRIPTION</th>
                        <th class="text-center" width="100px;">ខ្នាត/ឯកតា <br>UOM</th>
                        <th class="text-center" width="100px;">ចំនួន <br>QUANTITY</th>
                        <th class="text-center" width="100px;">តម្លៃ <br>PRICE</th>
                        <th class="text-center" width="100px;">តម្លៃសរុប <br>TOTAL</th>
                        <th class="text-center">កំណត់សម្គាល់ <br>REMARK</th>
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
                                    <td><?php echo $item->quantity; ?></td>
                                    <td><?php echo currency_format(1, $item->price); ?></td>
                                    <td><?php echo currency_format(1, $item->total); ?></td>
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
                        <input type="hidden" name="total_amount" id="total_amount"> 
                        <td style="border: none !important;"></td>                                    
                    </tr>
                </tbody>
            </table>
            <!-- note -->
            <table class="table table-bordered">
                    <tr><td><b>កំណត់ចំណាំ៖</b> ការដាក់ទម្រង់ស្នើសុំសម្ភារៈ ត្រូវធ្វើឡើងអោយបានមុនប្រាំពីរថ្ងៃ នៃថ្ងៃធ្វើការ។ សម្រាប់ការស្នើសុំសម្ភារៈ ក្រៅប្រទេសត្រូវធ្វើឡើងអោយបានមុន<br>៣ខែ នៃថ្ងៃធ្វើការ។ ប្រសិនបើលោកអ្នកមិនបានដឺងអំពីលក្ខណះនិងភាពលម្អិត(Specitication)របស់សម្ភារៈនោះទេសូមភ្ជាប់ឯកសារឬប្តូររូបភាពពាក់ព័ន្ធនិងការស្នើសុំនេះ។</td></tr>
            </table>
            <!-- authorize -->
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

