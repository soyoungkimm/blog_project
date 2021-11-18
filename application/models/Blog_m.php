<?php
    class Blog_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getListsOrderByRecent() {
            $sql = "select id, user_id, title, writeday, ispublic, count, image from blog order by writeday desc";
           
            return $this->db->query($sql)->result();
        }

        public function getListsOrderByPopular() {
            $sql = "select id, user_id, title, writeday, ispublic, count, image from blog order by count desc";
            
            return $this->db->query($sql)->result();
        }

        public function getRow($id) { 
            return $this->db->get_where('blog', array('id' => $id))->row();
        }
        
        public function getAboutBlog() {
            return $this->db->get_where('blog', array('$id' => 5))->row(); // 회원 : 0, 관리자 : 1
        }

        public function getListsWriterPopularPost($user_id) {
            $sql = "select id, title, writeday, image from blog where user_id=".$user_id." order by count desc limit 3";

            return $this->db->query($sql)->result();
        }

        public function getPopularBlogThree() {
            $sql = "select * from blog where ispublic=0 order by count desc limit 3";
            
            return $this->db->query($sql)->result();
        }

        public function rowCount() {
            $sql = "select * from blog";
            
            return $this->db->query($sql)->num_rows();
        }

        public function getAjaxBlogList($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page) {
            
            if ($search_tag != "" && $search_title != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog 
                inner join hashtag on blog.id=hashtag.blog_id where blog.ispublic=0 and 
                hashtag.name like '%" . $search_tag . "%' and blog.title like '%" . $search_title . "%' GROUP BY blog.id ";
            }
            else if($search_title != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog where blog.ispublic=0 
                and blog.title like '%" . $search_title . "%' GROUP BY blog.id ";
            }
            else if($search_tag != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog 
                inner join hashtag on blog.id=hashtag.blog_id where blog.ispublic=0
                and hashtag.name like '%" . $search_tag . "%' GROUP BY blog.id ";
            }
            else {
                $sql = "select id, user_id, title, writeday, count, image from blog where ispublic=0 ";
            }

            if ($sort == "recent") {
                $sql .= "order by blog.writeday desc, id ";
            }
            else if ($sort == "popular") {
                $sql .= "order by blog.count desc, id ";
            }


            $sql .= "limit ";
            $sql .= (string)((int)$recordNumPerPage * ((int)$wish_page - 1)) . ", " . (string)($recordNumPerPage);
            
            //echo($sql);
            return $this->db->query($sql)->result();
        }

        public function getAjaxTotalBlogListCount($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page) {
            
            if ($search_tag != "" && $search_title != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog 
                inner join hashtag on blog.id=hashtag.blog_id where blog.ispublic=0 and 
                hashtag.name like '%" . $search_tag . "%' and blog.title like '%" . $search_title . "%' GROUP BY blog.id ";
            }
            else if($search_title != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog where blog.ispublic=0 
                and blog.title like '%" . $search_title . "%' GROUP BY blog.id ";
            }
            else if($search_tag != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog 
                inner join hashtag on blog.id=hashtag.blog_id where blog.ispublic=0
                and hashtag.name like '%" . $search_tag . "%' GROUP BY blog.id ";
            }
            else {
                $sql = "select id, user_id, title, writeday, count, image from blog where ispublic=0 ";
            }

            if ($sort == "recent") {
                $sql .= "order by blog.writeday desc, id ";
            }
            else if ($sort == "popular") {
                $sql .= "order by blog.count desc, id ";
            }

            return $this->db->query($sql)->num_rows();
        }
    }
?>