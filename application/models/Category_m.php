<?php
    class Category_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getCategoryById($id) { 
            return $this->db->get_where('category', array('id' => $id))->row();
        }

        public function getCategoryByUserId($user_id) {
            return $this->db->get_where('category', array('user_id' => $user_id))->result();
        }

        public function getCategoryByBlogs($blogs) {
            if(count($blogs) == 0) {
                return null;
            }
            else {
                $sql = "select * from category where ";

                for($i = 0; $i < count($blogs); $i++) {
                    $sql = $sql . "user_id=" . $blogs[$i]->user_id;
                    if($i < (count($blogs) - 1)){
                        $sql = $sql . " or ";
                    } 
                }
            }
            return $this->db->query($sql)->result();
        }

        public function increaseCount($category_id) {
            $sql = "update category set article_num = article_num + 1 where id=".$category_id;
            return $this->db->query($sql);
        }

        public function decreaseCount($category_id) {
            $sql = "update category set article_num = article_num - 1 where id=".$category_id;
            return $this->db->query($sql);
        }
    }
?>