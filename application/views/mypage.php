<style>
  #reviseBtn {
    border-radius: 5px; 
    padding : 5px; 
    width : 50px; 
    height : 35px; 
    display : absolute; 
    float : left; 
    margin-right : -100px;
  }

  #reviseBtn_user {
    border-radius: 5px; 
    padding : 5px; 
    width : 50px; 
    height : 35px; 
  }

  #search_title_mypage, #search_tag_mypage {
    background : #f7f7f7;
    border: none;          
  }

  #blog_title {
    height: 46px; 
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    white-space: normal; 
    text-align: left;
    display: -webkit-box; 
    -webkit-line-clamp: 2; 
    -webkit-box-orient: vertical;
    color : #000;
  }

  #blog_thumbnail {
    border : solid #efefef;
    border-width : 1px 1px 1px 1px; 
  }
</style>

<section class="site-section pt-5">
      <div class="container">
        <div class="row mb-4">
          <div class="col" style="text-align: center;">
            <div class="mypage_image_box" style="display: inline-block;border : solid #efefef; border-width : 1px 1px 1px 1px" >
              <img src="/~sale24/prj/my/img/user/<?=$data['user']->image?>" alt="Image Placeholder" id="mypage_image" />
            </div>
            <div style="display : inline-block; text-align : left; position : relative; top : -50px; margin-left : 15px">
              <div style="color : #000000; font-weight : bold; font-size : 25px; font-family : 'Nanum Gothic'">
                <?=$data['user']->name?>
              </div>
              <div style="color : #303030; font-size : 20px; font-family : 'Nanum Gothic';">
                <?=$data['user']->mini_content?>
              </div>
            </div>
          </div>
        </div>
        <hr style="width : 40%">
        <br><br>
        <div class="row blog-entries" >
          <div class="col-md-12 col-lg-4 sidebar" style="margin-left : -85px">
            <br>
            <div class="sidebar-box">
            <?php
              if ($this->session->userdata('user_id') == $data['user']->id) {
            ?>
              <button type="button" id="reviseBtn" onclick="location.href='/~sale24/prj/category/editCategory'" class="btn btn-primary" style>??????</button>
            <?php
              }
            ?>
              <h3 class="heading" style="text-align : center;">Categories</h3>
              <ul class="categories" id="ca_ul">
                <li class="lili" id="ca0" style="cursor:pointer;"><a onclick="pressEnter();">?????? <span>(<?=$data['blog_count']?>)</span></a></li>
              <?php
                if (isset($data['user_categorys'])) {
                  foreach ($data['user_categorys'] as $user_category) {
              ?>
                    <li class="lili" id="ca<?=$user_category->id?>" style="cursor:pointer;"><a onclick="pressCategory(1, <?=$user_category->id?>);"><?=$user_category->name?> <span>(<?=$user_category->article_num?>)</span></a></li>
              <?php
                    if (isset($data['user_category_details'])) {
                      foreach($data['user_category_details'] as $user_category_detail) {
                        if ($user_category->id == $user_category_detail->category_id) {
              ?>
                          <li class="lili" id="cade<?=$user_category_detail->id?>" style="cursor:pointer;"><a onclick="pressCategoryDetail(1, <?=$user_category_detail->id?>);">&nbsp;&nbsp;&nbsp;<?=$user_category_detail->name?><span>(<?=$user_category_detail->article_num?>)</span></a></li>
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


            <div class="sidebar-box search-form-wrap">
              <div class="search-form">
                <div class="form-group" >
                  <a onclick="pressEnter();" style="cursor:pointer;"><span class="icon fa fa-search"></span></a>
                  <input type="text" value="" class="form-control" id="search_title_mypage" placeholder="search by title" onkeyup="if(window.event.keyCode==13){pressEnter();}"/>
                </div>
              </div>
            </div>
            <!-- END sidebar-box -->



            <div class="sidebar-box search-form-wrap">
              <div class="search-form">
                <div class="form-group">
                  <a onclick="pressEnter();" style="cursor:pointer;"><span class="icon fa fa-search"></span></a>
                  <input type="text" value="" class="form-control" id="search_tag_mypage" placeholder="search by tag" onkeyup="if(window.event.keyCode==13){pressEnter();}"/>
                </div>
              </div>
            </div>

            <div class="sidebar-box">
              <h3 class="heading" style="text-align : center;">Tags</h3>
              <ul class="tags">
                <?php
                  if (isset($data['user_hashtags'])) {
                    foreach($data['user_hashtags'] as $user_hashtag) {
                ?>
                      <li><a id="tag" style="cursor:pointer;" onclick="document.getElementById('search_tag_mypage').value = '<?=$user_hashtag->name?>'; pressEnter();"><?=$user_hashtag->name?></a></li>
                <?php
                    }
                  }
                ?>
              </ul>
            </div>
          </div>


          <div class="col-md-12 col-lg-8 main-content" style="padding-left : 120px;">
            <div class="row">
              <div class="col-md-12" style="text-align : center;">
                <a id="write" style="color : #000000; font-weight : bold; font-size : 30px; font-family : 'Nanum Gothic'; 
                cursor:pointer;" onclick="changeListWrite(1);">???</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a id="introduce" style="color : #c7c7c7; font-weight : bold; font-size : 30px; font-family : 'Nanum Gothic'; 
                cursor:pointer;" onclick="changeListIntroduce(1);">??????</a>
                <?php
                  if ($this->session->userdata('user_id') == $data['user']->id) {
                ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a id="setting" style="color : #c7c7c7; font-weight : bold; font-size : 30px; font-family : 'Nanum Gothic'; 
                    cursor:pointer;" onclick="changeListSetting(1);">??????</a>
                <?php
                  }
                ?>
              </div>
            </div>
            <input type="hidden" id="isClickWrite" value="true"/>
            <input type="hidden" id="isClickIntroduce" value="false" />
            <input type="hidden" id="isClickSetting" value="false"/>

            <div id="intro_area">
              <!-- ?????? ????????? ?????? -->
            </div>

            <div id="setting_area">
              <!-- ?????? ????????? ?????? -->
            </div>

            <div class="row mb-5 mt-5" id="blog_list">
                <!--ajax blog list ????????? ??????-->
            </div>

            <div class="row" id="page_area">
                <!--ajax pagenation ????????? ??????-->
            </div>
          </div>
          <!-- END main-content -->

          
        </div>
      </div>
    </section>


    <script>
      var isClickWrite = document.getElementById('isClickWrite');
      var isClickIntroduce = document.getElementById('isClickIntroduce');
      var isClickSetting = document.getElementById('isClickSetting');



      $(document).ready(function () 
      {
        changeListWrite(1);
        $("#ca0").css("backgroundColor", "#f7f7f7");
      });




      function pressEnter() {
        $(".lili").css("backgroundColor", "#ffffff");

        var category = document.getElementById("ca0");
        category.style.backgroundColor = "#f7f7f7";


        if(isClickWrite.value == "true") {
          changeListWrite(1);
        }
        else if (isClickIntroduce.value == "true"){
          changeListIntroduce(1);
        }
        else if (isClickSetting.value == "true"){
          changeListSetting(1);
        }
      }





      function pressCategory(wishPage, category_id) {

        $(".lili").css("backgroundColor", "#ffffff");
        document.getElementById('search_tag_mypage').value = '';
        document.getElementById('search_title_mypage').value = '';

        var category = document.getElementById("ca"+category_id);
        category.style.backgroundColor = "#f7f7f7";

        execute_ajax_category(wishPage, category_id);
      }





      function pressCategoryDetail(wishPage, category_detail_id) {

        $(".lili").css("backgroundColor", "#ffffff");
        document.getElementById('search_tag_mypage').value = '';
        document.getElementById('search_title_mypage').value = '';

        var category_detail = document.getElementById("cade"+category_detail_id);
        category_detail.style.backgroundColor = "#f7f7f7";

        execute_ajax_category_detail(wishPage, category_detail_id);
      }






      function changeListWrite(wishPage) {

        $("#write").css("color", "#000000");
        $("#introduce").css("color", "#c7c7c7");
        $("#setting").css("color", "#c7c7c7");

        isClickWrite.value = 'true';
        isClickIntroduce.value = 'false';
        isClickSetting.value = 'false';

        execute_ajax_blog(wishPage);
      }





      function changeListIntroduce(wishPage) {

        $("#write").css("color", "#c7c7c7");
        $("#introduce").css("color", "#000000");
        $("#setting").css("color", "#c7c7c7");

        isClickWrite.value = 'false';
        isClickIntroduce.value = 'true';
        isClickSetting.value = 'false';

        var intro_str = '<div class="row mb-5 mt-5">\n' + 
                          '<div class="col-md-12">\n' + 
                            '<br>\n' + 
                            '<div style="text-align : center; font-size : 20px; font-family : \'Nanum Gothic\';">\n' + 
                              '<?=$data['user']->content?>\n' + 
                            '</div>\n' + 
                          '</div>\n' +  
                        '</div>';
        
        $("#blog_list").empty();
        $('#page_area').empty();
        $('#intro_area').empty();
        $('#setting_area').empty();
        $("#intro_area").append(intro_str);
      }






      function changeListSetting(wishPage) {

        $("#write").css("color", "#c7c7c7");
        $("#introduce").css("color", "#c7c7c7");
        $("#setting").css("color", "#000000");

        isClickWrite.value = 'false';
        isClickIntroduce.value = 'false';
        isClickSetting.value = 'true';

        var set_str = '<div class="row mb-5 mt-5">\n' +
                        '<div class="col-md-12">\n' + 
                          '<div style="text-align : center; font-size : 20px; font-family : \'Nanum Gothic\';">\n' + 
                            '<div class="mypage_image_box" style="display: inline-block; border : solid #efefef; border-width : 1px 1px 1px 1px">\n' + 
                              '<img src="/~sale24/prj/my/img/user/<?=$data['user']->image?>" alt="user_image" id="mypage_image" />\n' +   
                            '</div>\n' +  
                            '<br><br>\n' +
                            '<div style="text-align : left; display: inline-block;">\n' + 
                              '??????&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="mypage_input_text" value="<?=$data['user']->name?>" readonly/>\n' + 
                              '<br><br>\n' + 
                              'email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="mypage_input_text" value="<?=$data['user']->email?>" readonly/>\n' + 
                              '<br><br>\n' + 
                              '?????? ??????&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="mypage_input_text" value="<?=$data['user']->mini_content?>" readonly/>\n' + 
                              '<br><br>\n' + 
                              '??? ??????&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea id="mypage_input_textarea" rows="5" cols="33" readonly><?=$data['user']->content?></textarea>\n' + 
                              '<br><br>\n' + 
                              '????????? ?????? ?????? ?????? ??????&nbsp;&nbsp;&nbsp;\n';
                      
                  if(<?=$data['user']->getNotice?> == 0) {
                    set_str +='<label class="switch">\n' + 
                                '<input type="checkbox" checked onclick="return(false);">\n' + 
                                '<span class="slider round"></span>\n' + 
                              '</label>\n';
                  }
                  else { // ????????? ?????? ?????? ????????? ??????
                    set_str +='<label class="switch">\n' + 
                                '<input type="checkbox" onclick="return(false);">\n' + 
                                '<span class="slider round"></span>\n' + 
                              '</label>\n';
                  }
                  set_str +='</div>\n' + 
                            '<br><br>\n' + 
                            '<button type="button" id="reviseBtn_user" onclick="location.href=\'/~sale24/prj/user/edit\'" class="btn btn-primary">??????</button><br><br>\n' +
                          '<div>\n' + 
                        '</div>\n' + 
                      '</div>\n';

        $("#blog_list").empty();
        $('#page_area').empty();
        $('#intro_area').empty();
        $('#setting_area').empty();
        $("#setting_area").append(set_str);
      }



      function make_blog_list(result, wishPage) {
        // --------  blog list ?????? ?????? ?????? --------
        var str = ""; 
            for (var i = 0; i < result.blogs.length; i++) {
              
              var writeday_arr = result.blogs[i].writeday.split("-");
              var year = writeday_arr[0];
              var month = writeday_arr[1];
              var date = writeday_arr[2];
              
              str +='<div class="col-md-12">\n' + 
                    '<div class="post-entry-horzontal">\n' + 
                      '<a onclick="clickBlog(' + result.blogs[i].id + ', ' + result.blogs[i].ispublic + ');">\n';
                    if(result.blogs[i].image != null) {
                      str += '<div class="image" style="background-image: url(/~sale24/prj/my/img/blog/' + result.blogs[i].image + ');"></div>\n';
                    }
                    else {
                      str += '<div id="blog_thumbnail" class="image" style="background-image: url(/~sale24/prj/my/img/blog/default.jpg);"></div>\n';
                    }
                    str += '<span class="text" style="width : 530px;">\n' + 
                          '<div class="post-meta">\n' + 
                            '<span class="author mr-2"><img src="/~sale24/prj/my/img/user/<?=$data['user']->image?>" alt="Colorlib">&nbsp;&nbsp;<?=$data['user']->name?></span>&bullet;\n' + 
                            '<span class="mr-2">' + year + "??? " + month + "??? " + date + '???</span>\n';
                    <?php
                      if($this->session->userdata('user_id') == $data['user']->id) {
                    ?>
                    str +=  '&bullet;<span class="ml-2">????????? ' + result.blogs[i].count + '</span>\n';
                    <?php
                      }
                    ?>
                    str +='</div>\n' + 
                          '<h2 id="blog_title" style="word-break:break-all;">' + result.blogs[i].title + '</h2>\n' + 
                        '</span>\n' + 
                      '</a>\n' + 
                    '</div>\n' + 
                    '</div>\n';           
            }       



            // list ??????
            $("#blog_list").empty();
            $('#intro_area').empty();
            $('#setting_area').empty();
            $("#blog_list").html(str);
            // --------  blog list ?????? ?????? ???  --------




            // --------  page ?????? ?????? ?????? --------
            var PageNumToViewOneTime = 5; // ??????????????? ??? ?????? ?????? ????????? ??????
            var recordNumPerPage = 6.0; // ??? ???????????? ?????? ????????? ??????
            var totalRecordCount = result.total_count; // ????????? ??? ????????? ??????
            var totalPageNum = Math.ceil(totalRecordCount / recordNumPerPage); // ??? ????????? ??????, Math.ceil : ??????
            var totalBlockNum = Math.ceil(totalPageNum / PageNumToViewOneTime); // PageNumToViewOneTime ??? ??????
            var page_str = '<div class="col-md-12 text-center">\n' + 
                            '<nav aria-label="Page navigation" class="text-center">\n' + 
                              '<ul class="pagination">\n' +
                                '<div class="col-md-12 text-center">\n';



            
            // ?????? ??????
            if (wishPage > 1){
              page_str += "<li class='page-item'><a class='page-link' style='cursor:pointer;' id='page_before' "; 
              if(isClickWrite.value == "true") {
                page_str += 'onclick="changeListWrite(' + (wishPage - 1) + ');">';
              }else if (isClickIntroduce.value == "true"){
                page_str += 'onclick="changeListIntroduce(' + (wishPage - 1) + ');">';
              }
              else if (isClickSetting.value == "true") {
                page_str += 'onclick="changeListSetting(' + (wishPage - 1) + ');">';
              }
              page_str += "&lt;</a></li>\n";
            }
            else{
                page_str += "<li class='page-item'><a class='page-link' id='page_before'>&lt;</a></li>\n"; // ?????? ????????????
            }



            // ????????? ?????? ??????
            for(var j = 0; j < totalBlockNum; j++){
              if (1 + (PageNumToViewOneTime * j) <= wishPage && wishPage < 1 + (PageNumToViewOneTime * (j + 1))) {
                for (var k = 1 + (PageNumToViewOneTime * j); k < 1 + (PageNumToViewOneTime * (j + 1)); k++) {
                  if(wishPage == k && k <= totalPageNum){
                    page_str += "<li id='page_num' class='page-item active'><a class='page-link' style='cursor:pointer;'>" + k + "</a></li>\n";
                  }
                  else if(wishPage != k && k <= totalPageNum){

                    page_str += "<li id='page_num' class='page-item'><a class='page-link' style='cursor:pointer;' ";

                    if(isClickWrite.value == "true") {
                      page_str += 'onclick="changeListWrite(' + k + ');">';
                    }else if (isClickIntroduce.value == "true"){
                      page_str += 'onclick="changeListIntroduce(' + k + ');">';
                    }
                    else if(isClickSetting.value == "true") {
                      page_str += 'onclick="changeListSetting(' + k + ');">';
                    }
                    page_str += k + "</a></li>\n";
                  }
                  
                }
              }
              break;
            }


        
            // ?????? ??????
            if (wishPage < (totalPageNum)){

              page_str += "<li class='page-item'><a class='page-link' style='cursor:pointer;' id='page_after' ";

              if(isClickWrite.value == "true") {
                page_str += 'onclick="changeListWrite(' + (wishPage + 1) + ');">';
              }else if (isClickIntroduce.value == "true"){
                page_str += 'onclick="changeListIntroduce(' + (wishPage + 1) + ');">';
              }
              else if (isClickSetting.value == "true") {
                page_str += 'onclick="changeListSetting(' + (wishPage + 1) + ');">';
              }
              page_str += "&gt;</a></li>\n";
            }
            else{
              page_str += "<li class='page-item'><a class='page-link' style='cursor:pointer;' id='page_after'>&gt;</a></li>\n"; // ?????? ????????????
            }
            page_str += '</ul>\n' +
                      '</nav>\n' +
                      '</div>\n';


            // ????????? ??????
            $('#page_area').empty();
            $("#page_area").append(page_str);
            // --------  page ?????? ?????? ???  ---------
      }


      function execute_ajax_category(wishPage, category_id) {
        $.ajax({
          url: "/~sale24/prj/user/ajax_create_category_list",
          type: "POST",
          data: {
            category_id: category_id,
            wishPage: wishPage,
            user_id: <?=$data['user']->id?>
          },
          datatype: "json",
          success : function(result) {
            
            make_blog_list(result, wishPage);

          },
          error: function(request,status,error){ // ??????
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // ?????? ??? ??????
            console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
          }
        });
      }


      function execute_ajax_blog(wishPage) {

            $.ajax({
              url: "/~sale24/prj/user/ajax_createList",
              type: "POST",
              data: {
                search_title: $('#search_title_mypage').val(),
                search_tag: $('#search_tag_mypage').val(),
                wishPage: wishPage,
                user_id: <?=$data['user']->id?>
              },
              datatype: "json",
              success : function(result) {
                
                make_blog_list(result, wishPage);

              },
              error: function(request,status,error){ // ??????
                alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // ?????? ??? ??????
                console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
              }
            });
      }

      function execute_ajax_category_detail(wishPage, category_detail_id) {
        $.ajax({
          url: "/~sale24/prj/user/ajax_create_category_detail_list",
          type: "POST",
          data: {
            category_detail_id: category_detail_id,
            wishPage: wishPage,
            user_id: <?=$data['user']->id?>
          },
          datatype: "json",
          success : function(result) {
            
            make_blog_list(result, wishPage);
            
          },
          error: function(request,status,error){ // ??????
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // ?????? ??? ??????
            console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
          }
        });
      }



      function clickBlog(blog_id, ispublic) {
        
        var session_user_id = '<?=$this->session->userdata('user_id')?>';
        var user_id = '<?=$data['user']->id?>';
        
        if(ispublic == 1) {// ????????? ??? ??? 
          if (session_user_id != user_id) {
            alert('????????? ????????????.');
            return;
          }
        }
        location.href = '/~sale24/prj/blog/single/' + blog_id;
      }
    </script>