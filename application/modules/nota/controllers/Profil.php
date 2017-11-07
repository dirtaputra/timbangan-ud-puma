<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MX_Controller {

	public function __construct() {
    parent::__construct();         
    }
    
    public function get_table_name() {
        return 'user';
    }
    
    
    public function get_module() {
        return 'profil';
    }
    public function index() {
        $database =& $this->pro_database;
        $data['module'] = $this->get_module();
        $data['name'] = $this->session->userdata('name');
        $data['username'] = $this->session->userdata('username');
        $data['email'] = $this->session->userdata('email');        
        $data['id'] = $this->session->userdata('user_id');
        $data['view_file'] = 'profil_view';
        $data['menu_view'] = 'Profil';
        $data['sub_menu_view'] = 'Profil';
        $data['title'] = 'Profil';
        echo $database->go('template', $data);
    }
    
     public function get_post_data() {
        $data['name'] = $this->input->post('name', true);
        $data['username'] = $this->input->post('username', true);
        $data['password'] = $this->input->post('password', true);
        $data['email'] = $this->input->post('email', true);
        $data['cfmpassword'] = $this->input->post('cfmpassword', true);
        $data['id'] = $this->input->post('id', true);
        return $data;
    }
    
    public function update() {        
        $data = $this->get_post_data();
        $database =& $this->pro_database;        
        $this->form_validation->set_rules('name', 'Nama', 'required');
        if($data['username']!=$this->session->userdata('username')){
            $this->form_validation->set_rules('username', '', 'callback_is_exist_uniq');
        }
        if(!empty($data['password'])){
            $this->form_validation->set_rules('cfmpassword', 'Password', 'callback_is_pass['.$data['password'].']');
        }
        if ($this->form_validation->run($this) == FALSE) {
            $this->form_validation->set_error_delimiters(
                '<div style="color:red;">', '</div>');
            $this->index();
        } else {           
            $this->db->trans_begin();
                $newpass = md5($data['password']).sha1($data['password']);
                $newpass=sha1($newpass);
                $update=array(
                  'name'=>$data['name'],
                  'username'=>$data['username'],
                  'password'=>$newpass,                  
                  'email'=>$data['email'],                  
                );
                 if(empty($data['password'])){
                     unset($update['password']);
                 }
                 
                $where = array('id'=>$data['id']);
                $database->_update($this->get_table_name(),$update,$where);
                
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error_message', 'Gagal mengedit Sprofil anda');
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $this->session->set_userdata('name', $data['name']);
                $this->session->set_userdata('username', $data['username']);
                $this->session->set_userdata('email', $data['email']);
                $this->session->set_flashdata('success_message', 'Sukses mengedit profil anda');
            }
            $redirect = base_url() . 'profil';
            redirect($redirect,'refresh');
        }
    }
    
    
    public function is_exist_uniq($param) {
      $database =& $this->pro_database;       
        $mst = $database->mini_find($this->get_table_name(),'username','username',$param);
        if (!empty($mst)) {
          $this->form_validation->set_message('is_exist_uniq', '%s sudah ada.');  
          return false;
        }
        return true;
    }
    public function is_pass($pass,$cfpass) {
        if ($pass != $cfpass) {
          $this->form_validation->set_message('is_pass', '%s tidak sama.');  
          return false;
        }
        return true;
    }
    
}
