<form class="form-horizontal row-border" id="validate-form" 
  action="<?php echo base_url() . "transaksi/editpost"; ?>" method="post">
                  
<div data-widget-group="group1">
   <div class="row">
      <div class="col-xs-12">
         <div class="panel panel-midnightblue">
            <div class="panel-heading">
               <h2>Transaksi SPTA</h2>              
            </div>
            <div class="panel-body">
                  <?php if (validation_errors()) { ?>
                      <div class="form-group">
                         <div class="col-sm-6">
                             <?php echo validation_errors(); ?>
                         </div>
                      </div>
                  <?php } ?>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">SPTA :</label>
                     <div class="col-sm-5">
                        <input type="number" placeholder="Masukkan SPTA" 
                               id="SPTA" required  class="form-control" name="SPTA" value="<?php echo $SPTA;?>" >
                        <input type="hidden" name="SPTAasli" value="<?php echo $SPTA;?>" >
                      
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Nama Petani:</label>
                     <div class="col-sm-6">
                        <div class="input-group nama-petani">
                        <input type="text" placeholder="Masukkan nama anda" 
                               id="nama_petani" required  class="form-control"
                               name="nama_petani" value="<?php echo $nama_petani;?>" readonly="true">
                        <span class="input-group-addon"><i class="ti ti-book"></i></span>
                        <input type="hidden" id="id_nama_petani" value="<?php echo $id_nama_petani;?>"
                               name="id_nama_petani">
                        </div>
                     </div>
                  </div>
               
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Kode Kelompok Petani:</label>
                     <div class="col-sm-6">
                        <div class="input-group kode-kelompok">
                        <input type="text" placeholder="Masukkan Kode Kelompok" 
                               id="kode_kelompok" required  class="form-control" name="kode_kelompok" 
                               value="<?php echo $kode_kelompok;?>" readonly="true">
                        <span class="input-group-addon"><i class="ti ti-book"></i></span>
                        <input type="hidden" id="id_kode_kelompok" value="<?php echo $id_kode_kelompok;?>" 
                               name="id_kode_kelompok">
                        </div>
                     </div>
                  </div>
               
                  <div class="form-group">
                     <label class="col-sm-3 control-label">No Kendaraan:</label>
                     <div class="col-sm-6">
                        <div class="input-group kendaraan">
                        <input type="text" placeholder="Masukkan No Kendaraan" 
                               id="no_kendaraan" required  class="form-control" name="kendaraan" 
                               value="<?php echo $kendaraan;?>" >
                        </div>
                     </div>
                  </div>
               
               <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal Masuk: </label>
                  <div class="col-sm-4">                     
                     <div class="input-group date" >
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input id="tanggal-masuk" type="text" name="tanggal_masuk" class="form-control" 
                                   readonly="true" value="<?php echo $tanggal_masuk;?>">
                    </div>
                  </div>
               </div>
               
            <div class="form-group">
                 <label class="col-sm-3 control-label">Tarif:</label>
                 <div class="col-sm-6">
                    <div class="input-group tarif">
                    <input type="text" placeholder="Tarif" 
                           id="tarif" class="form-control" name="tarif" value="<?php echo $tarif;?>" 
                           readonly="true" >
                    <span class="input-group-addon"><i class="ti ti-book"></i></span>
                    <input type="hidden" id="id_tarif" value="<?php echo $id_tarif;?>" name="id_tarif">
                    </div>
                 </div>
              </div>
               
            <div class="form-group">
                 <label class="col-sm-3 control-label">Netto :</label>
                 <div class="col-sm-4">
                    <input id="netto" type="number" placeholder="Netto" required  
                           step="0.01" class="form-control" name="netto" value="<?php echo $netto;?>" >                    
                 </div>
              </div>
               
            <div class="form-group">
                 <label class="col-sm-3 control-label">Harga Rp.</label>
                 <div class="col-sm-4">
                    <label class="col-sm-4 control-label"><div id="rp1"><?php echo $rp?$rp:0;?></div></label>
                    <input type="hidden" id="rp" name="rp" value="<?php echo $rp?$rp:0;?>">
                 </div>
              </div>
               
            </div>
            <div class="panel-footer">
               <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <div class="btn-toolbar">                        
                       
                        <input type="submit" value="Simpan" class="btn btn-green" 
                               onclick="return confirm('Apakah anda yakin mengedit data ini??')">
                        <a href="<?php echo base_url() . "transaksi"; ?>"> 
                           <button type="button" class="btn btn-info reset_form" > Kembali </button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
 </form>

<script>
    
    $(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();        
        var tarif = $("#tarif");
        var netto = $("#netto");
        var rp = $("#rp");
            
            if (tarif.val().length > 0 && netto.val().length > 0) {
                var hasil = tarif.val()*netto.val();
                $('#rp1').html(rupiah(parseFloat(hasil).toFixed(0)));
                $('#rp').val(parseFloat(hasil).toFixed(0));
            }else{
                if(rp.val() != <?php echo $rp;?>){
                $('#rp1').html(0);
                $('#rp').val('');
            }
          }
    }, 800);
    
    $('#tanggal-masuk').datepicker({
                todayHighlight: true,
	    	startDate: "-1y",
	    	endDate: "+0d",
                format: "yyyy-mm-dd"
		});
    
    });   
    $('body').on('click','.nama-petani',function(ev){
          window.open('<?php echo base_url($module.'/nama_petani');?>','Note','width=700,height=500,top=75,left=300,scrollbars=yes');
         });
         
    $('body').on('click','.kode-kelompok',function(ev){
          window.open('<?php echo base_url($module.'/kode_kelompok');?>','Note','width=700,height=500,top=75,left=300,scrollbars=yes');
         });         
      
    $('body').on('click','.tarif',function(ev){        
          var inp = $("#tanggal-masuk");
            if (inp.val().length > 0) {
                window.open('<?php echo base_url($module.'/tarif/');?>'+formatDate(inp.val()),'Note','width=700,height=500,top=75,left=300,scrollbars=yes');
                
              }else{ 
                alert('Pilih tanggal masuk');
            }
         }); 
         
    $('body').on('click','#tanggal-masuk',function(){ 
          var tarif = $("#tarif");
          var id_tarif = $("#id_tarif");
          tarif.val('');
          id_tarif.val('');
         }); 
         
         
 function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}        

function rupiah(a,b,c,d,e){e=function(f){return f.split('').reverse().join('')};b=e(parseInt(a,10).toString());
    for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return e(d)+',00'}



</script>