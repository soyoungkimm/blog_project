     <style>
      #title_blog_content {
        height: 30px; 
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all;
        white-space: normal; 
        text-align: left;
        display: -webkit-box; 
        -webkit-line-clamp: 1; 
        -webkit-box-orient: vertical;
        color : #fff;
      }


      #blog_title {
        height: 55px; 
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all;
        white-space: normal; 
        text-align: left;
        display: -webkit-box; 
        -webkit-line-clamp: 2; 
        -webkit-box-orient: vertical;
      }

      #blog_thumbnail {
        width:100%;
        height:100%;
        object-fit: cover;
      }

      #blog_thumbnail_box {
        border : solid #efefef;
        border-width : 1px 1px 0px 1px; 
        width : 100%; 
        height:230px;
        overflow:hidden;
        margin:0 auto;
      }
       </style>
     
     <!-- 스크롤 이미지 시작 -->
      <section class="site-section pt-5 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <div class="owl-carousel owl-theme home-slider">
                <?php
                  $count = 0;
                  foreach($data['title_blog'] as $title_blog) {
                      $writeday_arr = explode("-", $title_blog->writeday);
                      $year = $writeday_arr[0];
                      $month = $writeday_arr[1];
                      $date = $writeday_arr[2];
                      
                      if ($count == "0") {
                        $image_name = "code.jpg";
                      }
                      else if($count == "1") {
                        $image_name = "table.jpg";
                      }
                      else if($count == "2") {
                        $image_name = "programming.png";
                      }
                ?>
                  <div>
                    <a href="/~sale24/prj/blog/single/<?=$title_blog->id?>" class="a-block d-flex align-items-center height-lg" style="background-image: url('/~sale24/prj/my/img/blog/<?=$image_name?>'); ">
                      <div class="text half-to-full">
                        <?php
                          if ($title_blog->category_name != null) {
                            echo '<span class="category mb-5">'.$title_blog->category_name.'</span>';
                          }
                          if ($title_blog->category_detail_name != null){
                            echo '<span class="category mb-5">'.$title_blog->category_detail_name.'</span>';
                          }
                        ?>
                        
                        <div class="post-meta">
                          
                          <span class="author mr-2"><img src="/~sale24/prj/my/img/user/<?=$title_blog->user_image?>" alt="Colorlib">&nbsp;&nbsp;<?=$title_blog->user_name?></span>&bullet;
                          <span class="mr-2"><?=$year?>년 <?=$month?>월 <?=$date?>일</span> 
                          
                        </div>
                        <h3><?=$title_blog->title?></h3>
                        <p id="title_blog_content"><?=strip_tags($title_blog->content)?></p>
                      </div>
                    </a>
                  </div>
                <?php
                  $count++;
                  }
                ?>
                
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- 스크롤 이미지 끝 -->




      



      <!-- 블로그 부분 시작 -->
      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <a id="recent" style="color : #000000; font-weight : bold; font-size : 30px; font-family : 'Nanum Gothic'; 
              cursor:pointer;" onclick="changeListSortRecent(1);">최신</a>
              <a id="popular" style="color : #c7c7c7; font-weight : bold; font-size : 30px; font-family : 'Nanum Gothic'; 
              cursor:pointer;" onclick="changeListSortPopular(1);">인기</a>


              <div style='float : right; margin-right : 10px; margin-top : -20px'>
                <div class="dropdown">
                  &nbsp;<a id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><div style="width : 30px; cursor : pointer; text-align : center;"><i class="fa fa-ellipsis-v fa-lg"></div></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdown04" style="margin-top : 1em; position: absolute;">
                    <a class="dropdown-item" href="/~sale24/prj/blog/single/54">About</a>
                    <a class="dropdown-item" href="/~sale24/prj/blog/contact">Contact</a>
                    <a class="dropdown-item" href="/~sale24/prj/user/mypage/3">Notice</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" id="isClickRecent" value="true"/>
          <input type="hidden" id="isClickPopular" value="false" />
          <br>
          <div class="row blog-entries">
              <div class="col-md-12 col-lg-8 main-content" >
                <div class="row" id="blog_list">
                  <!--  list ajax 출력될 부분 -->
                </div>
              

                <div class="row mt-5">
                  <div class="col-md-12 text-center">
                    <nav aria-label="Page navigation" class="text-center">
                      <ul class="pagination" id="page_area">
                        <!-- page ajax 출력될 부분 -->
                      </ul>
                    </nav>
                  </div>
                </div>
                
              </div>
            


            <div class="col-md-12 col-lg-4 sidebar">
              <div class="sidebar-box search-form-wrap">
                <div class="search-form">
                  <div class="form-group" >
                    <a onclick="pressEnter();" style="cursor:pointer;"><span class="icon fa fa-search"></span></a>
                    <input type="text" value="" class="form-control" id="search_title" placeholder="search by title" onkeyup="if(window.event.keyCode==13){pressEnter();}"/>
                  </div>
                <div>
                <br><br>
                <div class="search-form">
                  <div class="form-group">
                    <a onclick="pressEnter();" style="cursor:pointer;"><span class="icon fa fa-search"></span></a>
                    <input type="text" value="" class="form-control" id="search_tag" placeholder="search by tag" onkeyup="if(window.event.keyCode==13){pressEnter();}"/>
                  </div>
                </div>
              </div>
              <br><br>
              <!-- END sidebar-box -->
              <div class="sidebar-box">
                <h3 class="heading">Tags</h3>
                <ul class="tags">
                  <?php
                    foreach ($data['hashtags'] as $hashtag) {
                  ?>
                    <li><a id="tag" style="cursor:pointer;" onclick="document.getElementById('search_tag').value = '<?=$hashtag->name?>'; pressEnter();"><?=$hashtag->name?></a></li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
              <div class="sidebar-box">
                <h3 class="heading">Recommend Posts</h3>
                <div class="post-entry-sidebar">
                  <ul>
                    <?php
                      foreach ($data['recommend_blog'] as $recommend_blog) {
                        $writeday_arr = explode("-", $recommend_blog->writeday);
                        $year = $writeday_arr[0];
                        $month = $writeday_arr[1];
                        $date = $writeday_arr[2];
                      
                    ?>
                    <li>
                      <a href="/~sale24/prj/blog/single/<?=$recommend_blog->id?>">
                        <img src="/~sale24/prj/my/img/blog/<?=$recommend_blog->image?>" alt="Image placeholder" class="mr-4">
                        <div class="text">
                          <h4><?=$recommend_blog->title?></h4>
                          <div class="post-meta">
                            <span class="mr-2"><?=$year?>년 <?=$month?>월 <?=$date?>일</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <?php
                      }
                    ?>
                    
                  </ul>
                </div>
              </div>
            </div>
            <!-- END sidebar -->
          </div>
        </div>
      </section>
      <!-- 블로그 부분 끝 -->
      


      <script>
        var isClickRecent = document.getElementById('isClickRecent');
        var isClickPopular = document.getElementById('isClickPopular');
        $(document).ready(function () 
        {
          changeListSortRecent(1);
        });

        function pressEnter() {
          if(isClickRecent.value == "true") {
            changeListSortRecent(1);
          }
          else if (isClickPopular.value == "true"){
            changeListSortPopular(1);
          }
        }

        function changeListSortRecent(wishPage) {

          $("#recent").css("color", "#000000");
          $("#popular").css("color", "#c7c7c7");
          
          isClickRecent.value = 'true';
          isClickPopular.value = 'false';

          execute_ajax("recent", wishPage);
        }

        function changeListSortPopular(wishPage) {
          $("#recent").css("color", "#c7c7c7");
          $("#popular").css("color", "#000000");

          isClickRecent.value = 'false';
          isClickPopular.value = 'true';

          execute_ajax("popular", wishPage);
        }

        function execute_ajax(sort, wishPage) {
          
            $.ajax({
              url: "/~sale24/prj/blog/ajax_createList",
              type: "POST",
              data: {
                search_title: $('#search_title').val(),
                search_tag: $('#search_tag').val(),
                sort: sort,
                wishPage: wishPage
              },
              datatype: "json",
              success : function(data) {
                
                // --------  blog list 화면 변경 시작 --------
                var str = ""; 

                for (var i = 0; i < data.blogs.length; i++) {
                  
                  var writeday_arr = data.blogs[i].writeday.split("-");
                  var year = writeday_arr[0];
                  var month = writeday_arr[1];
                  var date = writeday_arr[2];

                  str +=  "<div class='col-md-6'>\n" +
                            "<div class='blog-entry'>\n" +
                            "<a href='/~sale24/prj/blog/single/" + data.blogs[i].id + "'>\n";
                  if(data.blogs[i].image != null) {
                      str += "<div id='blog_thumbnail_box'><img id='blog_thumbnail' src='/~sale24/prj/my/img/blog/" + data.blogs[i].image + "' alt='Image placeholder'/></div>\n";
                  }
                  else {
                      str += "<div id='blog_thumbnail_box'><img id='blog_thumbnail' src='/~sale24/prj/my/img/blog/default.jpg' alt='Image placeholder'/></div>\n";
                  }
                      str +="</a>\n" +  
                      "<div class='blog-content-body'>\n" + 
                                "<div class='post-meta'>\n" ;
                      for (var j = 0; j < data.users.length; j++) {
                        if(data.blogs[i].user_id == data.users[j].id) {
                          str +=  "<span class='author mr-2'>" + 
                                    "<a style='color : #B3B3B3;' href='/~sale24/prj/user/mypage/" + data.users[j].id + "'>" + 
                                      "<img src='/~sale24/prj/my/img/user/" + data.users[j].image + "' alt='Colorlib' />&nbsp;&nbsp;" + data.users[j].name + 
                                    "</a>" + 
                                  "</span>&bullet;\n";
                        }
                      }
                          str +=  "<span class='mr-2'>" + year + "년 " + month + "월 " + date + "일</span></span>\n" + 
                                "</div>\n" +
                                "<a href='/~sale24/prj/blog/single/" + data.blogs[i].id + "'>\n" + 
                                  "<h2 id='blog_title'>" + data.blogs[i].title + "</h2>\n" + 
                                "</a>\n" + 
                              "</div>\n" + 
                            "</div>\n" + 
                          "</div>\n";                
                }       



                // list 생성
                $("#blog_list").empty();
                $("#blog_list").html(str);
                // --------  blog list 화면 변경 끝  --------




                // --------  page 화면 변경 시작 --------
                var PageNumToViewOneTime = 5; // 웹페이지에 한 번에 보일 페이지 개수
                var recordNumPerPage = 8.0; // 한 페이지에 보일 레코드 개수
                var totalRecordCount = data.total_count; // 검색된 총 레코드 개수
                var totalPageNum = Math.ceil(totalRecordCount / recordNumPerPage); // 총 페이지 개수, Math.ceil : 올림
                var totalBlockNum = Math.ceil(totalPageNum / PageNumToViewOneTime); // PageNumToViewOneTime 총 개수
                var page_str = "";



                
                // 이전 버튼
                if (wishPage > 1){
                  page_str += "<li class='page-item'><a class='page-link' style='cursor:pointer;' id='page_before' "; 
                  if(isClickRecent.value == "true") {
                    page_str += 'onclick="changeListSortRecent(' + (wishPage - 1) + ');">';
                  }else if (isClickPopular.value == "true"){
                    page_str += 'onclick="changeListSortPopular(' + (wishPage - 1) + ');">';
                  }
                  page_str += "&lt;</a></li>\n";
                }
                else{
                    page_str += "<li class='page-item'><a class='page-link' id='page_before'>&lt;</a></li>\n"; // 버튼 비활성화
                }



                // 페이지 숫자 버튼
                for(var j = 0; j < totalBlockNum; j++){
                  if (1 + (PageNumToViewOneTime * j) <= wishPage && wishPage < 1 + (PageNumToViewOneTime * (j + 1))) {
                    for (var k = 1 + (PageNumToViewOneTime * j); k < 1 + (PageNumToViewOneTime * (j + 1)); k++) {
                      if(wishPage == k && k <= totalPageNum){
                        page_str += "<li id='page_num' class='page-item active'><a class='page-link' style='cursor:pointer;'>" + k + "</a></li>\n";
                      }
                      else if(wishPage != k && k <= totalPageNum){

                        page_str += "<li id='page_num' class='page-item'><a class='page-link' style='cursor:pointer;' ";

                        if(isClickRecent.value == "true") {
                          page_str += 'onclick="changeListSortRecent(' + k + ');">';
                        }else if (isClickPopular.value == "true"){
                          page_str += 'onclick="changeListSortPopular(' + k + ');">';
                        }
                        page_str += k + "</a></li>\n";
                      }
                      
                    }
                  }
                  break;
                }


            
                // 다음 버튼
                if (wishPage < (totalPageNum)){

                  page_str += "<li class='page-item'><a class='page-link' style='cursor:pointer;' id='page_after' ";
                  if(isClickRecent.value == "true") {
                    page_str += 'onclick="changeListSortRecent(' + (wishPage + 1) + ');">';
                  }
                  else if (isClickPopular.value == "true"){
                    page_str += 'onclick="changeListSortPopular(' + (wishPage + 1) + ');">';
                  }
                  page_str += "&gt;</a></li>\n";
                }
                else{
                  page_str += "<li class='page-item'><a class='page-link' style='cursor:pointer;' id='page_after'>&gt;</a></li>\n"; // 버튼 비활성화
                }



                // 페이지 생성
                $('#page_area').empty();
                $("#page_area").append(page_str);
                // --------  page 화면 변경 끝  ---------

                
              },
              error: function(request,status,error){ // 실패
                alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
              }
            });
        }


      </script>
      