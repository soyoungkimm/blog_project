    <style>
      

      #title {
        color : #000000; 
        font-weight : bold;
        font-size : 40px; 
        font-family : 'Nanum Gothic';  
        width : 100%; 
        height : 60px; 
        border : none; 
        outline : none;
      }

      #public {
        color : #000000; 
        font-weight : bold;
        font-size : 20px; 
        font-family : 'Nanum Gothic'; 
        cursor:pointer;
      }

      #private {
        color : #c7c7c7; 
        font-weight : bold;
        font-size : 20px; 
        font-family : 'Nanum Gothic'; 
        cursor:pointer;
      }

      input::placeholder {
        color : #c7c7c7;
      }

      #category_area {
        color : #666666; 
        font-weight : bold;
        font-size : 20px; 
        font-family : 'Nanum Gothic'; 
      }

      #hashtag_txt {
        color : #000000; 
        font-size : 25px; 
        font-family : 'Nanum Gothic';  
        width : 280px; 
        height : 35px; 
        border : none; 
        outline : none;
      }

      #hashtag_a {
        border-radius: 15px;
        font-family : 'Nanum Gothic'; 
        color : #000000;
        background : #a3d4ff;
        border: none; 
        padding-left : 10px;
        padding-right : 10px;
      }

      

      .form-select {
        border-color : #c7c7c7;
        border-radius: 5px;
      }


    </style>
    
    <section class="site-section pt-5">
      <div class="container">
        <form action="/~sale24/prj/blog/edit/<?=$data['blog']->id?>" method="post" enctype="multipart/form-data" name="editBlogForm">
          <div class="row mb-4">
            <div class="col" style="text-align: center;" >
              <div id="all" style="display: inline-block;">
                <div id="category_area" style="text-align : left;">
              <?php 
                // 유효성 검사에서 걸린경우
                if (set_value('category_id') != '') {
              ?>
                  카테고리&nbsp;&nbsp;
                  <select class="form-select" aria-label="Default select example" name="category_id" id="ca_sel" onchange="selected();" >
                    <option value="0">없음</option>
                    <?php
                      if (isset($data['user_categorys'])) {
                        foreach ($data['user_categorys'] as $user_category) {
                          if ($user_category->id == set_value('category_id')) {
                    ?>
                            <option value="<?=$user_category->id?>" selected><?=$user_category->name?></option>
                    <?php
                          }
                          else {
                    ?>
                            <option value="<?=$user_category->id?>"><?=$user_category->name?></option>                          
                    <?php
                          }
                        }  
                      }
                    ?>
                  </select>
              <?php
                }
                // 유효성 검사에서 걸리지 않은 경우(처음 고칠 때)
                else {
              ?>
                  카테고리&nbsp;&nbsp;
                  <select class="form-select" aria-label="Default select example" name="category_id" id="ca_sel" onchange="selected();" >
                    <option value="0">없음</option>
                    <?php
                      if (isset($data['user_categorys'])) {
                        foreach ($data['user_categorys'] as $user_category) {
                          if ($user_category->id == $data['blog']->category_id) {
                    ?>
                          <option value="<?=$user_category->id?>" selected><?=$user_category->name?></option>
                    <?php
                          }
                          else {
                    ?>
                          <option value="<?=$user_category->id?>"><?=$user_category->name?></option>
                    <?php
                          }
                        }  
                      }
                    ?>
                  </select>
              <?php
                }
              ?> 
                  &nbsp;&nbsp;&nbsp;

                  <div id="ca_de_area" style="display : inline-block;">
                    <?php
                      // 유효성 검사에서 걸린 경우
                      if(set_value('category_detail_id') != '') {
                        ?>    
                        카테고리 상세&nbsp;&nbsp;
                        <select class="form-select" aria-label="Default select example" name="category_detail_id">
                          <option value="0">없음</option>
              <?php
                        foreach ($data['user_category_details'] as $user_category_detail) {
                          if (set_value('category_id') == $user_category_detail->category_id) {
                            if ($user_category_detail->id == set_value('category_detail_id')) {
              ?>
                            <option value="<?=$user_category_detail->id?>" selected><?=$user_category_detail->name?></option>
              <?php   
                            }
                            else {
              ?>
                            <option value="<?=$user_category_detail->id?>"><?=$user_category_detail->name?></option>
              <?php
                            }
                          }
                        }
              ?>
                        </select>
                    <?php
                      }
                      // category_detail이 blog에 있을 경우
                      else if(isset($data['blog']->category_detail_id)) {
                    ?>
                        카테고리 상세&nbsp;&nbsp;
                        <select class="form-select" aria-label="Default select example" name="category_detail_id">
                          <option value="0">없음</option>
              <?php
                        foreach ($data['user_category_details'] as $user_category_detail) {
                          if ($data['blog']->category_id == $user_category_detail->category_id) {
                            if ($user_category_detail->id == $data['blog']->category_detail_id) {
              ?>
                            <option value="<?=$user_category_detail->id?>" selected><?=$user_category_detail->name?></option>
              <?php   
                            }
                            else {
              ?>
                            <option value="<?=$user_category_detail->id?>"><?=$user_category_detail->name?></option>
              <?php
                            }
                          }
                        }
              ?>
                        </select>
                    <?php    
                      }
                    ?>
                    
                        <!-- category detail 출력 부분 -->
                  </div>
                </div>

                <br>
                <div style="text-align : left;">
                  <a id="public" onclick="clickPublic();">공개</a>&nbsp;&nbsp;&nbsp;
                  <a id="private" onclick="clickPrivate();">비공개</a>
                <div>
                <input type="hidden" name="ispublic" value="0" />
                
                <br>
                <?php
                  if ($data['blog']->image != null) {
                    echo "<img src='/~sale24/prj/my/img/blog/".$data['blog']->image."' width='500px'>";
                  }
                ?>
                <div class="filebox" style="text-align : left;">
                  <input class="upload-name" name="upload-name" value="<?=$data['blog']->image?>" placeholder="첨부파일" readonly>
                  <label for="file">파일찾기</label> 
                  <input type="file" id="file" name="upload_file">
                  <input type="hidden" name="upload_file_name" value="">
                </div>
                <br>
                

                <input type="text" name="title" value="<?php if(set_value('title') != '') {echo set_value('title');} else {echo $data['blog']->title;} ?>" placeholder="제목을 입력하세요" style="width: 100%" id="title"/>
                
                <br><br>

                <textarea name="content" placeholder="내용" rows="10" cols="50"><?php if(set_value('content') != '') {echo htmlspecialchars(set_value('content'));} else {echo htmlspecialchars($data['blog']->content);} ?></textarea>

                <br>
                <div style="text-align : left;">
                  <div id="m_hashtag" style="display : inline-block;">
                      <!--hashtag 출력 부분-->
                  </div>

                  <input type="text" placeholder="해쉬 태그를 입력하세요" id="hashtag_txt" 
                  onkeyup="if(window.event.keyCode==13){make_hashtag();}" />
                  
                  <input type="hidden" name="hashtag" value="">
                  
                <div>
          
                <br>
                
                
              </div>
            </div>
          </div>
          <br><br><br><br>
          <div class="row mb-4" style="text-align : center;">
            <div class="col">
              <?php echo validation_errors(); ?>
              <input type="button" onclick="submitForm();" value="저장" style="text-align : center;" id="submitBtn"/>
            </div>
          </div>
        </form>
      </div>
    </section>
    


    


    
    <script>
      CKEDITOR.replace('content', {
          filebrowserUploadUrl: "/~sale24/prj/blog/ck_upload_run",
          extraPlugins: 'codesnippet',
          codeSnippet_theme: 'monokai_sublime',
          height: '800',
          removeButtons: 'PasteFromWord'
      });         
    </script>
    <script>
      var ispublic = document.getElementsByName('ispublic');


      $(document).ready(function() {
        
        // 제목 끝으로 focus
        var len = $('input[name=title]').val().length;
        $('input[name=title]').focus();
        $('input[name=title]')[0].setSelectionRange(len, len);
        
        <?php
          // 유효성 검사에서 걸렸을 때
          if (set_value('ispublic') != '') {
            if (set_value('ispublic') == 0) {
        ?>
              clickPublic();
        <?php
            }
            else {
        ?>
              clickPrivate();
        <?php
            }
          }
          // 첫 화면 ispublic 출력
          else {
            if($data['blog']->ispublic == 0) {
        ?>
              clickPublic();
        <?php
            }
            else {
        ?>
              clickPrivate();
        <?php
            }
          }



          // 유효성 검사 걸렸을 때
          if (set_value('hashtag') != '' && set_value('hashtag') != 'undefined') {
            $param = set_value('hashtag');
            echo "make_hashtag_set_val('$param');";
          }
          // 처음 화면일 때
          else if ($data['hashtag'] != null){
            
            $hstr = '';
            $count = 0;
            foreach ($data['hashtag'] as $hashtag) {
              if ($count == 0) {
                $hstr = $hashtag->name;
              }
              else {
                $hstr .= "#".$hashtag->name;
              }
              $count++;
            }
            $param = $hstr;
            
            echo "make_hashtag_first('$param');";
          }
        ?>          
        
      });



      // submit하기
      function submitForm() {
        
        var form = document.editBlogForm;
        form.hashtag.value = document.getElementsByName('hashtag').value;
        form.ispublic.value = document.getElementsByName('ispublic').value;

        if (form.upload_file_name.value != null) {
          form.upload_file_name.value = document.getElementsByName('upload_file_name').value;
        }
      
        form.submit();
      }


      function clickPublic() {
        $("#public").css("color", "#000000");
        $("#private").css("color", "#c7c7c7");

        ispublic.value = '0'; // 공개
      }


      function clickPrivate() {
        $("#public").css("color", "#c7c7c7");
        $("#private").css("color", "#000000");
        
        ispublic.value = '1'; // 공개
      }

      

      // enter키 submit방지
      $('input[type="text"]').keydown(function() {
          if (event.keyCode === 13) {
              event.preventDefault();
          }
      });


      function selected(){
      
        var sel_str = '카테고리 상세&nbsp;&nbsp;<select class="form-select" aria-label="Default select example" name="category_detail_id">\n' + 
                        '<option value="0" selected>없음</option>\n';
        var ca_sel = document.getElementById("ca_sel"); 
        var selected_category_id = ca_sel.options[ca_sel.selectedIndex].value; //option의 value가 저장
        var count = 0;
<?php
          foreach ($data['user_category_details'] as $user_category_detail) {
?>
            if (selected_category_id == <?=$user_category_detail->category_id?>) {
              sel_str += '<option value="<?=$user_category_detail->id?>"><?=$user_category_detail->name?></option>\n';
              count++;
            }
<?php   
          }
?>
        sel_str += '</select>';

        if (count > 0) {
          $("#ca_de_area").empty();
          $("#ca_de_area").html(sel_str);
        }
        else {
          $("#ca_de_area").empty();
        }
      } 





      $("#file").on('change',function(){
        var file_val = $("#file").val();
        var file_arr = file_val.split('\\');
        var file_name = file_arr[file_arr.length - 1];

        $(".upload-name").val(file_name);
        document.getElementsByName('upload_file_name').value = file_name;
        
      });     



      function make_hashtag() {
        var hashtag = $('#hashtag_txt').val();

        document.getElementById('hashtag_txt').value = '';
        
        var hashtag1 = document.getElementsByName('hashtag');
        
        
        if (hashtag1.value == null || hashtag1.value == '') {
          // 해쉬태그 이름 저장
          hashtag1.value = hashtag;
        }
        else {
          // 같은 값의 해쉬태그가 있는지 확인
          var arr = hashtag1.value.split('#');
          for (var a = 0; a < arr.length; a++) {
            if (arr[a] == hashtag) {
              return;
            }
          }
          
          // 해쉬태그 이름 저장
          hashtag1.value += "#" + hashtag;
        }
        console.log(document.getElementsByName('hashtag').value);

        // 해쉬태그 ui 화면에 만들기
        var hash_str = '<a id="hashtag_a" onClick="delete_hashtag(this);" class="btn btn-primary" style=margin-left : 5px" name="' + hashtag + '">' + hashtag + '</a>\n';
        $("#m_hashtag").append(hash_str);
      }



      // form validation에서 걸렸을 때 해쉬태그 복구
      function make_hashtag_set_val(hashtag_val) {
        // 해쉬태그 문자열 쪼개기
        var arr = hashtag_val.split('#');
        var hash_val_str = '';
        for (var a = 0; a < arr.length; a++) {
          hash_val_str += '<a id="hashtag_a" onClick="delete_hashtag(this);" class="btn btn-primary" style=margin-left : 5px" name="' + arr[a] + '">' + arr[a] + '</a>\n';
        }

        $("#m_hashtag").append(hash_val_str);
      }


      // 블로그 첫화면일 때 해쉬태그 복구
      function make_hashtag_first(hashtag_val) {
        // 해쉬태그 문자열 쪼개기
        var arr = hashtag_val.split('#');
        var hash_val_str = '';
        for (var a = 0; a < arr.length; a++) {
          hash_val_str += '<a id="hashtag_a" onClick="delete_hashtag(this);" class="btn btn-primary" style=margin-left : 5px" name="' + arr[a] + '">' + arr[a] + '</a>\n';
        }

        document.getElementsByName('hashtag').value = hashtag_val;
        $("#m_hashtag").append(hash_val_str);
      }




      function delete_hashtag(me) {
        me.remove();

        // 해쉬태그 네임도 제거
        var arr = document.getElementsByName('hashtag').value.split('#');
        var len = arr.length;
        for (var a = 0; a < len; a++) {
          if (arr[a] == me.name) {
            arr.splice(a, 1);
          }
        }
        console.log(arr);
        var str = '';
        for (var i = 0; i < arr.length; i++) {
          if (i == 0) {
            str += arr[i];
          }
          else {
            str += "#" + arr[i];
          }
        }
        
        document.getElementsByName('hashtag').value = str;
      }



    </script>