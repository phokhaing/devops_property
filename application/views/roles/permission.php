
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
        <div class="page-header-title"><a href="<?php echo site_url('role'); ?>" title="Back To Role"><?php echo lang("role"); ?></a> / <?php echo getRoleName($roleId) ?> / <?php echo lang("set_permission"); ?>
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
            <div class="form-group has-feedback no-margin">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                    <div class="input-group-btn">
                        <input type="hidden" id="search_type" value="0">
                    </div><!-- /btn-group -->
                </div>
            </div>
            <a href="<?php echo site_url("role/setModule?role=".$roleId) ?>" class="btn btn-primary btn-sm"><?php echo lang("add_module") ?></a>
            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
        </div>
    </div>

    <div class="table-responsive">
        <table id="table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="table-header">
                    <th>No</th>
                    <th>Module Access</th>
                    <th> 
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" value="" title="Check All" onchange="checkAll()" id="check-all">
                            <label class="custom-control-label" for="" id="check-proccess">Permission Access</label>
                        </div>
                    </th>
                    <th class="hidden-sm">Action</th>
                </tr>
            </thead>
            <tbody id="list-accessright" class="small-text">
                    <?php 
                        $isCheckedAll = true;
                        if (isset($data) && empty($data)) {
                            $isCheckedAll = false;
                        }
                        
                        $i=1;
                        foreach ($data as $row): ?>
                           <tr>
                                <td><b><?php echo $i++; ?></b></td>
                                <td><b><?php echo strtoupper($row['module_name']); ?></b></td>
                                <td>
                                    <?php foreach ($permissions as $permission) { 
                                            $isChecked = checkedPermission($_GET['role'], $row['module_id'],$permission['permission_id']);
                                            if($isChecked == 0){
                                                $isCheckedAll = false;
                                            }
                                        ?>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" <?php echo ($isChecked != 0 ? 'checked' : ''); ?> class="custom-control-input" value="<?php echo checkedPermission($_GET['role'], $row['module_id'],$permission['permission_id']); ?>" onchange="checkPermission('<?php echo strtolower(str_replace('/', '-', $row['module_name']).'-'.str_replace('/', '-', $permission['permission_name'])); ?>',<?php echo $row['module_id'] ?>,<?php echo $permission['permission_id']; ?>);" id="<?php echo strtolower(str_replace('/', '-', $row['module_name']).'-'.str_replace('/', '-', $permission['permission_name'])); ?>">
                                            <label class="custom-control-label" for="<?php echo strtolower(str_replace('/', '-', $row['module_name']).'-'.str_replace('/', '-', $permission['permission_name'])); ?>"><?php echo $permission['permission_name'] ?></label>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($this->authorization->hasPermission($moduleName, "delete")): ?>
                                        <a href="<?php echo base_url('role/deleteRoleModule?role_id='.$roleId.'&id='.$row['id'].'&module_id='.$row['module_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    <?php endforeach;?>
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
    $(document).ready(function(){
        var isCheckedAll = '<?php echo $isCheckedAll; ?>';
        if(isCheckedAll == true){
            $('#check-all').prop('checked', true); 
        }else{
            $('#check-all').prop('checked', false);  
        }
    }); 

    var table;
    var baseURL = global_base_url+"role";

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

    function checkPermission(div, moduleId, permissionId){
        var value = $('#'+div).val();
        $.ajax({
            url: baseURL+'/checkPermission',
            type: 'GET',
            dataType: 'json',
            data: {
                'modulePermissionId': value,
                'moduleId': moduleId,
                'permissionId': permissionId,
                'roleId': '<?php echo $_GET['role']; ?>'
            },
            success: function(response){ 
                if(value == 0){// current unchecked set to checked
                    $('#'+div).val(response);   
                }else{// current checked set to unchecked
                    $('#'+div).val(0);
                }
            },
            error: function(){
                $('#'+div).removeAttr('checked');
            }
        });
    }

    function setCheckAll(div, moduleId, permissionId)
    {
        var checkBox = document.getElementById("check-all");
        
        var roleId =  <?php echo $_GET['role']; ?>;
        var value = 0;

        $.ajax({
            url: baseURL+'/ischeckedPermission/'+roleId+'/'+moduleId+'/'+permissionId,
            type: 'GET',
            success: function(response){
                value = response;  

                // check all except record checked
                if(checkBox.checked == true && value == 0){
                    $.ajax({
                        url: baseURL+'/checkPermission',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            'modulePermissionId': value,
                            'moduleId': moduleId,
                            'permissionId': permissionId,
                            'roleId': '<?php echo $_GET['role']; ?>'
                        },
                        beforeSend: function () {
                            $('#check-proccess').text('Loading...');
                        },
                        success: function(response){
                            $('#check-proccess').text('Permission Access');
                            $('#'+div).val(response);  
                            $('#'+div).prop('checked', true);  
                        },
                        error: function(){
                            $('#'+div).removeAttr('checked');
                        }
                    });
                }

                // uncheck all except record checked
                if(checkBox.checked == false && value !=0){ 
                    $.ajax({
                        url: baseURL+'/checkPermission',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            'modulePermissionId': value,
                            'moduleId': moduleId,
                            'permissionId': permissionId,
                            'roleId': '<?php echo $_GET['role']; ?>'
                        },
                        beforeSend: function () {
                            $('#check-proccess').text('Loading...');
                        },
                        success: function(response){ 
                            $('#check-proccess').text('Permission Access');
                            $('#'+div).prop('checked', false);  
                            $('#'+div).val(0);  
                        },
                        error: function(){
                            $('#'+div).removeAttr('checked');
                        }
                    });
                }
            }
        });
    }

    function checkAll()
    {   
        var checkBox = document.getElementById("check-all");
        var div = null;
        var moduleId = null;
        var permissionId = null;
        var modules = <?php echo json_encode($data); ?>;
        var permissions = <?php echo json_encode($permissions); ?>;

        for (var i = 0; i < modules.length; i++) 
        {
            for (var j = 0; j < permissions.length; j++)
            {
                div = modules[i].module_name.replace('/', '-').toLowerCase()+'-'+permissions[j].permission_name.replace('/', '-').toLowerCase();
                moduleId = modules[i].module_id;
                permissionId = permissions[j].permission_id;
                setCheckAll(div, moduleId, permissionId);
            }
        }
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
