    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            <?php
              if (isset($data['blog']->image)) {
            ?>
            <img src="/~sale24/prj/my/img/blog/<?=$data['blog']->image?>" alt="Image" class="img-fluid mb-5" width="100%">
            <?php
              }
            ?>
            <?php
              $writeday_arr = explode("-", $data['blog']->writeday);
              $year = $writeday_arr[0];
              $month = $writeday_arr[1];
              $date = $writeday_arr[2];
            ?>
              <div style="float : right;">
                <span>
                  <a href="#">수정</a>
                  <a href="#">삭제</a>
                </span>
              </div>
             <div class="post-meta">
                <span class="author mr-2"><img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Colorlib" class="mr-2"> username</span>&bullet;
                <span class="mr-2"><?=$year?>년 <?=$month?>월 <?=$date?>일 </span> &bullet;
                <span class="ml-2"><span class="fa fa-comments"></span> <?=$data['blog']->count?></span>
              </div>
              
            <br>
            <h1 class="mb-4"><?=$data['blog']->title?></h1>

            <?php
              if(isset($data['category'])) {
            ?>
            <a class="category mb-5" href="#"><?=$data['category']->name?></a>&nbsp;
            <?php
              }
              if(isset($data['category_detail'])) {
            ?>
            <a class="category mb-5" href="#"><?=$data['category_detail']->name?></a>&nbsp;
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
                  <a href="#"><?=$data['category']->name?></a>
                <?php
                  }

                  if (isset($data['category_detail'])) {
                ?>
                / <a href="#"><?=$data['category_detail']->name?></a>  
                <?php
                  }
                ?>
                &nbsp;Tags: 
                <?php
                  if (isset($data['hashtags'])) {
                    foreach ($data['hashtags'] as $hashtag) {
                ?>
                <a href="#">#<?=$hashtag->name?></a>&nbsp;
                <?php
                    }
                  }
                ?>
              </p>
            </div>


            <div class="pt-5">
              <h3 class="mb-5">6 Comments</h3>
              <ul class="comment-list">
                <li class="comment">
                  <div class="vcard">
                    <img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>
                </li>

                <li class="comment">
                  <div class="vcard">
                    <img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>

                  <ul class="children">
                    <li class="comment">
                      <div class="vcard">
                        <img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3>Jean Doe</h3>
                        <div class="meta">January 9, 2018 at 2:21pm</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                        <p><a href="#" class="reply rounded">Reply</a></p>
                      </div>


                      <ul class="children">
                        <li class="comment">
                          <div class="vcard">
                            <img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>Jean Doe</h3>
                            <div class="meta">January 9, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                            <p><a href="#" class="reply rounded">Reply</a></p>
                          </div>

                            <ul class="children">
                              <li class="comment">
                                <div class="vcard">
                                  <img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                  <h3>Jean Doe</h3>
                                  <div class="meta">January 9, 2018 at 2:21pm</div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                  <p><a href="#" class="reply rounded">Reply</a></p>
                                </div>
                              </li>
                            </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>

                <li class="comment">
                  <div class="vcard">
                    <img src="/~sale24/prj/my/lib/wordify-master/images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>
                </li>
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">댓글 작성</h3>
                <form action="#" class="p-5 bg-light">
                  <div class="form-group">
                    <textarea name="review" id="review" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="저장" class="btn btn-primary">
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
                <img src="/~sale24/prj/my/lib/wordify-master/images/person_2.jpg" alt="Image Placeholder" class="img-fluid">
                <div class="bio-body">
                  <h2>username</h2>
                  <p>작성자 소개</p>
                  <p><a href="#" class="btn btn-primary btn-sm rounded">read more</a></p>
                  <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  

            <div class="sidebar-box">
              <h3 class="heading">Writer's Categories</h3>
              <ul class="categories">
              <?php
                if (isset($data['user_categorys'])) {
                  foreach ($data['user_categorys'] as $user_category) {
              ?>
                    <li><a href="#"><?=$user_category->name?> <span>(<?=$user_category->article_num?>)</span></a></li>
              <?php
                    if (isset($data['user_category_details'])) {
                      foreach($data['user_category_details'] as $user_category_detail) {
                        if ($user_category->id == $user_category_detail->category_id) {
              ?>
                          <li><a href="#">&nbsp;&nbsp;&nbsp;<?=$user_category_detail->name?><span>(<?=$user_category_detail->article_num?>)</span></a></li>
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
                      <li><a href="#"><?=$user_hashtag->name?></a></li>
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
  
    