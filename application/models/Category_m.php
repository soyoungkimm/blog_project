<?php
    class Category_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getCategoryById($id) { 
            return $this->db->get_where('category', array('id' => $id))->row();
        }

        public function getCategoryByUserId($user_id) {

            $sql = "select * from category where user_id=".$user_id." order by order_num asc";
            
            return $this->db->query($sql)->result();
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

        public function delete($id) {
            $sql = "delete from category where id=".$id;
            $this->db->query($sql);
        }


        public function add($name, $user_id) {
            
            $arr = array(
                'user_id'=>$user_id,
                'name'=>$name,
                'article_num'=>0,
                'order_num'=>10000000 // 최대한 뒤쪽에 놔줘야 하므로 이렇게 함
            );
            $this->db->insert('category', $arr);
        }

        public function edit($name, $category_id) {
            $sql = "update category set name='".$name."' where id=".$category_id;
            return $this->db->query($sql);
        }
        
    }
?>