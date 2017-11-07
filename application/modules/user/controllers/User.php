<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

	public function __construct() {
    parent::__construct(); 
    }
    
    public function get_table_name() {
        return 'user';
    }

    public function get_module() {
        return 'user';
    }
    public function index() {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['view_file'] = 'user_view';
        $data['menu_view'] = 'user';
        $data['sub_menu_view'] = 'Master Pengguna';
        $data['title'] = 'Master Pengguna';
        $data['js_table'] = true;
        $query = array(
            'table' => $this->get_table_name(),
            'limit' => 1000,
            'offset' => 0);
        $data['data_query']=$database->find($query);
        echo $database->go('template', $data);
    }
    
     public function get_post_data() {
        $data['name'] = $this->input->post('name', true);
        $data['username'] = $this->input->post('username', true);
        $data['password'] = $this->input->post('password', true);
        $data['email'] = $this->input->post('email', true);
        $data['type'] = $this->input->post('type', true);
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
        if(empty($data['name']) || empty($data['username']) || empty($data['password'])){
            $data_json['status']='gagal';
            $data_json['reason']='Nama,password,username harus di isi';
        }else{
           if ($this->is_exist_uniq($data['username'])) {            
             $this->db->trans_begin();
                $newpass = md5($data['password']).sha1($data['password']);
                $newpass=sha1($newpass); 
                $insert=array(
                  'name'=>$data['name'],                  
                  'username'=>$data['username'],                
                  'password'=>$newpass,                
                  'email'=>$data['email'],                
                  'type'=>$data['type']                
                );
                $database->_insert($this->get_table_name(),$insert);
            if ($this->db->trans_status() === FALSE) {
                $data_json['status']='gagal';
                $data_json['reason']='Database error';
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $data_json['status']='sukses';
                $data_json['reason']='Data berhasil di masukkan';
            }             
            }else{                  
                $data_json['status']='gagal';
                $data_json['reason']='Username saat ini sudah ada di database';
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
                  <label class="col-sm-3 control-label">Nama : </label>
                  <div class="col-sm-4">                     
                     <input id="nama" type="text" class="form-control" name="name" value="'.$data['name'].'">
                     <input type="hidden"  name="id" value="'.$data['id'].'">
                  </div>
                  <div id="nama-error" class="error">Data tidak Boleh Kosong</div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Username : </label>
                  <div class="col-sm-4">
                     <input id="username" type="text" class="form-control" name="username" value="'.$data['username'].'">
                  </div>
                  <div id="username-error" class="error">Data tidak Boleh Kosong</div>
               </div>
               <div class="form-group">                  
                  <label class="col-sm-1 control-label"></label>
                  <div class="col-sm-7">                     
                     Jika tidak ingin merubah password, kolom password dikosongi saja.
                  </div>                  
               </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Password : </label>
                  <div class="col-sm-4">
                     <input id="password" type="password" class="form-control" name="password" value="">
                  </div>
                  <div id="password-error" class="error">Data tidak Boleh Kosong</div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Email : </label>
                  <div class="col-sm-4">
                     <input id="email" type="text" class="form-control" name="email" value="'.$data['email'].'">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Level : </label>
                  <div class="col-sm-4">
                     <select name="type" id="jenis" class="form-control">
                        <option value=1 >Pegawai</option>
                        <option value=0 >Admin</option>
                     </select>
                  </div>
               </div>
         ';
    }
    
    
    public function edit_ajax() {
        $data = $this->get_post_data();
        $data['id'] = $this->input->post('id', true);
        $database =& $this->pro_database;            
          if (!empty($data['name']) and !empty($data['username'])) {            
            $this->db->trans_begin();
                $newpass = md5($data['password']).sha1($data['password']);
                $newpass=sha1($newpass); 
                $update=array(
                  'name'=>$data['name'],                  
                  'username'=>$data['username'],                
                  'password'=>$newpass,                
                  'email'=>$data['email'],                
                  'type'=>$data['type']
                  
                );
                $where = array('id'=>$data['id']);
                if(empty($data['password'])){
                     unset($update['password']);
                 }
                $database->_update($this->get_table_name(),$update,$where);
                
            if ($this->db->trans_status() === FALSE) {
                $data_json['status']='gagal';
                $data_json['reason']='Database error';
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $data_json['status']='sukses';
                $data_json['reason']='Data berhasil diupdate';
            }
            
          }else{
            $data_json['status']='gagal';
            $data_json['reason']='Nama,password,username tidak boleh kosong';   
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
    
    public function status_deaktiv($param) {
        $database =& $this->pro_database;
        $update=array( 'status'=>0 );
        $where = array('id'=>$param);
        $database->_update($this->get_table_name(),$update,$where);
        redirect(base_url().$this->get_module(),'refresh');
    }
    public function status_aktiv($param) {
        $database =& $this->pro_database;
        $update=array( 'status'=>1 );
        $where = array('id'=>$param);
        $database->_update($this->get_table_name(),$update,$where);
        redirect(base_url().$this->get_module(),'refresh');
    }
    
    
    public function is_exist_uniq($param) {
      $database =& $this->pro_database;       
        $mst = $database->mini_find($this->get_table_name(),'username','username',$param);
        if (!empty($mst)) {
          return false;
        }
        return true;
    }
    
}
