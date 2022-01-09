<!-- from add$link.  -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>
<div class="white-area-content">
    <!-- label header -->
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("add").' '.lang("customer_info") ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal")) ?>
                <ul class="nav nav-tabs">
                    <li class="active" id="active-customer"><a data-toggle="tab" href="#customer"><?php echo lang('customer'); ?> Info</a></li>
                    <li id="active-contact"><a data-toggle="tab" href="#contact"><?php echo lang('contact'); ?></a></li>
                    <li id="active-identification"><a data-toggle="tab" href="#identification"><?php echo lang('identification'); ?></a></li>
                    <!-- <li><a data-toggle="tab" href="#classification"><?php// echo lang('classification'); ?></a></li> -->
                    <li id="active-employment"><a data-toggle="tab" href="#employment"><?php echo lang('employment'); ?></a></li>
                    <li id="active-business"><a data-toggle="tab" href="#business"><?php echo lang('business'); ?></a></li>
                    <li id="active-incomeexpend"><a data-toggle="tab" href="#incomeexpend"><?php echo lang('income').' '.lang('expend'); ?></a></li>
                </ul><br>

                <div class="tab-content">                    
                    <!-- Customer info -->
                    <div id="customer" class="tab-pane fade in active">
                        <div class="form-group">
                            <!-- firstname_kh -->
                            <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang('firstname_kh'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control' type="text" name="firstname_kh" id="firstname_kh" value="<?php echo set_value('firstname_kh'); ?>" placeholder="<?php echo lang('firstname_kh'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('firstname_kh'); ?></span>
                            </div>
                            <!-- lastname_kh -->
                            <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang('lastname_kh'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control' type="text" name="lastname_kh" id="lastname_kh" value="<?php echo set_value('lastname_kh'); ?>" placeholder="<?php echo lang('lastname_kh'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('lastname_kh'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- firstname_en -->
                            <label class="col-md-2 label-heading" for="firstname_en"><?php echo lang('firstname_en'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control' type="text" name="firstname_en" id="firstname_en" value="<?php echo set_value('firstname_en'); ?>" placeholder="<?php echo lang('firstname_en'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('firstname_en'); ?></span>
                            </div>
                            <!-- lastname_en -->
                            <label class="col-md-2 label-heading" for="lastname_en"><?php echo lang('lastname_en'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control' type="text" name="lastname_en" id="lastname_en" value="<?php echo set_value('lastname_en'); ?>" placeholder="<?php echo lang('lastname_en'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('lastname_en'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo set_select('salutation'); ?>
                            <!-- salutation -->
                            <label class="col-md-2 label-heading" for="salutation"><?php echo lang('salutation'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="salutation" required>
                                    <option value="">--- Salutation ---</option>
                                    <option value="Mr" <?php echo (set_value('salutation') == 'Mr' ? 'selected' : ''); ?>>Mr</option>
                                    <option value="Mrs" <?php echo (set_value('salutation') == 'Mrs' ? 'selected' : ''); ?>>Mrs</option>
                                    <option value="Miss" <?php echo (set_value('salutation') == 'Miss' ? 'selected' : ''); ?>>Miss</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('salutation'); ?></span> 
                            </div>
                            <!-- gender -->
                            <label class="col-md-2 label-heading" for="gender"><?php echo lang('gender'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="gender" required>
                                    <option value="">--- Gender * ---</option>
                                    <option value="M" <?php echo (set_value('gender') == 'M' ? 'selected' : ''); ?>>Male</option>
                                    <option value="F" <?php echo (set_value('gender') == 'F' ? 'selected' : ''); ?>>Female</option>
                                    <option value="O" <?php echo (set_value('gender') == 'O' ? 'selected' : ''); ?>>Other</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('gender'); ?></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- dob -->
                            <label class="col-md-2 label-heading" for="dob"><?php echo lang('dob'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" name="dob" id="dob" value="<?php echo set_value('dob'); ?>" placeholder="dd-mm-yyyy" required/>
                                <span class="text-danger"><?php echo form_error('dob'); ?></span>    
                            </div>
                            <!-- nationality -->
                            <label class="col-md-2 label-heading" for="nationality"><?php echo lang('nationality'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="nationality">
                                    <?php if(!empty($nationality)): ?>
                                        <?php foreach($nationality as $row):?>
                                            <option value="<?php echo $row->id;?>" <?php echo (set_value('nationality') == $row->id ? 'selected' : ''); ?>><?php echo $row->name_kh?></option>
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
                                    <?php if(!empty($country)): ?>
                                        <?php foreach($country as $row):?>
                                            <option value="<?php echo $row->id?>" <?php echo (set_value('dob_country') == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('dob_country'); ?></span>  
                            </div>
                            <!-- dob_province -->
                            <label class="col-md-2 label-heading" for="dob_province"><?php echo lang('province'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="dob_province" id="province_dropdown" required>
                                    <?php echo selectedProvince(set_value('dob_country'), set_value('dob_province')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('dob_province'); ?></span>      
                            </div>
                        </div>
                        <div class="form-group">                            
                            <!-- dob_district -->
                            <label class="col-md-2 label-heading" for="dob_district"><?php echo lang('district'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="dob_district" id="district_dropdown" required>
                                    <?php echo selectedDistrict(set_value('dob_province'), set_value('dob_district')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('dob_district'); ?></span>     
                            </div>
                            <!-- dob_commune -->
                            <label class="col-md-2 label-heading" for="dob_commune"><?php echo lang('commune'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" id='commune_dropdown' name="dob_commune" required>
                                    <?php echo selectedCommune(set_value('dob_district'), set_value('dob_commune')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('dob_commune'); ?></span>       
                            </div>                            
                        </div>
                        <div class="form-group">
                            <!-- dob_village -->
                            <label class="col-md-2 label-heading" for="dob_village"><?php echo lang('village'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="dob_village" id='village_dropdown' required>
                                    <?php echo selectedVillage(set_value('dob_commune'), set_value('dob_village')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('dob_village'); ?></span>     
                            </div>
                            <!-- marital_status -->
                            <label class="col-md-2 label-heading" for="marital_status"><?php echo lang('marital_status'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" id="marital_status" name="marital_status" required>
                                    <option value="">--- Marital Status * ---</option>
                                    <option value="S" <?php echo (set_value('marital_status') == 'S' ? 'selected' : ''); ?>>Single</option>
                                    <option value="M" <?php echo (set_value('marital_status') == 'M' ? 'selected' : ''); ?>>Married</option>
                                    <option value="D" <?php echo (set_value('marital_status') == 'D' ? 'selected' : ''); ?>>Divorced</option>
                                    <option value="W" <?php echo (set_value('marital_status') == 'W' ? 'selected' : ''); ?>>Window</option>
                                    <option value="Windower" <?php echo (set_value('marital_status') == 'Windower' ? 'selected' : ''); ?>>Windower</option>
                                    <option value="Separated" <?php echo (set_value('marital_status') == 'Separated' ? 'selected' : ''); ?>>Separated</option>
                                    <option value="Defacto" <?php echo (set_value('marital_status') == 'Defacto' ? 'selected' : ''); ?>>Defacto</option>
                                    <option value="U" <?php echo (set_value('marital_status') == 'U' ? 'selected' : ''); ?>>Unknown</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('marital_status'); ?></span>        
                            </div>
                        </div>
                        <div class="form-group">                            
                            <!-- house_ownership -->
                            <label class="col-md-2 label-heading" for="house_ownership"><?php echo lang('house_ownership'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="house_ownership" required>
                                    <option value="">--- House Owndership ---</option>
                                    <option value="Owner" <?php echo (set_value('house_ownership') == 'Owner' ? 'selected' : ''); ?>>Owner</option>
                                    <option value="Family" <?php echo (set_value('house_ownership') == 'Family' ? 'selected' : ''); ?>>Family</option>
                                    <option value="Sibling" <?php echo (set_value('house_ownership') == 'Sibling' ? 'selected' : ''); ?>>Sibling</option>
                                    <option value="Other Relative" <?php echo (set_value('house_ownership') == 'Other Relative' ? 'selected' : ''); ?>>Other Relative</option>
                                    <option value="Friend" <?php echo (set_value('house_ownership') == 'Friend' ? 'selected' : ''); ?>>Friend</option>
                                    <option value="Rental" <?php echo (set_value('house_ownership') == 'Rental' ? 'selected' : ''); ?>>Rental</option>
                                    <option value="Other" <?php echo (set_value('house_ownership') == 'Other' ? 'selected' : ''); ?>>Other</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('house_ownership'); ?></span>       
                            </div>
                            <!-- family_member -->
                            <label class="col-md-2 label-heading" for="family_member"><?php echo lang('family_member'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='family_member' name="family_member" value="<?php echo set_value('family_member'); ?>" placeholder="<?php echo lang('family_member'); ?>"  required/>
                                <span class="text-danger"><?php echo form_error('family_member'); ?></span>       
                            </div>                            
                        </div>
                        <div class="form-group">
                            <!-- active_member -->
                            <label class="col-md-2 label-heading" for="active_member"><?php echo lang('active_member'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" name="active_member" value="<?php echo set_value('active_member'); ?>" placeholder="<?php echo lang('active_member'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('active_member'); ?></span>        
                            </div>
                            <!-- resident -->
                            <label class="col-md-2 label-heading" for="resident"><?php echo lang('resident'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="resident">
                                    <option value="RESID" <?php echo (set_value('resident') == 'RESID' ? 'selected' : ''); ?>>Resident</option>
                                    <option value="NO" <?php echo (set_value('resident') == 'NO' ? 'selected' : ''); ?>>NO</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('resident'); ?></span>       
                            </div>
                        </div>
                        <div class="form-group"> 
                            <!-- sector -->
                            <label class="col-md-2 label-heading" for="sector"><?php echo lang('sector'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' onchange="selectSector()" data-live-search="true" id="sector" name="sector" required>
                                    <option value="">--- select sector ---</option>
                                    <?php if(!empty($sector)): ?>
                                        <?php foreach($sector as $row):?>
                                            <option value="<?php echo $row->id;?>" <?php echo (set_value('sector') == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('sector'); ?></span>     
                            </div>
                            <!-- industry -->
                            <label class="col-md-2 label-heading" for="industry"><?php echo lang('industry'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" id="industry" name="industry" required>
                                    <?php echo selectedIndustry(set_value('sector'), set_value('industry')); ?>
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
                                    <option value="">--- As Guarantor ---</option>
                                    <option value="YES" <?php echo (set_value('guarantor') == 'YES' ? 'selected' : ''); ?>>YES</option>
                                    <option value="NO" <?php echo (set_value('guarantor') == 'NO' ? 'selected' : ''); ?>>NO</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('guarantor'); ?></span>       
                            </div>
                            <!-- officer -->
                            <label class="col-md-2 label-heading" for="officer"><?php echo lang('officer'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="officer" required>
                                    <option value=""> -- <?php echo lang('officer'); ?> -- </option>
                                    <?php if(!empty(findOfficer())): ?>
                                        <?php foreach (findOfficer() as $user):?>
                                            <option value="<?php echo $user->ID; ?>" <?php echo (set_value('officer') == $user->ID ? 'selected' : ''); ?>><?php echo $user->first_name . ' ' . $user->last_name; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('officer'); ?></span>         
                            </div>
                        </div>


                        <!-- spouse info -->
                        <fieldset id="spouse-info">
                            <?php if($this->input->post('spouse_firstname_kh') != null): ?>
                                <legend>Spouse Info</legend>
                                <div class="form-group">
                                    <!-- spouse_firstname_kh -->
                                        <label class="col-md-2 label-heading" for="spouse_firstname_kh"><?php echo lang("firstname_kh"); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class="form-control" type="text" name="spouse_firstname_kh" id="spouse_firstname_kh" value="<?php echo set_value("spouse_firstname_kh"); ?>" placeholder="<?php echo lang("firstname_kh"); ?>" required/>
                                            <span class="text-danger"><?php echo form_error("spouse_firstname_kh"); ?></span>
                                        </div>
                                        <!-- spouse_lastname_kh -->
                                        <label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang("lastname_kh"); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class="form-control" type="text" name="spouse_lastname_kh" id="spouse_lastname_kh" value="<?php echo set_value("spouse_lastname_kh"); ?>" placeholder="<?php echo lang("lastname_kh"); ?>" required/>
                                            <span class="text-danger"><?php echo form_error("spouse_lastname_kh"); ?></span>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!-- spouse_firstname_en -->
                                    <label class="col-md-2 label-heading" for="spouse_firstname_en"><?php echo lang("firstname_en"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class="form-control" type="text" name="spouse_firstname_en" id="spouse_firstname_en" value="<?php echo set_value("spouse_firstname_en"); ?>" placeholder="<?php echo lang("firstname_en"); ?>" required/>
                                        <span class="text-danger"><?php echo form_error("spouse_firstname_en"); ?></span>
                                    </div>
                                    <!-- spouse_lastname_en -->
                                    <label class="col-md-2 label-heading" for="spouse_lastname_en"><?php echo lang("lastname_en"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class="form-control" type="text" name="spouse_lastname_en" id="spouse_lastname_en" value="<?php echo set_value("spouse_lastname_en"); ?>" placeholder="<?php echo lang("lastname_en"); ?>" required/>
                                        <span class="text-danger"><?php echo form_error("spouse_lastname_en"); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- spouse_dob -->
                                    <label class="col-md-2 label-heading" for="spouse_dob"><?php echo lang("dob"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class="form-control"  type="text" name="spouse_dob" id="spouse_dob" value="<?php echo set_value("spouse_dob"); ?>" placeholder="dd-mm-yyyy" required/>
                                        <span class="text-danger"><?php echo form_error("spouse_dob"); ?></span>    
                                    </div>
                                    <!-- spouse_nationality -->
                                    <label class="col-md-2 label-heading" for="spouse_nationality"><?php echo lang("nationality"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style="width:100%" data-live-search="true" name="spouse_nationality">
                                            <?php if(!empty($nationality)): ?>
                                                <?php foreach($nationality as $row):?>
                                                    <option value="<?php echo $row->id;?>" <?php echo (set_value('spouse_nationality') == $row->id ? 'selected' : ''); ?>><?php echo $row->name_kh?></option>
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
                                        <input class="form-control"  type="text" name="spouse_occupation" id="spouse_occupation" value="<?php echo set_value("spouse_occupation"); ?>" placeholder="<?php echo lang("occupation"); ?>" required/>
                                        <span class="text-danger"><?php echo form_error("spouse_occupation"); ?></span>    
                                    </div>
                                    <!-- spouse_id_type -->
                                    <label class="col-md-2 label-heading" for="spouse_id_type"><?php echo lang("id_type"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <select class="form-control select2" style="width:100%" data-live-search="true" id="spouse_id_type" name="spouse_id_type">
                                            <option value="">--- select id type ---</option>
                                            <?php if(!empty($identificationType)): ?>
                                                <?php foreach($identificationType as $row):?>
                                                    <option value="<?php echo $row->id;?>" <?php echo (set_value('spouse_id_type') == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
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
                                        <input class="form-control"  type="text" id="spouse_id_code" name="spouse_id_code" value="<?php echo set_value("spouse_id_code"); ?>" placeholder="<?php echo lang("id_code"); ?>" required/>
                                        <span class="text-danger"><?php echo form_error("spouse_id_code"); ?></span>       
                                    </div> 
                                    <!-- spouse_issue_date -->
                                    <label class="col-md-2 label-heading" for="spouse_issue_date"><?php echo lang("issue_date"); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class="form-control"  type="text" id="spouse_issue_date" name="spouse_issue_date" value="<?php echo set_value("spouse_issue_date"); ?>" placeholder="dd-mm-yyyy" required/>
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
                        <div class="form-group">
                            <!-- country_id -->
                            <label class="col-md-2 label-heading" for="country_id"><?php echo lang('country'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectCountry('')" name="country_id[]" id="country_id" required>
                                    <option value="">--- Select Country ---</option>
                                    <?php if(!empty($country)): ?>
                                        <?php foreach($country as $row):?>
                                            <option value="<?php echo $row->id?>" <?php echo (set_value('country_id[0]') == $row->id ? 'selected' : ''); ?>><?php echo $row->name_en?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('country_id[0]'); ?></span>  
                            </div>
                            <!-- <?php// var_dump(set_value('province_id[0]'));die(); ?> -->
                            <!-- province_id -->
                            <label class="col-md-2 label-heading" for="province_id"><?php echo lang('province'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectProvince('')" name="province_id[]" id="province_id" required>
                                    <?php echo selectedProvince(set_value('country_id[0]'), set_value('province_id[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('province_id[0]'); ?></span>      
                            </div>
                        </div>
                        <div class="form-group">                            
                            <!-- district_id -->
                            <label class="col-md-2 label-heading" for="district_id"><?php echo lang('district'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectDistrict('')" name="district_id[]" id="district_id" required>
                                    <?php echo selectedDistrict(set_value('province_id[0]'), set_value('district_id[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('district_id[0]'); ?></span>     
                            </div>
                            <!-- commune_id -->
                            <label class="col-md-2 label-heading" for="commune_id"><?php echo lang('commune'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectCommune('')" id='commune_id' name="commune_id[]" required>
                                    <?php echo selectedCommune(set_value('district_id[0]'), set_value('commune_id[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('commune_id[0]'); ?></span>       
                            </div>                            
                        </div>
                        <div class="form-group">
                            <!-- village_id -->
                            <label class="col-md-2 label-heading" for="village_id"><?php echo lang('village'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="village_id[]" id='village_id' required>
                                    <?php echo selectedVillage(set_value('commune_id[0]'), set_value('village_id[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('village_id[0]'); ?></span>     
                            </div>
                            <!-- city -->
                            <label class="col-md-2 label-heading" for="city"><?php echo lang('city'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='city' name="city[]" value="<?php echo set_value('city[0]'); ?>" placeholder="<?php echo lang('city'); ?>"/>
                                <span class="text-danger"><?php echo form_error('city[0]'); ?></span>       
                            </div> 
                        </div>
                        <div class="form-group">                            
                            <!-- house_no -->
                            <label class="col-md-2 label-heading" for="house_no"><?php echo lang('house_no'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='house_no' name="house_no[]" value="<?php echo set_value('house_no[0]'); ?>" placeholder="<?php echo lang('house_no'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('house_no[0]'); ?></span>       
                            </div> 
                            <!-- street -->
                            <label class="col-md-2 label-heading" for="street"><?php echo lang('street'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='street' name="street[]" value="<?php echo set_value('street[0]'); ?>" placeholder="<?php echo lang('street'); ?>"  required/>
                                <span class="text-danger"><?php echo form_error('street[0]'); ?></span>       
                            </div>                            
                        </div>    
                        <div class="form-group">                            
                            <!-- phone1 -->
                            <label class="col-md-2 label-heading" for="phone1"><?php echo lang('phone1'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='phone1' name="phone1[]" value="<?php echo set_value('phone1[0]'); ?>" placeholder="0123456789"  required/>
                                <span class="text-danger"><?php echo form_error('phone1[0]'); ?></span>       
                            </div> 
                            <!-- phone2 -->
                            <label class="col-md-2 label-heading" for="phone2"><?php echo lang('phone2'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='phone2' name="phone2[]" value="<?php echo set_value('phone2[0]'); ?>" placeholder="0123456789"/>
                                <span class="text-danger"><?php echo form_error('phone2[0]'); ?></span>       
                            </div>                            
                        </div>   
                        <div class="form-group">                            
                            <!-- email -->
                            <label class="col-md-2 label-heading" for="email"><?php echo lang('email'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="email" id='email' name="email[]" value="<?php echo set_value('email[0]'); ?>" placeholder="example@gmail.com"  required/>
                                <span class="text-danger"><?php echo form_error('email[0]'); ?></span>       
                            </div> 
                            <!-- map_latitude -->
                            <label class="col-md-2 label-heading" for="map_latitude"><?php echo lang('map_latitude'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='map_latitude' name="map_latitude[]" value="<?php echo set_value('map_latitude[0]'); ?>" placeholder="<?php echo lang('map_latitude'); ?>"/>
                                <span class="text-danger"><?php echo form_error('map_latitude[0]'); ?></span>       
                            </div>                            
                        </div> 
                        <div class="form-group"> 
                            <!-- map_longitude -->
                            <label class="col-md-2 label-heading" for="map_longitude"><?php echo lang('map_longitude'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='map_longitude' name="map_longitude[]" value="<?php echo set_value('map_longitude[0]'); ?>" placeholder="<?php echo lang('map_longitude'); ?>"/>
                                <span class="text-danger"><?php echo form_error('map_longitude[0]'); ?></span>       
                            </div> 
                            <!-- button add form -->
                            <label class="col-md-2 label-heading" for="" id="addContact">
                                <a href="javascript:void(0)" title="Add Form" onclick="addContact();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                            </label>
                            <div class="col-md-4 ui-front" >
                            </div>                            
                        </div>     

                        <!-- append set_value -->
                        <?php 
                        if($this->input->post('house_no') != null):
                            $set_value_contact = count($this->input->post('house_no'));
                            if($set_value_contact > 1): 
                             for ($i=0; $i < $set_value_contact; $i++):
                                 if($i > 0): ?>

                                    <div id="removeContact<?php echo $i; ?>"><hr>
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
                                            <input class='form-control'  type="number" id='phone2<?php echo $i; ?>' name="phone2[]" value="<?php echo set_value('phone2['.$i.']'); ?>" placeholder="0123456789"/>
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
                                            <input class='form-control'  type="number" id='map_latitude<?php echo $i; ?>' name="map_latitude[]" value="<?php echo set_value('map_latitude['.$i.']'); ?>" placeholder="<?php echo lang('map_latitude'); ?>"/>
                                            <span class="text-danger"><?php echo form_error('map_latitude['.$i.']'); ?></span>       
                                        </div>                            
                                    </div> 
                                    <div class="form-group"> 
                                        <!-- map_longitude -->
                                        <label class="col-md-2 label-heading" for="map_longitude<?php echo $i; ?>"><?php echo lang('map_longitude'); ?></label>
                                        <div class="col-md-4 ui-front">
                                            <input class='form-control'  type="number" id='map_longitude<?php echo $i; ?>' name="map_longitude[]" value="<?php echo set_value('map_longitude['.$i.']'); ?>" placeholder="<?php echo lang('map_longitude'); ?>"/>
                                            <span class="text-danger"><?php echo form_error('map_longitude['.$i.']'); ?></span>       
                                        </div> 
                                        <label for="function" class="col-md-3 label-heading">
                                            <!-- button add form -->
                                            <a href="javascript:void(0)" title="Remove Form" onclick="removeContact('<?php echo $i;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                            <!-- button remove form -->
                                            <a href="javascript:void(0)" title="Add Form" onclick="addContact();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                        </label>
                                        <div class="col-md-4 ui-front" >
                                        </div>                           
                                    </div>

                                <?php endif;
                             endfor; 
                            endif; 
                        endif;
                         ?>
                        <!-- end append set_value -->

                        <!-- append main app to here -->
                        <div class="append-contact"></div>         
                    </div>
                    <!-- end contact address --> 

                    <!-- identification document -->
                    <div id="identification" class="tab-pane fade">
                        <div class="form-group">
                            <!-- identification_type -->
                            <label class="col-md-2 label-heading" for="identification_type"><?php echo lang('id_type'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" id="identification_type" name="identification_type[]" required>
                                    <option value="">--- select id type ---</option>
                                    <?php if(!empty($identificationType)): ?>
                                        <?php foreach($identificationType as $row):?>
                                            <option value="<?php echo $row->id;?>" <?php echo set_select('identification_type[0]', $row->id); ?>><?php echo $row->name_en?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('identification_type[0]'); ?></span>     
                            </div>
                            <!-- identification_code -->
                            <label class="col-md-2 label-heading" for="identification_code"><?php echo lang('id_code'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='identification_code' name="identification_code[]" value="<?php echo set_value('identification_code[0]'); ?>" placeholder="<?php echo lang('id_code'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('identification_code[0]'); ?></span>       
                            </div> 
                        </div>
                        <div class="form-group">
                            <!-- identification_issue_place -->
                            <label class="col-md-2 label-heading" for="identification_issue_place"><?php echo lang('issue_place'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='identification_issue_place' name="identification_issue_place[]" value="<?php echo set_value('identification_issue_place[0]'); ?>" placeholder="<?php echo lang('issue_place'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('identification_issue_place[0]'); ?></span>       
                            </div> 
                            <!-- identification_issue_date -->
                            <label class="col-md-2 label-heading" for="identification_issue_date"><?php echo lang('issue_date'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control' onclick="selectIssueDate('')"  type="text" id='identification_issue_date' name="identification_issue_date[]" value="<?php echo set_value('identification_issue_date[0]'); ?>" placeholder="dd-mm-yyyy" required/>
                                <span class="text-danger"><?php echo form_error('identification_issue_date[0]'); ?></span>       
                            </div> 
                        </div>
                        <div class="form-group">
                            <!-- identification_expiry_date -->
                            <label class="col-md-2 label-heading" for="identification_expiry_date"><?php echo lang('expiry_date'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='identification_expiry_date' name="identification_expiry_date[]" value="<?php echo set_value('identification_expiry_date[0]'); ?>" placeholder="dd-mm-yyyy" required/>
                                <span class="text-danger"><?php echo form_error('identification_expiry_date[0]'); ?></span>       
                            </div>   
                            <!-- button add form -->
                            <label class="col-md-2 label-heading" for="" id="addIdentification">
                                <a href="javascript:void(0)" title="Add Form" onclick="addIdentification();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                            </label>
                            <div class="col-md-4 ui-front" >
                            </div>  
                        </div>

                        <!-- append set_value -->
                        <?php 
                        if($this->input->post('identification_type') != null):
                            $set_identification_type = count($this->input->post('identification_type'));
                            if($set_identification_type > 1): 
                             for ($i=0; $i < $set_identification_type; $i++):
                                if($i > 0): ?>
                                    
                                <div id="removeIdentification<?php echo $i; ?>"><hr>
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
                                            <!-- button add form -->
                                            <a href="javascript:void(0)" title="Remove Form" onclick="removeIdentification('<?php echo $i;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                            <!-- button remove form -->
                                            <a href="javascript:void(0)" title="Add Form" onclick="addIdentification();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                        </label>
                                        <div class="col-md-4 ui-front" >
                                        </div>  
                                    </div>
                                </div>

                                <?php 
                                endif;
                             endfor;
                            endif;
                        endif;?>
                        <!-- append main app to here -->
                        <div class="append-identification"></div>  
                    </div>
                    <!-- End identification document --> 

                    <!-- Classification info -->
                    <!-- <div id="classification" class="tab-pane fade">
                        <div class="form-group">  -->
                            <!-- sector -->
                            <!-- <label class="col-md-2 label-heading" for="sector"><?php// echo lang('sector'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' onchange="selectSector()" data-live-search="true" id="sector" name="sector">
                                    <option value="">--- select sector ---</option>
                                    <?php// if(!empty($sector)): ?>
                                        <?php// foreach($sector as $row):?>
                                            <option value="<?php// echo $row->id;?>"><?php// echo $row->name_en?></option>
                                        <?php// endforeach; ?>
                                    <?php// endif; ?>
                                </select>
                                <span class="text-danger"><?php// echo form_error('sector'); ?></span>     
                            </div> -->
                            <!-- industry -->
                            <!-- <label class="col-md-2 label-heading" for="industry"><?php// echo lang('industry'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" id="industry" name="industry">
                                    <option value="">--- select sector first ---</option>
                                </select>
                                <span class="text-danger"><?php// echo form_error('industry'); ?></span>     
                            </div>
                        </div>
                        <div class="form-group"> -->
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
                        </div>
                    </div> -->
                    <!-- End classification info -->

                    <!-- Employee detail -->
                    <div id="employment" class="tab-pane fade">
                        <div class="form-group">
                            <!-- employment_type -->
                            <label class="col-md-2 label-heading" for="employment_type"><?php echo lang('employment_type'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="employment_type[]" id="employment_type" required>
                                    <option value="">--- select employment type ---</option>
                                    <option value="C" <?php echo set_select('employment_type[0]', 'C'); ?>>Current</option>
                                    <option value="P" <?php echo set_select('employment_type[0]', 'P'); ?>>Previouse</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('employment_type[0]'); ?></span>  
                            </div>
                            <!-- self_employee -->
                            <label class="col-md-2 label-heading" for="self_employee"><?php echo lang('self_employee'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' onchange="changeSelfEmployee()" data-live-search="true" name="self_employee[]" id="self_employee" required>
                                    <option value="">--- select self employee ---</option>
                                    <option value="Y" <?php echo set_select('self_employee[0]', 'Y'); ?>>Yes</option>
                                    <option value="N" <?php echo set_select('self_employee[0]', 'N'); ?>>No</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('self_employee[0]'); ?></span>  
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- company_name -->
                            <label class="col-md-2 label-heading" for="company_name"><?php echo lang('company_name'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='company_name' name="company_name[]" value="<?php echo set_value('company_name[0]'); ?>" placeholder="<?php echo lang('company_name'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('company_name[0]'); ?></span>       
                            </div> 
                            <!-- empbusiness_type_id -->
                            <label class="col-md-2 label-heading" for="empbusiness_type_id"><?php echo lang('business_type'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="empbusiness_type_id[]" id='empbusiness_type_id' required>
                                    <option value="">--- select business type ---</option>
                                    <?php if(!empty($businessType)): ?>
                                        <?php foreach ($businessType as $row):?>
                                            <option value="<?php echo $row->id; ?>" <?php echo set_select('empbusiness_type_id[0]', $row->id); ?>><?php echo $row->code.'-'.$row->name_kh; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('empbusiness_type_id[0]'); ?></span>     
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- employer_name -->
                            <label class="col-md-2 label-heading" for="employer_name"><?php echo lang('employer_name'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='employer_name' name="employer_name[]" value="<?php echo set_value('employer_name[0]'); ?>" placeholder="<?php echo lang('employer_name'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('employer_name[0]'); ?></span>       
                            </div> 
                            <!-- emp_occupation -->
                            <label class="col-md-2 label-heading" for="emp_occupation"><?php echo lang('occupation'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='emp_occupation' name="emp_occupation[]" value="<?php echo set_value('emp_occupation[0]'); ?>" placeholder="<?php echo lang('employer_name'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('emp_occupation[0]'); ?></span>     
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- length_of_service -->
                            <label class="col-md-2 label-heading" for="length_of_service"><?php echo lang('length_of_service'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='length_of_service' name="length_of_service[]" value="<?php echo set_value('length_of_service[0]'); ?>" placeholder="<?php echo lang('length_of_service'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('length_of_service[0]'); ?></span>       
                            </div> 
                            <!-- employer_address_type -->
                            <label class="col-md-2 label-heading" for="employer_address_type"><?php echo lang('employer_address_type'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="employer_address_type[]" id="employer_address_type" required>
                                    <option value="">--- select address type* ---</option>
                                    <option value="RESID" <?php echo set_select('employer_address_type[0]', 'RESID'); ?>>Residential</option>
                                    <option value="WORK" <?php echo set_select('employer_address_type[0]', 'WORK'); ?>>Work</option>
                                    <option value="POST" <?php echo set_select('employer_address_type[0]', 'POST'); ?>>Correspondence</option>
                                    <option value="U" <?php echo set_select('employer_address_type[0]', 'U'); ?>>Unknown</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('employer_address_type[0]'); ?></span>     
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- employer_id -->
                            <label class="col-md-2 label-heading" for="employer_id"><?php echo lang('employer_id'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='employer_id' name="employer_id[]" value="<?php echo set_value('employer_id[0]'); ?>" placeholder="<?php echo lang('employer_id'); ?>" required/>
                                <span class="text-danger"><?php echo form_error('employer_id[0]'); ?></span>     
                            </div>
                            <!-- employer_country -->
                            <label class="col-md-2 label-heading" for="employer_country"><?php echo lang('country'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerCountry('')" name="employer_country[]" id="employer_country" required>
                                    <option value="">--- Select Country ---</option>
                                    <?php if(!empty($country)): ?>
                                        <?php foreach($country as $row):?>
                                            <option value="<?php echo $row->id?>" <?php echo set_select('employer_country[0]', $row->id); ?>><?php echo $row->name_en?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('employer_country[0]'); ?></span>  
                            </div>
                        </div>
                        <div class="form-group">     
                            <!-- employer_province -->
                            <label class="col-md-2 label-heading" for="employer_province"><?php echo lang('province'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerProvince('')" name="employer_province[]" id="employer_province" required>
                                    <?php echo selectedProvince(set_value('employer_country[0]'), set_value('employer_province[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('employer_province[0]'); ?></span>      
                            </div>                       
                            <!-- employer_district -->
                            <label class="col-md-2 label-heading" for="employer_district"><?php echo lang('district'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerDistrict('')" name="employer_district[]" id="employer_district" required>
                                    <?php echo selectedDistrict(set_value('employer_province[0]'), set_value('employer_district[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('employer_district[0]'); ?></span>     
                            </div>                           
                        </div>
                        <div class="form-group">
                            <!-- employer_commune -->
                            <label class="col-md-2 label-heading" for="employer_commune"><?php echo lang('commune'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" onchange="selectEmployerCommune('')" id='employer_commune' name="employer_commune[]" required>
                                    <?php echo selectedCommune(set_value('employer_district[0]'), set_value('employer_commune[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('employer_commune[0]'); ?></span>       
                            </div> 
                            <!-- employer_village -->
                            <label class="col-md-2 label-heading" for="employer_village"><?php echo lang('village'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" name="employer_village[]" id='employer_village' required>
                                    <?php echo selectedVillage(set_value('employer_commune[0]'), set_value('employer_village[0]')); ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('employer_village[0]'); ?></span>     
                            </div>
                        </div>
                        <div class="form-group">                            
                            <!-- employer_houseno -->
                            <label class="col-md-2 label-heading" for="employer_houseno"><?php echo lang('house_no'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='employer_houseno' name="employer_houseno[]" value="<?php echo set_value('employer_houseno[0]'); ?>" placeholder="#..."  required/>
                                <span class="text-danger"><?php echo form_error('employer_houseno[0]'); ?></span>       
                            </div> 
                            <!-- employer_street -->
                            <label class="col-md-2 label-heading" for="employer_street"><?php echo lang('street'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="text" id='employer_street' name="employer_street[]" value="<?php echo set_value('employer_street[0]'); ?>" placeholder="No..."  required/>
                                <span class="text-danger"><?php echo form_error('employer_street[0]'); ?></span>       
                            </div>                           
                        </div>    
                        <div class="form-group">    
                            <!-- employed_year -->
                            <label class="col-md-2 label-heading" for="employed_year"><?php echo lang('employed_year'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='employed_year' name="employed_year[]" value="<?php echo set_value('employed_year[0]'); ?>" placeholder="<?php echo lang('employed_year'); ?>"  required/>
                                <span class="text-danger"><?php echo form_error('employed_year[0]'); ?></span>       
                            </div>                          
                            <!-- employee_currency -->
                            <label class="col-md-2 label-heading" for="employee_currency"><?php echo lang('currency'); ?></label>
                            <div class="col-md-4 ui-front">
                                <select class="form-control select2" style='width:100%' data-live-search="true" id='employee_currency' name="employee_currency[]" required>
                                    <option>--- select currency ---</option>
                                    <?php if(!empty(listCurrency())): ?>
                                        <?php foreach (listCurrency() as $curr):?>
                                            <option value="<?php echo $curr->id ?>" <?php echo set_select('employee_currency[0]', $curr->id); ?>><?php echo $curr->name_en.' ('.$curr->currency_code.')'; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('employee_currency[0]'); ?></span>       
                            </div>                           
                        </div>   
                        <div class="form-group">
                            <!-- emplyee_salary -->
                            <label class="col-md-2 label-heading" for="emplyee_salary"><?php echo lang('emplyee_salary'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='emplyee_salary' name="emplyee_salary[]" value="<?php echo set_value('emplyee_salary[0]'); ?>" placeholder="<?php echo lang('emplyee_salary') ?>" required/>
                                <span class="text-danger"><?php echo form_error('emplyee_salary[0]'); ?></span>       
                            </div> 
                            <!-- button add form -->
                            <label class="col-md-2 label-heading" for="" id="addEmployment">
                                <a href="javascript:void(0)" title="Add Form" onclick="addEmployment();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                            </label>
                            <div class="col-md-4 ui-front" >
                            </div>  
                        </div>

                        <!-- append set_value -->
                        <?php 
                        if($this->input->post('employment_type') != null):
                            $set_employment_type = count($this->input->post('employment_type'));
                            if($set_employment_type > 1): 
                             for ($i=0; $i < $set_employment_type; $i++):
                               if($i > 0): ?>
                                    
                                <div id="removeEmployment<?php echo $i; ?>"><hr>
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
                                            <input class='form-control'  type="text" id='emp_occupation<?php echo $i; ?>' name="emp_occupation[]" value="<?php echo set_value('emp_occupation['.$i.']'); ?>" placeholder="<?php echo lang('employer_name'); ?>" required/>
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
                                            <input class='form-control'  type="number" id='employed_year<?php echo $i; ?>' name="employed_year[]" value="<?php echo set_value('employed_year['.$i.']'); ?>" placeholder="<?php echo lang('employed_year'); ?>"  required/>
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
                                            <input class='form-control'  type="number" id='emplyee_salary<?php echo $i; ?>' name="emplyee_salary[]" value="<?php echo set_value('emplyee_salary['.$i.']'); ?>" placeholder="<?php echo lang('emplyee_salary') ?>" required/>
                                            <span class="text-danger"><?php echo form_error('emplyee_salary['.$i.']'); ?></span>       
                                        </div> 
                                        <!-- button add form -->
                                        <label for="function" class="col-md-3 label-heading">
                                            <!-- button add form -->
                                            <a href="javascript:void(0)" title="Remove Form" onclick="removeEmployment('<?php echo $i;?>')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>
                                            <!-- button remove form -->
                                            <a href="javascript:void(0)" title="Add Form" onclick="addEmployment();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>
                                        </label>
                                        <div class="col-md-4 ui-front" >
                                        </div>
                                    </div>

                               <?php 
                               endif;
                             endfor;
                            endif;
                        endif;?>

                        <!-- append main app to here -->
                        <div class="append-employment"></div>              
                    </div>
                    <!-- end employment address -->  

                    <!-- Business Info -->
                    <div id="business" class="tab-pane fade" style="display: none;">
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
                                        <input class='form-control'  type="text" id='business_licence' name="business_licence[]" value="<?php echo set_value('occupation'); ?>" placeholder="<?php echo lang('employer_name'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('business_licence'); ?></span>     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- employee_amount -->
                                    <label class="col-md-2 label-heading" for="employee_amount"><?php echo lang('employee_amount'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='employee_amount' name="employee_amount[]" value="<?php echo set_value('employee_amount'); ?>" placeholder="<?php echo lang('employee_amount'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('employee_amount'); ?></span>       
                                    </div> 
                                    <!-- man_employee_amount -->
                                    <label class="col-md-2 label-heading" for="man_employee_amount"><?php echo lang('man_employee_amount'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='man_employee_amount' name="man_employee_amount[]" value="<?php echo set_value('man_employee_amount'); ?>" placeholder="<?php echo lang('man_employee_amount'); ?>"/>
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
                                    <!-- business_profit -->
                                    <label class="col-md-2 label-heading" for="business_profit"><?php echo lang('business_profit'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='business_profit' name="business_profit[]" value="<?php echo set_value('business_profit'); ?>" placeholder="<?php echo lang('business_profit'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('business_profit'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- transport_cost -->
                                    <label class="col-md-2 label-heading" for="transport_cost"><?php echo lang('transport_cost'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='transport_cost' name="transport_cost[]" value="<?php echo set_value('transport_cost'); ?>" placeholder="<?php echo lang('transport_cost'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('transport_cost'); ?></span>       
                                    </div>
                                    <!-- repair_cost -->
                                    <label class="col-md-2 label-heading" for="repair_cost"><?php echo lang('repair_cost'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='repair_cost' name="repair_cost[]" value="<?php echo set_value('repair_cost'); ?>" placeholder="<?php echo lang('repair_cost'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('repair_cost'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- profit_before_tax -->
                                    <label class="col-md-2 label-heading" for="profit_before_tax"><?php echo lang('profit_before_tax'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='profit_before_tax' name="profit_before_tax[]" value="<?php echo set_value('profit_before_tax'); ?>" placeholder="<?php echo lang('profit_before_tax'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('profit_before_tax'); ?></span>       
                                    </div>
                                    <!-- income_after_tax -->
                                    <label class="col-md-2 label-heading" for="income_after_tax"><?php echo lang('income_after_tax'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='income_after_tax' name="income_after_tax[]" value="<?php echo set_value('income_after_tax'); ?>" placeholder="<?php echo lang('income_after_tax'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('income_after_tax'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- business_cost -->
                                    <label class="col-md-2 label-heading" for="business_cost"><?php echo lang('business_cost'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='business_cost' name="business_cost[]" value="<?php echo set_value('business_cost'); ?>" placeholder="<?php echo lang('business_cost'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('business_cost'); ?></span>       
                                    </div>
                                    <!-- other_profit -->
                                    <label class="col-md-2 label-heading" for="other_profit"><?php echo lang('other_profit'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='other_profit' name="other_profit[]" value="<?php echo set_value('other_profit'); ?>" placeholder="<?php echo lang('other_profit'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('other_profit'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- total_profit -->
                                    <label class="col-md-2 label-heading" for="total_profit"><?php echo lang('total_profit'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='total_profit' name="total_profit[]" value="<?php echo set_value('total_profit'); ?>" placeholder="<?php echo lang('total_profit'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('total_profit'); ?></span>       
                                    </div>
                                    <!-- electric_water_expend -->
                                    <label class="col-md-2 label-heading" for="electric_water_expend"><?php echo lang('electric_water_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='electric_water_expend' name="electric_water_expend[]" value="<?php echo set_value('electric_water_expend'); ?>" placeholder="<?php echo lang('electric_water_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('electric_water_expend'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- salary_food_expend -->
                                    <label class="col-md-2 label-heading" for="salary_food_expend"><?php echo lang('salary_food_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='salary_food_expend' name="salary_food_expend[]" value="<?php echo set_value('salary_food_expend'); ?>" placeholder="<?php echo lang('salary_food_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('salary_food_expend'); ?></span>       
                                    </div>
                                    <!-- rent_house_expend -->
                                    <label class="col-md-2 label-heading" for="rent_house_expend"><?php echo lang('rent_house_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='rent_house_expend' name="rent_house_expend[]" value="<?php echo set_value('rent_house_expend'); ?>" placeholder="<?php echo lang('rent_house_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('rent_house_expend'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- insurance_expend -->
                                    <label class="col-md-2 label-heading" for="insurance_expend"><?php echo lang('insurance_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='insurance_expend' name="insurance_expend[]" value="<?php echo set_value('insurance_expend'); ?>" placeholder="<?php echo lang('insurance_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('insurance_expend'); ?></span>       
                                    </div>
                                    <!-- advertise_expend -->
                                    <label class="col-md-2 label-heading" for="advertise_expend"><?php echo lang('advertise_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='advertise_expend' name="advertise_expend[]" value="<?php echo set_value('advertise_expend'); ?>" placeholder="<?php echo lang('advertise_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('advertise_expend'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- loan_expend -->
                                    <label class="col-md-2 label-heading" for="loan_expend"><?php echo lang('loan_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='loan_expend' name="loan_expend[]" value="<?php echo set_value('loan_expend'); ?>" placeholder="<?php echo lang('loan_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('loan_expend'); ?></span>       
                                    </div>
                                    <!-- tax_expend -->
                                    <label class="col-md-2 label-heading" for="tax_expend"><?php echo lang('tax_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='tax_expend' name="tax_expend[]" value="<?php echo set_value('tax_expend'); ?>" placeholder="<?php echo lang('tax_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('tax_expend'); ?></span>       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- others_expend -->
                                    <label class="col-md-2 label-heading" for="others_expend"><?php echo lang('others_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='others_expend' name="others_expend[]" value="<?php echo set_value('others_expend'); ?>" placeholder="<?php echo lang('others_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('others_expend'); ?></span>       
                                    </div>
                                    <!-- total_expend -->
                                    <label class="col-md-2 label-heading" for="total_expend"><?php echo lang('total_expend'); ?></label>
                                    <div class="col-md-4 ui-front">
                                        <input class='form-control'  type="number" id='total_expend' name="total_expend[]" value="<?php echo set_value('total_expend'); ?>" placeholder="<?php echo lang('total_expend'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('total_expend'); ?></span>       
                                    </div>
                                </div>
                                <!-- end income & expend -->
                                
                                <div class="form-group">
                                    <!-- button add form -->
                                    <label class="col-md-2 label-heading" for="" id="addBusiness">
                                        <a href="javascript:void(0)" title="Add Form" onclick="addBusiness();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a> 
                                    </label>
                                    <div class="col-md-4 ui-front" >
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <!-- append main app to here -->
                        <div class="append-business"></div>              
                    </div>
                    <!-- end contact address --> 

                    <!-- Income Expend -->
                    <div id="incomeexpend" class="tab-pane fade">
                        <legend>Personal Income & Expend</legend>
                        <div class="form-group">
                            <!-- personal_profit -->
                            <label class="col-md-2 label-heading" for="personal_profit"><?php echo lang('profit'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_profit' name="personal_profit" value="<?php echo set_value('personal_profit'); ?>" placeholder="<?php echo lang('profit'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_profit'); ?></span>       
                            </div> 
                            <!-- personal_income_salary -->
                            <label class="col-md-2 label-heading" for="personal_income_salary"><?php echo lang('income_salary'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_income_salary' name="personal_income_salary" value="<?php echo set_value('income_salary'); ?>" placeholder="<?php echo lang('personal_income_salary'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_income_salary'); ?></span>       
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- personal_other_profit -->
                            <label class="col-md-2 label-heading" for="personal_other_profit"><?php echo lang('other_profit'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_other_profit' name="personal_other_profit" value="<?php echo set_value('personal_other_profit'); ?>" placeholder="<?php echo lang('other_profit'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_other_profit'); ?></span>       
                            </div>
                            <!-- total_income -->
                            <label class="col-md-2 label-heading" for="total_income"><?php echo lang('total_income'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='total_income' name="total_income" value="<?php echo set_value('total_income'); ?>" placeholder="<?php echo lang('total_income'); ?>"/>
                                <span class="text-danger"><?php echo form_error('total_income'); ?></span>       
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- personal_food_expend -->
                            <label class="col-md-2 label-heading" for="personal_food_expend"><?php echo lang('expend_food'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_food_expend' name="personal_food_expend" value="<?php echo set_value('personal_food_expend'); ?>" placeholder="<?php echo lang('expend_food'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_food_expend'); ?></span>       
                            </div>
                            <!-- personal_clothes_expend -->
                            <label class="col-md-2 label-heading" for="personal_clothes_expend"><?php echo lang('expend_cloth'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_clothes_expend' name="personal_clothes_expend" value="<?php echo set_value('personal_clothes_expend'); ?>" placeholder="<?php echo lang('expend_cloth'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_clothes_expend'); ?></span>       
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- personal_media_expend -->
                            <label class="col-md-2 label-heading" for="personal_media_expend"><?php echo lang('expend_media'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_media_expend' name="personal_media_expend" value="<?php echo set_value('personal_media_expend'); ?>" placeholder="<?php echo lang('expend_media'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_media_expend'); ?></span>       
                            </div>
                            <!-- personal_insurance_expend -->
                            <label class="col-md-2 label-heading" for="personal_insurance_expend"><?php echo lang('expend_insurance'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_insurance_expend' name="personal_insurance_expend" value="<?php echo set_value('personal_insurance_expend'); ?>" placeholder="<?php echo lang('expend_insurance'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_insurance_expend'); ?></span>       
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- personal_electric_expend -->
                            <label class="col-md-2 label-heading" for="personal_electric_expend"><?php echo lang('electric_water_expend'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_electric_expend' name="personal_electric_expend" value="<?php echo set_value('personal_electric_expend'); ?>" placeholder="<?php echo lang('electric_water_expend'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_electric_expend'); ?></span>       
                            </div>
                            <!-- personal_repare_expend -->
                            <label class="col-md-2 label-heading" for="personal_repare_expend"><?php echo lang('expend_repare'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_repare_expend' name="personal_repare_expend" value="<?php echo set_value('personal_repare_expend'); ?>" placeholder="<?php echo lang('expend_repare'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_repare_expend'); ?></span>       
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- personal_other_expend -->
                            <label class="col-md-2 label-heading" for="personal_other_expend"><?php echo lang('others_expend'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_other_expend' name="personal_other_expend" value="<?php echo set_value('personal_other_expend'); ?>" placeholder="<?php echo lang('others_expend'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_other_expend'); ?></span>       
                            </div>
                            <!-- possibility_pay -->
                            <label class="col-md-2 label-heading" for="possibility_pay"><?php echo lang('possibility_pay'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='possibility_pay' name="possibility_pay" value="<?php echo set_value('possibility_pay'); ?>" placeholder="<?php echo lang('possibility_pay'); ?>"/>
                                <span class="text-danger"><?php echo form_error('possibility_pay'); ?></span>       
                            </div>
                        </div>   
                        <div class="form-group">
                            <!-- personal_total_expend -->
                            <label class="col-md-2 label-heading" for="personal_total_expend"><?php echo lang('total_expend'); ?></label>
                            <div class="col-md-4 ui-front">
                                <input class='form-control'  type="number" id='personal_total_expend' name="personal_total_expend" value="<?php echo set_value('personal_total_expend'); ?>" placeholder="<?php echo lang('total_expend'); ?>"/>
                                <span class="text-danger"><?php echo form_error('personal_total_expend'); ?></span>       
                            </div>
                        </div>         
                    </div>
                    <!-- end income expend -->                                  
                </div>

                <!-- button action -->
                <div class="text-right">
                    <a href="<?php echo base_url($link); ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</a> 
                    <button type="submit" id="btn-submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i> <?php echo lang("btn_save") ?></button> 
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/address.js"></script>


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

        // focus form that not valid of validation
        var class_active = '<?php echo (isset($class_active) ? $class_active : ''); ?>';
        if(class_active != ''){
            $("input").each(function(){
               if ($(this).prop('required') && $(this).val() == "") {
                   $($(this)).after('<span class="text-danger">This field can not be blank.</span>');
               }
            });
            $("select").each(function(){
               if ($(this).prop('required') && $(this).val() == "") {
                   $($(this)).after('<span class="text-danger">This field can not be blank.</span>');
               }
            });

            // remove default active tab
            $('.active').removeClass('in active');
            // add class in active for specific form error
            $('#active-'+class_active).addClass('active'); 
            $('#'+class_active).addClass('in active'); 
        }

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

    /* list industry by sector id */
    function selectSector(){
        var sectorID =  $('#sector').val();
        if(sectorID){
            $.ajax({
                type:'GET',
                url:'findIndustry/'+sectorID,
                success:function(response){
                    $('#industry').html(response);
                }
            });
        }
    }
</script>
<!-- append spouse info -->
<script type="text/javascript">
    $('#marital_status').on('change',function(){
        if($(this).val() == "M"){
            var spouseinfo = '<legend>Spouse Info</legend>'+
                            '<div class="form-group">'+
                                '<!-- spouse_firstname_kh -->'+
                                    '<label class="col-md-2 label-heading" for="spouse_firstname_kh"><?php echo lang("firstname_kh"); ?></label>'+
                                    '<div class="col-md-4 ui-front">'+
                                        '<input class="form-control" type="text" name="spouse_firstname_kh" id="spouse_firstname_kh" value="<?php echo set_value("spouse_firstname_kh"); ?>" placeholder="<?php echo lang("firstname_kh"); ?>" required/>'+
                                        '<span class="text-danger"><?php echo form_error("spouse_firstname_kh"); ?></span>'+
                                    '</div>'+
                                    '<!-- spouse_lastname_kh -->'+
                                    '<label class="col-md-2 label-heading" for="firstname_kh"><?php echo lang("lastname_kh"); ?></label>'+
                                    '<div class="col-md-4 ui-front">'+
                                        '<input class="form-control" type="text" name="spouse_lastname_kh" id="spouse_lastname_kh" value="<?php echo set_value("spouse_lastname_kh"); ?>" placeholder="<?php echo lang("lastname_kh"); ?>" required/>'+
                                        '<span class="text-danger"><?php echo form_error("spouse_lastname_kh"); ?></span>'+
                                    '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<!-- spouse_firstname_en -->'+
                                '<label class="col-md-2 label-heading" for="spouse_firstname_en"><?php echo lang("firstname_en"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<input class="form-control" type="text" name="spouse_firstname_en" id="spouse_firstname_en" value="<?php echo set_value("spouse_firstname_en"); ?>" placeholder="<?php echo lang("firstname_en"); ?>" required/>'+
                                    '<span class="text-danger"><?php echo form_error("spouse_firstname_en"); ?></span>'+
                                '</div>'+
                                '<!-- spouse_lastname_en -->'+
                                '<label class="col-md-2 label-heading" for="spouse_lastname_en"><?php echo lang("lastname_en"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<input class="form-control" type="text" name="spouse_lastname_en" id="spouse_lastname_en" value="<?php echo set_value("spouse_lastname_en"); ?>" placeholder="<?php echo lang("lastname_en"); ?>" required/>'+
                                    '<span class="text-danger"><?php echo form_error("spouse_lastname_en"); ?></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<!-- spouse_dob -->'+
                                '<label class="col-md-2 label-heading" for="spouse_dob"><?php echo lang("dob"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<input class="form-control"  type="text" name="spouse_dob" id="spouse_dob" value="<?php echo set_value("spouse_dob"); ?>" placeholder="dd-mm-yyyy" required/>'+
                                    '<span class="text-danger"><?php echo form_error("spouse_dob"); ?></span>    '+
                                '</div>'+
                                '<!-- spouse_nationality -->'+
                                '<label class="col-md-2 label-heading" for="spouse_nationality"><?php echo lang("nationality"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<select class="form-control select2" style="width:100%" data-live-search="true" name="spouse_nationality">'+
                                        '<?php if(!empty($nationality)): ?>'+
                                            '<?php foreach($nationality as $row):?>'+
                                                '<option value="<?php echo $row->id;?>"><?php echo $row->name_kh?></option>'+
                                            '<?php endforeach; ?>'+
                                        '<?php endif; ?>'+
                                    '</select>'+
                                    '<span class="text-danger"><?php echo form_error("nationality"); ?></span>      '+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<!-- spouse_occupation -->'+
                                '<label class="col-md-2 label-heading" for="spouse_occupation"><?php echo lang("occupation"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<input class="form-control"  type="text" name="spouse_occupation" id="spouse_occupation" value="<?php echo set_value("spouse_occupation"); ?>" placeholder="<?php echo lang("occupation"); ?>" required/>'+
                                    '<span class="text-danger"><?php echo form_error("spouse_occupation"); ?></span>    '+
                                '</div>'+
                                '<!-- spouse_id_type -->'+
                                '<label class="col-md-2 label-heading" for="spouse_id_type"><?php echo lang("id_type"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<select class="form-control select2" style="width:100%" data-live-search="true" id="spouse_id_type" name="spouse_id_type" required>'+
                                        '<option value="">--- select id type ---</option>'+
                                        '<?php if(!empty($identificationType)): ?>'+
                                            '<?php foreach($identificationType as $row):?>'+
                                                '<option value="<?php echo $row->id;?>"><?php echo $row->name_en?></option>'+
                                            '<?php endforeach; ?>'+
                                        '<?php endif; ?>'+
                                    '</select>'+
                                    '<span class="text-danger"><?php echo form_error("spouse_id_type"); ?></span>     '+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<!-- spouse_id_code -->'+
                                '<label class="col-md-2 label-heading" for="spouse_id_code"><?php echo lang("id_code"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<input class="form-control"  type="text" id="spouse_id_code" name="spouse_id_code" value="<?php echo set_value("spouse_id_code"); ?>" placeholder="<?php echo lang("id_code"); ?>" required/>'+
                                    '<span class="text-danger"><?php echo form_error("spouse_id_code"); ?></span>       '+
                                '</div> '+
                                '<!-- spouse_issue_date -->'+
                                '<label class="col-md-2 label-heading" for="spouse_issue_date"><?php echo lang("issue_date"); ?></label>'+
                                '<div class="col-md-4 ui-front">'+
                                    '<input class="form-control"  type="text" id="spouse_issue_date" name="spouse_issue_date" value="<?php echo set_value("spouse_issue_date"); ?>" placeholder="dd-mm-yyyy" required/>'+
                                    '<span class="text-danger"><?php echo form_error("spouse_issue_date"); ?></span>       '+
                                '</div> '+
                            '</div>';
    
            $('#spouse-info').html(spouseinfo);
            $('.select2').select2();
            $(function () {
                $("#spouse_dob").datepicker({ 
                    dateFormat: 'dd-mm-yy',
                });
            });
            $(function () {
                $("#spouse_issue_date").datepicker({ 
                    dateFormat: 'dd-mm-yy',
                });
            });

            /**
             * validation required form
             */
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
                
            /**
             * end validation required form
             */
        }else{
            $('#spouse-info').html('');
        }
    });
</script>

<!-- append business -->
<script type="text/javascript">
    var bus = 0;
    function addBusiness() {
        bus += 1;
        if (bus <= 10) {
            var formBusiness = '<div id="removeBusiness'+bus+'"><hr>' +
                                    '<div class="panel panel-default">'+
                                        '<div class="panel-body">'+
                                            '<div class="form-group">'+                               
                                                '<!-- business_name -->'+
                                                '<label class="col-md-2 label-heading" for="business_name'+bus+'"><?php echo lang("business_name"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="text" id="business_name'+bus+'" name="business_name[]" value="<?php echo set_value("business_name['+bus+']"); ?>" placeholder="<?php echo lang("business_name"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("business_name[]"); ?></span>       '+
                                                '</div> '+
                                                '<!-- business_type -->'+
                                                '<label class="col-md-2 label-heading" for="business_type'+bus+'"><?php echo lang("business_type"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" name="business_type[]" id="business_type'+bus+'">'+
                                                        '<option value="">--- select business type ---</option>'+
                                                        '<?php if(!empty($businessType)): ?>'+
                                                            '<?php foreach ($businessType as $row):?>'+
                                                                '<option value="<?php echo $row->id; ?>"><?php echo $row->code." - ".$row->name_kh; ?></option>'+
                                                            '<?php endforeach; ?>'+
                                                        '<?php endif; ?>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_type[]"); ?></span>  '+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- business_status -->'+
                                                '<label class="col-md-2 label-heading" for="business_status'+bus+'"><?php echo lang("business_status"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" name="business_status[]" id="business_status'+bus+'">'+
                                                        '<option value="">--- select business status ---</option>'+
                                                        '<?php if(!empty($businessStatus)): ?>'+
                                                            '<?php foreach ($businessStatus as $row):?>'+
                                                                '<option value="<?php echo $row->id; ?>"><?php echo $row->name_kh; ?></option>'+
                                                            '<?php endforeach; ?>'+
                                                        '<?php endif; ?>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_status[]"); ?></span>     '+
                                                '</div>'+
                                                '<!-- business_format -->'+
                                                '<label class="col-md-2 label-heading" for="business_format'+bus+'"><?php echo lang("business_format"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" name="business_format[]" id="business_format'+bus+'">'+
                                                        '<option value="">--- select business type ---</option>'+
                                                        '<?php if(!empty($businessFormat)): ?>'+
                                                            '<?php foreach ($businessFormat as $row):?>'+
                                                                '<option value="<?php echo $row->id; ?>"><?php echo $row->name_kh; ?></option>'+
                                                            '<?php endforeach; ?>'+
                                                        '<?php endif; ?>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_format"); ?></span>     '+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- business_start -->'+
                                                '<label class="col-md-2 label-heading" for="business_start'+bus+'"><?php echo lang("business_start"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="text" id="business_start'+bus+'" name="business_start[]" value="<?php echo set_value("business_start['+bus+']"); ?>" placeholder="dd-mm-yyyy"/>'+
                                                    '<span class="text-danger"><?php echo form_error("business_start[]"); ?></span>       '+
                                                '</div> '+
                                                '<!-- business_licence -->'+
                                                '<label class="col-md-2 label-heading" for="business_licence'+bus+'"><?php echo lang("business_licence"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="text" id="business_licence'+bus+'" name="business_licence[]" value="<?php echo set_value("occupation['+bus+']"); ?>" placeholder="<?php echo lang("employer_name"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("business_licence[]"); ?></span>     '+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- employee_amount -->'+
                                                '<label class="col-md-2 label-heading" for="employee_amount'+bus+'"><?php echo lang("employee_amount"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="employee_amount'+bus+'" name="employee_amount[]" value="<?php echo set_value("employee_amount['+bus+']"); ?>" placeholder="<?php echo lang("employee_amount"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("employee_amount[]"); ?></span>       '+
                                                '</div> '+
                                                '<!-- man_employee_amount -->'+
                                                '<label class="col-md-2 label-heading" for="man_employee_amount'+bus+'"><?php echo lang("man_employee_amount"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="man_employee_amount'+bus+'" name="man_employee_amount[]" value="<?php echo set_value("man_employee_amount['+bus+']"); ?>" placeholder="<?php echo lang("man_employee_amount"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("man_employee_amount[]"); ?></span>       '+
                                                '</div> '+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- business_country -->'+
                                                '<label class="col-md-2 label-heading" for="business_country'+bus+'"><?php echo lang("country"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectBusinessCountry('+bus+')" name="business_country[]" id="business_country'+bus+'">'+
                                                        '<option value="">--- Select Country ---</option>'+
                                                        '<?php if(!empty($country)): ?>'+
                                                            '<?php foreach($country as $row):?>'+
                                                                '<option value="<?php echo $row->id?>"><?php echo $row->name_en?></option>'+
                                                            '<?php endforeach; ?>'+
                                                        '<?php endif; ?>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_country[]"); ?></span>  '+
                                                '</div>'+
                                                '<!-- business_province -->'+
                                                '<label class="col-md-2 label-heading" for="business_province'+bus+'"><?php echo lang("province"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectBusinessProvince('+bus+')" name="business_province[]" id="business_province'+bus+'">'+
                                                        '<option value="">--- Province ---</option>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_province"); ?></span>      '+
                                                '</div> '+
                                            '</div>   '+
                                            '<div class="form-group">                                               '+
                                                '<!-- business_district -->'+
                                                '<label class="col-md-2 label-heading" for="business_district'+bus+'"><?php echo lang("district"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectBusinessDistrict('+bus+')" name="business_district[]" id="business_district'+bus+'" >'+
                                                        '<option value="">--- District ---</option>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_district[]"); ?></span>     '+
                                                '</div>  '+
                                                '<!-- business_commune -->'+
                                                '<label class="col-md-2 label-heading" for="business_commune'+bus+'"><?php echo lang("commune"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectBusinessCommune('+bus+')" id="business_commune'+bus+'" name="business_commune[]">'+
                                                        '<option value="">--- Commune ---</option>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_commune[]"); ?></span>       '+
                                                '</div>                          '+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- business_village -->'+
                                                '<label class="col-md-2 label-heading" for="business_village'+bus+'"><?php echo lang("village"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" name="business_village[]" id="business_village'+bus+'">'+
                                                        '<option value="">--- Village ---</option>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("business_village[]"); ?></span>     '+
                                                '</div>                           '+
                                                '<!-- location_status -->'+
                                                '<label class="col-md-2 label-heading" for="location_status'+bus+'"><?php echo lang("location_status"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<select class="form-control select2" style="width:100%" data-live-search="true" name="location_status[]" id="location_status'+bus+'">'+
                                                        '<option value="">--- select location status ---</option>'+
                                                        '<?php if(!empty($businessLocationStatus)): ?>'+
                                                            '<?php foreach($businessLocationStatus as $row):?>'+
                                                                '<option value="<?php echo $row->id?>"><?php echo $row->name_en?></option>'+
                                                            '<?php endforeach; ?>'+
                                                        '<?php endif; ?>'+
                                                    '</select>'+
                                                    '<span class="text-danger"><?php echo form_error("location_status[]"); ?></span>       '+
                                                '</div>                         '+
                                            '</div>'+

                                            '<!-- income & expend -->'+
                                            '<legend>Income & Expend</legend>'+
                                            '<div class="form-group">'+
                                                '<!-- income_date -->'+
                                                '<label class="col-md-2 label-heading" for="income_date'+bus+'"><?php echo lang("income_date"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="text" id="income_date'+bus+'" name="income_date[]" value="<?php echo set_value("income_date['+bus+']"); ?>" placeholder="<?php echo lang("income_date"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("income_date[]"); ?></span>'+
                                                '</div>'+
                                                '<!-- business_profit -->'+
                                                '<label class="col-md-2 label-heading" for="business_profit'+bus+'"><?php echo lang("business_profit"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="business_profit'+bus+'" name="business_profit[]" value="<?php echo set_value("business_profit['+bus+']"); ?>" placeholder="<?php echo lang('business_profit'); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error('business_profit[]'); ?></span>'+      
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- transport_cost -->'+
                                                '<label class="col-md-2 label-heading" for="transport_cost'+bus+'"><?php echo lang('transport_cost'); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="transport_cost'+bus+'" name="transport_cost[]" value="<?php echo set_value("transport_cost['+bus+']"); ?>" placeholder="<?php echo lang('transport_cost'); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error('transport_cost[]'); ?></span>'+       
                                                '</div>'+
                                                '<!-- repair_cost -->'+
                                                '<label class="col-md-2 label-heading" for="repair_cost'+bus+'"><?php echo lang("repair_cost"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="repair_cost'+bus+'" name="repair_cost[]" value="<?php echo set_value("repair_cost['+bus+']"); ?>" placeholder="<?php echo lang("repair_cost"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("repair_cost[]"); ?></span>'+       
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- profit_before_tax -->'+
                                                '<label class="col-md-2 label-heading" for="profit_before_tax'+bus+'"><?php echo lang("profit_before_tax"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="profit_before_tax'+bus+'" name="profit_before_tax[]" value="<?php echo set_value("profit_before_tax['+bus+']"); ?>" placeholder="<?php echo lang("profit_before_tax"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("profit_before_tax[]"); ?></span>'+       
                                                '</div>'+
                                                '<!-- income_after_tax -->'+
                                                '<label class="col-md-2 label-heading" for="income_after_tax'+bus+'"><?php echo lang("income_after_tax"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="income_after_tax'+bus+'" name="income_after_tax[]" value="<?php echo set_value("income_after_tax['+bus+']"); ?>" placeholder="<?php echo lang("income_after_tax"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("income_after_tax[]"); ?></span>'+       
                                                '</div>'+ 
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- business_cost -->'+
                                                '<label class="col-md-2 label-heading" for="business_cost'+bus+'"><?php echo lang("business_cost"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="business_cost'+bus+'" name="business_cost[]" value="<?php echo set_value("business_cost['+bus+']"); ?>" placeholder="<?php echo lang("business_cost"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("business_cost[]"); ?></span>'+       
                                                '</div>'+
                                                '<!-- other_profit -->'+
                                                '<label class="col-md-2 label-heading" for="other_profit'+bus+'"><?php echo lang("other_profit"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="other_profit'+bus+'" name="other_profit[]" value="<?php echo set_value("other_profit['+bus+']"); ?>" placeholder="<?php echo lang("other_profit"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("other_profit[]"); ?></span>'+       
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- total_profit -->'+
                                                '<label class="col-md-2 label-heading" for="total_profit'+bus+'"><?php echo lang("total_profit"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="total_profit'+bus+'" name="total_profit[]" value="<?php echo set_value("total_profit['+bus+']"); ?>" placeholder="<?php echo lang("total_profit"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("total_profit[]"); ?></span>'+       
                                                '</div>'+
                                                '<!-- electric_water_expend -->'+
                                                '<label class="col-md-2 label-heading" for="electric_water_expend'+bus+'"><?php echo lang("electric_water_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="electric_water_expend'+bus+'" name="electric_water_expend[]" value="<?php echo set_value("electric_water_expend['+bus+']"); ?>" placeholder="<?php echo lang("electric_water_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("electric_water_expend[]"); ?></span>'+       
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- salary_food_expend -->'+
                                                '<label class="col-md-2 label-heading" for="salary_food_expend'+bus+'"><?php echo lang("salary_food_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="salary_food_expend'+bus+'" name="salary_food_expend[]" value="<?php echo set_value("salary_food_expend['+bus+']"); ?>" placeholder="<?php echo lang("salary_food_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("salary_food_expend[]"); ?></span>'+       
                                                '</div>'+
                                                '<!-- rent_house_expend -->'+
                                                '<label class="col-md-2 label-heading" for="rent_house_expend'+bus+'"><?php echo lang("rent_house_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="rent_house_expend'+bus+'" name="rent_house_expend[]" value="<?php echo set_value("rent_house_expend['+bus+']"); ?>" placeholder="<?php echo lang("rent_house_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("rent_house_expend[]"); ?></span>'+       
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- insurance_expend -->'+
                                                '<label class="col-md-2 label-heading" for="insurance_expend'+bus+'"><?php echo lang("insurance_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="insurance_expend'+bus+'" name="insurance_expend[]" value="<?php echo set_value("insurance_expend['+bus+']"); ?>" placeholder="<?php echo lang("insurance_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("insurance_expend[]"); ?></span>'+       
                                                '</div>'+
                                                '<!-- advertise_expend -->'+
                                                '<label class="col-md-2 label-heading" for="advertise_expend'+bus+'"><?php echo lang("advertise_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="advertise_expend'+bus+'" name="advertise_expend[]" value="<?php echo set_value("advertise_expend['+bus+']"); ?>" placeholder="<?php echo lang("advertise_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("advertise_expend[]"); ?></span>'+       
                                                '</div>'+ 
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- loan_expend -->'+
                                                '<label class="col-md-2 label-heading" for="loan_expend'+bus+'"><?php echo lang("loan_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="loan_expend'+bus+'" name="loan_expend[]" value="<?php echo set_value("loan_expend['+bus+']"); ?>" placeholder="<?php echo lang("loan_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("loan_expend[]"); ?></span>  '+     
                                                '</div>'+
                                                '<!-- tax_expend -->'+
                                                '<label class="col-md-2 label-heading" for="tax_expend'+bus+'"><?php echo lang("tax_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="tax_expend'+bus+'" name="tax_expend[]" value="<?php echo set_value("tax_expend['+bus+']"); ?>" placeholder="<?php echo lang("tax_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("tax_expend[]"); ?></span>'+       
                                                '</div>'+
                                            '</div>'+
                                            '<div class="form-group">'+
                                                '<!-- others_expend -->'+
                                                '<label class="col-md-2 label-heading" for="others_expend'+bus+'"><?php echo lang("others_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="others_expend'+bus+'" name="others_expend[]" value="<?php echo set_value("others_expend['+bus+']"); ?>" placeholder="<?php echo lang("others_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("others_expend[]"); ?></span> '+      
                                                '</div>'+
                                                '<!-- total_expend -->'+
                                                '<label class="col-md-2 label-heading" for="total_expend'+bus+'"><?php echo lang("total_expend"); ?></label>'+
                                                '<div class="col-md-4 ui-front">'+
                                                    '<input class="form-control"  type="number" id="total_expend'+bus+'" name="total_expend[]" value="<?php echo set_value("total_expend['+bus+']"); ?>" placeholder="<?php echo lang("total_expend"); ?>"/>'+
                                                    '<span class="text-danger"><?php echo form_error("total_expend[]"); ?></span>'+       
                                                '</div>'+
                                            '</div>'+
                                            '<!-- end income & expend -->'+

                                            '<div class="form-group">'+
                                                '<label for="function" class="col-md-3 label-heading">'+
                                                    '<!-- button add form -->'+
                                                    '<a href="javascript:void(0)" title="Remove Form" onclick="removeBusiness('+bus+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                                    '<!-- button remove form -->'+
                                                    ' <a href="javascript:void(0)" title="Add Form" onclick="addBusiness();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>'+
                                                '</label>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';

            $('.append-business').append(formBusiness);
            $('.select2').select2();
            $(function () {
                $("#business_start"+bus).datepicker({ 
                    dateFormat: 'dd-mm-yy',
                });
            });
            $(function () {
                $("#income_date"+bus).datepicker({ 
                    dateFormat: 'dd-mm-yy',
                });
            });

            /**
             * validation required form
             */
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
                
            /**
             * end validation required form
             */
        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE EMPLOYMENT FORM THAT APPENDED
    function removeBusiness(num){
        $('#removeBusiness'+num).remove();
    }
</script>
<!-- append employment -->  
<script type="text/javascript">
    var emp = <?php echo (!empty($this->input->post('employment_type')) ? count($this->input->post('employment_type'))-1 : 0); ?>;
    function addEmployment() {
        emp += 1;
        if (iden <= 10) {
            var formEmployment = '<div id="removeEmployment'+emp+'"><hr>' +
                                    '<div class="form-group">'+
                                        '<!-- employment_type -->'+
                                        '<label class="col-md-2 label-heading" for="employment_type'+emp+'"><?php echo lang("employment_type"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" name="employment_type[]" id="employment_type'+emp+'" >'+
                                                '<option value="">--- select employment type ---</option>'+
                                                '<option value="P">Current</option>'+
                                                '<option value="P">Previouse</option>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employment_type[]"); ?></span> '+
                                        '</div>'+
                                        '<!-- self_employee -->'+
                                        '<label class="col-md-2 label-heading" for="self_employee'+emp+'"><?php echo lang("self_employee"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="changeSelfEmployee()" name="self_employee[]" id="self_employee'+emp+'">'+
                                                '<option value="">--- select employment type ---</option>'+
                                                '<option value="Y">Yes</option>'+
                                                '<option value="N">No</option>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("self_employee[]"); ?></span>  '+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<!-- company_name -->'+
                                        '<label class="col-md-2 label-heading" for="company_name'+emp+'"><?php echo lang("company_name"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="text" id="company_name'+emp+'" name="company_name[]" value="<?php echo set_value("company_name['+emp+']"); ?>" placeholder="<?php echo lang("company_name"); ?>"/>'+
                                            '<span class="text-danger"><?php echo form_error("company_name[]"); ?></span>       '+
                                        '</div> '+
                                        '<!-- empbusiness_type_id -->'+
                                        '<label class="col-md-2 label-heading" for="empbusiness_type_id'+emp+'"><?php echo lang("business_type"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" name="empbusiness_type_id[]" id="empbusiness_type_id'+emp+'">'+
                                                '<option value="">--- select business type ---</option>'+
                                                '<?php if(!empty($businessType)): ?>'+
                                                    '<?php foreach ($businessType as $row):?>'+
                                                        '<option value="<?php echo $row->id; ?>"><?php echo $row->name_kh; ?></option>'+
                                                    '<?php endforeach; ?>'+
                                                '<?php endif; ?>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("empbusiness_type_id[]"); ?></span>     '+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<!-- employer_name -->'+
                                        '<label class="col-md-2 label-heading" for="employer_name'+emp+'"><?php echo lang("employer_name"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="text" id="employer_name'+emp+'" name="employer_name[]" value="<?php echo set_value("employer_name['+emp+']"); ?>" placeholder="<?php echo lang("employer_name"); ?>"/>'+
                                            '<span class="text-danger"><?php echo form_error("employer_name[]"); ?></span>       '+
                                        '</div> '+
                                        '<!-- emp_occupation -->'+
                                        '<label class="col-md-2 label-heading" for="emp_occupation'+emp+'"><?php echo lang("occupation"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="text" id="emp_occupation'+emp+'" name="emp_occupation[]" value="<?php echo set_value("occupation['+emp+']"); ?>" placeholder="<?php echo lang("employer_name"); ?>"/>'+
                                            '<span class="text-danger"><?php echo form_error("emp_occupation[]"); ?></span>     '+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<!-- length_of_service -->'+
                                        '<label class="col-md-2 label-heading" for="length_of_service'+emp+'"><?php echo lang("length_of_service"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="text" id="length_of_service'+emp+'" name="length_of_service[]" value="<?php echo set_value("length_of_service['+emp+']"); ?>" placeholder="<?php echo lang("length_of_service"); ?>"/>'+
                                            '<span class="text-danger"><?php echo form_error("length_of_service[]"); ?></span>       '+
                                        '</div> '+
                                        '<!-- employer_address_type -->'+
                                        '<label class="col-md-2 label-heading" for="employer_address_type'+emp+'"><?php echo lang("employer_address_type"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" name="employer_address_type[]" id="employer_address_type'+emp+'">'+
                                                '<option value="">--- select address type* ---</option>'+
                                                '<option value="RESID">Residential</option>'+
                                                '<option value="WORK">Work</option>'+
                                                '<option value="POST">Correspondence</option>'+
                                                '<option value="U">Unknown</option>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employer_address_type[]"); ?></span>     '+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<!-- employer_id -->'+
                                        '<label class="col-md-2 label-heading" for="employer_id'+emp+'"><?php echo lang("employer_id"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="text" id="employer_id'+emp+'" name="employer_id[]" value="<?php echo set_value("employer_id['+emp+']"); ?>" placeholder="<?php echo lang("employer_id"); ?>"/>'+
                                            '<span class="text-danger"><?php echo form_error("employer_id[]"); ?></span>     '+
                                        '</div>'+
                                        '<!-- employer_country -->'+
                                        '<label class="col-md-2 label-heading" for="employer_country'+emp+'"><?php echo lang("country"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectEmployerCountry('+emp+')" name="employer_country[]" id="employer_country'+emp+'">'+
                                                '<option value="">--- Select Country ---</option>'+
                                                '<?php if(!empty($country)): ?>'+
                                                    '<?php foreach($country as $row):?>'+
                                                        '<option value="<?php echo $row->id?>"><?php echo $row->name_en?></option>'+
                                                    '<?php endforeach; ?>'+
                                                '<?php endif; ?>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employer_country[]"); ?></span>  '+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">     '+
                                        '<!-- employer_province -->'+
                                        '<label class="col-md-2 label-heading" for="employer_province'+emp+'"><?php echo lang("province"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectEmployerProvince('+emp+')" name="employer_province[]" id="employer_province'+emp+'">'+
                                                '<option value="">--- Province ---</option>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employer_province[]"); ?></span>      '+
                                        '</div>                       '+
                                        '<!-- employer_district -->'+
                                        '<label class="col-md-2 label-heading" for="employer_district'+emp+'"><?php echo lang("district"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectEmployerDistrict('+emp+')" name="employer_district[]" id="employer_district'+emp+'" >'+
                                            '<option value="">--- District ---</option>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employer_district[]"); ?></span>     '+
                                        '</div>                           '+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<!-- employer_commune -->'+
                                        '<label class="col-md-2 label-heading" for="employer_commune'+emp+'"><?php echo lang("commune"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectEmployerCommune('+emp+')" id="employer_commune'+emp+'" name="employer_commune[]">'+
                                                '<option value="">--- Commune ---</option>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employer_commune[]"); ?></span>       '+
                                        '</div> '+
                                        '<!-- employer_village -->'+
                                        '<label class="col-md-2 label-heading" for="employer_village'+emp+'"><?php echo lang("village"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" name="employer_village[]" id="employer_village'+emp+'">'+
                                                '<option value="">--- Village ---</option>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employer_village[]"); ?></span>     '+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">                            '+
                                        '<!-- employer_houseno -->'+
                                        '<label class="col-md-2 label-heading" for="employer_houseno'+emp+'"><?php echo lang("house_no"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="text" id="employer_houseno'+emp+'" name="employer_houseno[]" value="<?php echo set_value("employer_houseno['+emp+']"); ?>" placeholder="#..."  required/>'+
                                            '<span class="text-danger"><?php echo form_error("employer_houseno[]"); ?></span>       '+
                                        '</div> '+
                                        '<!-- employer_street -->'+
                                        '<label class="col-md-2 label-heading" for="employer_street'+emp+'"><?php echo lang("street"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="text" id="employer_street'+emp+'" name="employer_street[]" value="<?php echo set_value("employer_street['+emp+']"); ?>" placeholder="No..."  required/>'+
                                            '<span class="text-danger"><?php echo form_error("employer_street[]"); ?></span>       '+
                                        '</div>                           '+
                                    '</div>    '+
                                    '<div class="form-group">    '+
                                        '<!-- employed_year -->'+
                                        '<label class="col-md-2 label-heading" for="employed_year'+emp+'"><?php echo lang("employed_year"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="number" id="employed_year'+emp+'" name="employed_year[]" value="<?php echo set_value("employed_year['+emp+']"); ?>" placeholder="<?php echo lang("employed_year"); ?>"  required/>'+
                                            '<span class="text-danger"><?php echo form_error("employed_year[]"); ?></span>       '+
                                        '</div>                          '+
                                        '<!-- employee_currency -->'+
                                        '<label class="col-md-2 label-heading" for="employee_currency'+emp+'"><?php echo lang("currency"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<select class="form-control select2" style="width:100%" data-live-search="true" id="employee_currency'+emp+'" name="employee_currency[]">'+
                                                '<option>--- select currency ---</option>'+
                                                '<?php if(!empty(listCurrency())): ?>'+
                                                    '<?php foreach (listCurrency() as $curr):?>'+
                                                        '<option <?php echo $curr->id ?>><?php echo $curr->name_en." (".$curr->currency_code.")"; ?></option>'+
                                                    '<?php endforeach; ?>'+
                                                '<?php endif; ?>'+
                                            '</select>'+
                                            '<span class="text-danger"><?php echo form_error("employee_currency[]"); ?></span>       '+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<!-- emplyee_salary -->'+
                                        '<label class="col-md-2 label-heading" for="emplyee_salary'+emp+'"><?php echo lang("emplyee_salary"); ?></label>'+
                                        '<div class="col-md-4 ui-front">'+
                                            '<input class="form-control"  type="number" id="emplyee_salary'+emp+'" name="emplyee_salary[]" value="<?php echo set_value("emplyee_salary['+emp+']"); ?>" placeholder="<?php echo lang("emplyee_salary") ?>" required/>'+
                                            '<span class="text-danger"><?php echo form_error("emplyee_salary[]"); ?></span>       '+
                                        '</div>'+
                                        '<label for="function" class="col-md-3 label-heading">'+
                                            '<!-- button add form -->'+
                                            '<a href="javascript:void(0)" title="Remove Form" onclick="removeEmployment('+emp+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                            '<!-- button remove form -->'+
                                            ' <a href="javascript:void(0)" title="Add Form" onclick="addEmployment();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>'+
                                        '</label>'+
                                    '</div>'+
                                '</div>';

            $('.append-employment').append(formEmployment);

            $('.select2').select2();

            /**
             * validation required form
             */
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

            /**
             * end validation required form
             */
            
        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE EMPLOYMENT FORM THAT APPENDED
    function removeEmployment(num){
        $('#removeEmployment'+num).remove();
    }
</script>
<!-- add identification append -->
<script type="text/javascript">
    var iden = <?php echo (!empty($this->input->post('identification_type')) ? count($this->input->post('identification_type'))-1 : 0); ?>;
    function addIdentification() {
        iden += 1;
        if (iden <= 10) {
            var formIdentification = '<div id="removeIdentification'+iden+'"><hr>' +
                                        '<div class="form-group">'+
                                            '<!-- identification_type -->'+
                                            '<label class="col-md-2 label-heading" for="identification_type'+iden+'"><?php echo lang("id_type"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<select class="form-control select2" style="width:100%" data-live-search="true" id="identification_type'+iden+'" name="identification_type[]" required>'+
                                                    '<option value="">--- select id type ---</option>'+
                                                    '<?php if(!empty($identificationType)): ?>'+
                                                        '<?php foreach($identificationType as $row):?>'+
                                                            '<option value="<?php echo $row->id;?>"><?php echo $row->name_en?></option>'+
                                                        '<?php endforeach; ?>'+
                                                    '<?php endif; ?>'+
                                                '</select>'+
                                                '<span class="text-danger"><?php echo form_error("identification_type[]"); ?></span>     '+
                                            '</div>'+
                                            '<!-- identification_code -->'+
                                            '<label class="col-md-2 label-heading" for="identification_code'+iden+'"><?php echo lang("id_code"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" id="identification_code'+iden+'" name="identification_code[]" value="<?php echo set_value("identification_code['+iden+']"); ?>" placeholder="<?php echo lang("id_code"); ?>" required/>'+
                                                '<span class="text-danger"><?php echo form_error("identification_code[]"); ?></span>       '+
                                            '</div> '+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<!-- identification_issue_place -->'+
                                            '<label class="col-md-2 label-heading" for="identification_issue_place'+iden+'"><?php echo lang("issue_place"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" id="identification_issue_place'+iden+'" name="identification_issue_place[]" value="<?php echo set_value("identification_issue_place['+iden+']"); ?>" placeholder="<?php echo lang("issue_place"); ?>" required/>'+
                                                '<span class="text-danger"><?php echo form_error("identification_issue_place[]"); ?></span>       '+
                                            '</div> '+
                                            '<!-- identification_issue_date -->'+
                                            '<label class="col-md-2 label-heading" for="identification_issue_date'+iden+'"><?php echo lang("issue_date"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" id="identification_issue_date'+iden+'" name="identification_issue_date[]" value="<?php echo set_value("identification_issue_date['+iden+']"); ?>" placeholder="dd-mm-yyyy" required/>'+
                                                '<span class="text-danger"><?php echo form_error("identification_issue_date[]"); ?></span>       '+
                                            '</div> '+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<!-- identification_expiry_date -->'+
                                            '<label class="col-md-2 label-heading" for="identification_expiry_date'+iden+'"><?php echo lang("expiry_date"); ?></label>'+
                                            '<div class="col-md-4 ui-front">'+
                                                '<input class="form-control"  type="text" id="identification_expiry_date'+iden+'" name="identification_expiry_date[]" value="<?php echo set_value("expiry_date['+iden+']"); ?>" placeholder="dd-mm-yyyy" required/>'+
                                                '<span class="text-danger"><?php echo form_error("identification_expiry_date[]"); ?></span>       '+
                                            '</div>'+
                                            '<label for="function" class="col-md-3 label-heading">'+
                                            '<!-- button add form -->'+
                                            '<a href="javascript:void(0)" title="Remove Form" onclick="removeIdentification('+iden+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                            '<!-- button remove form -->'+
                                            ' <a href="javascript:void(0)" title="Add Form" onclick="addIdentification();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>'+
                                            '</label>'+
                                        '</div>'+
                                    '</div>';

            $('.append-identification').append(formIdentification);
            $('.select2').select2();
            $(function () {
                $("#identification_issue_date"+iden).datepicker({ 
                    dateFormat: 'dd-mm-yy',
                    onClose: function(dfr){
                        // set minDate for identification_expiry_date
                        $("#identification_expiry_date"+iden).datepicker("option", "minDate", dfr);
                    }
                });
            });
            $(function () {
                $("#identification_expiry_date"+iden).datepicker({ 
                    dateFormat: 'dd-mm-yy',
                });
            });

            /**
             * validation required form
             */
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
                
            /**
             * end validation required form
             */
        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE IDENTIFICATION FORM THAT APPENDED
    function removeIdentification(num){
        $('#removeIdentification'+num).remove();
    }
</script>
<!-- contact address multiple append -->
<script type="text/javascript">
    var num = <?php echo (!empty($this->input->post('country_id')) ? count($this->input->post('country_id'))-1 : 0); ?>;;
    function addContact(num=null) {
        num += 1;
        if (num <= 10) {
            var formContact = '<div id="removeContact'+num+'"><hr>' +
                        '<div class="form-group">'+
                            '<!-- country_id -->'+
                            '<label class="col-md-2 label-heading" for="country_id'+num+'"><?php echo lang("country"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectCountry('+num+')" name="country_id[]" id="country_id'+num+'">'+
                                    '<option value="">--- Select Country ---</option>'+
                                    '<?php if(!empty($country)): ?>'+
                                        '<?php foreach($country as $row):?>'+
                                            '<option value="<?php echo $row->id?>"><?php echo $row->name_en?></option>'+
                                        '<?php endforeach; ?>'+
                                    '<?php endif; ?>'+
                                '</select>'+
                                '<span class="text-danger"><?php echo form_error("country_id[]"); ?></span>  '+
                            '</div>'+
                            '<!-- province_id -->'+
                            '<label class="col-md-2 label-heading" for="province_id'+num+'"><?php echo lang("province"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectProvince('+num+')" name="province_id[]" id="province_id'+num+'">'+
                                    '<option value="">--- Province ---</option>'+
                                '</select>'+
                                '<span class="text-danger"><?php echo form_error("province_id[]"); ?></span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<!-- district_id -->'+
                            '<label class="col-md-2 label-heading" for="district_id'+num+'"><?php echo lang("district"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectDistrict('+num+')" name="district_id[]" id="district_id'+num+'" >'+
                                    '<option value="">--- District ---</option>'+
                                '</select>'+
                                '<span class="text-danger"><?php echo form_error("district_id[]"); ?></span>'+
                            '</div>'+
                            '<!-- commune_id -->'+
                            '<label class="col-md-2 label-heading" for="commune_id'+num+'"><?php echo lang("commune"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<select class="form-control select2" style="width:100%" data-live-search="true" onchange="selectCommune('+num+')" name="commune_id[]" id="commune_id'+num+'"'+
                                    '<option value="">--- Commune ---</option>'+
                                '</select>'+
                                '<span class="text-danger"><?php echo form_error("commune_id[]"); ?></span>'+
                            '</div>                            '+
                        '</div>'+
                        '<div class="form-group">'+
                            '<!-- village_id -->'+
                            '<label class="col-md-2 label-heading" for="village_id'+num+'"><?php echo lang("village"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<select class="form-control select2" style="width:100%" data-live-search="true" name="village_id[]" id="village_id'+num+'">'+
                                    '<option value="">--- Village ---</option>'+
                                '</select>'+
                                '<span class="text-danger"><?php echo form_error("village_id[]"); ?></span>'+
                            '</div>'+
                            '<!-- city -->'+
                            '<label class="col-md-2 label-heading" for="city'+num+'"><?php echo lang("city"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="text" id="city'+num+'" name="city[]" value="<?php echo set_value("city['+num+']"); ?>" placeholder="<?php echo lang("city"); ?>"/>'+
                                '<span class="text-danger"><?php echo form_error("city[]"); ?></span>'+
                            '</div> '+
                        '</div>'+
                        '<div class="form-group">'+
                            '<!-- house_no -->'+
                            '<label class="col-md-2 label-heading" for="house_no'+num+'"><?php echo lang("house_no"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="text" id="house_no'+num+'" name="house_no[]" value="<?php echo set_value("house_no['+num+']"); ?>" placeholder="<?php echo lang("house_no"); ?>"  required/>'+
                                '<span class="text-danger"><?php echo form_error("house_no[]"); ?></span>'+
                            '</div> '+
                            '<!-- street -->'+
                            '<label class="col-md-2 label-heading" for="street'+num+'"><?php echo lang("street"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="text" id="street'+num+'" name="street[]" value="<?php echo set_value("street['+num+']"); ?>" placeholder="<?php echo lang("street"); ?>"  required/>'+
                                '<span class="text-danger"><?php echo form_error("street[]"); ?></span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<!-- phone1 -->'+
                            '<label class="col-md-2 label-heading" for="phone1'+num+'"><?php echo lang("phone1"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="text" id="phone1'+num+'" name="phone1[]" value="<?php echo set_value("phone1['+num+']"); ?>" placeholder="0123456789"  required/>'+
                                '<span class="text-danger"><?php echo form_error("phone1[]"); ?></span>'+
                            '</div> '+
                            '<!-- phone2 -->'+
                            '<label class="col-md-2 label-heading" for="phone2'+num+'"><?php echo lang("phone2"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="number" id="phone2'+num+'" name="phone2[]" value="<?php echo set_value("phone2['+num+']"); ?>" placeholder="0123456789"/>'+
                                '<span class="text-danger"><?php echo form_error("phone2[]"); ?></span>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<!-- email -->'+
                            '<label class="col-md-2 label-heading" for="email'+num+'"><?php echo lang("email"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="email" id="email'+num+'" name="email[]" value="<?php echo set_value("email['+num+']"); ?>" placeholder="example@gmail.com"  required/>'+
                                '<span class="text-danger"><?php echo form_error("email[]"); ?></span>'+
                            '</div> '+
                            '<!-- map_latitude -->'+
                            '<label class="col-md-2 label-heading" for="map_latitude'+num+'"><?php echo lang("map_latitude"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="number" id="map_latitude'+num+'" name="map_latitude[]" value="" placeholder="<?php echo lang("map_latitude"); ?>"/>'+
                                '<span class="text-danger"><?php echo form_error("map_latitude[]"); ?></span>'+
                            '</div>                            '+
                        '</div> '+
                        '<div class="form-group">'+
                            '<!-- map_longitude -->'+
                            '<label class="col-md-2 label-heading" for="map_longitude'+num+'"><?php echo lang("map_longitude"); ?></label>'+
                            '<div class="col-md-4 ui-front">'+
                                '<input class="form-control"  type="number" id="map_longitude'+num+'" name="map_longitude[]" value="" placeholder="<?php echo lang("map_longitude"); ?>"/>'+
                                '<span class="text-danger"><?php echo form_error("map_longitude[]"); ?></span>'+
                            '</div> '+
                            '<label for="function" class="col-md-3 label-heading">'+
                                '<!-- button add form -->'+
                                '<a href="javascript:void(0)" title="Remove Form" onclick="removeContact('+num+')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span></a>'+
                                '<!-- button remove form -->'+
                                ' <a href="javascript:void(0)" title="Add Form" onclick="addContact();" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></a>'+
                            '</label>'+
                            '<div class="col-md-4 ui-front" >'+
                            '</div>'+
                        '</div>'+
                    '</div>';

            $('.append-contact').append(formContact);
            $('.select2').select2();

            /**
             * validation required form
             */
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
                
            /**
             * end validation required form
             */
        } else {
            alert("You can add only 10 forms!");
        }
    }
    // REMOVE REQUEST TYPE THAT APPENDED
    function removeContact(num){
        $('#removeContact'+num).remove();
    }
</script>
<!-- append business by self_employee of employment -->
<script type="text/javascript">
    function changeSelfEmployee(){
        $("select[name='self_employee[]']").each(function(){
            $('li#active-business').remove();// remove li of business
            $('#business').hide(); // hide business content
            if($(this).val() == 'Y'){ // if self employee yes, show business income expend
                $('li#active-employment').after('<li id="active-business"><a data-toggle="tab" href="#business"><?php echo lang('business'); ?></a></li>');
                $('#business').show();
                return false;
            }
        });
    }
</script>
<!-- alert notification -->
<script type="text/javascript">
    $('.select2').select2();
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>
<!-- date format -->
<script type="text/javascript">
    $(function () {
        $("#dob").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
    $(function () {
        $("#spouse_dob").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
    $(function () {
        $("#spouse_issue_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
    $(function () {
        $("#identification_issue_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
            onClose: function(dfr){
                // set minDate for identification_expiry_date
                $("#identification_expiry_date").datepicker("option", "minDate", dfr);
            }
        });
    });
    $(function () {
        $("#identification_expiry_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
    $(function () {
        $("#business_start").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
    $(function () {
        $("#income_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
</script>

