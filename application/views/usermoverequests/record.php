<table id="table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="table-header">
                <td>N<sup>o</sup></td>
                <td>User Move</td>
                <td>Duration</td>
                <!-- <td>Branch</td>
                <td>Requested By</td>
                <td>Requested At</td>
                <td>Approved By</td> -->
                <td class="center-table-data">Status</td>
                <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody class="small-text">
            <?php foreach ($lists as $key => $value) : ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo getUserFullName($value->user_id); ?></td>
                    <td><?php echo ucfirst($value->duration_move); ?></td>
                    <!-- <td><?php echo getBranchName($value->branch); ?></td>
                    <td><?php echo getUserFullName($value->requested_by); ?></td>
                    <td>
                        <?php
                            $colldate = strtotime($value->requested_at);
                            $collection_date = new DateTime(date('d-m-Y', $colldate));
                            echo $collection_date->format("d/m/Y");
                        ?>
                    </td>
                    <td><?php echo getUserFullName($value->approved_by); ?></td>-->

                    <!-- status -->
                    <!-- status -->
                    <td class="center-table-data"><?php echo $this->approval->showApprovalStatus($value->from_status); ?></td> 

                    <!-- button -->
                    <td class="center-table-data">
                        
                        <?php if($this->authorization->hasPermission($moduleName, "view")): ?>
                            <a href="<?php echo base_url('userMoveRequest/view?id=').$value->move_id; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View">View</a> 
                        <?php endif; ?>

                        <?php if($this->authorization->hasPermission($moduleName, "update")): ?>
                            <a href="<?php echo base_url('userMoveRequest/edit/').$value->move_id; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><span class="glyphicon glyphicon-cog"></span></a> 
                        <?php endif; ?>

                        <?php if($this->authorization->hasPermission($moduleName, "delete")): ?>
                            <a href="<?php echo base_url('userMoveRequest/delete?id=').$value->move_id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    var table;

    table = $('#table').DataTable({
        "bLengthChange": false, // hide show entities
    });
    $('.dataTables_wrapper .dataTables_filter').remove();

    $('#form-search-input').on('keyup change', function () {
        table.search(this.value).draw();
    });
</script>