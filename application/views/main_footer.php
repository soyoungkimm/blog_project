    <style>
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
    </style>
      <footer class="site-footer">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-4">
              <h3>About Us</h3>
              <p class="mb-4">
                <img src="/~sale24/prj/my/img/blog/<?=$about->image?>" alt="Image placeholder" class="img-fluid" width="100%">
              </p>

              <p><span id="about"><?=$about->content?></span> <a href="/~sale24/prj/blog/single/5">Read More</a></p>
            </div>

            <div class="col-md-6 ml-auto">
              <div class="row">
                <div class="col-md-7">
                  <h3>Latest Post</h3>
                  <div class="post-entry-sidebar">
                    <ul>
                    <?php
                      $count = 0;
                      foreach ($blogs as $blog) {
                        $count++;
                        if ($count == 5){
                          break;
                        }
                        $writeday_arr = explode("-", $blog->writeday);
                        $year = $writeday_arr[0];
                        $month = $writeday_arr[1];
                        $date = $writeday_arr[2];
                    ?>
                      <li>
                        <a href="/~sale24/prj/blog/single/<?=$blog->id?>">
                          <?php
                            if (isset($blog->image)) {
                          ?>
                            <img src="/~sale24/prj/my/img/blog/<?=$blog->image?>" alt="Image placeholder" class="mr-4">
                          <?php
                            }
                            else {
                          ?>
                            <img src="/~sale24/prj/my/img/blog/default.JPG" alt="Image placeholder" class="mr-4">
                          <?php
                            }
                          ?>
                          <div class="text">
                            <h4><?=$blog->title?></h4>
                            <div class="post-meta">
                              <span class="mr-2"><?=$year?>년 <?=$month?>월 <?=$date?>일</span> &bullet;
                              <span class="ml-2"><span class="fa fa-comments"></span> <?=$blog->count?></span>
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
                <div class="col-md-1"></div>
                
                <div class="col-md-4">

                  <div class="mb-5">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                      <li><a href="/~sale24/prj/blog">Home</a></li>
                      <li><a href="/~sale24/prj/blog/single/5">About Us</a></li>
                      <li><a href="/~sale24/prj/blog/contact">Contact</a></li>
                    </ul>
                  </div>
                  
                  <div class="mb-5">
                    <h3>Social</h3>
                    <ul class="list-unstyled footer-social">
                      <li><a href="#"><span class="fa fa-twitter"></span> Twitter</a></li>
                      <li><a href="#"><span class="fa fa-facebook"></span> Facebook</a></li>
                      <li><a href="#"><span class="fa fa-instagram"></span> Instagram</a></li>
                      <li><a href="#"><span class="fa fa-vimeo"></span> Vimeo</a></li>
                      <li><a href="#"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                      <li><a href="#"><span class="fa fa-snapchat"></span> Snapshot</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <p class="small">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> All Rights Reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
        </div>
      </footer>
      <!-- END footer -->

    </div>
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>
    
    <script src="/~sale24/prj/my/lib/wordify-master/js/jquery-3.2.1.min.js"></script>
    <script src="/~sale24/prj/my/lib/wordify-master/js/jquery-migrate-3.0.0.js"></script>
    <script src="/~sale24/prj/my/lib/wordify-master/js/popper.min.js"></script>
    <script src="/~sale24/prj/my/lib/wordify-master/js/bootstrap.min.js"></script>
    <script src="/~sale24/prj/my/lib/wordify-master/js/owl.carousel.min.js"></script>
    <script src="/~sale24/prj/my/lib/wordify-master/js/jquery.waypoints.min.js"></script>
    <script src="/~sale24/prj/my/lib/wordify-master/js/jquery.stellar.min.js"></script>

    <script src="/~sale24/prj/my/lib/wordify-master/js/main.js"></script>
    
  </body>
</html>