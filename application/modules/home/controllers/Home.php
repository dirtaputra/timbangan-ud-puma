<?php
defined('BASEPATH') OR exit('No direct script access allowed');class Home extends MX_Controller {public function __construct() { parent::__construct(); } public function get_table_name() { return ''; } public function get_module() { return 'home'; } public function index() { $_dc6dce50998f['module'] = $this->get_module(); $_dc6dce50998f['view_file'] = 'home_view'; $_dc6dce50998f['menu_view'] = 'home'; $_dc6dce50998f['sub_menu_view'] = 'dashboard'; $_dc6dce50998f['title'] = 'Home'; echo $this->pro_database->go('template', $_dc6dce50998f); }}