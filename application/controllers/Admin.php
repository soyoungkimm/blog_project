<?php
    class Admin extends CI_Controller {

      function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
      }

      function index() { 
        $this->load->view("admin_main");
      }

      function user_detail() {
        
      }
    }
?>