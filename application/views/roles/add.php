<!-- from add role -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<div class="white-area-content">
    <!-- label header -->
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("add_role") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url("role/create"), array("class" => "form-horizontal")) ?>
            <!-- role name -->
            <div class="form-group">
                <label for="role_name" class="col-md-3 label-heading">Role Name</label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="role_name" class="form-control" name="role_name" value="<?php echo set_value('role_name') ?>" required>
                    <span class="text-danger"><?php echo form_error('role_name'); ?></span>
                </div>
            </div>
            <!--status-->
            <div class="form-group">
                <label for="status" class="col-md-3 label-heading">Status</label>
                <div class="col-md-9 ui-front">
                    <select name="status" id="status" class="form-control select2" required>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('status'); ?></span>
                </div>
            </div>

            <!-- button action -->
            <div class="text-right">
                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_save") ?></button> 
                <a href="<?php echo base_url('role'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
            </div>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();

    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>

