<!-- message success -->
<?php if(!empty($this->session->flashdata('success'))){ ?>
<div class="row" id="alert-success">
    <div class="col-md-12">
        <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('success') ?></div>
    </div>
</div>
<?php } ?>
<!-- message error -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-send"></span> <?php echo lang("loan_purpose") ?>
        </div>
        <div class="db-header-extra form-inline">
            <!-- filter -->
            <div class="input-group input-sm">
                <span class="input-group-addon" style="background-color: #286091;border-color: #286091;color:#ffffff; font-size: 13px;">Filter</span>
                <select id="filter" onchange="filter();" class="form-control select2 input-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                    <option value=""> All </option>
                    <option value="1"> Active </option>
                    <option value="0"> Inactive </option>
                </select>
            </div>          
            <!-- search -->
            <?php if($this->authorization->hasPermission($moduleName, "search")): ?>
            <div class="form-group has-feedback no-margin">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                    <div class="input-group-btn">
                        <input type="hidden" id="search_type" value="0">
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- button add -->
            <?php if($this->authorization->hasPermission($moduleName, "create")): ?>
                <a href="<?php echo site_url($link."/add") ?>" class="btn btn-primary btn-sm"><?php echo lang('add_new'); ?></a>
            <?php endif; ?>
            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
        </div>
    </div>
    <div class="table-responsive" id="table-list">
        <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="table-header">
                    <td>N<sup>o</sup></td>
                    <th><?php echo lang('purpose_code'); ?></th>
                    <!-- <th><?php echo lang('name_en'); ?></th> -->
                    <th><?php echo lang('name_kh'); ?></th>
                    <th><?php echo lang('purposetype_code'); ?></th>
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
                            <td><b><?php echo ucwords($row->purpose_code); ?></b></td>
                            <!-- <td><b><?php echo ucwords($row->name_en); ?></b></td> -->
                            <td><b><?php echo substr($row->name_kh, 0, 150); ?></b></td>
                            <td><b><?php echo getPurposeTypeCode($row->purposetype_id); ?></b></td>
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
    </div>
</div>

<style type="text/css">
.dataTables_wrapper .dataTables_filter {
    visibility: hidden; /* hide datatable search box */
}
</style>
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

    function filter(){
        var value = $('#filter').val();
        $.ajax({
            url: baseURL + "/findFilter/" + value,
            type: "get",
            success: function (response) {
                $('#table-list').html(response);
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
