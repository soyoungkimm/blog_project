<?php
    class Recomment_m extends CI_Model {
      
      function __construct() {
        parent::__construct();
      }


      function getRecommentByComment($comments) {
        $sql = "select * from user_recomment where ";
        $count = 0;
        foreach ($comments as $comment) {
          $sql .= " user_comment_id=".$comment->id;
          if (count($comments) - 1 != $count) {
            $sql .= " or ";
          }
          $count++;
        }
        
        return $this->db->query($sql)->result();
      }


      function add($blog_id, $content, $comment_id) {
        $this->db->set('writeday', 'now()', false);
        $arr = array(
            'user_comment_id'=>$comment_id,
            'user_id'=>$this->session->userdata('user_id'),
            'content'=>$content
        );
        $this->db->insert('user_recomment', $arr);
      }


      function edit($recomment_id, $content) {
        $sql = "update user_recomment set content='".$content."'where id=".$recomment_id;
        
        $this->db->query($sql);
      }


      function getRecommentById($id) {
        $sql = "select * from user_recomment where id=".$id;

        return $this->db->query($sql)->row();
      }


      function getRecommentCount($comments) {
        $sql = "select * from user_recomment where ";
        $count = 0;
        foreach ($comments as $comment) {
          $sql .= " user_comment_id=".$comment->id;
          if (count($comments) - 1 != $count) {
            $sql .= " or ";
          }
          $count++;
        }
        
        return $this->db->query($sql)->num_rows();
      }


      function deleteRecomment($id) {
        $sql = "delete from user_recomment where id=".$id;
        
        $this->db->query($sql);
      }


      function deleteRecommentByCommentId($id) {
        $sql = "delete from user_recomment where user_comment_id=".$id;
        
        $this->db->query($sql);
      }

      function getRecommentByCommentId($comment_id) {
        $sql = "select id from user_recomment where user_comment_id=".$comment_id;
        
        return $this->db->query($sql)->num_rows();
      }
    }
?>