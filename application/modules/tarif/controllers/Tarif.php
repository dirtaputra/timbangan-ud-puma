<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends MX_Controller {

	public function __construct() {
    parent::__construct();         
    }
    
    public function get_table_name() {
        return 'master_tarif';
    }

    public function get_module() {
        return 'tarif';
    }
    public function index() {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['view_file'] = 'tarif_view';
        $data['menu_view'] = 'tarif';
        $data['sub_menu_view'] = 'Master Harga';
        $data['title'] = 'Master Harga';
        $data['js_table'] = true;
        $query = array(
            'table' => $this->get_table_name(),
            'orderby' => 'tanggal_tarif desc',
            'limit' => 90000000,
            'offset' => 0);
        $data['data_query']=$database->find($query);
        echo $database->go('template', $data);
    }
    
     public function get_post_data() {
        $data['tarif'] = $this->input->post('tarif', true);
        $data['tanggal_tarif'] = $this->input->post('tanggal_tarif', true);
        $data['varietas'] = $this->input->post('varietas', true);
        $data['tanggal_tarif'] = $this->input->post('tanggal_tarif', true);
        $data['id'] = $this->input->post('id', true);
        return $data;
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
   
     
    public function tambah_ajax() {
        $data = $this->get_post_data();
        $data_json = array();
        $database =& $this->pro_database; 
        if(empty($data['tarif']) || empty($data['tanggal_tarif'])){
            $data_json['status']='gagal';
            $data_json['reason']='Tanggal atau tarif harus di isi';
        }else{
           if ($this->is_exist_uniq($data['tanggal_tarif'],$data['varietas'])) {            
             $this->db->trans_begin();
                $data['tanggal_tarif'] = $this->date_($data['tanggal_tarif']);
                $insert=array(
                  'tarif'=>$data['tarif'],                  
                  'varietas'=>$data['varietas'],                  
                  'tanggal_tarif'=>$data['tanggal_tarif']                  
                );
                $database->_insert($this->get_table_name(),$insert);
            if ($this->db->trans_status() === FALSE) {
                $data_json['status']='gagal';
                $data_json['reason']='Database error';
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $data_json['status']='sukses';
                $data_json['reason']='Harga berhasil di masukkan';
            }             
            }else{                  
                $data_json['status']='gagal';
                $data_json['reason']='Harga saat ini sudah ada di database';
            }
        } 
        $data_json = json_encode($data_json);
        echo $data_json; 
    }
    
    
    public function show_edit_ajax($param) {
        $database =& $this->pro_database;
        $query = array(
            'table' => $this->get_table_name(),
            'field' => '*, DATE_FORMAT(tanggal_tarif, "%d/%m/%Y") as tgl_tarif',
            'where' => array('id'=>$param),
            'limit' => 1,
            'offset' => 0);
        $data =$database->find($query);
        $data=$data->row_array();
        echo '          
           <div class="form-group">
                <label class="col-sm-3 control-label">Harga untuk tanggal :</label>
                <div class="col-sm-4">
                <div class="input-group date" id="tanggal-harga2">
                          <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                          <input id="tanggal" type="text" value="'.$data['tgl_tarif'].'" name="tanggal_tarif" class="form-control" readonly="true">
                  </div>
                </div>
                 <div id="tanggal-error" class="error">Tidak Boleh Kosong</div>
           </div>
           <div class="form-group">
                <label class="col-sm-3 control-label">Varietas :</label>
                <div class="col-sm-4">
                  <input id="nama" type="text" class="form-control" name="varietas" value="'.$data['varietas'].'">
                 </div>
           </div>
           <div class="form-group">
                <label class="col-sm-3 control-label">Harga :</label>
                <div class="col-sm-4">
                  <input id="nama" type="number" class="form-control" name="tarif" value="'.$data['tarif'].'">
                  <input type="hidden" name="id" value="'.$data['id'].'">
                </div>
                 <div id="nama-error" class="error">Tidak Boleh Kosong</div>
           </div>
         ';
    }
    
    
    public function edit_ajax() {
        $data = $this->get_post_data();
        $data['id'] = $this->input->post('id', true);
        $database =& $this->pro_database; 
        if ($this->is_exist_uniq($data['tanggal_tarif'],$data['varietas'],$data['tarif'])) {            
          if (!empty($data['tarif'])) {            
            $this->db->trans_begin();
                $update=array(
                  'tanggal_tarif'=>$this->date_($data['tanggal_tarif']),
                  'varietas'=>$data['varietas'],
                  'tarif'=>$data['tarif']
                  
                );
                $where = array('id'=>$data['id']);
                $database->_update($this->get_table_name(),$update,$where);
                
            if ($this->db->trans_status() === FALSE) {
                $data_json['status']='gagal';
                $data_json['reason']='Database error';
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $data_json['status']='sukses';
                $data_json['reason']='Data berhasil di edit';
            }
          }else{
            $data_json['status']='gagal';
            $data_json['reason']='Harga tidak boleh kosong';   
          } 
            
        } else {
            $data_json['status']='gagal';
            $data_json['reason']='Data sudah ada di database';
        }
         $data_json = json_encode($data_json);
         echo $data_json;         
    }
    
    public function delete_ajax($param) {
       $check = $this->pro_database->mini_find($this->get_table_name(),'*','id',$param);
       $data_json = array();
       if(!empty($check)){ 
        $this->db->trans_begin();
        $delete = array('id' => $param);
        $this->pro_database->_delete($this->get_table_name(), $delete);
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
    
    public function is_exist_uniq($tanggal,$varietas,$harga='') {
      $database =& $this->pro_database;       
        $check = array('tanggal_tarif'=>$tanggal,'varietas'=>$varietas,'tarif'=>$harga);
        if(empty($harga)){
            unset($check['tarif']);
        }
        $mst = $database->mini_find($this->get_table_name(),'id',$check);
        if (!empty($mst)) {
          return false;
        }
        return true;
    }
     public function date_($param) {
        $date = str_replace('/', '-', $param);
        return date('Y-m-d', strtotime($date));
    }
}
