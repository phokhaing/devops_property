<table id="table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="table-header">
            <?php if($status == 'checked_detail' || $status == 'unauthorize_detail'): ?>
                <td>Ordered No. <span id="all-items" data-toggle="tooltip" data-placement="bottom" title="Click hide items" data-original-title="Click hide items" class="glyphicon glyphicon-minus text-right" onclick="hideAllItems('all-items');"></span></td>
            <?php else: ?>
                <td>Ref No.</td>
            <?php endif; ?>

            <td>Received From</td>            
            <td>GRN No.</td>
            <td>Date</td>
            <td>Phone</td>
            <td>Address</td>
            <td><?php echo lang('reference');?></td>
            <td class="center-table-data"><?php echo lang('status'); ?></td>
            <td>Prepared By</td>
            <td>Checked By</td>
            <td>Total Amount</td>
        </tr>
    </thead>
    <tbody id="list-data" class="small-text">
            <?php if(!empty($filters)): ?>
                <?php $total_amount = 0; ?>
                <?php foreach ($filters as $row): ?>
                    <tr>
                        <td><b><?php echo $row->grn_no; ?></b> <span id="item-<?php echo $row->id; ?>" data-toggle="tooltip" data-placement="bottom" title="Click hide item" data-original-title="Click hide item" class="glyphicon glyphicon-minus text-right" onclick="hideItem('item-<?php echo $row->id; ?>');"></span></td>
                        <td><?php echo findSupplierName($row->received_from); ?></td>
                        <td><?php echo $row->ordered_no; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                        <td><?php echo $row->phone; ?></td>
                        <td><?php echo $row->address; ?></td>
                        <td><?php echo $row->reference; ?></td>
                        <td class="center-table-data"><?php echo findStatus($row->authorize_status); ?></td>
                        <td><?php echo getUserFullName($row->created_by); ?></td>
                        <td><?php echo getUserFullName($row->checked_by); ?></td>
                        <td><?php echo currency_format(1, $row->total_amount); ?></td>
                    </tr>

                    <!-- show items -->
                    <?php if(isset($status)):?>
                        <?php if($status == 'all' || $status == 'checked_detail' || $status == 'unauthorize_detail'): ?>
                            <?php $items = findGoodsReceivedNoteItemByID($row->id); ?>
                            <?php if(!empty($items)): ?>

                                <tr class="item-<?php echo $row->id; ?> all-items">
                                    <td colspan="2" class="text-right"><b>No.</b></td>
                                    <td style="display: none;"></td>
                                    <td><b>Item No.</b></td>
                                    <td><b>Description</b></td>
                                    <td><b>Ref No.</b></td>
                                    <td><b>UOM</b></td>
                                    <td><b>Price</b></td>
                                    <td colspan="4"><b>Remarks</b></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                    <td style="display: none;"></td>
                                </tr>

                                <?php foreach ($items as $key => $item): ?>

                                <tr class="item-<?php echo $row->id; ?> all-items">
                                    <td colspan="2" class="text-right"><?php echo $key+1; ?></td>
                                    <td style="display: none;"></td>
                                    <td><?php echo $item->item_no; ?></td>
                                    <td><?php echo $item->description; ?></td>
                                    <td><?php echo $item->ref_no; ?></td>
                                    <td><?php echo findMeasurementName($item->uom); ?></td>
                                    <td><?php echo currency_format(1, $item->price); ?></td>
                                    <td colspan="4"><?php echo $item->remark; ?></td>
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
            <th colspan="9" style="text-align:right">Total:</th>
            <th colspan="2" class="text-right"><?php echo currency_format(1, $total_amount); ?></th>
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
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 10 ).footer() ).html(
                '$'+pageTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' ( $'+ total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' total)'
            );
        }
    });
    $('.dataTables_wrapper .dataTables_filter').remove();

    $('#form-search-input').on('keyup change', function () {
        table.search(this.value).draw();
    });

</script>