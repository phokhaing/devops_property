<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("view").' '.lang('customer_info'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>
    <div class="panel panel-default">   
        <div class="panel-heading">
            customer code: <b><?php echo $customer->customer_id; ?></b>
        </div>   
        <div class="panel-body">
        <?php echo form_open_multipart(site_url($link."/update?id=".(!empty($customer) ? $customer->id : '')), array("class" => "form-horizontal")) ?>
            <ul class="nav nav-tabs">
                <li class="active" id="active-customer"><a data-toggle="tab" href="#customer"><?php echo lang('customer'); ?> Info</a></li>
                <li id="active-contact"><a data-toggle="tab" href="#contact"><?php echo lang('contact'); ?></a></li>
                <li id="active-identification"><a data-toggle="tab" href="#identification"><?php echo lang('identification'); ?></a></li>
                <!-- <li><a data-toggle="tab" href="#classification"><?php// echo lang('classification'); ?></a></li> -->
                <li id="active-employment"><a data-toggle="tab" href="#employment"><?php echo lang('employment'); ?></a></li>
                <!-- <li id="active-business"><a data-toggle="tab" href="#business"><?php echo lang('business'); ?></a></li> -->
                <li id="active-incomeexpend"><a data-toggle="tab" href="#incomeexpend"><?php echo lang('income').' '.lang('expend'); ?></a></li>
                <li id="active-attachment"><a data-toggle="tab" href="#attachment"><?php echo lang('attachment'); ?></a></li>
            </ul><br>

            <div id="input-deleted">
                <!-- append form deleted here -->
                <!-- append fileDeleted -->
            </div>

            <div class="tab-content">                

                <!-- Customer info -->
                <div id="customer" class="tab-pane fade in active">
                    <div class="form-group">
                        <!-- customer code -->
                        <input class='form-control' type="hidden" name="customer_id" id="customer_id" value="<?php echo (set_value('customer_id') == false ? $customer->customer_id : set_value('customer_id')); ?>"/>
                        <!-- firstname_kh -->
                        <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang('firstname_kh'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="firstname_kh" id="firstname_kh" value="<?php echo (set_value('firstname_kh') == false ? $customer->firstname_kh : set_value('firstname_kh')); ?>" placeholder="<?php echo lang('firstname_kh'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('firstname_kh'); ?></span>
                        </div>
                        <!-- lastname_kh -->
                        <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang('lastname_kh'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="lastname_kh" id="lastname_kh" value="<?php echo (set_value('lastname_kh') == false ? $customer->lastname_kh : set_value('lastname_kh')); ?>" placeholder="<?php echo lang('lastname_kh'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('lastname_kh'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- firstname_en -->
                        <label class="col-md-2 label-heading" for="firstname_en"><?php echo lang('firstname_en'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="firstname_en" id="firstname_en" value="<?php echo (set_value('firstname_en') == false ? $customer->firstname_en : set_value('firstname_en')); ?>" placeholder="<?php echo lang('firstname_en'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('firstname_en'); ?></span>
                        </div>
                        <!-- lastname_en -->
                        <label class="col-md-2 label-heading" for="lastname_en"><?php echo lang('lastname_en'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="lastname_en" id="lastname_en" value="<?php echo (set_value('lastname_en') == false ? $customer->lastname_en : set_value('lastname_en')); ?>" placeholder="<?php echo lang('lastname_en'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('lastname_en'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo set_select('salutation'); ?>
                        <!-- salutation -->
                        <label class="col-md-2 label-heading" for="salutation"><?php echo lang('salutation'); ?></label>
                        <div class="col-md-4 ui-front">
                            <?php 
                            $salutation = null;
                            if(!empty($customer)){
                                $salutation = $customer->salutation;
                                if(set_value('salutation') != false){
                                    $salutation = set_value('salutation');
                                }
                            }?>
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="salutation" required>
                                <option value="">--- Salutation ---</option>
                                <option value="Mr" <?php echo ($salutation == 'Mr' ? 'selected' : ''); ?>>Mr</option>
                                <option value="Mrs" <?php echo ($salutation == 'Mrs' ? 'selected' : ''); ?>>Mrs</option>
                                <option value="Miss" <?php echo ($salutation == 'Miss' ? 'selected' : ''); ?>>Miss</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('salutation'); ?></span> 
                        </div>
                        <!-- gender -->
                        <label class="col-md-2 label-heading" for="gender"><?php echo lang('gender'); ?></label>
                        <div class="col-md-4 ui-front">
                            <?php 
                            $gender = null;
                            if(!empty($customer)){
                                $gender = $customer->gender;
                                if(set_value('gender') != false){
                                    $gender = set_value('gender');
                                }
                            }?>
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="gender" required>
                                <option value="">--- Gender * ---</option>
                                <option value="M" <?php echo ($gender == 'M' ? 'selected' : ''); ?>>Male</option>
                                <option value="F" <?php echo ($gender == 'F' ? 'selected' : ''); ?>>Female</option>
                                <option value="O" <?php echo ($gender == 'O' ? 'selected' : ''); ?>>Other</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('gender'); ?></span> 
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- dob -->
                        <label class="col-md-2 label-heading" for="dob"><?php echo lang('dob'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="text" name="dob" id="dob" value="<?php echo (!empty($customer) ? date('d-m-Y', strtotime($customer->dob)) : ''); ?>" placeholder="dd-mm-yyyy" required/>
                            <span class="text-danger"><?php echo form_error('dob'); ?></span>    
                        </div>
                        <!-- nationality -->
                        <label class="col-md-2 label-heading" for="nationality"><?php echo lang('nationality'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="nationality">
                                <?php if(!empty($nationality)): ?>
                                    <?php 
                                    $nation = null;
                                    if(!empty($customer)){
                                        $nation = $customer->nationality;
                                        if(set_value('nationality') != false){
                                            $nation = set_value('nationality');   
                                        }                                 
                                    }?>
                                    <?php foreach($nationality as $row):?>
                                        <option value="<?php echo $row->id;?>" <?php echo ($nation == $row->id ? 'selected' : ''); ?>><?php echo $row->name_kh?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('nationality'); ?></span>      
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- dob_country -->
                        <label class="col-md-2 label-heading" for="dob_country"><?php echo lang('country'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="dob_country" id="country" required>
                                <option value="">--- Select Country ---</option>
                                <?php $dob_country = null; 
                                if(!empty($customer)){ 
                                    $dob_country = $customer->dob_country;
                                    if(set_value('dob_country') != false){
                                        $dob_country = set_value('dob_country');   
                                    } 
                                }?>
                                <?php if(!empty($country)): ?>                                    
                                    <?php foreach($country as $row):?>
                                        <option value="<?php echo $row->id?>" <?php echo ($dob_country == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('dob_country'); ?></span>  
                        </div>
                        <!-- dob_province -->
                        <label class="col-md-2 label-heading" for="dob_province"><?php echo lang('province'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="dob_province" id="province_dropdown" required>
                                <?php $dob_province = null; 
                                if(!empty($customer)){ 
                                    $dob_province = $customer->dob_province;
                                    if(set_value('dob_province') != false){
                                        $dob_province = set_value('dob_province');   
                                    }
                                }?>
                                <?php echo selectedProvince($dob_country, $dob_province); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('dob_province'); ?></span>      
                        </div>
                    </div>
                    <div class="form-group">                            
                        <!-- dob_district -->
                        <label class="col-md-2 label-heading" for="dob_district"><?php echo lang('district'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="dob_district" id="district_dropdown" required>
                                <?php $dob_district = null; 
                                if(!empty($customer)){ 
                                    $dob_district = $customer->dob_district;
                                    if(set_value('dob_district') != false){
                                        $dob_district = set_value('dob_district');   
                                    }
                                }?>
                                <?php echo selectedDistrict($dob_province, $dob_district); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('dob_district'); ?></span>     
                        </div>
                        <!-- dob_commune -->
                        <label class="col-md-2 label-heading" for="dob_commune"><?php echo lang('commune'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" id='commune_dropdown' name="dob_commune" required>
                                <?php $dob_commune = null; 
                                if(!empty($customer)){ 
                                    $dob_commune = $customer->dob_commune;
                                    if(set_value('dob_commune') != false){
                                        $dob_commune = set_value('dob_commune');   
                                    }
                                }?>
                                <?php echo selectedCommune($dob_district, $dob_commune); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('dob_commune'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">
                        <!-- dob_village -->
                        <label class="col-md-2 label-heading" for="dob_village"><?php echo lang('village'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="dob_village" id='village_dropdown' required>
                                <?php $dob_village = null; 
                                if(!empty($customer)){ 
                                    $dob_village = $customer->dob_village;
                                    if(set_value('dob_village') != false){
                                        $dob_village = set_value('dob_village');   
                                    }
                                }?>
                                <?php echo selectedVillage($dob_commune, $dob_village); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('dob_village'); ?></span>     
                        </div>
                        <!-- marital_status -->
                        <label class="col-md-2 label-heading" for="marital_status"><?php echo lang('marital_status'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" id="marital_status" name="marital_status" required>
                                <?php $marital_status = null; 
                                if(!empty($customer)){ 
                                    $marital_status = $customer->marital_status;
                                    if(set_value('marital_status') != false){
                                        $marital_status = set_value('marital_status');   
                                    }
                                }?>
                                <option value="">--- Marital Status * ---</option>
                                <option value="S" <?php echo ($marital_status == 'S' ? 'selected' : ''); ?>>Single</option>
                                <option value="M" <?php echo ($marital_status == 'M' ? 'selected' : ''); ?>>Married</option>
                                <option value="D" <?php echo ($marital_status == 'D' ? 'selected' : ''); ?>>Divorced</option>
                                <option value="W" <?php echo ($marital_status == 'W' ? 'selected' : ''); ?>>Window</option>
                                <option value="Windower" <?php echo ($marital_status == 'Windower' ? 'selected' : ''); ?>>Windower</option>
                                <option value="Separated" <?php echo ($marital_status == 'Separated' ? 'selected' : ''); ?>>Separated</option>
                                <option value="Defacto" <?php echo ($marital_status == 'Defacto' ? 'selected' : ''); ?>>Defacto</option>
                                <option value="U" <?php echo ($marital_status == 'U' ? 'selected' : ''); ?>>Unknown</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('marital_status'); ?></span>        
                        </div>
                    </div>
                    <div class="form-group">                            
                        <!-- house_ownership -->
                        <label class="col-md-2 label-heading" for="house_ownership"><?php echo lang('house_ownership'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="house_ownership" required>
                                <?php $house_ownership = null; 
                                if(!empty($customer)){ 
                                    $house_ownership = $customer->house_ownership;
                                    if(set_value('house_ownership') != false){
                                        $house_ownership = set_value('house_ownership');   
                                    }
                                }?>
                                <option value="">--- House Owndership ---</option>
                                <option value="Owner" <?php echo ($house_ownership == 'Owner' ? 'selected' : ''); ?>>Owner</option>
                                <option value="Family" <?php echo ($house_ownership == 'Family' ? 'selected' : ''); ?>>Family</option>
                                <option value="Sibling" <?php echo ($house_ownership == 'Sibling' ? 'selected' : ''); ?>>Sibling</option>
                                <option value="Other Relative" <?php echo ($house_ownership == 'Other Relative' ? 'selected' : ''); ?>>Other Relative</option>
                                <option value="Friend" <?php echo ($house_ownership == 'Friend' ? 'selected' : ''); ?>>Friend</option>
                                <option value="Rental" <?php echo ($house_ownership == 'Rental' ? 'selected' : ''); ?>>Rental</option>
                                <option value="Other" <?php echo ($house_ownership == 'Other' ? 'selected' : ''); ?>>Other</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('house_ownership'); ?></span>       
                        </div>
                        <!-- family_member -->
                        <label class="col-md-2 label-heading" for="family_member"><?php echo lang('family_member'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="number" min="1" id='family_member' name="family_member" value="<?php echo (set_value('family_member') == false ? $customer->family_member : set_value('family_member')); ?>" placeholder="<?php echo lang('family_member'); ?>"  required/>
                            <span class="text-danger"><?php echo form_error('family_member'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">
                        <!-- active_member -->
                        <label class="col-md-2 label-heading" for="active_member"><?php echo lang('active_member'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="number" min="1" name="active_member" value="<?php echo (set_value('active_member') == false ? $customer->active_member : set_value('active_member')); ?>" placeholder="<?php echo lang('active_member'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('active_member'); ?></span>        
                        </div>
                        <!-- resident -->
                        <label class="col-md-2 label-heading" for="resident"><?php echo lang('resident'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="resident">
                                <?php $resident = null; 
                                if(!empty($customer)){ 
                                    $resident = $customer->resident;
                                    if(set_value('resident') != false){
                                        $resident = set_value('resident');
                                    }
                                }?>
                                <option value="RESID" <?php echo ($resident == 'RESID' ? 'selected' : ''); ?>>Resident</option>
                                <option value="NO" <?php echo ($resident == 'NO' ? 'selected' : ''); ?>>NO</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('resident'); ?></span>       
                        </div>
                    </div>
                    <div class="form-group"> 
                        <!-- sector -->
                        <label class="col-md-2 label-heading" for="sector"><?php echo lang('sector'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' onchange="selectSector()" data-live-search="true" id="sector" name="sector" required>
                                <?php $sec = null; 
                                if(!empty($customer)){ 
                                    $sec = $customer->sector;
                                    if(set_value('sector') != false){
                                        $sec = set_value('sector');
                                    }
                                }?>
                                <option value="">--- select sector ---</option>
                                <?php if(!empty($sector)): ?>
                                    <?php foreach($sector as $row):?>
                                        <option value="<?php echo $row->id;?>" <?php echo ($sec == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('sector'); ?></span>     
                        </div>
                        <!-- industry -->
                        <label class="col-md-2 label-heading" for="industry"><?php echo lang('industry'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" id="industry" name="industry" required>
                                <?php $industry = null; 
                                if(!empty($customer)){ 
                                    $industry = $customer->industry;
                                    if(set_value('industry') != false){
                                        $industry = set_value('industry');
                                    }
                                }?>
                                <?php echo selectedIndustry($sec, $industry); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('industry'); ?></span>     
                        </div>
                    </div>
                    <!-- <div class="form-group"> -->
                        <!-- account_member -->
                        <!-- <label class="col-md-2 label-heading" for="account_member"><?php// echo lang('account_member'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' onchange="selectaccount_member()" data-live-search="true" id="account_member" name="account_member">
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                            <span class="text-danger"><?php// echo form_error('account_member'); ?></span>     
                        </div> -->
                        <!-- customer_type -->
                        <!-- <label class="col-md-2 label-heading" for="customer_type"><?php// echo lang('customer_type'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" id="customer_type" name="customer_type">
                                <option value="">--- select customer type ---</option>
                            </select>
                            <span class="text-danger"><?php// echo form_error('customer_type'); ?></span>     
                        </div>
                    </div> -->
                    <div class="form-group">                            
                        <!-- guarantor -->
                        <label class="col-md-2 label-heading" for="guarantor"><?php echo lang('guarantor'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="guarantor" required>
                                <?php $guarantor = null; 
                                if(!empty($customer)){ 
                                    $guarantor = $customer->guarantor;
                                    if(set_value('guarantor') != false){
                                        $guarantor = set_value('guarantor');
                                    }
                                }?>
                                <option value="">--- As Guarantor ---</option>
                                <option value="YES" <?php echo ($guarantor == 'YES' ? 'selected' : ''); ?>>YES</option>
                                <option value="NO" <?php echo ($guarantor == 'NO' ? 'selected' : ''); ?>>NO</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('guarantor'); ?></span>       
                        </div>
                        <!-- officer -->
                        <label class="col-md-2 label-heading" for="officer"><?php echo lang('officer'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="officer" required>
                                <option value=""> -- <?php echo lang('officer'); ?> -- </option>
                                <?php $officer = null; 
                                if(!empty($customer)){ 
                                    $officer = $customer->officer;
                                    if(set_value('officer') != false){
                                        $officer = set_value('officer');
                                    }
                                }?>
                                <?php if(!empty(getAllUsers())): ?>
                                    <?php foreach (getAllUsers() as $user):?>
                                        <option value="<?php echo $user->ID; ?>" <?php echo ($officer == $user->ID ? 'selected' : ''); ?>><?php echo $user->staff_id.' - '.$user->first_name . ' ' . $user->last_name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('officer'); ?></span>         
                        </div>
                    </div>


                    <!-- spouse info -->
                    <input class="form-control" type="hidden" name="spouse_id" id="spouse_id" value="<?php echo (!empty($spouse) ? $spouse->spouse_id : ""); ?>"/>
                    <fieldset id="spouse-info">
                        <?php if(!empty($spouse) || set_value('spouse_firstname_kh') == true): ?>
                            <legend>Spouse Info</legend>
                            <div class="form-group">
                                <!-- spouse_firstname_kh -->
                                    <label class="col-md-2 label-heading" for="spouse_firstname_kh"><?php echo lang("firstname_kh"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class="form-control" type="text" name="spouse_firstname_kh" id="spouse_firstname_kh" value="<?php echo (set_value('spouse_firstname_kh') == false ? (!empty($spouse) ? $spouse->spouse_firstname_kh : '') : set_value('spouse_firstname_kh')); ?>" placeholder="<?php echo lang("firstname_kh"); ?>" required/>
                                        <span class="text-danger"><?php echo form_error("spouse_firstname_kh"); ?></span>
                                    </div>
                                    <!-- spouse_lastname_kh -->
                                    <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang("lastname_kh"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class="form-control" type="text" name="spouse_lastname_kh" id="spouse_lastname_kh" value="<?php echo (set_value('spouse_lastname_kh') == false ? (!empty($spouse) ? $spouse->spouse_lastname_kh : "") : set_value('spouse_lastname_kh')); ?>" placeholder="<?php echo lang("lastname_kh"); ?>" required/>
                                        <span class="text-danger"><?php echo form_error("spouse_lastname_kh"); ?></span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <!-- spouse_firstname_en -->
                                <label class="col-md-2 label-heading" for="spouse_firstname_en"><?php echo lang("firstname_en"); ?></label>
                                <div class="col-md-4 ui-front">
                                    <input class="form-control" type="text" name="spouse_firstname_en" id="spouse_firstname_en" value="<?php echo (set_value('spouse_firstname_en') == false ? (!empty($spouse) ? $spouse->spouse_firstname_en : "") : set_value('spouse_firstname_en')); ?>" placeholder="<?php echo lang("firstname_en"); ?>" required/>
                                    <span class="text-danger"><?php echo form_error("spouse_firstname_en"); ?></span>
                                </div>
                                <!-- spouse_lastname_en -->
                                <label class="col-md-2 label-heading" for="spouse_lastname_en"><?php echo lang("lastname_en"); ?></label>
                                <div class="col-md-4 ui-front">
                                    <input class="form-control" type="text" name="spouse_lastname_en" id="spouse_lastname_en" value="<?php echo (set_value('spouse_lastname_en') == false ? (!empty($spouse) ? $spouse->spouse_lastname_en : "") : set_value('spouse_lastname_en')); ?>" placeholder="<?php echo lang("lastname_en"); ?>" required/>
                                    <span class="text-danger"><?php echo form_error("spouse_lastname_en"); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- spouse_dob -->
                                <label class="col-md-2 label-heading" for="spouse_dob"><?php echo lang("dob"); ?></label>
                                <div class="col-md-4 ui-front">                                    
                                    <input class="form-control"  type="text" name="spouse_dob" id="spouse_dob" value="<?php echo (set_value('spouse_dob') == false ? (!empty($spouse) ? date('d-m-Y', strtotime($spouse->spouse_dob)) : "") : set_value('spouse_dob')); ?>" placeholder="dd-mm-yyyy" required/>
                                    <span class="text-danger"><?php echo form_error("spouse_dob"); ?></span>    
                                </div>
                                <!-- spouse_nationality -->
                                <label class="col-md-2 label-heading" for="spouse_nationality"><?php echo lang("nationality"); ?></label>
                                <div class="col-md-4 ui-front">
                                    <select class="form-control select2" style="width:100%" data-live-search="true" name="spouse_nationality">
                                        <?php $spouse_nationality = null; 
                                        if(!empty($spouse)){ 
                                            $spouse_nationality = (!empty($spouse) ? $spouse->spouse_nationality : "");
                                            if(set_value('spouse_nationality') != false){
                                                $spouse_nationality = set_value('spouse_nationality');
                                            }
                                        }?>
                                        <?php if(!empty($nationality)): ?>
                                            <?php foreach($nationality as $row):?>
                                                <option value="<?php echo $row->id;?>" <?php echo ($spouse_nationality == $row->id ? 'selected' : ""); ?>><?php echo $row->name_kh?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error("nationality"); ?></span>      
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- spouse_occupation -->
                                <label class="col-md-2 label-heading" for="spouse_occupation"><?php echo lang("occupation"); ?></label>
                                <div class="col-md-4 ui-front">
                                    <input class="form-control"  type="text" name="spouse_occupation" id="spouse_occupation" value="<?php echo (set_value('spouse_occupation') == false ? (!empty($spouse) ? $spouse->spouse_occupation : "") : set_value('spouse_occupation')); ?>" placeholder="<?php echo lang("occupation"); ?>" required/>
                                    <span class="text-danger"><?php echo form_error("spouse_occupation"); ?></span>    
                                </div>
                                <!-- spouse_id_type -->
                                <label class="col-md-2 label-heading" for="spouse_id_type"><?php echo lang("id_type"); ?></label>
                                <div class="col-md-4 ui-front">
                                    <select class="form-control select2" style="width:100%" data-live-search="true" id="spouse_id_type" name="spouse_id_type">
                                        <?php 
                                            $spouse_id_type = (!empty($spouse) ? $spouse->spouse_id_type : "");
                                            if(set_value('spouse_id_type') != false){
                                                $spouse_id_type = set_value('spouse_id_type');
                                            }
                                        ?>
                                        <option value="">--- select id type ---</option>
                                        <?php if(!empty($identificationType)): ?>
                                            <?php foreach($identificationType as $row):?>
                                                <option value="<?php echo $row->id;?>" <?php echo ($spouse_id_type == $row->id ? 'selected' : ""); ?>><?php echo $row->name_en?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error("spouse_id_type"); ?></span>     
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- spouse_id_code -->
                                <label class="col-md-2 label-heading" for="spouse_id_code"><?php echo lang("id_code"); ?></label>
                                <div class="col-md-4 ui-front">
                                    <input class="form-control"  type="text" id="spouse_id_code" name="spouse_id_code" value="<?php echo (set_value('spouse_id_code') == false ? (!empty($spouse) ? $spouse->spouse_id_code : "") : set_value('spouse_id_code')); ?>" placeholder="<?php echo lang("id_code"); ?>" required/>
                                    <span class="text-danger"><?php echo form_error("spouse_id_code"); ?></span>       
                                </div> 
                                <!-- spouse_issue_date -->
                                <label class="col-md-2 label-heading" for="spouse_issue_date"><?php echo lang("issue_date"); ?></label>
                                <div class="col-md-4 ui-front">                                    
                                    <input class="form-control"  type="text" id="spouse_issue_date" name="spouse_issue_date" value="<?php echo (set_value('spouse_issue_date') == false ? (!empty($spouse) ? date('d-m-Y', strtotime($spouse->spouse_issue_date)) : "") : set_value('spouse_issue_date')); ?>" placeholder="dd-mm-yyyy" required/>
                                    <span class="text-danger"><?php echo form_error("spouse_issue_date"); ?></span>       
                                </div> 
                            </div>
                        <?php endif; ?>
                    </fieldset>
                    <!-- end spouse info -->
                </div>
                <!-- End Customer info  -->  

                <!-- Contact Address -->
                <div id="contact" class="tab-pane fade">
                    <input type="hidden" id="contact_deleted" name="contact_deleted" value="<?php echo set_value('contact_deleted'); ?>">
                    <?php if(isset($contacts) && !empty($contacts) && set_value('country_id[0]') == false):
                        foreach ($contacts as $key => $contact): 
                            if(set_value('contact_id['.$key.']') == false){
                                $contact_id = $contact->contact_id;
                            }else{
                                $contact_id = set_value('contact_id['.$key.']');
                            }
                            if($key > 0){echo '<div id="removeContact'.$key.'"><hr>'; } ?>

                                <input type="hidden" name="contact_id[]" value="<?php echo $contact_id; ?>">
                                <div class="form-group">
                                    <!-- country_id -->
                                    <label class="col-md-2 label-heading" for="country_id<?php echo $key; ?>"><?php echo lang('country'); ?></label>
                                    <div class="col-md-4 ui-front">                                        
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectCountry('<?php echo $key; ?>')" name="country_id[]" id="country_id<?php echo $key; ?>" required>
                                            <option value="">--- Select Country ---</option>  
                                            <?php 
                                                $country_id = $contact->country_id;
                                                if(set_value('country_id['.$key.']') != false){
                                                    $country_id = set_value('country_id['.$key.']');
                                                }
                                             ?>                                          
                                            <?php if(!empty($country)): ?>
                                                <?php foreach($country as $row):?>
                                                    <option value="<?php echo $row->id?>" <?php echo ($country_id == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('country_id[]'); ?></span>  
                                    </div>
                                    <!-- <?php// var_dump(set_value('province_id[0]'));die(); ?> -->
                                    <!-- province_id -->
                                    <label class="col-md-2 label-heading" for="province_id<?php echo $key; ?>"><?php echo lang('province'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectProvince('<?php echo $key; ?>')" name="province_id[]" id="province_id<?php echo $key; ?>" required>
                                            <?php 
                                                $province_id = $contact->province_id;
                                                if(set_value('province_id['.$key.']') != false){
                                                    $province_id = set_value('province_id['.$key.']');
                                                }
                                             ?> 
                                            <?php echo selectedProvince($country_id, $province_id); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('province_id['.$key.']'); ?></span>      
                                    </div>
                                </div>
                                <div class="form-group">                            
                                    <!-- district_id -->
                                    <label class="col-md-2 label-heading" for="district_id<?php echo $key; ?>"><?php echo lang('district'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectDistrict('<?php echo $key; ?>')" name="district_id[]" id="district_id<?php echo $key; ?>" required>
                                            <?php 
                                                $district_id = $contact->district_id;
                                                if(set_value('district_id['.$key.']') != false){
                                                    $district_id = set_value('district_id['.$key.']');
                                                }
                                             ?> 
                                            <?php echo selectedDistrict($province_id, $district_id); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('district_id['.$key.']'); ?></span>     
                                    </div>
                                    <!-- commune_id -->
                                    <label class="col-md-2 label-heading" for="commune_id<?php echo $key; ?>"><?php echo lang('commune'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectCommune('<?php echo $key; ?>')" id='commune_id<?php echo $key; ?>' name="commune_id[]" required>
                                            <?php 
                                                $commune_id = $contact->commune_id;
                                                if(set_value('commune_id['.$key.']') != false){
                                                    $commune_id = set_value('commune_id['.$key.']');
                                                }
                                             ?> 
                                            <?php echo selectedCommune($district_id, $commune_id); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('commune_id['.$key.']'); ?></span>       
                                    </div>                            
                                </div>
                                <div class="form-group">
                                    <!-- village_id -->
                                    <label class="col-md-2 label-heading" for="village_id<?php echo $key; ?>"><?php echo lang('village'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="village_id[]" id='village_id<?php echo $key; ?>' required>
                                            <?php 
                                                $village_id = $contact->village_id;
                                                if(set_value('village_id['.$key.']') != false){
                                                    $village_id = set_value('village_id['.$key.']');
                                                }
                                             ?>
                                            <?php echo selectedVillage($commune_id, $village_id); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('village_id['.$key.']'); ?></span>     
                                    </div>
                                    <!-- city -->
                                    <label class="col-md-2 label-heading" for="city<?php echo $key; ?>"><?php echo lang('city'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='city<?php echo $key; ?>' name="city[]" value="<?php echo set_value('city['.$key.']') == false ? $contact->city : set_value('city['.$key.']'); ?>" placeholder="<?php echo lang('city'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('city['.$key.']'); ?></span>       
                                    </div> 
                                </div>
                                <div class="form-group">                            
                                    <!-- house_no -->
                                    <label class="col-md-2 label-heading" for="house_no<?php echo $key; ?>"><?php echo lang('house_no'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='house_no<?php echo $key; ?>' name="house_no[]" value="<?php echo (set_value('house_no['.$key.']') == false ? $contact->house_no : set_value('house_no['.$key.']')); ?>" placeholder="<?php echo lang('house_no'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('house_no['.$key.']'); ?></span>       
                                    </div> 

                                    <!-- street -->
                                    <label class="col-md-2 label-heading" for="street"><?php echo lang('street'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='street<?php echo $key; ?>' name="street[]" value="<?php echo (set_value('street['.$key.']') == false ? $contact->street : set_value('street['.$key.']')); ?>" placeholder="<?php echo lang('street'); ?>"  required/>
                                        <span class="text-danger"><?php echo form_error('street['.$key.']'); ?></span>       
                                    </div>                            
                                </div>    
                                <div class="form-group">                            
                                    <!-- phone1 -->
                                    <label class="col-md-2 label-heading" for="phone1<?php echo $key; ?>"><?php echo lang('phone1'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='phone1<?php echo $key; ?>' name="phone1[]" value="<?php echo (set_value('phone1['.$key.']') == false ? $contact->phone1 : set_value('phone1['.$key.']')); ?>" placeholder="0123456789"  required/>
                                        <span class="text-danger"><?php echo form_error('phone1['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- phone2 -->
                                    <label class="col-md-2 label-heading" for="phone2<?php echo $key; ?>"><?php echo lang('phone2'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" min="1" id='phone2<?php echo $key; ?>' name="phone2[]" value="<?php echo (set_value('phone2['.$key.']') == false ? $contact->phone2 : set_value('phone2['.$key.']')); ?>" placeholder="0123456789"/>
                                        <span class="text-danger"><?php echo form_error('phone2['.$key.']'); ?></span>       
                                    </div>                            
                                </div>   
                                <div class="form-group">                            
                                    <!-- email -->
                                    <label class="col-md-2 label-heading" for="email<?php echo $key; ?>"><?php echo lang('email'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="email" id='email<?php echo $key; ?>' name="email[]" value="<?php echo (set_value('email['.$key.']') == false ? $contact->email : set_value('email['.$key.']')); ?>" placeholder="example@gmail.com"  required/>
                                        <span class="text-danger"><?php echo form_error('email['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- map_latitude -->
                                    <label class="col-md-2 label-heading" for="map_latitude<?php echo $key; ?>"><?php echo lang('map_latitude'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" min="1" id='map_latitude<?php echo $key; ?>' name="map_latitude[]" value="<?php echo (set_value('map_latitude['.$key.']') == false ? $contact->map_latitude : set_value('map_latitude['.$key.']')); ?>" placeholder="<?php echo lang('map_latitude'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('map_latitude['.$key.']'); ?></span>       
                                    </div>                            
                                </div> 
                                <div class="form-group"> 
                                    <!-- map_longitude -->
                                    <label class="col-md-2 label-heading" for="map_longitude<?php echo $key; ?>"><?php echo lang('map_longitude'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" min="1" id='map_longitude<?php echo $key; ?>' name="map_longitude[]" value="<?php echo (set_value('map_longitude['.$key.']') == false ? $contact->map_longitude : set_value('map_longitude['.$key.']')); ?>" placeholder="<?php echo lang('map_longitude'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('map_longitude['.$key.']'); ?></span>       
                                    </div>                                     
                                    <label for="function" class="col-md-3 label-heading">
                                        <?php if($key > 0):?>
                                        <!-- button add form -->
                                        <a href="javascript:void(0)" title="Remove Form" onclick="removeContact('<?php echo $key;?>','<?php echo $contact_id;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                        <?php endif; ?>
                                        <!-- button remove form -->
                                        <a href="javascript:void(0)" title="Add Form" onclick="addContact();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                    </label>
                                    <div class="col-md-4 ui-front" >
                                    </div> 
                                </div>
                            <?php if($key > 0){echo '</div>'; }
                        endforeach;
                    else:   

                        // if validation form error
                        if($this->input->post('house_no')):
                            for ($i=0; $i < count($this->input->post('house_no')); $i++):
                                $contact_id = set_value('contact_id['.$i.']');
                                if($i > 0){echo '<div id="removeContact'.$i.'"><hr>'; } ?>

                                    <input type="hidden" name="contact_id[]" value="<?php echo $contact_id; ?>">
                                    <div class="form-group">
                                        <!-- country_id -->
                                        <label class="col-md-2 label-heading" for="country_id<?php echo $i; ?>"><?php echo lang('country'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectCountry('<?php echo $i; ?>')" name="country_id[]" id="country_id<?php echo $i; ?>" required>
                                                <option value="">--- Select Country ---</option>
                                                <?php if(!empty($country)): ?>
                                                    <?php foreach($country as $row):?>
                                                        <option value="<?php echo $row->id?>" <?php echo (set_value('country_id['.$i.']') == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('country_id[]'); ?></span>  
                                        </div>
                                        <!-- <?php// var_dump(set_value('province_id[0]'));die(); ?> -->
                                        <!-- province_id -->
                                        <label class="col-md-2 label-heading" for="province_id<?php echo $i; ?>"><?php echo lang('province'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectProvince('<?php echo $i; ?>')" name="province_id[]" id="province_id<?php echo $i; ?>" required>
                                                <?php echo selectedProvince(set_value('country_id['.$i.']'), set_value('province_id['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('province_id['.$i.']'); ?></span>      
                                        </div>
                                    </div>
                                    <div class="form-group">                            
                                        <!-- district_id -->
                                        <label class="col-md-2 label-heading" for="district_id<?php echo $i; ?>"><?php echo lang('district'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectDistrict('<?php echo $i; ?>')" name="district_id[]" id="district_id<?php echo $i; ?>" required>
                                                <?php echo selectedDistrict(set_value('province_id['.$i.']'), set_value('district_id['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('district_id['.$i.']'); ?></span>     
                                        </div>
                                        <!-- commune_id -->
                                        <label class="col-md-2 label-heading" for="commune_id<?php echo $i; ?>"><?php echo lang('commune'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectCommune('<?php echo $i; ?>')" id='commune_id<?php echo $i; ?>' name="commune_id[]" required>
                                                <?php echo selectedCommune(set_value('district_id['.$i.']'), set_value('commune_id['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('commune_id['.$i.']'); ?></span>       
                                        </div>                            
                                    </div>
                                    <div class="form-group">
                                        <!-- village_id -->
                                        <label class="col-md-2 label-heading" for="village_id<?php echo $i; ?>"><?php echo lang('village'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" name="village_id[]" id='village_id<?php echo $i; ?>' required>
                                                <?php echo selectedVillage(set_value('commune_id['.$i.']'), set_value('village_id['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('village_id['.$i.']'); ?></span>     
                                        </div>
                                        <!-- city -->
                                        <label class="col-md-2 label-heading" for="city<?php echo $i; ?>"><?php echo lang('city'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='city<?php echo $i; ?>' name="city[]" value="<?php echo set_value('city['.$i.']'); ?>" placeholder="<?php echo lang('city'); ?>"/>
                                            <span class="text-danger"><?php echo form_error('city['.$i.']'); ?></span>       
                                        </div> 
                                    </div>
                                    <div class="form-group">                            
                                        <!-- house_no -->
                                        <label class="col-md-2 label-heading" for="house_no<?php echo $i; ?>"><?php echo lang('house_no'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='house_no<?php echo $i; ?>' name="house_no[]" value="<?php echo set_value('house_no['.$i.']'); ?>" placeholder="<?php echo lang('house_no'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('house_no['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- street -->
                                        <label class="col-md-2 label-heading" for="street"><?php echo lang('street'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='street<?php echo $i; ?>' name="street[]" value="<?php echo set_value('street['.$i.']'); ?>" placeholder="<?php echo lang('street'); ?>"  required/>
                                            <span class="text-danger"><?php echo form_error('street['.$i.']'); ?></span>       
                                        </div>                            
                                    </div>    
                                    <div class="form-group">                            
                                        <!-- phone1 -->
                                        <label class="col-md-2 label-heading" for="phone1<?php echo $i; ?>"><?php echo lang('phone1'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='phone1<?php echo $i; ?>' name="phone1[]" value="<?php echo set_value('phone1['.$i.']'); ?>" placeholder="0123456789"  required/>
                                            <span class="text-danger"><?php echo form_error('phone1['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- phone2 -->
                                        <label class="col-md-2 label-heading" for="phone2<?php echo $i; ?>"><?php echo lang('phone2'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="number" min="1" id='phone2<?php echo $i; ?>' name="phone2[]" value="<?php echo set_value('phone2['.$i.']'); ?>" placeholder="0123456789"/>
                                            <span class="text-danger"><?php echo form_error('phone2['.$i.']'); ?></span>       
                                        </div>                            
                                    </div>   
                                    <div class="form-group">                            
                                        <!-- email -->
                                        <label class="col-md-2 label-heading" for="email<?php echo $i; ?>"><?php echo lang('email'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="email" id='email<?php echo $i; ?>' name="email[]" value="<?php echo set_value('email['.$i.']'); ?>" placeholder="example@gmail.com"  required/>
                                            <span class="text-danger"><?php echo form_error('email['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- map_latitude -->
                                        <label class="col-md-2 label-heading" for="map_latitude<?php echo $i; ?>"><?php echo lang('map_latitude'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="number" min="1" id='map_latitude<?php echo $i; ?>' name="map_latitude[]" value="<?php echo set_value('map_latitude['.$i.']'); ?>" placeholder="<?php echo lang('map_latitude'); ?>"/>
                                            <span class="text-danger"><?php echo form_error('map_latitude['.$i.']'); ?></span>       
                                        </div>                            
                                    </div> 
                                    <div class="form-group"> 
                                        <!-- map_longitude -->
                                        <label class="col-md-2 label-heading" for="map_longitude<?php echo $i; ?>"><?php echo lang('map_longitude'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="number" min="1" id='map_longitude<?php echo $i; ?>' name="map_longitude[]" value="<?php echo set_value('map_longitude['.$i.']'); ?>" placeholder="<?php echo lang('map_longitude'); ?>"/>
                                            <span class="text-danger"><?php echo form_error('map_longitude['.$i.']'); ?></span>       
                                        </div>                                     
                                        <label for="function" class="col-md-3 label-heading">
                                            <?php if($i > 0): ?>
                                            <!-- button remove form -->
                                            <a href="javascript:void(0)" title="Remove Form" onclick="removeContact('<?php echo $i;?>','<?php echo $contact_id; ?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                            <?php endif; ?> 
                                            <!-- button add form -->
                                            <a href="javascript:void(0)" title="Add Form" onclick="addContact();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                        </label>
                                        <div class="col-md-4 ui-front" >
                                        </div>                                                              
                                    </div>
                                <?php if($i > 0){echo '</div>'; }
                            endfor;
                        endif;
                    endif;?>
                    <!-- end append set_value -->
                    <!-- append main app to here -->
                    <div class="append-contact"></div>         
                </div>
                <!-- end contact address --> 

                <!-- identification document -->
                <div id="identification" class="tab-pane fade">
                    <input type="hidden" id="identification_deleted" name="identification_deleted" value="<?php echo set_value('identification_deleted'); ?>">

                    <?php if(isset($identifications) && !empty($identifications) && set_value('identification_type[0]') == false):
                        foreach ($identifications as $key => $iden): ?>
                            <?php if($key > 0){echo '<div id="removeIdentification'.$key.'"><hr>'; } ?>
                                <?php 
                                    if(set_value('identification_id['.$key.']') == false){
                                        $identification_id = $iden->identification_id;
                                    }else{
                                        $identification_id = set_value('identification_id['.$key.']');
                                    } ?>

                                <input type="hidden" name="identification_id[]" value="<?php echo $identification_id; ?>">
                                <div class="form-group">
                                    <!-- identification_type -->
                                    <label class="col-md-2 label-heading" for="identification_type"><?php echo lang('id_type'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" id="identification_type" name="identification_type[]" required>
                                            <option value="">--- select id type ---</option>
                                            <?php 
                                                $identification_type = $iden->identification_type;
                                                if(set_value('identification_type['.$key.']') != false){
                                                    $identification_type = set_value('identification_type['.$key.']');
                                                }
                                             ?> 
                                            <?php if(!empty($identificationType)): ?>
                                                <?php foreach($identificationType as $row):?>
                                                    <option value="<?php echo $row->id;?>" <?php echo ($identification_type == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('identification_type['.$key.']'); ?></span>     
                                    </div>
                                    <!-- identification_code -->
                                    <label class="col-md-2 label-heading" for="identification_code"><?php echo lang('id_code'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='identification_code' name="identification_code[]" value="<?php echo set_value('identification_code['.$key.']') == false ? $iden->identification_code : set_value('identification_code['.$key.']'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('identification_code['.$key.']'); ?></span>       
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <!-- identification_issue_place -->
                                    <label class="col-md-2 label-heading" for="identification_issue_place"><?php echo lang('issue_place'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='identification_issue_place' name="identification_issue_place[]" value="<?php echo set_value('identification_issue_place['.$key.']') == false ? $iden->identification_issue_place : set_value('identification_issue_place['.$key.']'); ?>" placeholder="<?php echo lang('issue_place'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('identification_issue_place['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- identification_issue_date -->
                                    <label class="col-md-2 label-heading" for="identification_issue_date"><?php echo lang('issue_date'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control' type="text" id='identification_issue_date' name="identification_issue_date[]" value="<?php echo set_value('identification_issue_date['.$key.']') == false ? date('d-m-Y', strtotime($iden->identification_issue_date)) : set_value('identification_issue_date['.$key.']'); ?>" placeholder="dd-mm-yyyy" required/>
                                        <span class="text-danger"><?php echo form_error('identification_issue_date['.$key.']'); ?></span>       
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <!-- identification_expiry_date -->
                                    <label class="col-md-2 label-heading" for="identification_expiry_date"><?php echo lang('expiry_date'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='identification_expiry_date' name="identification_expiry_date[]" value="<?php echo set_value('identification_expiry_date['.$key.']') == false ? $iden->identification_expiry_date : set_value('identification_expiry_date['.$key.']'); ?>" placeholder="dd-mm-yyyy" required/>
                                        <span class="text-danger"><?php echo form_error('identification_expiry_date['.$key.']'); ?></span>       
                                    </div>   
                                    <!-- button add form -->
                                    <label class="col-md-2 label-heading" for="" id="addIdentification">
                                        <?php if($key > 0):?>
                                        <!-- button add form -->
                                        <a href="javascript:void(0)" title="Remove Form" onclick="removeIdentification('<?php echo $key;?>','<?php echo $identification_id;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                        <?php endif; ?>
                                        <a href="javascript:void(0)" title="Add Form" onclick="addIdentification();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                    </label>
                                    <div class="col-md-4 ui-front" >
                                    </div>  
                                </div>
                            <?php if($key > 0){echo '</div>';}
                        endforeach;
                    else: 

                        // append set_value   
                        if($this->input->post('identification_type')):                      
                            for ($i=0; $i < count($this->input->post('identification_type')); $i++):
                                $identification_id = set_value('identification_id['.$i.']');
                                if($i > 0){ echo '<div id="removeIdentification'.$i.'"><hr>';} ?>

                                    <input type="hidden" name="identification_id[]" value="<?php echo $identification_id; ?>">
                                    <div class="form-group">
                                        <!-- identification_type -->
                                        <label class="col-md-2 label-heading" for="identification_type<?php echo $i; ?>"><?php echo lang('id_type'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" id="identification_type<?php echo $i; ?>" name="identification_type[]" required>
                                                <option value="">--- select id type ---</option>
                                                <?php if(!empty($identificationType)): ?>
                                                    <?php foreach($identificationType as $row):?>
                                                        <option value="<?php echo $row->id;?>" <?php echo set_select('identification_type['.$i.']', $row->id); ?>><?php echo $row->name_en?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('identification_type['.$i.']'); ?></span>     
                                        </div>
                                        <!-- identification_code -->
                                        <label class="col-md-2 label-heading" for="identification_code<?php echo $i; ?>"><?php echo lang('id_code'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='identification_code<?php echo $i; ?>' name="identification_code[]" value="<?php echo set_value('identification_code['.$i.']'); ?>" placeholder="<?php echo lang('id_code'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('identification_code['.$i.']'); ?></span>       
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <!-- identification_issue_place -->
                                        <label class="col-md-2 label-heading" for="identification_issue_place<?php echo $i; ?>"><?php echo lang('issue_place'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='identification_issue_place<?php echo $i; ?>' name="identification_issue_place[]" value="<?php echo set_value('identification_issue_place['.$i.']'); ?>" placeholder="<?php echo lang('issue_place'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('identification_issue_place['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- identification_issue_date -->
                                        <label class="col-md-2 label-heading" for="identification_issue_date<?php echo $i; ?>"><?php echo lang('issue_date'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='identification_issue_date<?php echo $i; ?>' name="identification_issue_date[]" value="<?php echo set_value('identification_issue_date['.$i.']'); ?>" placeholder="dd-mm-yyyy" required/>
                                            <span class="text-danger"><?php echo form_error('identification_issue_date['.$i.']'); ?></span>       
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <!-- identification_expiry_date -->
                                        <label class="col-md-2 label-heading" for="identification_expiry_date<?php echo $i; ?>"><?php echo lang('expiry_date'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='identification_expiry_date<?php echo $i; ?>' name="identification_expiry_date[]" value="<?php echo set_value('identification_expiry_date['.$i.']'); ?>" placeholder="dd-mm-yyyy" required/>
                                            <span class="text-danger"><?php echo form_error('identification_expiry_date['.$i.']'); ?></span>       
                                        </div>   
                                        <!-- button add form -->
                                        <label for="function" class="col-md-3 label-heading">
                                            <!-- button remove form -->
                                            <?php if($i > 0): ?>
                                            <a href="javascript:void(0)" title="Remove Form" onclick="removeIdentification('<?php echo $i;?>','<?php echo $identification_id; ?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                            <?php endif; ?> 
                                            <!-- button add form -->
                                            <a href="javascript:void(0)" title="Add Form" onclick="addIdentification();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                        </label>
                                        <div class="col-md-4 ui-front" >
                                        </div>  
                                    </div>
                                <?php if($key > 0){echo '</div>';}
                            endfor;
                        endif;
                    endif;?>


                    <!-- append main app to here -->
                    <div class="append-identification"></div> 
                    <!-- upload files -->
                    <legend><h4><?php echo lang("attachment").' '.lang("files"); ?></h4></legend>

                    <!-- existing files -->
                    <?php if(!empty($identificationFiles)): ?>       
                        <input type="hidden" id="identification_file_deleted" name="identification_file_deleted" value="<?php echo set_value('identification_file_deleted'); ?>">                 
                        <input type="hidden" id="identification_file_path" name="identification_file_path" value="<?php echo set_value('identification_file_path'); ?>">                 
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
                               <?php foreach ($identificationFiles as $key => $file) : ?>
                               <tr id="list_ident_file<?php echo $key; ?>">
                                  <td><?php echo $key+1; ?></td>
                                  <td>
                                    <?php $path = $file->file_path.'/'.$file->upload_file_name;?>
                                    <a href="<?php echo base_url().$path; ?>" target="_blank"><?php echo $file->original_name; ?></a>
                                  </td>
                                  <td><?php echo $file->extension; ?></td>
                                  <td><?php echo $file->file_size; ?>kb</td>
                                  <td><?php echo $file->file_path; ?></td>
                               </tr>
                               <?php endforeach; ?>
                            </table>
                         </div>
                        </div>
                    <?php endif; ?>
                    <!-- end upload files -->
                </div>
                <!-- End identification document -->

                <!-- Employee detail -->
                <div id="employment" class="tab-pane fade">
                    <input type="hidden" id="employment_deleted" name="employment_deleted" value="<?php echo set_value('employment_deleted'); ?>">

                    <?php if(isset($employments) && !empty($employments) && set_value('employment_type[0]') == false):
                    foreach ($employments as $key => $emp): ?>
                        <?php if($key > 0){echo '<div id="removeEmployment'.$key.'"><hr>'; } ?>
                            <?php 
                                if(set_value('employment_id['.$key.']') == false){
                                    $employment_id = $emp->employment_id;
                                }else{
                                    $employment_id = set_value('employment_id['.$key.']');
                                } ?>

                                <input type="hidden" name="employment_id[]" value="<?php echo $employment_id; ?>">
                                <div class="form-group">
                                    <!-- employment_type -->
                                    <label class="col-md-2 label-heading" for="employment_type"><?php echo lang('employment_type'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="employment_type[]" id="employment_type" required>
                                            <option value="">--- select employment type ---</option>
                                            <?php 
                                                $employment_type = $emp->employment_type;
                                                if(set_value('employment_type['.$key.']') != false){
                                                    $employment_type = set_value('employment_type['.$key.']');
                                                }
                                             ?> 
                                            <option value="C" <?php echo ($employment_type == 'C' ? 'selected' : ''); ?>>Current</option>
                                            <option value="P" <?php echo ($employment_type == 'P' ? 'selected' : ''); ?>>Previouse</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employment_type['.$key.']'); ?></span>  
                                    </div>
                                    <!-- self_employee -->
                                    <label class="col-md-2 label-heading" for="self_employee"><?php echo lang('self_employee'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' onchange="changeSelfEmployee()" data-live-search="true" name="self_employee[]" id="self_employee" required>
                                            <option value="">--- select self employee ---</option>
                                            <?php 
                                                $self_employee = $emp->self_employee;
                                                if(set_value('self_employee['.$key.']') != false){
                                                    $self_employee = set_value('self_employee['.$key.']');
                                                }
                                             ?> 
                                            <option value="Y" <?php echo ($self_employee == 'Y' ? 'selected' : ''); ?>>Yes</option>
                                            <option value="N" <?php echo ($self_employee == 'N' ? 'selected' : ''); ?>>No</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('self_employee['.$key.']'); ?></span>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- company_name -->
                                    <label class="col-md-2 label-heading" for="company_name"><?php echo lang('company_name'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='company_name' name="company_name[]" value="<?php echo set_value('company_name['.$key.']') == false ? $emp->company_name : set_value('company_name['.$key.']'); ?>" placeholder="<?php echo lang('company_name'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('company_name['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- empbusiness_type_id -->
                                    <label class="col-md-2 label-heading" for="empbusiness_type_id"><?php echo lang('business_type'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="empbusiness_type_id[]" id='empbusiness_type_id' required>
                                            <option value="">--- select business type ---</option>
                                            <?php if(!empty($businessType)): ?>
                                                <?php 
                                                    $empbusiness_type_id = $emp->empbusiness_type_id;
                                                    if(set_value('empbusiness_type_id['.$key.']') != false){
                                                        $empbusiness_type_id = set_value('empbusiness_type_id['.$key.']');
                                                    }
                                                 ?> 
                                                <?php foreach ($businessType as $row):?>
                                                    <option value="<?php echo $row->id; ?>" <?php echo ($empbusiness_type_id == $row->id ? 'selected' : ''); ?>><?php echo $row->code.'-'.$row->name_kh; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('empbusiness_type_id['.$key.']'); ?></span>     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- employer_name -->
                                    <label class="col-md-2 label-heading" for="employer_name"><?php echo lang('employer_name'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='employer_name' name="employer_name[]" value="<?php echo set_value('employer_name['.$key.']') == false ? $emp->employer_name : set_value('employer_name['.$key.']'); ?>" placeholder="<?php echo lang('employer_name'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('employer_name['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- emp_occupation -->
                                    <label class="col-md-2 label-heading" for="emp_occupation"><?php echo lang('occupation'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='emp_occupation' name="emp_occupation[]" value="<?php echo set_value('emp_occupation['.$key.']') == false ? $emp->emp_occupation : set_value('emp_occupation['.$key.']'); ?>" placeholder="<?php echo lang('occupation'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('emp_occupation['.$key.']'); ?></span>     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- length_of_service -->
                                    <label class="col-md-2 label-heading" for="length_of_service"><?php echo lang('length_of_service'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='length_of_service' name="length_of_service[]" value="<?php echo set_value('length_of_service['.$key.']') == false ? $emp->length_of_service : set_value('length_of_service['.$key.']'); ?>" placeholder="<?php echo lang('length_of_service'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('length_of_service['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- employer_address_type -->
                                    <label class="col-md-2 label-heading" for="employer_address_type"><?php echo lang('employer_address_type'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="employer_address_type[]" id="employer_address_type" required>
                                            <option value="">--- select address type* ---</option>
                                            <?php 
                                                $employer_address_type = $emp->employer_address_type;
                                                if(set_value('employer_address_type['.$key.']') != false){
                                                    $employer_address_type = set_value('employer_address_type['.$key.']');
                                                }
                                             ?>
                                            <option value="RESID" <?php echo ($employer_address_type == 'RESID' ? 'selected' : ''); ?>>Residential</option>
                                            <option value="WORK" <?php echo ($employer_address_type == 'WORK' ? 'selected' : ''); ?>>Work</option>
                                            <option value="POST" <?php echo ($employer_address_type == 'POST' ? 'selected' : ''); ?>>Correspondence</option>
                                            <option value="U" <?php echo ($employer_address_type == 'U' ? 'selected' : ''); ?>>Unknown</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employer_address_type['.$key.']'); ?></span>     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- employer_id -->
                                    <label class="col-md-2 label-heading" for="employer_id"><?php echo lang('employer_id'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='employer_id' name="employer_id[]" value="<?php echo set_value('employer_id['.$key.']') == false ? $emp->employer_id : set_value('employer_id['.$key.']'); ?>" placeholder="<?php echo lang('employer_id'); ?>" required/>
                                        <span class="text-danger"><?php echo form_error('employer_id['.$key.']'); ?></span>     
                                    </div>
                                    <!-- employer_country -->
                                    <label class="col-md-2 label-heading" for="employer_country"><?php echo lang('country'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerCountry('')" name="employer_country[]" id="employer_country" required>
                                            <option value="">--- Select Country ---</option>
                                            <?php if(!empty($country)): ?>
                                                <?php 
                                                    $employer_country = $emp->employer_country;
                                                    if(set_value('employer_country['.$key.']') != false){
                                                        $employer_country = set_value('employer_country['.$key.']');
                                                    }
                                                 ?>
                                                <?php foreach($country as $row):?>
                                                    <option value="<?php echo $row->id?>" <?php echo ($employer_country == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employer_country['.$key.']'); ?></span>  
                                    </div>
                                </div>
                                <div class="form-group">     
                                    <!-- employer_province -->
                                    <label class="col-md-2 label-heading" for="employer_province"><?php echo lang('province'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerProvince('')" name="employer_province[]" id="employer_province" required>
                                            <?php 
                                                $employer_province = $emp->employer_province;
                                                if(set_value('employer_province['.$key.']') != false){
                                                    $employer_province = set_value('employer_province['.$key.']');
                                                }
                                             ?>
                                            <?php echo selectedProvince($employer_country, $employer_province); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employer_province['.$key.']'); ?></span>      
                                    </div>                       
                                    <!-- employer_district -->
                                    <label class="col-md-2 label-heading" for="employer_district"><?php echo lang('district'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerDistrict('')" name="employer_district[]" id="employer_district" required>
                                            <?php 
                                                $employer_district = $emp->employer_district;
                                                if(set_value('employer_district['.$key.']') != false){
                                                    $employer_district = set_value('employer_district['.$key.']');
                                                }
                                             ?>
                                            <?php echo selectedDistrict($employer_province, $employer_district); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employer_district['.$key.']'); ?></span>     
                                    </div>                           
                                </div>
                                <div class="form-group">
                                    <!-- employer_commune -->
                                    <label class="col-md-2 label-heading" for="employer_commune"><?php echo lang('commune'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerCommune('')" id='employer_commune' name="employer_commune[]" required>
                                            <?php 
                                                $employer_commune = $emp->employer_commune;
                                                if(set_value('employer_commune['.$key.']') != false){
                                                    $employer_commune = set_value('employer_commune['.$key.']');
                                                }
                                             ?>
                                            <?php echo selectedCommune($employer_district, $employer_commune); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employer_commune['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- employer_village -->
                                    <label class="col-md-2 label-heading" for="employer_village"><?php echo lang('village'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="employer_village[]" id='employer_village' required>
                                            <?php 
                                                $employer_village = $emp->employer_village;
                                                if(set_value('employer_village['.$key.']') != false){
                                                    $employer_village = set_value('employer_village['.$key.']');
                                                }
                                             ?>
                                            <?php echo selectedVillage($employer_commune, $employer_village); ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employer_village['.$key.']'); ?></span>     
                                    </div>
                                </div>
                                <div class="form-group">                            
                                    <!-- employer_houseno -->
                                    <label class="col-md-2 label-heading" for="employer_houseno"><?php echo lang('house_no'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='employer_houseno' name="employer_houseno[]" value="<?php echo set_value('employer_houseno['.$key.']') == false ? $emp->employer_houseno : set_value('employer_houseno['.$key.']'); ?>" placeholder="#..."  required/>
                                        <span class="text-danger"><?php echo form_error('employer_houseno['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- employer_street -->
                                    <label class="col-md-2 label-heading" for="employer_street"><?php echo lang('street'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='employer_street' name="employer_street[]" value="<?php echo set_value('employer_street['.$key.']') == false ? $emp->employer_street : set_value('employer_street['.$key.']'); ?>" placeholder="No..."  required/>
                                        <span class="text-danger"><?php echo form_error('employer_street['.$key.']'); ?></span>       
                                    </div>                           
                                </div>    
                                <div class="form-group">    
                                    <!-- employed_year -->
                                    <label class="col-md-2 label-heading" for="employed_year"><?php echo lang('employed_year'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" min="1" id='employed_year' name="employed_year[]" value="<?php echo set_value('employed_year['.$key.']') == false ? $emp->employed_year : set_value('employed_year['.$key.']'); ?>" placeholder="<?php echo lang('employed_year'); ?>"  required/>
                                        <span class="text-danger"><?php echo form_error('employed_year['.$key.']'); ?></span>       
                                    </div>                          
                                    <!-- employee_currency -->
                                    <label class="col-md-2 label-heading" for="employee_currency"><?php echo lang('currency'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" id='employee_currency' name="employee_currency[]" required>
                                            <option>--- select currency ---</option>
                                            <?php if(!empty(listCurrency())): ?>
                                                 <?php 
                                                    $employee_currency = $emp->employee_currency;
                                                    if(set_value('employee_currency['.$key.']') != false){
                                                        $employee_currency = set_value('employee_currency['.$key.']');
                                                    }
                                                 ?> 
                                                <?php foreach (listCurrency() as $curr):?>
                                                    <option value="<?php echo $curr->id ?>" <?php echo ($employee_currency == $curr->id ? 'selected' : ''); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('employee_currency['.$key.']'); ?></span>       
                                    </div>                           
                                </div>   
                                <div class="form-group">
                                    <!-- emplyee_salary -->
                                    <label class="col-md-2 label-heading" for="emplyee_salary"><?php echo lang('emplyee_salary'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" min="1" id='emplyee_salary' name="emplyee_salary[]" value="<?php echo set_value('emplyee_salary['.$key.']') == false ? $emp->emplyee_salary : set_value('emplyee_salary['.$key.']'); ?>" placeholder="<?php echo lang('emplyee_salary') ?>" required/>
                                        <span class="text-danger"><?php echo form_error('emplyee_salary['.$key.']'); ?></span>       
                                    </div> 
                                    <!-- button add form -->
                                    <label class="col-md-2 label-heading" for="" id="addEmployment">
                                        <?php if($key > 0):?>
                                        <!-- button add form -->
                                        <a href="javascript:void(0)" title="Remove Form" onclick="removeEmployment('<?php echo $key;?>','<?php echo $employment_id;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                        <?php endif; ?>
                                        <a href="javascript:void(0)" title="Add Form" onclick="addEmployment();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                    </label>
                                    <div class="col-md-4 ui-front" >
                                    </div>  
                                </div>
                            <?php if($key > 0){echo '</div>';}
                        endforeach;
                    else: 

                        // append set_value    
                        if($this->input->post('identification_type')):                       
                            for ($i=0; $i < count($this->input->post('employment_type')); $i++):
                                $employment_id = set_value('employment_id['.$i.']');
                                if($i > 0){ echo '<div id="removeEmployment'.$i.'"><hr>';} ?>

                                    <input type="hidden" name="employment_id[]" value="<?php echo $employment_id; ?>">
                                    <div class="form-group">
                                        <!-- employment_type -->
                                        <label class="col-md-2 label-heading" for="employment_type<?php echo $i; ?>"><?php echo lang('employment_type'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" name="employment_type[]" id="employment_type<?php echo $i; ?>" required>
                                                <option value="">--- select employment type ---</option>
                                                <option value="C" <?php echo set_select('employment_type['.$i.']', 'C'); ?>>Current</option>
                                                <option value="P" <?php echo set_select('employment_type['.$i.']', 'P'); ?>>Previouse</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employment_type['.$i.']'); ?></span>  
                                        </div>
                                        <!-- self_employee -->
                                        <label class="col-md-2 label-heading" for="self_employee<?php echo $i; ?>"><?php echo lang('self_employee'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' onchange="changeSelfEmployee()" data-live-search="true" name="self_employee[]" id="self_employee<?php echo $i; ?>" required>
                                                <option value="">--- select self employee ---</option>
                                                <option value="Y" <?php echo set_select('self_employee['.$i.']', 'Y'); ?>>Yes</option>
                                                <option value="N" <?php echo set_select('self_employee['.$i.']', 'N'); ?>>No</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('self_employee['.$i.']'); ?></span>  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- company_name -->
                                        <label class="col-md-2 label-heading" for="company_name<?php echo $i; ?>"><?php echo lang('company_name'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='company_name<?php echo $i; ?>' name="company_name[]" value="<?php echo set_value('company_name['.$i.']'); ?>" placeholder="<?php echo lang('company_name'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('company_name['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- empbusiness_type_id -->
                                        <label class="col-md-2 label-heading" for="empbusiness_type_id<?php echo $i; ?>"><?php echo lang('business_type'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" name="empbusiness_type_id[]" id='empbusiness_type_id<?php echo $i; ?>' required>
                                                <option value="">--- select business type ---</option>
                                                <?php if(!empty($businessType)): ?>
                                                    <?php foreach ($businessType as $row):?>
                                                        <option value="<?php echo $row->id; ?>" <?php echo set_select('empbusiness_type_id['.$i.']', $row->id); ?>><?php echo $row->code.'-'.$row->name_kh; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('empbusiness_type_id['.$i.']'); ?></span>     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- employer_name -->
                                        <label class="col-md-2 label-heading" for="employer_name<?php echo $i; ?>"><?php echo lang('employer_name'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='employer_name<?php echo $i; ?>' name="employer_name[]" value="<?php echo set_value('employer_name['.$i.']'); ?>" placeholder="<?php echo lang('employer_name'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('employer_name['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- emp_occupation -->
                                        <label class="col-md-2 label-heading" for="emp_occupation<?php echo $i; ?>"><?php echo lang('occupation'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='emp_occupation<?php echo $i; ?>' name="emp_occupation[]" value="<?php echo set_value('emp_occupation['.$i.']'); ?>" placeholder="<?php echo lang('occupation'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('emp_occupation['.$i.']'); ?></span>     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- length_of_service -->
                                        <label class="col-md-2 label-heading" for="length_of_service<?php echo $i; ?>"><?php echo lang('length_of_service'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='length_of_service<?php echo $i; ?>' name="length_of_service[]" value="<?php echo set_value('length_of_service['.$i.']'); ?>" placeholder="<?php echo lang('length_of_service'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('length_of_service['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- employer_address_type -->
                                        <label class="col-md-2 label-heading" for="employer_address_type<?php echo $i; ?>"><?php echo lang('employer_address_type'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" name="employer_address_type[]" id="employer_address_type<?php echo $i; ?>" required>
                                                <option value="">--- select address type* ---</option>
                                                <option value="RESID" <?php echo set_select('employer_address_type['.$i.']', 'RESID'); ?>>Residential</option>
                                                <option value="WORK" <?php echo set_select('employer_address_type['.$i.']', 'WORK'); ?>>Work</option>
                                                <option value="POST" <?php echo set_select('employer_address_type['.$i.']', 'POST'); ?>>Correspondence</option>
                                                <option value="U" <?php echo set_select('employer_address_type['.$i.']', 'U'); ?>>Unknown</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employer_address_type['.$i.']'); ?></span>     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- employer_id -->
                                        <label class="col-md-2 label-heading" for="employer_id<?php echo $i; ?>"><?php echo lang('employer_id'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='employer_id<?php echo $i; ?>' name="employer_id[]" value="<?php echo set_value('employer_id['.$i.']'); ?>" placeholder="<?php echo lang('employer_id'); ?>" required/>
                                            <span class="text-danger"><?php echo form_error('employer_id['.$i.']'); ?></span>     
                                        </div>
                                        <!-- employer_country -->
                                        <label class="col-md-2 label-heading" for="employer_country<?php echo $i; ?>"><?php echo lang('country'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerCountry('<?php echo $i; ?>')" name="employer_country[]" id="employer_country<?php echo $i; ?>" required>
                                                <option value="">--- Select Country ---</option>
                                                <?php if(!empty($country)): ?>
                                                    <?php foreach($country as $row):?>
                                                        <option value="<?php echo $row->id?>" <?php echo set_select('employer_country['.$i.']', $row->id); ?>><?php echo $row->name_en?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employer_country['.$i.']'); ?></span>  
                                        </div>
                                    </div>
                                    <div class="form-group">     
                                        <!-- employer_province -->
                                        <label class="col-md-2 label-heading" for="employer_province<?php echo $i; ?>"><?php echo lang('province'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerProvince('<?php echo $i; ?>')" name="employer_province[]" id="employer_province<?php echo $i; ?>" required>
                                                <?php echo selectedProvince(set_value('employer_country['.$i.']'), set_value('employer_province['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employer_province['.$i.']'); ?></span>      
                                        </div>                       
                                        <!-- employer_district -->
                                        <label class="col-md-2 label-heading" for="employer_district<?php echo $i; ?>"><?php echo lang('district'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerDistrict('<?php echo $i; ?>')" name="employer_district[]" id="employer_district<?php echo $i; ?>" required>
                                                <?php echo selectedDistrict(set_value('employer_province['.$i.']'), set_value('employer_district['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employer_district['.$i.']'); ?></span>     
                                        </div>                           
                                    </div>
                                    <div class="form-group">
                                        <!-- employer_commune -->
                                        <label class="col-md-2 label-heading" for="employer_commune<?php echo $i; ?>"><?php echo lang('commune'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerCommune('<?php echo $i; ?>')" id='employer_commune<?php echo $i; ?>' name="employer_commune[]" required>
                                                <?php echo selectedCommune(set_value('employer_district['.$i.']'), set_value('employer_commune['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employer_commune['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- employer_village -->
                                        <label class="col-md-2 label-heading" for="employer_village<?php echo $i; ?>"><?php echo lang('village'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" name="employer_village[]" id='employer_village<?php echo $i; ?>' required>
                                                <?php echo selectedVillage(set_value('employer_commune['.$i.']'), set_value('employer_village['.$i.']')); ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employer_village['.$i.']'); ?></span>     
                                        </div>
                                    </div>
                                    <div class="form-group">                            
                                        <!-- employer_houseno -->
                                        <label class="col-md-2 label-heading" for="employer_houseno<?php echo $i; ?>"><?php echo lang('house_no'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='employer_houseno<?php echo $i; ?>' name="employer_houseno[]" value="<?php echo set_value('employer_houseno['.$i.']'); ?>" placeholder="#..."  required/>
                                            <span class="text-danger"><?php echo form_error('employer_houseno['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- employer_street -->
                                        <label class="col-md-2 label-heading" for="employer_street<?php echo $i; ?>"><?php echo lang('street'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="text" id='employer_street<?php echo $i; ?>' name="employer_street[]" value="<?php echo set_value('employer_street['.$i.']'); ?>" placeholder="No..."  required/>
                                            <span class="text-danger"><?php echo form_error('employer_street['.$i.']'); ?></span>       
                                        </div>                           
                                    </div>    
                                    <div class="form-group">    
                                        <!-- employed_year -->
                                        <label class="col-md-2 label-heading" for="employed_year<?php echo $i; ?>"><?php echo lang('employed_year'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="number" min="1" id='employed_year<?php echo $i; ?>' name="employed_year[]" value="<?php echo set_value('employed_year['.$i.']'); ?>" placeholder="<?php echo lang('employed_year'); ?>"  required/>
                                            <span class="text-danger"><?php echo form_error('employed_year['.$i.']'); ?></span>       
                                        </div>                          
                                        <!-- employee_currency -->
                                        <label class="col-md-2 label-heading" for="employee_currency<?php echo $i; ?>"><?php echo lang('currency'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <select class="form-control select2" style='width:100%' data-live-search="true" id='employee_currency<?php echo $i; ?>' name="employee_currency[]" required>
                                                <option>--- select currency ---</option>
                                                <?php if(!empty(listCurrency())): ?>
                                                    <?php foreach (listCurrency() as $curr):?>
                                                        <option value="<?php echo $curr->id ?>" <?php echo set_select('employee_currency['.$i.']', $curr->id); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('employee_currency['.$i.']'); ?></span>       
                                        </div>                           
                                    </div>   
                                    <div class="form-group">
                                        <!-- emplyee_salary -->
                                        <label class="col-md-2 label-heading" for="emplyee_salary<?php echo $i; ?>"><?php echo lang('emplyee_salary'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="number" min="1" id='emplyee_salary<?php echo $i; ?>' name="emplyee_salary[]" value="<?php echo set_value('emplyee_salary['.$i.']'); ?>" placeholder="<?php echo lang('emplyee_salary') ?>" required/>
                                            <span class="text-danger"><?php echo form_error('emplyee_salary['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- button add form -->
                                        <label for="function" class="col-md-3 label-heading">
                                            <!-- button remove form -->
                                            <?php if($i > 0): ?>
                                            <a href="javascript:void(0)" title="Remove Form" onclick="removeEmployment('<?php echo $i;?>','<?php echo $employment_id; ?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                            <?php endif; ?> 
                                            <!-- button add form -->
                                            <a href="javascript:void(0)" title="Add Form" onclick="addEmployment();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                        </label>
                                        <div class="col-md-4 ui-front" >
                                        </div>
                                    </div>
                                <?php if($i > 0){echo '</div>';}
                            endfor;
                        endif;
                    endif;?>

                    <!-- append main app to here -->
                    <div class="append-employment"></div>              
                </div>
                <!-- end employment address -->

                <!-- set business plan id for deleted if no self employment  -->
                <?php if(!empty($businessPlans)):
                    foreach ($businessPlans as $key => $b): ?>
                    <input type="hidden" name="businessPlanId[]" value="<?php echo $b->business_plan_id; ?>">
                    <input type="hidden" name="businessIncomeId[]" value="<?php echo $b->business_plan_id; ?>">
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Business address info -->
                <div id="business" class="tab-pane fade">
                    <input type="hidden" id="business_deleted" name="business_deleted" value="<?php echo set_value('business_deleted'); ?>">
                    <input type="hidden" id="business_inex_deleted" name="business_inex_deleted" value="<?php echo set_value('business_inex_deleted'); ?>">

                    <?php if(isset($businessPlans) && !empty($businessPlans) && set_value('business_name[0]') == false):
                        foreach ($businessPlans as $key => $buss):
                            if($key > 0){echo '<div id="removeBusiness'.$key.'"><hr>'; } 
                             
                                if(set_value('business_plan_id['.$key.']') == false){
                                    $business_plan_id = $buss->business_plan_id;
                                    $business_income_id = $buss->business_income_id;
                                }else{
                                    $business_plan_id = set_value('business_plan_id['.$key.']');
                                    $business_income_id = set_value('business_income_id['.$key.']');
                                } ?>

                                <input type="hidden" name="business_plan_id[]" value="<?php echo $business_plan_id; ?>">
                                <input type="hidden" name="business_income_id[]" value="<?php echo $business_income_id; ?>">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <!-- business_name -->
                                            <label class="col-md-2 label-heading" for="business_name"><?php echo lang('business_name'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='business_name' name="business_name[]" value="<?php echo set_value('business_name['.$key.']') == false ? $buss->business_name : set_value('business_name['.$key.']'); ?>" placeholder="<?php echo lang('business_name'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('business_name[0]'); ?></span>       
                                            </div> 
                                            <!-- business_type -->
                                            <label class="col-md-2 label-heading" for="business_type"><?php echo lang('business_type'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_type[]" id='business_type'>
                                                    <option value="">--- select business type ---</option>
                                                    <?php if(!empty($businessType)): ?>
                                                        <?php 
                                                            $business_type = $buss->business_type;
                                                            if(set_value('business_type['.$key.']') != false){
                                                                $business_type = set_value('business_type['.$key.']');
                                                            }
                                                         ?> 
                                                        <?php foreach ($businessType as $row):?>
                                                            <option value="<?php echo $row->id; ?>" <?php echo ($business_type == $row->id ? 'selected' : ''); ?>><?php echo $row->code.' - '.$row->name_kh; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_type'); ?></span>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- business_status -->
                                            <label class="col-md-2 label-heading" for="business_status"><?php echo lang('business_status'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_status[]" id='business_status'>
                                                    <option value="">--- select business status ---</option>
                                                    <?php if(!empty($businessStatus)): ?>
                                                        <?php 
                                                            $business_status = $buss->business_status;
                                                            if(set_value('business_status['.$key.']') != false){
                                                                $business_status = set_value('business_status['.$key.']');
                                                            }
                                                         ?> 
                                                        <?php foreach ($businessStatus as $row):?>
                                                            <option value="<?php echo $row->id; ?>" <?php echo ($business_status == $row->id ? 'selected' : ''); ?>><?php echo $row->name_kh; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_status'); ?></span>     
                                            </div>
                                            <!-- business_format -->
                                            <label class="col-md-2 label-heading" for="business_format"><?php echo lang('business_format'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_format[]" id='business_format'>
                                                    <option value="">--- select business type ---</option>
                                                    <?php if(!empty($businessFormat)): ?>
                                                        <?php 
                                                            $business_format = $buss->business_format;
                                                            if(set_value('business_format['.$key.']') != false){
                                                                $business_format = set_value('business_format['.$key.']');
                                                            }
                                                         ?> 
                                                        <?php foreach ($businessFormat as $row):?>
                                                            <option value="<?php echo $row->id; ?>" <?php echo ($business_format == $row->id ? 'selected' : ''); ?>><?php echo $row->name_kh; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_format'); ?></span>     
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- business_start -->
                                            <label class="col-md-2 label-heading" for="business_start"><?php echo lang('business_start'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='business_start' name="business_start[]" value="<?php echo set_value('business_start['.$key.']') == false ? $buss->business_start : set_value('business_start['.$key.']'); ?>" placeholder="dd-mm-yyyy"/>
                                                <span class="text-danger"><?php echo form_error('business_start'); ?></span>       
                                            </div> 
                                            <!-- business_licence -->
                                            <label class="col-md-2 label-heading" for="business_licence"><?php echo lang('business_licence'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='business_licence' name="business_licence[]" value="<?php echo set_value('business_licence['.$key.']') == false ? $buss->business_licence : set_value('business_licence['.$key.']'); ?>" placeholder="<?php echo lang('business_licence'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('business_licence'); ?></span>     
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- employee_amount -->
                                            <label class="col-md-2 label-heading" for="employee_amount"><?php echo lang('employee_amount'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="number" min="1" id='employee_amount' name="employee_amount[]" value="<?php echo set_value('employee_amount['.$key.']') == false ? $buss->employee_amount : set_value('employee_amount['.$key.']'); ?>" placeholder="<?php echo lang('employee_amount'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('employee_amount'); ?></span>       
                                            </div> 
                                            <!-- man_employee_amount -->
                                            <label class="col-md-2 label-heading" for="man_employee_amount"><?php echo lang('man_employee_amount'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="number" min="1" id='man_employee_amount' name="man_employee_amount[]" value="<?php echo set_value('man_employee_amount['.$key.']') == false ? $buss->man_employee_amount : set_value('man_employee_amount['.$key.']'); ?>" placeholder="<?php echo lang('man_employee_amount'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('man_employee_amount'); ?></span>       
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <!-- business_country -->
                                            <label class="col-md-2 label-heading" for="business_country"><?php echo lang('country'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessCountry('')" name="business_country[]" id="business_country">
                                                    <option value="">--- Select Country ---</option>
                                                    <?php if(!empty($country)): ?>
                                                        <?php 
                                                            $business_country = $buss->business_country;
                                                            if(set_value('business_country['.$key.']') != false){
                                                                $business_country = set_value('business_country['.$key.']');
                                                            }
                                                         ?> 
                                                        <?php foreach($country as $row):?>
                                                            <option value="<?php echo $row->id?>" <?php echo ($business_country == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_country'); ?></span>  
                                            </div>
                                            <!-- business_province -->
                                            <label class="col-md-2 label-heading" for="business_province"><?php echo lang('province'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessProvince('')" name="business_province[]" id="business_province">
                                                    <?php 
                                                        $business_province = $buss->business_province;
                                                        if(set_value('business_province['.$key.']') != false){
                                                            $business_province = set_value('business_province['.$key.']');
                                                        }
                                                     ?> 
                                                    <?php echo selectedProvince($business_country, $business_province); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_province'); ?></span>      
                                            </div> 
                                        </div>   
                                        <div class="form-group">                                               
                                            <!-- business_district -->
                                            <label class="col-md-2 label-heading" for="business_district"><?php echo lang('district'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessDistrict('')" name="business_district[]" id="business_district" >
                                                    <?php 
                                                        $business_district = $buss->business_district;
                                                        if(set_value('business_district['.$key.']') != false){
                                                            $business_district = set_value('business_district['.$key.']');
                                                        }
                                                     ?>
                                                    <?php echo selectedDistrict($business_province, $business_district); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_district'); ?></span>     
                                            </div>  
                                            <!-- business_commune -->
                                            <label class="col-md-2 label-heading" for="business_commune"><?php echo lang('commune'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessCommune('')" id='business_commune' name="business_commune[]">
                                                    <?php 
                                                        $business_commune = $buss->business_commune;
                                                        if(set_value('business_commune['.$key.']') != false){
                                                            $business_commune = set_value('business_commune['.$key.']');
                                                        }
                                                     ?>
                                                    <?php echo selectedCommune($business_district, $business_commune); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_commune'); ?></span>       
                                            </div>                          
                                        </div>
                                        <div class="form-group">
                                            <!-- business_village -->
                                            <label class="col-md-2 label-heading" for="business_village"><?php echo lang('village'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_village[]" id='business_village'>
                                                    <?php 
                                                        $business_village = $buss->business_village;
                                                        if(set_value('business_village['.$key.']') != false){
                                                            $business_village = set_value('business_village['.$key.']');
                                                        }
                                                     ?>
                                                    <?php echo selectedVillage($business_commune, $business_village); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_village'); ?></span>     
                                            </div>                           
                                            <!-- location_status -->
                                            <label class="col-md-2 label-heading" for="location_status"><?php echo lang('location_status'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="location_status[]" id="location_status">
                                                    <option value="">--- select location status ---</option>
                                                    <?php if(!empty($businessLocationStatus)): ?>
                                                        <?php 
                                                            $location_status = $buss->location_status;
                                                            if(set_value('location_status['.$key.']') != false){
                                                                $location_status = set_value('location_status['.$key.']');
                                                            }
                                                         ?> 
                                                        <?php foreach($businessLocationStatus as $row):?>
                                                            <option value="<?php echo $row->id?>" <?php echo ($location_status == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('location_status'); ?></span>       
                                            </div>                         
                                        </div>    
                                        
                                        <!-- income & expend -->
                                        <legend>Income & Expend</legend>
                                        <div class="form-group">
                                            <!-- income_date -->
                                            <label class="col-md-2 label-heading" for="income_date"><?php echo lang('income_date'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='income_date' name="income_date[]" value="<?php echo set_value('income_date['.$key.']') == false ? date('d-m-Y', strtotime($buss->income_date)) : set_value('income_date['.$key.']'); ?>" placeholder="<?php echo lang('income_date'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('income_date'); ?></span>       
                                            </div> 
                                            <!-- business_currency -->
                                            <label class="col-md-2 label-heading" for="business_currency<?php echo $key; ?>"><?php echo lang('currency'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select name="business_currency[]" id="business_currency<?php echo $key; ?>" style='width:100%' data-live-search="true" class="form-control select2">
                                                      <option value="">--- select currency ---</option>
                                                      <?php if(!empty(listCurrency())): ?>
                                                        <?php 
                                                            $business_currency = $buss->business_currency;
                                                            if(set_value('business_currency['.$key.']') != false){
                                                                $business_currency = set_value('business_currency['.$key.']');
                                                            }
                                                         ?>
                                                          <?php foreach (listCurrency() as $curr): ?>
                                                            <option value="<?php echo $curr->id;?>" <?php echo ($business_currency == $curr->id ? 'selected' : ''); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                                          <?php endforeach; ?>
                                                      <?php endif; ?>
                                                    </select>
                                                <span class="text-danger"><?php echo form_error('business_currency['.$key.']'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- business_profit -->
                                            <label class="col-md-2 label-heading" for="business_profit<?php echo $key; ?>"><?php echo lang('business_profit'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='business_profit<?php echo $key; ?>' name="business_profit[]" value="<?php echo set_value('business_profit['.$key.']') == false ? $buss->business_profit : set_value('business_profit['.$key.']'); ?>" placeholder="<?php echo lang('business_profit'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('business_profit['.$key.']'); ?></span>       
                                            </div>
                                            <!-- transport_cost -->
                                            <label class="col-md-2 label-heading" for="transport_cost"><?php echo lang('transport_cost'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='transport_cost' name="transport_cost[]" value="<?php echo set_value('transport_cost['.$key.']') == false ? $buss->transport_cost : set_value('transport_cost['.$key.']'); ?>" placeholder="<?php echo lang('transport_cost'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('transport_cost'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- repair_cost -->
                                            <label class="col-md-2 label-heading" for="repair_cost"><?php echo lang('repair_cost'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='repair_cost' name="repair_cost[]" value="<?php echo set_value('repair_cost['.$key.']') == false ? $buss->repair_cost : set_value('repair_cost['.$key.']'); ?>" placeholder="<?php echo lang('repair_cost'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('repair_cost'); ?></span>       
                                            </div>
                                            <!-- profit_before_tax -->
                                            <label class="col-md-2 label-heading" for="profit_before_tax"><?php echo lang('profit_before_tax'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='profit_before_tax' name="profit_before_tax[]" value="<?php echo set_value('profit_before_tax['.$key.']') == false ? $buss->profit_before_tax : set_value('profit_before_tax['.$key.']'); ?>" placeholder="<?php echo lang('profit_before_tax'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('profit_before_tax'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- income_after_tax -->
                                            <label class="col-md-2 label-heading" for="income_after_tax"><?php echo lang('income_after_tax'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='income_after_tax' name="income_after_tax[]" value="<?php echo set_value('income_after_tax['.$key.']') == false ? $buss->income_after_tax : set_value('income_after_tax['.$key.']'); ?>" placeholder="<?php echo lang('income_after_tax'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('income_after_tax'); ?></span>       
                                            </div>
                                            <!-- business_cost -->
                                            <label class="col-md-2 label-heading" for="business_cost"><?php echo lang('business_cost'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='business_cost' name="business_cost[]" value="<?php echo set_value('business_cost['.$key.']') == false ? $buss->business_cost : set_value('business_cost['.$key.']'); ?>" placeholder="<?php echo lang('business_cost'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('business_cost'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- other_profit -->
                                            <label class="col-md-2 label-heading" for="other_profit"><?php echo lang('other_profit'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='other_profit' name="other_profit[]" value="<?php echo set_value('other_profit['.$key.']') == false ? $buss->other_profit : set_value('other_profit['.$key.']'); ?>" placeholder="<?php echo lang('other_profit'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('other_profit'); ?></span>       
                                            </div>
                                            <!-- total_profit -->
                                            <label class="col-md-2 label-heading" for="total_profit"><?php echo lang('total_profit'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='total_profit' name="total_profit[]" value="<?php echo set_value('total_profit['.$key.']') == false ? $buss->total_profit : set_value('total_profit['.$key.']'); ?>" placeholder="<?php echo lang('total_profit'); ?>" readonly/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('total_profit'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- electric_water_expend -->
                                            <label class="col-md-2 label-heading" for="electric_water_expend"><?php echo lang('electric_water_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='electric_water_expend' name="electric_water_expend[]" value="<?php echo set_value('electric_water_expend['.$key.']') == false ? $buss->electric_water_expend : set_value('electric_water_expend['.$key.']'); ?>" placeholder="<?php echo lang('electric_water_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('electric_water_expend'); ?></span>       
                                            </div>
                                            <!-- salary_food_expend -->
                                            <label class="col-md-2 label-heading" for="salary_food_expend"><?php echo lang('salary_food_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='salary_food_expend' name="salary_food_expend[]" value="<?php echo set_value('salary_food_expend['.$key.']') == false ? $buss->salary_food_expend : set_value('salary_food_expend['.$key.']'); ?>" placeholder="<?php echo lang('salary_food_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('salary_food_expend'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- rent_house_expend -->
                                            <label class="col-md-2 label-heading" for="rent_house_expend"><?php echo lang('rent_house_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='rent_house_expend' name="rent_house_expend[]" value="<?php echo set_value('rent_house_expend['.$key.']') == false ? $buss->rent_house_expend : set_value('rent_house_expend['.$key.']'); ?>" placeholder="<?php echo lang('rent_house_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('rent_house_expend'); ?></span>       
                                            </div>
                                            <!-- insurance_expend -->
                                            <label class="col-md-2 label-heading" for="insurance_expend"><?php echo lang('insurance_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='insurance_expend' name="insurance_expend[]" value="<?php echo set_value('insurance_expend['.$key.']') == false ? $buss->insurance_expend : set_value('insurance_expend['.$key.']'); ?>" placeholder="<?php echo lang('insurance_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('insurance_expend'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- advertise_expend -->
                                            <label class="col-md-2 label-heading" for="advertise_expend"><?php echo lang('advertise_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='advertise_expend' name="advertise_expend[]" value="<?php echo set_value('advertise_expend['.$key.']') == false ? $buss->advertise_expend : set_value('advertise_expend['.$key.']'); ?>" placeholder="<?php echo lang('advertise_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('advertise_expend'); ?></span>       
                                            </div>
                                            <!-- loan_expend -->
                                            <label class="col-md-2 label-heading" for="loan_expend"><?php echo lang('loan_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='loan_expend' name="loan_expend[]" value="<?php echo set_value('loan_expend['.$key.']') == false ? $buss->loan_expend : set_value('loan_expend['.$key.']'); ?>" placeholder="<?php echo lang('loan_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('loan_expend'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- tax_expend -->
                                            <label class="col-md-2 label-heading" for="tax_expend"><?php echo lang('tax_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='tax_expend' name="tax_expend[]" value="<?php echo set_value('tax_expend['.$key.']') == false ? $buss->tax_expend : set_value('tax_expend['.$key.']'); ?>" placeholder="<?php echo lang('tax_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('tax_expend'); ?></span>       
                                            </div>
                                            <!-- others_expend -->
                                            <label class="col-md-2 label-heading" for="others_expend"><?php echo lang('others_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='others_expend' name="others_expend[]" value="<?php echo set_value('others_expend['.$key.']') == false ? $buss->others_expend : set_value('others_expend['.$key.']'); ?>" placeholder="<?php echo lang('others_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('others_expend'); ?></span>       
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <!-- total_expend -->
                                            <label class="col-md-2 label-heading" for="total_expend"><?php echo lang('total_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='total_expend' name="total_expend[]" value="<?php echo set_value('total_expend['.$key.']') == false ? $buss->total_expend : set_value('total_expend['.$key.']'); ?>" placeholder="<?php echo lang('total_expend'); ?>" readonly/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $key; ?>"><?php echo getCurrencyCode($business_currency); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('total_expend'); ?></span>       
                                            </div>
                                            <label class="col-md-2 label-heading" for="" id="addEmployment">
                                                <?php if($key > 0):?>
                                                    <!-- button add form -->
                                                    <a href="javascript:void(0)" title="Remove Form" onclick="removeBusiness('<?php echo $key;?>','<?php echo $business_plan_id;?>', '<?php echo $business_income_id;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                                <?php endif; ?>
                                                <a href="javascript:void(0)" title="Add Form" onclick="addBusiness();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                            </label>  
                                        </div>
                                    </div>
                                </div>
                            <?php if($key > 0){echo '</div>';}
                        endforeach;

                    elseif($this->input->post('identification_type')):
                        // append set_value                                                   
                        for ($i=0; $i < count($this->input->post('business_name')); $i++):
                            $business_plan_id = set_value('business_plan_id['.$i.']');
                            $business_income_id = set_value('business_income_id['.$i.']');
                            if($i > 0){ echo '<div id="removeBusiness'.$i.'"><hr>';} ?>

                                <input type="hidden" name="business_plan_id[]" value="<?php echo $business_plan_id; ?>">
                                <input type="hidden" name="business_income_id[]" value="<?php echo $business_income_id; ?>">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <!-- business_name -->
                                            <label class="col-md-2 label-heading" for="business_name<?php echo $i; ?>"><?php echo lang('business_name'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='business_name<?php echo $i; ?>' name="business_name[]" value="<?php echo set_value('business_name['.$i.']'); ?>" placeholder="<?php echo lang('business_name'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('business_name['.$i.']'); ?></span>       
                                            </div> 
                                            <!-- business_type -->
                                            <label class="col-md-2 label-heading" for="business_type<?php echo $i; ?>"><?php echo lang('business_type'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_type[]" id='business_type'>
                                                    <option value="">--- select business type ---</option>
                                                    <?php if(!empty($businessType)): ?>
                                                        <?php foreach ($businessType as $row):?>
                                                            <option value="<?php echo $row->id; ?>" <?php echo set_select('business_type['.$i.']', $row->id); ?>><?php echo $row->code.' - '.$row->name_kh; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_type['.$i.']'); ?></span>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- business_status -->
                                            <label class="col-md-2 label-heading" for="business_status<?php echo $i; ?>"><?php echo lang('business_status'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_status[]" id='business_status<?php echo $i; ?>'>
                                                    <option value="">--- select business status ---</option>
                                                    <?php if(!empty($businessStatus)): ?>
                                                        <?php foreach ($businessStatus as $row):?>
                                                            <option value="<?php echo $row->id; ?>" <?php echo set_select('business_status['.$i.']', $row->id); ?>><?php echo $row->name_kh; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_status['.$i.']'); ?></span>     
                                            </div>
                                            <!-- business_format -->
                                            <label class="col-md-2 label-heading" for="business_format<?php echo $i; ?>"><?php echo lang('business_format'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_format[]" id='business_format<?php echo $i; ?>'>
                                                    <option value="">--- select business type ---</option>
                                                    <?php if(!empty($businessFormat)): ?>
                                                        <?php foreach ($businessFormat as $row):?>
                                                            <option value="<?php echo $row->id; ?>" <?php echo set_select('business_format['.$i.']', $row->id); ?>><?php echo $row->name_kh; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_format['.$i.']'); ?></span>     
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- business_start -->
                                            <label class="col-md-2 label-heading" for="business_start"><?php echo lang('business_start'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='business_start<?php echo $i; ?>' name="business_start[]" value="<?php echo set_value('business_start['.$i.']'); ?>" placeholder="dd-mm-yyyy"/>
                                                <span class="text-danger"><?php echo form_error('business_start['.$i.']'); ?></span>       
                                            </div> 
                                            <!-- business_licence -->
                                            <label class="col-md-2 label-heading" for="business_licence<?php echo $i; ?>"><?php echo lang('business_licence'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='business_licence<?php echo $i; ?>' name="business_licence[]" value="<?php echo set_value('business_licence['.$i.']'); ?>" placeholder="<?php echo lang('business_licence'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('business_licence['.$i.']'); ?></span>     
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- employee_amount -->
                                            <label class="col-md-2 label-heading" for="employee_amount<?php echo $i; ?>"><?php echo lang('employee_amount'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="number" min="1" id='employee_amount<?php echo $i; ?>' name="employee_amount[]" value="<?php echo set_value('employee_amount['.$i.']'); ?>" placeholder="<?php echo lang('employee_amount'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('employee_amount['.$i.']'); ?></span>       
                                            </div> 
                                            <!-- man_employee_amount -->
                                            <label class="col-md-2 label-heading" for="man_employee_amount<?php echo $i; ?>"><?php echo lang('man_employee_amount'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="number" min="1" id='man_employee_amount<?php echo $i; ?>' name="man_employee_amount[]" value="<?php echo set_value('man_employee_amount['.$i.']'); ?>" placeholder="<?php echo lang('man_employee_amount'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('man_employee_amount['.$i.']'); ?></span>       
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <!-- business_country -->
                                            <label class="col-md-2 label-heading" for="business_country<?php echo $i; ?>"><?php echo lang('country'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessCountry('')" name="business_country[]" id="business_country<?php echo $i; ?>">
                                                    <option value="">--- Select Country ---</option>
                                                    <?php if(!empty($country)): ?>
                                                        <?php foreach($country as $row):?>
                                                            <option value="<?php echo $row->id?>" <?php echo set_select('business_country['.$i.']', $row->id); ?>><?php echo $row->name_en?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_country['.$i.']'); ?></span>  
                                            </div>
                                            <!-- business_province -->
                                            <label class="col-md-2 label-heading" for="business_province<?php echo $i; ?>"><?php echo lang('province'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessProvince('')" name="business_province[]" id="business_province<?php echo $i; ?>">
                                                    <?php echo selectedProvince(set_select('business_country['.$i.']'), set_select('business_province['.$i.']')); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_province['.$i.']'); ?></span>      
                                            </div> 
                                        </div>   
                                        <div class="form-group">                                               
                                            <!-- business_district -->
                                            <label class="col-md-2 label-heading" for="business_district<?php echo $i; ?>"><?php echo lang('district'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessDistrict('')" name="business_district[]" id="business_district<?php echo $i; ?>" >
                                                    <?php echo selectedDistrict(set_select('business_province['.$i.']'), set_select('business_district['.$i.']')); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_district'); ?></span>     
                                            </div>  
                                            <!-- business_commune -->
                                            <label class="col-md-2 label-heading" for="business_commune<?php echo $i; ?>"><?php echo lang('commune'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessCommune('')" id='business_commune<?php echo $i; ?>' name="business_commune[]">
                                                    <?php echo selectedCommune(set_select('business_district['.$i.']'), set_select('business_commune['.$i.']')); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_commune['.$i.']'); ?></span>       
                                            </div>                          
                                        </div>
                                        <div class="form-group">
                                            <!-- business_village -->
                                            <label class="col-md-2 label-heading" for="business_village<?php echo $i; ?>"><?php echo lang('village'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="business_village[]" id='business_village<?php echo $i; ?>'>
                                                    <?php echo selectedVillage(set_select('business_commune['.$i.']'), set_select('business_village['.$i.']')); ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('business_village['.$i.']'); ?></span>     
                                            </div>                           
                                            <!-- location_status -->
                                            <label class="col-md-2 label-heading" for="location_status<?php echo $i; ?>"><?php echo lang('location_status'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select class="form-control select2" style='width:100%' data-live-search="true" name="location_status[]" id="location_status<?php echo $i; ?>">
                                                    <option value="">--- select location status ---</option>
                                                    <?php if(!empty($businessLocationStatus)): ?>
                                                        <?php foreach($businessLocationStatus as $row):?>
                                                            <option value="<?php echo $row->id?>" <?php echo set_select('location_status['.$i.']', $row->id); ?>><?php echo $row->name_en?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('location_status['.$i.']'); ?></span>       
                                            </div>                         
                                        </div>    
                                        
                                        <!-- income & expend -->
                                        <legend>Income & Expend</legend>
                                        <div class="form-group">
                                            <!-- income_date -->
                                            <label class="col-md-2 label-heading" for="income_date<?php echo $i; ?>"><?php echo lang('income_date'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <input class='form-control'  type="text" id='income_date' name="income_date[]" value="<?php echo set_value('income_date['.$i.']'); ?>" placeholder="<?php echo lang('income_date'); ?>"/>
                                                <span class="text-danger"><?php echo form_error('income_date['.$i.']'); ?></span>       
                                            </div> 
                                            <!-- business_currency -->
                                            <label class="col-md-2 label-heading" for="business_currency<?php echo $i; ?>"><?php echo lang('currency'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <select name="business_currency[]" id="business_currency<?php echo $i; ?>" style='width:100%' data-live-search="true" class="form-control select2">
                                                      <option value="">--- select currency ---</option>
                                                      <?php if(!empty(listCurrency())): ?>
                                                          <?php foreach (listCurrency() as $curr): ?>
                                                            <option value="<?php echo $curr->id;?>" <?php echo set_select('business_currency['.$i.']', $curr->id); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                                          <?php endforeach; ?>
                                                      <?php endif; ?>
                                                    </select>
                                                <span class="text-danger"><?php echo form_error('business_currency['.$i.']'); ?></span>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <!-- business_profit -->
                                            <label class="col-md-2 label-heading" for="business_profit<?php echo $i; ?>"><?php echo lang('business_profit'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='business_profit<?php echo $i; ?>' name="business_profit[]" value="<?php echo set_value('business_profit['.$i.']'); ?>" placeholder="<?php echo lang('business_profit'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('business_profit['.$i.']'); ?></span>       
                                            </div>
                                            <!-- transport_cost -->
                                            <label class="col-md-2 label-heading" for="transport_cost<?php echo $i; ?>"><?php echo lang('transport_cost'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='transport_cost<?php echo $i; ?>' name="transport_cost[]" value="<?php echo set_value('transport_cost['.$i.']'); ?>" placeholder="<?php echo lang('transport_cost'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('transport_cost['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- repair_cost -->
                                            <label class="col-md-2 label-heading" for="repair_cost<?php echo $i; ?>"><?php echo lang('repair_cost'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='repair_cost<?php echo $i; ?>' name="repair_cost[]" value="<?php echo set_value('repair_cost['.$i.']'); ?>" placeholder="<?php echo lang('repair_cost'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('repair_cost['.$i.']'); ?></span>       
                                            </div>
                                            <!-- profit_before_tax -->
                                            <label class="col-md-2 label-heading" for="profit_before_tax<?php echo $i; ?>"><?php echo lang('profit_before_tax'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='profit_before_tax<?php echo $i; ?>' name="profit_before_tax[]" value="<?php echo set_value('profit_before_tax['.$i.']'); ?>" placeholder="<?php echo lang('profit_before_tax'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('profit_before_tax['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- income_after_tax -->
                                            <label class="col-md-2 label-heading" for="income_after_tax<?php echo $i; ?>"><?php echo lang('income_after_tax'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='income_after_tax<?php echo $i; ?>' name="income_after_tax[]" value="<?php echo set_value('income_after_tax['.$i.']'); ?>" placeholder="<?php echo lang('income_after_tax'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('income_after_tax['.$i.']'); ?></span>       
                                            </div>
                                            <!-- business_cost -->
                                            <label class="col-md-2 label-heading" for="business_cost<?php echo $i; ?>"><?php echo lang('business_cost'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='business_cost<?php echo $i; ?>' name="business_cost[]" value="<?php echo set_value('business_cost['.$i.']'); ?>" placeholder="<?php echo lang('business_cost'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('business_cost['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- other_profit -->
                                            <label class="col-md-2 label-heading" for="other_profit<?php echo $i; ?>"><?php echo lang('other_profit'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='other_profit<?php echo $i; ?>' name="other_profit[]" value="<?php echo set_value('other_profit['.$i.']'); ?>" placeholder="<?php echo lang('other_profit'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('other_profit['.$i.']'); ?></span>       
                                            </div>
                                            <!-- total_profit -->
                                            <label class="col-md-2 label-heading" for="total_profit<?php echo $i; ?>"><?php echo lang('total_profit'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='total_profit<?php echo $i; ?>' name="total_profit[]" value="<?php echo set_value('total_profit['.$i.']'); ?>" placeholder="<?php echo lang('total_profit'); ?>" readonly/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('total_profit['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- electric_water_expend -->
                                            <label class="col-md-2 label-heading" for="electric_water_expend<?php echo $i; ?>"><?php echo lang('electric_water_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='electric_water_expend<?php echo $i; ?>' name="electric_water_expend[]" value="<?php echo set_value('electric_water_expend['.$i.']'); ?>" placeholder="<?php echo lang('electric_water_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('electric_water_expend'); ?></span>       
                                            </div>
                                            <!-- salary_food_expend -->
                                            <label class="col-md-2 label-heading" for="salary_food_expend<?php echo $i; ?>"><?php echo lang('salary_food_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='salary_food_expend<?php echo $i; ?>' name="salary_food_expend[]" value="<?php echo set_value('salary_food_expend['.$i.']'); ?>" placeholder="<?php echo lang('salary_food_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('salary_food_expend['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- rent_house_expend -->
                                            <label class="col-md-2 label-heading" for="rent_house_expend<?php echo $i; ?>"><?php echo lang('rent_house_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='rent_house_expend<?php echo $i; ?>' name="rent_house_expend[]" value="<?php echo set_value('rent_house_expend['.$i.']'); ?>" placeholder="<?php echo lang('rent_house_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('rent_house_expend['.$i.']'); ?></span>       
                                            </div>
                                            <!-- insurance_expend -->
                                            <label class="col-md-2 label-heading" for="insurance_expend<?php echo $i; ?>"><?php echo lang('insurance_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='insurance_expend<?php echo $i; ?>' name="insurance_expend[]" value="<?php echo set_value('insurance_expend['.$i.']'); ?>" placeholder="<?php echo lang('insurance_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('insurance_expend['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- advertise_expend -->
                                            <label class="col-md-2 label-heading" for="advertise_expend<?php echo $i; ?>"><?php echo lang('advertise_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='advertise_expend<?php echo $i; ?>' name="advertise_expend[]" value="<?php echo set_value('advertise_expend['.$i.']'); ?>" placeholder="<?php echo lang('advertise_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('advertise_expend['.$i.']'); ?></span>       
                                            </div>
                                            <!-- loan_expend -->
                                            <label class="col-md-2 label-heading" for="loan_expend<?php echo $i; ?>"><?php echo lang('loan_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='loan_expend<?php echo $i; ?>' name="loan_expend[]" value="<?php echo set_value('loan_expend['.$i.']'); ?>" placeholder="<?php echo lang('loan_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('loan_expend['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- tax_expend -->
                                            <label class="col-md-2 label-heading" for="tax_expend<?php echo $i; ?>"><?php echo lang('tax_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='tax_expend<?php echo $i; ?>' name="tax_expend[]" value="<?php echo set_value('tax_expend['.$i.']'); ?>" placeholder="<?php echo lang('tax_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('tax_expend['.$i.']'); ?></span>       
                                            </div>
                                            <!-- others_expend -->
                                            <label class="col-md-2 label-heading" for="others_expend<?php echo $i; ?>"><?php echo lang('others_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='others_expend<?php echo $i; ?>' name="others_expend[]" value="<?php echo set_value('others_expend['.$i.']'); ?>" placeholder="<?php echo lang('others_expend'); ?>"/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('others_expend['.$i.']'); ?></span>       
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- total_expend -->
                                            <label class="col-md-2 label-heading" for="total_expend<?php echo $i; ?>"><?php echo lang('total_expend'); ?></label>
                                            <div class="col-md-4 ui-front">
                                                <div class="input-group">
                                                    <input class='form-control'  type="number" min="1" id='total_expend<?php echo $i; ?>' name="total_expend[]" value="<?php echo set_value('total_expend['.$i.']'); ?>" placeholder="<?php echo lang('total_expend'); ?>" readonly/>
                                                    <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign<?php echo $i; ?>"><?php echo getCurrencyCode(set_value('business_currency['.$i.']')); ?></span></div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error('total_expend['.$i.']'); ?></span>       
                                            </div>
                                            <label for="function" class="col-md-2 label-heading">
                                                <!-- button remove form -->
                                                <?php if($i > 0): ?>
                                                <a href="javascript:void(0)" title="Remove Form" onclick="removeBusiness('<?php echo $i;?>','<?php echo $employment_id; ?>',, '<?php echo $business_income_id;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                                <?php endif; ?> 
                                                <!-- button add form -->
                                                <a href="javascript:void(0)" title="Add Form" onclick="addBusiness();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php if($i > 0){echo '</div>';}
                        endfor;

                    else: ?>
                        <!-- form add default -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <!-- business_name -->
                                    <label class="col-md-2 label-heading" for="business_name"><?php echo lang('business_name'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='business_name' name="business_name[]" value="<?php echo set_value('business_name[0]'); ?>" placeholder="<?php echo lang('business_name'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('business_name[0]'); ?></span>       
                                    </div> 
                                    <!-- business_type -->
                                    <label class="col-md-2 label-heading" for="business_type"><?php echo lang('business_type'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="business_type[]" id='business_type'>
                                            <option value="">--- select business type ---</option>
                                            <?php if(!empty($businessType)): ?>
                                                <?php foreach ($businessType as $row):?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->code.' - '.$row->name_kh; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_type'); ?></span>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- business_status -->
                                    <label class="col-md-2 label-heading" for="business_status"><?php echo lang('business_status'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="business_status[]" id='business_status'>
                                            <option value="">--- select business status ---</option>
                                            <?php if(!empty($businessStatus)): ?>
                                                <?php foreach ($businessStatus as $row):?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_kh; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_status'); ?></span>     
                                    </div>
                                    <!-- business_format -->
                                    <label class="col-md-2 label-heading" for="business_format"><?php echo lang('business_format'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="business_format[]" id='business_format'>
                                            <option value="">--- select business type ---</option>
                                            <?php if(!empty($businessFormat)): ?>
                                                <?php foreach ($businessFormat as $row):?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_kh; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_format'); ?></span>     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- business_start -->
                                    <label class="col-md-2 label-heading" for="business_start"><?php echo lang('business_start'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='business_start' name="business_start[]" value="<?php echo set_value('business_start'); ?>" placeholder="dd-mm-yyyy"/>
                                        <span class="text-danger"><?php echo form_error('business_start'); ?></span>       
                                    </div> 
                                    <!-- business_licence -->
                                    <label class="col-md-2 label-heading" for="business_licence"><?php echo lang('business_licence'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='business_licence' name="business_licence[]" value="<?php echo set_value('business_licence'); ?>" placeholder="<?php echo lang('business_licence'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('business_licence'); ?></span>     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- employee_amount -->
                                    <label class="col-md-2 label-heading" for="employee_amount"><?php echo lang('employee_amount'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" min="1" id='employee_amount' name="employee_amount[]" value="<?php echo set_value('employee_amount'); ?>" placeholder="<?php echo lang('employee_amount'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('employee_amount'); ?></span>       
                                    </div> 
                                    <!-- man_employee_amount -->
                                    <label class="col-md-2 label-heading" for="man_employee_amount"><?php echo lang('man_employee_amount'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" min="1" id='man_employee_amount' name="man_employee_amount[]" value="<?php echo set_value('man_employee_amount'); ?>" placeholder="<?php echo lang('man_employee_amount'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('man_employee_amount'); ?></span>       
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <!-- business_country -->
                                    <label class="col-md-2 label-heading" for="business_country"><?php echo lang('country'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessCountry('')" name="business_country[]" id="business_country">
                                            <option value="">--- Select Country ---</option>
                                            <?php if(!empty($country)): ?>
                                                <?php foreach($country as $row):?>
                                                    <option value="<?php echo $row->id?>"><?php echo $row->name_en?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_country'); ?></span>  
                                    </div>
                                    <!-- business_province -->
                                    <label class="col-md-2 label-heading" for="business_province"><?php echo lang('province'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessProvince('')" name="business_province[]" id="business_province">
                                            <option value="">--- Province ---</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_province'); ?></span>      
                                    </div> 
                                </div>   
                                <div class="form-group">                                               
                                    <!-- business_district -->
                                    <label class="col-md-2 label-heading" for="business_district"><?php echo lang('district'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessDistrict('')" name="business_district[]" id="business_district" >
                                            <option value="">--- District ---</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_district'); ?></span>     
                                    </div>  
                                    <!-- business_commune -->
                                    <label class="col-md-2 label-heading" for="business_commune"><?php echo lang('commune'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectBusinessCommune('')" id='business_commune' name="business_commune[]">
                                            <option value="">--- Commune ---</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_commune'); ?></span>       
                                    </div>                          
                                </div>
                                <div class="form-group">
                                    <!-- business_village -->
                                    <label class="col-md-2 label-heading" for="business_village"><?php echo lang('village'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="business_village[]" id='business_village'>
                                            <option value="">--- Village ---</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('business_village'); ?></span>     
                                    </div>                           
                                    <!-- location_status -->
                                    <label class="col-md-2 label-heading" for="location_status"><?php echo lang('location_status'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style='width:100%' data-live-search="true" name="location_status[]" id="location_status">
                                            <option value="">--- select location status ---</option>
                                            <?php if(!empty($businessLocationStatus)): ?>
                                                <?php foreach($businessLocationStatus as $row):?>
                                                    <option value="<?php echo $row->id?>"><?php echo $row->name_en?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('location_status'); ?></span>       
                                    </div>                         
                                </div>    
                                
                                <!-- income & expend -->
                                <legend>Income & Expend</legend>
                                <div class="form-group">
                                    <!-- income_date -->
                                    <label class="col-md-2 label-heading" for="income_date"><?php echo lang('income_date'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="text" id='income_date' name="income_date[]" value="<?php echo set_value('income_date'); ?>" placeholder="<?php echo lang('income_date'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('income_date'); ?></span>       
                                    </div> 
                                    <!-- business_currency -->
                                    <label class="col-md-2 label-heading" for="business_currency"><?php echo lang('currency'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select name="business_currency[]" id="business_currency" style='width:100%' data-live-search="true" class="form-control select2">
                                              <option value="">--- select currency ---</option>
                                              <?php if(!empty(listCurrency())): ?>
                                                  <?php foreach (listCurrency() as $curr): ?>
                                                    <option value="<?php echo $curr->id;?>" <?php echo set_select('business_currency[0]', $curr->id); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                                  <?php endforeach; ?>
                                              <?php endif; ?>
                                            </select>
                                        <span class="text-danger"><?php echo form_error('business_currency[0]'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- business_profit -->
                                    <label class="col-md-2 label-heading" for="business_profit"><?php echo lang('business_profit'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='business_profit' name="business_profit[]" value="<?php echo set_value('business_profit'); ?>" placeholder="<?php echo lang('business_profit'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('business_profit[0]'); ?></span>       
                                    </div>
                                    <!-- transport_cost -->
                                    <label class="col-md-2 label-heading" for="transport_cost"><?php echo lang('transport_cost'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='transport_cost' name="transport_cost[]" value="<?php echo set_value('transport_cost'); ?>" placeholder="<?php echo lang('transport_cost'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('transport_cost'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- repair_cost -->
                                    <label class="col-md-2 label-heading" for="repair_cost"><?php echo lang('repair_cost'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='repair_cost' name="repair_cost[]" value="<?php echo set_value('repair_cost'); ?>" placeholder="<?php echo lang('repair_cost'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('repair_cost'); ?></span>       
                                    </div>
                                    <!-- profit_before_tax -->
                                    <label class="col-md-2 label-heading" for="profit_before_tax"><?php echo lang('profit_before_tax'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='profit_before_tax' name="profit_before_tax[]" value="<?php echo set_value('profit_before_tax'); ?>" placeholder="<?php echo lang('profit_before_tax'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('profit_before_tax'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- income_after_tax -->
                                    <label class="col-md-2 label-heading" for="income_after_tax"><?php echo lang('income_after_tax'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='income_after_tax' name="income_after_tax[]" value="<?php echo set_value('income_after_tax'); ?>" placeholder="<?php echo lang('income_after_tax'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('income_after_tax'); ?></span>       
                                    </div>
                                    <!-- business_cost -->
                                    <label class="col-md-2 label-heading" for="business_cost"><?php echo lang('business_cost'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='business_cost' name="business_cost[]" value="<?php echo set_value('business_cost'); ?>" placeholder="<?php echo lang('business_cost'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('business_cost'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- other_profit -->
                                    <label class="col-md-2 label-heading" for="other_profit"><?php echo lang('other_profit'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='other_profit' name="other_profit[]" value="<?php echo set_value('other_profit'); ?>" placeholder="<?php echo lang('other_profit'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('other_profit'); ?></span>       
                                    </div>
                                    <!-- total_profit -->
                                    <label class="col-md-2 label-heading" for="total_profit"><?php echo lang('total_profit'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='total_profit' name="total_profit[]" value="<?php echo set_value('total_profit'); ?>" placeholder="<?php echo lang('total_profit'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('total_profit'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- electric_water_expend -->
                                    <label class="col-md-2 label-heading" for="electric_water_expend"><?php echo lang('electric_water_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='electric_water_expend' name="electric_water_expend[]" value="<?php echo set_value('electric_water_expend'); ?>" placeholder="<?php echo lang('electric_water_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('electric_water_expend'); ?></span>       
                                    </div>
                                    <!-- salary_food_expend -->
                                    <label class="col-md-2 label-heading" for="salary_food_expend"><?php echo lang('salary_food_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='salary_food_expend' name="salary_food_expend[]" value="<?php echo set_value('salary_food_expend'); ?>" placeholder="<?php echo lang('salary_food_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('salary_food_expend'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- rent_house_expend -->
                                    <label class="col-md-2 label-heading" for="rent_house_expend"><?php echo lang('rent_house_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='rent_house_expend' name="rent_house_expend[]" value="<?php echo set_value('rent_house_expend'); ?>" placeholder="<?php echo lang('rent_house_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('rent_house_expend'); ?></span>       
                                    </div>
                                    <!-- insurance_expend -->
                                    <label class="col-md-2 label-heading" for="insurance_expend"><?php echo lang('insurance_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='insurance_expend' name="insurance_expend[]" value="<?php echo set_value('insurance_expend'); ?>" placeholder="<?php echo lang('insurance_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('insurance_expend'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- advertise_expend -->
                                    <label class="col-md-2 label-heading" for="advertise_expend"><?php echo lang('advertise_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='advertise_expend' name="advertise_expend[]" value="<?php echo set_value('advertise_expend'); ?>" placeholder="<?php echo lang('advertise_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('advertise_expend'); ?></span>       
                                    </div>
                                    <!-- loan_expend -->
                                    <label class="col-md-2 label-heading" for="loan_expend"><?php echo lang('loan_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='loan_expend' name="loan_expend[]" value="<?php echo set_value('loan_expend'); ?>" placeholder="<?php echo lang('loan_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('loan_expend'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- tax_expend -->
                                    <label class="col-md-2 label-heading" for="tax_expend"><?php echo lang('tax_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='tax_expend' name="tax_expend[]" value="<?php echo set_value('tax_expend'); ?>" placeholder="<?php echo lang('tax_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('tax_expend'); ?></span>       
                                    </div>
                                    <!-- others_expend -->
                                    <label class="col-md-2 label-heading" for="others_expend"><?php echo lang('others_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='others_expend' name="others_expend[]" value="<?php echo set_value('others_expend'); ?>" placeholder="<?php echo lang('others_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('others_expend'); ?></span>       
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <!-- total_expend -->
                                    <label class="col-md-2 label-heading" for="total_expend"><?php echo lang('total_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <div class="input-group">
                                            <input class='form-control'  type="number" min="1" id='total_expend' name="total_expend[]" value="<?php echo set_value('total_expend'); ?>" placeholder="<?php echo lang('total_expend'); ?>"/>
                                            <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="business_currency_sign">USD</span></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error('total_expend'); ?></span>       
                                    </div>
                                    <!-- button add form -->
                                    <label class="col-md-2 label-heading" for="" id="addBusiness">
                                        <a href="javascript:void(0)" title="Add Form" onclick="addBusiness();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                    </label>  
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- append main app to here -->
                    <div class="append-business"></div>              
                </div>
                <!-- end business address info-->

                <!-- Income Expend -->
                <div id="incomeexpend" class="tab-pane fade">
                    <legend>Personal Income & Expend</legend>
                    <input type="hidden" name="personal_income_id" value="<?php echo set_value('personal_income_id') == false ? (!empty($personalInExs) ? $personalInExs->personal_income_id : '') : set_value('personal_income_id'); ?>">
                    <div class="form-group">
                        <!-- personal_currency -->
                        <label class="col-md-2 label-heading" for="personal_currency"><?php echo lang('currency'); ?></label>
                        <div class="col-md-4 ui-front">
                            <select name="personal_currency" id="personal_currency" style='width:100%' onchange="personalCurrency('');" data-live-search="true" class="form-control select2">
                                  <?php if(!empty(listCurrency())): ?>
                                    <?php 
                                    $personal_currency = null;
                                    if(!empty($personalInExs)){
                                        $personal_currency = $personalInExs->personal_currency;
                                        if(set_value('personal_currency') != false){
                                            $personal_currency = set_value('personal_currency');   
                                        }                                 
                                    }?>
                                      <?php foreach (listCurrency() as $curr): ?>
                                        <option value="<?php echo $curr->id;?>" <?php echo ($personal_currency == $curr->id ? 'selected' : ''); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                      <?php endforeach; ?>
                                  <?php endif; ?>
                                </select>
                            <span class="text-danger"><?php echo form_error('personal_currency'); ?></span>
                        </div>
                        <!-- personal_profit -->
                        <label class="col-md-2 label-heading" for="personal_profit"><?php echo lang('profit'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_profit' name="personal_profit" value="<?php echo set_value('personal_profit') == false ? (!empty($personalInExs) ? $personalInExs->personal_profit : '') : set_value('personal_profit'); ?>" placeholder="<?php echo lang('profit'); ?>"/>
                               <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_profit'); ?></span>       
                        </div>
                    </div>
                    <div class="form-group"> 
                        <!-- personal_income_salary -->
                        <label class="col-md-2 label-heading" for="personal_income_salary"><?php echo lang('income_salary'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_income_salary' name="personal_income_salary" value="<?php echo set_value('personal_income_salary') == false ? (!empty($personalInExs) ? $personalInExs->personal_income_salary : '') : set_value('personal_income_salary'); ?>" placeholder="<?php echo lang('personal_income_salary'); ?>"/>
                                 <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_income_salary'); ?></span>       
                        </div>
                        <!-- personal_other_profit -->
                        <label class="col-md-2 label-heading" for="personal_other_profit"><?php echo lang('other_profit'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_other_profit' name="personal_other_profit" value="<?php echo set_value('personal_other_profit') == false ? (!empty($personalInExs) ? $personalInExs->personal_other_profit : '') : set_value('personal_other_profit'); ?>" placeholder="<?php echo lang('other_profit'); ?>"/>
                                 <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_other_profit'); ?></span>       
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- total_income -->
                        <label class="col-md-2 label-heading" for="total_income"><?php echo lang('total_income'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='total_income' name="total_income" value="<?php echo set_value('total_income') == false ? (!empty($personalInExs) ? $personalInExs->total_income : '') : set_value('total_income'); ?>" placeholder="<?php echo lang('total_income'); ?>" readonly/>
                               <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('total_income'); ?></span>       
                        </div>
                        <!-- personal_food_expend -->
                        <label class="col-md-2 label-heading" for="personal_food_expend"><?php echo lang('expend_food'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_food_expend' name="personal_food_expend" value="<?php echo set_value('personal_food_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_food_expend : '') : set_value('personal_food_expend'); ?>" placeholder="<?php echo lang('expend_food'); ?>"/>
                                 <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_food_expend'); ?></span>       
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- personal_clothes_expend -->
                        <label class="col-md-2 label-heading" for="personal_clothes_expend"><?php echo lang('expend_cloth'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_clothes_expend' name="personal_clothes_expend" value="<?php echo set_value('personal_clothes_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_clothes_expend : '') : set_value('personal_clothes_expend'); ?>" placeholder="<?php echo lang('expend_cloth'); ?>"/>
                               <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_clothes_expend'); ?></span>       
                        </div>
                        <!-- personal_media_expend -->
                        <label class="col-md-2 label-heading" for="personal_media_expend"><?php echo lang('expend_media'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_media_expend' name="personal_media_expend" value="<?php echo set_value('personal_media_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_media_expend : '') : set_value('personal_media_expend'); ?>" placeholder="<?php echo lang('expend_media'); ?>"/>
                                 <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_media_expend'); ?></span>       
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- personal_insurance_expend -->
                        <label class="col-md-2 label-heading" for="personal_insurance_expend"><?php echo lang('expend_insurance'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_insurance_expend' name="personal_insurance_expend" value="<?php echo set_value('personal_insurance_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_insurance_expend : '') : set_value('personal_insurance_expend'); ?>" placeholder="<?php echo lang('expend_insurance'); ?>"/>
                               <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_insurance_expend'); ?></span>       
                        </div>
                        <!-- personal_electric_expend -->
                        <label class="col-md-2 label-heading" for="personal_electric_expend"><?php echo lang('electric_water_expend'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_electric_expend' name="personal_electric_expend" value="<?php echo set_value('personal_electric_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_electric_expend : '') : set_value('personal_electric_expend'); ?>" placeholder="<?php echo lang('electric_water_expend'); ?>"/>
                               <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_electric_expend'); ?></span>       
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- personal_repare_expend -->
                        <label class="col-md-2 label-heading" for="personal_repare_expend"><?php echo lang('expend_repare'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_repare_expend' name="personal_repare_expend" value="<?php echo set_value('personal_repare_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_repare_expend : '') : set_value('personal_repare_expend'); ?>" placeholder="<?php echo lang('expend_repare'); ?>"/>
                                 <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_repare_expend'); ?></span>       
                        </div>
                        <!-- personal_other_expend -->
                        <label class="col-md-2 label-heading" for="personal_other_expend"><?php echo lang('others_expend'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_other_expend' name="personal_other_expend" value="<?php echo set_value('personal_other_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_other_expend : '') : set_value('personal_other_expend'); ?>" placeholder="<?php echo lang('others_expend'); ?>"/>
                                 <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_other_expend'); ?></span>       
                        </div>
                    </div>   
                    <div class="form-group">
                        <!-- possibility_pay -->
                        <label class="col-md-2 label-heading" for="possibility_pay"><?php echo lang('possibility_pay'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='possibility_pay' name="possibility_pay" value="<?php echo set_value('possibility_pay') == false ? (!empty($personalInExs) ? $personalInExs->possibility_pay : '') : set_value('possibility_pay'); ?>" placeholder="<?php echo lang('possibility_pay'); ?>"/>
                               <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('possibility_pay'); ?></span>       
                        </div>
                        <!-- personal_total_expend -->
                        <label class="col-md-2 label-heading" for="personal_total_expend"><?php echo lang('total_expend'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                                <input class='form-control'  type="number" min="1" id='personal_total_expend' name="personal_total_expend" value="<?php echo set_value('personal_total_expend') == false ? (!empty($personalInExs) ? $personalInExs->personal_total_expend : '') : set_value('personal_total_expend'); ?>" placeholder="<?php echo lang('total_expend'); ?>" readonly/>
                                 <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span class="personal_currency_sign"><?php echo (set_value('personal_currency') != false ? getCurrencyCode(set_value('personal_currency')) : getCurrencyCode($personal_currency)); ?></span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('personal_total_expend'); ?></span>       
                        </div>
                    </div>         
                </div>
                <!-- end income expend --> 

                <!-- attachment fles-->
                <div id="attachment" class="tab-pane fade">
                    <legend><h4><?php echo lang("attachment").' '.lang("files"); ?></h4></legend>
                    <!-- list existing files -->
                    <?php if(!empty($attachments)): ?>       
                        <input type="hidden" id="attachment_file_deleted" name="attachment_file_deleted" value="<?php echo set_value('attachment_file_deleted'); ?>">                 
                        <input type="hidden" id="attachment_file_path" name="attachment_file_path" value="<?php echo set_value('attachment_file_path'); ?>">                 
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
                </div>
                <!-- End attachment files -->                                      
            </div>    
            <!-- button action -->
            <div class="text-right">
                <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Close</a> 
            </div>
            
        <?php echo form_close(); ?>
        </div>
        <div class="panel-footer"><b>created by:</b> <?php echo getUserFullName($customer->created_by); ?> <b>| created at:</b> <?php echo $customer->created_at; ?>
        <?php if($customer->updated_by != null): ?>
            | <b>updated by:</b> <?php echo getUserFullName($customer->updated_by); ?> <b>| updated at:</b> <?php echo $customer->updated_at; ?> </div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();

    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });

    // show business info if existing
    var business_existing = <?php echo (!empty($businessPlans) ? count($businessPlans) : 0); ?>;
    if(business_existing != 0){
        // $('li#active-business').show();// remove li of business
        $('li#active-employment').after('<li id="active-business"><a data-toggle="tab" href="#business"><?php echo lang('business'); ?></a></li>');
    }
</script>

