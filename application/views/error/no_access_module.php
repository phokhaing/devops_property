<div class="white-area-content">
    <div class="text-center">
        <img width="10%" src="<?php echo base_url('images/permission_icon.jpg'); ?>">
    </div>
    <div class="text-center">
        <h2 style="font-weight: bold; font-family: 'Times New Roman';">You don't have authorization to access this module <?php echo (isset($_GET['module']) ? '"'.$_GET['module'].'"' : '');?></h2>
        <p style="font-weight: bold; font-family: 'Times New Roman';">Please contact to administrator!</p>
    </div>
    <div class="text-center">
        <a href="<?php echo base_url('home'); ?>" class="btn btn-default">Back Home</a>
    </div>
</div>