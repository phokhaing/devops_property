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
            po no: <b><?php echo $data->po_no; ?></b>
        </div>
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($data) ? $data->id : '')), array("class" => "form-horizontal","id"=>"form_purchase_order")) ?>
            <div class="col-md-12">
                <div class="form-group">
                    <!-- name_shop -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="name_shop">ឈ្មោះហាង/Name Shop<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <select name="name_shop" onchange="changeSupplier()" id="name_shop"
                                class="form-control select2 name_shop" style="width: 100%" required>
                                <option value="">--- select ---</option>
                                <?php if(!empty($suppliers)): ?>
                                <?php foreach ($suppliers as $key => $value) : ?>
                                <?php if (!empty($data)) {
                                                $name_shop = $data->name_shop;
                                                if (set_value('name_shop') != false) {
                                                    $name_shop = set_value('name_shop');
                                                }
                                            }?>
                                <option value="<?php echo $value->id; ?>"
                                    <?php echo ($name_shop == $value->id ? 'selected' : ''); ?>>
                                    <?php echo $value->name; ?></option>
                                <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('name_shop'); ?></span>
                            <!-- button add form -->
                            <a href="javascript:void(0)" onclick="addSupplier();" id="add_supplier" title="Add supplier"
                                class="pull-right">New</a>
                        </div>
                    </div>
                    <!-- po_no -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="po_no">លេខរៀង/PO No.<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="po_no" id="po_no"
                                value="<?php echo (set_value('po_no') == false ? $data->po_no : set_value('po_no')); ?>"
                                placeholder="<?php echo lang('po_no'); ?>" required readonly />
                            <span class="text-danger"><?php echo form_error('ref_no'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- address -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="address">អាសយដ្ឋាន/Address<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control address' type="text" name="address" id="address"
                                value="<?php echo (set_value('address') == false ? $data->address : set_value('address')); ?>"
                                placeholder="<?php echo lang('address'); ?>" required />
                            <span class="text-danger"><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                    <!-- date -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="date">ថ្ងៃធ្វើឯកសារ/Date<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <input class='form-control' type="text" name="date" id="date"
                                value="<?php echo (set_value('date') == false ? date('d-m-Y', strtotime($data->date)) : set_value('date')); ?>"
                                placeholder="<?php echo lang('date'); ?>" required />
                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- contact -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="contact">អ្នកទំនាក់ទំនង/Contact<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control contact' type="text" name="contact" id="contact"
                                value="<?php echo (set_value('contact') == false ? $data->contact : set_value('contact')); ?>"
                                placeholder="<?php echo lang('contact'); ?>" required />
                            <span class="text-danger"><?php echo form_error('contact'); ?></span>
                        </div>
                    </div>
                    <!-- deadline -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="deadline">ថ្ងៃកំណត់/Deadline<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <input class='form-control' type="text" name="deadline" id="deadline"
                                value="<?php echo (set_value('deadline') == false ? date('d-m-Y', strtotime($data->deadline)) : set_value('deadline')); ?>"
                                placeholder="<?php echo lang('deadline'); ?>" required />
                            <span class="text-danger"><?php echo form_error('deadline'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- phone_number -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="phone_number">លេខទូរស័ព្ទ/Phone<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="phone_number" id="phone_number"
                                value="<?php echo (set_value('phone_number') == false ? $data->phone_number : set_value('phone_number')); ?>"
                                placeholder="<?php echo lang('phone_number'); ?>" required />
                            <span class="text-danger"><?php echo form_error('phone_number'); ?></span>
                        </div>
                    </div>
                    <!-- pr_no -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="pr_no">លេខសំណើរ/PR No.<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="pr_no" id="pr_no"
                                value="<?php echo (set_value('pr_no') == false ? $data->pr_no : set_value('pr_no')); ?>"
                                placeholder="<?php echo lang('pr_no'); ?>" required />
                            <span class="text-danger"><?php echo form_error('pr_no'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- cheque -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="cheque">ឈ្មោះសែក/Cheque.<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="cheque" id="cheque"
                                value="<?php echo (set_value('cheque') == false ? $data->cheque : set_value('cheque')); ?>"
                                placeholder="<?php echo lang('cheque'); ?>" required />
                            <span class="text-danger"><?php echo form_error('cheque'); ?></span>
                        </div>
                    </div>
                    <!-- cheque_date -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="cheque_date">ថ្ងៃធ្វើឯកសារ/Date<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <input class='form-control' type="text" name="cheque_date" id="cheque_date"
                                value="<?php echo (set_value('cheque_date') == false ? $data->cheque_date : set_value('cheque_date')); ?>"
                                placeholder="<?php echo lang('cheque_date'); ?>" required />
                            <span class="text-danger"><?php echo form_error('cheque_date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- payment_term -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="payment_term">ការទូទាត់/Payment Term<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="payment_term" id="payment_term"
                                value="<?php echo (set_value('payment_term') == false ? $data->payment_term : set_value('payment_term')); ?>"
                                placeholder="<?php echo lang('payment_term'); ?>" required />
                            <span class="text-danger"><?php echo form_error('payment_term'); ?></span>
                        </div>
                    </div>
                    <!-- project -->
                    <div class="col-md-2 text-right">
                        <label class="label-heading" for="project">ឈ្មោះគំរោង/Project<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4">
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
                </div>
                <div class="form-group">
                    <!-- warranty -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="warranty">ការធានា/Warranty<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="warranty" id="warranty"
                                value="<?php echo (set_value('warrenty') == false ? $data->warranty : set_value('warranty')); ?>"
                                placeholder="<?php echo lang('warranty'); ?>" required />
                            <span class="text-danger"><?php echo form_error('warranty'); ?></span>
                        </div>
                    </div>
                    <!-- warranty_contact -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="warranty_contact">អ្នកទំនាក់ទំនង/Contact<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="warranty_contact" id="warranty_contact"
                                value="<?php echo (set_value('warranty_contact') == false ? $data->warranty_contact : set_value('warranty_contact')); ?>"
                                placeholder="<?php echo lang('warranty_contact'); ?>" required />
                            <span class="text-danger"><?php echo form_error('warranty_contact'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- delivery -->
                    <div class="col-md-2 col-xs-12">
                        <div class="row">
                            <label class="label-heading" for="delivery">ការដឹកជញ្ជូន/Delivery<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="delivery" id="delivery"
                                value="<?php echo (set_value('delivery') == false ? $data->delivery : set_value('delivery')); ?>"
                                placeholder="<?php echo lang('delivery'); ?>" required />
                            <span class="text-danger"><?php echo form_error('delivery'); ?></span>
                        </div>
                    </div>
                    <!-- delivery_phone_number -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="delivery_phone_number">លេខទូរស័ព្ទ/Phone<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="delivery_phone_number"
                                id="delivery_phone_number"
                                value="<?php echo (set_value('delivery_phone_number') == false ? $data->delivery_phone_number : set_value('delivery_phone_number')); ?>"
                                placeholder="<?php echo lang('delivery_phone_number'); ?>" required />
                            <span class="text-danger"><?php echo form_error('delivery_phone_number'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- location -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="location">ទីតាំង/Location<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <input class='form-control location' type="text" name="location" id="location"
                                value="<?php echo (set_value('location') == false ? $data->location : set_value('location')); ?>"
                                placeholder="<?php echo lang('location'); ?>" required />
                            <span class="text-danger"><?php echo form_error('location'); ?></span>
                        </div>
                    </div>
                    <!-- reciever -->
                    <div class="col-md-2 col-xs-12 text-right">
                        <label class="label-heading" for="reciever">លេខអ្នកទទួល/Reciever<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row">
                            <input class='form-control' type="text" name="reciever" id="reciever"
                                value="<?php echo (set_value('reciever') == false ? $data->reciever : set_value('reciever')); ?>"
                                placeholder="<?php echo lang('reciever'); ?>" required />
                            <span class="text-danger"><?php echo form_error('reciever'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- reference -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="reference"><?php echo lang('reference');?></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <input class='form-control reference' type="text" name="reference" id="reference"
                                value="<?php echo (set_value('reference') == false ? $data->reference : set_value('reference')); ?>"
                                placeholder="<?php echo lang('reference'); ?>" />
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
                                <th class="text-center" width="50px;">លរ<br>NO</br></th>
                                <th class="text-center">ពិពណ៍នាសម្ភារៈ <br>DESCRIPTION</th>
                                <th class="text-center" width="150px;">ខ្នាត/ឯកតា <br>UOM</th>
                                <th class="text-center" width="150px;">ចំនួន <br>QUANTITY</th>
                                <th class="text-center" width="150px;">តម្លៃ <br>PRICE</th>
                                <th class="text-center" width="250;">តម្លៃសរុប <br>TOTAL AMOUNT</th>
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
                                    <div class="input-group">
                                        <!-- total -->
                                        <input class='form-control input-sm total' type="hidden" name="total[]"
                                            id="total<?php echo $key;?>" value="<?php echo $item->total; ?>"
                                            placeholder="<?php echo lang('total'); ?>" />
                                        <input class='form-control input-sm' type="text"
                                            onkeyup="countTotal('<?php echo $key;?>')" id="show_total<?php echo $key;?>"
                                            value="<?php echo $item->total; ?>"
                                            placeholder="<?php echo lang('total'); ?>" required readonly />
                                        <span class="text-danger"><?php echo form_error('total['.$key.']'); ?></span>
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
                                    <div class="input-group">
                                        <!-- total -->
                                        <input class='form-control input-sm total' type="hidden" name="total[]"
                                            id="total<?php echo $i; ?>"
                                            value="<?php echo set_value('total['.$i.']'); ?>"
                                            placeholder="<?php echo lang('total'); ?>" />
                                        <input class='form-control input-sm' type="number"
                                            onkeyup="countTotal('<?php echo $i; ?>');" id="show_total<?php echo $i; ?>"
                                            value="<?php echo set_value('total['.$i.']'); ?>"
                                            placeholder="<?php echo lang('total'); ?>" required />
                                        <span class="text-danger"><?php echo form_error('total['.$i.']'); ?></span>
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
                                <td class="text-right" colspan="5">សរុប/Sub Total:</td>
                                <td id="show_sub_total_amount"><?php echo $data->sub_total_amount; ?></td>
                                <input type="hidden" name="sub_total_amount" id="sub_total_amount"
                                    value="<?php echo $data->sub_total_amount;?>">
                            </tr>
                            <tr>
                                <td class="text-right" colspan="5">តម្លៃបញ្ចុះ/Discount:</td>
                                <td>
                                    <!-- discount -->
                                    <input class='form-control input-sm discount' type="hidden" name="discount"
                                        id="discount" value="<?php echo $data->discount;?>" />
                                    <input class='form-control input-sm' type="text" onkeyup="countDiscount();"
                                        id="show_discount" value="<?php echo $data->discount; ?>"
                                        placeholder="<?php echo lang('discount'); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="5">ចំនួនប្រាក់កក់/Deposit:</td>
                                <td>
                                    <!-- deposit -->
                                    <input class='form-control input-sm deposit' type="hidden" name="deposit"
                                        id="deposit" value="<?php echo $data->deposit; ?>" />
                                    <input class='form-control input-sm' type="text" onkeyup="countDeposit();"
                                        id="show_deposit" value="<?php echo $data->deposit; ?>"
                                        placeholder="<?php echo lang('deposit'); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="5">តម្លៃសរុបក្រោយពេលបញ្ចុះតម្លៃ និងកក់/Grand Total After
                                    Discount and Deposit:</td>
                                <td id="show_total_amount"><?php echo $data->total_amount;?></td>
                                <input type="hidden" name="total_amount" id="total_amount"
                                    value="<?php echo $data->total_amount; ?>">
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

            <!-- order -->
            <div class="row panel panel-default">
                <div class="panel-heading"><b><u>សម្រាប់អ្នកផ្គត់ផ្គង់ (For Vendor Only)</u></b></div>
                <div class="panel-body">
                    <!-- status approval  -->
                    <div class="form-group">
                        <!-- order_by  -->
                        <label for="order_by" class="col-md-4 label-heading">ទទួលការកម្មង់ដោយ៖<br>Recieved and confirmed
                            order by: <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class="form-control" type="text" name="order_by"
                                value="<?php echo (set_value('order_by') == false ? $data->order_by : set_value('order_by')); ?>"
                                required>
                            <span class="text-danger"><?php echo form_error('order_by'); ?></span>
                        </div>
                        <!-- approved_by  -->
                        <label for="order_by" class="col-md-1 label-heading">Date: <sup
                                class="text-danger">*</sup></label>
                        <div class="col-md-3 ui-front">
                            <input class="form-control" type="text" id="order_date" name="order_date"
                                value="<?php echo (set_value('order_date') == false ? date('d-m-Y', strtotime($data->order_date)) : set_value('order_date')); ?>"
                                required>
                            <span class="text-danger"><?php echo form_error('order_date'); ?></span>
                        </div>
                    </div>
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

<?php $this->load->view('layout/modal_confirm', array('form_id'=>'form_purchase_order')); ?>
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
        '<div class="input-group">' +
        '<!-- total -->' +
        '<input class="form-control input-sm total" type="hidden" name="total[]" id="total' + item +
        '" placeholder="<?php echo lang("total"); ?>"/>' +
        '<input class="form-control input-sm" type="text" onkeyup="countTotal(' + item + ');" id="show_total' + item +
        '" placeholder="<?php echo lang("total"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("total[0]"); ?></span>' +
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
    var total = parseFloat(price) * parseFloat(quantity);

    $('#show_total' + id).val(total).simpleMoneyFormat(); // show format
    $('#total' + id).val(total); // asign value to total
    sumSubTotalAmount();
}

function countDiscount() {
    $('#show_discount').simpleMoneyFormat(); // show format
    $('#discount').val($('#show_discount').val().replace(/,/g, ''));
    sumSubTotalAmount();
}

function countDeposit() {
    $('#show_deposit').simpleMoneyFormat(); // show format
    $('#deposit').val($('#show_deposit').val().replace(/,/g, ''));
    sumSubTotalAmount();
}

function sumSubTotalAmount() {
    var sub_total_amount = parseFloat(0);
    $(".total").each(function(key) {
        sub_total_amount += +$(this).val();

        // show no length
        var noid = $(this).attr('id').replace(/total/g, 'no');
        $('#' + noid).text(key + 1);
    });
    $('#show_sub_total_amount').text(sub_total_amount).simpleMoneyFormat();
    $('#show_sub_total_amount').text($('#show_sub_total_amount').text() + '$');
    $('#sub_total_amount').val(sub_total_amount);

    var discount = $('#discount').val();
    var deposit = $('#deposit').val();
    if (discount == '') {
        discount = 0;
    }
    if (deposit == '') {
        deposit = 0;
    }
    var total_amount = parseFloat(sub_total_amount) - parseFloat(discount) - parseFloat(deposit);
    $('#show_total_amount').text(total_amount).simpleMoneyFormat();
    $('#show_total_amount').text($('#show_total_amount').text() + '$');
    $('#total_amount').val(total_amount);
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

function changeSupplier() {
    var supplier_to = $('.supplier_to').val();
    if (supplier_to != '') {
        $.ajax({
            url: 'findSupplierByID/' + supplier_to,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $('.contact').val(response.telephone);
                $('.address').val(response.address);
                checkRequiredForm();
            }
        });
    } else {
        $('.contact').val('');
        $('.address').val('');
        checkRequiredForm();
    }
}
</script>

<!-- general -->
<script type="text/javascript">
$("#date").datepicker({
    dateFormat: 'dd-mm-yy',
    onClose: function(dfr) {
        // set minDate for identification_expiry_date
        $("#deadline").datepicker("option", "minDate", dfr);
    },
    onSelect: function(dateText){
        /* generate code */
        var date = $(this).val();
        var code = '<?php echo $data->po_no;?>';
        $.ajax({
            url: 'generateCode',
            type: 'get',
            data:{
                'date': date,
                'code': code
            },
            success: function(output) {
                $('#po_no').val(output);
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
    sumSubTotalAmount();
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
        url: global_base_url + '/purchase_order/add_supplier',
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
                $('select[name="name_shop"]').html(response[1]);
                $('.contact').val(response.contact);
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