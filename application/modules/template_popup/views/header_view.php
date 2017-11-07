<head>
   <meta charset="utf-8">
   <title><?php echo $title ?></title>   
   <link rel="shortcut icon" href="<?php echo base_url() . "assets/img/icon.ico"; ?>" type="image/x-icon" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="apple-touch-fullscreen" content="yes">
   <meta name="author" content="KaijuThemes">
   <!--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet' type='text/css'>-->
   <link type="text/css" href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet">
   <link type="text/css" href="<?php echo base_url(); ?>assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
   
   <?php 
   $menu_view = isset($menu_view)?$menu_view:'';
   if ($menu_view == 'login') { ?>

       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
       <!--[if lt IE 9]>
           <link type="text/css" href="<?php echo base_url(); ?>assets/css/ie8.css" rel="stylesheet">
           <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
       <![endif]-->

       <!-- The following CSS are included as plugins and can be removed if unused-->


   <?php } else { ?>       
       <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/codeprettifier/prettify.css" rel="stylesheet"> 

       <!--[if lt IE 10]>
           <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/media.match.min.js"></script>
           <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
           <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/placeholder.min.js"></script>
       <![endif]-->
       <!-- The following CSS are included as plugins and can be removed if unused-->       
        <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/form-daterangepicker/daterangepicker-bs3.css" rel="stylesheet">   
       <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"> 						<!-- FullCalendar -->
       <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"> 			<!-- jVectorMap -->
       <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.css" rel="stylesheet">  
       <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">                    <!-- Bootstrap Support for Datatables -->
       <link type="text/css" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
<?php } ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jqueryui-1.10.3.min.js"></script> 
<style>
   .error{
	display: none;
	margin-left: 10px;
}		

.error_show{
	color: red;
	margin-left: 10px;
}
</style>
</head>