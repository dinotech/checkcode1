<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class main_controller extends CI_Controller {
function __construct() {
parent::__construct();
$this->load->model('form_model');
}
function index() {
$this->load->view('form');
}

    public function add_user1() { 
        $arr['page'] = 'user';
        $this->load->view('admin/vwAddUser',$arr);
    }

     public function edit_user1() {
        $arr['page'] = 'user';
        $this->load->view('admin/vwEditUser',$arr);
    }
    
     public function block_user1() {
        // Code goes here
    }
    
     public function delete_user1() {
        // Code goes here
    }
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */