<?php
    class Hashtag_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getHashtagByBlogId($id) { 
            return $this->db->get_where('hashtag', array('blog_id' => $id))->result();
        }

        public function getHashtagListByBlogs($publicBlogIds) { 
            $sql = "select * from hashtag";
            if (isset($publicBlogIds)) {
                $sql .= " where ";
                for($i = 0; $i < count($publicBlogIds); $i++) {
                    $sql = $sql . "blog_id=" . $publicBlogIds[$i]->id;
                    if($i < (count($publicBlogIds) - 1)){
                        $sql = $sql . " or ";
                    } 
                }
            }

            return $this->db->query($sql)->result();
        }

        public function getHashtagByUserId($user_id) {
            return $this->db->get_where('hashtag', array('user_id' => $user_id))->result();
        }

        public function addHashtag($tag_name, $user_id, $blog_id) {

            $sql = "insert into hashtag(blog_id, name, user_id) values(".$blog_id.", '".$tag_name."', ".$user_id.")";

            return $this->db->query($sql);
        }
    }
?>