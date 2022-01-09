<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if (isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>         
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

        <!-- Styles -->
        <link href="<?php echo base_url(); ?>styles/login_layout.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>styles/responsive.css" rel="stylesheet" type="text/css">
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,500,600,700' rel='stylesheet' type='text/css'>
        <!-- <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" /> -->
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">


        <!-- libs added by khaing -->
            <!-- Plugins css -->
            <link href="<?php echo base_url(); ?>assets/libs/nestable2/jquery.nestable.min.css" rel="stylesheet" />
             <!-- Select2 -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/select2/select2.min.css">
        <!-- end libs -->
        
        <!-- SCRIPTS -->
        <script type="text/javascript">
            var global_base_url = "<?php echo site_url('/') ?>";
        </script>
        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>

        <!-- select2 -->
        <script src="<?php echo base_url(); ?>assets/select2/select2.full.min.js"></script>  

        <!-- Favicon: http://realfavicongenerator.net -->
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() ?>images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>images/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?php echo base_url() ?>images/favicon/site.webmanifest">
        <link rel="mask-icon" href="<?php echo base_url() ?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="<?php echo base_url() ?>images/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->


        <script type="text/javascript">
            $(document).ready(function () {
                $(document).tooltip();
            });
        </script>

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?> 
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-12 top-margin">
                    <?php if ($this->settings->info->install) : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info"><b><span class="glyphicon glyphicon-warning-sign"></span></b> <a href="<?php echo site_url("install") ?>">Great job on uploading all the files and setting up the site correctly! Let's now create the Admin account and set the default settings. Click here! This message will disappear once you have run the install process.</a></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $gl = $this->session->flashdata('globalmsg'); ?>
                    <?php if (!empty($gl)) : ?>
                        <div class="container projects-wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php echo $content ?>

                </div>
            </div>
        </div>
        <!-- libs added by khaing -->
                <!-- Plugins js-->
                <script src="<?php echo base_url(); ?>assets/libs/nestable2/jquery.nestable.min.js"></script>
                <!-- Nestable init-->
                <script src="<?php echo base_url(); ?>assets/libs/nestable2/nestable.init.js"></script>
            <!-- end libs -->
    </body>
</html>