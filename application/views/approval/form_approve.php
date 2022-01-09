<?php echo form_open_multipart(site_url(getModuleNameByID($approval->module_id)."/authorize/".$approval->record_id), array("class" => "form-horizontal")) ?>  
    <div class="panel panel-default">
        <div class="panel-body">
            <legend id="label-cusinfo">Authorization Log:</legend>
            <?php $transferFrom = $this->approval->findApprovalLog($approval->module_id, $approval->record_id);
                    if($transferFrom):
                        foreach ($transferFrom as $key => $status): ?>
                            <!-- transfer from  -->
                            <div class="form-group">
                                <label for="status" class="col-md-3 label-heading text-right">User:</label>
                                <div class="col-md-9 ui-front">
                                    <input type="text" class="form-control" value="<?php echo getUserFullName($status->from_user); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 label-heading text-right">Transfer To:</label>
                                <div class="col-md-9 ui-front">
                                    <select class="form-control select2" style='width:100%' data-live-search="true" readonly>
                                        <?php $users = explode(",", $status->to_user); ?>
                                        <?php foreach ($users as $u) {
                                            echo '<option value="">'.getUserFullName($u).'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 label-heading text-right">For:</label>
                                <div class="col-md-9 ui-front">
                                    <select class="form-control select2" style='width:100%' data-live-search="true" readonly>
                                        <option value=""><?php echo $status->authorize_name; ?></option>
                                    </select>
                                </div>
                            </div>
                            <!-- comment  -->
                            <div class="form-group">
                                <label class="col-md-3 label-heading text-right">Comment:</label>
                                <div class="col-md-9 ui-front">
                                    <textarea class="form-control" readonly><?php echo $approval->comment; ?></textarea>
                                </div>
                            </div><hr>
                <?php endforeach; 
            endif; ?>
        </div>
    </div>

    <!-- approval blog  -->  
    <div class="panel panel-default">
        <div class="panel-body">
            <legend id="label-cusinfo">Decision Making:</legend>
            <input type="hidden" name="from_status" value="<?php echo $approval->to_status;?>">
                <!-- status approval  -->
                <div class="form-group">
                    <label for="status" class="col-md-3 label-heading text-right">Option:</label>
                    <div class="col-md-9 ui-front">
                        <select name="status" id="status" class="form-control select2" style='width:100%' data-live-search="true" required>
                            <option value="">--- choose option ---</option>
                            <option value="approve">FINAL APPROVE</option>
                            <option value="transfer">TRANSFER TO</option>
                            <option value="reject">REJECT</option>
                        </select>
                    </div>
                </div>
                <div id="option-transfer">
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
    <div class="text-center">
        <!-- button transfer -->
        <button type="submit" class="btn btn-success" id="btn-transfer" style="display: none;"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo ucfirst($approval->authorize_name); ?> & TRANSFER</button> 
        <!-- button approve -->
        <button type="submit" class="btn btn-success" id="btn-approve" style="display: none;"><i class="glyphicon glyphicon-ok-circle"></i> FINAL APPROVE </button>
        <!-- button reject -->
        <button type="submit" class="btn btn-danger" id="btn-reject" style="display: none;"><i class="glyphicon glyphicon-exclamation-sign"></i> REJECT </button> 
        <!-- button print -->
        <button class="btn btn-primary" onclick="javascript:printDiv('printablediv')"><i class="glyphicon glyphicon-print"></i> Print</button>
        <!-- button cancel -->
        <a href="<?php echo base_url('userMoveRequest'); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
    </div>
<?php echo form_close(); ?>

<!-- end approval  -->
<script type="text/javascript">
    /* Choose option approval */
    $('#status').on('change', function(){
        var option = $(this).val();
        if(option == 'transfer'){
            var transfer = '<!-- user approval  -->'+
            '<div class="form-group">'+
                '<label for="to_user" class="col-md-3 label-heading text-right">User:</label>'+
                '<div class="col-md-9 ui-front">'+
                    '<select name="to_user[]" id="to_user" class="form-control select2" style="width:100%" data-live-search="true" required multiple>'+
                        '<option value="">--- choose user approval ---</option>'+
                        '<?php if(!empty(getAllUsers())): ?>'+
                            '<?php foreach (getAllUsers() as $key => $user) : ?>'+
                              '<?php if((int) $user->ID != (int) $this->user->info->ID): ?>'+
                                '<option value="<?php echo $user->ID; ?>"><?php echo $user->first_name." ".$user->last_name; ?></option>'+
                              '<?php endif; ?>'+
                            '<?php endforeach ?>'+
                        '<?php endif; ?>'+
                    '</select>'+
                '</div>'+
            '</div>'+
            '<!-- status approval  -->'+
            '<div class="form-group">'+
                '<label for="to_status" class="col-md-3 label-heading text-right">For:</label>'+
                '<div class="col-md-9 ui-front">'+
                    '<select name="to_status" id="to_status" class="form-control select2" style="width:100%" data-live-search="true" required>'+
                        '<option value="">--- choose approval status ---</option>'+
                        '<?php if(!empty(getAuthorizeStatus())): ?>'+
                            '<?php foreach (getAuthorizeStatus() as $status) : ?>'+
                                '<?php if((int) $status->authorize_id >= (int) $approval->from_status): ?>'+
                                    '<option value="<?php echo $status->authorize_id; ?>"><?php echo $status->authorize_name; ?></option>'+
                                    '<?php endif; ?>'+
                            '<?php endforeach ?>'+
                        '<?php endif; ?>'+
                    '</select>'+
                '</div>'+
            '</div>';
    
            $('#option-transfer').html(transfer);
            $('.select2').select2();
            $('#btn-transfer').show();
            $('#btn-reject').hide();
            $('#btn-approve').hide();
        }else if(option == 'approve'){
            $('#option-transfer').html('');
            $('#btn-approve').show();
            $('#btn-reject').hide();
            $('#btn-transfer').hide();
        }else{
            $('#option-transfer').html('');
            $('#btn-approve').hide();
            $('#btn-transfer').hide();
            $('#btn-reject').show();
        }
    });
    /* End choose option approval */
</script>