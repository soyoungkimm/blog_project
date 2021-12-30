
<style>
  #all {
    font-family : 'Nanum Gothic';
  }

  #category_txt {
    font-size : 17px; 
    font-family : 'Nanum Gothic'; 
    width : 400px; 
    height : 35px; 
    border : none; 
    outline : none;
    color : #6e6e6e;
    background : #f7f7f7;
    padding : 15px;
  }

  #category_txt_detail {
    font-size : 17px; 
    font-family : 'Nanum Gothic'; 
    width : 370px; 
    height : 35px; 
    border : none; 
    outline : none;
    color : #6e6e6e;
    background : #f7f7f7;
    padding : 15px;
  }

  #plus{
    border-radius: 5px; 
    border : none;
    width : 50px; 
    height : 35px; 
    display : absolute; 
    float : right; 
    background-color : #b486ff;
  }

  #remove {
    border-radius: 5px; 
    border : none;
    width : 50px; 
    height : 35px; 
    background-color : #ffc9c9;
    float : left; 
  }

  #edit {
    border-radius: 5px; 
    border : none;
    width : 50px; 
    height : 35px; 
    background-color : #a8d0ff;
    float : left; 
  }

  #ok {
    border-radius: 5px; 
    border : none;
    width : 50px; 
    height : 35px; 
    background-color :#a1d596;
    float : left; 
  }


