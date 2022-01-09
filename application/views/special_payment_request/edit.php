<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b>
            <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content animate-bottom">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span>
            <?php echo lang("edit").' '.lang($title); ?></div>
        <div class="db-header-extra">
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            id: <b><?php echo $data->id; ?></b>
        </div>
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal","id"=>"form_special_payment_request")) ?>
            <div class="col-xs-12" style="border-bottom: 1px solid #bfbfbf;">
                    <div class="col-xs-4">
                        <?php if(!empty($this->settings->info->site_logo)) : ?>
                            <img src="<?php echo base_url().$this->settings->info->upload_path_relative . "/" . $this->settings->info->site_logo ?>" class="img-rounded img-responsive">
                        <?php endif; ?>
                    </div> 
                    <div class="col-xs-4" style="text-align: center;">
                        <h4 style="text-align: center;font-size: 16px;font-family: Khmer OS Muol;"><label>លិខិតស្នើសុំបង់ប្រាក់ខុសលក្ខខណ្ឌ</label></h4>
                    </div>
                    <div class="col-xs-4"></div>
                </div>

                <!-- show data -->
                <style type="text/css">
                    .borderless td, .borderless th {
                        border: none !important;
                        /* font-size: 11px; */
                        font-family: Khmer OS Content;
                    }
                    .table-bordered td, .table-bordered th {
                        /* font-size: 11px; */
                        font-family: Khmer OS Content;
                    }
                </style>

                <table class="table borderless" style="border-spacing: 0 0px;">
                    <tbody>
                        <tr>
                            <td>ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ</td>
                            <td>
                                <!-- fullname -->
                                <input class="form-control input-sm" name="fullname" type="text" id="fullname" value="<?php echo $data->fullname;?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("fullname"); ?></span>
                            </td>
                            <td>ភេទ</td>
                            <td>
                                <input class="form-control input-sm" type="text" id="gender" name="gender" value="<?php echo $data->gender; ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("gender"); ?></span>
                            </td>
                            <td>មានតួនាទីជា</td>
                            <td>
                                <input class="form-control input-sm" name="position" type="text" id="position" value="<?php echo $data->position; ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>ស្ថិតនៅក្រុម</td>
                            <td>
                                <input class="form-control input-sm" type="text" name="division" id="division" value="<?php echo $data->division;?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("division"); ?></span>
                            </td>
                            <td>អត្តលេខ</td>
                            <td>
                                <input class="form-control input-sm" type="text" name="staff_id" id="staff_id" value="<?php echo $data->staff_id;?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("staff_id"); ?></span>
                            </td>
                            <td colspan="2">។</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table borderless" style="border-spacing: 0 0px;">
                    <tbody>
                        <tr>
                            <td>កម្មវត្ថុ៖</td>
                            <td>
                               <textarea name="subject" id="subject" required><?php echo (set_value('subject') == false ? $data->subject : set_value('subject'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("subject"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>សម្របសម្រូួល៖</td>
                            <td>
                               <textarea name="content" id="content" required><?php echo (set_value('content') == false ? $data->content : set_value('content'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("content"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>មូលហេតុ៖</td>
                            <td>
                               <textarea name="reason" id="reason" required><?php echo (set_value('reason') == false ? $data->reason : set_value('reason'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("reason"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                               <textarea name="reference" id="reference" required><?php echo (set_value('reference') == false ? $data->reference : set_value('reference'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("reference"); ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                

            <!-- button action -->
            <div class="text-right">
                <!-- button update -->
                <span id="submit_loader" style="display:none;"></span>
                <?php if($this->authorization->hasPermission($moduleName, "update")): ?>
                <button type="button" id="btn-submit" onclick="updateConfirm();" class="btn btn-success"><i
                        class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_update") ?></button>
                <?php endif; ?>
                <!-- button cancel -->
                <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip"
                    data-placement="bottom" title="Cancel" data-original-title="View"><i
                        class="glyphicon glyphicon-remove-circle"></i> Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/modal_confirm', array('form_id'=>'form_special_payment_request')); ?>
<script type="text/javascript">
        $('.select2').select2();
        // subject
        CKEDITOR.replace('subject', {
        height: '200',
        filebrowserUploadUrl: "<?php echo base_url('FileUpload/Upload'); ?>",
        filebrowserBrowseUrl: "<?php echo base_url('FileUpload/file_browser'); ?>",
        });
        // content
        CKEDITOR.replace('content', {
        height: '200',
        filebrowserUploadUrl: "<?php echo base_url('FileUpload/Upload'); ?>",
        filebrowserBrowseUrl: "<?php echo base_url('FileUpload/file_browser'); ?>",
        });
        // reason
        CKEDITOR.replace('reason', {
        height: '100',
        filebrowserUploadUrl: "<?php echo base_url('FileUpload/Upload'); ?>",
        filebrowserBrowseUrl: "<?php echo base_url('FileUpload/file_browser'); ?>",
        });
        // reference
        CKEDITOR.replace('reference', {
        height: '50',
        filebrowserUploadUrl: "<?php echo base_url('FileUpload/Upload'); ?>",
        filebrowserBrowseUrl: "<?php echo base_url('FileUpload/file_browser'); ?>",
        });
    </script>

    <!-- items -->

    <!-- required form -->
    <script type="text/javascript">
    $(document).ready(function() {
        checkRequiredForm();
    });

    function checkRequiredForm() {
        //  check all field input that required
        $('form').find('textarea').each(function() {
            if ($(this).prop('required') && $(this).val() == "") {
                $('#btn-submit').prop('disabled', true);
                return false;
            }
        });
        $('form').find('input').each(function() {
            if ($(this).prop('required') && $(this).val() == "") {
                $('#btn-submit').prop('disabled', true);
                return false;
            }
        });
        //  check all field select required
        $('form').find('select').each(function() {
            if ($(this).prop('required') && $(this).val() == "") {
                $('#btn-submit').prop('disabled', true);
                return false;
            }
        });
        // check all fiedl required and remove text error element
        $('input').on({
            mouseleave: function() {
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                // check all input
                $("input").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                // check all select option
                $("select").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
            },
            keyup: function() {
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                $("input").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                $("select").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
            }
        });
        $('textarea').on({
            mouseleave: function() {
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                // check all input
                $("input").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                // check all select option
                $("select").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
            },
            keyup: function() {
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                // check all textarea
                $("textarea").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                $("input").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
                $("select").each(function() {
                    if ($(this).prop('required') && $(this).val() == "") {
                        console.log($(this).attr('id'));
                        $('#btn-submit').prop('disabled', true);
                        return false;
                    }
                });
            }
        });
        $('select').on('change', function() {
            $(this).next('span.text-danger').remove();
            $('#btn-submit').prop('disabled', false);
            // check all textarea
            $("textarea").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            // check all field input required
            $("input").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            // check all field select required
            $("select").each(function() {
                if ($(this).prop('required') && $(this).val() == '') {
                    console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
        });
    }
    </script>