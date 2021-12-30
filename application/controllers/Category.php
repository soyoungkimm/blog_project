<?php
    class Category extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->helper('url');
            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');
        }

        function _ajax_header() {
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");
        }

        function editCategory() {

            $user_id = $this->session->userdata('user_id');

            $this->load->model('Blog_m');
            
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);
            
            
            $this->load->view("main_header");
            $this->load->view("editCategory", array('data'=>$data));


            $about = $this->Blog_m->getRow(54);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }


        function ajax_category_delete() {
            $this->_ajax_header(); 

            $user_id = $this->session->userdata('user_id');

            $id = $_POST['category_id'];

            // 카테고리 삭제
            $this->Category_m->delete($id);
            
            // 세부 카테고리도 삭제
            $this->Category_detail_m->deleteByCategoryId($id);


            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }

        function ajax_category_detail_delete() {
            $this->_ajax_header(); 

            $user_id = $this->session->userdata('user_id');

            $id = $_POST['category_detail_id'];

            // 세부 카테고리 삭제
            $this->Category_detail_m->delete($id);
            
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        function ajax_category_add() {
            $this->_ajax_header(); 

            $user_id = $this->session->userdata('user_id');

            $name = $_POST['name'];

            // 카테고리 추가
            $this->Category_m->add($name, $user_id);
            
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }

        function ajax_category_detail_add() {
            $this->_ajax_header(); 

            $user_id = $this->session->userdata('user_id');

            $name = $_POST['name'];
            $category_id = $_POST['category_id'];

            // 세부 카테고리  추가
            $this->Category_detail_m->add($name, $category_id);
            
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        function ajax_category_edit() {
            $this->_ajax_header(); 

            $user_id = $this->session->userdata('user_id');

            $name = $_POST['name'];
            $category_id = $_POST['category_id'];

            // 카테고리 추가
            $this->Category_m->edit($name, $category_id);
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        function ajax_category_detail_edit() {
            $this->_ajax_header(); 

            $user_id = $this->session->userdata('user_id');

            $name = $_POST['name'];
            $id = $_POST['category_detail_id'];

            // 카테고리 추가
            $this->Category_detail_m->edit($name, $id);
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }
    }
?>
