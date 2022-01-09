<table id="table" class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="table-header">
            <td>N<sup>o</sup></td>
            <th><?php echo lang('rule_code'); ?></th>
            <th><?php echo lang('name_en'); ?></th>
            <th><?php echo lang('name_kh'); ?></th>
            <th><?php echo lang('created_by'); ?></th>
            <th><?php echo lang('created_at'); ?></th>
            <td class="center-table-data"><?php echo lang('status'); ?></td>
            <td class="text-center"><?php echo lang('action'); ?></td>
        </tr>
    </thead>
    <tbody id="list-data" class="small-text">
            <?php 
                $i=1;
                foreach ($data as $row): ?>
                <tr>
                    <td><b><?php echo $i++; ?></b></td>
                    <td><b><?php echo $row->rule_code; ?></b></td>
                    <td><b><?php echo $row->name_en; ?></b></td>
                    <td><b><?php echo $row->name_kh; ?></b></td>
                    <td><?php echo getUserFullName($row->created_by); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row->created_at));; ?></td>
                    <!-- status -->
                    <td class="center-table-data">
                        <?php echo ($row->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'); ?>
                    </td>
                    <!-- button action -->
                    <td class="center-table-data">
                        <!-- button view -->
                        <?php if($this->authorization->hasPermission($moduleName, "view")):?>
                            <a href="<?php echo base_url($link.'/view?id=').$row->id; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View">View</a> 
                        <?php endif; ?>
                        <!-- button update -->
                        <?php if($this->authorization->hasPermission($moduleName, "update")):?>
                            <a href="<?php echo base_url($link.'/edit?id=').$row->id; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><span class="glyphicon glyphicon-cog"></span></a> 
                        <?php endif; ?>
                        <!-- button delete -->
                        <?php if($this->authorization->hasPermission($moduleName, "delete")):?>
                            <a href="<?php echo base_url($link.'/delete?id=').$row->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you?')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    var table;
    var baseURL = "<?php echo site_url($link); ?>";

    table = $('#table').DataTable({
    "bLengthChange": false, // hide show entities
    });
    $('.dataTables_wrapper .dataTables_filter').remove();

    $('#form-search-input').on('keyup change', function () {
    table.search(this.value).draw();
    });
</script>