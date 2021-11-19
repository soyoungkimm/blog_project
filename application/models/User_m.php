<?php
    class User_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        function getUserbyEmailPwd($user_email, $user_pwd) {
          $sql = "select id, image, division from user where email='".$user_email."' and password='".$user_pwd."'";

          return $this->db->query($sql)->row();
        }

        function getUserByUserId($user_id) {
            $sql = "select * from user where id='".$user_id."'";
            
            return $this->db->query($sql)->row();
        }

        function getUserByBlogs($blogs) {
          $sql = "select * from user where ";
          $count = 0;
          $user_id_array = array();
          $array = array();
          $result = array();

          foreach ($blogs as $blog) {
            array_push($user_id_array, $blog->user_id);
            $array = array_unique($user_id_array);
          }
          
          foreach($array as $arr) {
            array_push($result, $arr);
          }
          
          foreach($result as $user_id) {
            $count++;
            $sql .= "id=".$user_id." ";
            if(count($result) != $count) {
              $sql .= "or ";
            }
          }

          return $this->db->query($sql)->result();
        }
    }
?>