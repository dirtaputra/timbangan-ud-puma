<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MX_Controller {

	public function __construct() {
    parent::__construct(); 
       
    }
    
    public function get_table_name() {
        return 'transaksi';
    }

    public function get_module() {
        return 'transaksi';
    }
    public function index() {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['view_file'] = 'transaksi_view';
        $data['menu_view'] = 'transaksi';
        $data['sub_menu_view'] = 'Transaksi';
        $data['title'] = 'Transaksi';
        $data['js_table'] = true;
        echo $database->go('template', $data);
    }
    public function add() {
        $database =& $this->pro_database;
        $data = $this->get_post_data();
        $data['module'] = $this->get_module();
        $data['view_file'] = 'add_view';
        $data['menu_view'] = 'transaksi';
        $data['sub_menu_view'] = 'Transaksi';
        $data['title'] = 'Transaksi';
        $data['js_table'] = true;
        echo $database->go('template', $data);
    }
    
    public function edit($edit='') {
        if(!is_numeric($edit)){
            $this->session->set_flashdata('error_message', 'Data Kosong');
            $redirect = base_url() . 'transaksi';
            redirect($redirect,'refresh');
        }
        $database =& $this->pro_database;
        $mst = $database->mini_find($this->get_table_name(),'*','SPTA',$edit);
        if(empty($mst)){
            $this->session->set_flashdata('error_message', 'Data Kosong');
            $redirect = base_url() . 'transaksi';
            redirect($redirect,'refresh');
        }else{
        $mst = (array)$mst[0]; 
        $data['SPTA'] = $mst['SPTA'];
        $data['nama_petani'] = $database->mini_find('master_petani','nama','id',$mst['id_nama_petani']);
        $data['id_nama_petani'] = $mst['id_nama_petani'];
        $data['kode_kelompok'] = $database->mini_find('master_nama_kelompok_tani',
                                 'nama_kelompok','id',$mst['id_kelompok_tani']);
        $data['id_kode_kelompok'] = $mst['id_kelompok_tani'];
        $data['kendaraan'] = $mst['no_kendaraan'];
        $data['tanggal_masuk'] =  $mst['tanggal_masuk'];
        $data['tanggal_hari_ini'] =  $mst['tanggal_hari_ini'];
        $data['netto'] = $mst['netto'];
        $data['rp'] = $mst['total_harga']; 
        $data['id_tarif'] = $mst['id_master_tarif']; 
        $data['tarif'] = $mst['harga']; 
        
        $data['module'] = $this->get_module();
        $data['view_file'] = 'edit_view';
        $data['menu_view'] = 'transaksi';
        $data['sub_menu_view'] = 'Transaksi';
        $data['title'] = 'Transaksi';
        $data['js_table'] = true;
        echo $database->go('template', $data);
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
    public function kendaraan() {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['view_file'] = 'kendaraan_view';
        $data['menu_view'] = 'No Kendaraan';
        $data['sub_menu_view'] = 'No Kendaraan';
        $data['title'] = 'No Kendaraan';
        $data['js_table'] = true;
        echo $database->go('template_popup', $data);
    }
    public function kode_kelompok() {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['view_file'] = 'kodekelompok_view';
        $data['menu_view'] = 'Kode petani';
        $data['sub_menu_view'] = 'Kode Kelompok Tani';
        $data['title'] = 'Kode Kelompok Tani';
        $data['js_table'] = true;
        echo $database->go('template_popup', $data);
    }
    public function tarif($tgl='') {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['tgl'] = $tgl;
        $data['view_file'] = 'tarif_view';
        $data['menu_view'] = 'Harga menurut varietas dan tanggal';
        $data['sub_menu_view'] = 'Harga menurut varietas dan tanggal';
        $data['title'] = 'Harga menurut varietas dan tanggal';
        $data['js_table'] = true;
        echo $database->go('template_popup', $data);
    }
    
     public function get_post_data() {         
        $data['SPTA'] = $this->input->post('SPTA', true);
        $data['nama_petani'] = $this->input->post('nama_petani', true);
        $data['id_nama_petani'] =$this->input->post('id_nama_petani', true);
        $data['kode_kelompok'] = $this->input->post('kode_kelompok', true);
        $data['id_kode_kelompok'] = $this->input->post('id_kode_kelompok', true);
        $data['kendaraan'] = $this->input->post('kendaraan', true);
        $data['tanggal_masuk'] = $this->input->post('tanggal_masuk', true);
        $data['tarif'] = $this->input->post('tarif', true);
        $data['id_tarif'] = $this->input->post('id_tarif', true);        
        $data['netto'] = $this->input->post('netto', true);
        $data['rp'] = $this->input->post('rp', true);        
        return $data;
    }
    
    public function addpost() {
       $data = $this->get_post_data();
        $database =& $this->pro_database; 
        //$this->form_validation->set_rules('SPTA', 'SPTA', 'required|callback_is_exist_uniq');
        $this->form_validation->set_rules('nama_petani', 'Nama Petani', 'required');
        $this->form_validation->set_rules('kode_kelompok', 'Kode Kelompok', 'required');
        $this->form_validation->set_rules('kendaraan', 'Kendaraan', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('tarif', 'Tarif', 'required');
        $this->form_validation->set_rules('netto', 'Netto', 'required|callback_is_not_null');
        if ($this->form_validation->run($this) == FALSE) {
            $this->form_validation->set_error_delimiters(
              '<div class="col-md-8"><div style="color:red;">', '</div></div>');
              $this->add();
        } else {  
            $this->db->trans_begin(); 
              $data['tanggal_masuk'] = date("Y-m-d", strtotime($data['tanggal_masuk']));
                $insert=array(
                  'SPTA'=>$data['SPTA'],
                  'id_kelompok_tani'=>$data['kode_kelompok'],
                  'no_kendaraan'=>$data['kendaraan'],
                  'id_nama_petani'=>$data['id_nama_petani'],
                  'id_master_tarif'=>$data['id_tarif'],
                  'tanggal_masuk'=>$data['tanggal_masuk'],
                  'netto'=>$data['netto'],
                  'harga'=>$data['tarif'],
                  'total_harga'=>$data['rp'],
                  
                );
                $database->_insert($this->get_table_name(),$insert);
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error_message', 'error');
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('success_message', 'Berhasil memsaukkan data.');
            }
            $redirect = base_url() . 'transaksi';
            redirect($redirect,'refresh');
        }
    }
    
    public function editpost() {
       $data = $this->get_post_data();       
       $data['sptaasli'] = $this->input->post('SPTAasli', true);
        $database =& $this->pro_database;         
        $this->form_validation->set_rules('SPTA', 'SPTA', 'required|callback_is_exist_uniq['.$data['sptaasli'].']');
        $this->form_validation->set_rules('nama_petani', 'Nama Petani', 'required');
        $this->form_validation->set_rules('kode_kelompok', 'Kode Kelompok', 'required');
        $this->form_validation->set_rules('kendaraan', 'Kendaraan', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('rp', 'Harga', 'required');
        $this->form_validation->set_rules('netto', 'Netto', 'required|callback_is_not_null');
        if ($this->form_validation->run($this) == FALSE) {
            $this->form_validation->set_error_delimiters(
              '<div class="col-md-8"><div style="color:red;">', '</div></div>');
              $this->edit($data['sptaasli']);
        } else {  
            $this->db->trans_begin(); 
                $data['tanggal_masuk'] = date("Y-m-d", strtotime($data['tanggal_masuk']));
                $update=array(
                  'SPTA'=>$data['SPTA'],
                  'id_kelompok_tani'=>$data['id_kode_kelompok'],
                  'no_kendaraan'=>$data['kendaraan'],
                  'id_nama_petani'=>$data['id_nama_petani'],
                  'tanggal_masuk'=>$data['tanggal_masuk'],
                  'netto'=>$data['netto'],
                  'harga'=>$data['tarif'],
                  'total_harga'=>$data['rp'],
                  
                );
                $where = array('SPTA'=>$data['SPTA']);
                $database->_update($this->get_table_name(),$update,$where);
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error_message', 'error');
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('success_message', 'Berhasil Merubah data.');
            }
            $redirect = base_url() . 'transaksi';
            redirect($redirect,'refresh');
        }
    }
    
    public function delete_ajax($param) {
       $database =& $this->pro_database;  
       $check = $this->pro_database->mini_find($this->get_table_name(),'SPTA','SPTA',$param);
       $data_json = array();
       if(!empty($check)){ 
        $this->db->trans_begin();
        $where = array('SPTA' => $param);
            $sql = " INSERT log_delete_transaksi (SPTA,id_kelompok_tani,id_master_tarif,no_kendaraan,id_nama_petani,
             	tanggal_masuk,tanggal_hari_ini,netto,harga,total_harga)
            SELECT * FROM transaksi WHERE transaksi.SPTA = '".$param."'";
          $database->custom($sql);  
          $database->_delete($this->get_table_name(), $where);
        if ($this->db->trans_status() === FALSE) {
            $data_json['status']='gagal';
            $data_json['reason']='Database error';
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $data_json['status']='sukses';
            $data_json['reason']='Data berhasil hapus';
        }
       }else{
           $data_json['status']='gagal';
           $data_json['reason']='Data tidak ada di database!';
       }
       
       $data_json = json_encode($data_json);
        echo $data_json; 
    }
     
    public function loaddata() {
        
         $request = $_GET; 
         $data_json['draw'] = 1;
         $database =& $this->pro_database;          
         $query_data = array(
            'table' => $this->get_table_name().' a',
            'field' => 'a.*,b.nama_kelompok,d.nama as nama_petani, '
           . 'DATE_FORMAT(a.tanggal_masuk, "%d-%m-%Y") as tgl_masuk',
            'limit' => 150,
            'offset' => 0,
            'groupby' => 'a.spta',
            'orderby' => 'a.tanggal_masuk desc',
            'join' => array(
            array('master_nama_kelompok_tani b', 'a.id_kelompok_tani = b.id', 'left'),
            array('master_petani d', 'a.id_nama_petani = d.id', 'left')
            ));
          if(!empty($request['search']['value'])){ 
            $match = $request['search']['value'];
            $query_data['like'] =  array(
             array('a.SPTA', $match),
             array('b.nama_kelompok', $match),
             array('a.no_kendaraan', $match),
             array('d.nama', $match),
             array('a.tanggal_masuk', $match),
             array('a.harga', $match));
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
               $a[] = array($value['SPTA'],$value['tgl_masuk'],$value['nama_petani'],
                        $value['no_kendaraan'],$value['id_kelompok_tani'],
                 'Rp. ' . number_format((float)$value['total_harga'],0,',','.') ,
                   (!$this->session->userdata('type')) ?
                       '<td class="center"><a href="'.  base_url('transaksi/edit/'.$value['SPTA']).'" >'
                     . '<button class="btn-blue btn"><i class="ti ti-pencil-alt"></i> Edit</button></a>'
                     . ' <a href="#" data-id="' . $value['SPTA'] . '" class="hapus_ajax">'
                     . '<button class="btn-danger btn" ><i class="ti ti-trash"></i> Hapus</button></a></td>'
                     :'') ; 
            }
            $data_json['data'] = $a ;
            echo json_encode($data_json);
            
        }else{
            $data_json['draw'] = 0;
            $data_json['recordsTotal'] =0;
            $data_json['recordsFiltered'] =0;
               $a[] = array('Data Kosong','Data Kosong','Data Kosong',
                 'Data Kosong','Data Kosong','Data Kosong','Data Kosong') ;             
            $data_json['data'] = $a ;
            echo json_encode($data_json);
        }
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
    
    public function loaddata_kode_kelompok() {        
         $request = $_GET; 
         $data_json['draw'] = 1;
         $database =& $this->pro_database;          
         $query_data = array(
            'table' => 'master_nama_kelompok_tani a',
            'limit' => 150,
            'offset' => 0);
          if(!empty($request['search']['value'])){ 
            $match = $request['search']['value'];
            $query_data['like'] =  array(
             array('a.nama_kelompok', $match));
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
               $a[] = array($value['nama_kelompok'],'<button class="btn btn-green" data-id="' . $value['id'] . '"'
                 . 'data-name="' . $value['nama_kelompok'] . '">Tambahkan</button>') ; 
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
    
    public function loaddata_tarif($tgl='') { 
         $request = $_GET; 
         $data_json['draw'] = 1;
         $database =& $this->pro_database;          
         $query_data1 = array(
            'table' => 'master_tarif a',
            'field' => 'tanggal_tarif',
            'where' => 'tanggal_tarif <= "'.$tgl.'"',
            'orderby' => 'a.tanggal_tarif DESC',
            'limit' => 1,
            'offset' => 0);         
           $tanggal = $database->find($query_data1);
       
        if(!empty($tanggal)){
            $tanggal = $tanggal->row_array();
            $query_data = array(
            'table' => 'master_tarif a',
            'where' => 'tanggal_tarif = "'.$tanggal['tanggal_tarif'].'"',
            'orderby' => 'a.tanggal_tarif DESC',
            'offset' => 0);
            if(!empty($request['search']['value'])){ 
            $match = $request['search']['value'];
            $query_data['like'] =  array(
             array('a.varietas', $match),
             array('a.tanggal_tarif', $match)
              );
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
             $data = $database->find($query_data);        
             $count_all = $database->count_all($query_data);
             
            $data = $data->result_array(); 
            $data_json['recordsTotal'] =$count_all;
            $data_json['recordsFiltered'] =$count_all;
            
            foreach ($data as $value) {
               $a[] = array($value['tanggal_tarif'],$value['varietas'],$value['tarif'],
                 '<button class="btn btn-green" data-id="' . $value['id'] . '"'
                 . 'data-name="' . $value['tarif'] . '">Tambahkan</button>') ; 
            }
            $data_json['data'] = $a ;
            echo json_encode($data_json);
            
        }else{
            $data_json['draw'] = 0;
            $data_json['recordsTotal'] =0;
            $data_json['recordsFiltered'] =0;
               $a[] = array('Data Kosong','Data Kosong','Data Kosong','Data Kosong') ;             
            $data_json['data'] = $a ;
            echo json_encode($data_json);
        }
    }
    
    
    
    public function is_exist_uniq($param,$callback='') {
      $database =& $this->pro_database;   
        if($callback == $param)            
            return true;
        $mst = $database->mini_find($this->get_table_name(),'SPTA','SPTA',$param);
        if (!empty($mst)) {
            $this->form_validation->set_message('is_exist_uniq', '%s ini '.$param.' sudah ada.');
            return false;
        }
        return true;
    }
    public function is_not_null($param) {
        if(0 == $param) {  
            $this->form_validation->set_message('is_not_null', '%s tidak boleh 0');
            return false;
        }
        return true;
    }
    
}
