<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("view").' '.lang('loan_ruledetail'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal")) ?>
            <!-- ruledetail_code -->
            <div class="form-group">
                <label for="ruledetail_code" class="col-md-3 label-heading"><?php echo lang('ruledetail_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="ruledetail_code" class="form-control" name="ruledetail_code" value="<?php echo (!empty($data) ? $data->ruledetail_code : ''); ?>" required>
                    <span class="text-danger"><?php echo form_error('ruledetail_code'); ?></span>
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
            <!-- rule_id -->
            <div class="form-group">
                <label for="rule_id" class="col-md-3 label-heading"><?php echo lang('rule_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="rule_id" id="rule_id">
                        <option>--- select rule_id ---</option>
                        <?php foreach ($rules as $rule): ?>
                            <?php if(!empty($data)){
                                $selected = '';
                                if($data->rule_id == $rule->id){
                                    $selected = 'selected';
                                }
                            } ?>
                        <option value="<?php echo $rule->id;?>" <?php echo $selected; ?>><?php echo $rule->rule_code.' - '.$rule->name_en.' '.$rule->name_kh; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('rule_id'); ?></span>
                </div>
            </div>
            <!-- min_amount -->
            <div class="form-group">
                <label for="min_amount" class="col-md-3 label-heading"><?php echo lang('min_amount'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="min_amount" value="<?php echo (!empty($data) ? $data->min_amount : ''); ?>" class="form-control" id="min_amount" required>
                    <span class="text-danger"><?php echo form_error('min_amount'); ?></span>
                </div>
            </div>
            <!-- max_amount -->
            <div class="form-group">
                <label for="max_amount" class="col-md-3 label-heading"><?php echo lang('max_amount'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="max_amount" value="<?php echo (!empty($data) ? $data->max_amount : ''); ?>" class="form-control" id="max_amount" required>
                    <span class="text-danger"><?php echo form_error('max_amount'); ?></span>
                </div>
            </div>
            <!-- min_term -->
            <div class="form-group">
                <label for="min_term" class="col-md-3 label-heading"><?php echo lang('min_term'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="number" name="min_term" value="<?php echo (!empty($data) ? $data->min_term : ''); ?>" class="form-control" id="min_term" required>
                    <span class="text-danger"><?php echo form_error('min_term'); ?></span>
                </div>
            </div>
            <!-- max_term -->
            <div class="form-group">
                <label for="max_term" class="col-md-3 label-heading"><?php echo lang('max_term'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="number" name="max_term" value="<?php echo (!empty($data) ? $data->max_term : ''); ?>" class="form-control" id="max_term" required>
                    <span class="text-danger"><?php echo form_error('max_term'); ?></span>
                </div>
            </div>
            <!-- min_fee -->
            <div class="form-group">
                <label for="min_fee" class="col-md-3 label-heading"><?php echo lang('min_fee'); ?> (%)</label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="min_fee" value="<?php echo (!empty($data) ? $data->min_fee : ''); ?>" class="form-control" id="min_fee" required>
                    <span class="text-danger"><?php echo form_error('min_fee'); ?></span>
                </div>
            </div>
            <!-- max_fee -->
            <div class="form-group">
                <label for="max_fee" class="col-md-3 label-heading"><?php echo lang('max_fee'); ?> (%)</label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="max_fee" value="<?php echo (!empty($data) ? $data->max_fee : ''); ?>" class="form-control" id="max_fee" required>
                    <span class="text-danger"><?php echo form_error('max_fee'); ?></span>
                </div>
            </div>
            <!-- reduce_amount -->
            <div class="form-group">
                <label for="reduce_amount" class="col-md-3 label-heading"><?php echo lang('reduce_amount'); ?> (%)</label>
                <div class="col-md-9 ui-front">
                    <input type="text" name="reduce_amount" value="<?php echo (!empty($data) ? $data->reduce_amount : ''); ?>" class="form-control" id="reduce_amount" required>
                    <span class="text-danger"><?php echo form_error('reduce_amount'); ?></span>
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

