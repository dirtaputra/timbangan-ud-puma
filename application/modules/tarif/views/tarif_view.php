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
                     <td style="padding: 10px 0px;"><button class="btn-green btn" data-toggle="modal" data-target="#tambah">
                  <i class="ti ti-plus"></i> Tambah</button></td>
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
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Varietas</th>
                        <th>Harga</th>
                        <?php if (!$this->session->userdata('type')) {
                            echo '<th>Aksi</th>';
                        } ?>
                     </tr>
                  </thead>
                  <tbody>
                      <?php
                      if (!empty($data_query)) {
                          $data_query = $data_query->result();
                          $no = 1;
                          $delete_msg = 'Apakah anda yakin untuk menghapus data ini?';
                          foreach ($data_query as $value) {
                              echo '<tr>';
                              echo '<td>' . $no . '</td>';
                              echo '<td>' . date("d/m/Y", strtotime($value->tanggal_tarif )). '</td>';
                              echo '<td>' . $value->varietas . '</td>';
                              echo '<td> Rp. ' . number_format((float)$value->tarif,0,',','.') . '</td>';
                              if (!$this->session->userdata('type')) {
                                  echo '<td class="center"><a href="#" data-id="' . $value->id . '" class="edit_ajax">'
                                  . '<button class="btn-blue btn"><i class="ti ti-pencil-alt"></i> Edit</button></a>'
                                  . ' <a href="#" data-id="' . $value->id . '" class="hapus_ajax">'
                                  . '<button class="btn-danger btn" ><i class="ti ti-trash"></i> Hapus</button></a></td>';
                              }
                              echo '</tr>';
                              $no++;
                          }
                      }
                      ?>
                  </tbody>
               </table>
            </div>
            <div class="panel-footer"></div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="tambah" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah <?php echo ucfirst($module); ?></h4>
         </div>
         <form id="form-tambah"  method="post" class="form-horizontal" >
            <div class="modal-body">

               <div class="form-group">
                  <label class="col-sm-3 control-label">Harga untuk tanggal: </label>
                  <div class="col-sm-4">                     
                     <div class="input-group date" id="tanggal-harga">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input id="tanggal" type="text" name="tanggal_tarif" class="form-control" readonly="true">
                    </div>
                  </div>
                  <div id="tanggal-error" class="error_show">Data tidak Boleh Kosong</div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Varietas: </label>
                  <div class="col-sm-4">
                     <input id="varietas" type="text" class="form-control" name="varietas" value="">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Harga: </label>
                  <div class="col-sm-4">
                     <input id="nama" type="number" class="form-control" name="tarif" value="">
                  </div>
                  <div id="nama-error" class="error_show">Data tidak Boleh Kosong</div>
               </div>

            </div>        
            <div class="modal-footer">
               <button type="button" class="btn btn-info reset_form" > Hapus </button>
               <button type="submit" class="btn btn-green apply">Simpan</button> 
               <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

            </div>
         </form>     
      </div>

   </div>
</div>

<div class="modal fade" id="editmodal" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit <?php echo ucfirst($module); ?></h4>
         </div>
         <form id="form-edit"  method="post" class="form-horizontal" >
            <div class="modal-body">
            </div>        
            <div class="modal-footer">
               <button type="submit" class="btn btn-green apply"  name="submit" value="edit">Simpan</button> 
               <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

            </div>
         </form>     
      </div>

   </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {
        
        $('#table-data').dataTable({
            "language": {
                "lengthMenu": "_MENU_"
            }
        });
        $('.dataTables_filter input').attr('placeholder', 'Cari...');
        $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
        $('.panel-ctrls').append("<i class='separator'></i>");
        $('.panel-ctrl').append($('.dataTables_length'));
        $('.panel-footer').append($(".dataTable+.row"));
        $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");


        $('.reset_form').on('click', function () {
            $(this).closest('.modal-content').find('input, text').val('');
            $("#tanggal-error").addClass('error_show');
        });


        $('#nama').on('input', function () {
            var input = $(this);
            var is_name = input.val();
            if (is_name) {
                $("#nama-error").removeClass('error_show').addClass('error');
            } else {
                $("#nama-error").removeClass('error').addClass('error_show');
            }
        });
        $('#tanggal').on('change', function () {
            var input = $(this);
            var is_name = input.val();
            if (is_name) {
                $("#tanggal-error").removeClass('error_show').addClass('error');
            } else {
                $("#tanggal-error").removeClass('error').addClass('error_show');
            }
        });
        
        
        $("a.edit_ajax").click(function (eve) {
            eve.preventDefault();
            var target = "<?php echo base_url() . $module . "/show_edit_ajax/"; ?>" + $(this).attr("data-id");
            $("#editmodal .modal-body").load(target, function () {
                $("#editmodal").modal("show");
                initialise();
            })
           });
        
        
        $("a.hapus_ajax").click(function (ev) {
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
                            location.reload(true);
                        }
                    }
                });
            }
        });


        $('#form-tambah').submit(function (event) {
            $("#tambah").modal("hide");
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . $module . "/tambah_ajax" ?>",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (data) {
                    if (data == null || data.status == 'gagal') {
                        alert(data.reason);
                        $(".reset_form").trigger("click");
                        $("#tambah").modal("show");
                    } else {
                        alert(data.reason);
                        $(".reset_form").trigger("click");
                        location.reload(true);
                    }
                }
            });
        });
        
        $('#form-edit').submit(function (event) {
            if (confirm('Apakah anda ingin megedit data ini?')) {
                $("#editmodal").modal("hide");
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . $module . "/edit_ajax" ?>",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function (data) {
                        if (data == null || data.status == 'gagal') {
                            alert(data.reason);
                        } else {
                            alert(data.reason);
                            location.reload(true);
                        }
                    }
                });

            }
        });
        $('#tanggal-harga').datepicker({
		todayHighlight: true,
		format: 'dd/mm/yyyy'
		});
    });
    
    $('body').on('click','#tanggal',function(){
         initialise();
    });

    function initialise(){
        $('#tanggal-harga2').datepicker({
		todayHighlight: true,
		format: 'dd/mm/yyyy'
		});
    };
</script>