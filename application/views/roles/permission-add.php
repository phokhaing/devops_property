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
        <?php echo form_open_multipart(site_url("role/createModule"), array("class" => "form-horizontal")) ?>
            <!-- module name -->
            <div class="form-group">
                <label for="role_name" class="col-md-3 label-heading">Module Name</label>
                <div class="col-md-9 ui-front">
                    <input type="hidden" class="form-control role_id" name="role_id" value="<?php echo $roleId; ?>">
                    <select class="form-control select2 module_id" name="module_id[]" multiple required>
                        <!-- <option value="">Select Modules</option> -->
                        <?php foreach ($modules as $value) { ?>
                        <option value="<?php echo $value['module_id']; ?>"><?php echo $value['module_name']; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('module_id'); ?></span>
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

