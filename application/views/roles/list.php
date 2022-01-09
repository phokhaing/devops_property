
<?php if(!empty($this->session->flashdata('success'))){ ?>
<div class="row" id="alert-success">
    <div class="col-md-12">
        <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('success') ?></div>
    </div>
</div>
<?php } ?>

<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-send"></span> <?php echo lang("role"); ?>
        </div>
        <div class="db-header-extra form-inline">
            <!-- short by -->
            <!-- <div class="btn-group">
                <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php echo lang("ctn_885") ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="">All</a></li>
                        <li><a href="">Unauthorize</a></li>
                        <li><a href="">Authorize</a></li>
                    </ul>
                </div>
            </div> -->           

            <!-- search -->
            <?php if($this->authorization->hasPermission($moduleName, "search")): ?>
                <div class="form-group has-feedback no-margin">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                        <div class="input-group-btn">
                            <input type="hidden" id="search_type" value="0">
                        </div><!-- /btn-group -->
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->authorization->hasPermission($moduleName, "create")): ?>
                <a href="<?php echo site_url("role/add") ?>" class="btn btn-primary btn-sm"><?php echo lang("add_role") ?></a>
            <?php endif; ?>
            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
        </div>
    </div>

    <div class="table-responsive">
        <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="table-header">
                        <td>N<sup>o</sup></td>
                        <th>role Name</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                        <td class="center-table-data">Status</td>
                        <td class="text-center">Action</td>
                </tr>
            </thead>
            <tbody id="list-accessright" class="small-text">
                    <?php 
                        $i=1;
                        foreach ($data as $row): ?>
                        <tr>
                            <td><b><?php echo $i++; ?></b></td>

                                <td><b><?php echo strtoupper($row['role_name']); ?></b></td>
                                <td><?php echo getUserFullName($row['created_by']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['created_at']));; ?></td>

                                <td class="center-table-data">
                                    <?php echo ($row['status'] == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'); ?>
                                </td>
                                <td class="center-table-data">
                                    <!-- setPermission button -->
                                    <?php if($this->authorization->hasPermission($moduleName, "view")): ?>
                                        <a href="<?php echo base_url('role/setPermission?role=').$row['role_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Set Permission" data-original-title="Set Permission"><span class="glyphicon glyphicon-lock"></span></a> 
                                    <?php endif; ?>

                                    <?php if($this->authorization->hasPermission($moduleName, "view")): ?>
                                        <a href="<?php echo base_url('role/view?id=').$row['role_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View">View</a> 
                                    <?php endif; ?>

                                    <?php if($this->authorization->hasPermission($moduleName, "update")): ?>
                                        <a href="<?php echo base_url('role/edit?id=').$row['role_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><span class="glyphicon glyphicon-cog"></span></a> 
                                    <?php endif; ?>

                                    <?php if($this->authorization->hasPermission($moduleName, "delete")): ?>
                                     <a href="<?php echo base_url('role/delete?id=').$row['role_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                    <?php endif; ?>
                                </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style type="text/css">
.dataTables_wrapper .dataTables_filter {
    visibility: hidden; /* hide datatable search box */
}
</style>
<script type="text/javascript">

    var table;
    var baseURL = "<?php echo site_url(); ?>accessRight";

    table = $('#table').DataTable({
        "bLengthChange": false, // hide show entities
    });
    $('.dataTables_wrapper .dataTables_filter').remove();

    $('#form-search-input').on('keyup change', function () {
        table.search(this.value).draw();
    });

    function filter(){
        var value = $('#filter').val();
        $.ajax({
            url: global_base_url + "accessRight/findFilter/" + value,
            type: "get",
            success: function (response) {
                $('#list-accessright').html(response);
            }
        });
    }


</script>
<script>
    $("#alert-success").fadeTo(8000, 8000).slideUp(500, function(){
        $("#alert-success").alert('close');
    });
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>
