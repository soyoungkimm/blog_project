<!doctype html>
<html lang="en">
  <head>
    <title>Belog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

    <link rel="stylesheet" href="/~sale24/prj/my/lib/wordify-master/css/bootstrap.css">
    <link rel="stylesheet" href="/~sale24/prj/my/lib/wordify-master/css/animate.css">
    <link rel="stylesheet" href="/~sale24/prj/my/lib/wordify-master/css/owl.carousel.min.css">

    <link rel="stylesheet" href="/~sale24/prj/my/lib/wordify-master/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/~sale24/prj/my/lib/wordify-master/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/~sale24/prj/my/lib/wordify-master/fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="/~sale24/prj/my/lib/wordify-master/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--ckeditor cdn-->
    <script src="https://cdn.ckeditor.com/4.17.1/full-all/ckeditor.js"></script>
    


    <style>
        /*레이어 팝업창*/
        .layer{
            position: fixed;
            width: 25%;
            left: 55%;
            margin-left: -20%;
            height: 360px;
            top: 50%;
            margin-top: -150px;
            overflow: auto;
            z-index: 20;
            display:none;

            /* decoration */
            background-color: #fff;
            padding: 1em;
            border-radius: 5px;
        }

        #mask {
            position:absolute;
            z-index:10;
            background-color:#000;
            display:none;
            left:0;
            top:0;
        }

        #login_input_text, #login_input_text2 {
          font-size : 17px; 
          font-family : 'Nanum Gothic'; 
          width : 220px; 
          height : 35px; 
          border : none; 
          outline : none;
          color : #6e6e6e;
          border : 1px solid #ebebeb;
        }

        #mypage_input_text {
          font-size : 17px; 
          font-family : 'Nanum Gothic'; 
          width : 220px; 
          height : 35px; 
          border : none; 
          outline : none;
          color : #6e6e6e;
          background : #f7f7f7;
        }

        #mypage_input_textarea {
          font-size : 17px; 
          font-family : 'Nanum Gothic'; 
          border : none; 
          outline : none;
          color : #6e6e6e;
          background : #f7f7f7;
        }

        /*글이 세줄 이상이면 글을 자르고 ...으로 대체한다.*/
        #about
        {
          height: 100px; 
          overflow: hidden;
          text-overflow: ellipsis;
          word-break: break-all;
          white-space: normal; 
          text-align: left;
          display: -webkit-box; 
          -webkit-line-clamp: 3; 
          -webkit-box-orient: vertical;
        }

        #search_title, #search_tag {
          background : #f7f7f7;
          border: none;          
        }

        .user_image_box {
          width: 38px;
          height: 38px; 
          border-radius: 100%;
          overflow: hidden;
        }

        #user_image {
          height: 38px;
          width : 38px;
          object-fit: cover;
        }

        .mypage_image_box {
          width: 200px;
          height: 200px; 
          border-radius: 100%;
          overflow: hidden;
        }

        #mypage_image {
          width : 200px;
          height: 200px;
          object-fit: cover;
        }


        /* The switch - the box around the slider */
        .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
          opacity: 0;
          width: 0;
          height: 0;
        }

        /* The slider */
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }

        .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }

        input:checked + .slider {
          background-color: #2196F3;
        }

        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }

        .slider.round:before {
          border-radius: 50%;
        }

        #wirteBtn {
          border-radius: 5px; 
          padding : 5px; 
          width : 100px;
        }

        #login {
          border-radius: 5px; 
          padding : 5px; 
          width : 80px;
        }

        .filebox .upload-name {
          display: inline-block;
          height: 40px;
          padding: 0 10px;
          vertical-align: middle;
          border: 1px solid #dddddd;
          width: 30%;
          color: #999999;
        }

      .filebox label {
        font-family : 'Nanum Gothic';
        display: inline-block;
        padding: 2px 20px;
        color: #000000;
        vertical-align: middle;
        background-color: #cdcdcd;
        cursor: pointer;
        height: 40px;
        margin-left: 10px;
        margin-top : 9px
        
      }

      .filebox input[type="file"] {
        position: absolute;
        width: 0;
        height: 0;
        padding: 0;
        overflow: hidden;
        border: 0;
      }

      #submitBtn {
        font-family : 'Nanum Gothic'; 
        background : #c7c7c7;
        border: none;
        border-radius: 5px;
        width : 80px;
      }


      .btn-primary {
        background-color: #b486ff;
        border-color: #b486ff;
      }

      .page-item.active .page-link {
        background-color: #b486ff;
      }

      .pagination li a:hover {
        background-color: #b486ff;
        
      }

      .category {
        background-color: #b486ff;
      }

      .tags li a:hover {
        background-color: #b486ff;
      }

      #tag:hover{
        color : #fff;
      }

      #page_before:hover {
        color : #fff;
      }

      #page_after:hover {
        color : #fff;
      }

      #page_num:hover {
        color : #fff;
      }

      p, .blog-entries .post-meta {
        font-family : 'Nanum Gothic'; 
      }
      </style>
  </head>
  <body>
    <div class="wrap">
      <header role="banner">
        <div class="top-bar" style="background : #fff; padding : 5px;">
          <div class="container" style="text-align : right; padding-bottom : 20px; padding-top : 30px"> 
          <a href="/~sale24/prj/blog"><img src="/~sale24/prj/my/img/blog/logo.png" style="width : 102px; height : 40px; float : left;" /> </a>
          <?php
            if(!$this->session->userdata('user_id')) {
              echo "<button type='button' id='login' class='btn btn-primary'>로그인</button>";
            }
            else {
          ?>
              <button type="button" id="wirteBtn" onclick="location.href = '/~sale24/prj/blog/add'" class="btn btn-primary" >새 글 작성</button>&nbsp;&nbsp;
              
              <div style='float : right;'>
                <div class="dropdown">
                  &nbsp;<a class="dropdown-toggle"  href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                  <div class="dropdown-menu" aria-labelledby="dropdown04" style="margin-top : 1em; position: absolute;">
                    <a class="dropdown-item" href="/~sale24/prj/user/mypage/<?=$this->session->userdata('user_id');?>">내 벨로그</a>
                    <a class="dropdown-item" href="/~sale24/prj/auth/logout">로그아웃</a>
                  </div>
                </div>
              </div>
              <div style='float : right;'>
                <div class='user_image_box'><img src='/~sale24/prj/my/img/user/<?=$this->session->userdata('user_image')?>' alt='userImage' id='user_image'/></div>
              </div>
          <?php
            }
				  ?>  
          </div>
        </div>


        <!--<div class="container logo-wrap">
          <div class="row pt-5">
            <div class="col-12 text-center">
              <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
              <h1 class="site-logo"><a href="/~sale24/prj/blog">Belog</a></h1>
            </div>
          </div>
        </div>-->
        
        <!--<nav class="navbar navbar-expand-md  navbar-light bg-light">
          <div class="container">
            <div class="collapse navbar-collapse" id="navbarMenu">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/~sale24/prj/blog">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/~sale24/prj/blog/single/5">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/~sale24/prj/blog/contact">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/~sale24/prj/user/mypage/3">Notice</a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>-->
      </header>
      <!-- END header -->



      <!--  로그인 팝업 창 시작   -->
      <form action="/~sale24/prj/auth/login" method="post">
        <div class="layer">
          <br>
          <h4 style="text-align : center;">로그인</h4>
          <br>
          <div align="center">
            <div>
              <input type="text" name="user_email" id="login_input_text" placeholder="email"/>
            </div>
            <br>
            <div>
              <input type="password" name="user_pwd" id="login_input_text2" placeholder="비밀번호"/>
            </div>
            <br>
            <button type="submit" id="" class="btn btn-primary" style="border-radius: 5px; padding : 5px; width : 50px">확인</button>
            <button type="button" onclick="location.href='/~sale24/prj/user/signup'" class="btn btn-primary" style="border-radius: 5px; padding : 5px; width : 80px">회원가입</button>
          </div>
          <br>
        </div>
        <div id="mask"></div>
      </form>
      <!--  로그인 팝업 창 끝   -->
