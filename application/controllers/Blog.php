<?php
    class Blog extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->helper('url');
        }

        
        public function index() {           
            $this->load->model('Blog_m');
            $publicBlogId = $this->Blog_m->getPublicBlogId();

            $this->load->model('Hashtag_m');
            $data['hashtags'] = $this->Hashtag_m->getHashtagListByBlogs($publicBlogId);

            
            $this->load->view("main_header");
            $this->load->view("main", array('data'=>$data));


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
                
                redirect('/~sale24/prj/blog');
            }


            $this->load->model('Blog_m');
            $about = $this->Blog_m->getRow(5);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }

        public function add() {
            $this->load->model('Blog_m');
            $this->load->model('Hashtag_m');
            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');
            $this->load->view("main_header");
            
            $user_id = $this->session->userdata('user_id');
            $this->load->model('Category_m');
            $data['user_categorys'] = $this->Category_m->getCategoryByUserId($user_id);


            $this->load->model('Category_detail_m');
            $data['user_category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['user_categorys']);

            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', '제목', 'required|max_length[100]');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view("addBlog", array('data'=>$data));
            }
            else {  
                if ($this->input->post('upload_file_name') != null) {
                    
                    // 파일을 저장할 경로
                    $config['upload_path'] = 'my/img/blog'; 
                    // 확장자가 .gif, .jpg, .png인 파일만 업로드 허용
                    $config['allowed_types'] = 'gif|jpg|png';
                    // 허용되는 파일의 최대 사이즈
                    $config['max_size'] = '10000';
                    // 허용되는 최대 가로 길이
                    $config['max_width']  = '1024';
                    // 허용되는 최대 세로 길이(높이)
                    $config['max_height']  = '1024';
                    // 같은 이름의 파일이 있으면 덮어쓰기를 할건지
                    $config['overwrite'] = TRUE;
                    // upload 라이브러리 로드
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload("upload_file")) { // 업로드에 성공하면
                        // $data['upload_file'] = array('upload_file' =>  $this->upload->data());
                        // var_dump($data);
                
                        $user_id = $this->session->userdata('user_id');

                        if ($this->input->post('category_id') == 0) {
                            $category_id = null;
                        }
                        else {
                            $category_id = $this->input->post('category_id');
                            $this->Category_m->increaseCount($category_id);
                        }
    
                        if($this->input->post('category_detail_id') == 0 || $this->input->post('category_detail_id') == null) {
                            $category_detail_id = null;
                        }
                        else {
                            $category_detail_id = $this->input->post('category_detail_id');
                            $this->Category_detail_m->increaseCount($category_detail_id);
                        }

                        $blog = array(
                            'user_id'=>$user_id,
                            'title'=>$this->input->post('title'),
                            'content'=>$this->input->post('content'),
                            'ispublic'=>$this->input->post('ispublic'),
                            'image'=>$this->input->post('upload_file_name'), 
                            'category_id'=>$category_id,
                            'category_detail_id'=>$category_detail_id
                        );
                        $blog_id = $this->Blog_m->addBlog($blog); // 방금 작성한 블로그 아이디 리턴

                        
                        // 해쉬태그 테이블에 추가
                        $hashtag = $this->input->post('hashtag');
                        $hashtag_arr = explode('#', $hashtag);
                        if (isset($hashtag_arr)) {
                            foreach ($hashtag_arr as $tag_name) {
                                $this->Hashtag_m->addHashtag($tag_name, $user_id, $blog_id);
                            }
                        }
                        


                        // 사용자가 작성한 블로그 페이지로 옮기기
                        redirect('/~sale24/prj/blog/single/'.$blog_id);
                    }
                    else { // 업로드에 실패하면
                        //$error = array('error' =>  $this->upload->display_errors());
                        //var_dump($error);
                        $this->load->view("addBlog", array('data'=>$data));
                    }
                }
                // image 없을 때
                else { 
                    
                    $user_id = $this->session->userdata('user_id');

                    if ($this->input->post('category_id') == 0) {
                        $category_id = null;
                    }
                    else {
                        $category_id = $this->input->post('category_id');
                        $this->Category_m->increaseCount($category_id);
                    }

                    if($this->input->post('category_detail_id') == 0 || $this->input->post('category_detail_id') == null) {
                        $category_detail_id = null;
                    }
                    else {
                        $category_detail_id = $this->input->post('category_detail_id');
                        $this->Category_detail_m->increaseCount($category_detail_id);
                    }

                    $blog = array(
                        'user_id'=>$user_id,
                        'title'=>$this->input->post('title'),
                        'content'=>$this->input->post('content'),
                        'ispublic'=>$this->input->post('ispublic'),
                        'image'=>null, 
                        'category_id'=>$category_id,
                        'category_detail_id'=>$category_detail_id
                    );
                    $blog_id = $this->Blog_m->addBlog($blog); // 방금 작성한 블로그 아이디 리턴

                    
                    // 해쉬태그 테이블에 추가
                    $hashtag = $this->input->post('hashtag');
                    $hashtag_arr = explode('#', $hashtag);
                    if (isset($hashtag_arr)) {
                        foreach ($hashtag_arr as $tag_name) {
                            $this->Hashtag_m->addHashtag($tag_name, $user_id, $blog_id);
                        }
                    }

                    // 사용자가 작성한 블로그 페이지로 옮기기
                    redirect('/~sale24/prj/blog/single/'.$blog_id);
                }
                
            }
            
            $about = $this->Blog_m->getRow(5);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }


        public function ck_upload_run() {
            // 파일을 저장할 경로
            $config['upload_path'] = 'my/img/blog'; 

            // 확장자가 .gif, .jpg, .png인 파일만 업로드 허용
            $config['allowed_types'] = 'gif|jpg|png';

            // 허용되는 파일의 최대 사이즈
            $config['max_size'] = '10000';

            // 허용되는 최대 가로 길이
            $config['max_width']  = '1024';

            // 허용되는 최대 세로 길이(높이)
            $config['max_height']  = '1024';

            // 같은 이름의 파일이 있으면 덮어쓰기를 할건지
            $config['overwrite'] = TRUE;

            // upload 라이브러리 로드
            $this->load->library('upload', $config);

            if($this->upload->do_upload("upload")) { // 업로드에 성공하면

                $upload_file = $this->upload->data();
                $file_name = $upload_file['file_name'];
                $file_location = "/~sale24/prj/my/img/blog/".$file_name;
                
                echo '{"filename" : "'.$file_name.'", "uploaded" : 1, "url":"'.$file_location.'"}';
            }
            else { // 업로드에 실패하면
                echo '{"uploaded": 0, "error": {"message": "파일 업로드에 실패했습니다.'.$this->upload->display_errors('','').'"}}';
            }

        }
    }
?>