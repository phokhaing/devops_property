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
            ref code: <b><?php echo $data->ref_no; ?></b>
        </div>
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal","id"=>"form_update_purchase_request")) ?>
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
                                <option value="<?php echo $data->name; ?>"
                                    <?php echo set_select('name', $data->name); ?>>
                                    <?php echo getUserFullName($data->name); ?></option>
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
                                value="<?php echo (set_value('cell_phone') == false ? $data->cell_phone : set_value('cell_phone')); ?>"
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
                                value="<?php echo (set_value('ref_no') == false ? $data->ref_no : set_value('ref_no')); ?>"
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
                                <option value="<?php echo $data->position; ?>"
                                    <?php echo set_select('position', $data->position); ?>>
                                    <?php echo getPositionName($data->position); ?></option>
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
                                <option value="<?php echo $data->div; ?>" <?php echo set_select('div', $data->div); ?>>
                                    <?php echo getDivisionName($data->div); ?></option>
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
                                value="<?php echo (set_value('r_date') == false ? date('d-m-Y', strtotime($data->r_date)) : set_value('r_date')); ?>"
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
                                <option value="<?php echo $data->branch; ?>"
                                    <?php echo set_select('branch', $data->branch); ?>>
                                    <?php echo getBranchName($data->branch); ?></option>
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
                                value="<?php echo (set_value('deadline') == false ? date('d-m-Y', strtotime($data->deadline)) : set_value('deadline')); ?>"
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
                                <option value="<?php echo $data->department; ?>"
                                    <?php echo set_select('department', $data->department); ?>>
                                    <?php echo getDepartmentName($data->department); ?></option>
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
                                <?php if(!empty($data)){
                                                $selected = '';
                                                if($data->project == $value->id){
                                                    $selected = 'selected';
                                                }
                                            } ?>
                                <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>>
                                    <?php echo $value->project_name; ?></option>
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
                                value="<?php echo (set_value('location') == false ? $data->location : set_value('location')); ?>"
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
                            <textarea class="form-control" name="reference" id="reference" rows="2"><?php echo (set_value('reference') == false ? $data->reference : set_value('reference')); ?></textarea>
                            <span class="text-danger"><?php echo form_error('reference'); ?></span>
                        </div>
                    </div>
                    <!-- purpose -->
                    <div class="col-md-2 col-xs-12">
                        <label class="label-heading" for="staff_request">គោលបំណង/ Purpose<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <textarea class="form-control" name="purpose" id="purpose" rows="2"
                                required><?php echo (set_value('purpose') == false ? $data->purpose : set_value('purpose')); ?></textarea>
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

                            <input type="hidden" id="item_deleted" name="item_deleted"
                                value="<?php echo set_value('item_deleted'); ?>">

                            <?php 
                                $total = 0;
                                // exist data
                                if(!empty($items) && set_value('description[0]') == false):
                                    $num=1;
                                    foreach ($items as $key => $item): 
                                        $total += $item->total;
                                        if(set_value('item_id['.$key.']') == false){
                                            $item_id = $item->id;
                                        }else{
                                            $item_id = set_value('item_id['.$key.']');
                                        } ?>

                            <input type="hidden" name="item_id[]" value="<?php echo $item_id; ?>">
                            <tr id="removeItem<?php echo $key;?>">
                                <td id="no<?php echo $key;?>"><?php echo $num++; ?></td>
                                <td>
                                    <!-- discription -->
                                    <textarea class="form-control input-sm" name="description[]"
                                        id="description<?php echo $key;?>" rows="1"
                                        required><?php echo $item->description;?></textarea>
                                    <span class="text-danger"><?php echo form_error('description['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <!-- uom -->
                                    <select class="form-control select2" style='width:100%' data-live-search="true"
                                        name="uom[]" id="uom<?php echo $key; ?>" required>
                                        <option value="">--- select ---</option>
                                        <?php
                                                            $uom = $item->uom;
                                                            if (set_value('uom[' . $key . ']') != false) {
                                                                $uom = set_value('uom[' . $key . ']');
                                                            }
                                                        ?>
                                        <?php if (!empty($measurements)): ?>
                                        <?php foreach ($measurements as $row): ?>
                                        <option value="<?php echo $row->id ?>"
                                            <?php echo ($uom == $row->id ? 'selected' : ''); ?>>
                                            <?php echo $row->name.' ('.$row->symbol.')'; ?></option>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('uom['.$key. ']'); ?></span>
                                </td>
                                <td>
                                    <!-- quantity -->
                                    <input class='form-control input-sm' type="number"
                                        onkeyup="countPrice('<?php echo $key;?>')" name="quantity[]"
                                        id="quantity<?php echo $key;?>" value="<?php echo $item->quantity; ?>"
                                        placeholder="<?php echo lang('quantity'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('quantity['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <!-- price -->
                                    <input class='form-control input-sm price' type="hidden" name="price[]"
                                        id="price<?php echo $key;?>" value="<?php echo $item->price; ?>"
                                        placeholder="<?php echo lang('price'); ?>" />
                                    <input class='form-control input-sm' type="text"
                                        onkeyup="countPrice('<?php echo $key;?>')" id="show_price<?php echo $key;?>"
                                        value="<?php echo $item->price; ?>" placeholder="<?php echo lang('price'); ?>"
                                        required />
                                    <span class="text-danger"><?php echo form_error('price['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <!-- total -->
                                    <input class='form-control input-sm total' type="hidden" name="total[]"
                                        id="total<?php echo $key;?>" value="<?php echo $item->total; ?>"
                                        placeholder="<?php echo lang('total'); ?>" />
                                    <input class='form-control input-sm' type="text"
                                        onkeyup="countTotal('<?php echo $key;?>')" id="show_total<?php echo $key;?>"
                                        value="<?php echo $item->total; ?>" placeholder="<?php echo lang('total'); ?>"
                                        required readonly />
                                    <span class="text-danger"><?php echo form_error('total['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <!-- remark -->
                                        <textarea class="form-control input-sm" name="remark[]"
                                            id="remark<?php echo $key;?>" rows="1"><?php 
                                                                $remark = $item->remark;
                                                                if(set_value('remark['.$key.']') != false){
                                                                $remark = set_value('remark['.$key.']');
                                                                }
                                                                echo $remark;
                                                            ?> 
                                                        </textarea>
                                        <span class="text-danger"><?php echo form_error('remark['.$key.']'); ?></span>
                                        <!-- btn add items -->
                                        <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">
                                            <?php if($key > 0): ?>
                                            <!-- btn remove item -->
                                            <a href="javascript:void(0)" title="Remove Item"
                                                onclick="removeItem('<?php echo $key; ?>','<?php echo $item_id; ?>');"
                                                class="btn btn-default btn-xs text-body"><span
                                                    class="glyphicon glyphicon-minus"></span></a>
                                            <?php else: ?>
                                            <!-- btn add item -->
                                            <a href="javascript:void(0)" title="Add Form" onclick="addItem();"
                                                class="btn btn-default btn-xs text-body"><span
                                                    class="glyphicon glyphicon-plus"></span></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                    endforeach;

                                // validation form false
                                elseif($this->input->post('description') != null):
                                    for ($i=0; $i < count($this->input->post('description')); $i++):
                                        $total += set_value('total['.$i.']');
                                        $item_id = set_value('item_id['.$i.']');?>

                            <input type="hidden" name="item_id[]" value="<?php echo $item_id; ?>">
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
                                        <?php if (!empty($measurements)): ?>
                                        <?php foreach ($measurements as $row): ?>
                                        <option value="<?php echo $row->id ?>"
                                            <?php echo set_select('uom['.$i.']', $row->id); ?>>
                                            <?php echo $row->name.' ('.$row->symbol.')'; ?></option>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('uom['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- quantity -->
                                    <input class='form-control input-sm' type="number" name="quantity[]"
                                        onkeyup="countPrice('<?php echo $i; ?>');" id="quantity<?php echo $i; ?>"
                                        value="<?php echo set_value('quantity['.$i.']'); ?>"
                                        placeholder="<?php echo lang('quantity'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('quantity['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- price -->
                                    <input class='form-control input-sm price' type="hidden" name="price[]"
                                        id="price<?php echo $i; ?>" value="<?php echo set_value('price['.$i.']'); ?>"
                                        placeholder="<?php echo lang('price'); ?>" />
                                    <input class='form-control input-sm' type="number"
                                        onkeyup="countPrice('<?php echo $i; ?>');" id="show_price<?php echo $i; ?>"
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
                                        placeholder="<?php echo lang('total'); ?>" required />
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
                                            <?php if($i > 0): ?>
                                            <!-- btn remove item -->
                                            <a href="javascript:void(0)" title="Remove Item"
                                                onclick="removeItem('<?php echo $i; ?>','<?php echo $item_id; ?>');"
                                                class="btn btn-default btn-xs text-body"><span
                                                    class="glyphicon glyphicon-minus"></span></a>
                                            <?php else: ?>
                                            <!-- btn add item -->
                                            <a href="javascript:void(0)" title="Add Item" onclick="addItem();"
                                                class="btn btn-default btn-xs text-body"><span
                                                    class="glyphicon glyphicon-plus"></span></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <?php 
                                    endfor; 
                                endif;
                                ?>
                            <!-- total -->
                            <tr class="append-items">
                                <td class="text-right" style="border: none !important;" colspan="5"><b>Total:</b></td>
                                <td style="border: none !important;" id="sum_total">
                                    <?php echo currency_format(1, $data->total_amount); ?></td>
                                <input type="hidden" name="total_amount" id="total_amount"
                                    value="<?php echo $data->total_amount; ?>">
                                <td style="border: none !important;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end table items -->

            <div class="row">
                <div class="col-md-12">
                    <!-- list existing files -->
                    <?php if(!empty($attachments)): ?>
                    <input type="hidden" id="attachment_file_deleted" name="attachment_file_deleted"
                        value="<?php echo set_value('attachment_file_deleted'); ?>">
                    <input type="hidden" id="attachment_file_path" name="attachment_file_path"
                        value="<?php echo set_value('attachment_file_path'); ?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>File Name</th>
                                    <th>File Description</th>
                                    <th>File Size</th>
                                </tr>
                                <?php foreach ($attachments as $key => $attach) : ?>
                                <tr id="list_attachment_file<?php echo $key; ?>">
                                    <td>
                                        <?php $attach_path = $attach->file_path.'/'.$attach->upload_file_name;?>
                                        <a href="<?php echo base_url().$attach_path; ?>"
                                            target="_blank"><?php echo $attach->original_name; ?></a>
                                    </td>
                                    <td><?php echo $attach->description; ?></td>
                                    <td><?php echo $attach->file_size ?>kb <a href="javascript:void(0);"
                                            class="btn btn-danger btn-xs pull-right"
                                            onclick="removeAttachmentFile('<?php echo $key; ?>','<?php echo $attach->id; ?>','<?php echo $attach_path; ?>');"><span
                                                class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- upload files -->
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
                                    rows="1"><?php echo (set_value('attachment_files_description') == false ? (!empty($attachments) ? $attachments[0]->description : '') : set_value('attachment_files_description')); ?></textarea>
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
                    <!-- end upload files -->
                </div>
            </div>

            <!-- button action -->
            <div class="text-right">
                <!-- button update -->
                <span id="submit_loader" style="display:none;"></span>
                <?php if($this->authorization->hasPermission($moduleName, "create")): ?>
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

<?php $this->load->view('layout/modal_confirm', array('form_id'=>'form_update_purchase_request')); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/simple.money.format.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/file_upload.js"></script>


<!-- items -->
<script type="text/javascript">
document.getElementById('attachment_files').addEventListener('change', handleFileSelect, false);

var item =
    <?php echo (set_value('description') == false ? (!empty($items) ? count($items)-1 : 0) : count($this->input->post('description'))-1); ?>;
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
        '<select class="form-control select2" style="width:100%" data-live-search="true" name="uom[]" id="uom' + item +
        '" required>' +
        '<option value="">--- select ---</option>' +
        '<?php if(!empty($measurements)): ?>' +
        '<?php foreach ($measurements as $key => $row):?>' +
        '<option value="<?php echo $row->id ?>"><?php echo $row->name." (".$row->symbol.")"; ?></option>' +
        '<?php endforeach; ?>' +
        '<?php endif; ?>' +
        '</select>' +
        '<span class="text-danger"><?php echo form_error("uom[0]"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- quantity -->' +
        '<input class="form-control input-sm" type="text" name="quantity[]" onkeyup="countPrice(' + item +
        ');" id="quantity' + item + '" placeholder="<?php echo lang("quantity"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("quantity[0]"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- price -->' +
        '<input class="form-control input-sm price" type="hidden" name="price[]" id="price' + item +
        '" placeholder="<?php echo lang("price"); ?>"/>' +
        '<input class="form-control input-sm" type="text" onkeyup="countPrice(' + item + ');" id="show_price' + item +
        '" placeholder="<?php echo lang("price"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("price[0]"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- total -->' +
        '<input class="form-control input-sm total" type="hidden" name="total[]" id="total' + item +
        '" placeholder="<?php echo lang("total"); ?>"/>' +
        '<input class="form-control input-sm" type="text" onkeyup="countTotal(' + item + ');" id="show_total' + item +
        '" placeholder="<?php echo lang("total"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("total[0]"); ?></span>' +
        '</td>' +
        '<td>' +
        '<div class="input-group">' +
        '<!-- remark -->' +
        '<textarea class="form-control input-sm" name="remark[]" id="remark' + item +
        '" rows="1" required></textarea>' +
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
function removeItem(item, item_id) {
    $('#removeItem' + item).remove();
    if (item_id != null) {
        var deleted = $('#item_deleted').val();
        deleted += "___" + item_id;
        $('#item_deleted').val(deleted);
    }
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
        var code = '<?php echo $data->ref_no;?>';
        $.ajax({
            url: 'generateCode',
            type: 'get',
            data:{
                'date': date,
                'code': code
            },
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