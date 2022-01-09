<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li class="active"><?php echo lang("ctn_89") ?></li>
</ol>

<p><?php echo lang("ctn_90") ?></p>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open_multipart(site_url("admin/settings_pro"), array("class" => "form-horizontal")) ?>

<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_91") ?></label>
    <div class="col-sm-10">
    	<input type="text" class="form-control" id="name-in" name="site_name" placeholder="" value="<?php echo $this->settings->info->site_name ?>">
    	<span class="help-block"><?php echo lang("ctn_92") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="name-in" class="col-sm-2 control-label"><?php echo lang("ctn_379") ?></label>
    <div class="col-sm-10">
        <select name="logo_option" class="form-control">
        <option value="0"><?php echo lang("ctn_380") ?></option>
        <option value="1" <?php if($this->settings->info->logo_option == 1) echo "selected" ?>><?php echo lang("ctn_381") ?></option>
        </select>
        <span class="help-block"><?php echo lang("ctn_382") ?></span>
    </div>
</div>
  
<div class="form-group">
            <label for="desc-in" class="col-sm-2 control-label"><?php echo lang("ctn_93") ?></label>
            <div class="col-sm-10">
                <textarea name="site_desc" id="site_desc"><?php echo $this->settings->info->site_desc ?></textarea>
	            <span class="help-block"><?php echo lang("ctn_94") ?></span>
	        </div>
</div>
<div class="form-group">
    <label for="se-in" class="col-sm-2 control-label"><?php echo lang("ctn_95") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="se-in" name="site_email" placeholder="" value="<?php echo $this->settings->info->site_email ?>">
        <span class="help-block"><?php echo lang("ctn_96") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="se-in" class="col-sm-2 control-label"><?php echo lang("ctn_670") ?></label>
    <div class="col-sm-10">
        <select name="layoutid" class="form-control">
        <?php foreach($layouts->result() as $r) : ?>
            <option value="<?php echo $r->ID ?>" <?php if($r->layout_path == $this->settings->info->layout) echo "selected" ?>><?php echo $r->name ?></option>
        <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="image-in" class="col-sm-2 control-label"><?php echo lang("ctn_97") ?></label>
    <div class="col-sm-10">
        <?php if(!empty($this->settings->info->site_logo)) : ?>
            <p><img src='<?php echo base_url().$this->settings->info->upload_path_relative . "/" . $this->settings->info->site_logo ?>'></p>
        <?php endif; ?>
        <input type="file" name="userfile" size="20" />
        <span class="help-block"><?php echo lang("ctn_98") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="image-in" class="col-sm-2 control-label"><?php echo lang("ctn_746") ?></label>
    <div class="col-sm-5">
        <input type="text" name="logo_width" value="<?php echo $this->settings->info->logo_width ?>" class="form-control" placeholder="Logo Width ... " ?>
    </div>
    <div class="col-sm-5">
        <input type="text" name="logo_height" value="<?php echo $this->settings->info->logo_height ?>" class="form-control" placeholder="Logo Height ... " ?>
    </div>
