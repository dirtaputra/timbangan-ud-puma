<div data-widget-group="group1">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2><?php echo $title; ?></h2>
               <div class="panel-ctrls"></div>
            </div>
            <table cellspacing="0" width="100%">
               <tbody>
                  <tr>
                     <td style="padding: 10px 0px;"><a href="<?php echo base_url($module.'/add');?>"><button class="btn-green btn">
                  <i class="ti ti-plus"></i> Tambah</button></a></td>
                  <td >&nbsp;</td>
                  <td style="padding: 10px 12px 10px 0px; text-align: right;">Tampil : </td>
                  <td style="padding: 10px 0px; width: 12%;"><div class="panel-ctrl"></div></td>
                  </tr>
               </tbody>
            </table>            
            <div class="panel-body no-padding">
               <table id="table-data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>No SPTA</th>
                        <th>Tanggal Masuk</th>
                        <th>Petani</th>
                        <th>No Kendaraan</th>
                        <th>Kode Kelompok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
               </table>
            </div>
            <div class="panel-footer"></div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function () {
        
       $('#table-data').dataTable({
            "language": {
                "lengthMenu": "_MENU_"
            },
            "processing": true,
            "ordering": false,
            "serverSide": true,
            "ajax": "<?php echo base_url()."transaksi/loaddata";?>"
        });
         $('.dataTables_filter input').attr('placeholder', 'Cari...');
        $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
//        $('.panel-ctrls').append("<i class='separator'></i>");
//        $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
        $('.panel-ctrl').append($('.dataTables_length'));
        $('.panel-footer').append($(".dataTable+.row"));
        $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
        
        
        
        });
        $('body').on('click','.hapus_ajax',function(ev){
            if (confirm('Apakah anda ingin menghapusnya??')) {
                ev.preventDefault();
                var target = $(this).attr("data-id");
                $.ajax({
                    url: "<?php echo base_url() . $module . "/delete_ajax/"; ?>" + target,
                    type: 'GET',
                    dataType: "JSON",
                    success: function (data) {
                        if (data == null || data.status == 'gagal') {
                            alert('Data gagal dihapus');
                        } else {
                            alert('Data berhasil dihapus');
//                            location.reload(true);
                            $('#table-data').dataTable().api().ajax.reload()
                        }
                    }
                });
            }
         });
        
</script>