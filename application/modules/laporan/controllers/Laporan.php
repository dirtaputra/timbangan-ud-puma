<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MX_Controller {

	public function __construct() {
    parent::__construct();  
    $this->output->enable_profiler(ENVIRONMENT == "development");       
    //$this->output->enable_profiler(TRUE);
    }
    
    public function get_table_name() {
        return '';
    }

    public function get_module() {
        return 'laporan';
    }
    public function index() {
        redirect(base_url().'laporan/transaksiSPTA');
    }
    
    public function transaksiSPTA() {      
            $data = $this->get_post_data();        
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['view_file'] = 'laporanSPTA_view';
        $data['menu_view'] = 'Laporan SPTA';
        $data['sub_menu_view'] = 'Laporan SPTA';
        $data['title'] = 'Laporan SPTA';
        $data['js_table'] = true;        
        echo $database->go('template', $data);
    }
    
    public function get_post_data() {
        $data['nama_petani'] = $this->input->post('nama_petani', true);
        $data['id_nama_petani'] = $this->input->post('id_nama_petani', true);
        $data['start'] = $this->input->post('start', true);
        $data['end'] = $this->input->post('end', true);
        return $data;
    }
    
    public function carispta() {
        $database =& $this->pro_database;
        $data = $this->get_post_data();
        $data['start_cetak'] = $start = $this->date_($data['start']);
        $data['end_cetak'] = $end = $this->date_($data['end']);
        $query_data = array(
            'table' => 'transaksi a',
            'field' => 'a.*,b.nama_kelompok,d.nama as nama_petani, '
           . 'DATE_FORMAT(a.tanggal_hari_ini, "%d-%m-%Y") as tgl_masuk, e.varietas',
            'where' => ' a.id_nama_petani = "'.$data['id_nama_petani'].'" '
          . 'and a.tanggal_hari_ini BETWEEN "'.$start.'" and  "'.$end.'"',
            'limit' => 1000,
            'offset' => 0,
            'groupby' => 'a.spta,a.id_master_tarif',
            'orderby' => 'a.tanggal_masuk ASC',
            'join' => array(
            array('master_nama_kelompok_tani b', 'a.id_kelompok_tani = b.id', 'left'),
            array('master_petani d', 'a.id_nama_petani = d.id', 'left'),
            array('master_tarif e', 'a.id_master_tarif = e.id', 'left'),
            ));
        $data_query=$database->find($query_data);
        if(!empty($data_query)){
            $data_query = $data_query->result_array();
            
            $varietas = NULL;
            $data_baru=array(); 

            foreach ($data_query as $key => $value) {
                if ($value['varietas'] != $varietas) {
                   $varietas = $value['varietas'];
                }
                $data_baru[$varietas][] = $value;
            }
            
            $data['data'] = $data_baru;
            $data['module'] = $this->get_module();
            $data['view_file'] = 'laporanSPTA_view';
            $data['menu_view'] = 'Laporan SPTA';
            $data['sub_menu_view'] = 'Laporan SPTA';
            $data['title'] = 'Laporan SPTA';
            $data['js_table'] = true;        
            echo $database->go('template', $data);
        }else{
            $message = 'Data yang anda cari tidak ada.';
            $this->session->set_flashdata('error_message', $message);
            $data['module'] = $this->get_module();
            $data['view_file'] = 'laporanSPTA_view';
            $data['menu_view'] = 'Laporan SPTA';
            $data['sub_menu_view'] = 'Laporan SPTA';
            $data['title'] = 'Laporan SPTA';
            $data['js_table'] = true;        
            echo $database->go('template', $data);
        }
    }
    public function cetakspta($id='',$start='',$end='') {
      if(!empty($id) && !empty($start) && !empty($end)){
          $database =& $this->pro_database;
         $query_data = array(
            'table' => 'transaksi a',
            'field' => 'a.*,b.nama_kelompok,d.nama as nama_petani, '
           . 'DATE_FORMAT(a.tanggal_masuk, "%d-%m-%Y") as tgl_masuk, e.varietas, e.tarif',
            'where' => 'a.id_nama_petani = "'.$id.'" and '
           . 'a.tanggal_masuk BETWEEN "'.$start.'" and  "'.$end.'"',
            'limit' => 1000,
            'offset' => 0,
            'groupby' => 'a.spta,a.id_master_tarif',
            'orderby' => 'a.tanggal_masuk ASC',
            'join' => array(
            array('master_nama_kelompok_tani b', 'a.id_kelompok_tani = b.id', 'left'),
            array('master_petani d', 'a.id_nama_petani = d.id', 'left'),
            array('master_tarif e', 'a.id_master_tarif = e.id', 'left'),
            ));
        $data_query=$database->find($query_data);
        $nama = $database->mini_find('master_petani','nama','id',$id);
        $data_query = $data_query->result_array();
            $varietas = NULL;
            $data_baru=array(); 

            foreach ($data_query as $key => $value) {
                if ($value['varietas'] != $varietas) {
                   $varietas = $value['varietas'];
                }
                $data_baru[$varietas][] = $value;
            }
        echo '<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <title>Print Test</title>
            <style type="text/css" media="print">
                @page 
                {
                    size: auto;   
                    margin: 0mm;  
                }
                
                .container{
                    margin-top: 20px;
                    margin-bottom: 10px;
                    margin-right: 20px;
                    margin-left: 20px;
                    }
                    
                table.solidtable {border: 1px solid black;border-collapse: collapse;}
                table.solidtable th { border: 1px solid black;}
                table.solidtable tr { border: 1px solid black;}
                table.solidtable td {  border: 1px solid black; }
                    
            </style>
        </head>
        <body onload="window.print()" >
          <div class="container">
          <table width="100%">
                <tr>
                  <td>UD. PUMA trans</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Jln. Raya Sengguruh No. 886</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                  <td>Kepanjen-Kabupaten Malang</td>                  
                  <td style="width: 35%;">&nbsp;</td>                  
                  <td style="width: 10%;">Nama</td>
                  <td>: &nbsp;'.$nama.'</td>
                </tr>
                <tr>
                  <td>Telp - Fax (0341)397967</td>
                  <td style="width: 35%;">&nbsp;</td>
                  <td style="width: 10%;">Tanggal</td>
                  <td>: &nbsp;'.$start.'s/d'.$end.'</td>
                </tr>
        </table>
        </br>
        <table width="100%" class="solidtable" cellpadding="7">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No. Pol</th>
                        <th>No. SP</th>
                        <th>Berat</th>
                        <th>Harga (Rp.)</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>';
                      
                      $no=1;
                      $total = 0;
                      $subtotal = 0;                    
                      foreach ($data_baru as $key => $value) {
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
                            echo '<td colspan="6" style="text-align: right;">Subtotal Rp. </td>';
                            echo '<td style="text-align: right;">'.number_format((float)$subtotal,0,',','.').'</td>';
                            echo '</tr>';  
                          $total += $subtotal;
                          $subtotal =0;
                          
                      }
                            echo '<tr>';
                          echo '<td colspan="6" style="text-align: right;" >Total Rp. </td>';
                          echo '<td style="text-align: right;">'.number_format((float)$total,0,',','.').'</td>';
                          echo '</tr>';
          echo' </tbody>
                  </table>
           </div>
        </body>
        </html>';
        }
    }
    public function loaddata() {
         $database =& $this->pro_database; 
        $query = array(
            'table' => $this->get_table_name(),
            'limit' => 9000000,
            'offset' => 0);
        $data=$database->find($query);
        $count_all=$database->count_all($query);
        if(!empty($data)){
            $data_json['draw'] = 0;
            $data_json['recordsTotal'] =$count_all;
            $data_json['recordsFiltered'] =$count_all;
            $data_json['data'] = $data->result_array();
            echo json_encode($data_json);
            
        }
    }
    
    public function nama_petani() {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['view_file'] = 'namapetani_view';
        $data['menu_view'] = 'nama petani';
        $data['sub_menu_view'] = 'Nama petani';
        $data['title'] = 'Nama Petani';
        $data['js_table'] = true;
        echo $database->go('template_popup', $data);
    }    
    
     public function loaddata_nama_petani() {
        
         $request = $_GET; 
         $data_json['draw'] = 1;
         $database =& $this->pro_database;          
         $query_data = array(
            'table' => 'master_petani a',
            'limit' => 150,
            'offset' => 0);
          if(!empty($request['search']['value'])){ 
            $match = $request['search']['value'];
            $query_data['like'] =  array(
             array('a.nama', $match));
             $query_data['is_or_like'] = true;
           }
           if(!empty($request['length'])){ 
               $query_data['limit']= $request['length'];
           }
           if(!empty($request['start'])){
               $query_data['offset']= $request['start'];
           }
           if(!empty($request['draw'])){
              $data_json['draw'] = $request['draw'];
          }
        $data=$database->find($query_data);
        $count_all = $database->count_all($query_data);
        if(!empty($data)){
            $data = $data->result_array(); 
            $data_json['recordsTotal'] =$count_all;
            $data_json['recordsFiltered'] =$count_all;
            
            foreach ($data as $value) {
               $a[] = array($value['nama'],'<button class="btn btn-green" data-id="' . $value['id'] . '"'
                 . 'data-name="' . $value['nama'] . '">Tambahkan</button>') ; 
            }
            $data_json['data'] = $a ;
            echo json_encode($data_json);
            
        }else{
            $data_json['draw'] = 0;
            $data_json['recordsTotal'] =0;
            $data_json['recordsFiltered'] =0;
               $a[] = array('Data Kosong','Data Kosong') ;             
            $data_json['data'] = $a ;
            echo json_encode($data_json);
        }
    }
    public function decod($param) {
        return urldecode(base64_decode($param));
    }  
    public function date_($param) {
        $date = str_replace('/', '-', $param);
        return date('Y-m-d', strtotime($date));
    }
    
}
