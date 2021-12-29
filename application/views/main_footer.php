<style>
  #footer_latest_blog_title {
    height: 46px; 
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    white-space: normal; 
    text-align: left;
    display: -webkit-box; 
    -webkit-line-clamp: 2; 
    -webkit-box-orient: vertical;
    color : #fff;
    padding-top : 3px;
  }
</style>
      <footer class="site-footer">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-4">
              <h3>About Us</h3>
              <p class="mb-4">
                <img src="/~sale24/prj/my/img/blog/logo.png" alt="Image placeholder" class="img-fluid" width="60%">
              </p>

              <span id="about"><?=strip_tags($about->content)?></span> <a href="/~sale24/prj/blog/single/54">Read More</a>
            </div>

            <div class="col-md-6 ml-auto">
              <div class="row">
                <div class="col-md-7">
                  <h3>Latest Post</h3>
                  <div class="post-entry-sidebar">
                    <ul>
                    <?php
                      foreach ($blogs as $blog) {

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
                            <img src="/~sale24/prj/my/img/blog/default.jpg" alt="Image placeholder" class="mr-4">
                          <?php
                            }
                          ?>
                          <div class="text">
                            <h4 style="word-break:break-all;" id="footer_latest_blog_title"><?=$blog->title?></h4>
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
                <div class="col-md-1"></div>
                
                <div class="col-md-4">

                  <div class="mb-5">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                      <li><a href="/~sale24/prj/blog">Home</a></li>
                      <li><a href="/~sale24/prj/blog/single/54">About Us</a></li>
                      <li><a href="/~sale24/prj/blog/contact">Contact</a></li>
                    </ul>
                  </div>

                  <div class="mb-5">
                    <h3 style="color : #b486ff;">Developer</h3>
                    <ul class="list-unstyled">
                      
                      <li style="font-family : 'Nanum Gothic'; color : #fff;">김소영</li>
                      
                    </ul>
                  </div>
                  
                  <!--<div class="mb-5">
                    <h3>Social</h3>
                    <ul class="list-unstyled footer-social">
                      <li><a href=""><span class="fa fa-twitter"></span> Twitter</a></li>
                      <li><a href=""><span class="fa fa-facebook"></span> Facebook</a></li>
                      <li><a href=""><span class="fa fa-instagram"></span> Instagram</a></li>
                      <li><a href=""><span class="fa fa-vimeo"></span> Vimeo</a></li>
                      <li><a href=""><span class="fa fa-youtube-play"></span> Youtube</a></li>
                      <li><a href=""><span class="fa fa-snapchat"></span> Snapshot</a></li>
                    </ul>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center" style="margin-bottom : -100px">
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
          
    <script>
      // 레이어 팝업창 열기
      function layer_open(){

      var maskHeight = $(document).height();
      var maskWidth = $(window).width();
      //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
      $('#mask').css({'width':maskWidth,'height':maskHeight});

      // 1초동안 까맣게 됐다가 50%불투명
      $('#mask').fadeTo("slow",0.5);

      $(".layer").fadeIn();

      //레이어 영역 외 바탕화면 클릭시 화면 닫기
      $("#mask").click(function (e) {
          layer_close();
      })
      }

      // 레이어 팝업창 닫기
      function layer_close(){
      $(".layer").fadeOut();
      $('#mask').fadeOut();
      }

      // 버튼 클릭시 레이어 팝업창 열기
      $("#login").click(function () {
      layer_open();
      })

      // 로그인 error검사
      $(document).ready(function () 
      {
        var search = location.search;
        var param = new URLSearchParams(search);

        if (param.has('loginerror')) {
          layer_open();
        }
      });

    </script>


    <!--<script type="text/javascript" src="/~sale24/prj/my/lib/TableDnD-master/js/jquery.tablednd.js"></script>-->
  </body>
</html>