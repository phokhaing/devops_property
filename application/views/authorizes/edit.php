<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("edit_authorize") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url("authorize/update?id=".(!empty($data) ? $data->authorize_id : '')), array("class" => "form-horizontal")) ?>
            <!-- authorize name -->
            <div class="form-group">
                <label for="authorize_name" class="col-md-3 label-heading">authorize Name</label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="authorize_name" class="form-control" name="authorize_name" value="<?php echo (!empty($data) ? $data->authorize_name : ''); ?>" required>
                    <span class="text-danger valid-authorize-name"><?php echo form_error('authorize_name'); ?></span>
                </div>
            </div>
            <!-- user name -->
            <div class="form-group">
                <label for="user_id" class="col-md-3 label-heading">User Name</label>
                <div class="col-md-9 ui-front">
                    <select class="form-control select2 user_id" name="user_id[]" multiple required>
                        <option value="">--- select users ---</option>
                        <?php if(!empty(getAllUsers())): ?>
                            <?php foreach(getAllUsers() as $user){
                                $selected = ''; 
                                if(!empty($data)){
                                    $users = explode(",", $data->user_id);
                                    if(in_array($user->ID, $users)){
                                        $selected = 'selected';
                                    }
                                } ?>
                            <option value="<?php echo $user->ID; ?>" <?php echo $selected; ?>><?php echo $user->first_name.' '.$user->last_name; ?></option>
                            <?php } ?>
                        <?php endif; ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('user_id'); ?></span>
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
               <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_update") ?></button> <a href="<?php echo base_url('authorize'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
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

