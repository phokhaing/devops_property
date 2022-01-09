            
<!-- approval blog  -->  
<div class="panel panel-default">
    <div class="panel-body">
        <legend id="label-cusinfo">Decision Makers:</legend>
        <!-- status approval  -->
        <div class="form-group">
            <label for="status" class="col-md-3 label-heading text-right">Option:</label>
            <div class="col-md-9 ui-front">
                <select name="status" id="status" class="form-control select2" style='width:100%' data-live-search="true" required>
                    <option value="transfer">TRANSFER TO</option>
                </select>
            </div>
        </div>
        <!-- user approval  -->
        <div class="form-group">
            <label for="to_user" class="col-md-3 label-heading text-right">User:</label>
            <div class="col-md-9 ui-front">
                <select name="to_user[]" id="to_user" class="form-control select2" style="width:100%" data-live-search="true" required multiple>
                    <option value="">--- choose user approval ---</option>
                    <?php if(!empty(getAllUsers())): ?>
                        <?php foreach (getAllUsers() as $key => $user) : ?>
                            <option value="<?php echo $user->ID; ?>"><?php echo $user->first_name." ".$user->last_name; ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <!-- status approval  -->
        <div class="form-group">
            <label for="to_status" class="col-md-3 label-heading text-right">For:</label>
            <div class="col-md-9 ui-front">
                <select name="to_status" id="to_status" class="form-control select2" style="width:100%" data-live-search="true" required>
                    <option value="">--- choose approval status ---</option>
                    <?php if(!empty(getAuthorizeStatus())): ?>
                        <?php foreach (getAuthorizeStatus() as $status) : ?>
                            <option value="<?php echo $status->authorize_id; ?>"><?php echo $status->authorize_name; ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <!-- comment  -->
        <div class="form-group">
            <label for="comment" class="col-md-3 label-heading text-right">Comment:</label>
            <div class="col-md-9 ui-front">
                <textarea name="comment" class="form-control" id="comment"></textarea>
            </div>
        </div>
    </div>
</div>