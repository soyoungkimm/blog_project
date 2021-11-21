<?php
    class Category_detail_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }
        
        public function getCategoryDetailById($id) {
            return $this->db->get_where('category_detail', array('id' => $id))->row(); 
        }

        public function getCategoryDetailByCategory($category) {
            
            if(count($category) == 0) {
                return null;
            }
            else {
                $sql = "select * from category_detail where ";

                for($i = 0; $i < count($category); $i++) {
                    $sql = $sql . "category_id=" . $category[$i]->id;
                    if($i < (count($category) - 1)){
                        $sql = $sql . " or ";
                    } 
                }
            }
            return $this->db->query($sql)->result();
        }


        public function increaseCount($category_detail_id) {
            $sql = "update category_detail set article_num = article_num + 1 where id=".$category_detail_id;
            return $this->db->query($sql);
        }
    }
?>