<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petani extends MX_Controller {

	public function __construct() {
    parent::__construct();         
    }
    
    public function get_table_name() {
        return 'master_petani';
    }

    public function get_module() {
        return 'petani';
    }
    public function index() {
        $database =& $this->pro_database; 
        $data = $this->get_post_data();
        $data['module'] = $this->get_module();
        $data['view_file'] = 'petani_view';
        $data['menu_view'] = 'petani';
        $data['sub_menu_view'] = 'Master Nama Petani';
        $data['title'] = 'Master Nama Petani';
        $data['js_table'] = true;
        $query = array(
            'table' => $this->get_table_name(),
            'limit' => 90000000,
            'offset' => 0);
        $data['data_query']=$database->find($query);
        echo $database->go('template', $data);
    }
    
     public function get_post_data() {
        $data['nama'] = $this->input->post('nama', true);
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
   
    public function tambah() {
        $data = $this->get_post_data();
        $database =& $this->pro_database; 
        
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $this->form_validation->set_error_delimiters(
                '<div class="col-md-8">'
                . '<div style="color:red;">', '</div></div>');
            $this->index();
        } else {  
            $this->db->trans_begin();
                $insert=array(
                  'nama'=>$data['nama']                  
                );
                $database->_insert($this->get_table_name(),$insert);
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error_message', 'error');
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('success_message', 'sukses memsaukkan data.');
            }
            $redirect = base_url() . 'barang';
            redirect($redirect,'refresh');
        }
    }
    
    public function tambah_ajax() {
        $data = $this->get_post_data();
        $data_json = array();
        $database =& $this->pro_database; 
        if(empty($data['nama'])){
            $data_json['status']='gagal';
            $data_json['reason']='Nama Petani harus di isi';
        }else{
           if ($this->is_exist_uniq($data['nama'])) {            
             $this->db->trans_begin();
                $insert=array(
                  'nama'=>$data['nama']                  
                );
                $database->_insert($this->get_table_name(),$insert);
            if ($this->db->trans_status() === FALSE) {
                $data_json['status']='gagal';
                $data_json['reason']='Database error';
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $data_json['status']='sukses';
                $data_json['reason']='Nama petani berhasil di masukkan';
            }             
            }else{                  
                $data_json['status']='gagal';
                $data_json['reason']='Nama petani sudah ada di database';
            }
        } 
        $data_json = json_encode($data_json);
        echo $data_json; 
    }
    
    
    public function show_edit_ajax($param) {
        $database =& $this->pro_database;
        $query = array(
            'table' => $this->get_table_name(),
            'where' => array('id'=>$param),
            'limit' => 1,
            'offset' => 0);
        $data =$database->find($query);
        $data=$data->row_array();
        echo '
          <div class="form-group">
                <label class="col-sm-3 control-label">Nama Petani</label>
                <div class="col-sm-3">
                  <input id="nama" type="text" class="form-control" name="nama" value="'.$data['nama'].'">
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
        if ($this->is_exist_uniq($data['nama'])) {            
            $this->db->trans_begin();
                $update=array(
                  'nama'=>$data['nama']                 
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
                $data_json['reason']='Nama petani berhasil di edit';
            } 
        } else {
            $data_json['status']='gagal';
            $data_json['reason']='Nama petani sudah ada di database';
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
            $data_json['reason']='Nama petani berhasil hapus';
        }
       }else{
           $data_json['status']='gagal';
           $data_json['reason']='Nama Petani tidak ada di database!';
       }
       
       $data_json = json_encode($data_json);
        echo $data_json; 
    }
    
    public function is_exist_uniq($param) {
      $database =& $this->pro_database;       
        $mst = $database->mini_find($this->get_table_name(),'id','nama',$param);
        if (!empty($mst)) {
          return false;
        }
        return true;
    }
    
}
