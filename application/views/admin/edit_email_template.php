<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_1") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
  <li><a href="<?php echo site_url("admin/email_templates") ?>"><?php echo lang("ctn_3") ?></a></li>
  <li class="active"><?php echo lang("ctn_4") ?></li>
</ol>

<p><?php echo lang("ctn_5") ?></p>

<hr>

<div class="panel panel-default">
<div class="panel-body">
<?php echo form_open(site_url("admin/edit_email_template_pro/" . $email_template->ID), array("class" => "form-horizontal")) ?>

<div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_11") ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="title" value="<?php echo $email_template->title ?>">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_706") ?></label>
                    <div class="col-md-8">
                        <select name="hook" class="form-control select2" required style="width:100%;">
                          <option value="">--- Choose email hook ---</option>
                          <?php if(!empty(getEmailHook())): ?>
                              <?php foreach (getEmailHook() as $key => $hook):?>
                                <option value="<?php echo $hook->hook; ?>" <?php if($email_template->hook == $hook->hook) echo "selected" ?>><?php echo $hook->hook_name; ?></option>
                              <?php endforeach; ?>
                          <?php endif ?>
                        </select>
                        <span class="help-block"><?php echo lang("ctn_712") ?></span>
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_148") ?></label>
                    <div class="col-md-8">
                        <select name="language" class="form-control">
                        <?php foreach($languages as $k=>$v) : ?>
                          <option value="<?php echo $k ?>" <?php if($k == $email_template->language) echo "selected" ?>><?php echo $v['display_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <table class="table table-bordered">
      <tr><td>[NAME]</td><td> <?php echo lang("ctn_7") ?></td></tr>
      <tr><td>[SITE_URL]</td><td> <?php echo lang("ctn_8") ?></td></tr>
      <tr><td>[SITE_NAME]</td><td> <?php echo lang("ctn_9") ?></td></tr>
      <tr><td>[EMAIL_LINK]</td><td> <?php echo lang("ctn_10") ?></td></tr>
      <tr><td>[IMAP_TICKET_REPLY_STRING]</td><td> <?php echo lang("ctn_713") ?></td></tr>
      <tr><td>[IMAP_TICKET_ID]</td><td> <?php echo lang("ctn_714") ?></td></tr>
      <tr><td>[FIRST_NAME]</td><td> <?php echo lang("ctn_765") ?></td></tr>
      <tr><td>[LAST_NAME]</td><td> <?php echo lang("ctn_766") ?></td></tr>
      </table>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading"><?php echo lang("ctn_3") ?></label>
                    <div class="col-md-8">
                        <textarea name="template" id="ann-area"><?php echo $email_template->message ?></textarea>
                    </div>
            </div>   

<input type="submit" class="form-control btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
<?php echo form_close() ?>
</div>
</div>
</div>
<script type="text/javascript">
  $('.select2').select2();
$(document).ready(function() {
CKEDITOR.replace('ann-area', { height: '150'});
});
</script>