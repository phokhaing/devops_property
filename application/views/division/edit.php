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
            <!-- name_en -->
            <div class="form-group">
                <label for="name_en" class="col-md-3 label-heading"><?php echo lang('name_en'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="name_en" class="form-control" name="name_en" value="<?php echo (set_value('name_en') == false ? $data->name_en : set_value('name_en')); ?>" required>
                    <span class="text-danger"><?php echo form_error('name_en'); ?></span>
                </div>
            </div>
            <!-- name_kh -->
            <div class="form-group">
                <label for="name_kh" class="col-md-3 label-heading"><?php echo lang('name_kh'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="name_kh" class="form-control" name="name_kh" value="<?php echo (set_value('name_kh') == false ? $data->name_kh : set_value('name_kh')); ?>" required>
                    <span class="text-danger"><?php echo form_error('name_kh'); ?></span>
                </div>
            </div>
            <!--status-->
            <div class="form-group">
                <label for="status" class="col-md-3 label-heading">Status</label>
                <div class="col-md-9 ui-front">
                    <select name="status" id="status" class="form-control select2" required>
                        <?php 
                            $status = $data->status;
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
               <span id="submit_loader" style="display:none;"></span>
                <?php if($this->authorization->hasPermission($moduleName, "create")): ?>
                    <button type="button" id="btn-submit" onclick="updateConfirm();" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_update") ?></button> 
                <?php endif; ?>
               <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
            </div>
            
        <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php $this->load->view('layout/modal_confirm'); ?>
<script type="text/javascript">
    $('.select2').select2();

    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>

