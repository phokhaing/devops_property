<div class="container">
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


<hr>

 	<h2><?php echo lang("ctn_869") ?></h2>
  	<p><?php echo lang("ctn_870") ?></p>

  	<?php if($this->user->info->oauth_provider) : ?>
  	<?php if($this->user->info->oauth_provider == "twitter") : ?>	
  		<p>Twitter - <a href="<?php echo site_url("user_settings/deauth/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_871") ?></a></p>
  	<?php endif; ?>
  	<?php if($this->user->info->oauth_provider == "google") : ?>	
  		<p>Google - <a href="<?php echo site_url("user_settings/deauth/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_871") ?></a></p>
  	<?php endif; ?>
  	<?php if($this->user->info->oauth_provider == "facebook") : ?>	
  		<p>Facebook - <a href="<?php echo site_url("user_settings/deauth/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_871") ?></a></p>
  	<?php endif; ?>
  	<?php endif; ?>

</div>
</div>

</div>
</div>
</div>