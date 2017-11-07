<div data-widget-group="group1">
   <div class="row">
      <div class="col-xs-12">
         <div class="panel panel-midnightblue">
            <div class="panel-heading">
               <h2>Profil Pengguna</h2>              
            </div>
            <div class="panel-body">
               
               <form class="form-horizontal row-border" id="validate-form" 
                     action="<?php echo base_url()."profil/update";?>" method="post">
                  <input type="hidden" value="<?php echo $id;?>" name="id">
                  <?php if(validation_errors()){?>
                  <div class="form-group">
                     <div class="col-sm-6">
                        <?php echo validation_errors();?>
                     </div>
                  </div>
                  <?php }?>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Nama :</label>
                     <div class="col-sm-6">
                        <input type="text" placeholder="Masukkan nama anda" 
                              required  class="form-control" name="name" value="<?php echo $name;?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Username :</label>
                     <div class="col-sm-6">
                        <input type="text" placeholder="Masukkan username anda" 
                               required class="form-control" name="username" value="<?php echo $username;?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"></label>
                     <div class="col-sm-6">
                        <p>Jika ingin merubah password masukkan password baru anda 
                           dikolom bawah ini, jika tidak ingin merubah jangan diisi.</p>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Password :</label>
                     <div class="col-sm-6">
                        <input type="password" id="password" class="form-control" name="password">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Ulangi Password anda :</label>
                     <div class="col-sm-6">
                        <input type="password" id="cfmPassword" class="form-control" name="cfmpassword">
                        <span id='message'></span>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label class="col-sm-3 control-label">E-mail :</label>
                     <div class="col-sm-6">
                        <input type="text" placeholder="Masukkan email anda" class="form-control" 
                               name="email" value="<?php echo $email;?>" >
                     </div>
                  </div>
            </div>
            <div class="panel-footer">
               <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <div class="btn-toolbar">
                         <input type="submit" value="Simpan">
                     </div>
                  </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script>
var message_show=false;    
var pass=false;    
$('#password, #cfmPassword').on('keyup', function () {
  if ($('#password').val() == $('#cfmPassword').val()) {
    $('#message').html('Password sama').css('color', 'green');
    message_show=true;
    pass=true;
    $(':input[type="submit"]').prop('disabled', false);
  } else 
    $('#message').html('Password tidak sama, ulangi lagi').css('color', 'red');
    $('#message').show();
     $(':input[type="submit"]').prop('disabled', true);
    message_show=true;
});
$('body').on('click', function(){
    if(message_show && pass){
      message_show = false; 
      pass = false;
      $('#message').hide('slow').delay(3000);
      $(':input[type="submit"]').prop('disabled', false);
    }
})
</script>