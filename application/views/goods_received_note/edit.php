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
            <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal","id"=>"form_goods_received_note")) ?>
            <div class="col-md-12">
                <div class="form-group">
                    <!-- received_from -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="received_from">Received From:<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <select name="received_from" onchange="changeSupplier()" id="received_from"
                                class="form-control select2 received_from" style="width: 100%" required>
                                <option value="">--- select ---</option>
                                <?php if(!empty($suppliers)): ?>
                                <?php foreach ($suppliers as $key => $value) : ?>
                                <?php if (!empty($data)) {
                                                $received_from = $data->received_from;
                                                if (set_value('received_from') != false) {
                                                    $received_from = set_value('received_from');
                                                }
                                            }?>
                                <option value="<?php echo $value->id; ?>"
                                    <?php echo ($received_from == $value->id ? 'selected' : ''); ?>>
                                    <?php echo $value->name; ?></option>
                                <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('received_from'); ?></span>
                            <!-- button add form -->
                            <a href="javascript:void(0)" onclick="addSupplier();" id="add_supplier" title="Add supplier"
                                class="pull-right">New</a>
                        </div>
                    </div>
                    <!-- grn_no -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="grn_no">GRN No.:<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="grn_no" id="grn_no"
                                value="<?php echo (set_value('grn_no') == false ? $data->grn_no : set_value('grn_no')); ?>"
                                placeholder="<?php echo lang('grn_no'); ?>" required readonly />
                            <span class="text-danger"><?php echo form_error('grn_no'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- address -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="address">Address:<sup class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <textarea class="form-control address" name="address" id="address" rows="1"
                                required><?php echo (set_value('address') == false ? $data->address : set_value('address')); ?></textarea>
                            <span class="text-danger"><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                    <!-- date -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="date">Date:<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="date" id="date"
                                value="<?php echo (set_value('date') == false ? date('d-m-Y', strtotime($data->date)) : set_value('date')); ?>"
                                placeholder="<?php echo lang('date'); ?>" required />
                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- phone -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="phone">Phone:<sup class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control phone' type="text" name="phone" id="phone"
                                value="<?php echo (set_value('phone') == false ? $data->phone : set_value('phone')); ?>"
                                placeholder="<?php echo lang('phone'); ?>" required />
                            <span class="text-danger"><?php echo form_error('phone'); ?></span>
                        </div>
                    </div>
                    <!-- ordered_no -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="ordered_no">Ordered No.:<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="ordered_no" id="ordered_no"
                                value="<?php echo (set_value('ordered_no') == false ? $data->ordered_no : set_value('ordered_no')); ?>"
                                placeholder="<?php echo lang('ordered_no'); ?>" required />
                            <span class="text-danger"><?php echo form_error('ordered_no'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- reference -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="reference"><?php echo lang('reference');?>:<sup class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <textarea class="form-control reference" name="reference" id="reference" rows="1"
                                required><?php echo (set_value('reference') == false ? $data->reference : set_value('reference')); ?></textarea>
                            <span class="text-danger"><?php echo form_error('reference'); ?></span>
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
                                <th class="text-center" width="50px;">No.</br></th>
                                <th class="text-center">Item No.</th>
                                <th class="text-center">Description</th>
                                <th class="text-center" width="100px;">Ref. No.</th>
                                <th class="text-center" width="100px;">UOM</th>
                                <th class="text-center" width="100px;">Price</th>
                                <th class="text-center" width="250px">Remarks</th>
                            </tr>

                            <input type="hidden" id="item_deleted" name="item_deleted"
                                value="<?php echo set_value('item_deleted'); ?>">

                            <?php 
                                // exist data
                                if(!empty($items) && set_value('description[0]') == false):
                                    $num=1;
                                    foreach ($items as $key => $item): 
                                        if(set_value('item_id['.$key.']') == false){
                                            $item_id = $item->id;
                                        }else{
                                            $item_id = set_value('item_id['.$key.']');
                                        } ?>

                            <input type="hidden" name="item_id[]" value="<?php echo $item_id; ?>">
                            <tr id="removeItem<?php echo $key;?>">
                                <td id="no<?php echo $key;?>"><?php echo $num++; ?></td>
                                <td>
                                    <!-- item_no -->
                                    <input class='form-control input-sm item_no' type="text" name="item_no[]"
                                        id="item_no<?php echo $key;?>" value="<?php echo $item->item_no; ?>"
                                        placeholder="<?php echo lang('item_no'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('item_no['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <!-- discription -->
                                    <textarea class="form-control input-sm" name="description[]"
                                        id="description<?php echo $key;?>" rows="1"
                                        required><?php echo $item->description;?></textarea>
                                    <span class="text-danger"><?php echo form_error('description['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <!-- ref_no -->
                                    <input class='form-control input-sm ref_no' type="text" name="ref_no[]"
                                        id="ref_no<?php echo $key;?>" value="<?php echo $item->ref_no; ?>"
                                        placeholder="<?php echo lang('ref_no'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('ref_no['.$key.']'); ?></span>
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
                                    <!-- price -->
                                    <input class='form-control input-sm price' type="hidden" name="price[]"
                                        id="price<?php echo $key;?>" value="<?php echo $item->price; ?>"
                                        placeholder="<?php echo lang('price'); ?>" />
                                    <input class='form-control input-sm' type="text"
                                        onkeyup="sumPrice('<?php echo $key;?>')" id="show_price<?php echo $key;?>"
                                        value="<?php echo $item->price; ?>" placeholder="<?php echo lang('price'); ?>"
                                        required />
                                    <span class="text-danger"><?php echo form_error('price['.$key.']'); ?></span>
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
                                        $item_id = set_value('item_id['.$i.']');?>

                            <input type="hidden" name="item_id[]" value="<?php echo $item_id; ?>">
                            <tr id="removeItem<?php echo $i; ?>">
                                <td id="no<?php echo $i; ?>"><?php echo $i; ?></td>
                                <td>
                                    <!-- item_no -->
                                    <input class='form-control input-sm item_no' type="text" name="item_no[]"
                                        id="item_no<?php echo $i; ?>" value="<?php echo set_value('item_no['.$i.']');?>"
                                        placeholder="<?php echo lang('item_no'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('item_no['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- discription -->
                                    <textarea class="form-control input-sm" name="description[]"
                                        id="description<?php echo $i; ?>" rows="1"
                                        required><?php echo set_value('description['.$i.']');?></textarea>
                                    <span class="text-danger"><?php echo form_error('description['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- ref_no -->
                                    <input class='form-control input-sm ref_no' type="text" name="ref_no[]"
                                        id="ref_no<?php echo $i; ?>" value="<?php echo set_value('ref_no['.$i.']');?>"
                                        placeholder="<?php echo lang('ref_no'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('ref_no['.$i.']'); ?></span>
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
                                    <!-- price -->
                                    <input class='form-control input-sm price' type="hidden" name="price[]"
                                        id="price<?php echo $i; ?>" value="<?php echo set_value('price['.$i.']'); ?>"
                                        placeholder="<?php echo lang('price'); ?>" />
                                    <input class='form-control input-sm' type="number"
                                        onkeyup="sumPrice('<?php echo $i; ?>');" id="show_price<?php echo $i; ?>"
                                        value="<?php echo set_value('price['.$i.']'); ?>"
                                        placeholder="<?php echo lang('price'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('price['.$i.']'); ?></span>
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

<?php $this->load->view('layout/modal_confirm', array('form_id'=>'form_goods_received_note')); ?>
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
        '<!-- item_no -->' +
        '<input class="form-control input-sm" type="text" name="item_no[]" id="item_no' + item +
        '" placeholder="<?php echo lang("item_no"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("item_no['+item+']"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- discription -->' +
        '<textarea class="form-control input-sm" name="description[]" id="description' + item +
        '" rows="1" required></textarea>' +
        '<span class="text-danger"><?php echo form_error("description['+item+']"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- ref_no -->' +
        '<input class="form-control input-sm" type="text" name="ref_no[]" id="ref_no' + item +
        '" placeholder="<?php echo lang("ref_no"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("ref_no['+item+']"); ?></span>' +
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
        '<span class="text-danger"><?php echo form_error("uom['+item+']"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- price -->' +
        '<input class="form-control input-sm price" type="hidden" name="price[]" id="price' + item +
        '" placeholder="<?php echo lang("price"); ?>"/>' +
        '<input class="form-control input-sm" type="text" onkeyup="sumPrice(' + item + ');" id="show_price' + item +
        '" placeholder="<?php echo lang("price"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("price['+item+']"); ?></span>' +
        '</td>' +
        '<td>' +
        '<div class="input-group">' +
        '<!-- remark -->' +
        '<textarea class="form-control input-sm" name="remark[]" id="remark' + item +
        '" rows="1" required></textarea>' +
        '<span class="text-danger"><?php echo form_error("remark['+item+']"); ?></span>' +
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
        var code = '<?php echo $data->grn_no;?>';
        $.ajax({
            url: 'generateCode',
            type: 'get',
            data:{
                'date': date,
                'code': code
            },
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
                                <label for="telephone" class="col-md-3 label-heading"><?php echo lang('telephone'); ?>
                                    <sup class="text-danger">*</sup></label>
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