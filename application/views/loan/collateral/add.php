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
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> <?php echo lang("add").' '.lang('loan').' '.lang('collateral'); ?></div>
        <div class="db-header-extra"> 
        </div>
    </div>

    <!-- form body -->
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo form_open_multipart(site_url($link."/create"), array("class" => "form-horizontal")) ?>
                <div class="col-md-12">
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
                        <!-- asset_type -->
                        <label class="col-md-2 label-heading" for="asset_type"><?php echo lang('asset_type'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="asset_type" id="asset_type" required>
                                <option value="">--- select asset type ---</option>
                                <option value="Movable Assets" <?php echo set_select('asset_type', 'Movable Assets'); ?>>Movable Assets</option>
                                <option value="Imovable Assets" <?php echo set_select('asset_type', 'Imovable Assets'); ?>>Imovable Assets</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('asset_type'); ?></span>  
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- owner_name -->
                        <label class="col-md-2 label-heading" for="owner_name"><?php echo lang('owner_name'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="owner_name" id="owner_name" value="<?php echo set_value('owner_name'); ?>" placeholder="<?php echo lang('owner_name'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('owner_name'); ?></span>
                        </div>
                        <!-- owner_spouse_name -->
                        <label class="col-md-2 label-heading" for="owner_spouse_name"><?php echo lang('owner_spouse_name'); ?> </label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="owner_spouse_name" id="owner_spouse_name" value="<?php echo set_value('owner_spouse_name'); ?>" placeholder="<?php echo lang('owner_spouse_name'); ?>"/>
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
                                    <?php foreach($relations as $row):?>
                                        <option value="<?php echo $row->id?>" <?php echo set_select('relation_id', $row->id); ?>><?php echo $row->relation_code.' - '.$row->name_kh;?></option>
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
                                <option value="Legal entity" <?php echo set_select('represent_type', 'Legal entity'); ?>>Legal entity</option>
                                <option value="Individual entity" <?php echo set_select('represent_type', 'Individual entity'); ?>>Individual entity</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('represent_type'); ?></span>  
                        </div>                            
                    </div>
                    <div class="form-group">
                        <!-- representor -->
                        <label class="col-md-2 label-heading" for="representor"><?php echo lang('representor'); ?> </label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="representor" id="representor" value="<?php echo set_value('representor'); ?>" placeholder="<?php echo lang('representor_of_collateral'); ?>" readonly/>
                            <span class="text-danger"><?php echo form_error('representor'); ?></span>
                        </div>
                        <!-- document_type -->
                        <label class="col-md-2 label-heading" for="document_type"><?php echo lang('document_type'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="document_type" id="document_type" required>
                                <option value="">--- select document type ---</option>
                                <option value="Hypotec" <?php echo set_select('document_type', 'Hypotec'); ?>>Hypotec</option>
                                <option value="Plong" <?php echo set_select('document_type', 'Plong'); ?>>Plong</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('document_type'); ?></span> 
                        </div>                          
                    </div>
                    <div class="form-group">                            
                        <!-- size -->
                        <label class="col-md-2 label-heading" for="size"><?php echo lang('size_of_collateral'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="size" id="size" value="<?php echo set_value('size'); ?>" placeholder="<?php echo lang('size_of_collateral'); ?>"/>
                            <span class="text-danger"><?php echo form_error('size'); ?></span>
                        </div>  
                        <!-- collateral_type_id -->
                        <label class="col-md-2 label-heading" for="collateral_type_id"><?php echo lang('collateral_type_id'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="collateral_type_id" id="collateral_type_id" required>
                                <option value="">--- select collateral type ---</option>
                                <?php if(!empty($collateralTypes)): ?>
                                    <?php foreach($collateralTypes as $row):?>
                                        <option value="<?php echo $row->id?>" <?php echo set_select('collateral_type_id', $row->id); ?>><?php echo $row->code.' - '.$row->name_kh;?></option>
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
                                <?php if(!empty($country)): ?>
                                    <?php foreach($country as $row):?>
                                        <option value="<?php echo $row->id?>" <?php echo set_select('country_id', $row->id); ?>><?php echo $row->name_en?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('country_id'); ?></span>  
                        </div>
                        <!-- province_id -->
                        <label class="col-md-2 label-heading" for="province_id"><?php echo lang('province'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="province_id" id="province_dropdown" required>
                                <?php echo selectedProvince(set_value('country_id'), set_value('province_id')); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('province_id'); ?></span>      
                        </div>
                    </div>
                    <div class="form-group">                            
                        <!-- district_id -->
                        <label class="col-md-2 label-heading" for="district_id"><?php echo lang('district'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="district_id" id="district_dropdown" required>
                                <?php echo selectedDistrict(set_value('province_id'), set_value('district_id')); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('district_id'); ?></span>     
                        </div>
                        <!-- commune_id -->
                        <label class="col-md-2 label-heading" for="commune_id"><?php echo lang('commune'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" id='commune_dropdown' name="commune_id" required>
                                <?php echo selectedCommune(set_value('district_id'), set_value('commune_id')); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('commune_id'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">
                        <!-- village_id -->
                        <label class="col-md-2 label-heading" for="village_id"><?php echo lang('village'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <select class="form-control select2" style='width:100%' data-live-search="true" name="village_id" id='village_dropdown' required>
                                <?php echo selectedVillage(set_value('commune_id'), set_value('village_id')); ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('village_id'); ?></span>    
                        </div>
                        <!-- document_number -->
                        <label class="col-md-2 label-heading" for="document_number"><?php echo lang('document_number'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="document_number" id="document_number" value="<?php echo set_value('document_number'); ?>" placeholder="<?php echo lang('document_number'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('document_number'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">                            
                        <!-- issue_date -->
                        <label class="col-md-2 label-heading" for="issue_date"><?php echo lang('issue_date'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="issue_date" id="issue_date" value="<?php echo set_value('issue_date'); ?>" placeholder="<?php echo lang('issue_date'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('issue_date'); ?></span>
                        </div>
                        <!-- issue_place -->
                        <label class="col-md-2 label-heading" for="issue_place"><?php echo lang('issue_place'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="text" id='issue_place' name="issue_place" value="<?php echo set_value('issue_place'); ?>" placeholder="<?php echo lang('issue_place'); ?>"  required/>
                            <span class="text-danger"><?php echo form_error('issue_place'); ?></span>       
                        </div>                            
                    </div>
                    <div class="form-group">                            
                        <!-- issue_by -->
                        <label class="col-md-2 label-heading" for="issue_by"><?php echo lang('issue_by'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="issue_by" id="issue_by" value="<?php echo set_value('issue_by'); ?>" placeholder="<?php echo lang('issue_by'); ?>" required/>
                            <span class="text-danger"><?php echo form_error('issue_by'); ?></span>
                        </div>
                        <!-- purchased_price -->
                        <label class="col-md-2 label-heading" for="purchased_price"><?php echo lang('purchased_price'); ?></label>
                        <div class="col-md-4 ui-front">
                            <div class="input-group">
                              <input class='form-control'  type="text" id='purchased_price' name="purchased_price" value="<?php echo set_value('purchased_price'); ?>" placeholder="<?php echo lang('purchased_price'); ?>" />
                              <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0">
                                <select name="currency" id="currency">
                                  <?php if(!empty(listCurrency())): ?>
                                      <?php foreach (listCurrency() as $curr): ?>
                                        <option value="<?php echo $curr->id;?>" <?php echo set_select('currency', $curr->id); ?>><?php echo $curr->currency_code; ?></option>
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
                              <input class='form-control' type="text" name="valuation_price" id="valuation_price" value="<?php echo set_value('valuation_price'); ?>" placeholder="<?php echo lang('valuation_price'); ?>"/>
                              <div class="input-group-addon" style="padding-top: 0; padding-bottom: 0"><span id="currencysign">USD</span></div>
                            </div>
                            <span class="text-danger"><?php echo form_error('valuation_price'); ?></span>
                        </div>
                        <!-- valuer -->
                        <label class="col-md-2 label-heading" for="valuer"><?php echo lang('valuer'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="text" id='valuer' name="valuer" value="<?php echo set_value('valuer'); ?>" placeholder="<?php echo lang('valuer'); ?>" />
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
                                    <?php foreach (findOfficer() as $user):?>
                                        <option value="<?php echo $user->ID; ?>" <?php echo (set_value('officer') == $user->ID ? 'selected' : ''); ?>><?php echo $user->first_name . ' ' . $user->last_name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('customer_id'); ?></span> 
                        </div>
                        <!-- recieved_date -->
                        <label class="col-md-2 label-heading" for="recieved_date"><?php echo lang('recieved_date'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control' type="text" name="recieved_date" id="recieved_date" value="<?php echo set_value('recieved_date'); ?>" placeholder="<?php echo lang('recieved_date'); ?>" required/>
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
                                    <?php foreach(getAllUsers() as $row):?>
                                        <option value="<?php echo $row->ID?>" <?php echo set_select('recieved_by'); ?>><?php echo $row->staff_id.' - '.$row->first_name.' '.$row->last_name;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('recieved_by'); ?></span>     
                        </div>                         
                        <!-- withdrawal_date -->
                        <label class="col-md-2 label-heading" for="withdrawal_date"><?php echo lang('withdrawal_date'); ?> <sup class="text-danger">*</sup></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="text" id='withdrawal_date' name="withdrawal_date" value="<?php echo set_value('withdrawal_date'); ?>" placeholder="<?php echo lang('withdrawal_date'); ?>"  required/>
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
                                    <?php foreach(getAllUsers() as $row):?>
                                        <option value="<?php echo $row->ID?>" <?php echo set_select('withdrawal_by'); ?>><?php echo $row->staff_id.' - '.$row->first_name.' '.$row->last_name;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('withdrawal_by'); ?></span>   
                        </div>   
                        <!-- map_latitude -->
                        <label class="col-md-2 label-heading" for="map_latitude"><?php echo lang('map_latitude'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="number" min="0" id='map_latitude' name="map_latitude" value="<?php echo set_value('map_latitude'); ?>" placeholder="<?php echo lang('map_latitude'); ?>"/>
                            <span class="text-danger"><?php echo form_error('map_latitude'); ?></span>       
                        </div>                     
                    </div>
                    <div class="form-group">
                        <!-- map_longitude -->
                        <label class="col-md-2 label-heading" for="map_longitude"><?php echo lang('map_longitude'); ?></label>
                        <div class="col-md-4 ui-front">
                            <input class='form-control'  type="number" min="0" id='map_longitude' name="map_longitude" value="<?php echo set_value('map_longitude'); ?>" placeholder="<?php echo lang('map_longitude'); ?>"/>
                            <span class="text-danger"><?php echo form_error('map_longitude'); ?></span>       
                        </div> 
                        <!--status-->
                        <div class="form-group">
                            <label for="status" class="col-md-2 label-heading">Status</label>
                            <div class="col-md-4 ui-front">
                                <select name="status" id="status" class="form-control select2" required>
                                    <option value="1" <?php echo set_select('status', '1'); ?>>Active</option>
                                    <option value="0" <?php echo set_select('status', '0'); ?>>In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End  info  -->  

                    <!-- attachment -->
                    <legend><?php echo lang("attachment").' '.lang("files"); ?></legend>
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
                    <!-- End identification document --> 

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
    $('.select2').select2();
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
    document.getElementById('attachment_files').addEventListener('change', handleFileSelect, false);
</script>
<script type="text/javascript">
    $('#represent_type').on('change', function () {
        if(this.value == 'Legal entity'){
           $('#representor').removeAttr('readonly');
        }else{
            $('#representor').attr('readonly','readonly');
        }
    });
    $('#currency').on('change', function(){
        $.ajax({
            url: 'getCurrnecySign/'+$(this).val(),
            type: 'get',
            success: function(output){
                console.log(output);
                $('#currencysign').text(output);
            }
        });
        
    });
      // $('#purchased_price').simpleMoneyFormat();
      // $('#valuation_price').simpleMoneyFormat();
</script>
<!-- date format -->
<script type="text/javascript">
    $(function () {
        $("#issue_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
    $(function () {
        $("#recieved_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
    $(function () {
        $("#withdrawal_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
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
