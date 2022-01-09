<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("view").' '.lang('loan_interest_rate'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal")) ?>
            <!-- interestrate_code -->
            <div class="form-group">
                <label for="interestrate_code" class="col-md-3 label-heading"><?php echo lang('interestrate_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="interestrate_code" class="form-control" name="interestrate_code" value="<?php echo (!empty($data) ? $data->interestrate_code : ''); ?>" required>
                    <span class="text-danger"><?php echo form_error('interestrate_code'); ?></span>
                </div>
            </div>
            <!-- interest_id -->
            <div class="form-group">
                <label for="interest_id" class="col-md-3 label-heading"><?php echo lang('interest_code'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="interest_id" id="interest_id">
                        <option>--- select interest ---</option>
                        <?php foreach ($interest as $inter): ?>
                            <?php if(!empty($data)){
                                $selected = '';
                                if($data->interest_id == $inter->id){
                                    $selected = 'selected';
                                }
                            }?>
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
                            }?>
                        <option value="<?php echo $curr->id;?>" <?php echo $selected; ?>><?php echo $curr->name_en.' '.$curr->name_kh.' ('.$curr->currency_code.')'; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('currency'); ?></span>
                </div>
            </div>
            <!-- rate_amount -->
            <div class="form-group">
                <label for="rate_amount" class="col-md-3 label-heading"><?php echo lang('rate_amount'); ?></label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2" name="rate_amount" id="rate_amount">
                        <option>--- select reate ---</option>
                        <?php for($i=1; $i<=30; $i++){?>
                            <?php if(!empty($data)){
                                $selected = '';
                                if($data->rate_amount == $i){
                                    $selected = 'selected';
                                }
                            } ?>
                           <option value="<?php echo $i ?>" <?php echo $selected; ?>><?php echo $i ?> %</option>
                        <?php };?>
                    </select>
                    <span class="text-danger"><?php echo form_error('rate_amount'); ?></span>
                </div>
            </div>
            <!-- description -->
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

