<?php
$menu_view = isset($menu_view) ? $menu_view : '';
if ($menu_view == 'login') {
    ?>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/velocityjs/velocity.ui.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/application.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/demo/demo.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/demo/demo-switcher.js"></script>

<?php } else { ?>

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

							<!-- Load jQueryUI -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/application.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/demo/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/form-daterangepicker/moment.min.js"></script>              			<!-- Moment.js for Date Range Picker -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js"></script> 			<!-- Color Picker -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/form-daterangepicker/daterangepicker.js"></script>     				<!-- Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>      			<!-- Datepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>      			<!-- Timepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> <!-- DateTime Picker -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/clockface/js/clockface.js"></script>     								<!-- Clockface -->


<script type="text/javascript" src="<?php echo base_url(); ?>assets/demo/demo-pickers.js"></script>   

<?php if(isset($js_table)){?>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/demo/demo-datatables.js"></script>-->
<?php }

} ?>