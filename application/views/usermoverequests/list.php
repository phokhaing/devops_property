
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
        <div class="page-header-title"> <span class="glyphicon glyphicon-send"></span> <?php echo lang('usermoverequest') ?>
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

            <!-- filter -->
            <div class="input-group input-sm">
                <span class="input-group-addon" style="background-color: #286091;border-color: #286091;color:#ffffff; font-size: 13px;">Filter</span>
                <select id="filter" onchange="filter();" class="form-control select2 input-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                    <option value=""> All </option>
                    <?php if(!empty(getAllAuthorizeStatus())): ?>
                            <?php foreach (getAllAuthorizeStatus() as $status) : ?>
                                <option value="<?php echo $status->authorize_id; ?>"><?php echo ucfirst(strtolower($status->authorize_name)); ?></option>
                            <?php endforeach ?>
                    <?php endif; ?>
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
                        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
                            <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
                            <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
                            <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="title-exact"></span> <?php echo lang("ctn_425") ?></a></li>
                            <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="title2-exact"></span> <?php echo lang("ctn_481") ?></a></li>
                            <li><a href="#" onclick="change_search(4)"><span class="glyphicon glyphicon-ok no-display" id="title3-exact"></span> <?php echo lang("ctn_550") ?></a></li>
                            <li><a href="#" onclick="change_search(5)"><span class="glyphicon glyphicon-ok no-display" id="title4-exact"></span> <?php echo lang("ctn_551") ?></a></li>
                            <li><a href="#" onclick="change_search(6)"><span class="glyphicon glyphicon-ok no-display" id="title5-exact"></span> <?php echo lang("ctn_552") ?></a></li>
                            <li><a href="#" onclick="change_search(7)"><span class="glyphicon glyphicon-ok no-display" id="title6-exact"></span> <?php echo lang("ctn_611") ?></a></li>
                        </ul>
                    </div><!-- /btn-group -->
                </div>
            </div>
            <?php endif; ?>
            <?php if($this->authorization->hasPermission($moduleName, "create")): ?>
                <a href="<?php echo site_url("userMoveRequest/add") ?>" class="btn btn-primary btn-sm"><?php echo lang("add_new") ?></a>
            <?php endif; ?>
        </div>
    </div>

    <div class="table-responsive" id="table-list">
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
    </div>
</div>
<style type="text/css">
.dataTables_wrapper .dataTables_filter {
    visibility: hidden; /* hide datatable search box */
}
</style>
<script type="text/javascript">

    function remove(id){
        controller = "/role/delete/";
        responseDelete(baseURL+controller+id);
    } 

    var table;
    var baseURL = "<?php echo site_url(); ?>userMoveRequest";

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
            url: global_base_url + "userMoveRequest/findFilter/" + value,
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

