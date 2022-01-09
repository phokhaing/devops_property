<?php if (!empty($this->session->flashdata('error'))) {?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b>
            <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php }?>

<div class="white-area-content animate-bottom">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span>
            <?php echo lang("edit") . ' ' . lang($title); ?></div>
        <div class="db-header-extra">
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            ref code: <b><?php echo $data->ref_no; ?></b>
        </div>
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link . "/update?id=" . (!empty($data) ? $data->id : '')), array("class" => "form-horizontal","id"=>"form_update_payment_voucher")) ?>
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
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="position">តួនាទី/ Position<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <label class="label-heading" for="div">ផ្នែក/ Div<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <select name="div" id="div" class="form-control select2" style="width: 100%" required>
                                <option value="<?php echo $data->div; ?>" <?php echo set_select('div', $data->div); ?>>
                                    <?php echo getDivisionName($data->div); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('div'); ?></span>
                        </div>
                    </div>
                    <!-- date -->
                    <div class="col-md-2">
                        <label class="label-heading" for="date">កាលបរិច្ឆេទ/ Date<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <input class='form-control' type="text" name="date" id="date"
                                value="<?php echo (set_value('date') == false ? date('d-m-Y', strtotime($data->date)) : set_value('date')); ?>"
                                placeholder="<?php echo lang('date'); ?>" required />
                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- staff_id -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="staff_id">អត្តលេខ/ ID<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <input class='form-control' type="text" name="staff_id" id="staff_id"
                                value="<?php echo (set_value('staff_id') == false ? $this->user->info->staff_id : set_value('staff_id')); ?>"
                                placeholder="<?php echo lang('ID'); ?>" required readonly />
                            <span class="text-danger"><?php echo form_error('staff_id'); ?></span>
                        </div>
                    </div>
                    <!-- branch -->
                    <div class="col-md-2">
                        <label class="label-heading" for="branch">សាខា/ Branch<sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <select name="branch" id="branch" class="form-control select2" style="width: 100%" required>
                                <option value="<?php echo $data->branch; ?>"
                                    <?php echo set_select('branch', $data->branch); ?>>
                                    <?php echo getBranchName($data->branch); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('branch'); ?></span>
                        </div>
                    </div>
                    <!-- department -->
                    <div class="col-md-2">
                        <label class="label-heading" for="department">នាយកដ្ឋាន/ Department<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-2">
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
                </div>
                <div class="form-group">
                    <!-- project -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="project">គំរោង/ Project<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <select name="project" onchange="changeProject()" id="project"
                                class="form-control select2 project" style="width: 100%" required>
                                <option value="">--- select ---</option>
                                <?php if (!empty($projects)): ?>
                                <?php foreach ($projects as $key => $value): ?>
                                <?php if (!empty($data)) {
                                                $selected = '';
                                                if ($data->project == $value->id) {
                                                    $selected = 'selected';
                                                }
                                            }?>
                                <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>>
                                    <?php echo $value->project_name; ?></option>
                                <?php endforeach?>
                                <?php endif;?>
                            </select>
                            <span class="text-danger"><?php echo form_error('project'); ?></span>
                        </div>
                    </div>
                    <!-- location -->
                    <div class="col-md-2">
                        <label class="label-heading" for="location">ទីតាំង/ location<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <input class='form-control location' type="text" name="location" id="location"
                                value="<?php echo (set_value('location') == false ? $data->location : set_value('location')); ?>"
                                placeholder="<?php echo lang('location'); ?>" required readonly />
                            <span class="text-danger"><?php echo form_error('location'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- supplier_to -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="supplier_to">អ្នកផ្គត់ផ្គង់/ Supplier To<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <select name="supplier_to" onchange="changeSupplier()" id="supplier_to"
                                class="form-control select2 supplier_to" style="width: 100%" required>
                                <option value="">--- select ---</option>
                                <?php if(!empty($suppliers)): ?>
                                <?php foreach ($suppliers as $key => $value) : ?>
                                <?php if (!empty($data)) {
                                                $supplier_to = $data->supplier_to;
                                                if (set_value('supplier_to') != false) {
                                                    $supplier_to = set_value('supplier_to');
                                                }
                                            }?>
                                <option value="<?php echo $value->id; ?>"
                                    <?php echo ($supplier_to == $value->id ? 'selected' : ''); ?>>
                                    <?php echo $value->name; ?></option>
                                <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('supplier_to'); ?></span>
                        </div>
                    </div>
                    <!-- telephone -->
                    <div class="col-md-2">
                        <label class="label-heading" for="telephone">ទូរស័ព្ទ/ Telephone<sup
                                class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <input class='form-control telephone' type="text" name="telephone" id="telephone"
                                value="<?php echo (set_value('telephone') == false ? $data->telephone : set_value('telephone')); ?>"
                                placeholder="0123456789" required readonly />
                            <span class="text-danger"><?php echo form_error('telephone'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- address -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="address">អាសយដ្ឋាន/ Address<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <textarea class="form-control address" name="address" id="address" rows="1" required
                                readonly><?php echo (set_value('address') == false ? $data->address : set_value('address')); ?></textarea>
                            <span class="text-danger"><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- paid_to -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="paid_to">បង់ប្រាក់ទៅឈ្មោះ/ Paid To<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <textarea class="form-control" name="paid_to" id="paid_to" rows="1"
                                required><?php echo (set_value('paid_to') == false ? $data->paid_to : set_value('paid_to')); ?></textarea>
                            <span class="text-danger"><?php echo form_error('paid_to'); ?></span>
                        </div>
                    </div>
                    <!-- bank_account -->
                    <div class="col-md-2">
                        <label class="label-heading" for="bank_account">Bank Account</label>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <textarea class="form-control" name="bank_account" id="bank_account"
                                rows="1"><?php echo (set_value('bank_account') == false ? $data->bank_account : set_value('bank_account')); ?></textarea>
                            <span class="text-danger"><?php echo form_error('bank_account'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- purpose -->
                    <div class="col-md-2">
                        <div class="row">
                            <label class="label-heading" for="purpose">គោលបំណង/ Purpose<sup
                                    class="text-danger">*</sup></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <textarea class="form-control" name="purpose" id="purpose" rows="1"
                                required><?php echo (set_value('purpose') == false ? $data->purpose : set_value('purpose')); ?></textarea>
                            <span class="text-danger"><?php echo form_error('purpose'); ?></span>
                        </div>
                    </div>
                    <!-- reference -->
                    <div class="col-md-2">
                        <label class="label-heading" for="reference"><?php echo lang('reference');?></label>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <textarea class="form-control" name="reference" id="reference" rows="1"><?php echo (set_value('reference') == false ? $data->reference : set_value('reference')); ?></textarea>
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
                                <th class="text-center">លរ<br>NO</br></th>
                                <th class="text-center">កូដគណនេយ្យ <br>Account Code/Name</th>
                                <th class="text-center">បរិយាយ <br>DESCRIPTION</th>
                                <th class="text-center" colspan="2">Account USD<br><span class="text-left">Debit</span>
                                    | <span class="text-right"> Credit</span></th>
                                <th class="text-center">កំណត់សម្គាល់ <br>REMARK</th>
                            </tr>

                            <input type="hidden" id="item_deleted" name="item_deleted"
                                value="<?php echo set_value('item_deleted'); ?>">

                            <?php
                                    $total = 0;
                                    // exist data
                                    if (!empty($items) && set_value('description[0]') == false):
                                        $num = 1;
                                        foreach ($items as $key => $item):
                                            if (set_value('item_id[' . $key . ']') == false) {
                                                $item_id = $item->id;
                                            } else {
                                                $item_id = set_value('item_id[' . $key . ']');
                                            }?>

                            <input type="hidden" name="item_id[]" value="<?php echo $item_id; ?>">
                            <tr id="removeItem<?php echo $key; ?>">
                                <td id="no<?php echo $key; ?>"><?php echo $num++; ?></td>
                                <td>
                                    <!-- account -->
                                    <select class="form-control select2" style='width:100%' data-live-search="true"
                                        name="account[]" id="account<?php echo $key; ?>" required>
                                        <option value="">--- select ---</option>
                                        <?php
                                                            $account = $item->account;
                                                            if (set_value('account[' . $key . ']') != false) {
                                                                $account = set_value('account[' . $key . ']');
                                                            }
                                                        ?>
                                        <?php if (!empty($accounts)): ?>
                                        <?php foreach ($accounts as $acc): ?>
                                        <option value="<?php echo $acc->id ?>"
                                            <?php echo ($account == $acc->id ? 'selected' : ''); ?>>
                                            <?php echo $acc->code.' - '.$acc->name; ?></option>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('account['.$key. ']'); ?></span>
                                </td>
                                <td>
                                    <!-- discription -->
                                    <textarea class="form-control input-sm" name="description[]"
                                        id="description<?php echo $key; ?>" rows="1"
                                        required><?php echo $item->description; ?></textarea>
                                    <span class="text-danger"><?php echo form_error('description['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <!-- debit -->
                                    <input class='form-control input-sm debit' type="hidden" name="debit[]"
                                        id="debit<?php echo $key; ?>" value="<?php echo $item->debit; ?>"
                                        placeholder="<?php echo lang('debit'); ?>" />
                                    <input class='form-control input-sm' type="text"
                                        onkeyup="countDebit('<?php echo $key; ?>')" id="show_debit<?php echo $key; ?>"
                                        value="<?php echo $item->debit; ?>" placeholder="<?php echo lang('debit'); ?>"
                                        required />
                                    <span class="text-danger"><?php echo form_error('debit['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <!-- credit -->
                                    <input class='form-control input-sm credit' type="hidden" name="credit[]"
                                        id="credit<?php echo $key; ?>" value="<?php echo $item->credit; ?>"
                                        placeholder="<?php echo lang('credit'); ?>" />
                                    <input class='form-control input-sm' type="text"
                                        onkeyup="countCredit('<?php echo $key; ?>')" id="show_credit<?php echo $key; ?>"
                                        value="<?php echo $item->credit; ?>" placeholder="<?php echo lang('credit'); ?>"
                                        required />
                                    <span class="text-danger"><?php echo form_error('credit['.$key.']'); ?></span>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <!-- remark -->
                                        <textarea class="form-control input-sm" name="remark[]"
                                            id="remark<?php echo $key; ?>" rows="1" required><?php
                                                                $remark = $item->remark;
                                                                if (set_value('remark[' . $key . ']') != false) {
                                                                    $remark = set_value('remark[' . $key . ']');
                                                                }
                                                                echo $remark;
                                                            ?>
                                                        </textarea>
                                        <span
                                            class="text-danger"><?php echo form_error('remark[' . $key . ']'); ?></span>
                                        <!-- btn add items -->
                                        <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">
                                            <?php if ($key > 0): ?>
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
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                        endforeach;

                                    // validation form false
                                    elseif ($this->input->post('description') != null):
                                        for ($i = 0; $i < count($this->input->post('description')); $i++):
                                            $item_id = set_value('item_id[' . $i . ']');?>

                            <input type="hidden" name="item_id[]" value="<?php echo $item_id; ?>">
                            <tr id="removeItem<?php echo $i; ?>">
                                <td id="no<?php echo $i; ?>"><?php echo $i; ?></td>
                                <td>
                                    <!-- account -->
                                    <select class="form-control select2" style='width:100%' data-live-search="true"
                                        name="account[]" id="account<?php echo $i; ?>" required>
                                        <option value="">--- select ---</option>
                                        <?php if (!empty($accounts)): ?>
                                        <?php foreach ($accounts as $acc): ?>
                                        <option value="<?php echo $acc->id ?>"
                                            <?php echo set_select('account['.$i.']', $acc->id); ?>>
                                            <?php echo $acc->code.' - '.$acc->name; ?></option>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('account['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <!-- discription -->
                                    <textarea class="form-control input-sm" name="description[]"
                                        id="description<?php echo $i; ?>" rows="1"
                                        required><?php echo set_value('description['.$i.']'); ?></textarea>
                                    <span class="text-danger"><?php echo form_error('description['.$i .']'); ?></span>
                                </td>
                                <td>
                                    <!-- debit -->
                                    <input class='form-control input-sm debit' type="hidden" name="debit[]"
                                        id="debit<?php echo $i; ?>"
                                        value="<?php echo set_value('debit[' . $i . ']'); ?>"
                                        placeholder="<?php echo lang('debit'); ?>" />
                                    <input class='form-control input-sm' type="text"
                                        onkeyup="countDebit('<?php echo $i; ?>');" id="show_debit<?php echo $i; ?>"
                                        value="<?php echo set_value('debit[' . $i . ']'); ?>"
                                        placeholder="<?php echo lang('debit'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('debit[' . $i . ']'); ?></span>
                                </td>
                                <td>
                                    <!-- credit -->
                                    <input class='form-control input-sm credit' type="hidden" name="credit[]"
                                        id="credit<?php echo $i; ?>" value="<?php echo set_value('credit['.$i.']'); ?>"
                                        placeholder="<?php echo lang('credit'); ?>" />
                                    <input class='form-control input-sm' type="number"
                                        onkeyup="countCredit('<?php echo $i; ?>');" id="show_credit<?php echo $i; ?>"
                                        value="<?php echo set_value('credit['.$i.']'); ?>"
                                        placeholder="<?php echo lang('credit'); ?>" required />
                                    <span class="text-danger"><?php echo form_error('credit['.$i.']'); ?></span>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <!-- remark -->
                                        <textarea class="form-control input-sm" name="remark[]"
                                            id="remark<?php echo $i; ?>" rows="1"
                                            required><?php echo set_value('remark[' . $i . ']'); ?></textarea>
                                        <span class="text-danger"><?php echo form_error('remark[' . $i . ']'); ?></span>
                                        <!-- btn add items -->
                                        <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">
                                            <?php if ($i > 0): ?>
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
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                        endfor;
                                    endif;?>

                            <!-- total -->
                            <tr class="append-items">
                                <td class="text-right" colspan="3"><b>សរុប/ Total Amount</b></td>
                                <td id="show_total_debit"><?php echo currency_format(1, $data->total_debit); ?></td>
                                <input type="hidden" name="total_debit" value="<?php echo $data->total_debit; ?>"
                                    id="total_debit">
                                <input type="hidden" name="total_credit" value="<?php echo $data->total_credit; ?>"
                                    id="total_credit">
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end table items -->

            <div class="row">
                <div class="col-md-12">
                    <!-- list existing files -->
                    <?php if (!empty($attachments)): ?>
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
                                <?php foreach ($attachments as $key => $attach): ?>
                                <tr id="list_attachment_file<?php echo $key; ?>">
                                    <td>
                                        <?php $attach_path = $attach->file_path . '/' . $attach->upload_file_name;?>
                                        <a href="<?php echo base_url() . $attach_path; ?>"
                                            target="_blank"><?php echo $attach->original_name; ?></a>
                                    </td>
                                    <td><?php echo $attach->description; ?></td>
                                    <td><?php echo $attach->file_size ?>kb <a href="javascript:void(0);"
                                            class="btn btn-danger btn-xs pull-right"
                                            onclick="removeAttachmentFile('<?php echo $key; ?>','<?php echo $attach->id; ?>','<?php echo $attach_path; ?>');"><span
                                                class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                        </div>
                    </div>
                    <?php endif;?>
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
                                            if ($this->session->has_userdata('attachment_files_catch')):
                                                $pdf = 0;
                                                $doc = 0;
                                                $xls = 0;
                                                $p = 0;
                                                $d = 0;
                                                $x = 0;
                                                $kk = 0;
                                                $jj = 0;
                                                foreach ($this->session->userdata('attachment_files_catch') as $key => $file):
                                                    $ext = substr($file['extension'], 0, 4);

                                                    if ($ext == '.doc'): ?>
                                    <div class="img-wrap" id="catch_attachment_files-doc-<?php echo $doc++; ?>">
                                        <span class="close" title="Delete"
                                            onclick="remove_file('catch_attachment_files-doc-<?php echo $d++; ?>','<?php echo $file['original_name']; ?>')">&times</span>
                                        <img class="thumb"
                                            style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;"
                                            src="<?php echo base_url('images/word.png'); ?>"
                                            title="<?php echo $file['upload_file_name']; ?>" />
                                    </div>
                                    <?php elseif ($ext == '.xls'): ?>
                                    <div class="img-wrap" id="catch_attachment_files-xls-<?php echo $xls++; ?>">
                                        <span class="close" title="Delete"
                                            onclick="remove_file('catch_attachment_files-xls-<?php echo $x++; ?>', '<?php echo $file['original_name']; ?>')">&times</span>
                                        <img class="thumb"
                                            style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;"
                                            src="<?php echo base_url('images/excel.ico'); ?>"
                                            title="<?php echo $file['upload_file_name']; ?>" />
                                    </div>
                                    <?php elseif ($ext == '.pdf'): ?>
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
                                            src="<?php echo base_url() . $file['file_path'] . '/' . $file['upload_file_name']; ?>"
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

<?php $this->load->view('layout/modal_confirm', array('form_id'=>'form_update_payment_voucher'));?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/simple.money.format.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/file_upload.js"></script>


<!-- items -->
<script type="text/javascript">
document.getElementById('attachment_files').addEventListener('change', handleFileSelect, false);

var item =
    <?php echo (set_value('description') == false ? (!empty($items) ? count($items) - 1 : 0) : count($this->input->post('description')) - 1); ?>;
var count_item = 1;

function addItem() {
    item += 1;
    count_item = item + 1;
    var formItem = '<tr id="removeItem' + item + '">' +
        '<td  id="no' + item + '">' + count_item + '</td>' +
        '<td>' +
        '<!-- account -->' +
        '<select class="form-control select2" style="width:100%" data-live-search="true" name="account[]" id="account' +
        item + '" required>' +
        '<option value="">--- select ---</option>' +
        '<?php if(!empty($accounts)): ?>' +
        '<?php foreach ($accounts as $key => $acc):?>' +
        '<option value="<?php echo $acc->id ?>"><?php echo $acc->code." - ".$acc->name; ?></option>' +
        '<?php endforeach; ?>' +
        '<?php endif; ?>' +
        '</select>' +
        '<span class="text-danger"><?php echo form_error("account[0]"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- discription -->' +
        '<textarea class="form-control input-sm" name="description[]" id="description' + item +
        '" rows="1" required></textarea>' +
        '<span class="text-danger"><?php echo form_error("description['+item+']"); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- debit -->' +
        '<input class="form-control input-sm debit" value="0" type="hidden" name="debit[]" id="debit' + item +
        '" placeholder="<?php echo lang("debit"); ?>"/>' +
        '<input class="form-control input-sm" value="0" type="text" onkeyup="countDebit(' + item +
        ');" id="show_debit' + item + '" placeholder="<?php echo lang("debit"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error('debit[0]'); ?></span>' +
        '</td>' +
        '<td>' +
        '<!-- credit -->' +
        '<input class="form-control input-sm credit" value="0" type="hidden" name="credit[]" id="credit' + item +
        '" placeholder="<?php echo lang("credit"); ?>"/>' +
        '<input class="form-control input-sm" value="0" type="text" onkeyup="countCredit(' + item +
        ');" id="show_credit' + item + '" placeholder="<?php echo lang("credit"); ?>" required/>' +
        '<span class="text-danger"><?php echo form_error("credit[0]"); ?></span>' +
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
function removeItem(item, item_id) {
    $('#removeItem' + item).remove();
    if (item_id != null) {
        var deleted = $('#item_deleted').val();
        deleted += "___" + item_id;
        $('#item_deleted').val(deleted);
    }
    totalDebit();
    totalCredit();
}


function countCredit(id) {
    $('#show_credit' + id).simpleMoneyFormat(); // show format
    $('#credit' + id).val($('#show_credit' + id).val().replace(/,/g, '')); // asign value to credit
    totalCredit();
}

function totalCredit() {
    var total_credit = parseFloat(0);
    $(".credit").each(function(key) {
        total_credit += +$(this).val();

        // show no length
        var noid = $(this).attr('id').replace(/credit/g, 'no');
        $('#' + noid).text(key + 1);
    });
    // $('#total_credit').text(total_credit).simpleMoneyFormat();
    // $('#total_credit').text($('#total_credit').text()+ '$');
    $('#total_credit').val(total_credit);
}

function countDebit(id) {
    $('#show_debit' + id).simpleMoneyFormat(); // show format
    $('#debit' + id).val($('#show_debit' + id).val().replace(/,/g, '')); // asign value to debit
    totalDebit();
}

function totalDebit() {
    var show_total_debit = parseFloat(0);
    $(".debit").each(function(key) {
        show_total_debit += +$(this).val();

        // show no length
        var noid = $(this).attr('id').replace(/debit/g, 'no');
        $('#' + noid).text(key + 1);
    });
    $('#show_total_debit').text(show_total_debit).simpleMoneyFormat();
    $('#show_total_debit').text($('#show_total_debit').text() + '$');
    $('#total_debit').val(show_total_debit);
}
</script>

<!-- project -->
<script type="text/javascript">
function changeProject() {
    var project = $('.project').val();
    if (project != '') {
        $.ajax({
            url: 'findProjectLocation/' + project,
            type: 'get',
            success: function(output) {
                $('.location').val(output);
                checkRequiredForm();
            }
        });
    } else {
        $('.location').val('');
        checkRequiredForm();
    }
}

function changeSupplier() {
    var supplier_to = $('.supplier_to').val();
    if (supplier_to != '') {
        $.ajax({
            url: 'findSupplierByID/' + supplier_to,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $('.telephone').val(response.telephone);
                $('.address').val(response.address);
                checkRequiredForm();
            }
        });
    } else {
        $('.telephone').val('');
        $('.address').val('');
        checkRequiredForm();
    }
}
</script>

<!-- required form -->
<script type="text/javascript">
$(document).ready(function() {
    checkRequiredForm();
    totalDebit();
    totalCredit();
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
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            // check all input
            $("input").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            // check all select option
            $("select").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
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
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            $("input").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            $("select").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
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
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            // check all input
            $("input").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            // check all select option
            $("select").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
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
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            $("input").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
                    $('#btn-submit').prop('disabled', true);
                    return false;
                }
            });
            $("select").each(function() {
                if ($(this).prop('required') && $(this).val() == "") {
                    // console.log($(this).attr('id'));
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
                // console.log($(this).attr('id'));
                $('#btn-submit').prop('disabled', true);
                return false;
            }
        });
        // check all field input required
        $("input").each(function() {
            if ($(this).prop('required') && $(this).val() == "") {
                // console.log($(this).attr('id'));
                $('#btn-submit').prop('disabled', true);
                return false;
            }
        });
        // check all field select required
        $("select").each(function() {
            if ($(this).prop('required') && $(this).val() == '') {
                // console.log($(this).attr('id'));
                $('#btn-submit').prop('disabled', true);
                return false;
            }
        });
    });
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