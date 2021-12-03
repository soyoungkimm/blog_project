<?php
    class Category extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->helper('url');
        }

        function editCategory() {
            $this->load->model('Blog_m');
            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');
            
            $user_id = $this->session->userdata('user_id');

            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);
            
            
            $this->load->view("main_header");
            $this->load->view("editCategory", array('data'=>$data));


            $about = $this->Blog_m->getRow(5);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }


        function ajax_category_delete() {
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");

            $user_id = $this->session->userdata('user_id');

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');


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
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");

            $user_id = $this->session->userdata('user_id');

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');


            $id = $_POST['category_detail_id'];

            // 세부 카테고리 삭제
            $this->Category_detail_m->delete($id);
            
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        function ajax_category_add() {
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");

            $user_id = $this->session->userdata('user_id');

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');


            $name = $_POST['name'];

            // 카테고리 추가
            $this->Category_m->add($name, $user_id);
            
            
            $data['categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['categorys']);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }

        function ajax_category_detail_add() {
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");

            $user_id = $this->session->userdata('user_id');

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');


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
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");

            $user_id = $this->session->userdata('user_id');

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');


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
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");

            $user_id = $this->session->userdata('user_id');

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');


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
