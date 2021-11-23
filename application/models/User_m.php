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

        function getCommentWriterByComment($comments) {
          $sql = "select * from user where ";
          $count = 0;
          foreach ($comments as $comment) {
            $sql .= " id=".$comment->user_id;
            if (count($comments) - 1 != $count) {
              $sql .= " or ";
            }
            $count++;
          }
          
          return $this->db->query($sql)->result();
        }


        public function getRecommentWriterByRecomment($recomments) {
          $sql = "select * from user where ";
          $count = 0;
          foreach ($recomments as $recomment) {
            $sql .= " id=".$recomment->user_id;
            if (count($recomments) - 1 != $count) {
              $sql .= " or ";
            }
            $count++;
          }
          
          return $this->db->query($sql)->result();
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

        public function editUser($data) {
          // image 없을 때
          if ($data['image'] == 'no') {
            $sql = "update user set name='".$data['name']."', mini_content='".$data['mini_content']."', 
            content='".$data['content']."', getNotice=".$data['getNotice']." where id=".$data['user_id'];
          }
          // image 있을 때
          else {
            $sql = "update user set name='".$data['name']."', mini_content='".$data['mini_content']."', 
            content='".$data['content']."', getNotice=".$data['getNotice'].", image='".$data['image']."' where id=".$data['user_id'];
          }
          
          return $this->db->query($sql);
        }

        public function addUser($data) {
          $sql = "insert into user (name, email, password, content, image, division, getNotice, mini_content) values ('".$data['name']."', '".
          $data['email']."', '".$data['password']."', NULL, 'default_user.jpg', 0, 0, '".$data['mini_content']."')";

          $this->db->query($sql);
        }


        
    }
?>