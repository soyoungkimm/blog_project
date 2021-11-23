
    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            <?php
              if (isset($data['blog']->image)) {
            ?>
            <img src="/~sale24/prj/my/img/blog/<?=$data['blog']->image?>" alt="Image" class="img-fluid mb-5" width="100%" >
            <?php
              }
            ?>
            <?php
              $writeday_arr = explode("-", $data['blog']->writeday);
              $year = $writeday_arr[0];
              $month = $writeday_arr[1];
              $date = $writeday_arr[2];

              if ($this->session->userdata('user_id') == $data['user']->id) {
            ?>
              <div style="float : right;">
                <span>
                  <a href="/~sale24/prj/blog/edit/<?=$data['blog']->id?>">수정</a>
                  <a style="cursor:pointer;" onclick="pressDelete();">삭제</a>
                </span>
              </div>
            <?php
              }
            ?>
             <div class="post-meta">
                <span class="author mr-2"><img src="/~sale24/prj/my/img/user/<?=$data['user']->image?>" alt="Colorlib" class="mr-2" > <?=$data['user']->name?></span>&bullet;
                <span class="mr-2"><?=$year?>년 <?=$month?>월 <?=$date?>일 </span> &bullet;
                <span class="ml-2"><span class="fa fa-comments"></span> <?=$data['blog']->count?></span>
              </div>
              
            <br>
            <h1 class="mb-4"><?=$data['blog']->title?></h1>

            <?php
              if(isset($data['category'])) {
            ?>
            <a class="category mb-5"><?=$data['category']->name?></a>&nbsp;
            <?php
              }
              if(isset($data['category_detail'])) {
            ?>
            <a class="category mb-5"><?=$data['category_detail']->name?></a>&nbsp;
            <?php
              }
            ?>

            <div class="post-content-body">
              <?=$data['blog']->content?>
            </div>

            
            <div class="pt-5">
              <p>Categories:
                <?php
                  if (isset($data['category'])) {
                ?>
                  <a><?=$data['category']->name?></a>
                <?php
                  }

                  if (isset($data['category_detail'])) {
                ?>
                / <a><?=$data['category_detail']->name?></a>  
                <?php
                  }
                ?>
                &nbsp;Tags: 
                <?php
                  if (isset($data['hashtags'])) {
                    foreach ($data['hashtags'] as $hashtag) {
                ?>
                <a>#<?=$hashtag->name?></a>&nbsp;
                <?php
                    }
                  }
                ?>
              </p>
            </div>


            <div class="pt-5">
              <h3 class="mb-5">
                <?php
                  if (isset($data['comments'])) {
                    if(isset($data['recomments'])) {
                      echo count($data['comments']) + count($data['recomments']);
                    }
                    else {
                      echo count($data['comments']);
                    }
                  }
                  else {
                    echo 0;
                  }
                ?> Comments</h3>
              <ul class="comment-list">
                
                <?php
                  // 댓글 출력
                  if (isset($data['comments'])) {
                    foreach ($data['comments'] as $comment) {
                      $arr = explode(" ", $comment->writeday);
                      $writedate_arr = explode("-", $arr[0]);
                      $year = $writeday_arr[0];
                      $month = $writeday_arr[1];
                      $date = $writeday_arr[2];

                      $writetime_arr = explode(":", $arr[1]);
                      $hour = $writetime_arr[0];
                      $minite = $writetime_arr[1];
                      $second = $writetime_arr[2];
                ?>
                      <li class="comment">
                        <div class="vcard">
                <?php
                      foreach ($data['comment_users'] as $comment_user) {
                        if($comment_user->id == $comment->user_id) {
                ?>
                          <img src="/~sale24/prj/my/img/user/<?=$comment_user->image?>" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                          <h3><?=$comment_user->name?></h3>
                <?php
                        }
                      }
                ?>
                          <div class="meta"><?=$year?>년 <?=$month?>월 <?=$date?>일 <?=$hour?>시 <?=$minite?>분 <?=$second?>초</div>
                          <?=$comment->content?>
                          <p><a onclick="clickCommentBtn('co<?=$comment->id?>')"  class="reply rounded" style="cursor:pointer;">Reply</a></p>
                          <div id="co<?=$comment->id?>" class="comment-form-wrap pt-5" style="width : 650px; magin-top : -100px; display : none;">
                            <form class="p-5 bg-light">
                              <div class="form-group">
                                <textarea name="review" cols="30" rows="10" class="form-control" id="recomment<?=$comment->id?>"></textarea>
                              </div>
                              <div class="form-group">
                                <input type="button" onclick="createRecoment(<?=$comment->id?>, 'recomment<?=$comment->id?>', <?=$data['blog']->id?>);" value="저장" class="btn btn-primary">
                              </div>
                            </form>
                          </div>

                        </div>
                      </li>
                <?php
                      // 대댓글 출력
                      if(isset($data['recomments'])) {
                        foreach ($data['recomments'] as $recomment) {
                          if($recomment->user_comment_id == $comment->id) {
                            $arr = explode(" ", $recomment->writeday);
                            $writedate_arr = explode("-", $arr[0]);
                            $year = $writeday_arr[0];
                            $month = $writeday_arr[1];
                            $date = $writeday_arr[2];

                            $writetime_arr = explode(":", $arr[1]);
                            $hour = $writetime_arr[0];
                            $minite = $writetime_arr[1];
                            $second = $writetime_arr[2];


                  ?>
                            <li class="comment" style="margin-left : 50px">
                              <div class="vcard">
                      <?php
                            foreach ($data['recomment_users'] as $recomment_user) {
                              if($recomment_user->id == $recomment->user_id) {
                      ?>
                                <img src="/~sale24/prj/my/img/user/<?=$recomment_user->image?>" alt="Image placeholder">
                              </div>
                              <div class="comment-body">
                                <h3><?=$recomment_user->name?></h3>
                      <?php
                              }
                            }
                      ?>
                                <div class="meta"><?=$year?>년 <?=$month?>월 <?=$date?>일 <?=$hour?>시 <?=$minite?>분 <?=$second?>초</div>
                                <?=$recomment->content?>
                              </div>
                            </li>

                          
                <?php   
                          }
                        }     
                      }
                    }
                  }
                    
                ?>
                

                
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">댓글 작성</h3>
                <form class="p-5 bg-light">
                  <div class="form-group">
                    <textarea name="review" id="comment_textarea" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="button" onclick="createComent(<?=$data['blog']->id?>, 'comment_textarea');" value="저장" class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>

          </div>

          <!-- END main-content -->

          <div class="col-md-12 col-lg-4 sidebar">
            <!--<div class="sidebar-box search-form-wrap">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>-->
            <!-- END sidebar-box -->
            <br>
            <div class="sidebar-box">
              <div class="bio text-center">
                <a href="/~sale24/prj/user/mypage/<?=$data['user']->id?>"><img src="/~sale24/prj/my/img/user/<?=$data['user']->image?>" alt="Image Placeholder" class="img-fluid" style="width : 100px; height : 100px;"></a>
                <br><br>
                <div class="bio-body">
                  <h2><?=$data['user']->name?></h2>
                  <p><?=$data['user']->mini_content?></p>
                  <p><a href="/~sale24/prj/user/mypage/<?=$data['user']->id?>" class="btn btn-primary btn-sm rounded">read more</a></p>
                  <p class="social">
                    <a class="p-2"><span class="fa fa-facebook"></span></a>
                    <a class="p-2"><span class="fa fa-twitter"></span></a>
                    <a class="p-2"><span class="fa fa-instagram"></span></a>
                    <a class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  

            <div class="sidebar-box">
              <h3 class="heading">Writer's Categories</h3>
              <ul class="categories">
                <li><a>전체 <span>(<?=$data['blog_count']?>)</span></a></li>
              <?php
                if (isset($data['user_categorys'])) {
                  foreach ($data['user_categorys'] as $user_category) {
              ?>
                    <li><a><?=$user_category->name?> <span>(<?=$user_category->article_num?>)</span></a></li>
              <?php
                    if (isset($data['user_category_details'])) {
                      foreach($data['user_category_details'] as $user_category_detail) {
                        if ($user_category->id == $user_category_detail->category_id) {
              ?>
                          <li><a>&nbsp;&nbsp;&nbsp;<?=$user_category_detail->name?><span>(<?=$user_category_detail->article_num?>)</span></a></li>
              <?php
                        }
                      }
                    }
                  }
                }  
              ?>
              </ul>
            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Writer's Tags</h3>
              <ul class="tags">
                <?php
                  if (isset($data['user_hashtags'])) {
                    foreach($data['user_hashtags'] as $user_hashtag) {
                ?>
                      <li><a><?=$user_hashtag->name?></a></li>
                <?php
                    }
                  }
                ?>
              </ul>
            </div>

            <div class="sidebar-box">
              <h3 class="heading">Writer's Popular Posts</h3>
              <div class="post-entry-sidebar">
                <ul>
                  <?php
                    foreach ($data['writerPopularBlogs'] as $writerPopularBlog) {
                      $writeday_arr = explode("-", $writerPopularBlog->writeday);
                      $year = $writeday_arr[0];
                      $month = $writeday_arr[1];
                      $date = $writeday_arr[2];
                  ?>
                  <li>
                    <a href="/~sale24/prj/blog/single/<?=$writerPopularBlog->id?>">
                    <?php
                      if (isset($writerPopularBlog->image)){
                    ?>
                      <img src="/~sale24/prj/my/img/blog/<?=$writerPopularBlog->image?>" alt="Image placeholder" class="mr-4">
                    <?php
                      }
                      else {
                    ?>
                      <img src="/~sale24/prj/my/img/blog/default.JPG" alt="Image placeholder" class="mr-4">
                    <?php
                      }
                    ?>
                      
                      <div class="text">
                        <h4><?=$writerPopularBlog->title?></h4>
                        <div class="post-meta">
                          <span class="mr-2"><?=$year?>년 <?=$month?>월 <?=$date?>일 </span>
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
            <!-- END sidebar-box -->
          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-3 ">인기 글</h2>
          </div>
        </div>
        <div class="row">
          <?php
            foreach ($data['popularBlogs'] as $popularBlog) {
              $writeday_arr = explode("-", $popularBlog->writeday);
              $year = $writeday_arr[0];
              $month = $writeday_arr[1];
              $date = $writeday_arr[2];
              if (isset($popularBlog->image)) {
                $bgimage = $popularBlog->image;
              }
              else {
                $bgimage = "default.JPG";
              }
          ?>
          <div class="col-md-6 col-lg-4">
            <a href="/~sale24/prj/blog/single/<?=$popularBlog->id?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url('/~sale24/prj/my/img/blog/<?=$bgimage?>'); ">
              <div class="text">
                <div class="post-meta">
                  <?php
                    if(isset($data['popularBlogsCategorys'])) {
                      foreach ($data['popularBlogsCategorys'] as $popularBlogsCategory) {
                        if ($popularBlogsCategory->id == $popularBlog->category_id) {
                  ?>
                          <span class="category"><?=$popularBlogsCategory->name?></span>
                  <?php
                          foreach($data['popularBlogsCategoryDetails'] as $popularBlogsCategoryDetail) {
                            if ($popularBlogsCategoryDetail->id == $popularBlogsCategory->id) {
                  ?>
                              <span class="category"><?=$popularBlogsCategoryDetail->name?></span>
                  <?
                            }
                          }
                        }
                      } 
                    }
                  ?>
                  <p>
                  <span class="mr-2"><?=$year?>년 <?=$month?>월 <?=$date?>일</span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> <?=$popularBlog->count?></span>
                  </p>
                </div>
                <h3><?=$popularBlog->title?></h3>
              </div>
            </a>
          </div>
          <?php
            }
          ?>
        </div>
      </div>


    </section>
    <!-- END section -->
  
    <script>
      function pressDelete() {
        var answer = confirm('정말로 삭제하시겠습니까?');
        if (answer) {
          window.location.href = "/~sale24/prj/blog/delete/<?=$data['blog']->id?>";
        }
      }



      function clickCommentBtn(comment_box_id) {
        //console.log();
        if(document.getElementById(comment_box_id).style.display == "none") {
          document.getElementById(comment_box_id).style.display = "block";
          
        }
        else {
          document.getElementById(comment_box_id).style.display = "none";
        }
        
      }



      function createComent(blog_id, review_id) {
       
        
        var content = document.getElementById(review_id).value;

        <?php
          if(!$this->session->userdata('user_id')) {
        ?>
          alert('로그인이 필요합니다');
          return;
        <?php
          }
        ?>
        


        if (content == '') {
          alert('내용을 입력해주세요');
          return;
        }

        

        $.ajax({
              url: "/~sale24/prj/blog/ajax_comment",
              type: "POST",
              data: {
                blog_id : blog_id, 
                content : content
              },
              datatype: "json",
              success : function(data) {
                
                var str = "";

                  // 댓글 출력
                  if (data.comments != null) {
                    for (var i = 0; i < data.comments.length; i++) {

                      var arr = data.comments[i].writeday.split(" ");
                      var writedate_arr = arr[0].split("-");
                      var year = writedate_arr[0];
                      var month = writedate_arr[1];
                      var date = writedate_arr[2];

                      var writetime_arr = arr[1].split(":");
                      var hour = writetime_arr[0];
                      var minite = writetime_arr[1];
                      var second = writetime_arr[2];

                      str +='<li class="comment">\n' + 
                              '<div class="vcard">\n'; 

                      for (var j = 0; j < data.comment_users.length; j++) {
                        if(data.comment_users[j].id == data.comments[i].user_id) {
                
                          str += '<img src="/~sale24/prj/my/img/user/' + data.comment_users[j].image + '" alt="Image placeholder">\n' + 
                          '</div>\n' + 
                          '<div class="comment-body">\n' + 
                          '<h3>' + data.comment_users[j].name + '</h3>\n';
                
                        }
                      }
                
                      str += '<div class="meta">' + year + '년' + month + '월' + date + '일' + hour + '시' + minite + '분' + second + '초</div>\n' + 
                          data.comments[i].content + 
                          '<p><a onclick="clickCommentBtn(\'co' + data.comments[i].id + '\')"  class="reply rounded" style="cursor:pointer;">Reply</a></p>\n' + 

                          '<div id="co' + data.comments[i].id + '" class="comment-form-wrap pt-5" style="width : 650px; magin-top : -100px; display : none;">\n' + 
                            '<form class="p-5 bg-light">\n' + 
                              '<div class="form-group">\n' + 
                                '<textarea name="review" cols="30" rows="10" class="form-control" id="recomment' + data.comments[i].id + '"></textarea>\n' + 
                              '</div>\n' + 
                              '<div class="form-group">\n' + 
                                '<input type="button" onclick="createRecoment(' + data.comments[i].id + ', \'recomment' + data.comments[i].id + '\',' +  <?=$data['blog']->id?> + ');" value="저장" class="btn btn-primary">\n' + 
                              '</div>\n' +
                            '</form>\n' +
                          '</div>\n' +
                        '</div>\n' +
                      '</li>\n';

                
                      // 대댓글 출력
                      if(data.recomments != null) {
                        for (var a = 0; a < data.recomments.length; a++) {
                          if(data.recomments[a].user_comment_id == data.comments[i].id) {
                            var arr = data.recomments[a].writeday.split(" ");
                            var writedate_arr = arr[0].split("-");
                            var year = writedate_arr[0];
                            var month = writedate_arr[1];
                            var date = writedate_arr[2];

                            var writetime_arr = arr[1].split(":");
                            var hour = writetime_arr[0];
                            var minite = writetime_arr[1];
                            var second = writetime_arr[2];


                
                            str += '<li class="comment" style="margin-left : 50px">\n' + 
                              '<div class="vcard">\n';

                            for(var z = 0; z < data.recomment_users.length; z++) 
                            {
                              if(data.recomment_users[z].id == data.recomments[a].user_id) 
                              {
                    
                                str += '<img src="/~sale24/prj/my/img/user/' + data.recomment_users[z].image + '" alt="Image placeholder">\n' + 
                                '</div>\n' + 
                                '<div class="comment-body">\n' +
                                '<h3>' + data.recomment_users[z].name + '</h3>\n';
                      
                              }
                            }
                      
                            str += '<div class="meta">' + year + '년' + month + '월' + date + '일' + hour + '시' + minite + '분' + second + '초</div>\n' + 
                                data.recomments[a].content + 
                              '</div>\n' +
                           '</li>\n';

                          
                 
                          }
                        }     
                      }
                    }
                  }
                    
              






                // 댓글 생성
                $('.comment-list').empty();
                $(".comment-list").append(str);
                
                // 댓글창 지우기
                document.getElementById(review_id).value = '';

                
              },
              error: function(request,status,error){ // 실패
                alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
              }
            });

      }




      function createRecoment(comment_id, review_id, blog_id) {

        var content = document.getElementById(review_id).value;
        
        $.ajax({
            url: "/~sale24/prj/blog/ajax_recomment",
            type: "POST",
            data: {
              comment_id : comment_id, 
              blog_id :blog_id, 
              content : content
            },
            datatype: "json",
            success : function(data) {
              
              var str = ""; 



              
              // 댓글 출력
              if (data.comments != null) {
                    for (var i = 0; i < data.comments.length; i++) {

                      var arr = data.comments[i].writeday.split(" ");
                      var writedate_arr = arr[0].split("-");
                      var year = writedate_arr[0];
                      var month = writedate_arr[1];
                      var date = writedate_arr[2];

                      var writetime_arr = arr[1].split(":");
                      var hour = writetime_arr[0];
                      var minite = writetime_arr[1];
                      var second = writetime_arr[2];

                      str +='<li class="comment">\n' + 
                              '<div class="vcard">\n'; 

                      for (var j = 0; j < data.comment_users.length; j++) {
                        if(data.comment_users[j].id == data.comments[i].user_id) {
                
                          str += '<img src="/~sale24/prj/my/img/user/' + data.comment_users[j].image + '" alt="Image placeholder">\n' + 
                          '</div>\n' + 
                          '<div class="comment-body">\n' + 
                          '<h3>' + data.comment_users[j].name + '</h3>\n';
                
                        }
                      }
                
                      str += '<div class="meta">' + year + '년' + month + '월' + date + '일' + hour + '시' + minite + '분' + second + '초</div>\n' + 
                          data.comments[i].content + 
                          '<p><a onclick="clickCommentBtn(\'co' + data.comments[i].id + '\')"  class="reply rounded" style="cursor:pointer;">Reply</a></p>\n' + 

                          '<div id="co' + data.comments[i].id + '" class="comment-form-wrap pt-5" style="width : 650px; magin-top : -100px; display : none;">\n' + 
                            '<form class="p-5 bg-light">\n' + 
                              '<div class="form-group">\n' + 
                                '<textarea name="review" cols="30" rows="10" class="form-control" id="recomment' + data.comments[i].id + '"></textarea>\n' + 
                              '</div>\n' + 
                              '<div class="form-group">\n' + 
                                '<input type="button" onclick="createRecoment(' + data.comments[i].id + ', \'recomment' + data.comments[i].id + '\',' +  <?=$data['blog']->id?> + ');" value="저장" class="btn btn-primary">\n' + 
                              '</div>\n' +
                            '</form>\n' +
                          '</div>\n' +
                        '</div>\n' +
                      '</li>\n';

                
                      // 대댓글 출력
                      if(data.recomments != null) {
                        for (var a = 0; a < data.recomments.length; a++) {
                          if(data.recomments[a].user_comment_id == data.comments[i].id) {
                            var arr = data.recomments[a].writeday.split(" ");
                            var writedate_arr = arr[0].split("-");
                            var year = writedate_arr[0];
                            var month = writedate_arr[1];
                            var date = writedate_arr[2];

                            var writetime_arr = arr[1].split(":");
                            var hour = writetime_arr[0];
                            var minite = writetime_arr[1];
                            var second = writetime_arr[2];


                
                            str += '<li class="comment" style="margin-left : 50px">\n' + 
                              '<div class="vcard">\n';

                            for(var z = 0; z < data.recomment_users.length; z++) 
                            {
                              if(data.recomment_users[z].id == data.recomments[a].user_id) 
                              {
                    
                                str += '<img src="/~sale24/prj/my/img/user/' + data.recomment_users[z].image + '" alt="Image placeholder">\n' + 
                                '</div>\n' + 
                                '<div class="comment-body">\n' +
                                '<h3>' + data.recomment_users[z].name + '</h3>\n';
                      
                              }
                            }
                      
                            str += '<div class="meta">' + year + '년' + month + '월' + date + '일' + hour + '시' + minite + '분' + second + '초</div>\n' + 
                                data.recomments[a].content + 
                              '</div>\n' +
                           '</li>\n';

                          
                 
                          }
                        }     
                      }
                    }
                  }





              // 댓글 생성
              $('.comment-list').empty();
              $(".comment-list").append(str);
              

              
            },
            error: function(request,status,error){ // 실패
              alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
              console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
            }
          });

      }
      
    </script>