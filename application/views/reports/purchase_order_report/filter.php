<table id="table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="table-header">
            <?php if($status == 'approved_detail' || $status == 'unauthorize_detail'): ?>
                <td>PO No. <span id="all-items" data-toggle="tooltip" data-placement="bottom" title="Click hide items" data-original-title="Click hide items" class="glyphicon glyphicon-minus text-right" onclick="hideAllItems('all-items');"></span></td>
            <?php else: ?>
                <td>PO No.</td>
            <?php endif; ?>

            <td>Project Name</td>
            <td>Name Shope</td>             
            <td>Date</td>
            <td>Deadline</td>
            <td>Contact</td>
            <td>Phone</td>
            <td>PR No.</td>
            <td>Cheque</td>
            <td>Payment Term</td>
            <td>Warranty</td>
            <td>Warranty Contact</td>
            <td>Delivery</td>
            <td>Delivery Contact</td>
            <td>Location</td>
            <td>Address</td>
            <td><?php echo lang('reference');?></td>
            <td class="center-table-data"><?php echo lang('status'); ?></td>
            <td>Order By</td>
            <td>Order Date</td>
            <td>Receiver</td>
            <td>Request By</td>
            <td>Checked By</td>
            <td>Approved By</td>
            <td>Sub Total</td>
            <td>Discount</td>
            <td>Deposit</td>
            <td>Grand Total</td>
        </tr>
    </thead>
    <tbody id="list-data" class="small-text">
            <?php if(!empty($filters)): ?>
                <?php $total_amount = 0; ?>
                <?php foreach ($filters as $row): ?>
                    <tr>
                        <td><b><?php echo $row->po_no; ?></b> <span id="item-<?php echo $row->id; ?>" data-toggle="tooltip" data-placement="bottom" title="Click hide item" data-original-title="Click hide item" class="glyphicon glyphicon-minus text-right" onclick="hideItem('item-<?php echo $row->id; ?>');"></span></td>
                        <td><?php echo findProjectName($row->project); ?></td>
                        <td><?php echo findSupplierName($row->name_shop); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row->deadline)); ?></td>
                        <td><?php echo $row->contact; ?></td>
                        <td><?php echo $row->phone_number; ?></td>
                        <td><?php echo $row->pr_no; ?></td>
                        <td><?php echo $row->cheque; ?></td>
                        <td><?php echo $row->payment_term; ?></td>
                        <td><?php echo $row->warranty; ?></td>
                        <td><?php echo $row->warranty_contact; ?></td>
                        <td><?php echo $row->delivery; ?></td>
                        <td><?php echo $row->delivery_phone_number; ?></td>
                        <td><?php echo $row->location; ?></td>
                        <td><?php echo $row->address; ?></td>
                        <td><?php echo $row->reference; ?></td>
                        <td class="center-table-data"><?php echo findStatus($row->authorize_status); ?></td>
                        <td><?php echo $row->order_by; ?></td>
                        <td><?php echo $row->order_date; ?></td>
                        <td><?php echo $row->reciever; ?></td>
                        <td><?php echo getUserFullName($row->created_by); ?></td>
                        <td><?php echo getUserFullName($row->checked_by); ?></td>
                        <td><?php echo getUserFullName($row->approved_by); ?></td>
                        <td><?php echo currency_format(1, $row->sub_total_amount); ?></td>
                        <td><?php echo currency_format(1, $row->discount); ?></td>
                        <td><?php echo currency_format(1, $row->deposit); ?></td>
                        <td><?php echo currency_format(1, $row->total_amount); ?></td>
                    </tr>

                    <!-- show items -->
                    <?php if(isset($status)):?>
                        <?php if($status == 'all' || $status == 'approved_detail' || $status == 'unauthorize_detail'): ?>
                            <?php $items = findPurchaseOrderItemByID($row->id); ?>
                            <?php if(!empty($items)): ?>

                                <tr class="item-<?php echo $row->id; ?> all-items">
                                    <td colspan="2" class="text-right"><b>No.</b></td>
                                    <td style="display: none;"></td>
                                    <td><b>Description</b></td>
                                    <td><b>UOM</b></td>
                                    <td><b>Quantity</b></td>
                                    <td><b>Price</b></td>
                                    <td colspan="22"><b>Total</b></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                </tr>

                                <?php foreach ($items as $key => $item): ?>

                                <tr class="item-<?php echo $row->id; ?> all-items">
                                    <td colspan="2" class="text-right"><?php echo $key+1; ?></td>
                                    <td style="display: none;"></td>
                                    <td><?php echo $item->description; ?></td>
                                    <td><?php echo findMeasurementName($item->uom); ?></td>
                                    <td><?php echo $item->quantity; ?></td>
                                    <td><?php echo currency_format(1, $item->price); ?></td>
                                    <td colspan="22"><?php echo currency_format(1, $item->total); ?></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                </tr>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif;?>
                    <?php endif;?>
                
                <?php $total_amount += $row->total_amount; ?>
                <?php endforeach; ?>
            <?php endif;?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="25" style="text-align:right">Total:</th>
            <th colspan="3" class="text-right"><?php echo currency_format(1, $total_amount); ?></th>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    var table;
    var baseURL = "<?php echo site_url($link); ?>";
    // var total_page = '<?php //echo count($filters); ?>';
    // if(total_page > 10){
    //     total_page = '400px';
    // }else{
    //     total_page =  '200px';
    // }

    // var table = $('#table').DataTable({
    //     "ordering": false,
    //     "scrollY": total_page,
    //     "paging": false
    // } );
    table = $('#table').DataTable({
        "ordering": false,
        "bLengthChange": false, // hide show entities
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 27 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 27, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 27 ).footer() ).html(
                '$'+pageTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' ( $'+ total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' total)'
            );
        }
    });
    $('.dataTables_wrapper .dataTables_filter').remove();

    $('#form-search-input').on('keyup change', function () {
        table.search(this.value).draw();
    });

</script>