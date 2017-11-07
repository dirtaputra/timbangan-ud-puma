<div class="static-sidebar-wrapper sidebar-default">
   <div class="static-sidebar">
      <div class="sidebar">
         <div class="widget">
            <div class="widget-body">
               <div class="userinfo">
                  <div class="avatar">
                     <img src="<?php echo $this->session->userdata('avatar'); ?>" class="img-responsive img-circle"> 
                  </div>
                  <div class="info">
                     <span class="username"><?php echo $this->session->userdata('name'); ?><br></span>
                     <span class="useremail"><?php echo $this->session->userdata('email'); ?></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="widget stay-on-collapse" id="widget-sidebar">
            <nav role="navigation" class="widget-body">
               <ul class="acc-menu">
                  <li class="nav-separator"><span>Menu</span></li>
                  <!--<li><a href="<?php echo base_url(); ?>home"><i class="ti ti-home"></i><span>Dashboard</span><span class="badge badge-teal">2</span></a></li>-->
                  <li><a href="<?php echo base_url(); ?>home"><i class="ti ti-home"></i><span>Dashboard</span></a></li>
                  <li><a href="javascript:;"><i class="ti ti-pencil"></i><span>Master</span></a>
                     <ul class="acc-menu">
                        <li><a href="<?php echo base_url(); ?>kelompok">Nama Kelompok Tani</a></li>
                        <li><a href="<?php echo base_url(); ?>tarif">Tarif</a></li>
                        <li><a href="<?php echo base_url(); ?>petani">Petani</a></li>
                        <?php if (!$this->session->userdata('type')) { ?> <li><a href="<?php echo base_url(); ?>user">Pengguna</a></li><?php } ?>                                    
                     </ul>
                  </li>
                  <li><a href="javascript:;"><i class="ti ti-view-list-alt"></i><span>Transaksi</span></a>
                     <ul class="acc-menu">
                        <li><a href="<?php echo base_url(); ?>nota">Nota</a></li>
                        <li><a href="<?php echo base_url(); ?>laporan/transaksiSPTA">Cetak Laporan</a></li>
                     </ul>
                  </li>                             
                  <li>
                     <a href="javascript:;"><i class="ti ti-settings"></i><span>Option</span></a>
                     <ul class="acc-menu">
                        <li><a href="<?php echo base_url(); ?>profil">Profil</a></li>

                     </ul>
               </ul>
            </nav>
         </div>
      </div>
   </div>
</div>