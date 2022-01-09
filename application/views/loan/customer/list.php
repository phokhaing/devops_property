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
        <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("list").' '.lang('customer_info'); ?>
        </div>
        <div class="db-header-extra form-inline">
            <!-- filter -->
            <div class="input-group input-sm">
                <span class="input-group-addon" style="background-color: #286091;border-color: #286091;color:#ffffff; font-size: 13px;">Filter</span>
                <select id="filter" class="form-control select2 input-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                    <option value="all"> All </option>
                    <option value="active"> Active </option>
                    <option value="inactive"> Inactive </option>
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
                    <td><?php echo lang('customer_id'); ?></td>
                    <td><?php echo lang('firstname_en'); ?></td>
                    <td><?php echo lang('lastname_en'); ?></td>
                    <td><?php echo lang('firstname_kh'); ?></td>
                    <td><?php echo lang('lastname_kh'); ?></td>
                    <td><?php echo lang('gender'); ?></td>
                    <td><?php echo lang('officer'); ?></td>                
                    <td><?php echo lang('created_by'); ?></td>
                    <td><?php echo lang('created_at'); ?></td>
                    <td class="center-table-data"><?php echo lang('status'); ?></td>
                    <td class="text-center"><?php echo lang('action'); ?></td>
                </tr>
            </thead>
            <tbody id="list-data" class="small-text">
                    <?php 
                        $i=1;
                        foreach ($data as $row): ?>
                        <tr>
                            <td><?php echo $row->customer_id; ?></td>
                            <td><?php echo $row->firstname_en; ?></td>
                            <td><?php echo $row->lastname_en; ?></td>
                            <td><?php echo $row->firstname_kh; ?></td>
                            <td><?php echo $row->lastname_kh; ?></td>
                            <td><?php echo $row->gender; ?></td>
                            <td><?php echo getUserFullName($row->officer); ?></td>
                            <td><?php echo getUserFullName($row->created_by); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row->created_at)); ?></td>
                            <!-- status -->
                            <td class="center-table-data">
                                <?php echo ($row->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-default">Inactive</span>'); ?>
                            </td>
                            <!-- button action -->
                            <td class="center-table-data">
                                <!-- <div class="btn-group"> -->
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
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="deleteConfirm('<?php echo base_url($link.'/delete?id=').$row->id; ?>');" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                <?php endif; ?>
                            <!-- </div> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('layout/modal_confirm'); ?>
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

    $('#filter').on('change', function () {
        if(this.value == 'all'){
           table.search('').draw();
        }else{
            var searchTerm = this.value.toLowerCase(),
            regex = '\\b' + searchTerm + '\\b';
            table.rows().search(regex, true, false).draw();
        }
    });

</script>
<script>
    $("#alert-success").fadeTo(8000, 8000).slideUp(500, function(){
        $("#alert-success").alert('close');
    });
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>
