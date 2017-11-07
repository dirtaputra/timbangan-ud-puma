<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

   <div class="logo-area">
      <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
         <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
            <span class="icon-bg">
               <i class="ti ti-menu"></i>
            </span>
         </a>
      </span>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Sistem Timbangan</a>
   </div>

   <ul class="nav navbar-nav toolbar pull-right">
      <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
         <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i></a>
      </li>

      <li class="dropdown toolbar-icon-bg">
         <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
            <img class="img-circle" src="<?php echo $this->session->userdata('avatar');?>" alt="" />
         </a>
         <ul class="dropdown-menu userinfo arrow">
            <li><a href="<?php echo base_url(); ?>profil"><i class="ti ti-user"></i><span>Profile</span></a></li>            
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>authenticate/logout"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li>
         </ul>
      </li>
   </ul>

</header>
