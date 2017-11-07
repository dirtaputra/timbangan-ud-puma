<style>
	.depan {
	margin-left: 10%;
	}
	.depan1 {
	margin-left: 10%;
	margin-top: 2%;
	}
</style>
<div data-widget-group="group1">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>Beranda</h2>
               <div class="panel-ctrls"></div>
            </div>
            <div class="panel-body no-padding">
				<div class="row">
				<div class="col-sm-8"><div class="depan"><h3>  Selamat datang, <?php echo $this->session->userdata('name');?></h3></div></div>
			  </div>
			  <div class="row">
				<div class="col-sm-3 depan">Profil anda saat ini :</div>
			  </div>
			  <div class="row">
				<div class="col-sm-2 depan1">Nama :</div>
				<div class="col-sm-3 depan1"> <?php echo $this->session->userdata('name');?></div>
			  </div>
			  <div class="row">
				<div class="col-sm-2 depan1">Username :</div>
				<div class="col-sm-3 depan1"><?php echo $this->session->userdata('username');?></div>
			  </div>
			  <div class="row">
				<div class="col-sm-2 depan1">email :</div>
				<div class="col-sm-3 depan1"><?php echo $this->session->userdata('email');?></div>
			  </div>
            </div>
            <div class="panel-footer"></div>
         </div>
      </div>
   </div>
</div>