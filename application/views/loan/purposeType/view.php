<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("view").' '.lang('loan_purposetype'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal")) ?>
            <!-- purposetype_code -->
            <div class="form-group">
                <label for="purposetype_code" class="col-md-3 label-heading"><?php echo lang('purposetype_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="purposetype_code" class="form-control" name="purposetype_code" value="<?php echo (!empty($data) ? $data->purposetype_code : ''); ?>" required>
                    <span class="text-danger"><?php echo form_error('purposetype_code'); ?></span>
                </div>
            </div>
            <!-- name_en -->
            <div class="form-group">
                <label for="name_en" class="col-md-3 label-heading"><?php echo lang('name_en'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="name_en" value="<?php echo (!empty($data) ? $data->name_en : ''); ?>" class="form-control" id="name_en" required>
                    <span class="text-danger"><?php echo form_error('name_en'); ?></span>
                </div>
            </div>
            <!-- name_kh -->
            <div class="form-group">
                <label for="name_kh" class="col-md-3 label-heading"><?php echo lang('name_kh'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="name_kh" value="<?php echo (!empty($data) ? $data->name_kh : ''); ?>" class="form-control" id="name_kh" required>
                    <span class="text-danger"><?php echo form_error('name_kh'); ?></span>
                </div>
            </div>
            <!-- category_id -->
            <div class="form-group">
                <label for="category_id" class="col-md-3 label-heading"><?php echo lang('category_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="category_id" id="category_id">
                        <option>--- select category ---</option>
                        <?php foreach ($category as $cat): ?>
                            <?php if(!empty($data)){
                                $selected = '';
                                if($data->category_id == $cat->id){
                                    $selected = 'selected';
                                }
                            }?>
                        <option value="<?php echo $cat->id;?>" <?php echo $selected; ?>><?php echo $cat->category_code.' - '.$cat->description; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('category_id'); ?></span>
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
                <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Close</a> 
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

