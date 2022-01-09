<?php echo form_open_multipart(site_url("approve/approve/".$approval->module_id."/".$approval->record_id), array("class" => "form-horizontal")) ?>       
    <!-- approval blog  -->  
    <div class="panel panel-default">
        <div class="panel-body">
            <legend id="label-cusinfo">Decision Making:</legend>
            <input type="hidden" name="from_status" value="<?php echo $approval->to_status;?>">
            <?php if($approval->to_status != 4): ?>
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
            <?php else: ?>
                <!-- status approval  -->
                <div class="form-group">
                    <label for="status" class="col-md-3 label-heading text-right">Option:</label>
                    <div class="col-md-9 ui-front">
                        <select name="status" id="status" class="form-control select2" style='width:100%' data-live-search="true" required>
                            <option value="">--- choose option ---</option>
                            <option value="approve">FINAL APPROVE</option>
                            <option value="reject">REJECT</option>
                        </select>
                    </div>
                </div>
            <?php endif; ?>
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
    /**
    * ---------------------------------------
    * APPROVAL PROCCESS
    * ---------------------------------------
    */
    function btnDeleteFile(fileId, fileName){
        if(confirm('Are you sure you want to delete file '+fileName+'?')){
            $('#file-'+fileId).remove();
            $('#input-deleted').append('<input type="hidden" value="'+fileId+'" name="fileRemoved[]"/>');
            /*$.ajax({
                url: global_base_url+'userMoveRequest/removeFile/'+fileId,
                type: 'get',
                success: function (response){
                    $('#file-'+fileId).remove();
                    $("#alert-success").fadeTo(9000, 9000).slideUp(500, function(){
                        $("#alert-error").alert('close');
                    });
                }
            });*/
        }
    }

    function approve(){
        $.ajax({
                url: url,
                type: 'POST',
                data: new FormData($("#requestAccessRightForm")[0]),
                dataType: 'json',
                success: function (data) {
                    $("#spinningSquaresG").hide('slow');
                    $("#requestAccessRightForm").html('<h2>Successful request.</h2>');
                    console.log(data);
//                    setTimeout(function () {
////                        location.reload();
//                    }, 2000);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#spinningSquaresG").hide('slow');
                    $("#requestAccessRightForm").html('<h2>Request Faile.</h2>');
//                    setTimeout(function () {
//                        location.reload();
//                    }, 2000);
                     console.log(jqXHR);
                }
            });
    }
</script>

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
                                '<?php if((int) $status->authorize_id > (int) $approval->to_status): ?>'+
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