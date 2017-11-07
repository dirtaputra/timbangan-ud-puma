<link type="text/css" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
<form class="form-horizontal row-border" id="validate-form" 
      action="<?php echo base_url() . "laporan/carispta"; ?>" method="post">
   <div data-widget-group="group1">
      <div class="row">
         <div class="col-xs-12">
            <div class="panel panel-midnightblue" data-widget='{"draggable": "false"}'>
               <div class="panel-heading">
                  <h2>Cetak Laporan SPTA</h2>              
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
                     <label class="col-sm-3 control-label">Nama petani :</label>
                        <div class="col-sm-4">
                        <div class="input-group nama-petani">
                        <input type="text" placeholder="Cari nama petani" 
                               id="nama_petani" required  class="form-control"
                               name="nama_petani" value="<?php echo $nama_petani;?>" readonly="true">
                        <span class="input-group-addon"><i class="ti ti-book"></i></span>
                        <input type="hidden" id="id_nama_petani" value="<?php echo $id_nama_petani;?>"
                               name="id_nama_petani">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Tanggal Masuk</label>
                     <div class="col-sm-8">
                        <div class="input-daterange input-group" id="datepicker-range">
                           <input type="text" class="form-control" 
                                  value="<?php echo $start; ?>"
                                  name="start" required readonly="true"/>
                           <span class="input-group-addon">Sampai</span>
                           <input type="text" class="form-control" 
                                  value="<?php echo $end; ?>"
                                  name="end" required readonly="true"/>
                        </div>
                     </div>
                  </div>
                  <div class="panel-footer">
                     <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                           <div class="btn-toolbar">
                              <input type="submit" value="Cari" class="btn btn-green">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</form>
<?php
if (!empty($data)) {
?>

   <div data-widget-group="group2" id="print_page">
      <div class="row">
         <div class="col-xs-12">
            <div class="panel panel-midnightblue" data-widget='{"draggable": "false"}'>
               <div class="panel-heading">
                  <h2>Hasil Untuk Dicetak</h2>              
               </div>
               <div class="panel-body">
                  <div class="row">
                    <div class="col-md-9">
                   <table class="table-borderless">
                    <thead>
                      <tr>
                        <th>UD. PUMA trans</th>    
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Jln. Raya Sengguruh No. 886</td>
                      </tr>
                      <tr>
                        <td>Kepanjen-Kabupaten Malang</td>
                      </tr>
                      <tr>
                        <td>Telp - Fax (0341)397967</td>
                      </tr>
                    </tbody>
                  </table>
                    </div>
                   
                    <div class="col-md-3">
                   <table class="table-borderless">
                    <thead>
                      <tr>
                        <th></th>                        
                      </tr>
                    </thead>
                    <tbody>
                     <!--  <tr>
                         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr> -->
                      <tr>
                        <td style="width: 10%;">Nama</td>
                        <td>: <?php echo $nama_petani;?></td>
                      </tr>
                      <tr>
                        <td><br></td>
                      </tr>
                      <tr>
                        <td style="width: 10%;">Tanggal</td>
                        <td>: <?php  echo $start.' s/d '.$end;?></td>
                      </tr>
                    </tbody>
                  </table>
                    </div>
                    </div>
                  </br>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                         <th><center>No</center></th>
                        <th><center>Tanggal</center></th>
                        <th><center>No. Pol</center></th>
                        <th><center>No. SP</center></th>
                        <th><center>Berat</center></th>
                        <th><center>Harga (Rp.)</center></th>
                        <th><center>Jumlah</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=1;
                      $total = 0;
                      $subtotal = 0;                    
                      foreach ($data as $key => $value) {
                          echo '<tr>';
                          echo '<td colspan="7" align="center" >Varietas : '.$key.'</td>';
                          echo '</tr>';
                          foreach ($value as $key => $row) {  
                          echo '<tr>';
                          echo '<td>'.$no.'</td>';
                          echo '<td>'.date("d/m/Y", strtotime($row['tanggal_masuk'])).'</td>';
                          echo '<td>'.$row['no_kendaraan'].'</td>';
                          echo '<td>'.$row['SPTA'].'</td>';
                          echo '<td>'.$row['netto'].'</td>';
                          echo '<td style="text-align: right;">'.number_format((float)$row['harga'],0,',','.').'</td>';
                          $jumlah = $row['total_harga'];
                          echo '<td style="text-align: right;">'.number_format((float)$jumlah,0,',','.').'</td>';
                          echo '</tr>';
                          $header = false;
                          $subtotal += $jumlah;
                          $no++;
                          }
                           echo '<tr>';
                            echo '<td colspan="6" align="right" >Subtotal Rp. </td>';
                            echo '<td style="text-align: right;">'.number_format((float)$subtotal,0,',','.').'</td>';
                            echo '</tr>';  
                          $total += $subtotal;
                          $subtotal =0;
                          
                      }
                            echo '<tr>';
                          echo '<td colspan="6" align="right" >Total Rp. </td>';
                          echo '<td style="text-align: right;">'.number_format((float)$total,0,',','.').'</td>';
                          echo '</tr>';
                      ?> 
                      
                    </tbody>
                  </table>
                 
                  <div class="panel-footer">
                     <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                           <div class="btn-toolbar">
                            <input type="button" value="print" class="btn btn-green" onclick="PrintDiv();" />
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">  
    
    function PrintDiv() {    
       var popupWin = window.open(
       '<?php echo base_url()."laporan/cetakspta/".$id_nama_petani."/".$start_cetak."/".$end_cetak;
                
        ?>',
       '_blank', 'width=800,height=400');
            }
</script>
<?php
};
?>

<script type="text/javascript">  
    $('body').on('click','.nama-petani',function(ev){
          window.open('<?php echo base_url('laporan/nama_petani');?>','Note','width=700,height=500,top=75,left=300,scrollbars=yes');
         });    
   
</script>