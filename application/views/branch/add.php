<!-- from add branch -->
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
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("add_branch") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url("branch/create"), array("class" => "form-horizontal")) ?>
            <!-- branch code -->
            <div class="form-group">
                <label for="branch_code" class="col-md-3 label-heading"><?php echo lang('branch_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="branch_code" class="form-control" name="branch_code" value="<?php echo set_value('branch_code') ?>" required>
                    <span class="text-danger"><?php echo form_error('branch_code'); ?></span>
                </div>
            </div>
            <!-- branch name en -->
            <div class="form-group">
                <label for="branch_name" class="col-md-3 label-heading"><?php echo lang('branch_name'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="branch_name" class="form-control" name="branch_name" value="<?php echo set_value('branch_name') ?>" required>
                    <span class="text-danger"><?php echo form_error('branch_name'); ?></span>
                </div>
            </div>
            <!-- branch name kh -->
            <div class="form-group">
                <label for="branch_name_kh" class="col-md-3 label-heading"><?php echo lang('branch_name_kh'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="branch_name_kh" class="form-control" name="branch_name_kh" value="<?php echo set_value('branch_name_kh') ?>" required>
                    <span class="text-danger"><?php echo form_error('branch_name_kh'); ?></span>
                </div>
            </div>

            <!--manager_name-->
            <div class="form-group">
                <label for="manager_name" class="col-md-3 label-heading"><?php echo lang('manager_name'); ?></label>
                <div class="col-md-9 ui-front">
                    <select name="manager_name" id="manager_name" class="form-control select2">
                        <option value="0">--- Select manager ---</option>
                        <?php if(!empty(getAllUsers())): ?>
                        <?php foreach (getAllUsers() as $user): ?>
                        <option value="<?php echo $user->ID; ?>"><?php echo ucwords($user->first_name).' '.ucwords($user->last_name);?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <!-- email -->
            <div class="form-group">
                <label for="email" class="col-md-3 label-heading"><?php echo lang('email'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="email" id="email" class="form-control" name="email" value="<?php echo set_value('email') ?>">
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
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
                </div>
            </div>

            <!-- button action -->
            <div class="text-right">
                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_save") ?></button> 
                <a href="<?php echo base_url('branch'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
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

