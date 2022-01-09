<!-- from add$link.  -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<div class="white-area-content">
    <!-- label header -->
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("add").' '.lang($title) ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal")) ?>
            <!-- name -->
            <div class="form-group">
                <label for="name" class="col-md-3 label-heading"><?php echo lang('name'); ?> <sup class="text-danger">*</sup></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="name" class="form-control" name="name" value="<?php echo set_value('name') ?>" required>
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
            </div>
            <!-- telephone -->
            <div class="form-group">
                <label for="telephone" class="col-md-3 label-heading"><?php echo lang('telephone'); ?> <sup class="text-danger">*</sup></label>
                <div class="col-md-9 ui-front">
                    <input type="text" id="telephone" class="form-control" name="telephone" value="<?php echo set_value('telephone') ?>" placeholder="0123456789" required>
                    <span class="text-danger"><?php echo form_error('telephone'); ?></span>
                </div>
            </div>
            <!-- address -->
            <div class="form-group">
                <label for="address" class="col-md-3 label-heading"><?php echo lang('address'); ?></label>
                <div class="col-md-9 ui-front">
                    <textarea class="form-control input-sm" name="address" id="address" rows="3"><?php echo set_value('address');?></textarea>
                    <span class="text-danger"><?php echo form_error('address'); ?></span>
                </div>
            </div>
            <!--status-->
            <div class="form-group">
                <label for="status" class="col-md-3 label-heading">Status</label>
                <div class="col-md-9 ui-front">
                    <select name="status" id="status" class="form-control select2" required>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                    </select>
                </div>
            </div>

            <!-- button action -->
            <div class="text-right">
                <span id="submit_loader" style="display:none;"></span>
                <?php if($this->authorization->hasPermission($moduleName, "create")): ?>
                    <button type="submit" id="btn-submit" class="btn btn-success" onclick="getElementById('submit_loader').style.display = 'block'"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("save") ?></button> 
                <?php endif; ?>
                <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
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
<!-- required form -->
<script type="text/javascript">
    $(document).ready(function(){
        checkRequiredForm();
    });

    function checkRequiredForm(){
        //  check all field input that required
        $('form').find('textarea').each(function(){
            if ($(this).prop('required') && $(this).val() == "") {
               $('#btn-submit').prop('disabled', true);
               return false;
            }
        });
        $('form').find('input').each(function(){
            if ($(this).prop('required') && $(this).val() == "") {
               $('#btn-submit').prop('disabled', true);
               return false;
            }
        });
        //  check all field select required
        $('form').find('select').each(function(){
            if ($(this).prop('required') && $(this).val() == "") {
               $('#btn-submit').prop('disabled', true);
               return false;
            }
        });
        // check all fiedl required and remove text error element
        $('input').on({
            mouseleave: function(){
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                // check all input
                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                        // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                // check all select option
                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                        // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            },
            keyup: function(){
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                    // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                    // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                    // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            }
        });
        $('textarea').on({
            mouseleave: function(){
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                // check all input
                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                        // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                // check all select option
                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                        // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            },
            keyup: function(){
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                    // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                    // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                    // console.log($(this).attr('id'));
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            }
        });
        $('select').on('change', function(){
            $(this).next('span.text-danger').remove();
            $('#btn-submit').prop('disabled', false);
            // check all textarea
            $("textarea").each(function(){
               if ($(this).prop('required') && $(this).val() == ""){
                // console.log($(this).attr('id'));
                   $('#btn-submit').prop('disabled', true);
                   return false;
               }
            });
            // check all field input required
            $("input").each(function(){
               if ($(this).prop('required') && $(this).val() == ""){
                // console.log($(this).attr('id'));
                   $('#btn-submit').prop('disabled', true);
                   return false;
               }
            });
            // check all field select required
            $("select").each(function(){
                if($(this).prop('required') && $(this).val() == ''){
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                   return false;
                }
            });
        });
    }
</script>

