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
    }
?>