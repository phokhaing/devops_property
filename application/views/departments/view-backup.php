<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("view_department") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url("department/update?id=".(!empty($data) ? $data->id_department : '')), array("class" => "form-horizontal")) ?>
            <!-- department name -->
            <div class="form-group">
                <label for="department_name" class="col-md-3 label-heading"><?php echo lang('department_name'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="department_name" class="form-control" name="department_name" value="<?php echo (!empty($data) ? $data->department_name : ''); ?>" required>
                    <span class="text-danger"><?php echo form_error('department_name'); ?></span>
                </div>
            </div>
            <!-- department name kh -->
            <div class="form-group">
                <label for="department_name_kh" class="col-md-3 label-heading"><?php echo lang('department_name_kh'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="department_name_kh" class="form-control" name="department_name_kh" value="<?php echo (!empty($data) ? $data->department_name_kh : ''); ?>" required>
                    <span class="text-danger"><?php echo form_error('department_name_kh'); ?></span>
                </div>
            </div>
            <!--parent_id-->
            <!-- <div class="form-group">
                <label for="parent_id" class="col-md-3 label-heading"><?php echo lang('parent_id'); ?></label>
                <div class="col-md-9 ui-front">
                    <select name="parent_id" id="parent_id" class="form-control select2" required>
                        <option><?php echo ucwords(getDepartmentNameENByID($data->parent_id));?></option>
                    </select>
                </div>
            </div> -->
            
            <!-- show parent -->
            <?php if(!empty(viewDepartmentCatetories($data->parent_id))): ?>
                <?php foreach (viewDepartmentCatetories($data->parent_id) as $value): ?>
                    <div class="form-group">
                        <label for="parent_id" class="col-md-3 label-heading"><?php echo lang('parent_id'); ?></label>
                        <div class="col-md-9 ui-front">
                            <select name="parent_id" id="parent_id" class="form-control select2" required>
                                <option><?php echo $value; ?></option>
                            </select>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <!-- end show parent -->

            <!--status-->
            <div class="form-group">
                <label for="status" class="col-md-3 label-heading"><?php echo lang('status'); ?></label>
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
                <a href="<?php echo base_url('department'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Close</a> 
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

