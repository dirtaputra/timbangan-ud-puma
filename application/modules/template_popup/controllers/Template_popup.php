<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_popup extends MX_Controller {
    public function __construct() {
            parent::__construct(); 
                $this->pro_database->go('credential/is_logged_in');
            }
    public function index($data)
      {
        $this->load->view('template_view', $data);

      }
}
