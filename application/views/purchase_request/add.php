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
            <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal")) ?>
            <div class="col-md-12">
                <div class="form-group">
                    <!-- name -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="name">ឈ្មោះ/ Name<sup class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <select name="name" id="name" class="form-control select2" style="width: 100%" required>
                                <option value="<?php echo $this->user->info->ID; ?>"
                                    <?php echo set_select('name', $this->user->info->ID); ?>>
                                    <?php echo $this->user->info->first_name.' '.$this->user->info->last_name; ?>
                                </option>
                            </select>
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <!-- cell_phone -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="cell_phone">ទូរស័ព្ទដៃ/ Cell Phone<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="cell_phone" id="cell_phone"
                                value="<?php echo (set_value('cell_phone') == false ? $this->user->info->phone_number : set_value('cell_phone')); ?>"
                                placeholder="<?php echo lang('cell_phone'); ?>" readonly required />
                            <span class="text-danger"><?php echo form_error('cell_phone'); ?></span>
                        </div>
                    </div>
                    <!-- ref_no -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="ref_no">លេខរៀង/ Ref No<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="ref_no" id="ref_no"
                                value="<?php echo (set_value('ref_no') == false ? $refno : set_value('ref_no')); ?>"
                                placeholder="<?php echo lang('ref_no'); ?>" required readonly />
                            <span class="text-danger"><?php echo form_error('ref_no'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- position -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="position">តួនាទី/ Position<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <select name="position" id="position" class="form-control select2" style="width: 100%"
                                required>
                                <option value="<?php echo $this->user->info->position_id; ?>"
                                    <?php echo set_select('position', $this->user->info->position_id); ?>>
                                    <?php echo getPositionName($this->user->info->position_id); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('position'); ?></span>
                        </div>
                    </div>
                    <!-- div -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="div">ផ្នែក/ Div<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <select name="div" id="div" class="form-control select2" style="width: 100%" required>
                                <option value="<?php echo $this->user->info->division_id; ?>"
                                    <?php echo set_select('div', $this->user->info->division_id); ?>>
                                    <?php echo getDivisionName($this->user->info->division_id); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('div'); ?></span>
                        </div>
                    </div>
                    <!-- r_date -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="r_date">កាលបរិច្ឆេទស្នើសុំ/ R.Date<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="r_date" id="r_date"
                                value="<?php echo (set_value('r_date') == false ? date('d-m-Y') : set_value('r_date')); ?>"
                                placeholder="<?php echo lang('r_date'); ?>" required />
                            <span class="text-danger"><?php echo form_error('r_date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- staff_id -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="staff_id">អត្តលេខ/ ID<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="staff_id" id="staff_id"
                                value="<?php echo (set_value('staff_id') == false ? $this->user->info->staff_id : set_value('staff_id')); ?>"
                                placeholder="<?php echo lang('ID'); ?>" required readonly />
                            <span class="text-danger"><?php echo form_error('staff_id'); ?></span>
                        </div>
                    </div>
                    <!-- branch -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="branch">សាខា/ Branch<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <select name="branch" id="branch" class="form-control select2" style="width: 100%" required>
                                <option value="<?php echo $this->user->info->branch; ?>"
                                    <?php echo set_select('branch', $this->user->info->branch); ?>>
                                    <?php echo getBranchName($this->user->info->branch); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('branch'); ?></span>
                        </div>
                    </div>
                    <!-- deadline -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="deadline">កាលបរិច្ឆេទយក/ Deadline<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="deadline" id="deadline"
                                value="<?php echo set_value('deadline'); ?>"
                                placeholder="<?php echo lang('deadline'); ?>" required />
                            <span class="text-danger"><?php echo form_error('deadline'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- department -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="department">នាយកដ្ឋាន/ Department<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <select name="department" id="department" class="form-control select2" style="width: 100%"
                                required>
                                <option value="<?php echo $this->user->info->department_id; ?>"
                                    <?php echo set_select('department', $this->user->info->department_id); ?>>
                                    <?php echo getDepartmentName($this->user->info->department_id); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('department'); ?></span>
                        </div>
                    </div>
                    <!-- project -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="project">គំរោង/ Project<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <select name="project" onchange="changeProject()" id="project"
                                class="form-control select2 project" style="width: 100%" required>
                                <option value="">--- select ---</option>
                                <?php if(!empty($projects)): ?>
                                <?php foreach ($projects as $key => $value) : ?>
                                <option value="<?php echo $value->id; ?>"
                                    <?php echo set_select('project', $value->id); ?>><?php echo $value->project_name; ?>
                                </option>
                                <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('project'); ?></span>
                        </div>
                    </div>
                    <!-- location -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="location">ទីតាំង/ location<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <input class='form-control location' type="text" name="location" id="location"
                                value="<?php echo set_value('location'); ?>"
                                placeholder="<?php echo lang('location'); ?>" required />
                            <span class="text-danger"><?php echo form_error('location'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- reference -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="reference"><?php echo lang('reference');?></label>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <textarea class="form-control" name="reference" id="reference" rows="2"><?php echo set_value('reference');?></textarea>
                            <span class="text-danger"><?php echo form_error('reference'); ?></span>
                        </div>
                    </div>
                    <!-- purpose -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="purpose">គោលបំណង/ Purpose<sup
                                    class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <textarea class="form-control" name="purpose" id="purpose" rows="2"
                                required><?php echo set_value('purpose');?></textarea>
                            <span class="text-danger"><?php echo form_error('purpose'); ?></span>
                        </div>
                    </div>
                </div><br>
            </div>

            <!-- table item -->
            <div class="col-md-12 table-responsive">
                <div class="row">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th class="text-center" width="50px;">លរ<br>NO</br></th>
                                <th class="text-center">ពិពណ៍នាសម្ភារៈ <br>DESCRIPTION</th>
                                <th class="text-center" width="100px;">ខ្នាត/ឯកតា <br>UOM</th>
                                <th class="text-center" width="100px;">ចំនួន <br>QUANTITY</th>
                                <th class="text-center" width="100px;">តម្លៃ <br>PRICE</th>
                                <th class="text-center" width="100px;">តម្លៃសរុប <br>TOTAL</th>
                                <th class="text-center" width="250px">កំណត់សម្គាល់ <br>REMARK</th>
                            </tr>

                            <tr>
                                <td id="no0">1</td>
                                <td>
                                    <!-- discription -->
                                    <textarea class="form-control input-sm" name="description[]" id="description"
                                        rows="1" required><?php echo set_value('description[0]');?></textarea>
                                    <span class="text-danger"><?php echo form_error('description[0]'); ?></span>
                                </td>
                                <td>
                                    <!-- uom -->
                                    <select class="form-control select2 uom" style='width:100%' data-live-search="true"
                                        name="uom[]" id="uom" required>
                                        <option value="">--- select ---</option>
                                        <?php if(!empty($measurements)): ?>
                                        <?php foreach ($measurements as $key => $uom):?>
                                        <option value="<?php echo $uom->id ?>"
                                            <?php echo set_select('uom[0]', $uom->id); ?>>
                                            <?php echo $uom->name.' ('.$uom->symbol.')'; ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('uom[0]'); ?></span>
                                </td>
                                <td>
                                    <!-- quantity -->
                                    <input class='form-control input-sm quantity' type="number" name="quantity[]"
                                        id="quantity" onkeyup="countPrice('')"
                                        value="<?php echo set_value('quantity[0]'); ?>"
                                        placeholder="<?php echo lang('quantity'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('quantity[0]'); ?></span>
                                </td>
                                <td>
                                    <!-- price -->
                                    <input class='form-control input-sm price' type="hidden" name="price[]" id="price"
                                        value="<?php echo set_value('price[0]'); ?>"
                                        placeholder="<?php echo lang('price'); ?>" />
                                    <input class='form-control input-sm' type="text" onkeyup="countPrice('')"
                                        id="show_price" value="<?php echo set_value('price[0]'); ?>"
                                        placeholder="<?php echo lang('price'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('price[0]'); ?></span>
                                </td>
                                <td>
                                    <!-- total -->
                                    <input class='form-control input-sm total' type="hidden" name="total[]" id="total"
                                        value="<?php echo set_value('total[0]'); ?>"
                                        placeholder="<?php echo lang('total'); ?>" />
                                    <input class='form-control input-sm' type="text" onkeyup="countTotal('')"
                                        id="show_total" value="<?php echo set_value('total[0]'); ?>"
                                        placeholder="<?php echo lang('total'); ?>" required readonly />
                                    <span class="text-danger"><?php echo form_error('total[0]'); ?></span>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <!-- remark -->
                                        <textarea class="form-control input-sm" name="remark[]" id="remark"
                                            rows="1"><?php echo set_value('remark[0]');?></textarea>
                                        <span class="text-danger"><?php echo form_error('remark[0]'); ?></span>
                                        <!-- btn add items -->
                                        <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">
                                            <a href="javascript:void(0)" title="Add Form" onclick="addItem();"
                                                class="btn btn-default btn-xs text-body"><span
                                                    class="glyphicon glyphicon-plus"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- validation false -->
                            <!-- append set_value -->
                            <?php 
                                    if($this->input->post('description') != null):
                                        $count = count($this->input->post('description'));
                                        if($count > 1): 
                                         for ($i=0; $i < $count; $i++):
                                            if($i > 0): ?>

                            <tr id="removeItem<?php echo $i; ?>">
                                <td id="no<?php echo $i; ?>"><?php echo $i; ?></td>
                                <td>
                                    <!-- discription -->
                                    <textarea class="form-control input-sm" name="description[]"
                                        id="description<?php echo $i; ?>" rows="1"
                                        required><?php echo set_value('description['.$i.']');?></textarea>
                                    <span class="text-danger"><?php echo form_error('description['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- uom -->
                                    <select class="form-control select2" style='width:100%' data-live-search="true"
                                        name="uom[]" id="uom<?php echo $i; ?>" required>
                                        <option value="">--- select ---</option>
                                        <?php if(!empty($measurements)): ?>
                                        <?php foreach ($measurements as $key => $uom):?>
                                        <option value="<?php echo $uom->id ?>"
                                            <?php echo set_select('uom['.$i.']', $uom->id); ?>>
                                            <?php echo $uom->name.' ('.$uom->symbol.')'; ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('uom['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- quantity -->
                                    <input class='form-control input-sm quantity' type="number" name="quantity[]"
                                        id="quantity<?php echo $i; ?>" onkeyup="countPrice('<?php echo $i; ?>')"
                                        value="<?php echo set_value('quantity['.$i.']'); ?>"
                                        placeholder="<?php echo lang('quantity'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('quantity['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- price -->
                                    <input class='form-control input-sm price' type="hidden" name="price[]"
                                        id="price<?php echo $i; ?>" value="<?php echo set_value('price['.$i.']'); ?>"
                                        placeholder="<?php echo lang('price'); ?>" />
                                    <input class='form-control input-sm' type="text"
                                        onkeyup="countPrice('<?php echo $i; ?>')" id="show_price<?php echo $i; ?>"
                                        value="<?php echo set_value('price['.$i.']'); ?>"
                                        placeholder="<?php echo lang('price'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('price['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- total -->
                                    <input class='form-control input-sm total' type="hidden" name="total[]"
                                        id="total<?php echo $i; ?>" value="<?php echo set_value('total['.$i.']'); ?>"
                                        placeholder="<?php echo lang('total'); ?>" />
                                    <input class='form-control input-sm' type="number"
                                        onkeyup="countTotal('<?php echo $i; ?>');" id="show_total<?php echo $i; ?>"
                                        value="<?php echo set_value('total['.$i.']'); ?>"
                                        placeholder="<?php echo lang('total'); ?>" required readonly />
                                    <span class="text-danger"><?php echo form_error('total['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <!-- remark -->
                                        <textarea class="form-control input-sm" name="remark[]"
                                            id="remark<?php echo $i; ?>"
                                            rows="1"><?php echo set_value('remark['.$i.']');?></textarea>
                                        <span class="text-danger"><?php echo form_error('remark['.$i.']'); ?></span>
                                        <!-- btn add items -->
                                        <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">
                                            <a href="javascript:void(0)" title="Add Form"
                                                onclick="removeItem('<?php echo $i; ?>');"
                                                class="btn btn-default btn-xs text-body"><span
                                                    class="glyphicon glyphicon-minus"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <?php 
                                            endif;
                                          endfor; 
                                        endif; 
                                    endif;
                                    ?>
                            <!-- total -->
                            <tr class="append-items">
                                <td class="text-right" style="border: none !important;" colspan="5"><b>Total:</b></td>
                                <td style="border: none !important;" id="sum_total">0</td>
                                <input type="hidden" name="total_amount" id="total_amount">
                                <td style="border: none !important;"></td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </div>
                <hr>
                <!-- end table items -->

                <!-- attachement file -->
                <div class="row">
                    <div id="file_block">
                        <div class="form-group">
                            <!-- files upload -->
                            <label class="col-md-2 label-heading" for="files">Attachment Files</label>
                            <div class="col-md-4 ui-front cover_attachment_files">
                                <input class='form-control files' type="file" id='attachment_files'
                                    name="attachment_files[]" value="<?php echo set_value('attachment_files[]'); ?>"
                                    onchange="files_input('attachment_files','')" multiple />
                                <span class="text-danger"><?php echo form_error('attachment_files[]'); ?></span>
                                <!-- name muse be like input file above -->
                                <input type="hidden" id="attachment_files_deleted" value=""
                                    name="attachment_files_deleted" class="form-control">
                            </div>
                            <!-- file description -->
                            <label class="col-md-2 label-heading" for="attachment_files_description">File Description:
                            </label>
                            <div class="col-md-4 ui-front">
                                <textarea class="form-control" id="attachment_files_description"
                                    name="attachment_files_description"
                                    rows="1"><?php echo set_value('attachment_files_description'); ?></textarea>
                            </div>
                        </div>
                        <!-- preview files -->
                        <style type="text/css">
                        .img-wrap {
                            position: relative;
                            display: inline-block;
                            /*border: 1px red solid;*/
                            font-size: 0;
                        }

                        .img-wrap .close {
                            position: absolute;
                            top: 2px;
                            right: 2px;
                            z-index: 100;
                            background-color: #FFF;
                            padding: 5px 2px 2px;
                            /*color: #000;*/
                            color: #d54d49;
                            font-weight: bold;
                            cursor: pointer;
                            opacity: .2;
                            text-align: center;
                            font-size: 22px;
                            line-height: 10px;
                            border-radius: 50%;
                        }

                        .img-wrap:hover .close {
                            opacity: 1;
                        }
                        </style>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <output id="list_attachment_files">
                                    <!-- if validation form false -->
                                    <?php 
                                            if($this->session->has_userdata('attachment_files_catch')):
                                                $pdf=0;$doc=0;$xls=0;
                                                $p=0;$d=0;$x=0;$kk=0;$jj=0;
                                                foreach ($this->session->userdata('attachment_files_catch') as $key => $file):
                                                    $ext = substr($file['extension'], 0, 4);

                                                    if ($ext == '.doc'):?>
                                    <div class="img-wrap" id="catch_attachment_files-doc-<?php echo $doc++; ?>">
                                        <span class="close" title="Delete"
                                            onclick="remove_file('catch_attachment_files-doc-<?php echo $d++; ?>','<?php echo $file['original_name']; ?>')">&times</span>
                                        <img class="thumb"
                                            style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;"
                                            src="<?php echo base_url('images/word.png'); ?>"
                                            title="<?php echo $file['upload_file_name']; ?>" />
                                    </div>
                                    <?php elseif ($ext == '.xls'):?>
                                    <div class="img-wrap" id="catch_attachment_files-xls-<?php echo $xls++; ?>">
                                        <span class="close" title="Delete"
                                            onclick="remove_file('catch_attachment_files-xls-<?php echo $x++; ?>', '<?php echo $file['original_name']; ?>')">&times</span>
                                        <img class="thumb"
                                            style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;"
                                            src="<?php echo base_url('images/excel.ico'); ?>"
                                            title="<?php echo $file['upload_file_name']; ?>" />
                                    </div>
                                    <?php elseif ($ext == '.pdf'):?>
                                    <div class="img-wrap" id="pdf-<?php echo $pdf++; ?>">
                                        <span class="close" title="Delete"
                                            onclick="remove_file('pdf-<?php echo $p++; ?>', '<?php echo $file['upload_file_name']; ?>')">&times</span>
                                        <img class="thumb"
                                            style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;"
                                            src="<?php echo base_url('images/pdf.png'); ?>"
                                            title="<?php echo $file['upload_file_name']; ?>" />
                                    </div>
                                    <?php else: ?>
                                    <div class="img-wrap" id="catch_attachment_files-pic-<?php echo $kk++; ?>">
                                        <span class="close" title="Delete"
                                            onclick="remove_file('catch_attachment_files-pic-<?php echo $jj++; ?>', '<?php echo $file['original_name']; ?>')">&times</span>
                                        <img class="thumb"
                                            style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;"
                                            src="<?php echo base_url().$file['file_path'].'/'.$file['upload_file_name']; ?>"
                                            title="<?php echo $file['upload_file_name']; ?>" />
                                    </div>
                                    <?php endif; 
                                                endforeach;
                                            endif;
                                        ?>
                                </output>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end attachment file -->

                <!-- approval blog  -->
                <div class="row panel panel-default">
                    <div class="panel-heading"><b>Decision Makers:</b></div>
                    <div class="panel-body">
                        <!-- status approval  -->
                        <div class="form-group">
                            <!-- checked_by  -->
                            <label for="checked_by" class="col-md-2 label-heading">Check By: <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-4 ui-front">
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
                            </div>
                            <!-- approved_by  -->
                            <label for="approved_by" class="col-md-2 label-heading">Approve By: <sup
                                    class="text-danger">*</sup></label>
                            <div class="col-md-4 ui-front">
                                <select name="approved_by" id="approved_by" class="form-control select2"
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end approval  -->

                <!-- button action -->
                <div class="text-right">
                    <!-- button cancel -->
                    <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip"
                        data-placement="bottom" title="Cancel" data-original-title="View"><i
                            class="glyphicon glyphicon-remove-circle"></i> Cancel</a>
                    <!-- button submit -->
                    <span id="submit_loader" style="display:none;"></span>
                    <button type="submit" id="btn-submit" class="btn btn-success"
                        onclick="getElementById('submit_loader').style.display = 'block'"><i
                            class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_save") ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/modal_confirm'); ?>
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
            '<!-- discription -->' +
            '<textarea class="form-control input-sm" name="description[]" id="description' + item +
            '" rows="1" required></textarea>' +
            '<span class="text-danger"><?php echo form_error("description['+item+']"); ?></span>' +
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
            '<!-- quantity -->' +
            '<input class="form-control input-sm quantity" type="number" onkeyup="countPrice(' + item +
            ');" name="quantity[]" id="quantity' + item + '" placeholder="<?php echo lang("quantity"); ?>"/>' +
            '<span class="text-danger"><?php echo form_error("quantity[0]"); ?></span>' +
            '</td>' +
            '<td>' +
            '<!-- price -->' +
            '<input class="form-control input-sm price" type="hidden" name="price[]" id="price' + item +
            '" placeholder="<?php echo lang("price"); ?>"/>' +
            '<input class="form-control input-sm" type="text" onkeyup="countPrice(' + item + ');" id="show_price' +
            item + '" placeholder="<?php echo lang("price"); ?>" required/>' +
            '<span class="text-danger"><?php echo form_error("price[0]"); ?></span>' +
            '</td>' +
            '<td>' +
            '<!-- total -->' +
            '<input class="form-control input-sm total" type="hidden" name="total[]" id="total' + item +
            '" placeholder="<?php echo lang("total"); ?>"/>' +
            '<input class="form-control input-sm" type="text" onkeyup="countTotal(' + item + ');" id="show_total' +
            item + '" placeholder="<?php echo lang("total"); ?>" required readonly/>' +
            '<span class="text-danger"><?php echo form_error("total[0]"); ?></span>' +
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
        sumTotal();
    }

    function countPrice(id) {
        var quantity = $('#quantity' + id).val();
        $('#show_price' + id).simpleMoneyFormat(); // show format
        $('#price' + id).val($('#show_price' + id).val().replace(/,/g, '')); // asign value to total
        var price = $('#price' + id).val();

        if (quantity == '') {
            quantity = 0;
        }
        if (price == '') {
            price = 0;
        }
        var total_amount = parseFloat(price) * parseFloat(quantity);
        console.log(total_amount);
        $('#show_total' + id).val(total_amount).simpleMoneyFormat(); // show format
        $('#total' + id).val(total_amount); // asign value to total
        sumTotal();
    }

    function sumTotal() {
        var sum_total = parseFloat(0);
        $(".total").each(function(key) {
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

    <!-- currency -->
    <script type="text/javascript">
    function changeProject() {
        var project = $('.project').val();
        $.ajax({
            url: 'findProjectLocation/' + project,
            type: 'get',
            success: function(output) {
                $('.location').val(output);
                checkRequiredForm();
            }
        });
    }
    </script>

    <!-- required form -->
    <script type="text/javascript">
    $(document).ready(function() {
        sumTotal();
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

    <!-- general -->
    <script type="text/javascript">
    $("#r_date").datepicker({
        dateFormat: 'dd-mm-yy',
        onClose: function(dfr) {
            // set minDate for identification_expiry_date
            $("#deadline").datepicker("option", "minDate", dfr);
        },
        onSelect: function(dateText){
            /* generate code */
            var date = $(this).val();
            $.ajax({
                url: 'generateCode',
                type: 'get',
                data:{'date': date},
                success: function(output) {
                    $('#ref_no').val(output);
                }
            });
        }
    });

    $("#deadline").datepicker({
        dateFormat: 'dd-mm-yy',
    });

    $('.select2').select2();
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function() {
        $("#alert-error").alert('close');
    });
    </script>