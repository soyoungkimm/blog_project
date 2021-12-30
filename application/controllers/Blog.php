<?php
    class Blog extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->helper('url');
            $this->load->model('Blog_m');
        }

        function _header() {
            $this->load->view("main_header");
        }

        function _footer() {
            $about = $this->Blog_m->getRow(54);
            $blogs = $this->Blog_m->getListsOrderByRecent();
            $this->load->view("main_footer", array('about'=>$about, 'blogs'=>$blogs));
        }

        function _ajax_header(){
            header("Content-Type: text/html; charset=KS_C_5601-1987");
            header("Cache-Control:no-cache");
            header("Pragma:no-cache");
            header("Content-Type:application/json");
        }
        
        public function index() {       
            $user_id = $this->session->userdata('user_id');
            $this->_header();

            $this->load->model('Hashtag_m');

            
            $publicBlogId = $this->Blog_m->getPublicBlogId();
            $data['recommend_blog'] = $this->Blog_m->getRecommendBlog();
            $data['title_blog'] = $this->Blog_m->getTitleBlog();


            $data['hashtags'] = $this->Hashtag_m->getHashtagListByBlogs($publicBlogId);

            
            $this->load->view("main", array('data'=>$data));
            $this->_footer();
        }

        public function ajax_createList() {
            $this->_ajax_header(); 

            $search_title = $_POST['search_title'];
            $search_tag = $_POST['search_tag'];
            $sort = $_POST['sort'];
            $wish_page = $_POST['wishPage'];
            // 한 페이지에 보일 레코드 개수
            $recordNumPerPage = 8;

            
            $data['blogs'] = $this->Blog_m->getAjaxBlogList($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page);
            $data['total_count'] = $this->Blog_m->getAjaxTotalBlogListCount($recordNumPerPage, $sort, $search_title, $search_tag, $wish_page);
            
            if ($data['blogs'] != null) {
                $this->load->model('User_m');
                $data['users'] = $this->User_m->getUserByBlogs($data['blogs']);
            }
            

            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        public function single($id) {
            
            $this->_header();

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');
            $this->load->model('Hashtag_m');
            $this->load->model('User_m');
            $this->load->model('Comment_m');
            $this->load->model('Recomment_m');

            
            $data['blog'] = $this->Blog_m->getRow($id);
            $user_id = $data['blog']->user_id;
            $data['writerPopularBlogs'] = $this->Blog_m->getListsWriterPopularPost($user_id);
            $data['popularBlogs'] = $this->Blog_m->getPopularBlogThree();
            $data['blog_count'] = $this->Blog_m->getBlogCountByUserId($user_id);
            $this->Blog_m->plusBlogCount($id);

            
            $data['category'] = $this->Category_m->getCategoryById($data['blog']->category_id);
            $data['user_categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['popularBlogsCategorys'] = $this->Category_m->getCategoryByBlogs($data['popularBlogs']);
            
            
            $data['category_detail'] = $this->Category_detail_m->getCategoryDetailById($data['blog']->category_detail_id);
            $data['user_category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['user_categorys']); 
            $data['popularBlogsCategoryDetails'] = $this->Category_detail_m->getCategoryDetailByCategory($data['popularBlogsCategorys']);


            $data['hashtags'] = $this->Hashtag_m->getHashtagByBlogId($id);
            $data['user_hashtags'] = $this->Hashtag_m->getHashtagByUserId($user_id);


            $data['user'] = $this->User_m->getUserByUserId($user_id);
            

            $data['comments'] = $this->Comment_m->getCommentByBlogId($id);
            if ($data['comments'] != null) {
                $data['comment_users'] = $this->User_m->getCommentWriterByComment($data['comments']);
            }
            

            if ($data['comments'] != null) {
                $data['recomments'] = $this->Recomment_m->getRecommentByComment($data['comments']);
                if($data['recomments'] != null)
                $data['recomment_users'] = $this->User_m->getRecommentWriterByRecomment($data['recomments']);
            }
            

            $this->load->view("blog_single", array('data'=>$data));
            $this->_footer();
        }

        public function contact() {
            
            $this->_header();
            
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

            $this->_footer();
        }

        function _upload_config() {
            // 파일을 저장할 경로
            $config['upload_path'] = 'my/img/blog'; 
            // 확장자가 .gif, .jpg, .png인 파일만 업로드 허용
            $config['allowed_types'] = 'gif|jpg|png';
            // 허용되는 파일의 최대 사이즈
            $config['max_size'] = '100000';
            // 허용되는 최대 가로 길이
            $config['max_width']  = '10240';
            // 허용되는 최대 세로 길이(높이)
            $config['max_height']  = '10240';
            // 같은 이름의 파일이 있으면 덮어쓰기를 할건지
            $config['overwrite'] = FALSE;
            // upload 라이브러리 로드
            $this->load->library('upload', $config);
        }

        function _category_increase($post_category_id) {
            if ($post_category_id == 0) {
                $category_id = null;
            }
            else {
                $category_id = $post_category_id;
                $this->Category_m->increaseCount($category_id);
            }
        }


        function _category_detail_increase($post_category_detail_id) {
            if($post_category_detail_id == 0 || $post_category_detail_id == null) {
                $category_detail_id = null;
            }
            else {
                $category_detail_id = $post_category_detail_id;
                $this->Category_detail_m->increaseCount($category_detail_id);
            }
        }


        function _add_hashtag($post_hashtag, $user_id, $blog_id) {
            if($post_hashtag != "undefined") {
                $hashtag = $post_hashtag;
                $hashtag_arr = explode('#', $hashtag);
                if (isset($hashtag_arr)) {
                    foreach ($hashtag_arr as $tag_name) {
                        $this->Hashtag_m->addHashtag($tag_name, $user_id, $blog_id);
                    }
                }
            }
        }



        public function add() {
            $user_id = $this->session->userdata('user_id');
            $this->_header();

            $this->load->model('Hashtag_m');
            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');

            
            $data['user_categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['user_category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['user_categorys']);

            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', '제목', 'required|max_length[100]');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view("addBlog", array('data'=>$data));
            }
            else {  
                // image 있을 때
                if ($this->input->post('upload_file_name') != null  && $this->input->post('upload_file_name') != 'undefined') {
                    
                    $this->_upload_config();

                    if($this->upload->do_upload("upload_file")) { // 업로드에 성공하면
                        // image file 이름 겹치는 것 방지
                        $upload_data = $this->upload->data();
                        $arr = explode('/', $upload_data['full_path']);
                        $upload_file_name = $arr[count($arr) - 1];
                
                    }
                    else { // 업로드에 실패하면
                        $this->load->view("addBlog", array('data'=>$data));
                    }
                }
                // image 없을 때
                else { 
                    $upload_file_name = null;
                }
                
                // category 게시물 개수 + 1
                $this->_category_increase($this->input->post('category_id'));
                        
                // category detail 게시물 개수 + 1
                $this->_category_detail_increase($this->input->post('category_detail_id'));
                

                $blog = array(
                    'user_id'=>$user_id,
                    'title'=>$this->input->post('title'),
                    'content'=>$this->input->post('content'),
                    'ispublic'=>$this->input->post('ispublic'),
                    'image'=>$upload_file_name, 
                    'category_id'=>$category_id,
                    'category_detail_id'=>$category_detail_id
                );
                $blog_id = $this->Blog_m->addBlog($blog); // 방금 작성한 블로그 아이디 리턴

                
                // 해쉬태그 테이블에 추가
                $this->_add_hashtag($this->input->post('hashtag'), $user_id, $blog_id);
               
                
                // 사용자가 작성한 블로그 페이지로 옮기기
                redirect('/~sale24/prj/blog/single/'.$blog_id);
            }
            
            $this->_footer();
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
            $config['overwrite'] = False;

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

        function _edit_hashtag($data_hashtag, $post_hashtag, $blog_id, $user_id) {

            // 해쉬태그 비교하기 위해서 문자열로 만들기
            $str_h = '';
            $count_h = 0;
            foreach ($data_hashtag as $htag) {
                if ($count_h == 0) {
                    $str_h .= $htag->name;
                }
                else {
                    $str_h .= "#".$htag->name;
                }
                $count_h++;
            }



            // 해쉬태그가 변경됬다면
            if($post_hashtag != $str_h) {
                // 기존의 해쉬태그 다 삭제
                if ($str_h != '') {
                    $this->Hashtag_m->deleteHashtag($data_hashtag);
                }
                // 해쉬태그 테이블에 추가
                $hashtag = $post_hashtag;
                $hashtag_arr = explode('#', $hashtag);
                
                if(isset($hashtag_arr) && $hashtag != 'undefined') {
                    foreach ($hashtag_arr as $tag_name) {
                        if ($tag_name != '') {
                            $this->Hashtag_m->addHashtag($tag_name, $user_id, $blog_id);
                        }
                        
                    }
                }
            }

        }


        function _edit_category($data_blog, $post_category_id, $post_category_detail_id) {

            // 카테고리가 변경되었다면
            if (($data_blog->category_id != $post_category_id)  && ($data_blog->category_id != null)) {
                // 카테고리 total 글 개수에서 -1을 한다.
                $category_id = $data_blog->category_id;
                $this->Category_m->decreaseCount($category_id);
            }

            // 카테고리 상세가 변경되었다면
            if (($data_blog->category_detail_id != $post_category_detail_id)  && ($data_blog->category_detail_id != null)) {
                // 카테고리 상세 total 글 개수에서 -1을 한다.
                $category_detail_id = $data_blog->category_detail_id;
                $this->Category_detail_m->decreaseCount($category_detail_id);
            }


            // 카테고리가 선택됐으면
            if ($post_category_id == 0) {
                $category_id = null;
            }
            else {
                $category_id = $post_category_id;
                $this->Category_m->increaseCount($category_id);
            }
            
            // 카테고리 상세가 선택됬으면
            if($post_category_detail_id == 0 || $post_category_detail_id == null) {
                $category_detail_id = null;
            }
            else {
                $category_detail_id = $post_category_detail_id;
                $this->Category_detail_m->increaseCount($category_detail_id);
            }

            $category_arr = array(
                'category_id'=>$category_id,
                'category_detail_id'=>$category_detail_id
            );

            return $category_arr;
        }


        public function edit($id) {
            $user_id = $this->session->userdata('user_id');
            $this->_header();

            $this->load->model('Hashtag_m');
            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');


            $data['blog'] = $this->Blog_m->getRow($id);
            $data['hashtag'] = $this->Hashtag_m->getHashtagByBlogId($id);
            $data['user_categorys'] = $this->Category_m->getCategoryByUserId($user_id);
            $data['user_category_details'] = $this->Category_detail_m->getCategoryDetailByCategory($data['user_categorys']);

            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', '제목', 'required|max_length[100]');


            if ($this->form_validation->run() == FALSE) {
                $this->load->view("editBlog", array('data'=>$data));
            }
            else {  
                // image를 변경했을 때
                if ($this->input->post('upload_file_name') != null && $this->input->post('upload_file_name') != 'undefined') {
                    
                    $this->_upload_config();

                    if($this->upload->do_upload("upload_file")) { // 업로드에 성공하면
                        // image file 이름 겹치는 것 방지
                        $upload_data = $this->upload->data();
                        $arr = explode('/', $upload_data['full_path']);
                        $upload_file_name = $arr[count($arr) - 1];
                    }
                    else { // 업로드에 실패하면
                        $this->load->view("editBlog", array('data'=>$data));
                    }
                }
                // image 없을 때
                else { 
                    $upload_file_name = null;
                }
                

                // 카테고리 변경
                $category = $this->_edit_category($data['blog'], $this->input->post('category_id'), $this->input->post('category_detail_id')); 

                $blog_id = $data['blog']->id;

                $blog = array(
                    'blog_id'=>$blog_id,
                    'user_id'=>$user_id,
                    'title'=>$this->input->post('title'),
                    'content'=>$this->input->post('content'),
                    'ispublic'=>$this->input->post('ispublic'),
                    'image'=>$upload_file_name, 
                    'category_id'=>$category['category_id'],
                    'category_detail_id'=>$category['category_detail_id']
                );
                $this->Blog_m->editBlog($blog); // 방금 작성한 블로그 아이디 리턴
                

                // 해쉬태그 변경
                $this->_edit_hashtag($data['hashtag'], $this->input->post('hashtag'), $blog_id, $user_id);


                // 사용자가 수정한 블로그 페이지로 옮기기
                redirect('/~sale24/prj/blog/single/'.$blog_id);

            }
            
            $this->_footer();
        }

        public function delete($blog_id) {

            $this->load->model('Category_m');
            $this->load->model('Category_detail_m');

            $blog = $this->Blog_m->getRow($blog_id);


            // 카테고리 게시물 개수 -1 해주기
            if ($blog->category_id != null) {
               $this->Category_m->decreaseCount($blog->category_id);
            }
            // 카테고리 디테일 게시물 개수 -1 해주기
            if ($blog->category_detail_id != null) {
                $this->Category_detail_m->decreaseCount($blog->category_detail_id);
            }

            // 블로그 삭제
            $this->Blog_m->deleteBlog($blog_id);

            redirect('/~sale24/prj/blog');
        }

        function _get_comments_and_user_and_num($blog_id) {

            $data['comments'] = $this->Comment_m->getCommentByBlogId($blog_id);
            if($data['comments'] != null) {
                $data['comment_users'] = $this->User_m->getCommentWriterByComment($data['comments']);
                $data['recomments'] = $this->Recomment_m->getRecommentByComment($data['comments']);
                if ($data['recomments'] != null) {
                    $data['recomment_users'] = $this->User_m->getRecommentWriterByRecomment($data['recomments']);
                }
                
            }

            $data['comments_num'] = $this->Comment_m->getCommentCount($blog_id);
            if($data['comments_num'] != 0) {
				$comments = $this->Comment_m->getCommentByBlogId($blog_id);
                $data['recomments_num'] = $this->Recomment_m->getRecommentCount($comments);
            }

            return $data;
        }
        
        public function ajax_comment() {
            $this->_ajax_header(); 

            $this->load->model('Comment_m');
            $this->load->model('User_m');
            $this->load->model('Recomment_m');


            $blog_id = $_POST['blog_id'];
            $content = $_POST['content'];

            

            
            $this->Comment_m->add($blog_id, $content);


            
            $data = $this->_get_comments_and_user_and_num($blog_id);


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        public function ajax_recomment() {
            $this->_ajax_header(); 

            $this->load->model('User_m');
            $this->load->model('Recomment_m');
            $this->load->model('Comment_m');


            $blog_id = $_POST['blog_id'];
            $comment_id = $_POST['comment_id'];
            $content = $_POST['content'];

            
            $this->Recomment_m->add($blog_id, $content, $comment_id);


            
            $data = $this->_get_comments_and_user_and_num($blog_id);
            


            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        public function ajax_edit_comment() {
			$this->_ajax_header(); 

            $this->load->model('Comment_m');
            $this->load->model('User_m');
            
			

            $comment_id = $_POST['comment_id'];
            $content = $_POST['content'];

            

            $this->Comment_m->edit($comment_id, $content);
			
			
			
			$data['comment'] = $this->Comment_m->getCommentById($comment_id);
			$data['comment_user'] = $this->User_m->getUserByUserId($data['comment']->user_id);
			
			
            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
		}

        public function ajax_edit_recomment() {
            $this->_ajax_header(); 

            $this->load->model('Recomment_m');
            $this->load->model('User_m');
            

            $recomment_id = $_POST['recomment_id'];
            $content = $_POST['content'];

            
            $this->Recomment_m->edit($recomment_id, $content);
			
			
			$data['recomment'] = $this->Recomment_m->getRecommentById($recomment_id);
			$data['recomment_user'] = $this->User_m->getUserByUserId($data['recomment']->user_id);
			
			
            $result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
        }


        public function ajax_delete_comment() {
			$this->_ajax_header(); 

            $this->load->model('Comment_m');
			$this->load->model('Recomment_m');


            $comment_id = $_POST['comment_id'];
			$blog_id = $_POST['blog_id'];
			
			
            $this->Comment_m->deleteComment($comment_id);
			
			
			$data['comments_num'] = $this->Comment_m->getCommentCount($blog_id);
            if($data['comments_num'] != 0) {
				$comments = $this->Comment_m->getCommentByBlogId($blog_id);
                $data['recomments_num'] = $this->Recomment_m->getRecommentCount($comments);
            }
			
			
			$result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
		}

        public function ajax_delete_recomment() {
			$this->_ajax_header(); 

            $this->load->model('Comment_m');
			$this->load->model('Recomment_m');

            $recomment_id = $_POST['recomment_id'];
			$blog_id = $_POST['blog_id'];
			
			
            $this->Recomment_m->deleteRecomment($recomment_id);
			
			
			
			$data['comments_num'] = $this->Comment_m->getCommentCount($blog_id);
            if($data['comments_num'] != null) {
				$comments = $this->Comment_m->getCommentByBlogId($blog_id);
                $data['recomments_num'] = $this->Recomment_m->getRecommentCount($comments);
            }
			
			
			$result = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $result;
		}


        public function check_recomment_exists() {
            $this->_ajax_header(); 

            $this->load->model('Recomment_m');

            $comment_id = $_POST['comment_id'];

            $recomment_count = $this->Recomment_m->getRecommentByCommentId($comment_id);


            if($recomment_count == 0) {
                $isExistRecomment = false;
            }
            else {
                $isExistRecomment = true;
            }
            
            $result = json_encode($isExistRecomment, JSON_UNESCAPED_UNICODE);
            echo $result;
        }
    }
?>