
<style>
  #all {
    font-family : 'Nanum Gothic';
  }
</style>
<section class="site-section pt-5"> 
      <div class="container">
        <form action="/~sale24/prj/user/edit" method="post" enctype="multipart/form-data" name="editForm">
          <div class="row mb-4">
            <div class="col" style="text-align: center;" >
              <div id="all" style="display: inline-block;">
                <br>
                <h4>개인정보 수정</h4>
                <br><br><br><br>

                <div class="mypage_image_box" style="display: inline-block; border : solid #efefef; border-width : 1px 1px 1px 1px">
                  <img src="/~sale24/prj/my/img/user/<?=$data['user']->image?>" alt="Image Placeholder" id="mypage_image" />
                </div>
                <br><br>
                <div class="filebox" style="text-align : left;">
                  <label for="file" style="margin-left : -2px; margin-right : 8px">파일찾기</label> 
                  <input type="file" id="file" name="upload_file">  
                  <input class="upload-name" name="upload-name" value="<?=$data['user']->image?>" placeholder="첨부파일" style="width : 76%"readonly>
                  <input type="hidden" name="upload_file_name" value="">
                </div>
                <br><br><br><br>

                <div style="text-align : left;">
                  이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" id="mypage_input_text" value="<?=$data['user']->name?>" placeholder="이름을 입력하세요"  />
                  <?php echo validation_errors(); ?>
                  <br><br>
                  짧은 소개&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="mini_content" id="mypage_input_textarea" placeholder="짧은 소개" rows="10" cols="50"><?=$data['user']->mini_content?></textarea>
                  <br><br>
                  긴 소개&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="content" id="mypage_input_textarea" placeholder="긴 소개" rows="10" cols="50"><?=$data['user']->content?></textarea>
                </div>

                <br>

                <div style="text-align : left; margin-top : 20px">
                    댓글 알림 수신 여부&nbsp;&nbsp;&nbsp;
                  <?php
                    if($data['user']->getNotice == 0) {
                  ?>
                      <label class="switch">
                        <input type="checkbox" id="notice" checked>
                        <span class="slider round"></span>
                      </label>
                  <?php
                    }
                    else { // 이메일 알림 수신 거부의 경우
                  ?>
                      <label class="switch">
                        <input type="checkbox" id="notice">
                        <span class="slider round"></span>
                      </label>
                  <?php
                    }
                  ?>
                  <input type="hidden" name="getNotice" value="<?=$data['user']->getNotice?>">
                </div>


                <br>

                
          
              </div>
            </div>
          </div>
          <br>
          <div class="row mb-4" style="text-align : center;">
            <div class="col">
              <input type="button" onclick="submitForm();" value="저장" style="text-align : center;" id="submitBtn"/>
            </div>
          </div>
        </form>
      </div>
    </section>

    <script>

      $(document).ready(function() {
        
        // 이름 끝으로 focus
        var len = $('input[name=name]').val().length;
        $('input[name=name]').focus();
        $('input[name=name]')[0].setSelectionRange(len, len);
      });



      $("#file").on('change',function(){
        var file_val = $("#file").val();
        var file_arr = file_val.split('\\');
        var file_name = file_arr[file_arr.length - 1];

        $(".upload-name").val(file_name);
        document.getElementsByName('upload_file_name').value = file_name;
        
      });  


      // submit하기
      function submitForm() {
        
        var form = document.editForm;
        
        if (form.upload_file_name.value != null) {
          form.upload_file_name.value = document.getElementsByName('upload_file_name').value;
        }

        if ($('#notice').prop("checked")) {
          form.getNotice.value = 0;
        }
        else {
          form.getNotice.value = 1;
        }
        

        form.submit();
      }

      // enter키 submit방지
      $('input[type="text"]').keydown(function() {
          if (event.keyCode === 13) {
              event.preventDefault();
          }
      });
    </script>