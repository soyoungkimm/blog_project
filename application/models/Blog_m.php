<?php
    class Blog_m extends CI_Model {

        function __construct() {
            parent::__construct();
        }


        public function getPublicBlogId() {
            $sql = "select id from blog where ispublic=0 order by writeday desc";
           
            return $this->db->query($sql)->result();
        }

        public function addBlog($data) {
            $this->db->set('writeday', 'now()', false);
            $arr = array(
                'user_id'=>$data['user_id'],
                'title'=>$data['title'],
                'content'=>$data['content'],
                'ispublic'=>$data['ispublic'],
                'count' => 0,
                'image'=>$data['image'], 
                'category_id'=>$data['category_id'],
                'category_detail_id'=>$data['category_detail_id']
            );
            $this->db->insert('blog', $arr);

            return $this->db->insert_id(); // 방금 insert된 id를 반납
        }

        public function editBlog($data) {

            if($data['category_id'] == null) {
                $data['category_id'] = "NULL";
            }
            if($data['category_detail_id'] == null) {
                $data['category_detail_id'] = "NULL";
            }


            if($data['image'] == null) {
                $sql = "update blog set title='".$data['title']."', content='".$data['content']."', ispublic=".$data['ispublic'].
                ", category_id=".$data['category_id'].", category_detail_id=".$data['category_detail_id'].
                " where user_id=".$data['user_id']." and id=".$data['blog_id'];
            }
            else {
                $sql = "update blog set title='".$data['title']."', content='".$data['content']."', ispublic=".$data['ispublic'].
                ", image='".$data['image']."', category_id=".$data['category_id'].", category_detail_id=".$data['category_detail_id'].
                " where user_id=".$data['user_id']." and id=".$data['blog_id'];
            }
            
            $this->db->query($sql);
        }


        public function getListsOrderByRecent() {
            $sql = "select id, user_id, title, writeday, ispublic, count, image from blog where ispublic=0 order by writeday desc limit 0, 3";
           
            return $this->db->query($sql)->result();
        }

        public function getListByUserId($user_id) {
            $sql = "select id, user_id, title, writeday, ispublic, count, image 
            from blog where user_id=".$user_id." order by writeday desc limit 0, 2";
           
            return $this->db->query($sql)->result();
        }


        public function getBlogCountByUserId($id) {
            $sql = "select * from blog where user_id=".$id;
            
            return $this->db->query($sql)->num_rows();
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
            
            $sql = $this->ajax_sql($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page);
            $sql .= "limit ";
            $sql .= (string)((int)$recordNumPerPage * ((int)$wish_page - 1)) . ", " . (string)($recordNumPerPage);
            
            return $this->db->query($sql)->result();
        }

        public function getAjaxTotalBlogListCount($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page) {
            
            $sql = $this->ajax_sql($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page);

            return $this->db->query($sql)->num_rows();
        }

        public function ajax_sql($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page) {

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

            return $sql;
        }


        public function getAjaxBlogListMypage($recordNumPerPage, $search_title, $search_tag, $wish_page, $user_id) {

            $sql = $this->ajax_sql_mypage($recordNumPerPage, $search_title, $search_tag, $wish_page, $user_id);
            $sql .= "limit ";
            $sql .= (string)((int)$recordNumPerPage * ((int)$wish_page - 1)) . ", " . (string)($recordNumPerPage);

            return $this->db->query($sql)->result();
        }


        public function getAjaxTotalBlogListCountMypage($recordNumPerPage, $search_title, $search_tag, $wish_page, $user_id) {
            
            $sql = $this->ajax_sql_mypage($recordNumPerPage, $search_title, $search_tag, $wish_page, $user_id);

            return $this->db->query($sql)->num_rows();
        }

        public function ajax_sql_mypage($recordNumPerPage, $search_title, $search_tag, $wish_page, $user_id) {

            if ($search_tag != "" && $search_title != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog 
                inner join hashtag on blog.id=hashtag.blog_id where blog.user_id=".$user_id.
                " and hashtag.name like '%" . $search_tag . "%' and blog.title like '%" . $search_title . "%' GROUP BY blog.id 
                order by blog.writeday desc, id ";
            }
            else if($search_title != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog 
                where blog.user_id=".$user_id." and blog.title like '%" . $search_title . "%' GROUP BY blog.id 
                order by blog.writeday desc, id ";
            }
            else if($search_tag != "") {
                $sql = "select blog.id, blog.user_id, blog.title, blog.writeday, blog.count, blog.image from blog 
                inner join hashtag on blog.id=hashtag.blog_id where blog.user_id=".$user_id." and 
                hashtag.name like '%" . $search_tag . "%' GROUP BY blog.id order by blog.writeday desc, id ";
            }
            else {
                $sql = "select id, user_id, title, writeday, count, image from blog where blog.user_id=".$user_id.
                " order by blog.writeday desc, id ";
            }

            return $sql;
        }


        public function getAjaxBlogListMypageCategory($recordNumPerPage, $category_id, $wish_page, $user_id) {
            $sql = $this->ajax_sql_mypage_category($category_id, $user_id);
            $sql .= "limit ";
            $sql .= (string)((int)$recordNumPerPage * ((int)$wish_page - 1)) . ", " . (string)($recordNumPerPage);

            return $this->db->query($sql)->result();
        }

        public function getAjaxBlogListMypageCategoryCount($category_id, $user_id) {
            $sql = $this->ajax_sql_mypage_category($category_id, $user_id);

            return $this->db->query($sql)->num_rows();
        }

        public function ajax_sql_mypage_category($category_id, $user_id) {

            $sql = "select id, user_id, title, writeday, count, image from blog where category_id="
            .$category_id." and user_id=".$user_id." order by writeday desc, id ";

            return $sql;
        }




        public function getAjaxBlogListMypageCategoryDetail($recordNumPerPage, $category_detail_id, $wish_page, $user_id) {
            $sql = $this->ajax_sql_mypage_category_detail($category_detail_id, $user_id);
            $sql .= "limit ";
            $sql .= (string)((int)$recordNumPerPage * ((int)$wish_page - 1)) . ", " . (string)($recordNumPerPage);

            return $this->db->query($sql)->result();
        }

        public function getAjaxBlogListMypageCategoryDetailCount($category_detail_id, $user_id) {
            $sql = $this->ajax_sql_mypage_category_detail($category_detail_id, $user_id);

            return $this->db->query($sql)->num_rows();
        }

        public function ajax_sql_mypage_category_detail($category_detail_id, $user_id) {

            $sql = "select id, user_id, title, writeday, count, image from blog where category_detail_id="
            .$category_detail_id." and user_id=".$user_id." order by writeday desc, id ";

            return $sql;
        }

        public function deleteBlog($id) {
            $sql = "delete from blog where id=".$id;
            $this->db->query($sql);
        }


        public function plusBlogCount($id) {
            $sql = "update blog set count = count + 1 where id=".$id;
            return $this->db->query($sql);
        }

    }
?>