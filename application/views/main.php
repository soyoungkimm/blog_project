      <!-- 스크롤 이미지 시작 -->
      <section class="site-section pt-5 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <div class="owl-carousel owl-theme home-slider">
                <div>
                  <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('/~sale24/prj/my/img/blog/programming.png'); ">
                    <div class="text half-to-full">
                      <span class="category mb-5">Food</span>
                      <div class="post-meta">
                        
                        <span class="author mr-2"><img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
                        <span class="mr-2">March 15, 2018 </span> 
                        
                        
                      </div>
                      <h3>How to Find the Video Games of Your Youth</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                    </div>
                  </a>
                </div>
                <div>
                  <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('/~sale24/prj/my/img/blog/table.jpg'); ">
                    <div class="text half-to-full">
                      <span class="category mb-5">Travel</span>
                      <div class="post-meta">
                        
                        <span class="author mr-2"><img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
                        <span class="mr-2">March 15, 2018 </span> 
                        
                        
                      </div>
                      <h3>How to Find the Video Games of Your Youth</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                    </div>
                  </a>
                </div>
                <div>
                  <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('/~sale24/prj/my/img/blog/code.jpg'); ">
                    <div class="text half-to-full">
                      <span class="category mb-5">Sports</span>
                      <div class="post-meta">
                        
                        <span class="author mr-2"><img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
                        <span class="mr-2">March 15, 2018 </span> 
                       
                        
                      </div>
                      <h3>How to Find the Video Games of Your Youth</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                    </div>
                  </a>
                </div>
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
                    <a class="dropdown-item" href="/~sale24/prj/blog/single/5">About</a>
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
                <h3 class="heading">Recomment Posts</h3>
                <div class="post-entry-sidebar">
                  <ul>
                    <li>
                      <a href="">
                        <img src="images/img_2.jpg" alt="Image placeholder" class="mr-4">
                        <div class="text">
                          <h4>How to Find the Video Games of Your Youth</h4>
                          <div class="post-meta">
                            <span class="mr-2">March 15, 2018 </span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="">
                        <img src="images/img_4.jpg" alt="Image placeholder" class="mr-4">
                        <div class="text">
                          <h4>How to Find the Video Games of Your Youth</h4>
                          <div class="post-meta">
                            <span class="mr-2">March 15, 2018 </span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="">
                        <img src="images/img_12.jpg" alt="Image placeholder" class="mr-4">
                        <div class="text">
                          <h4>How to Find the Video Games of Your Youth</h4>
                          <div class="post-meta">
                            <span class="mr-2">March 15, 2018 </span>
                          </div>
                        </div>
                      </a>
                    </li>
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
                            "<a href='/~sale24/prj/blog/single/" + data.blogs[i].id + "' class='blog-entry'>\n";
                  if(data.blogs[i].image != null) {
                      str += "<img src='/~sale24/prj/my/img/blog/" + data.blogs[i].image + "' alt='Image placeholder' width='100%' height='230px' style='border : solid #efefef; border-width : 1px 1px 0px 1px'/>\n";
                  }
                  else {
                      str += "<img src='/~sale24/prj/my/img/blog/default.jpg' alt='Image placeholder' width='100%' height='230px' style='border : solid #efefef; border-width : 1px 1px 0px 1px'/>\n";
                  }
                      str += "<div class='blog-content-body'>\n" + 
                                "<div class='post-meta'>\n" ;
                      for (var j = 0; j < data.users.length; j++) {
                        if(data.blogs[i].user_id == data.users[j].id) {
                          str +=  "<span class='author mr-2'><img src='/~sale24/prj/my/img/user/" + data.users[j].image + "' alt='Colorlib' />" + data.users[j].name + "</span>&bullet;\n";
                        }
                      }
                          str +=  "<span class='mr-2'>" + year + "년 " + month + "월 " + date + "일</span></span>\n" + 
                                "</div>\n" +
                                "<h2>" + data.blogs[i].title + "</h2>\n" + 
                              "</div>\n" + 
                            "</a>\n" + 
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
      