<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("edit").' '.lang($title); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal")) ?>
            <!-- position_name_en -->
            <div class="form-group">
                <label for="position_name" class="col-md-3 label-heading"><?php echo lang('position_name_en'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="position_name" class="form-control" name="position_name" value="<?php echo (set_value('position_name') == false ? (!empty($data) ? $data->position_name : '') : set_value('position_name')); ?>" required>
                    <span class="text-danger"><?php echo form_error('position_name'); ?></span>
                </div>
            </div>
            <!-- position_name_kh -->
            <div class="form-group">
                <label for="position_name_kh" class="col-md-3 label-heading"><?php echo lang('position_name_kh'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="position_name_kh" class="form-control" name="position_name_kh" value="<?php echo (set_value('position_name_kh') == false ? (!empty($data) ? $data->position_name_kh : '') : set_value('position_name_kh')); ?>" required>
                    <span class="text-danger"><?php echo form_error('position_name_kh'); ?></span>
                </div>
            </div>
            <!-- description -->
            <div class="form-group">
                <label for="description" class="col-md-3 label-heading"><?php echo lang('description'); ?></label>
                <div class="col-md-9 ui-front">
                    <textarea class="form-control input-sm" name="description" id="description" rows="3"><?php echo (set_value('description') == false ? (!empty($data) ? $data->description : '') : set_value('description')); ?></textarea>
                    <span class="text-danger"><?php echo form_error('description'); ?></span>
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
                        if(set_value('status') != false){
                            $status = set_value('status');
                        }
                        ?>
                        <option value="1" <?php echo (($status == '1') ? 'selected' : ''); ?>> Active </option>
                        <option value="0" <?php echo (($status == '0') ? 'selected' : ''); ?>> In-Active </option>
                    </select>
                </div>
            </div>
            <div class="text-right">
               <button type="submit" onclick="return confirm('Are you sure you want to update this record?')" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_update") ?></button> <a href="<?php echo base_url('department'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
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

