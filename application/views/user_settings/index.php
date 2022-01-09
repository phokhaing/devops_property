<!-- message success -->
<?php if(!empty($this->session->flashdata('success'))){ ?>
<div class="row" id="alert-success">
    <div class="col-md-12">
        <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('success') ?></div>
    </div>
</div>
<?php } ?>
<!-- message error -->
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
        <div class="page-header-title"> <span class="glyphicon glyphicon-add"></span> Profile</div>
        <div class="db-header-extra"> 
        </div>
    </div>
	<div class="row">
		<div class="col-md-12 content-area">
			<div class="panel panel-default">
				<div class="panel-body">

					<div class="clearfix">
						<span class="plan-title"><?php echo lang("ctn_224") ?></span>

						<div class="pull-right">
							<a href="<?php echo site_url("user_settings/change_password") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_225") ?></a> <a href="<?php echo site_url("user_settings/social_networks") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_868") ?></a>
						</div>
					</div>

					<p><?php echo lang("ctn_226") ?></p>

					<hr>
					<?php echo form_open_multipart(site_url("user_settings/pro"), array("class" => "form-horizontal")) ?>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_228") ?></label>
						<div class="col-sm-10">
							<p><a href="<?php echo site_url("profile/" . $this->user->info->username) ?>"><?php echo $this->user->info->username ?></a></p>
						</div>
					</div>
					<?php if($this->settings->info->payment_enabled) : ?>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_605") ?></label>
							<div class="col-sm-10">
								<p><?php echo lang("ctn_248") ?>: <?php echo number_format($this->user->info->points,2) ?>. <a href="<?php echo site_url("client/funds") ?>"><?php echo lang("ctn_245") ?></a></p>

								<?php if($this->user->info->premium_time > 0) : ?>
									<?php $time = $this->common->convert_time($this->user->info->premium_time) ?>
									<p><?php echo lang("ctn_276") ?> <?php echo $this->common->get_time_string($time) ?> <?php echo lang("ctn_281") ?></p>
									<?php elseif($this->user->info->premium_time == -1) : ?>
										<p><?php echo lang("ctn_282") ?></p>
									<?php endif; ?>
									<p><a href="<?php echo site_url("client/plans") ?>"><?php echo lang("ctn_285") ?></a></p>
								</div>
							</div>
						<?php endif; ?>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_229") ?></label>
							<div class="col-sm-10">
								<p><img src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" /></p>
								<?php if($this->settings->info->avatar_upload) : ?>
									<input type="file" name="userfile" /> 
								<?php endif; ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_230") ?></label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="email" value="<?php echo $this->user->info->email ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_231") ?></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="first_name" value="<?php echo $this->user->info->first_name ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_232") ?></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="last_name" value="<?php echo $this->user->info->last_name ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="department" class="col-sm-2 control-label">Branch</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="branch" value="<?php if(($this->user->info->branch) !=""){echo get_org_name($this->user->info->branch);}  ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="department" class="col-sm-2 control-label">Department</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="department" value="<?php if(($this->user->info->department_id) !=""){echo get_department_name($this->user->info->department_id);}  ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_233") ?></label>
							<div class="col-sm-10">
								<textarea class="form-control" name="aboutme" rows="8"><?php echo nl2br($this->user->info->aboutme) ?></textarea>
							</div>
						</div>
						<?php foreach($fields->result() as $r) : ?>
							<div class="form-group">

								<label for="name-in" class="col-sm-2 label-heading"><?php echo $r->name ?> <?php if($r->required) : ?>*<?php endif; ?></label>
								<div class="col-sm-10">
									<?php if($r->type == 0) : ?>
										<input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>" value="<?php echo $r->value ?>">
										<?php elseif($r->type == 1) : ?>
											<textarea name="cf_<?php echo $r->ID ?>" rows="8" class="form-control"><?php echo $r->value ?></textarea>
											<?php elseif($r->type == 2) : ?>
												<?php $options = explode(",", $r->options); ?>
												<?php $values = array_map('trim', (explode(",", $r->value))); ?>
												<?php if(count($options) > 0) : ?>
													<?php foreach($options as $k=>$v) : ?>
														<div class="form-group"><input type="checkbox" name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>" value="1" <?php if(in_array($v,$values)) echo "checked" ?>> <?php echo $v ?></div>
													<?php endforeach; ?>
												<?php endif; ?>
												<?php elseif($r->type == 3) : ?>
													<?php $options = explode(",", $r->options); ?>

													<?php if(count($options) > 0) : ?>
														<?php foreach($options as $k=>$v) : ?>
															<div class="form-group"><input type="radio" name="cf_radio_<?php echo $r->ID ?>" value="<?php echo $k ?>" <?php if($r->value == $v) echo "checked" ?>> <?php echo $v ?></div>
														<?php endforeach; ?>
													<?php endif; ?>
													<?php elseif($r->type == 4) : ?>
														<?php $options = explode(",", $r->options); ?>
														<?php if(count($options) > 0) : ?>
															<select name="cf_<?php echo $r->ID ?>" class="form-control">
																<?php foreach($options as $k=>$v) : ?>
																	<option value="<?php echo $k ?>" <?php if($r->value == $v) echo "selected" ?>><?php echo $v ?></option>
																<?php endforeach; ?>
															</select>
														<?php endif; ?>
													<?php endif; ?>
													<span class="help-text"><?php echo $r->help_text ?></span>
												</div>
											</div>
										<?php endforeach; ?>
										<p><?php echo lang("ctn_351") ?></p>

										<p class="panel-subheading"><?php echo lang("ctn_234") ?></p>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_235") ?></label>
											<div class="col-sm-10">
												<input type="checkbox" name="enable_email_notification" value="1" <?php if($this->user->info->email_notification) echo "checked" ?>>
											</div>
										</div>
										<input type="submit" name="s" value="<?php echo lang("ctn_236") ?>" class="btn btn-primary form-control" />
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#alert-success").fadeTo(8000, 8000).slideUp(500, function(){
        $("#alert-success").alert('close');
    });
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });
</script>