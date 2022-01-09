<!-- from add$link.  -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b>
            <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<div class="white-area-content animate-bottom">
    <!-- label header -->
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span>
            <?php echo lang('add').' '.lang($title); ?></div>
        <div class="db-header-extra">
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal","id"=>"form_special_payment_request")) ?>
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
                                <input class="form-control input-sm" name="fullname" type="text" id="fullname" value="<?php echo $this->user->info->last_name_kh.' '.$this->user->info->first_name_kh; ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("fullname"); ?></span>
                            </td>
                            <td>ភេទ</td>
                            <td>
                                <?php 
                                    $gender = $this->user->info->gender;
                                    if($gender == 'male'){
                                        $gender = 'ប្រុស';
                                    }elseif($gender == 'female'){
                                        $gender = 'ស្រី';
                                    }
                                    if(set_value('gender') != false){
                                        $gender = set_value('gender');
                                    }
                                ?>
                                <input class="form-control input-sm" type="text" id="gender" name="gender" value="<?php echo $gender; ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("gender"); ?></span>
                            </td>
                            <td>មានតួនាទីជា</td>
                            <td>
                                <input class="form-control input-sm" name="position" type="text" id="position" value="<?php echo ucfirst(getPositionNameKH($this->user->info->position_id)); ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>ស្ថិតនៅក្រុម</td>
                            <td>
                                <input class="form-control input-sm" type="text" name="division" id="division" value="<?php echo ucfirst(getDivisionNameKH($this->user->info->division_id)); ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("division"); ?></span>
                            </td>
                            <td>អត្តលេខ</td>
                            <td>
                                <input class="form-control input-sm" type="text" name="staff_id" id="staff_id" value="<?php echo $this->user->info->staff_id; ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
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
                               <textarea name="subject" id="subject" required><?php echo (set_value('subject') == false ? '<p>សំណើស្នើសុំបង់ខុសលក្ខខណ្ឌជូនអតិថិជន</p>
                               <p>ទិញដីឡូតិ៏លេខ.................................. តម្លៃដីឡូតិ៏ពេញ............................. បញ្ចុះតម្លៃ..........................% និងបញ្ចុះចំនួន ................ ហើយតម្លៃដែលនៅសល់.................។ ធ្វើការបង់មុនចំនួន............................... រយះពេល................. ខែ។ ដោយខែទី១បង់..........................ខែទី២បង់........................ខែទី៣បង់.................ខែទី៤បង់ ................. ខែទី៥បង់ ......................................... ហើយចំនួនទឹកប្រាក់ដែលនៅសល់ធ្វើការរំលស់ចំនួន................................................ ក្នុង១ខែរយះពេលនៅសល់........................ខែ។</p>' : set_value('subject'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("subject"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>សម្របសម្រូួល៖</td>
                            <td>
                               <textarea name="content" id="content" required><?php echo (set_value('content') == false ? '
                               <p>លើកទី១ ................................................................................................................................................................................................................................</p>

                               <p>លើកទី២&nbsp;...............................................................................................................................................................................................................................</p>
                               
                               <p>លើកទី៣&nbsp;................................................................................................................................................................................................................................</p>' : set_value('content'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("content"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>មូលហេតុ៖</td>
                            <td>
                               <textarea name="reason" id="reason" required><?php echo (set_value('reason') == false ? '
                               ដោយសារអតិថិជន .................................................................................................................................................................................................................' : set_value('reason'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("reason"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                               <textarea name="reference" id="reference" required><?php echo (set_value('reference') == false ? '
                               តបតាមកម្មវត្ថុ និងបូលហេតុខាងលើ សូមលោក​............................... មេត្តាទទួលយកសំណើរបស់នាងខ្ញុំ/ខ្ញុំបាទ ដោយក្ដីអនុគ្រោះ។​' : set_value('reference'));?>
                               </textarea>
                               <span class="text-danger"><?php echo form_error("reference"); ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- approval blog  -->
                <table class="table borderless" style="border-spacing: 0 0px;">
                    <tbody>
                        <tr>
                            <th class="text-center">ស្នើសុំដោយ</th>
                            <th class="text-center">ពីនិត្យដោយ </th>
                            <th class="text-center">អនុម័តដោយ</th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                <select name="request_by" id="request_by" class="form-control select2"
                                    style="width:100%" data-live-search="true">
                                    <option value="$this->user->info->ID"><?php echo getUserFullName($this->user->info->ID);?></option>
                                </select>
                            </th>
                            <th class="text-center">
                                <select name="checked_by" id="checked_by" class="form-control select2"
                                    style="width:100%" data-live-search="true" required>
                                    <option value="">--- select ---</option>
                                    <?php if(!empty(getAllUsers())): ?>
                                    <?php foreach (getAllUsers() as $key => $user) : ?>
                                    <?php if((int) $user->ID != (int) $this->user->info->ID): ?>
                                    <option value="<?php echo $user->ID; ?>" ​​
                                        <?php echo set_select('checked_by', $user->ID); ?>>
                                        <?php echo $user->first_name." ".$user->last_name; ?></option>
                                    <?php endif; ?>
                                    <?php endforeach ?>
                                    <?php endif; ?>
                                </select>
                            </th>
                            <th class="text-center">
                                <select name="approved_by" id="approved_by" class="form-control select2"
                                    style="width:100%" data-live-search="true" required>
                                    <option value="">--- select ---</option>
                                    <?php if(!empty(getAllUsers())): ?>
                                    <?php foreach (getAllUsers() as $key => $user) : ?>
                                    <?php if((int) $user->ID != (int) $this->user->info->ID): ?>
                                    <option value="<?php echo $user->ID; ?>" ​​
                                        <?php echo set_select('approved_by', $user->ID); ?>>
                                        <?php echo $user->first_name." ".$user->last_name; ?></option>
                                    <?php endif; ?>
                                    <?php endforeach ?>
                                    <?php endif; ?>
                                </select>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <!-- end approval  -->
                
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