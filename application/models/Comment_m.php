<?php
    class Comment_m extends CI_Model {
        
        function __construct() {
            parent::__construct();
            //$this->load->database();
        }

        function getCommentByBlogId($blog_id) {
          $sql = "select * from user_comment where blog_id=".$blog_id;

          return $this->db->query($sql)->result();
        }


        function getCommentById($id) {
            $sql = "select * from user_comment where id=".$id;
			
			return $this->db->query($sql)->row();
        }



        function add($blog_id, $content) {
            $this->db->set('writeday', 'now()', false);
            $arr = array(
                'blog_id'=>$blog_id,
                'user_id'=>$this->session->userdata('user_id'),
                'content'=>$content
            );
            $this->db->insert('user_comment', $arr);
        }

        function delete() {

        }

        function edit($comment_id, $content) {
			$sql = "update user_comment set content='".$content."'where id=".$comment_id;
			
			$this->db->query($sql);
			
		}


        function deleteComment($id) {
			$sql = "delete from user_comment where id=".$id;
			
			return $this->db->query($sql);
		}

        function getCommentCount($id) {
			$sql = "select * from user_comment where blog_id=".$id;
			
			return $this->db->query($sql)->num_rows();
		}
        
    }
?>