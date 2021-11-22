<?php
    class User extends CI_Controller {
        function __construct() {
          parent::__construct();
          $this->load->helper('url');
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


        public function edit() {
          $user_id = $this->session->userdata('user_id');
          $this->load->view("main_header");


          $this->load->model('User_m');
          $data['user'] = $this->User_m->getUserByUserId($user_id);

          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', '이름', 'required|max_length[100]');
          

          if ($this->form_validation->run() == FALSE) {
              $this->load->view("editUser", array('data'=>$data));
          }
          else {  
            // image가 있으면
            if ($this->input->post('upload_file_name') != null && $this->input->post('upload_file_name') != 'undefined') {
                
                // 파일을 저장할 경로
                $config['upload_path'] = 'my/img/user'; 
                // 확장자가 .gif, .jpg, .png인 파일만 업로드 허용
                $config['allowed_types'] = 'gif|jpg|png';
                // 허용되는 파일의 최대 사이즈
                $config['max_size'] = '10000';
                // 허용되는 최대 가로 길이
                $config['max_width']  = '1024';
                // 허용되는 최대 세로 길이(높이)
                $config['max_height']  = '1024';
                // 같은 이름의 파일이 있으면 덮어쓰기를 할건지
                $config['overwrite'] = False;
                // upload 라이브러리 로드
                $this->load->library('upload', $config);

                if($this->upload->do_upload("upload_file")) { // 업로드에 성공하면


                    // image file 이름 겹치는 것 방지
                    $upload_data = $this->upload->data();
                    $arr = explode('/', $upload_data['full_path']);
                    $upload_file_name = $arr[count($arr) - 1];

                  

                    $data = array(
                        'user_id'=>$user_id,
                        'name'=>$this->input->post('name'),
                        'content'=>$this->input->post('content'),
                        'image'=>$upload_file_name,
                        'getNotice'=>$this->input->post('getNotice'),
                        'mini_content'=>$this->input->post('mini_content')
                    );
                    $this->User_m->editUser($data);

                    // 사용자가 작성한 블로그 페이지로 옮기기
                    redirect('/~sale24/prj/user/mypage/'.$user_id);
                }
                else { // 업로드에 실패하면
                    
                    $this->load->view("editUser", array('data'=>$data));
                }
            }
            // image 없을 때
            else { 
                $data = array(
                    'user_id'=>$user_id,
                    'name'=>$this->input->post('name'),
                    'content'=>$this->input->post('content'),
                    'image'=>"no",
                    'getNotice'=>$this->input->post('getNotice'),
                    'mini_content'=>$this->input->post('mini_content')
                );
                $this->User_m->editUser($data);

                // 사용자가 작성한 블로그 페이지로 옮기기
                redirect('/~sale24/prj/user/mypage/'.$user_id);
            }
          }


          $this->load->model('Blog_m');
          $about = $this->Blog_m->getRow(5);
          $blogs = $this->Blog_m->getListsOrderByRecent();
          $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
      }

      public function signup() {
        $this->load->model('User_m');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '이름', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[255]');
        $this->form_validation->set_rules('password', '비밀번호', 'required|max_length[30]');
        $this->form_validation->set_rules('password_check', '비밀번호 확인', 'required|max_length[100]|matches[password]');
        $this->form_validation->set_rules('mini_content', '짧은 소개', 'max_length[50]');
        $this->form_validation->set_rules('agreement', '회원 정보 제공 동의', 'required');
        
        if ($this->form_validation->run() == FALSE) {
          $this->load->view("join");
        }
        else { 
          $data = array(
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
            'mini_content'=>$this->input->post('mini_content')
          );
          //echo "success";
          //var_dump();
          $this->User_m->addUser($data);
          
          redirect('/~sale24/prj/blog');
        }
      }
    }
?>