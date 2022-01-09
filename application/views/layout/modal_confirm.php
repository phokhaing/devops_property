<!-- modal confirm delete -->
<div id="confirm_delete" class="modal" data-backdrop="static" data-keyboard="false">
   <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">                        
                    <h4 class="modal-title log-color text-center"><i class="glyphicon glyphicon-alert text-warning" aria-hidden="true"></i> Attention </h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to delete this file?</p>                        
                    <div class="text-center" style="padding-top: 1%;">                         
                      <button type="button" data-dismiss="modal" class="btn btn-danger"​ id="delete">Yes</button>
                     <button type="button" data-dismiss="modal" class="btn">No</button>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal confirm delete list-->
<div id="confirm_delete_list" class="modal" data-backdrop="static" data-keyboard="false">
   <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">                        
                    <h4 class="modal-title log-color text-center"><i class="glyphicon glyphicon-alert text-warning" aria-hidden="true"></i> Attention </h4>
                </div>
                <div class="modal-body">
                    <p class="text-center" id="attention-text">Are you sure you want to delete?</p>                        
                    <div class="text-center" style="padding-top: 1%;">                         
                      <button type="button" data-dismiss="modal" class="btn btn-danger"​ onclick="deleteSubmit();">Yes</button>
                     <button type="button" data-dismiss="modal" class="btn">No</button>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal confirm update -->
<div id="confirm_update" class="modal" data-backdrop="static" data-keyboard="false">
   <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">                        
                    <h4 class="modal-title log-color text-center"><i class="glyphicon glyphicon-alert text-warning" aria-hidden="true"></i> Attention </h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to update?</p>                        
                    <div class="text-center" style="padding-top: 1%;">
                        <!-- btn update -->
                        <?php 
                        $form = 'null';
                        if(isset($form_id)){
                            $form = $form_id;
                        } 
                        ?>
                        <!-- btn update -->
                        <button type="button" onclick="updateSubmit('<?php echo $form;?>');" data-dismiss="modal" class="btn btn-danger"><i class="glyphicon glyphicon-ok-circle" ></i> YES</button>
                        <!-- btn cancel -->
                        <button type="button" data-dismiss="modal" class="btn btn-default"><i class="glyphicon glyphicon-remove-circle"></i> NO</button>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal confirm reject-->
<div id="confirm_reject" class="modal" data-backdrop="static" data-keyboard="false">
   <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">                        
                    <h4 class="modal-title log-color text-center"><i class="glyphicon glyphicon-alert text-warning" aria-hidden="true"></i> Attention </h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="comment" class="col-form-label">Are you sure you want to reject?</label>
                            <textarea class="form-control" onkeyup="reject_comment()" name="comment" id="comment" rows="3" placeholder="Write a message..."><?php echo set_value('comment');?></textarea>
                            <span class="text-danger"><?php echo form_error('comment'); ?></span>
                        </div>   
                    </div>                   
                    <div class="text-right" style="padding-top: 1%;">   
                        <button type="button" onclick="submitReject();" id="btn_submit_reject" class="btn btn-danger"​>Yes</button>
                        <button type="button" data-dismiss="modal" class="btn">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var linkUrl = '';
    //  button update 
    function updateConfirm(){
        $('#confirm_update').modal('show');
    }
    function updateSubmit(id){
        document.getElementById('submit_loader').style.display = 'block'
        if(id != 'null'){
            $('form#'+id).submit();
        }else{
            $('form').submit();
        }
    }
    // button delete
    function deleteConfirm(url){
        linkUrl = url;
        $('#confirm_delete_list').modal('show');
    }
    function deleteSubmit(){
        document.getElementById('submit_loader').style.display = 'block'
        window.location.href = linkUrl;
        linkUrl = '';
    }
    function approveConfirm(url){
        linkUrl = url;
        $('#attention-text').text('Are you sure?');
        $('#confirm_delete_list').modal('show');
    }

    function rejectConfirm(url){
        linkUrl = url;
        $('#confirm_reject').modal('show');
    }
    function submitReject(){
        var comment = $('#comment').val();
        if(comment.length > 0){
            $('#btn_submit_reject').text('Submit...').attr('disabled','disabled');
            window.location.href = linkUrl+'?comment='+comment;
        }else{
            $('#comment').next('span').text('Please provide the reason of rejection...');
        } 
    }
    function reject_comment(){
        $('form#form_reject, #comment').next('span').text('');
    }
    
</script>