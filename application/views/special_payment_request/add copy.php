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
            <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal","id"=>"form_goods_received_note")) ?>
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
                                <!-- user_id -->
                                <input type="hidden" name="user_id" value="<?php echo $this->user->info->ID;?>">
                                <input class="form-control input-sm" type="text" id="user_id" value="<?php echo $this->user->info->last_name_kh.' '.$this->user->info->first_name_kh; ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("user_id"); ?></span>
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
                                <input type="hidden" name="position_id" value="<?php echo $this->user->info->position_id;?>">
                                <input class="form-control input-sm" type="text" id="position_id" value="<?php echo ucfirst(getPositionNameKH($this->user->info->position_id)); ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("position_id"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>ស្ថិតនៅក្រុម</td>
                            <td>
                                <input type="hidden" name="division_id" value="<?php echo $this->user->info->division_id;?>">
                                <input class="form-control input-sm" type="text" id="division_id" value="<?php echo ucfirst(getDivisionNameKH($this->user->info->division_id)); ?>" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" readonly/>
                                <span class="text-danger"><?php echo form_error("division_id"); ?></span>
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
                        <tr><th colspan="7" class="text-center"><u>សូមគោរពជូន</u></th></tr>
                        <tr>
                            <td></td>
                            <th>លោក</th>
                            <td colspan="2">
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted; border-bottom-style: dotted;" type="text" name="fullname" id="fullname" value="<?php echo set_value("fullname"); ?>" />
                                <span class="text-danger"><?php echo form_error("fullname"); ?></span>
                            </td>
                            <th>មានតួនាទីជា</th>
                            <td colspan="2">
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>កម្មវត្ថុ៖</td>
                            <td colspan="6">
                                <textarea class="form-control input-sm" name="request_for" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" id="request_for" rows="1"><?php echo (set_value('company_description') == false ? 'សំណើរស្នើសុំបង់ខុសលក្ខខណ្ឌជូនអតិថិជន' : set_value('request_for')); ?></textarea>
                                <span class="text-danger"><?php echo form_error("fullname"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ទិញដីឡូតិ៏លេខ</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>តម្លៃដីឡូតិ៏ពេញ</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>បញ្ចុះតម្លៃ</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>% និងបញ្ចុះចំនួន</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>ហើយតម្លៃដែលនៅសល់</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>។ ធ្វើការបង់មុនចំនួន</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td>រយះពេល</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>ខែ។ ដោយខែទី១ បង់</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>ខែទី២ បង់</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ខែទី៣ បង់</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>ខែទី៤ បង់</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>ខែទី៥ បង់</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">ហើយចំនួនទឹកប្រាក់ដែលនៅសល់ធ្វើការរំលស់ចំនួន</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>ក្នុង១ខែរយះពេលនៅសល់</td>
                            <td>
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                            <td>ខែ។</td>
                        </tr>
                        <tr>
                            <td>សម្របសម្រូួល៖</td>
                            <td>លើកទី១</td>
                            <td colspan="5">
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>លើកទី២</td>
                            <td colspan="5">
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>លើកទី៣</td>
                            <td colspan="5">
                                <input class="form-control input-sm" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo set_value("position"); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>មូលហេតុ៖</td>
                            <td colspan="6">
                                <textarea class="form-control input-sm" name="position" id="position" rows="2" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" ><?php echo (set_value('position') == false ? 'ដោយសារអតិថិជន' : set_value('position')); ?></textarea>
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="6">
                                <textarea class="form-control input-sm" name="position" id="position" rows="2" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" ><?php echo (set_value('position') == false ? 'តបតាមកម្មវត្ថុ និងមូលហេតុខាងលើ សូមលោក....................................... មេត្តាទទួលយកនៅសំណើរបស់នាងខ្ញុំ/ខ្ញុំបាទ ដោយក្ដីអនុគ្រោះ។' : set_value('position')); ?></textarea>
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <th colspan="3" class="text-right">
                                <input class="form-control input-sm text-right" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo (set_value('position') == false ? 'ថ្ងៃ............ខែ............ឆ្នាំ....................................' : set_value('position')); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <th colspan="3" class="text-right">
                                <input class="form-control input-sm text-right" style="border: none; border-bottom: 1px solid gray; border-bottom-style: dotted;" type="text" name="position" id="position" value="<?php echo (set_value('position') == false ? 'ធ្វើនៅ.................ថ្ងៃ............ខែ............ឆ្នាំ............' : set_value('position')); ?>" />
                                <span class="text-danger"><?php echo form_error("position"); ?></span>
                            </th>
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
                                    style="width:100%" data-live-search="true" required>
                                    <option value=""><?php echo getUserFullName($this->user->info->ID);?></option>
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


                
                
            <?php echo form_close(); ?>
        </div>
    </div>

    <?php $this->load->view('layout/modal_confirm', array('form_id'=>'form_goods_received_note')); ?>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/simple.money.format.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/file_upload.js"></script>


    <!-- items -->
    <script type="text/javascript">
    document.getElementById('attachment_files').addEventListener('change', handleFileSelect, false);

    var item =
        <?php echo (!empty($this->input->post('description')) ? count($this->input->post('description'))-1 : 0); ?>;
    var count_item = 1;

    function addItem() {
        item += 1;
        count_item = item + 1;
        var formItem = '<tr id="removeItem' + item + '">' +
            '<td  id="no' + item + '">' + count_item + '</td>' +
            '<td>' +
            '<!-- item_no -->' +
            '<input class="form-control input-sm item_no" type="text" name="item_no[]" id="item_no' + item +
            '" placeholder="<?php echo lang("item_no"); ?>" required/>' +
            '<span class="text-danger"><?php echo form_error("item_no[0]"); ?></span>' +
            '</td>' +
            '<td>' +
            '<!-- discription -->' +
            '<textarea class="form-control input-sm" name="description[]" id="description' + item +
            '" rows="1" required></textarea>' +
            '<span class="text-danger"><?php echo form_error("description['+item+']"); ?></span>' +
            '</td>' +
            '<td>' +
            '<!-- ref_no -->' +
            '<input class="form-control input-sm ref_no" type="text" name="ref_no[]" id="ref_no' + item +
            '" placeholder="<?php echo lang("ref_no"); ?>" required/>' +
            '<span class="text-danger"><?php echo form_error("ref_no[0]"); ?></span>' +
            '</td>' +
            '<td>' +
            '<!-- uom -->' +
            '<select class="form-control select2" style="width:100%" data-live-search="true" name="uom[]" id="uom' +
            item + '" required>' +
            '<option value="">--- select ---</option>' +
            '<?php if(!empty($measurements)): ?>' +
            '<?php foreach ($measurements as $key => $uom):?>' +
            '<option value="<?php echo $uom->id ?>"><?php echo $uom->name." (".$uom->symbol.")"; ?></option>' +
            '<?php endforeach; ?>' +
            '<?php endif; ?>' +
            '</select>' +
            '<span class="text-danger"><?php echo form_error("uom[0]"); ?></span>' +
            '</td>' +
            '<td>' +
            '<!-- price -->' +
            '<input class="form-control input-sm price" type="hidden" name="price[]" id="price' + item +
            '" placeholder="<?php echo lang("price"); ?>"/>' +
            '<input class="form-control input-sm" type="text" onkeyup="sumPrice(' + item + ');" id="show_price' + item +
            '" placeholder="<?php echo lang("price"); ?>" required/>' +
            '<span class="text-danger"><?php echo form_error("price[0]"); ?></span>' +
            '</td>' +
            '<td>' +
            '<div class="input-group">' +
            '<!-- remark -->' +
            '<textarea class="form-control input-sm" name="remark[]" id="remark' + item + '" rows="1"></textarea>' +
            '<span class="text-danger"><?php echo form_error("remark[0]"); ?></span>' +
            '<!-- btn remove item -->' +
            '<div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">' +
            '<a href="javascript:void(0)" title="Remove Item" onclick="removeItem(' + item +
            ');" class="btn btn-default btn-xs text-body"><span class="glyphicon glyphicon-minus"></span></a></div>' +
            '</div>' +
            '</td>' +
            '</tr>';

        $(formItem).insertBefore('.append-items');
        $('.select2').select2();
        checkRequiredForm();
    }

    // REMOVE REQUEST TYPE THAT APPENDED
    function removeItem(item) {
        $('#removeItem' + item).remove();
        totalPrice();
    }

    function sumPrice(id) {
        $('#show_price' + id).simpleMoneyFormat(); // show format
        $('#price' + id).val($('#show_price' + id).val().replace(/,/g, '')); // asign value to total
        totalPrice();
    }

    function totalPrice() {
        var sum_total = parseFloat(0);
        $(".price").each(function(key) {
            sum_total += +$(this).val();

            // show no length
            var noid = $(this).attr('id').replace(/total/g, 'no');
            $('#' + noid).text(key + 1);
        });
        $('#sum_total').text(sum_total).simpleMoneyFormat();
        $('#sum_total').text($('#sum_total').text() + '$');
        $('#total_amount').val(sum_total);
    }
    </script>

    <!-- company -->
    <script type="text/javascript">
    function changeCompany() {
        var id = $('.received_from').val();
        $.ajax({
            url: 'findCompany/' + id,
            type: 'get',
            dataType: 'json',
            success: function(output) {
                if (output != false) {
                    $('#address').val(output.address);
                    $('#phone').val(output.telephone);
                    checkRequiredForm();
                }
            }
        });
    }

    function changeSupplier() {
        var supplier_to = $('.received_from').val();
        if (supplier_to != '') {
            $.ajax({
                url: 'findSupplierByID/' + supplier_to,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    $('.phone').val(response.telephone);
                    $('.address').val(response.address);
                    checkRequiredForm();
                }
            });
        } else {
            $('.phone').val('');
            $('.address').val('');
            checkRequiredForm();
        }
    }
    </script>

    <!-- general -->
    <script type="text/javascript">
    $("#date").datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText){
            /* generate code */
            var date = $(this).val();
            $.ajax({
                url: 'generateCode',
                type: 'get',
                data:{'date': date},
                success: function(output) {
                    $('#grn_no').val(output);
                }
            });
        }
    });
    $('.select2').select2();
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function() {
        $("#alert-error").alert('close');
    });
    </script>

    <!-- required form -->
    <script type="text/javascript">
    $(document).ready(function() {
        totalPrice();
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

    <!-- Modal -->
    <script type="text/javascript">
    function addSupplier() {
        $('#modal_supplier').modal('show');
    }

    function submitSupplier() {
        $.ajax({
            url: global_base_url + '/goods_received_note/add_supplier',
            type: 'POST',
            dataType: 'json',
            data: new FormData($("#form_modal_supplier")[0]),
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('span.text-danger').html('');
            },
            success: function(response) {
                if (response[0] == 'true') {
                    $("#show-success").fadeTo(9000, 9000).slideUp(500, function() {
                        $("#show-success").alert('close');
                    });
                    // show customer to field customer_relation
                    $('select[name="received_from"]').html(response[1]);
                    $('.phone').val(response.contact);
                    $('.address').val(response.address);
                    $('#modal_supplier').modal('hide');

                } else if (response[0] == 'fail') { // show fail
                    $("#show-error").fadeTo(9000, 9000).slideUp(500, function() {
                        $("#show-error").alert('close');
                    });
                } else {
                    // show validation error
                    $.each(response, function(key, val) {
                        $('#' + key).after('<span class="text-danger">' + val + '</span>');
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error');
            }
        });
    }
    </script>
    <div class="modal fade" id="modal_supplier" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Supplier</h4>
                </div>

                <div class="modal-body">
                    <div class="panel panel-default">
                        <!-- show alert fail -->
                        <div class="row" id="show-error" style="display: none;">
                            <div class="col-md-12">
                                <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b>
                                    Something went wrong, please try again.</div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php echo form_open_multipart('',array("class" => "form-horizontal", "id"=>"form_modal_supplier")) ?>

                            <div id="modal_customer">
                                <!-- name -->
                                <div class="form-group">
                                    <label for="name" class="col-md-3 label-heading"><?php echo lang('name'); ?> <sup
                                            class="text-danger">*</sup></label>
                                    <div class="col-md-9 ui-front">
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="<?php echo set_value('name') ?>">
                                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                                    </div>
                                </div>
                                <!-- telephone -->
                                <div class="form-group">
                                    <label for="telephone"
                                        class="col-md-3 label-heading"><?php echo lang('telephone'); ?> <sup
                                            class="text-danger">*</sup></label>
                                    <div class="col-md-9 ui-front">
                                        <input type="text" id="telephone" class="form-control" name="telephone"
                                            value="<?php echo set_value('telephone') ?>" placeholder="0123456789">
                                        <span class="text-danger"><?php echo form_error('telephone'); ?></span>
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="form-group">
                                    <label for="address"
                                        class="col-md-3 label-heading"><?php echo lang('address'); ?></label>
                                    <div class="col-md-9 ui-front">
                                        <textarea class="form-control input-sm" name="address" id="address"
                                            rows="3"><?php echo set_value('address');?></textarea>
                                        <span class="text-danger"><?php echo form_error('address'); ?></span>
                                    </div>
                                </div>
                                <!--status-->
                                <div class="form-group">
                                    <label for="status" class="col-md-3 label-heading">Status</label>
                                    <div class="col-md-9 ui-front">
                                        <select name="status" id="status" class="form-control select2">
                                            <option value="1">Active</option>
                                            <option value="0">In-Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <!-- button submit -->
                                <span id="modal_submit_loader" style="display:none;"></span>
                                <button type="button" onclick="submitSupplier();" id="modal_btn_submit"
                                    class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i>
                                    <?php echo lang("btn_save") ?></button>
                                <!-- button cancel -->
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="glyphicon glyphicon-remove-circle"></i> Cancel</button>

                            </div> <!-- button action -->

                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>