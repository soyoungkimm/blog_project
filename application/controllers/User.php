<?php
    class User extends CI_Controller {
        function __construct() {
          parent::__construct();
        }

        public function mypage($id) {
          $this->load->view("main_header");
          

          $this->load->model('User_m');
          $data['user'] = $this->User_m->getUserByUserId($id);


          $this->load->model('Category_m');
          $data['user_categorys'] = $this->Category_m->getCategoryByUserId($id);


          $this->load->model('Category_detail_m');
          $data['user_category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['user_categorys']); 


          $this->load->model('Hashtag_m');
          $data['user_hashtags'] = $this->Hashtag_m->getHashtagByUserId($id);


          $this->load->model('Blog_m');
          $data['blog_count'] = $this->Blog_m->getBlogCountByUserId($id);

          $this->load->view("mypage", array('data'=>$data));

          
          
          $about = $this->Blog_m->getRow(5);
          $blogs = $this->Blog_m->getListsOrderByRecent();
          $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }

        public function ajax_createList() {
          header("Content-Type:application/json");

          $search_title = $_POST['search_title'];
          $search_tag = $_POST['search_tag'];
          $user_id = $_POST['user_id'];
          $wish_page = $_POST['wishPage'];
          // 한 페이지에 보일 레코드 개수
          $recordNumPerPage = 6;


          $this->load->model('Blog_m');
          $data['blogs'] = $this->Blog_m->getAjaxBlogListMypage($recordNumPerPage, $search_title, $search_tag, $wish_page, $user_id);
          $data['total_count'] = $this->Blog_m->getAjaxTotalBlogListCountMypage($recordNumPerPage, $search_title, $search_tag, $wish_page, $user_id);


          $result = json_encode($data, JSON_UNESCAPED_UNICODE);
          echo $result;
        }

        public function ajax_create_category_list() {
          header("Content-Type:application/json");


          $category_id = $_POST['category_id'];
          $user_id = $_POST['user_id'];
          $wish_page = $_POST['wishPage'];
          // 한 페이지에 보일 레코드 개수
          $recordNumPerPage = 6;


          $this->load->model('Blog_m');
          $data['blogs'] = $this->Blog_m->getAjaxBlogListMypageCategory($recordNumPerPage, $category_id, $wish_page, $user_id);
          $data['total_count'] = $this->Blog_m->getAjaxBlogListMypageCategoryCount($category_id, $user_id);


          $result = json_encode($data, JSON_UNESCAPED_UNICODE);
          echo $result;
        }


        public function ajax_create_category_detail_list() {
          header("Content-Type:application/json");

          
          $category_detail_id = $_POST['category_detail_id'];
          $user_id = $_POST['user_id'];
          $wish_page = $_POST['wishPage'];
          // 한 페이지에 보일 레코드 개수
          $recordNumPerPage = 6;


          $this->load->model('Blog_m');
          $data['blogs'] = $this->Blog_m->getAjaxBlogListMypageCategoryDetail($recordNumPerPage, $category_detail_id, $wish_page, $user_id);
          $data['total_count'] = $this->Blog_m->getAjaxBlogListMypageCategoryDetailCount($category_detail_id, $user_id);


          $result = json_encode($data, JSON_UNESCAPED_UNICODE);
          echo $result;
        }
    }
?>