            
<!-- approval blog  -->  
<div class="panel panel-default">
    <div class="panel-heading"><b>Decision Makers:</b></div>
    <div class="panel-body">
        <!-- status approval  -->
        <div class="form-group">
            <label for="status" class="col-md-2 label-heading">Option <sup class="text-danger">*</sup></label>
            <div class="col-md-4 ui-front">
                <select name="status" id="status" class="form-control select2" style='width:100%' data-live-search="true" required>
                    <option value="transfer">TRANSFER TO</option>
                </select>
            </div>
            <!-- user approval  -->
            <label for="to_user" class="col-md-2 label-heading">User <sup class="text-danger">*</sup></label>
            <div class="col-md-4 ui-front">
                <select name="to_user[]" id="to_user" class="form-control select2" style="width:100%" data-live-search="true" required multiple>
                    <option value="">--- choose user approval ---</option>
                    <?php if(!empty(getAllUsers())): ?>
                        <?php foreach (getAllUsers() as $key => $user) : ?>
                            <?php if((int) $user->ID != (int) $this->user->info->ID): ?>
                                <option value="<?php echo $user->ID; ?>"​​ <?php echo set_select('to_user[]', $user->ID); ?>><?php echo $user->first_name." ".$user->last_name; ?></option>
                            <?php endif; ?>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <!-- status approval  -->
            <label for="to_status" class="col-md-2 label-heading">For <sup class="text-danger">*</sup></label>
            <div class="col-md-4 ui-front">
                <select name="to_status" id="to_status" class="form-control select2" style="width:100%" data-live-search="true" required>
                    <option value="">--- choose approval status ---</option>
                    <?php if(!empty(getAuthorizeStatus())): ?>
                        <?php foreach (getAuthorizeStatus() as $status) : ?>
                            <option value="<?php echo $status->authorize_id; ?>" <?php echo set_select('to_status', $status->authorize_id); ?>><?php echo $status->authorize_name; ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
            <!-- comment  -->
            <label for="comment" class="col-md-2 label-heading">Comment</label>
            <div class="col-md-4 ui-front">
                <textarea name="comment" class="form-control" rows="1" id="comment"><?php echo set_value('comment'); ?></textarea>
            </div>
        </div>
    </div>
</div>