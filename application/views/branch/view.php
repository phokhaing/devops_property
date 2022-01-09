<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("view_branch") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url("branch/update?id=".(!empty($data) ? $data->id_branch : '')), array("class" => "form-horizontal")) ?>
            <!-- branch code -->
            <div class="form-group">
                <label for="branch_code" class="col-md-3 label-heading"><?php echo lang('branch_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="branch_code" class="form-control" name="branch_code" value="<?php echo (!empty($data) ? $data->branch_code : 'NULL'); ?>" required>
                    <span class="text-danger"><?php echo form_error('branch_code'); ?></span>
                </div>
            </div>
            <!-- branch name en -->
            <div class="form-group">
                <label for="branch_name" class="col-md-3 label-heading"><?php echo lang('branch_name'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="branch_name" class="form-control" name="branch_name" value="<?php echo (!empty($data) ? $data->branch_name : 'NULL'); ?>" required>
                    <span class="text-danger"><?php echo form_error('branch_name'); ?></span>
                </div>
            </div>
            <!-- branch name kh -->
            <div class="form-group">
                <label for="branch_name_kh" class="col-md-3 label-heading"><?php echo lang('branch_name_kh'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="branch_name_kh" class="form-control" name="branch_name_kh" value="<?php echo (!empty($data) ? $data->branch_name_kh : 'NULL'); ?>" required>
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
                        
                        <?php 
                          $selected = '';
                          if(!empty($data) && $data->manager_name == $user->ID){
                             $selected = 'selected';
                          } 
                        ?>
                        <option value="<?php echo $user->ID; ?>" <?php echo $selected; ?>><?php echo ucwords($user->first_name).' '.ucwords($user->last_name);?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <!-- email -->
            <div class="form-group">
                <label for="email" class="col-md-3 label-heading"><?php echo lang('email'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="email" id="email" class="form-control" name="email" value="<?php echo (!empty($data) ? $data->email : 'NULL'); ?>">
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
            </div>
            <!--status-->
            <div class="form-group">
                <label for="status" class="col-md-3 label-heading">Status</label>
                <div class="col-md-9 ui-front">
                    <select name="status" id="status" class="form-control select2" required>
                        <?php 
                        $status = '0';
                        if(!empty($data)){
                            $status = $data->status;
                        }
                        ?>
                        <option value="1" <?php echo (($status == '1') ? 'selected' : ''); ?>> Active </option>
                        <option value="0" <?php echo (($status == '0') ? 'selected' : ''); ?>> In-Active </option>
                    </select>
                </div>
            </div>
            <!-- created_by -->
            <div class="form-group">
                <label for="created_by" class="col-md-3 label-heading"><?php echo lang('created_by'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="created_by" class="form-control" name="created_by" value="<?php echo getUserFullName(!empty($data) ? $data->created_by : ''); ?>" readonly>
                    <span class="text-danger"><?php echo form_error('created_by'); ?></span>
                </div>
            </div>
            <!-- created_at -->
            <div class="form-group">
                <label for="created_at" class="col-md-3 label-heading"><?php echo lang('created_at'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="created_at" class="form-control" name="created_at" value="<?php echo (!empty($data) ? $data->created_at : ''); ?>" readonly>
                    <span class="text-danger"><?php echo form_error('created_at'); ?></span>
                </div>
            </div>
            <!-- updated_by -->
            <div class="form-group">
                <label for="updated_by" class="col-md-3 label-heading"><?php echo lang('updated_by'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="updated_by" class="form-control" name="updated_by" value="<?php echo getUserFullName(!empty($data) ? $data->updated_by : ''); ?>" readonly>
                    <span class="text-danger"><?php echo form_error('updated_by'); ?></span>
                </div>
            </div>
            <!-- updated_at -->
            <div class="form-group">
                <label for="updated_at" class="col-md-3 label-heading"><?php echo lang('updated_at'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="updated_at" class="form-control" name="updated_at" value="<?php echo (!empty($data) ? $data->updated_at : ''); ?>" readonly>
                    <span class="text-danger"><?php echo form_error('updated_at'); ?></span>
                </div>
            </div>
            <div class="text-right">
                <a href="<?php echo base_url('branch'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Close</a> 
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

