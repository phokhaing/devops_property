<!-- from add department -->
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
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("add_department") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url("department/create"), array("class" => "form-horizontal")) ?>
            <!-- department name en -->
            <div class="form-group">
                <label for="department_name" class="col-md-3 label-heading"><?php echo lang('department_name'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="department_name" class="form-control" name="department_name" value="<?php echo set_value('department_name') ?>" required>
                    <span class="text-danger"><?php echo form_error('department_name'); ?></span>
                </div>
            </div>
            <!-- department name kh -->
            <div class="form-group">
                <label for="department_name_kh" class="col-md-3 label-heading"><?php echo lang('department_name_kh'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="department_name_kh" class="form-control" name="department_name_kh" value="<?php echo set_value('department_name_kh') ?>" required>
                    <span class="text-danger"><?php echo form_error('department_name_kh'); ?></span>
                </div>
            </div>
            <!--parent_id-->
            <div class="form-group">
                <label for="parent_id" class="col-md-3 label-heading"><?php echo lang('parent_id'); ?></label>
                <div class="col-md-9 ui-front">
                    <select name="parent_id" id="parent_id" class="form-control select2" required>
                        <option value="0">--- Select parent ---</option>
                        <?php foreach ($data as $row): ?>
                        <option value="<?php echo $row['id_department']; ?>"><?php echo ucwords($row['department_name']);?></option>
                        <?php endforeach; ?>
                    </select>
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
                <a href="<?php echo base_url('department'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
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

