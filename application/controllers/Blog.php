<?php
    class Blog extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->database();
        }

        
        public function index() {           
            
            $this->load->model('Hashtag_m');
            $data['hashtags'] = $this->Hashtag_m->getHashtagLists();

            
            $this->load->view("main_header");
            $this->load->view("main", array('data'=>$data));


            $this->load->model('Blog_m');
            $about = $this->Blog_m->getRow(5);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }

        public function ajax_createList() {
            header("Content-Type:application/json");

            $search_title = $_POST['search_title'];
            $search_tag = $_POST['search_tag'];
            $sort = $_POST['sort'];
            $wish_page = $_POST['wishPage'];
            // 한 페이지에 보일 레코드 개수
            $recordNumPerPage = 8;

            $this->load->model('Blog_m');
            $data['blogs'] = $this->Blog_m->getAjaxBlogList($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page);
            $data['total_count'] = $this->Blog_m->getAjaxTotalBlogListCount($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page);
            
            $this->load->model('User_m');
            $data['users'] = $this->User_m->getUserByBlogs($data['blogs']);

            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        public function single($id) {
            $this->load->model('Blog_m');
            $data['blog'] = $this->Blog_m->getRow($id);
            $user_id = $data['blog']->user_id;
            $data['writerPopularBlogs'] = $this->Blog_m->getListsWriterPopularPost($user_id);
            $data['popularBlogs'] = $this->Blog_m->getPopularBlogThree();
            $data['blog_count'] = $this->Blog_m->getBlogCountByUserId($user_id);


            $this->load->model('Category_m');
            $data['category'] = $this->Category_m->getCategoryById($data['blog']->category_id);
            $data['user_categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['popularBlogsCategorys'] = $this->Category_m->getCategoryByBlogs($data['popularBlogs']);
            
            
            $this->load->model('Category_detail_m');
            $data['category_detail'] = $this->Category_detail_m->getCategoryDetailById($data['blog']->category_detail_id);
            $data['user_category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['user_categorys']); 
            $data['popularBlogsCategoryDetails'] = $this->Category_detail_m->getCategoryDetailByCategory($data['popularBlogsCategorys']);


            $this->load->model('Hashtag_m');
            $data['hashtags'] = $this->Hashtag_m->getHashtagByBlogId($id);
            $data['user_hashtags'] = $this->Hashtag_m->getHashtagByUserId($user_id);


            $this->load->model('User_m');
            $data['user'] = $this->User_m->getUserByUserId($user_id);


            $this->load->view("main_header");
            $this->load->view("blog_single", array('data'=>$data));

            
            $about = $this->Blog_m->getRow(5);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }

        public function contact() {
            $this->load->view("main_header");
            

            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', '이름', 'required|max_length[100]');
            $this->form_validation->set_rules('phone', '전화번호', 'required|max_length[11]');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('message', '내용', 'required');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view("contact");
            }
            else {  
                $data = array(
                    'name'=>$this->input->post('name'),
                    'phone'=>$this->input->post('phone'),
                    'email'=>$this->input->post('email'),
                    'message'=>$this->input->post('message')
                );
                $this->load->model('Contact_m');
                $this->Contact_m->add($data);
                $this->load->helper('url');
                redirect('/~sale24/prj/blog');
            }


            $this->load->model('Blog_m');
            $about = $this->Blog_m->getRow(5);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }

        public function add() {
            echo "add!";
        }
    }
?>