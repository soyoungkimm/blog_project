<?php
    class Auth extends CI_Controller {

      function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
      }

      public function login() {
        
        $this->load->model('User_m');
        $user_email = $this->input->post('user_email');
        $user_pwd = $this->input->post('user_pwd');
        $user_data = $this->User_m->getUserbyEmailPwd($user_email, $user_pwd);

        if (isset($user_data)) {
          $data = array(
            'user_id' => $user_data->id, 
            'user_image' => $user_data->image, 
            'division' => $user_data->division
          );
          $this->session->set_userdata($data);

          redirect('/~sale24/prj/blog');
        }
        else {
          
          redirect("/~sale24/prj/blog?loginerror");
        }
        
      }

      public function logout() {
        $data = array('user_id', 'user_image', 'division');
        $this->session->unset_userdata($data);
        redirect('/~sale24/prj/blog');
      }
    }
?>