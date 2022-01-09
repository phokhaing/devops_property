<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("edit").' '.lang('loan_product'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal")) ?>
            <!-- product_code -->
            <div class="form-group">
                <label for="product_code" class="col-md-3 label-heading"><?php echo lang('product_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="product_code" class="form-control" name="product_code" value="<?php echo (!empty($data) ? $data->product_code : ''); ?>" required>
                    <span class="text-danger"><?php echo form_error('product_code'); ?></span>
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
            <!-- ruledetail_id -->
            <div class="form-group">
                <label for="ruledetail_id" class="col-md-3 label-heading"><?php echo lang('ruledetail_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="ruledetail_id" id="ruledetail_id">
                        <option>--- select loan rule detail code ---</option>
                        <?php foreach ($ruleDetail as $rule): ?>
                            <?php if(!empty($data)){
                                $selected = '';
                                if($data->ruledetail_id == $rule->id){
                                    $selected = 'selected';
                                }
                            } ?>
                        <option value="<?php echo $rule->id;?>" <?php echo $selected; ?>><?php echo $rule->ruledetail_code.' - '.$rule->name_en; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('ruledetail_id'); ?></span>
                </div>
            </div>
            <!-- interest_id -->
            <div class="form-group">
                <label for="interest_id" class="col-md-3 label-heading"><?php echo lang('interest_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="interest_id" id="interest_id">
                        <option>--- select interest code ---</option>
                        <?php foreach ($interest as $inter): ?>
                            <?php if(!empty($data)){
                                $selected = '';
                                if($data->interest_id == $inter->id){
                                    $selected = 'selected';
                                }
                            } ?>
                        <option value="<?php echo $inter->id;?>" <?php echo $selected; ?>><?php echo $inter->interest_code.' ('.$inter->description.')'; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('interest_id'); ?></span>
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
                            } ?>
                        <option value="<?php echo $curr->id;?>" <?php echo $selected; ?>><?php echo $curr->name_en.' '.$curr->name_kh.' ('.$curr->currency_code.')'; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('currency'); ?></span>
                </div>
            </div>
            <!-- min_age -->
            <div class="form-group">
                <label for="min_age" class="col-md-3 label-heading"><?php echo lang('min_age'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="number" name="min_age" value="<?php echo (!empty($data) ? $data->min_age : ''); ?>" class="form-control" id="min_age" required>
                    <span class="text-danger"><?php echo form_error('min_age'); ?></span>
                </div>
            </div>
            <!-- max_age -->
            <div class="form-group">
                <label for="max_age" class="col-md-3 label-heading"><?php echo lang('max_age'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="number" name="max_age" value="<?php echo (!empty($data) ? $data->max_age : ''); ?>" class="form-control" id="max_age" required>
                    <span class="text-danger"><?php echo form_error('max_age'); ?></span>
                </div>
            </div>
            <!-- min_reduce_amount -->
            <div class="form-group">
                <label for="min_reduce_amount" class="col-md-3 label-heading"><?php echo lang('min_reduce_amount'); ?> (%)</label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="min_reduce_amount" value="<?php echo (!empty($data) ? $data->min_reduce_amount : ''); ?>" class="form-control" id="min_reduce_amount" required>
                    <span class="text-danger"><?php echo form_error('min_reduce_amount'); ?></span>
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