</div>
<div class="form-group">
    <label for="pname-in" class="col-sm-2 control-label"><?php echo lang("ctn_99") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="pname-in" name="upload_path" placeholder="" value="<?php echo $this->settings->info->upload_path ?>" ><br />
        <span class="help-block"><?php echo lang("ctn_100") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_101") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="dpname-in" name="upload_path_relative" placeholder="" value="<?php echo $this->settings->info->upload_path_relative ?>" ><br />
        <span class="help-block"><?php echo lang("ctn_102") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_103") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="dpname-in" name="date_format" placeholder="" value="<?php echo $this->settings->info->date_format ?>" ><br />
        <span class="help-block"><?php echo lang("ctn_104") ?> <a href="http://php.net/manual/en/function.date.php">http://php.net/manual/en/function.date.php</a></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_105") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="dpname-in" name="file_types" placeholder="" value="<?php echo $this->settings->info->file_types ?>" ><br />
        <span class="help-block"><?php echo lang("ctn_106") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_107") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="dpname-in" name="file_size" placeholder="" value="<?php echo $this->settings->info->file_size ?>" ><br />
        <span class="help-block"><?php echo lang("ctn_108") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_619") ?> & <?php echo lang("ctn_621") ?></label>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="dpname-in" name="avatar_width" placeholder="" value="<?php echo $this->settings->info->avatar_width ?>" >
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="dpname-in" name="avatar_height" placeholder="" value="<?php echo $this->settings->info->avatar_height ?>" >
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_845") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" class="form-control" id="dpname-in" name="resize_avatar" value="1" <?php if($this->settings->info->resize_avatar) echo "checked" ?>><br />
        <span class="help-block"><?php echo lang("ctn_846") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_383") ?></label>
    <div class="col-sm-10">
        <textarea name="notes" id="notes-area"><?php echo $this->settings->info->notes ?></textarea>
        <span class="help-block"><?php echo lang("ctn_384") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_344") ?></label>
    <div class="col-sm-10">
        <!-- <select name="default_user_role" class="form-control">
        <option value="0"><?php //echo lang("ctn_46") ?></option>
        <?php// foreach($roles->result() as $r) : ?>
            <option value="<?ph//p echo $r->ID ?>" <?php// if($r->ID == $this->settings->info->default_user_role) echo "selected" ?>><?php// echo $r->name ?></option>
        <?php //endforeach; ?>  
        </select> -->
        <select name="default_user_role" id="default_user_role" class="form-control select2" style="width: 100%" required>
            <option value="0"><?php echo lang("ctn_46") ?></option>
            <?php 
            if(!empty(findRoleActive())):
                foreach(findRoleActive() as $role) : ?>
                    <option value="<?php echo $role->role_id; ?>" <?php if($role->role_id == $this->settings->info->default_user_role) echo "selected" ?>><?php echo $role->role_name; ?></option>
                <?php endforeach;
            endif;?>
        </select>
        <span class="help-block"><?php echo lang("ctn_345") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_109") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" name="register" value="1" <?php if($this->settings->info->register) echo "checked" ?> />
        <span class="help-block"><?php echo lang("ctn_110") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_111") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" name="disable_captcha" value="1" <?php if($this->settings->info->disable_captcha) echo "checked" ?> />
        <span class="help-block"><?php echo lang("ctn_112") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_385") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" name="google_recaptcha" value="1" <?php if($this->settings->info->google_recaptcha) echo "checked" ?> />
        <span class="help-block"><?php echo lang("ctn_386") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_387") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="google_recaptcha_secret" value="<?php echo $this->settings->info->google_recaptcha_secret ?>" />
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_388") ?></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="google_recaptcha_key" value="<?php echo $this->settings->info->google_recaptcha_key ?>" />
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_113") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" name="avatar_upload" value="1" <?php if($this->settings->info->avatar_upload) echo "checked" ?> />
        <span class="help-block"><?php echo lang("ctn_114") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_327") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" name="login_protect" value="1" <?php if($this->settings->info->login_protect) echo "checked" ?> />
        <span class="help-block"><?php echo lang("ctn_328") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_329") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" name="activate_account" value="1" <?php if($this->settings->info->activate_account) echo "checked" ?> />
        <span class="help-block"><?php echo lang("ctn_330") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_374") ?></label>
    <div class="col-sm-10">
        <input type="checkbox" name="secure_login" value="1" <?php if($this->settings->info->secure_login) echo "checked" ?> />
        <span class="help-block"><?php echo lang("ctn_375") ?></span>
    </div>
</div>
<div class="form-group">
    <label for="dpname-in" class="col-sm-2 control-label"><?php echo lang("ctn_737") ?></label>
    <div class="col-sm-10">
        <input type="text" name="cache_time" class="form-control" value="<?php echo $this->settings->info->cache_time ?>"/>
        <span class="help-block"><?php echo lang("ctn_738") ?></span>
    </div>
</div>

<?php if($this->authorization->hasPermission(strtolower('admin/settings'), "update")): ?>
<input type="submit" class="btn btn-primary form-control" value="<?php echo lang("ctn_13") ?>" />
<?php endif; ?>
<?php echo form_close() ?>
</div>
</div>
</div>
<script type="text/javascript">
CKEDITOR.replace('site_desc', { height: '100'});
CKEDITOR.replace('notes-area', { height: '100'});
</script>
<script type="text/javascript">
    $('.select2').select2();
</script>