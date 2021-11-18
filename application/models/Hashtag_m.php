<?php
    class Hashtag_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getHashtagByBlogId($id) { 
            return $this->db->get_where('hashtag', array('blog_id' => $id))->result();
        }

        public function getHashtagLists() { 
            return $this->db->get('hashtag')->result();
        }

        public function getHashtagByUserId($user_id) {
            return $this->db->get_where('hashtag', array('user_id' => $user_id))->result();
        }
    }
?>