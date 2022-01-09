<!-- from add$link.  -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<div class="white-area-content animate-bottom">
    <!-- label header -->
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("add").' '.lang("loan").' '.lang("application") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal")) ?>
                <div class="col-md-12">
                    <fieldset>
                        <ul class="nav nav-tabs">
                            <li class="active" id="active-application"><a data-toggle="tab" href="#application"><?php echo lang('application'); ?></a></li>
                            <li id="active-customer"><a data-toggle="tab" href="#co-borrower"><?php echo lang('co-borrower'); ?></a></li>
                            <li id="active-fee"><a data-toggle="tab" href="#fee"><?php echo lang('fee'); ?></a></li>
                            <li id="active-guarantor"><a data-toggle="tab" href="#guarantor"><?php echo lang('guarantor'); ?></a></li>
                            <li id="active-collateral"><a data-toggle="tab" href="#collateral"><?php echo lang('collateral'); ?></a></li>
                            <li id="active-attachment"><a data-toggle="tab" href="#attachment"><?php echo lang('attachment'); ?></a></li>
                            <li><a data-toggle="tab" href="#spouse"><?php echo lang('spouse'); ?></a></li>
                            <li id="active-identification"><a data-toggle="tab" href="#identification"><?php echo lang('identification'); ?></a></li>
                            <li id="active-contact"><a data-toggle="tab" href="#contact"><?php echo lang('contact'); ?></a></li>
                            <li id="active-employment"><a data-toggle="tab" href="#employment"><?php echo lang('employment'); ?></a></li>
                        </ul><br>

                        <div class="tab-content"><br>
                            <!-- application -->
                            <div id="application" class="tab-pane fade in active">
                                <!-- collateral form -->
                                <div class="form-group">
                                    <!-- customer_id -->
                                    <label class="col-md-2 label-heading" for="customer_id"><?php echo lang('customer'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="customer_id" id="customer_id" required>
                                            <option value="">--- select customer ---</option>
                                            <?php if(!empty($customers)): ?>
                                                <?php foreach($customers as $customer):?>
                                                    <option value="<?php echo $customer->id?>" <?php echo set_select('customer_id', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('customer_id'); ?></span>
                                    </div>
                                    <!-- application_date -->
                                    <label class="col-md-2 label-heading" for="application_date"><?php echo lang('application_date'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control' type="text" name="application_date" id="application_date" value="<?php echo set_value('application_date'); ?>" placeholder="<?php echo lang('application_date'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('application_date'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- currency -->
                                    <label class="col-md-2 label-heading" for="currency"><?php echo lang('currency'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select name="currency" id="currency" style='width:100%' data-live-search="true" class="form-control select2">
                                              <?php if(!empty(listCurrency())): ?>
                                                  <?php foreach (listCurrency() as $curr): ?>
                                                    <option value="<?php echo $curr->id;?>" <?php echo set_select('currency', $curr->id); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                                  <?php endforeach; ?>
                                              <?php endif; ?>
                                            </select>
                                        <span class="text-danger"><?php echo form_error('currency'); ?></span>
                                    </div>
                                    <!-- appliied_amount -->
                                    <label class="col-md-2 label-heading" for="applied_amount"><?php echo lang('applied_amount'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control' min="1" type="hidden" name="applied_amount" id="applied_amount" value="<?php echo set_value('applied_amount'); ?>"/>
                                            <input class='form-control' type="text" id="set_applied_amount" value="<?php echo set_value('applied_amount'); ?>" placeholder="<?php echo lang('applied_amount'); ?>" required/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="currencysign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('applied_amount'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- loan_amount -->
                                    <label class="col-md-2 label-heading" for="loan_amount"><?php echo lang('loan_amount'); ?> </label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control' type="hidden" name="loan_amount" id="loan_amount" value="<?php echo set_value('loan_amount'); ?>" placeholder="<?php echo lang('loan_amount'); ?>" required/>
                                            <input class='form-control' min="1" type="text" id="set_loan_amount" value="<?php echo set_value('loan_amount'); ?>" placeholder="<?php echo lang('loan_amount'); ?>" required/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="currencysign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('loan_amount'); ?></span>
                                    </div>
                                    <!-- term -->
                                    <label class="col-md-2 label-heading" for="term"><?php echo lang('term'); ?>  <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control' min="1" type="number" name="term" id="term" value="<?php echo set_value('term'); ?>" placeholder="<?php echo lang('term'); ?>" required/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">Month</div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('term'); ?></span>
                                    </div>                           
                                </div>
                                <div class="form-group">
                                    <!-- interest_rate -->
                                    <label class="col-md-2 label-heading" for="interest_rate"><?php echo lang('interest_rate'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control' min="1" type="number" name="interest_rate" id="interest_rate" value="<?php echo set_value('interest_rate'); ?>" placeholder="<?php echo lang('cycle_of_collateral'); ?>" required/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">% / year</div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('interest_rate'); ?></span> 
                                    </div> 
                                    <!-- installment -->
                                    <label class="col-md-2 label-heading" for="installment"><?php echo lang('installment'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control' min="1" type="number" name="installment" id="installment" value="<?php echo set_value('installment'); ?>" placeholder="<?php echo lang('installment_of_collateral'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('installment'); ?></span>
                                    </div>                                                 
                                </div>
                                <div class="form-group">
                                    <!-- cycle -->
                                    <label class="col-md-2 label-heading" for="cycle"><?php echo lang('cycle'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control' min="1" type="number" name="cycle" id="cycle" value="<?php echo set_value('cycle'); ?>" placeholder="<?php echo lang('cycle_of_collateral'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('cycle'); ?></span>
                                    </div>                            
                                    <!-- loan_product -->
                                    <label class="col-md-2 label-heading" for="loan_product"><?php echo lang('loan_product'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="loan_product" id="loan_product" required>
                                            <option value="">--- select collateral type ---</option>
                                            <?php if(!empty($loanProducts)): ?>
                                                <?php foreach($loanProducts as $row):?>
                                                    <option value="<?php echo $row->id?>" <?php echo set_select('loan_product', $row->id); ?>><?php echo $row->product_code.' - '.$row->name_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('collateral_type_id'); ?></span> 
                                    </div>                                                  
                                </div>
                                <div class="form-group">                            
                                     <!-- frequency_type -->
                                    <label class="col-md-2 label-heading" for="frequency_type"><?php echo lang('frequency_type'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="frequency_type" id="frequency_type" required>
                                          <option value="">--- select frequency type ---</option>
                                          <option value="W" <?php echo set_select('frequency_type', 'W'); ?>> Weekly</option>
                                          <option value="F" <?php echo set_select('frequency_type', 'F'); ?>> Two Weekly</option>
                                          <option value="M" <?php echo set_select('frequency_type', 'M'); ?>>Monthly</option>
                                          <option value="Q" <?php echo set_select('frequency_type', 'Q'); ?>> Quarterly</option>
                                          <option value="H" <?php echo set_select('frequency_type', 'H'); ?>>Yearly</option>
                                          <option value="O" <?php echo set_select('frequency_type', 'O'); ?>> Others</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('frequency_type'); ?></span> 
                                    </div>   
                                    <!-- frequency -->
                                    <label class="col-md-2 label-heading" for="frequency"><?php echo lang('frequency'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control' min="1" type="number" name="frequency" id="frequency" value="<?php echo set_value('frequency'); ?>" placeholder="<?php echo lang('cycle_of_collateral'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('frequency'); ?></span> 
                                    </div>
                                                              
                                </div>
                                <div class="form-group">   
                                    <!-- loan_purpose_type -->
                                    <label class="col-md-2 label-heading" for="loan_purpose_type"><?php echo lang('loan_purpose_type'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="loan_purpose_type" id="loan_purpose_type" required>
                                          <option value="">--- loan purpose type ---</option>
                                            <?php if(!empty($loanPurposeType)): ?>
                                                <?php foreach($loanPurposeType as $row):?>
                                                    <option value="<?php echo $row->id?>" <?php echo set_select('loan_product', $row->id); ?>><?php echo $row->purposetype_code.' - '.$row->name_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('loan_purpose_type'); ?></span> 
                                    </div>                        
                                    <!-- loan_purpose -->
                                    <label class="col-md-2 label-heading" for="loan_purpose"><?php echo lang('loan_purpose'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="loan_purpose" id="loan_purpose" required>
                                          <option value="">--- loan purpose type ---</option>
                                            <?php if(!empty($loanPurpose)): ?>
                                                <?php foreach($loanPurpose as $row):?>
                                                    <option value="<?php echo $row->id?>" <?php echo set_select('loan_product', $row->id); ?>><?php echo $row->purpose_code.' - '.$row->name_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('loan_purpose'); ?></span> 
                                    </div>                                                   
                                </div>
                                <div class="form-group">                            
                                    <!-- officer -->
                                    <label class="col-md-2 label-heading" for="officer"><?php echo lang('officer'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="officer" id="officer" required>
                                            <option value="">--- select collateral type ---</option>
                                            <?php if(!empty(findOfficer())): ?>
                                                <?php foreach (findOfficer() as $user):?>
                                                    <option value="<?php echo $user->ID; ?>" <?php echo set_select('officer', $user->ID); ?>><?php echo $user->first_name . ' ' . $user->last_name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('officer'); ?></span> 
                                    </div>
                                    <!-- branch -->
                                    <label class="col-md-2 label-heading" for="branch"><?php echo lang('branch'); ?> <sup class="text-danger">*</sup></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="branch" id="branch" required>
                                            <option value="">--- select branch ---</option>
                                            <?php if(!empty(listBranchActive())): ?>
                                                <?php 
                                                    $branch_set = $this->user->info->branch;
                                                    if(set_value('branch') != false){
                                                        $branch_set = set_value('branch');
                                                    }?>
                                                <?php foreach (listBranchActive() as $branch):?>
                                                    <option value="<?php echo $branch->id_branch; ?>" <?php echo ($branch_set == $branch->id_branch ? 'selected' : ''); ?>><?php echo $branch->branch_code . ' - ' . $branch->branch_name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('branch'); ?></span> 
                                    </div>                           
                                </div><hr>
                                <!-- End  info  --> 

                                <!-- approval blog  -->                   
                                   <?php $this->load->view('approval/form_request'); ?>
                                <!-- end approval  -->
                            </div>
                            <!-- co-borrower -->
                            <div id="co-borrower" class="tab-pane fade">
                                <div class="form-group">
                                    <!-- co_borrower -->
                                    <label class="col-md-2 label-heading" for="co_borrower"><?php echo lang('customer'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="co_borrower[]" id="co_borrower">
                                            <option value="">--- select customer ---</option>
                                            <?php if(!empty($customers)): ?>
                                                <?php foreach($customers as $customer):?>
                                                    <option value="<?php echo $customer->id?>" <?php echo set_select('co_borrower[0]', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('co_borrower'); ?></span>
                                    </div>
                                    <!-- relation_id -->
                                    <label class="col-md-2 label-heading" for="co_borrower_relation"><?php echo lang('relation_indicator'); ?></label>
                                    <div class="col-md-3 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="co_borrower_relation[]" id="co_borrower_relation">
                                            <option value="">--- select relation ---</option>
                                            <?php if(!empty($relations)): ?>
                                                <?php foreach($relations as $row):?>
                                                    <option value="<?php echo $row->id?>" <?php echo set_select('co_borrower_relation[0]', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('co_borrower_relation'); ?></span>  
                                    </div>
                                    <label class="col-md-1 label-heading" for="" id="addContact">
                                        <a href="javascript:void(0)" title="Add Form" onclick="addCoborrower();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                    </label>
                                </div>

                                <!-- append set_value -->
                                <?php 
                                if($this->input->post('co_borrower') != null):
                                    $set_value_contact = count($this->input->post('co_borrower'));
                                    if($set_value_contact > 1): 
                                     for ($i=0; $i < $set_value_contact; $i++):
                                         if($i > 0): ?>

                                            <div class="form-group">
                                                <!-- co_borrower -->
                                                <label class="col-md-2 label-heading" for="co_borrower"><?php echo lang('customer'); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <select class="form-control select2" style='width:100%' data-live-search="true" name="co_borrower[]" id="co_borrower">
                                                        <option value="">--- select customer ---</option>
                                                        <?php if(!empty($customers)): ?>
                                                            <?php foreach($customers as $customer):?>
                                                                <option value="<?php echo $customer->id?>" <?php echo set_select('co_borrower['.$i.']', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('co_borrower'); ?></span>
                                                </div>
                                                <!-- relation_id -->
                                                <label class="col-md-2 label-heading" for="co_borrower_relation"><?php echo lang('relation_indicator'); ?></label>
                                                <div class="col-md-3 ui-front">
                                                    <select class="form-control select2" style='width:100%' data-live-search="true" name="co_borrower_relation[]" id="co_borrower_relation">
                                                        <option value="">--- select relation ---</option>
                                                        <?php if(!empty($relations)): ?>
                                                            <?php foreach($relations as $row):?>
                                                                <option value="<?php echo $row->id?>" <?php echo set_select('co_borrower_relation['.$i.']', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('co_borrower_relation'); ?></span>  
                                                </div>
                                                <label class="col-md-1 label-heading" for="" id="addContact">
                                                    <a href="javascript:void(0)" title="Add Form" onclick="addCoborrower();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                                </label>
                                            </div>

                                         <?php endif; 
                                      endfor; 
                                   endif;
                                  endif; ?>
                                <!-- append main app to here -->
                                <div class="append-coborrower"></div>  
                            </div>

                            <!-- fee -->
                            <div id="fee" class="tab-pane fade">
                                <?php 
                                if(!empty($loanFee)):
                                    foreach ($loanFee as $key => $fee):

                                        $readonly = 'readonly';
                                        if(set_value('fee_option['.$key.']') == 'YES'){
                                            $readonly = '';
                                        } ?>

                                        <div class="form-group">
                                            <input class='form-control' type="hidden" name="fee_id[]" value="<?php echo $fee->id; ?>"/>
                                            <!-- fee_option -->
                                            <label class="col-md-2 label-heading" for="fee_option<?php echo $key; ?>"><?php echo $fee->name_kh; ?></label>
                                            <div class="col-md-2 ui-front">
                                                <select class="form-control select2" onchange="feeOption('<?php echo $key;?>')" style='width:100%' data-live-search="true" name="fee_option[]" id="fee_option<?php echo $key; ?>">
                                                    <option value="NO" <?php echo set_select('fee_option['.$key.']', 'NO') ?>>NO</option>
                                                    <option value="YES" <?php echo set_select('fee_option['.$key.']', 'YES') ?>>YES</option>
                                                </select>
                                            </div>
                                            <!-- fee_amount -->
                                            <label class="col-md-2 label-heading" for="fee_amount<?php echo $key; ?>"><?php echo lang('amount'); ?></label>
                                            <div class="col-md-2 ui-front">
                                                <input class='form-control' type="number" name="fee_amount[]" id="fee_amount<?php echo $key; ?>" value="<?php echo set_value('fee_amount['.$key.']'); ?>" <?php echo $readonly; ?>/>
                                            </div>
                                            <!-- fee_description -->
                                            <label class="col-md-2 label-heading" for="fee_description<?php echo $key; ?>"><?php echo lang('description'); ?></label>
                                            <div class="col-md-2 ui-front">
                                                <input class='form-control' type="text" name="fee_description[]" id="fee_description<?php echo $key; ?>" value="<?php echo set_value('fee_description['.$key.']'); ?>" <?php echo $readonly; ?>/>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                endif;?>
                            </div>
  
                            <!-- guarantor -->
                            <div id="guarantor" class="tab-pane fade">
                                <div class="form-group">
                                    <!-- co_borrower -->
                                    <label class="col-md-2 label-heading" for="guarantor"><?php echo lang('customer'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="guarantor[]" id="guarantor">
                                            <option value="">--- select customer ---</option>
                                            <?php if(!empty($guarantors)): ?>
                                                <?php foreach($guarantors as $customer):?>
                                                    <option value="<?php echo $customer->id?>" <?php echo set_select('guarantor[0]', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('guarantor'); ?></span>
                                    </div>
                                    <!-- relation_id -->
                                    <label class="col-md-2 label-heading" for="guarantor_relation"><?php echo lang('relation_indicator'); ?></label>
                                    <div class="col-md-3 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="guarantor_relation[]" id="guarantor_relation">
                                            <option value="">--- select relation ---</option>
                                            <?php if(!empty($relations)): ?>
                                                <?php foreach($relations as $row):?>
                                                    <option value="<?php echo $row->id?>" <?php echo set_select('guarantor_relation[0]', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('guarantor_relation'); ?></span>  
                                    </div>
                                    <label class="col-md-1 label-heading" for="" id="addContact">
                                        <a href="javascript:void(0)" title="Add Form" onclick="addGuarantor();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                    </label>
                                </div>

                                <!-- validation false -->
                                <?php 
                                if($this->input->post('guarantor') != null):
                                    $set_value_contact = count($this->input->post('guarantor'));
                                    if($set_value_contact > 1): 
                                     for ($i=0; $i < $set_value_contact; $i++):
                                         if($i > 0): ?>

                                            <div class="form-group">
                                                <!-- guarantor -->
                                                <label class="col-md-2 label-heading" for="guarantor"><?php echo lang('customer'); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <select class="form-control select2" style='width:100%' data-live-search="true" name="guarantor[]" id="guarantor">
                                                        <option value="">--- select customer ---</option>
                                                        <?php if(!empty($guarantors)): ?>
                                                            <?php foreach($guarantors as $customer):?>
                                                                <option value="<?php echo $customer->id?>" <?php echo set_select('guarantor['.$i.']', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('guarantor'); ?></span>
                                                </div>
                                                <!-- relation_id -->
                                                <label class="col-md-2 label-heading" for="guarantor_relation"><?php echo lang('relation_indicator'); ?></label>
                                                <div class="col-md-3 ui-front">
                                                    <select class="form-control select2" style='width:100%' data-live-search="true" name="guarantor_relation[]" id="guarantor_relation">
                                                        <option value="">--- select relation ---</option>
                                                        <?php if(!empty($relations)): ?>
                                                            <?php foreach($relations as $row):?>
                                                                <option value="<?php echo $row->id?>" <?php echo set_select('guarantor_relation['.$i.']', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('guarantor_relation'); ?></span>  
                                                </div>
                                                <label class="col-md-1 label-heading" for="" id="addContact">
                                                    <a href="javascript:void(0)" title="Add Form" onclick="addGuarantor();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                                </label>
                                            </div>

                                         <?php endif; 
                                      endfor; 
                                   endif;
                                  endif; ?>
                                <!-- append main app to here -->
                                <div class="append-guarantor"></div>  
                            </div>

                            <!-- collateral -->
                            <div id="collateral" class="tab-pane fade">
                                <div id="append_collateral_id">    
                                    <!-- validation false -->
                                    <?php 
                                    if(set_value('customer_id') != false):?>
                                        <div class="form-group">
                                            <!-- collateral_id -->
                                            <label class="col-md-2 label-heading" for="collateral_id"><?php echo lang('customer'); ?></label>
                                            <div class="col-md-10 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="collateral_id[]" id="collateral_id" multiple>
                                                    <option value="">--- select customer ---</option>
                                                    <?php if(!empty(listCollateralByCustomerID(set_value('customer_id')))): ?>
                                                        <?php foreach(listCollateralByCustomerID(set_value('customer_id')) as $key => $coll):

                                                            $collateral_set = array();
                                                            if ($this->input->post('collateral_id') != null) {
                                                                $collateral_set = $this->input->post('collateral_id');
                                                            }
                                                            ?>

                                                            <option value="<?php echo $coll->id?>" <?php echo (in_array($coll->id, $collateral_set) ? 'selected' : ''); ?>><?php echo $coll->collateral_id.' - '.$coll->owner_name;?></option>

                                                            
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                     <?php endif; ?>                                  
                                </div> 
                            </div>

                            <!-- attachment -->
                            <div id="attachment" class="tab-pane fade">
                                <!-- upload files -->
                                <div id="file_block">
                                    <div class="form-group">
                                        <!-- files upload -->
                                        <label class="col-md-2 label-heading" for="files">Attachment Files</label>
                                        <div class="col-md-4 ui-front cover_attachment_files">
                                            <input class='form-control files' type="file" id='attachment_files' name="attachment_files[]" value="<?php echo set_value('attachment_files[]'); ?>" onchange="files_input('attachment_files','')" multiple/>
                                            <span class="text-danger"><?php echo form_error('attachment_files[]'); ?></span>       
                                            <!-- name muse be like input file above -->
                                            <input type="hidden" id="attachment_files_deleted" value="" name="attachment_files_deleted" class="form-control">
                                        </div>   
                                        <!-- file description -->
                                        <label class="col-md-2 label-heading" for="attachment_files_description">Description: </label>
                                        <div class="col-md-4 ui-front">
                                            <textarea class="form-control" id="attachment_files_description" name="attachment_files_description" rows="1"><?php echo set_value('attachment_files_description'); ?></textarea>
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
                                                                    <span class="close" title="Delete" onclick="remove_file('catch_attachment_files-doc-<?php echo $d++; ?>','<?php echo $file['original_name']; ?>')">&times</span>
                                                                    <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/word.png'); ?>" title="<?php echo $file['upload_file_name']; ?>"/>
                                                                </div>
                                                            <?php elseif ($ext == '.xls'):?>
                                                                <div class="img-wrap" id="catch_attachment_files-xls-<?php echo $xls++; ?>">
                                                                    <span class="close" title="Delete" onclick="remove_file('catch_attachment_files-xls-<?php echo $x++; ?>', '<?php echo $file['original_name']; ?>')">&times</span>
                                                                    <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/excel.ico'); ?>" title="<?php echo $file['upload_file_name']; ?>"/>
                                                                </div>
                                                            <?php elseif ($ext == '.pdf'):?>
                                                                <div class="img-wrap" id="pdf-<?php echo $pdf++; ?>">
                                                                    <span class="close" title="Delete" onclick="remove_file('pdf-<?php echo $p++; ?>', '<?php echo $file['upload_file_name']; ?>')">&times</span>
                                                                    <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url('images/pdf.png'); ?>" title="<?php echo $file['upload_file_name']; ?>"/>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="img-wrap" id="catch_attachment_files-pic-<?php echo $kk++; ?>">
                                                                    <span class="close" title="Delete" onclick="remove_file('catch_attachment_files-pic-<?php echo $jj++; ?>', '<?php echo $file['original_name']; ?>')">&times</span>
                                                                    <img class="thumb" style="height: 75px;width:100px;border: 1px solid #000;margin: 10px 5px 0 0;" src="<?php echo base_url().$file['file_path'].'/'.$file['upload_file_name']; ?>" title="<?php echo $file['upload_file_name']; ?>"/>
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

                            <!-- spouse -->
                            <div id="spouse" class="tab-pane fade">
                                <div id="append_spouse">
                                    <!-- validation false -->                                      
                                    <?php 
                                    if(set_value('customer_id') != false): 
                                        $spouse = getSpouseByCustomerID(set_value('customer_id'));?>
                                        <fieldset id="spouse-info">
                                            <div class="form-group">
                                                <!-- spouse_firstname_kh -->
                                                    <label class="col-md-2 label-heading" for="spouse_firstname_kh"><?php echo lang("firstname_kh"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control" type="text" value="<?php echo $spouse->spouse_firstname_kh; ?>"/>
                                                    </div>
                                                    <!-- spouse_lastname_kh -->
                                                    <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang("lastname_kh"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control" type="text" value="<?php echo $spouse->spouse_lastname_kh; ?>"/>
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- spouse_firstname_en -->
                                                <label class="col-md-2 label-heading" for="spouse_firstname_en"><?php echo lang("firstname_en"); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <input class="form-control" type="text" value="<?php echo $spouse->spouse_firstname_en; ?>"/>
                                                </div>
                                                <!-- spouse_lastname_en -->
                                                <label class="col-md-2 label-heading" for="spouse_lastname_en"><?php echo lang("lastname_en"); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <input class="form-control" type="text" value="<?php echo $spouse->spouse_lastname_en; ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- spouse_dob -->
                                                <label class="col-md-2 label-heading" for="spouse_dob"><?php echo lang("dob"); ?></label>
                                                <div class="col-md-4 ui-front">                                    
                                                    <input class="form-control"  type="text" value="<?php echo $spouse->spouse_dob; ?>"/>   
                                                </div>
                                                <!-- spouse_nationality -->
                                                <label class="col-md-2 label-heading" for="spouse_nationality"><?php echo lang("nationality"); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <input type="text" class="form-control" value="<?php echo $spouse->nation_name_kh; ?>"/>    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- spouse_occupation -->
                                                <label class="col-md-2 label-heading" for="spouse_occupation"><?php echo lang("occupation"); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <input class="form-control"  type="text" value="<?php echo $spouse->spouse_occupation; ?>"/> 
                                                </div>
                                                <!-- spouse_id_type -->
                                                <label class="col-md-2 label-heading" for="spouse_id_type"><?php echo lang("id_type"); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <input type="text" class="form-control" value="<?php echo $spouse->iden_name_kh; ?>"/>
                                                            
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- spouse_id_code -->
                                                <label class="col-md-2 label-heading" for="spouse_id_code"><?php echo lang("id_code"); ?></label>
                                                <div class="col-md-4 ui-front">
                                                    <input class="form-control"  type="text" value="<?php echo $spouse->spouse_id_code; ?>"/>     
                                                </div> 
                                                <!-- spouse_issue_date -->
                                                <label class="col-md-2 label-heading" for="spouse_issue_date"><?php echo lang("issue_date"); ?></label>
                                                <div class="col-md-4 ui-front">                                    
                                                    <input class="form-control"  type="text" value="<?php echo $spouse->spouse_issue_date; ?>"/>     
                                                </div> 
                                            </div>
                                        </fieldset>                                    
                                    <?php else: ?>     
                                        <center>Please select customer first</center>
                                    <?php endif; ?>
                                </div>  
                            </div>

                            <!-- identification -->
                            <div id="identification" class="tab-pane fade">
                                <div id="append_identification">  
                                    <!-- validation false -->
                                    <?php 
                                    if(set_value('customer_id') != false):
                                        if(!empty(getIdentificationByCustomerID(set_value('customer_id')))):
                                            foreach (getIdentificationByCustomerID(set_value('customer_id')) as $key => $iden): ?>
                                                <div class="form-group">
                                                    <!-- identification_type -->
                                                    <label class="col-md-2 label-heading" for="identification_type"><?php echo lang("id_type"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $iden->iden_name_kh;?>"/>
                                                    </div>
                                                    <!-- identification_code -->
                                                    <label class="col-md-2 label-heading" for="identification_code"><?php echo lang("id_code"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $iden->identification_code;?>"/>
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <!-- identification_issue_place -->
                                                    <label class="col-md-2 label-heading" for="identification_issue_place"><?php echo lang("issue_place"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $iden->identification_issue_place;?>"/>
                                                    </div> 
                                                    <!-- identification_issue_date -->
                                                    <label class="col-md-2 label-heading" for="identification_issue_date"><?php echo lang("issue_date"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $iden->identification_issue_date;?>"/>
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <!-- identification_expiry_date -->
                                                    <label class="col-md-2 label-heading" for="identification_expiry_date"><?php echo lang("expiry_date"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $iden->identification_expiry_date;?>"/>
                                                    </div>
                                                </div><hr>
                                            <?php endforeach;
                                        else: ?>
                                            <center>Please select customer first</center>  
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <center>Please select customer first</center>  
                                    <?php endif; ?>        
                                </div>  
                            </div>

                            <!-- contact -->
                            <div id="contact" class="tab-pane fade">
                                <div id="append_contact">  
                                    <!-- validation false -->
                                    <?php 
                                    if(set_value('customer_id') != false):
                                        if(!empty(getContactByCustomerID(set_value('customer_id')))):
                                            foreach (getContactByCustomerID(set_value('customer_id')) as $key => $con): ?>
                                                <div class="form-group">
                                                    <!-- country_id -->
                                                    <label class="col-md-2 label-heading" for="country_id"><?php echo lang("country"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->country_name_kh;?>"/>
                                                    </div>
                                                    <!-- province_id -->
                                                    <label class="col-md-2 label-heading" for="province_id"><?php echo lang("province"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->province_name_kh;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- district_id -->
                                                    <label class="col-md-2 label-heading" for="district_id"><?php echo lang("district"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->district_name_kh;?>"/>
                                                    </div>
                                                    <!-- commune_id -->
                                                    <label class="col-md-2 label-heading" for="commune_id"><?php echo lang("commune"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->commune_name_kh;?>"/>
                                                    </div>                            
                                                </div>
                                                <div class="form-group">
                                                    <!-- village_id -->
                                                    <label class="col-md-2 label-heading" for="village_id"><?php echo lang("village"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->village_name_kh;?>"/>
                                                    </div>
                                                    <!-- city -->
                                                    <label class="col-md-2 label-heading" for="city"><?php echo lang("city"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->city;?>"/>
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <!-- house_no -->
                                                    <label class="col-md-2 label-heading" for="house_no"><?php echo lang("house_no"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->house_no;?>"/>
                                                    </div> 
                                                    <!-- street -->
                                                    <label class="col-md-2 label-heading" for="street"><?php echo lang("street"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->street;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- phone1 -->
                                                    <label class="col-md-2 label-heading" for="phone1"><?php echo lang("phone1"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->phone1;?>"/>
                                                    </div> 
                                                    <!-- phone2 -->
                                                    <label class="col-md-2 label-heading" for="phone2"><?php echo lang("phone2"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->phone2;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- email -->
                                                    <label class="col-md-2 label-heading" for="email"><?php echo lang("email"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->email;?>"/>
                                                    </div> 
                                                    <!-- map_latitude -->
                                                    <label class="col-md-2 label-heading" for="map_latitude"><?php echo lang("map_latitude"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->map_latitude;?>"/>
                                                    </div>                            
                                                </div> 
                                                <div class="form-group">
                                                    <!-- map_longitude -->
                                                    <label class="col-md-2 label-heading" for="map_longitude"><?php echo lang("map_longitude"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $con->map_longitude;?>"/>
                                                    </div> 
                                                </div><hr>
                                            <?php endforeach;
                                        else: ?>
                                            <center>Please select customer first</center>  
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <center>Please select customer first</center>  
                                    <?php endif; ?>                                               
                                </div>  
                            </div>

                            <!-- employment -->
                            <div id="employment" class="tab-pane fade">
                                <div id="append_employment">  
                                    <!-- validation false -->
                                    <?php 
                                    if(set_value('customer_id') != false):
                                        if(!empty(getEmploymentByCustomerID(set_value('customer_id')))):
                                            foreach (getEmploymentByCustomerID(set_value('customer_id')) as $key => $emp): 

                                                $emp_type = '';
                                                if($emp->employment_type == 'C'){
                                                    $emp_type = 'Current';
                                                }else{
                                                    $emp_type = 'Previouse';
                                                }
                                                $self_emp = '';
                                                if($emp->self_employee == 'Y'){
                                                    $self_emp = 'YES';
                                                }else{
                                                    $self_emp = 'NO';
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <!-- employment_type -->
                                                    <label class="col-md-2 label-heading" for="employment_type"><?php echo lang("employment_type"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp_type;?>"/>
                                                    </div>
                                                    <!-- self_employee -->
                                                    <label class="col-md-2 label-heading" for="self_employee"><?php echo lang("self_employee"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $self_emp;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- company_name -->
                                                    <label class="col-md-2 label-heading" for="company_name"><?php echo lang("company_name"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->company_name;?>"/>
                                                    </div> 
                                                    <!-- empbusiness_type_id -->
                                                    <label class="col-md-2 label-heading" for="empbusiness_type_id"><?php echo lang("business_type"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <select class="form-control">
                                                            <option><?php echo $emp->business_type_name_kh;?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- employer_name -->
                                                    <label class="col-md-2 label-heading" for="employer_name"><?php echo lang("employer_name"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->employer_name;?>"/>
                                                    </div> 
                                                    <!-- emp_occupation -->
                                                    <label class="col-md-2 label-heading" for="emp_occupation"><?php echo lang("occupation"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->emp_occupation;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- length_of_service -->
                                                    <label class="col-md-2 label-heading" for="length_of_service"><?php echo lang("length_of_service"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->length_of_service;?>"/>
                                                    </div> 
                                                    <!-- employer_address_type -->
                                                    <label class="col-md-2 label-heading" for="employer_address_type"><?php echo lang("employer_address_type"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->employer_address_type;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- employer_id -->
                                                    <label class="col-md-2 label-heading" for="employer_id"><?php echo lang("employer_id"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->employer_id;?>"/>
                                                    </div>
                                                    <!-- employer_country -->
                                                    <label class="col-md-2 label-heading" for="employer_country"><?php echo lang("country"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->country_name_kh;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">     
                                                    <!-- employer_province -->
                                                    <label class="col-md-2 label-heading" for="employer_province"><?php echo lang("province"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->province_name_kh;?>"/>
                                                    </div>                       
                                                    <!-- employer_district -->
                                                    <label class="col-md-2 label-heading" for="employer_district"><?php echo lang("district"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->district_name_kh;?>"/>
                                                    </div>                           
                                                </div>
                                                <div class="form-group">
                                                    <!-- employer_commune -->
                                                    <label class="col-md-2 label-heading" for="employer_commune"><?php echo lang("commune"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->commune_name_kh;?>"/>
                                                    </div> 
                                                    <!-- employer_village -->
                                                    <label class="col-md-2 label-heading" for="employer_village"><?php echo lang("village"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->village_name_kh;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">                            
                                                    <!-- employer_houseno -->
                                                    <label class="col-md-2 label-heading" for="employer_houseno"><?php echo lang("house_no"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->employer_houseno;?>"/>
                                                    </div> 
                                                    <!-- employer_street -->
                                                    <label class="col-md-2 label-heading" for="employer_street"><?php echo lang("street"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->employer_street;?>"/>
                                                    </div>                           
                                                </div>    
                                                <div class="form-group">    
                                                    <!-- employed_year -->
                                                    <label class="col-md-2 label-heading" for="employed_year"><?php echo lang("employed_year"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->employed_year;?>"/>
                                                    </div>                          
                                                    <!-- employee_currency -->
                                                    <label class="col-md-2 label-heading" for="employee_currency"><?php echo lang("currency"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input class="form-control"  type="text" value="<?php echo $emp->currency_name_kh." ". $emp->currency_code;?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <!-- emplyee_salary -->
                                                    <label class="col-md-2 label-heading" for="emplyee_salary"><?php echo lang("emplyee_salary"); ?></label>
                                                    <div class="col-md-4 ui-front">
                                                        <input id="emplyee_salary" class="form-control"  type="text" value="<?php echo $emp->emplyee_salary;?>"/>
                                                    </div>
                                                </div><hr>

                                            <?php endforeach;
                                        else: ?>
                                            <center>Please select customer first</center>  
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <center>Please select customer first</center>  
                                    <?php endif; ?>           
                                </div>  
                            </div>
                        </div>
                    </fieldset>                    
                    
                    <!-- button action -->
                    <div class="text-right">                    
                        <!-- button cancel -->
                        <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
                        <!-- button submit -->
                        <span id="submit_loader" style="display:none;"></span>
                        <button type="submit" id="btn-submit" class="btn btn-success" onclick="getElementById('submit_loader').style.display = 'block'"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_save") ?></button> 
                    </div>                                           
                </div>                  
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/modal_confirm'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/address.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/simple.money.format.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/file_upload.js"></script>

<!-- preview files -->
<script type="text/javascript">
    document.getElementById('attachment_files').addEventListener('change', handleFileSelect, false);
</script>
<!-- co borrower -->
<script type="text/javascript">
    var num = <?php echo (!empty($this->input->post('co_borrower')) ? count($this->input->post('co_borrower'))-1 : 0); ?>;
    function addCoborrower(num=null) {
        num += 1;
        if (num <= 10) {
            var coborrower = '<div id="removeCoborrower'+num+'">'+
                            '<div class="form-group">'+
                                '<!-- co_borrower -->'+
                                '<label class="col-md-2 label-heading" for="co_borrower"><?php echo lang('customer'); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<select class="form-control select2" style="width:100%"data-live-search="true" name="co_borrower[]" id="co_borrower" required>'+
                                        '<option value="">--- select customer ---</option>'+
                                        '<?php if(!empty($customers)): ?>
                                            <?php foreach($customers as $customer):?>
                                                <option value="<?php echo $customer->id?>" <?php echo set_select('co_borrower', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('co_borrower'); ?></span>'+
                                '</div>'+
                                '<!-- relation_id -->'+
                                '<label class="col-md-2 label-heading" for="co_borrower_relation"><?php echo lang('relation_indicator'); ?></label>'+
                                '<div class="col-md-3 ui-front">'+
                                   '<select class="form-control select2" style="width:100%" data-live-search="true" name="co_borrower_relation[]" id="co_borrower_relation" required>'+
                                        '<option value="">--- select relation ---</option>'+
                                        '<?php if(!empty($relations)): ?>
                                            <?php foreach($relations as $row):?>
                                                <option value="<?php echo $row->id?>" <?php echo set_select('co_borrower_relation', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('co_borrower_relation'); ?></span>'+  
                                '</div>'+
                                '<label class="col-md-1 label-heading">'+
                                    '<!-- button add form -->'+
                                    '<a href="javascript:void(0)" title="Remove Form" onclick="removeCoborrower('+num+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                '</label>'+
                            '</div>'+
                        '</div>';

            $('.append-coborrower').append(coborrower);
            $('.select2').select2();
                
        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE REQUEST TYPE THAT APPENDED
    function removeCoborrower(num){
        $('#removeCoborrower'+num).remove();
    }    
</script>

<!-- guantor -->
<script type="text/javascript">
    var g = <?php echo (!empty($this->input->post('guarantor')) ? count($this->input->post('guarantor'))-1 : 0); ?>;
    function addGuarantor(g=null) {
        g += 1;
        if (g <= 10) {
            var coborrower = '<div id="removeGuarantor'+g+'">'+
                            '<div class="form-group">'+
                                '<!-- guarantor -->'+
                                '<label class="col-md-2 label-heading" for="guarantor"><?php echo lang('customer'); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<select class="form-control select2" style="width:100%"data-live-search="true" name="guarantor[]" id="guarantor'+g+'">'+
                                        '<option value="">--- select customer ---</option>'+
                                        '<?php if(!empty($customers)): ?>
                                            <?php foreach($customers as $customer):?>
                                                <option value="<?php echo $customer->id?>" <?php echo set_select('guarantor', $customer->id); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('guarantor'); ?></span>'+
                                '</div>'+
                                '<!-- relation_id -->'+
                                '<label class="col-md-2 label-heading" for="guarantor_relation"><?php echo lang('relation_indicator'); ?></label>'+
                                '<div class="col-md-3 ui-front">'+
                                   '<select class="form-control select2" style="width:100%" data-live-search="true" name="guarantor_relation[]" id="guarantor_relation">'+
                                        '<option value="">--- select relation ---</option>'+
                                        '<?php if(!empty($relations)): ?>
                                            <?php foreach($relations as $row):?>
                                                <option value="<?php echo $row->id?>" <?php echo set_select('guarantor_relation', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>'+
                                            '<?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>'+
                                    '<span class="text-danger"><?php echo form_error('guarantor_relation'); ?></span>'+  
                                '</div>'+
                                '<label class="col-md-1 label-heading">'+
                                    '<!-- button add form -->'+
                                    '<a href="javascript:void(0)" title="Remove Form" onclick="removeGuarantor('+g+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                '</label>'+
                            '</div>'+
                        '</div>';

            $('.append-guarantor').append(coborrower);
            $('.select2').select2();                

        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE REQUEST TYPE THAT APPENDED
    function removeGuarantor(g){
        $('#removeGuarantor'+g).remove();
    } 
</script>

<!-- fee charge -->
<script type="text/javascript">
    function feeOption(id){
        if($('#fee_option'+id).val() == 'YES'){            
            $('#fee_amount'+id).removeAttr('readonly').val('');
            $('#fee_description'+id).removeAttr('readonly').val('');
        }else{
            $('#fee_amount'+id).attr('readonly','readonly').val('');
            $('#fee_description'+id).attr('readonly','readonly').val('');
        }
    }
</script>

<!-- on change customer_id -->
<script type="text/javascript">
    $('#customer_id').on('change', function(){
        var customer_id = $(this).val();

        if(customer_id){
            // show collateral
            $.ajax({
                url: 'getCollateralByCustomerID/'+customer_id,
                type: 'get',
                success: function(collateral){
                    if(collateral){
                        $('#active-collateral').show();
                        $('#append_collateral_id').html('<!-- collateral_id -->'+
                            '<div class="form-group">'+
                                '<label class="col-md-2 label-heading" for="collateral_id"><?php echo lang('collateral'); ?></label>'+
                                '<div class="col-md-10 ui-front">'+
                                   '<select class="form-control select2" style="width:100%" data-live-search="true" name="collateral_id[]" id="collateral_id" multiple>'+
                                        '<option value="">--- select collateral ---</option>'+
                                        collateral+
                                    '</select>'+ 
                                '</div>'+
                            '</div>');
                        $('.select2').select2();
                    }else{
                        $('#active-collateral').hide();
                        $('#append_collateral_id').html('');
                    }
                }
            });

            // show spouse info
            $.ajax({
                url: 'findSpouseByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(spouse){ 
                    if(spouse){
                        $('#active-spouse').show();
                        $('#append_spouse').html('<!-- spouse info -->'+
                                    '<input class="form-control" type="hidden" name="spouse_id" value="'+spouse.spouse_id+'"/>'+
                                    '<fieldset id="spouse-info">'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_firstname_kh -->'+
                                    '                <label class="col-md-2 label-heading" for="spouse_firstname_kh"><?php echo lang("firstname_kh"); ?></label>'+
                                    '                <div class="col-md-4 ui-front">'+
                                    '                    <input class="form-control" type="text" value="'+spouse.spouse_firstname_kh+'"/>'+
                                    '                </div>'+
                                    '                <!-- spouse_lastname_kh -->'+
                                    '                <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang("lastname_kh"); ?></label>'+
                                    '                <div class="col-md-4 ui-front">'+
                                    '                    <input class="form-control" type="text" value="'+spouse.spouse_lastname_kh+'"/>'+
                                    '                </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_firstname_en -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_firstname_en"><?php echo lang("firstname_en"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control" type="text" value="'+spouse.spouse_firstname_en+'"/>'+
                                    '            </div>'+
                                    '            <!-- spouse_lastname_en -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_lastname_en"><?php echo lang("lastname_en"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control" type="text" value="'+spouse.spouse_lastname_en+'"/>'+
                                    '            </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_dob -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_dob"><?php echo lang("dob"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">                                    '+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_dob+'"/>   '+
                                    '            </div>'+
                                    '            <!-- spouse_nationality -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_nationality"><?php echo lang("nationality"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input type="text" class="form-control" value="'+spouse.nation_name_kh+'"/>    '+
                                    '            </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_occupation -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_occupation"><?php echo lang("occupation"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_occupation+'"/> '+
                                    '            </div>'+
                                    '            <!-- spouse_id_type -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_id_type"><?php echo lang("id_type"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input type="text" class="form-control" value="'+spouse.iden_name_kh+'"/>'+
                                    '                        '+
                                    '            </div>'+
                                    '        </div>'+
                                    '        <div class="form-group">'+
                                    '            <!-- spouse_id_code -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_id_code"><?php echo lang("id_code"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">'+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_id_code+'"/>     '+
                                    '            </div> '+
                                    '            <!-- spouse_issue_date -->'+
                                    '            <label class="col-md-2 label-heading" for="spouse_issue_date"><?php echo lang("issue_date"); ?></label>'+
                                    '            <div class="col-md-4 ui-front">                                    '+
                                    '                <input class="form-control"  type="text" value="'+spouse.spouse_issue_date+'"/>     '+
                                    '            </div> '+
                                    '        </div>'+
                                    '</fieldset>'+
                                    '<!-- end spouse info -->');
                    }else{
                        $('#active-spouse').hide();
                        $('#append_spouse').html('');
                    }
                }
            });

            // show identification
            $.ajax({
                url: 'findIdentificationByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(identification){
                    if(identification){
                        var formIdentification = '';
                        $.each(identification, function(key, iden){
                            formIdentification += '<div id="removeIdentification">' +
                                        '<div class="form-group">'+
                                            '<!-- identification_type -->'+
                                            '<label class="col-md-2 label-heading" for="identification_type"><?php echo lang("id_type"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.iden_name_kh+'"/>'+
                                            '</div>'+
                                            '<!-- identification_code -->'+
                                            '<label class="col-md-2 label-heading" for="identification_code"><?php echo lang("id_code"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_code+'"/>'+
                                            '</div> '+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<!-- identification_issue_place -->'+
                                            '<label class="col-md-2 label-heading" for="identification_issue_place"><?php echo lang("issue_place"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_issue_place+'"/>'+
                                            '</div> '+
                                            '<!-- identification_issue_date -->'+
                                            '<label class="col-md-2 label-heading" for="identification_issue_date"><?php echo lang("issue_date"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_issue_date+'"/>'+
                                            '</div> '+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<!-- identification_expiry_date -->'+
                                            '<label class="col-md-2 label-heading" for="identification_expiry_date"><?php echo lang("expiry_date"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" value="'+iden.identification_expiry_date+'"/>'+
                                            '</div>'+
                                        '</div><hr>'+
                                    '</div>';
                        });
                        $('#active-identification').show();
                        $('#append_identification').html(formIdentification);
                    }else{
                        $('#active-identification').hide();
                        $('#append_identification').html('');
                    }
                }
            });

            // show contact address
            $.ajax({
                url: 'findContactByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(contact){
                    if(contact){
                        var formContact = '';
                        $.each(contact, function(key, con){
                            formContact += '<div id="removeContact">' +
                                                '<div class="form-group">'+
                                                    '<!-- country_id -->'+
                                                    '<label class="col-md-2 label-heading" for="country_id"><?php echo lang("country"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.country_name_kh+'"/>'+
                                                    '</div>'+
                                                    '<!-- province_id -->'+
                                                    '<label class="col-md-2 label-heading" for="province_id"><?php echo lang("province"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.province_name_kh+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- district_id -->'+
                                                    '<label class="col-md-2 label-heading" for="district_id"><?php echo lang("district"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.district_name_kh+'"/>'+
                                                    '</div>'+
                                                    '<!-- commune_id -->'+
                                                    '<label class="col-md-2 label-heading" for="commune_id"><?php echo lang("commune"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.commune_name_kh+'"/>'+
                                                    '</div>                            '+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- village_id -->'+
                                                    '<label class="col-md-2 label-heading" for="village_id"><?php echo lang("village"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.village_name_kh+'"/>'+
                                                    '</div>'+
                                                    '<!-- city -->'+
                                                    '<label class="col-md-2 label-heading" for="city"><?php echo lang("city"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.city+'"/>'+
                                                    '</div> '+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- house_no -->'+
                                                    '<label class="col-md-2 label-heading" for="house_no"><?php echo lang("house_no"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.house_no+'"/>'+
                                                    '</div> '+
                                                    '<!-- street -->'+
                                                    '<label class="col-md-2 label-heading" for="street"><?php echo lang("street"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.street+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- phone1 -->'+
                                                    '<label class="col-md-2 label-heading" for="phone1"><?php echo lang("phone1"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.phone1+'"/>'+
                                                    '</div> '+
                                                    '<!-- phone2 -->'+
                                                    '<label class="col-md-2 label-heading" for="phone2"><?php echo lang("phone2"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.phone2+'"/>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                    '<!-- email -->'+
                                                    '<label class="col-md-2 label-heading" for="email"><?php echo lang("email"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.email+'"/>'+
                                                    '</div> '+
                                                    '<!-- map_latitude -->'+
                                                    '<label class="col-md-2 label-heading" for="map_latitude"><?php echo lang("map_latitude"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.map_latitude+'"/>'+
                                                    '</div>                            '+
                                                '</div> '+
                                                '<div class="form-group">'+
                                                    '<!-- map_longitude -->'+
                                                    '<label class="col-md-2 label-heading" for="map_longitude"><?php echo lang("map_longitude"); ?></label>'+
                                                    '<div class="col-md-4 ui-front">'+
                                                        '<input class="form-control"  type="text" value="'+con.map_longitude+'"/>'+
                                                    '</div> '+
                                                '</div><hr>'+
                                            '</div>';
                        });
                        $('#active-contact').show();
                        $('#append_contact').html(formContact);
                    }else{
                        $('#active-contact').hide();
                        $('#append_contact').html('');
                    }
                }
            });

            // show contact address
            $.ajax({
                url: 'findEmploymentByCustomerID/'+customer_id,
                type: 'get',
                dataType: 'json',
                success: function(employment){
                    console.log(employment);
                    if(employment){
                        var formEmployment = '';
                        $.each(employment, function(key, emp){
                            var emp_type = '';
                            if(emp.employment_type == 'C'){
                                emp_type = 'Current';
                            }else{
                                emp_type = 'Previouse';
                            }
                            var self_emp = '';
                            if(emp.self_employee == 'Y'){
                                self_emp = 'YES';
                            }else{
                                self_emp = 'NO';
                            }
                            formEmployment = '<div id="removeEmployment">' +
                                                    '<div class="form-group">'+
                                                        '<!-- employment_type -->'+
                                                        '<label class="col-md-2 label-heading" for="employment_type"><?php echo lang("employment_type"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp_type+'"/>'+
                                                        '</div>'+
                                                        '<!-- self_employee -->'+
                                                        '<label class="col-md-2 label-heading" for="self_employee"><?php echo lang("self_employee"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+self_emp+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- company_name -->'+
                                                        '<label class="col-md-2 label-heading" for="company_name"><?php echo lang("company_name"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.company_name+'"/>'+
                                                        '</div> '+
                                                        '<!-- empbusiness_type_id -->'+
                                                        '<label class="col-md-2 label-heading" for="empbusiness_type_id"><?php echo lang("business_type"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<select class="form-control">'+
                                                                '<option>'+emp.business_type_name_kh+'</option>'+
                                                            '</select>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- employer_name -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_name"><?php echo lang("employer_name"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_name+'"/>'+
                                                        '</div> '+
                                                        '<!-- emp_occupation -->'+
                                                        '<label class="col-md-2 label-heading" for="emp_occupation"><?php echo lang("occupation"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.emp_occupation+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- length_of_service -->'+
                                                        '<label class="col-md-2 label-heading" for="length_of_service"><?php echo lang("length_of_service"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.length_of_service+'"/>'+
                                                        '</div> '+
                                                        '<!-- employer_address_type -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_address_type"><?php echo lang("employer_address_type"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_address_type+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- employer_id -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_id"><?php echo lang("employer_id"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_id+'"/>'+
                                                        '</div>'+
                                                        '<!-- employer_country -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_country"><?php echo lang("country"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.country_name_kh+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">     '+
                                                        '<!-- employer_province -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_province"><?php echo lang("province"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.province_name_kh+'"/>'+
                                                        '</div>                       '+
                                                        '<!-- employer_district -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_district"><?php echo lang("district"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.district_name_kh+'"/>'+
                                                        '</div>                           '+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- employer_commune -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_commune"><?php echo lang("commune"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.commune_name_kh+'"/>'+
                                                        '</div> '+
                                                        '<!-- employer_village -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_village"><?php echo lang("village"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.village_name_kh+'"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">                            '+
                                                        '<!-- employer_houseno -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_houseno"><?php echo lang("house_no"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_houseno+'"/>'+
                                                        '</div> '+
                                                        '<!-- employer_street -->'+
                                                        '<label class="col-md-2 label-heading" for="employer_street"><?php echo lang("street"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employer_street+'"/>'+
                                                        '</div>                           '+
                                                    '</div>    '+
                                                    '<div class="form-group">    '+
                                                        '<!-- employed_year -->'+
                                                        '<label class="col-md-2 label-heading" for="employed_year"><?php echo lang("employed_year"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.employed_year+'"/>'+
                                                        '</div>                          '+
                                                        '<!-- employee_currency -->'+
                                                        '<label class="col-md-2 label-heading" for="employee_currency"><?php echo lang("currency"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input class="form-control"  type="text" value="'+emp.currency_name_kh+' ('+emp.currency_code+')"/>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<!-- emplyee_salary -->'+
                                                        '<label class="col-md-2 label-heading" for="emplyee_salary"><?php echo lang("emplyee_salary"); ?></label>'+
                                                        '<div class="col-md-4 ui-front">'+
                                                            '<input id="emplyee_salary" class="form-control"  type="text" value="'+emp.emplyee_salary+'"/>'+
                                                        '</div>'+
                                                    '</div><hr>'+
                                                '</div>';
                        });
                        $('#active-employment').show();
                        $('#append_employment').html(formEmployment);
                        $('#emplyee_salary').val($('#emplyee_salary').val().replace(".00", ''));
                        $('#emplyee_salary').simpleMoneyFormat();
                    }else{
                        $('#active-employment').hide();
                        $('#append_employment').html('');
                    }
                }
            });

        }else{
            var text = '<center>Please select customer first</center>';
            // hide collateral
            $('#active-collateral').hide();
            $('#append_collateral_id').html(text);
            // hide spouse info
            $('#active-spouse').hide();
            $('#append_spouse').html(text);
            // hide identification
            $('#active-identification').hide();
            $('#append_identification').html(text);
            // hide contact
            $('#active-contact').hide();
            $('#append_contact').html(text);
        }
        
    });
    $('#currency').on('change', function(){
        $.ajax({
            url: 'getCurrnecySign/'+$(this).val(),
            type: 'get',
            success: function(output){
                $('.currencysign').html(output);
            }
        });
        
    });
    $('#set_applied_amount').simpleMoneyFormat();
    $('#set_loan_amount').simpleMoneyFormat();
    $('#set_applied_amount').on({
        keyup: function(){
            $('#applied_amount').val($(this).val().replace(",", ''));
        }
    });
    $('#set_loan_amount').on({
        keyup: function(){
            $('#loan_amount').val($(this).val().replace(",", ''));
        }
    });

    $(function () {
        $("#application_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });

    $('.select2').select2();
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>

<!-- required form -->
<script type="text/javascript">
    $(document).ready(function(){
        //  check all field input that required
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

                // check all input
                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
                // check all select option
                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""   ){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            },
            keyup: function(){
                $(this).next('span').remove();
                $('#btn-submit').prop('disabled', false);

                $("input").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });

                $("select").each(function(){
                   if ($(this).prop('required') && $(this).val() == ""){
                       $('#btn-submit').prop('disabled', true);
                       return false;
                   }
                });
            }
        });
        $('select').on('change', function(){
            $(this).next('span.text-danger').remove();
            $('#btn-submit').prop('disabled', false);
            // check all field input required
            $("input").each(function(){
               if ($(this).prop('required') && $(this).val() == ""){
                   $('#btn-submit').prop('disabled', true);
                   return false;
               }
            });
            // check all field select required
            $("select").each(function(){
                if($(this).prop('required') && $(this).val() == ''){
                    $('#btn-submit').prop('disabled', true);
                   return false;
                }
            });
        });
    });
</script>
