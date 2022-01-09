<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("view").' '.lang('loan').' '.lang('collateral'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">   
        <div class="panel-heading">
            collateral code: <b><?php echo $data->collateral_id; ?></b>
        </div>   
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="col-md-12">
                    <!-- collateral form -->
                    <div class="form-group">
                        <!-- collateral code -->
                        <input class='form-control' type="hidden" name="collateral_id" id="collateral_id" value="<?php echo (set_value('collateral_id') == false ? $data->collateral_id : set_value('collateral_id')); ?>"/>
                        <!-- customer_id -->
                        <label class="col-md-2 label-heading" for="customer_id"><?php echo lang('customer'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="customer_id" id="customer_id" required>
                                <option value="">--- select customer ---</option>
                                <?php 
                                    $customer_id = null;
                                    if(!empty($data)){
                                        $customer_id = $data->customer_id;
                                        if(set_value('customer_id') != false){
                                            $customer_id = set_value('customer_id');
                                        }
                                    }
                                ?>
                                <?php if(!empty($customers)): ?>
                                    <?php foreach($customers as $customer):?>
                                        <option value="<?php echo $customer->id?>" <?php echo ($customer_id == $customer->id ? 'selected' : ''); ?>><?php echo $customer->customer_id.' - '.$customer->firstname_kh.' '.$customer->lastname_kh;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('customer_id'); ?></span>  
                        </div>
                        <!-- asset_type -->
                        <label class="col-md-2 label-heading" for="asset_type"><?php echo lang('asset_type'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="asset_type" id="asset_type" required>
                                <option value="">--- select asset type ---</option>
                                <?php 
                                    $asset_type = null;
                                    if(!empty($data)){
                                        $asset_type = $data->asset_type;
                                        if(set_value('asset_type') != false){
                                            $asset_type = set_value('asset_type');
                                        }
                                    }
                                ?>
                                <option value="Movable Assets" <?php echo ($asset_type == 'Movable Assets' ? 'selected' : ''); ?>>Movable Assets</option>
                                <option value="Imovable Assets" <?php echo ($asset_type == 'Imovable Assets' ? 'selected' : ''); ?>>Imovable Assets</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('asset_type'); ?></span>  
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- owner_name -->
                        <label class="col-md-2 label-heading" for="owner_name"><?php echo lang('owner_name'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="owner_name" id="owner_name" value="<?php echo (set_value('owner_name') == false ? $data->owner_name : set_value('owner_name')); ?>" placeholder="<?php echo lang('owner_name'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('owner_name'); ?></span>
                        </div>
                        <!-- owner_spouse_name -->
                        <label class="col-md-2 label-heading" for="owner_spouse_name"><?php echo lang('owner_spouse_name'); ?> </label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="owner_spouse_name" id="owner_spouse_name" value="<?php echo (set_value('owner_spouse_name') == false ? $data->owner_spouse_name : set_value('owner_spouse_name')); ?>" placeholder="<?php echo lang('owner_spouse_name'); ?>"/>
                            <span class="text-danger"><?php echo form_error('owner_spouse_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- relation_id -->
                        <label class="col-md-2 label-heading" for="relation_id"><?php echo lang('relation_indicator'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="relation_id" id="relation_id" required>
                                <option value="">--- select relation indicator ---</option>
                                <?php if(!empty($relations)): ?>
                                    <?php 
                                        $relation_id = null;
                                        if(!empty($data)){
                                            $relation_id = $data->relation_id;
                                            if(set_value('relation_id') != false){
                                                $relation_id = set_value('relation_id');
                                            }
                                        }
                                    ?>
                                    <?php foreach($relations as $row):?>
                                        <option value="<?php echo $row->id?>" <?php echo ($relation_id == $row->id ? 'selected' : ''); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('relation_id'); ?></span>  
                        </div>
                        <!-- represent_type -->
                        <label class="col-md-2 label-heading" for="represent_type"><?php echo lang('represent_type'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="represent_type" id="represent_type" required>
                                <option value="">--- select represent type ---</option>
                                <?php 
                                    $represent_type = null;
                                    if(!empty($data)){
                                        $represent_type = $data->represent_type;
                                        if(set_value('represent_type') != false){
                                            $represent_type = set_value('represent_type');
                                        }
                                    }
                                ?>
                                <option value="Legal entity" <?php echo ($represent_type == 'Legal entity' ? 'selected' : ''); ?>>Legal entity</option>
                                <option value="Individual entity" <?php echo ($represent_type == 'Individual entity' ? 'selected' : ''); ?>>Individual entity</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('represent_type'); ?></span>  
                        </div>                            
                    </div>
                    <div class="form-group">
                        <!-- representor -->
                        <label class="col-md-2 label-heading" for="representor"><?php echo lang('representor'); ?> </label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="representor" id="representor" value="<?php echo (set_value('representor') == false ? $data->representor : set_value('representor')); ?>" placeholder="<?php echo lang('representor_of_collateral'); ?>" readonly/>
                            <span class="text-danger"><?php echo form_error('representor'); ?></span>
                        </div>
                        <!-- document_type -->
                        <label class="col-md-2 label-heading" for="document_type"><?php echo lang('document_type'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="document_type" id="document_type" required>
                                <option value="">--- select document type ---</option>
                                <?php 
                                    $document_type = null;
                                    if(!empty($data)){
                                        $document_type = $data->document_type;
                                        if(set_value('document_type') != false){
                                            $document_type = set_value('document_type');
                                        }
                                    }
                                ?>
                                <option value="Hypotec" <?php echo ($document_type == 'Hypotec' ? 'selected' : ''); ?>>Hypotec</option>
                                <option value="Plong" <?php echo ($document_type == 'Plong' ? 'selected' : ''); ?>>Plong</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('document_type'); ?></span> 
                        </div>                          
                    </div>
                    <div class="form-group">                            
                        <!-- size -->
                        <label class="col-md-2 label-heading" for="size"><?php echo lang('size_of_collateral'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="size" id="size" value="<?php echo (set_value('size') == false ? $data->size : set_value('size')); ?>" placeholder="<?php echo lang('size_of_collateral'); ?>"/>
                            <span class="text-danger"><?php echo form_error('size'); ?></span>
                        </div>  
                        <!-- collateral_type_id -->
                        <label class="col-md-2 label-heading" for="collateral_type_id"><?php echo lang('collateral_type_id'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="collateral_type_id" id="collateral_type_id" required>
                                <option value="">--- select collateral type ---</option>
                                <?php if(!empty($collateralTypes)): ?>
                                    <?php 
                                        $collateral_type_id = null;
                                        if(!empty($data)){
                                            $collateral_type_id = $data->collateral_type_id;
                                            if(set_value('collateral_type_id') != false){
                                                $collateral_type_id = set_value('collateral_type_id');
                                            }
                                        }
                                    ?>
                                    <?php foreach($collateralTypes as $row):?>
                                        <option value="<?php echo $row->id?>" <?php echo ($collateral_type_id == $row->id ? 'selected' : ''); ?>><?php echo $row->code.' - '.$row->name_kh;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('collateral_type_id'); ?></span> 
                        </div>                          
                    </div>
                    <div class="form-group">
                        <!-- country_id -->
                        <label class="col-md-2 label-heading" for="country_id"><?php echo lang('country'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="country_id" id="country" required>
                                <option value="">--- Select Country ---</option>
                                <?php 
                                    $country_id = null;
                                    if(!empty($data)){
                                        $country_id = $data->country_id;
                                        if(set_value('country_id') != false){
                                            $country_id = set_value('country_id');
                                        }
                                    }
                                ?>
                                <?php if(!empty($country)): ?>
                                    <?php foreach($country as $row):?>
                                        <option value="<?php echo $row->id?>" <?php echo ($country_id == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('country_id'); ?></span>  
                        </div>
                        <!-- province_id -->
                        <label class="col-md-2 label-heading" for="province_id"><?php echo lang('province'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="province_id" id="province_dropdown" required>
                                <?php 
                                    $province_id = null;
                                    if(!empty($data)){
                                        $province_id = $data->province_id;
                                        if(set_value('province_id') != false){
                                            $province_id = set_value('province_id');
                                        }
                                    }
                                ?>
                                <?php echo selectedProvince($country_id, $province_id); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('province_id'); ?></span>      
                        </div>
                    </div>
                    <div class="form-group">                            
                        <!-- district_id -->
                        <label class="col-md-2 label-heading" for="district_id"><?php echo lang('district'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="district_id" id="district_dropdown" required>
                                <?php 
                                    $district_id = null;
                                    if(!empty($data)){
                                        $district_id = $data->district_id;
                                        if(set_value('district_id') != false){
                                            $district_id = set_value('district_id');
                                        }
                                    }
                                ?>
                                <?php echo selectedDistrict($province_id, $district_id); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('district_id'); ?></span>     
                        </div>
                        <!-- commune_id -->
                        <label class="col-md-2 label-heading" for="commune_id"><?php echo lang('commune'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" id='commune_dropdown' name="commune_id" required>
                                <?php 
                                    $commune_id = null;
                                    if(!empty($data)){
                                        $commune_id = $data->commune_id;
                                        if(set_value('commune_id') != false){
                                            $commune_id = set_value('commune_id');
                                        }
                                    }
                                ?>
                                <?php echo selectedCommune($district_id, $commune_id); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('commune_id'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">
                        <!-- village_id -->
                        <label class="col-md-2 label-heading" for="village_id"><?php echo lang('village'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="village_id" id='village_dropdown' required>
                                <?php 
                                    $village_id = null;
                                    if(!empty($data)){
                                        $village_id = $data->village_id;
                                        if(set_value('village_id') != false){
                                            $village_id = set_value('village_id');
                                        }
                                    }
                                ?>
                                <?php echo selectedVillage($commune_id, $village_id); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('village_id'); ?></span>    
                        </div>
                        <!-- document_number -->
                        <label class="col-md-2 label-heading" for="document_number"><?php echo lang('document_number'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="document_number" id="document_number" value="<?php echo (set_value('document_number') == false ? $data->document_number : set_value('document_number')); ?>" placeholder="<?php echo lang('document_number'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('document_number'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">                            
                        <!-- issue_date -->
                        <label class="col-md-2 label-heading" for="issue_date"><?php echo lang('issue_date'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="issue_date" id="issue_date" value="<?php echo (set_value('issue_date') == false ? $data->issue_date : set_value('issue_date')); ?>" placeholder="<?php echo lang('issue_date'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('issue_date'); ?></span>
                        </div>
                        <!-- issue_place -->
                        <label class="col-md-2 label-heading" for="issue_place"><?php echo lang('issue_place'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="text" id='issue_place' name="issue_place" value="<?php echo (set_value('issue_place') == false ? $data->issue_place : set_value('issue_place')); ?>" placeholder="<?php echo lang('issue_place'); ?>"  required/>
                            <span class="text-danger"><?php echo form_error('issue_place'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">                            
                        <!-- issue_by -->
                        <label class="col-md-2 label-heading" for="issue_by"><?php echo lang('issue_by'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="issue_by" id="issue_by" value="<?php echo (set_value('issue_by') == false ? $data->issue_by : set_value('issue_by')); ?>" placeholder="<?php echo lang('issue_by'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('issue_by'); ?></span>
                        </div>
                        <!-- purchased_price -->
                        <label class="col-md-2 label-heading" for="purchased_price"><?php echo lang('purchased_price'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                              <input class='form-control'  type="text" id='purchased_price' name="purchased_price" value="<?php echo (set_value('purchased_price') == false ? $data->purchased_price : set_value('purchased_price')); ?>" placeholder="<?php echo lang('purchased_price'); ?>" />
                              <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">
                                <select name="currency" id="currency">
                                    <?php 
                                    $currency = null;
                                    if(!empty($data)){
                                        $currency = $data->currency;
                                        if(set_value('currency') != false){
                                            $currency = set_value('currency');
                                        }
                                    }
                                ?>
                                  <?php if(!empty(listCurrency())): ?>
                                      <?php foreach (listCurrency() as $curr): ?>
                                        <option value="<?php echo $curr->id;?>" <?php echo ($currency == $curr->id ? 'selected' : ''); ?>><?php echo $curr->currency_code; ?></option>
                                      <?php endforeach; ?>
                                  <?php endif; ?>
                                </select>
                              </div>
                            </div>                                
                            <span class="text-danger"><?php echo form_error('purchased_price'); ?></span>       
                        </div>                            
                    </div>                        
                    <div class="form-group">                            
                        <!-- valuation_price -->
                        <label class="col-md-2 label-heading" for="valuation_price"><?php echo lang('valuation_price'); ?></label>
                        <div class="col-md-4 ui-front">                                
                            <div class="input-group">
                              <input class='form-control' type="text" name="valuation_price" id="valuation_price" value="<?php echo (set_value('valuation_price') == false ? $data->valuation_price : set_value('valuation_price')); ?>" placeholder="<?php echo lang('valuation_price'); ?>"/>
                              <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span id="currencysign">USD</span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('valuation_price'); ?></span>
                        </div>
                        <!-- valuer -->
                        <label class="col-md-2 label-heading" for="valuer"><?php echo lang('valuer'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="text" id='valuer' name="valuer" value="<?php echo (set_value('valuer') == false ? $data->valuer : set_value('valuer')); ?>" placeholder="<?php echo lang('valuer'); ?>" />
                            <span class="text-danger"><?php echo form_error('valuer'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">                            
                        <!-- officer -->
                        <label class="col-md-2 label-heading" for="officer"><?php echo lang('officer'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="officer" required>
                                <option value=""> -- <?php echo lang('officer'); ?> -- </option>
                                <?php if(!empty(findOfficer())): ?>
                                    <?php 
                                        $officer = null;
                                        if(!empty($data)){
                                            $officer = $data->officer;
                                            if(set_value('officer') != false){
                                                $officer = set_value('officer');
                                            }
                                        }
                                    ?>
                                    <?php foreach (findOfficer() as $user):?>
                                        <option value="<?php echo $user->ID; ?>" <?php echo ($officer == $user->ID ? 'selected' : ''); ?>><?php echo $user->first_name . ' ' . $user->last_name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('customer_id'); ?></span> 
                        </div>
                        <!-- recieved_date -->
                        <label class="col-md-2 label-heading" for="recieved_date"><?php echo lang('recieved_date'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="recieved_date" id="recieved_date" value="<?php echo (set_value('recieved_date') == false ? $data->recieved_date : set_value('recieved_date')); ?>" placeholder="<?php echo lang('recieved_date'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('recieved_date'); ?></span>
                        </div>                                                       
                    </div>
                    <div class="form-group">  
                        <!-- recieved_by -->
                        <label class="col-md-2 label-heading" for="recieved_by"><?php echo lang('recieved_by'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="recieved_by" id="recieved_by" required>
                                <option value="">--- select user ---</option>
                                <?php if(!empty(getAllUsers())): ?>
                                    <?php 
                                        $recieved_by = null;
                                        if(!empty($data)){
                                            $recieved_by = $data->recieved_by;
                                            if(set_value('recieved_by') != false){
                                                $recieved_by = set_value('recieved_by');
                                            }
                                        }
                                    ?>
                                    <?php foreach(getAllUsers() as $row):?>
                                        <option value="<?php echo $row->ID?>" <?php echo ($recieved_by == $row->ID ? 'selected' : ''); ?>><?php echo $row->staff_id.' - '.$row->first_name.' '.$row->last_name;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('recieved_by'); ?></span>     
                        </div>                         
                        <!-- withdrawal_date -->
                        <label class="col-md-2 label-heading" for="withdrawal_date"><?php echo lang('withdrawal_date'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="text" id='withdrawal_date' name="withdrawal_date" value="<?php echo (set_value('withdrawal_date') == false ? $data->withdrawal_date : set_value('withdrawal_date')); ?>" placeholder="<?php echo lang('withdrawal_date'); ?>"  required/>
                            <span class="text-danger"><?php echo form_error('withdrawal_date'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">                            
                        <!-- withdrawal_by -->
                        <label class="col-md-2 label-heading" for="withdrawal_by"><?php echo lang('withdrawal_by'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="withdrawal_by" id="withdrawal_by" required>
                                <option value="">--- select user ---</option>
                                <?php if(!empty(getAllUsers())): ?>
                                    <?php 
                                        $withdrawal_by = null;
                                        if(!empty($data)){
                                            $withdrawal_by = $data->withdrawal_by;
                                            if(set_value('withdrawal_by') != false){
                                                $withdrawal_by = set_value('withdrawal_by');
                                            }
                                        }
                                    ?>
                                    <?php foreach(getAllUsers() as $row):?>
                                        <option value="<?php echo $row->ID?>" <?php echo ($withdrawal_by == $row->ID ? 'selected' : ''); ?>><?php echo $row->staff_id.' - '.$row->first_name.' '.$row->last_name;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('withdrawal_by'); ?></span>   
                        </div>   
                        <!-- map_latitude -->
                        <label class="col-md-2 label-heading" for="map_latitude"><?php echo lang('map_latitude'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="number" min="0" id='map_latitude' name="map_latitude" value="<?php echo (set_value('map_latitude') == false ? $data->map_latitude : set_value('map_latitude')); ?>" placeholder="<?php echo lang('map_latitude'); ?>"/>
                            <span class="text-danger"><?php echo form_error('map_latitude'); ?></span>       
                        </div>                     
                    </div>
                    <div class="form-group">
                        <!-- map_longitude -->
                        <label class="col-md-2 label-heading" for="map_longitude"><?php echo lang('map_longitude'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="number" min="0" id='map_longitude' name="map_longitude" value="<?php echo (set_value('map_longitude') == false ? $data->map_longitude : set_value('map_longitude')); ?>" placeholder="<?php echo lang('map_longitude'); ?>"/>
                            <span class="text-danger"><?php echo form_error('map_longitude'); ?></span>       
                        </div> 
                        <!--status-->
                        <div class="form-group">
                            <label for="status" class="col-md-2 label-heading">Status</label>
                            <div class="col-md-4 ui-front">
                                <select name="status" id="status" class="form-control select2" required>
                                    <?php 
                                        $status = null;
                                        if(!empty($data)){
                                            $status = $data->status;
                                            if(set_value('status') != false){
                                                $status = set_value('status');
                                            }
                                        }
                                    ?>
                                    <option value="1" <?php echo ($status == '1' ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo ($status == '0' ? 'selected' : ''); ?>>In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <!-- End  info  --> 

                    <!-- attachment fles-->
                    <?php if(!empty($attachments)): ?>
                        <legend><h4><?php echo lang("attachment").' '.lang("files"); ?></h4></legend>
                        <!-- list existing files -->                                      
                        <div class="form-group">
                         <div class="col-md-12 table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>N<sup>o</sup></th>
                                    <th>File Name</th>
                                    <th>Ext</th>
                                    <th>File Size</th>
                                    <th>File Path</th>
                                </tr>
                               <?php foreach ($attachments as $key => $attach) : ?>
                               <tr id="list_attachment_file<?php echo $key; ?>">
                                    <td><?php echo $key+1; ?></td>
                                    <td>
                                        <?php $attach_path = $attach->file_path.'/'.$attach->upload_file_name;?>
                                        <a href="<?php echo base_url().$attach_path; ?>" target="_blank"><?php echo $attach->original_name; ?></a>
                                    </td>
                                    <td><?php echo $attach->extension; ?></td>
                                    <td><?php echo $attach->file_size; ?>kb</td>
                                    <td><?php echo $attach->file_path; ?></td>
                               </tr>
                               <?php endforeach; ?>
                            </table>
                         </div>
                        </div>
                    <?php endif; ?>
                    <!-- End attachment files -->  

                    <!-- button action -->
                    <div class="text-right">
                        <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Close</a> 
                    </div>                                    
                </div>                    
            </form>
        </div>
        <div class="panel-footer"><b>created by:</b> <?php echo getUserFullName($data->created_by); ?> <b>| created at:</b> <?php echo $data->created_at; ?>
        <?php if($data->updated_by != null): ?>
            | <b>updated by:</b> <?php echo getUserFullName($data->updated_by); ?> <b>| updated at:</b> <?php echo $data->updated_at; ?> </div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();

    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>