</style>
<section class="site-section pt-5">
      <div class="container">
        
          <div class="row mb-4">
            <div class="col" style="text-align: center;" >
              <div id="all" style="display: inline-block;">

              <h3 class="heading">Category 수정</h3>
              <br>
              <input type="button" id="plus" onclick="addCategory();" value="추가"/>
              <br><br>
              <table id="tablednd" cellspacing="0" cellpadding="2" style="text-align : left;">
              <?php
                if (isset($data['categorys'])) {
                  foreach ($data['categorys'] as $category) {
              ?>
                    <tr id="catr<?=$category->id?>">
                    <td><input id="plus" type="button" onclick="addCategoryDetail(this, <?=$category->id?>)" value="추가"/></td>
                    <td><input id="edit" type="button" onclick="updateCategory(<?=$category->id?>, 'ca<?=$category->id?>')" value="수정"/></td>
                    <td><input id="remove" type="button" onclick="deleteCategory(<?=$category->id?>)" value="삭제"/></td>
                    <td><input type="text" name="ca<?=$category->id?>" id="category_txt" value="<?=$category->name?>" readonly></td>
                    </tr>
                    
              <?php
                    if (isset($data['category_details'])) {
                      foreach($data['category_details'] as $category_detail) {
                        if ($category->id == $category_detail->category_id) {
              ?>
                          <tr id="detr<?=$category_detail->id?>">
                          <td></td>
                          <td><input id="edit" type="button" onclick="updateCategoryDetail(<?=$category_detail->id?>, 'de<?=$category_detail->id?>')" value="수정"/></td>
                          <td><input id="remove" type="button" onclick="deleteCategoryDetail(<?=$category_detail->id?>);" value="삭제"/></td>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="de<?=$category_detail->id?>" id="category_txt_detail" value="<?=$category_detail->name?>" readonly></td>
                          </tr>
              <?php
                        }
                      }
                    }
                  }
                }  
              ?>
              </table>
               
              
          
              </div>
            </div>
          </div>
        
      </div>
    </section>
    
    
    
    <script>
      
      function isExecuteOther() {
        var category_node = $(".hhhh");

        // 다른 수정이 실행 중 일때
        if (category_node.length != 0) {
          return true;
        }
        // 아닐 때
        return false;
      } 

      function updateCategoryDetail(category_detail_id, text_name) {
        
        // 현재 다른 수정을 실행 중인지 체크
        if (isExecuteOther()) {
          alert('카테고리 수정중에는 실행할 수 없습니다.');
          return;
        }

        var name = $("input[name=" + text_name + "]").val();
        
        var str ='<td></td>\n' + 
                  '<td></td>\n' + 
                  '<td><input id="ok" type="button" onclick="pressEditCategoryDetail(' + category_detail_id + ');" value="확인"/></td>\n' + 
                  '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="hhhh" id="category_txt_detail" value="' + name + '"></td>\n';


        $("#detr"+category_detail_id).empty();
        $("#detr"+category_detail_id).html(str);
      }


      function pressEditCategoryDetail(category_detail_id) {
        
        var category_detail_name = $(".hhhh").val();

        if (category_detail_name == '') {
          alert('카테고리명은 최소 1자 이상 입력해야합니다.');
          return;
        }

        $.ajax({
            url: "/~sale24/prj/category/ajax_category_detail_edit",
            type: "POST",
            data: {
              name: category_detail_name,
              category_detail_id : category_detail_id
            },
            datatype: "json",
            success : function(data) {

              execute_ajax(data);

            },
            error: function(request,status,error){ // 실패
              alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
              console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
            }
          });
      }


      function updateCategory(category_id, text_name) {

        // 현재 다른 수정을 실행 중인지 체크
        if (isExecuteOther()) {
          alert('카테고리 수정중에는 실행할 수 없습니다.');
          return;
        }

        var name = $("input[name=" + text_name + "]").val();
        
        var str ='<td></td>\n' + 
                  '<td></td>\n' + 
                  '<td><input id="ok" type="button" onclick="pressEditCategory(' + category_id + ');" value="확인"/></td>\n' + 
                  '<td><input type="text" class="hhhh" id="category_txt" value="' + name + '"></td>\n';


        $("#catr"+category_id).empty();
        $("#catr"+category_id).html(str);
      }

      function pressEditCategory(category_id) {

        var category_name = $(".hhhh").val();

        if (category_name == '') {
          alert('카테고리명은 최소 1자 이상 입력해야합니다.');
          return;
        }

        $.ajax({
            url: "/~sale24/prj/category/ajax_category_edit",
            type: "POST",
            data: {
              name: category_name,
              category_id : category_id
            },
            datatype: "json",
            success : function(data) {

              execute_ajax(data);
              
            },
            error: function(request,status,error){ // 실패
              alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
              console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
            }
          });

      }


      function addCategoryDetail(me, category_id) {

        // 현재 다른 수정을 실행 중인지 체크
        if (isExecuteOther()) {
          alert('카테고리 수정중에는 실행할 수 없습니다.');
          return;
        }

        var row = $(me).closest("tr");
        var str = '<tr>\n' + 
                  '<td></td>\n' + 
                  '<td></td>\n' + 
                  '<td><input id="ok" type="button" onclick="pressAddCategoryDetail(' + category_id + ');" value="확인"/></td>\n' + 
                  '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="hhhh" id="category_txt_detail" value=""></td>\n' + 
                '</tr>\n';
        $(str).insertAfter(row);
      }

      function pressAddCategoryDetail(category_id) {
        
        var category_name = $(".hhhh").val();

        if (category_name == '') {
          alert('카테고리명은 최소 1자 이상 입력해야합니다.');
          return;
        }
        
        $.ajax({
            url: "/~sale24/prj/category/ajax_category_detail_add",
            type: "POST",
            data: {
              name: category_name,
              category_id : category_id
            },
            datatype: "json",
            success : function(data) {

              execute_ajax(data);

            },
            error: function(request,status,error){ // 실패
              alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
              console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
            }
          });
      }


      function addCategory() {

        // 현재 다른 수정을 실행 중인지 체크
        if (isExecuteOther()) {
          alert('카테고리 수정중에는 실행할 수 없습니다.');
          return;
        }
       
        var str = '<tr>\n' + 
                  '<td></td>\n' + 
                  '<td></td>\n' + 
                  '<td><input id="ok" type="button" onclick="pressAdd();" value="확인"/></td>\n' + 
                  '<td><input type="text" class="hhhh" id="category_txt" value=""></td>\n' + 
                  
                '</tr>\n';

        $("#tablednd").append(str);
      }

      function pressAdd() {
        var category_name = $(".hhhh").val();

        if (category_name == '') {
          alert('카테고리명은 최소 1자 이상 입력해야합니다.');
          return;
        }
        
        $.ajax({
            url: "/~sale24/prj/category/ajax_category_add",
            type: "POST",
            data: {
              name: category_name
            },
            datatype: "json",
            success : function(data) {

              execute_ajax(data);
            },
            error: function(request,status,error){ // 실패
              alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
              console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
            }
          });
      }


      function deleteCategory(category_id) {

        // 현재 다른 수정을 실행 중인지 체크
        if (isExecuteOther()) {
          alert('카테고리 수정중에는 실행할 수 없습니다.');
          return;
        }

        var answer = confirm('정말로 삭제하시겠습니까? 세부 카테고리도 삭제됩니다.');

        if (answer) {

          $.ajax({
            url: "/~sale24/prj/category/ajax_category_delete",
            type: "POST",
            data: {
              category_id: category_id
            },
            datatype: "json",
            success : function(data) {

              execute_ajax(data);

            },
            error: function(request,status,error){ // 실패
              alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
              console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
            }
          });
        }

        
      }


      function deleteCategoryDetail(category_detail_id) {

        // 현재 다른 수정을 실행 중인지 체크
        if (isExecuteOther()) {
          alert('카테고리 수정중에는 실행할 수 없습니다.');
          return;
        }

        var answer = confirm('정말로 삭제하시겠습니까?');

        if (answer) {
          $.ajax({
            url: "/~sale24/prj/category/ajax_category_detail_delete",
            type: "POST",
            data: {
              category_detail_id: category_detail_id
            },
            datatype: "json",
            success : function(data) {

              execute_ajax(data);

            },
            error: function(request,status,error){ // 실패
              alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
              console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
            }
          });
        } 
      }



      function execute_ajax(data) {
          var str = '';
          
          if (data.categorys != null) {
            for (var i = 0; i < data.categorys.length; i++) {
        
                str += '<tr id="catr' + data.categorys[i].id + '">\n' + 
                        '<td><input id="plus" type="button" onclick="addCategoryDetail(this)" value="추가"/></td>\n' + 
                        '<td><input id="edit" type="button" onclick="updateCategory(' + data.categorys[i].id + ', \'ca' + data.categorys[i].id + '\')" value="수정"/></td>\n' + 
                        '<td><input id="remove" type="button" onclick="deleteCategory(' + data.categorys[i].id + ')" value="삭제"/></td>\n' +
                        '<td><input type="text" name="ca' + data.categorys[i].id + '" id="category_txt" value="' + data.categorys[i].name + '" readonly></td>\n' +
                      '</tr>\n';
              
        
              if (data.category_details != null) {
                for (var j = 0; j < data.category_details.length; j++) {
                  if (data.categorys[i].id == data.category_details[j].category_id) {
        
                str += '<tr id="detr' + data.category_details[j].id + '">\n' + 
                        '<td></td>\n' + 
                        '<td><input id="edit" type="button" onclick="updateCategoryDetail(' + data.category_details[j].id + ', \'de' + data.category_details[j].id + '\')" value="수정"/></td>\n' + 
                        '<td><input id="remove" type="button" onclick="deleteCategoryDetail(' +  data.category_details[j].id + ');" value="삭제"/></td>\n' + 
                        '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="de' +  data.category_details[j].id + '" id="category_txt_detail" value="' + data.category_details[j].name + '" readonly></td>\n' + 
                      '</tr>\n';
        
                  }
                }
              }
            }
          }  
            

          $("#tablednd").empty();
          $("#tablednd").html(str);
      }

    </script>
