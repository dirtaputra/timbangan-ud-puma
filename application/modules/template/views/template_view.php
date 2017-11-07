<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('header_view'); ?>
   <body class="animated-content" oncontextmenu="return false">  
       <?php $this->load->view('banner_view'); ?>
      <div id="wrapper">
         <div id="layout-static">
            <?php $this->load->view('menu_view'); ?>
            <div class="static-content-wrapper">
               <div class="static-content">
                  <div class="page-content">
                     <ol class="breadcrumb">
                        
                        <li class=""><a href="<?php echo base_url().$menu_view; ?>"><?php echo ucfirst($menu_view);?></a></li>
                        <li class="active"><a href="#"><?php echo ucfirst($sub_menu_view);?></a></li>

                     </ol>
                     
                     <div class="container-fluid">
                          <?php if($this->session->flashdata('success_message')) { ?>
                            <div class="alert alert-success">
                              <p><?php echo $this->session->flashdata('success_message'); ?></p> 
                              <p><button class="btn btn-success" onclick="hide()">OK</button></p> 
                            </div>
                          <?php } else if ($this->session->flashdata('error_message')) { ?>
                            <div class="alert alert-danger">
                               <p><?php echo $this->session->flashdata('error_message') ?></p> 
                               <p><button class="btn btn-danger" onclick="hide()">OK</button></p>
                            </div>
                          <?php } ?>
                        <?php $this->load->view($module . '/' . $view_file) ?>
                      </div> 
                  </div>
               </div>
            <?php $this->load->view('footer_view'); ?>
           </div>
         </div>
      </div>
      <script type="text/javascript">
          function hide(){
              $(".alert").hide();
          }
      </script>    
      <?php $this->load->view('switcher_view'); ?>
      <?php $this->load->view('javascript_view'); ?>
   </body>
</html>