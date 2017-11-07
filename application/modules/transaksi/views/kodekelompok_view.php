</br>
<div data-widget-group="group1">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2><?php echo $title; ?></h2>
               <div class="panel-ctrls"></div>
            </div>
            <div class="panel-body no-padding">
               <table id="table-data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>                        
                        <th>Kode Kelompok Petani</th>
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
            "ajax": "<?php echo base_url()."transaksi/loaddata_kode_kelompok";?>"
        });
        $('.dataTables_filter input').attr('placeholder', 'Cari...');
        $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
        $('.panel-ctrls').append("<i class='separator'></i>");
        $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
        $('.panel-footer').append($(".dataTable+.row"));
        $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
        });
        
        $('body').on('click','.btn-green',function(ev){
            ev.preventDefault();
             window.opener.document.getElementById('kode_kelompok').value = $(this).attr("data-name");
            window.opener.document.getElementById('id_kode_kelompok').value = $(this).attr("data-id");
            window.close();
           });
        
</script>