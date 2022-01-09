<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.min.css"/>
<script src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var funcNum = <?php echo $_GET['CKEditorFuncNum'] . ';'; ?>
        $('#fileExplorer').on('click', 'img', function () {
            var fileUrl = $(this).attr('title');
            window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
            window.close();
        }).hover(function () {
            $(this).css('cursor', 'pointer');
        });

        $('#fileExplorer').DataTable();
    });

</script>
<table id="fileExplorer" class="table table-hover fileExplorer">
    <thead>
        <tr>
            <th>Image</th>
            <th>File Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fileList as $fileName) { ?>
            <tr class="thumbnail">
                <td>
                    <img src="<?php echo base_url() . $fileName; ?>" alt="Thumb" title="<?php echo base_url() . $fileName; ?>" width="120" height="100" />
                </td>
                <td><?php echo $fileName; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>