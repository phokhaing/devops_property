<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("edit").' '.lang('loan_category'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal")) ?>
            <!-- category_code -->
            <div class="form-group">
                <label for="category_code" class="col-md-3 label-heading"><?php echo lang('category_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="category_code" class="form-control" name="category_code" value="<?php echo (!empty($data) ? $data->category_code : ''); ?>" required>
                    <span class="text-danger"><?php echo form_error('category_code'); ?></span>
                </div>
            </div>
            <!-- category_type -->
            <div class="form-group">
                <label for="categorytype_id" class="col-md-3 label-heading"><?php echo lang('categorytype_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="categorytype_id" id="categorytype_id">
                        <option>--- select category type ---</option>
                        <?php foreach ($categoryTypes as $type): ?>
                            <?php if(!empty($data)){
                                $selected = '';
                                if($data->categorytype_id == $type->id){
                                    $selected = 'selected';
                                }
                            }?>
                        <option value="<?php echo $type->id;?>" <?php echo $selected; ?>><?php echo $type->categorytype_code.'-'.$type->description; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('categorytype_id'); ?></span>
                </div>
            </div>
            <!-- currency -->
            <div class="form-group">
                <label for="currency" class="col-md-3 label-heading"><?php echo lang('currency'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="currency" id="currency">
                        <option>--- select currency ---</option>
                        <?php foreach ($currency as $curr): ?>
                        <?php if(!empty($data)){
                            $selected = '';
                            if($data->currency == $curr->id){
                                $selected = 'selected';
                            }
                        }?>
                        <option value="<?php echo $curr->id;?>" <?php echo $selected; ?>><?php echo $curr->name_en.' '.$curr->name_kh.' ('.$curr->currency_code.')'; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('currency'); ?></span>
                </div>
            </div>
            <!--description -->
            <div class="form-group">
                <label for="description" class="col-md-3 label-heading"><?php echo lang('description'); ?></label>
                <div class="col-md-9 ui-front">
                    <textarea class="form-control" name="description" id="description"><?php echo (!empty($data) ? $data->description : ''); ?></textarea>
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
                        ?>
                        <option value="1" <?php echo (($status == '1') ? 'selected' : ''); ?>> Active </option>
                        <option value="0" <?php echo (($status == '0') ? 'selected' : ''); ?>> In-Active </option>
                    </select>
                </div>
            </div>
            <div class="text-right">
               <button type="submit" onclick="return confirm('Are you sure you want to update this record?')" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_update") ?></button> <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
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

