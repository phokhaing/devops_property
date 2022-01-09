<div class="white-area-content animate-bottom">
    <!-- label header -->
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> Change Password</div>
        <div class="db-header-extra"> 
        </div>
    </div>

	<div class="panel panel-default">
		<div class="panel-body">

			<div class="clearfix">
				<span class="plan-title"><?php echo lang("ctn_224") ?></span>
				<div class="pull-right">
				<a href="<?php echo site_url("user_settings/change_password") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_225") ?></a>
				</div>
			</div>

			<p><?php echo lang("ctn_237") ?></p>

			<hr>
		  	<?php echo form_open(site_url("user_settings/change_password_pro"), array("class" => "form-horizontal")) ?>
		            <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_238") ?></label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="current_password" value="<?php echo set_value('current_password');?>">
                            <span class="text-danger"><?php echo form_error('current_password'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_239") ?></label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="new_pass1" value="<?php echo set_value('new_pass1');?>">
                            <span class="text-danger"><?php echo form_error('new_pass1'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_240") ?></label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="new_pass2" value="<?php echo set_value('new_pass2');?>">
                            <span class="text-danger"><?php echo form_error('new_pass2'); ?></span>
                        </div>
                    </div>
					 <input type="submit" name="s" value="<?php echo lang("ctn_241") ?>" class="btn btn-primary form-control" />
		    <?php echo form_close() ?>
	    </div>
	</div>

</div>