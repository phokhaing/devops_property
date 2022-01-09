<table id="table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="table-header">
            <td>No.</td>
            <td>Full Name</td>
            <td>Gender</td>              
            <td>Position</td>
            <td>Division</td>
            <td>Staff ID</td>
            <td>Subject</td>
            <td>Content</td>
            <td>Reason</td>
            <td>Reference</td>
            <td class="center-table-data"><?php echo lang('status'); ?></td>
            <td>Date</td>
            <td>Created By</td>
            <td>Created At</td>
            <td>Prepared By</td>
            <td>Prepared At</td>
            <td>Checked By</td>
            <td>Checked At</td>
            <td>Approved By</td>
            <td>Approved At</td>
            <td>Rejected By</td>
            <td>Rejected At</td>
        </tr>
    </thead>
    <tbody id="list-data" class="small-text">
        <?php 
        if(!empty($filters)):
            foreach ($filters as $row): ?>
            <tr>
                <td><b><?php echo $row->id; ?></b></td>
                <td><?php echo $row->fullname; ?></td>
                <td><?php echo $row->gender; ?></td>
                <td><?php echo $row->position; ?></td>
                <td><?php echo $row->division; ?></td>
                <td><?php echo $row->staff_id; ?></td>
                <td><?php echo $row->subject; ?></td>
                <td><?php echo $row->content; ?></td>
                <td><?php echo $row->reason; ?></td>
                <td><?php echo $row->reference; ?></td>
                <td class="center-table-data"><?php echo findStatus($row->authorize_status); ?></td>
                <td><?php echo ($row->date != null ? date('d/m/Y', strtotime($row->date)) : ''); ?></td>
                <td><?php echo getUserFullName($row->created_by); ?></td>
                <td><?php echo ($row->created_at != null ? date('d/m/Y H:i:sa', strtotime($row->created_at)) : ''); ?></td>
                <td><?php echo getUserFullName($row->created_by); ?></td>
                <td><?php echo ($row->created_at != null ? date('d/m/Y H:i:sa', strtotime($row->created_at)) : ''); ?></td>
                <td><?php echo getUserFullName($row->checked_by); ?></td>
                <td><?php echo ($row->checked_at != null ? date('d/m/Y H:i:sa', strtotime($row->checked_at)) : ''); ?></td>
                <td><?php echo getUserFullName($row->approved_by); ?></td>
                <td><?php echo ($row->approved_at != null ? date('d/m/Y H:i:sa', strtotime($row->approved_at)) : ''); ?></td>
                <td><?php echo getUserFullName($row->rejected_by); ?></td>
                <td><?php echo ($row->rejected_at != null ? date('d/m/Y H:i:sa', strtotime($row->rejected_at)) : ''); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
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
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 12 ).footer() ).html(
                '$'+pageTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' ( $'+ total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' total)'
            );
        }
    });
    $('.dataTables_wrapper .dataTables_filter').remove();

    $('#form-search-input').on('keyup change', function () {
        table.search(this.value).draw();
    });

</script>