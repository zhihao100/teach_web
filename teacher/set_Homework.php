<?php
include_once '../include.php';
$link=connect();
$sql = "select * from test where user_id={$_SESSION['userId']}";
$pageTotal = getNumRows($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发布作业</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
    <link href="CSS/set_Homework.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        //获取章节数
        function ChangeSelect(obj) {
            var n = obj.selectedIndex; //获取第一个列表中选中的项的序列
            var val = obj.options[n].value;  //获取第一个列表中选择的项的值
            var request = new XMLHttpRequest();//获取数据库中章节
            request.open("GET", "doTeacherAction.php?course_id="+val+"&act="+"getChapternum");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        document.getElementById("chapter1").innerHTML = request.responseText;
                    }
                }
            }
        }
        //动态显示题目
        function ChangeSelect2(obj) {
            var n = obj.selectedIndex; //获取第一个列表中选中的项的序列
            var val = obj.options[n].value;  //获取第一个列表中选择的项的值
            if(val==1) {
                var b=document.getElementsByClassName('type2');
                for(var e=0;e< b.length;e++) {
                    b[e].style.display = "none";
                }
                var c=document.getElementsByClassName('type1');
                for(var f=0;f< c.length;f++) {
                    c[f].style.display = "";
                }
                var a=document.getElementsByClassName('type3');
                for(var d=0;d< a.length;d++) {
                    a[d].style.display = "none";
                }
            }else{
                if(val==2) {
                    var m=document.getElementsByClassName('type2');
                    for(var j=0;j< m.length;j++) {
                        m[j].style.display = "";
                    }
                    var l=document.getElementsByClassName('type1');
                    for(var k=0;k< l.length;k++) {
                        l[k].style.display = "none";
                    }
                    var p=document.getElementsByClassName('type3');
                    for(var g=0;g< p.length;g++) {
                        p[g].style.display = "none";
                    }
                }else{
                    var q=document.getElementsByClassName('type2');
                    for(var x=0;x< q.length;x++) {
                        q[x].style.display = "none";
                    }
                    var r=document.getElementsByClassName('type1');
                    for(var y=0;y< r.length;y++) {
                        r[y].style.display = "none";
                    }
                    var s=document.getElementsByClassName('type3');
                    for(var z=0;z< s.length;z++) {
                     s[z].style.display = "";
                    }
                }
            }

        }
    </script>
</head>
<body>
<div class="content-wrap">
    <div>
        <div id="title_h"><a><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;已布置作业</p></a></div>
        <div id="homework_set_button"><p>发布作业</p></div>
        <div id="homework">
            <table id="table_c" cellpadding="0" cellspacing="0" style="overflow: auto">
                <tr>
                    <th class="num">作业编号</th>
                    <th class="content">作业名称</th>
                    <th class="belong">所属课程</th>
                    <th class="operate">操作</th>
                </tr>
                <?php
                $user_id=$_SESSION['userId'];
                $pageSize = 5;
                $pageArr = page_set_homework($pageTotal, $pageSize);
                $sql = "select test.id, test.test_title ,test.t_time,course.c_name from course, test where course.user_id={$user_id} and test.course_id=course.id limit {$pageArr['offset']},{$pageSize}";
                $result=mysqli_query($link,$sql);
                $i = 0;
                while($arry=@mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td class="<?php echo $i % 2 == 0 ? "num1" : "num" ?>"><?php echo $arry['id']; ?></td>
                        <td class="<?php echo $i % 2 == 0 ? "content1" : "content" ?>"><a class="content_enter" href="homework_detail_show.php?id=<?php echo $arry['id'];?>" target="_self"><?php echo $arry['test_title'];?></a></td>
                        <td class="<?php echo $i % 2 == 0 ? "belong1" : "belong" ?>"><?php echo $arry['c_name']; ?></td>
                        <td class="<?php echo $i % 2 == 0 ? "operate1" : "operate" ?>"><a class="delete">删除</a><a style="display: none;"><?php echo $arry['id']; ?></a></td>
                </tr>
                <?php $i++;}?>
            </table>
        </div>
    </div>
    <div class="page">
        <ul>
            <?php echo $pageArr['html'];?>
        </ul>
    </div>
    <div class="popup display_none"></div>
    <form method="post" action="doTeacherAction.php?act=addTest">
        <div id="homework_set" class="display_none">
            <div id="title_hs"><a><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作业布置</p></a></div>
            <div id="close_icon"></div>
            <div id="option_list">
                <div id="course">
                    <label><select class="op_list" onchange="ChangeSelect(this)" id="course1" name="course1">
                            <option class="option_default" selected="selected" disabled="disabled">课程名称</option>
                            <?php
                            $query="select id,c_name from course WHERE user_id={$user_id}";
                            $result= mysqli_query($link,$query);
                            while($arry=@mysqli_fetch_assoc($result)){
                                echo "<option value={$arry['id']}>{$arry['c_name']}</option>";
                            }
                            ?>
                        </select></label>
                </div>
                <div id="chapter">
                    <label><select class="op_list" id="chapter1" name="chapter1">
                            <option class="option_default" selected="selected" disabled="disabled">章节名称</option>
                        </select></label>
                </div>
                <div id="question_type">
                    <label><select class="op_list" onchange="ChangeSelect2(this)">
                            <option class="option_default" selected="selected" disabled="disabled" >题目类型</option>
                            <option value=1>选择题</option>
                            <option value=2>填空题</option>
                            <option value=3>简答题</option>
                        </select></label>
                </div>
            </div>
            <div id="subject" style="overflow:auto">
                <table id="table_s" cellpadding="0px" cellspacing="0px" class="table_s">
                    <tr>
                        <th class="num">题目类型</th>
                        <th class="content">题目内容</th>
                        <th class="operate">是否选择</th>
                    </tr>
                </table>
            </div>
            <div class="homework_submit">作业名称：<label><input type="text" name="Test_name" class="homework_name_input"></label> <input type="submit" value="提交" class="homework_btn"/><span>PS:请选择三种题型后再提交</span><span id="score">已选分值：0<span></span></span></div>
        </div>
    </form>
</div>
<script type="" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function(){
        var score=0;
        var len1=0;
        var len2=0;
        var len3=0;
      $("#chapter1").on("change",function(){
          var chapter_id= $("#chapter1").val();
          var course_id= $("#course1").val();
          $.ajax({
              datatype:"html",
              type:"post",
              url:"doTeacherAction.php",
              data:"course_id="+course_id+"&chapter_id="+chapter_id+"&act="+"getChQuestion",
                  success:function(data){
                      $("#table_s").append(data);
                      list_title();
                      $(".type1").on("change","input",function(){
                         len1= $(" .type1 input[type=checkbox]:checked").length;
                          score=len1*2+len2*4+len3*10;
                  $("#score").text("当前分数："+score);
                      });
                      $(".type2").on("change","input",function(){
                          len2= $(" .type2 input[type=checkbox]:checked").length;
                          score=len1*2+len2*4+len3*10;
                          $("#score").text("当前分数："+score);
                      });
                      $(".type3").on("change","input",function(){
                          len3= $(" .type3 input[type=checkbox]:checked").length;
                          score=len1*2+len2*4+len3*10;
                          $("#score").text("当前分数："+score);
                      })
          }
      })
      });


        $("#homework_set_button").bind("click",function(){
            $(".popup").fadeIn(800);
            $("#homework_set").fadeIn(800);
        });
        $("#close_icon").bind("click",function(){
            $(".popup").fadeOut(800);
            $("#homework_set").fadeOut(800);
        });
    });
    //发布作业时鼠标滑过显示具体题目
    function list_title(){
        $(".table_s tbody td a").hover(function(e) {
                var  x = 35,y = 15;
                var  title =this.text;
                var $html= "<div class='td-a'>" + title + "</div>";
                $("body").append($html);
                $(".td-a").css({
                    "top" : (e.pageY + y) + "px",
                    "left" : (e.pageX + x) + "px"
                }).show(2000);
            }, function() {
                $(".td-a").remove();
            });
    }
    $(function(){
        $("#homework").on("click",".delete",function(){
            var test_id = $(this).next("a").text();
       //   alert(test_id);
            if(confirm("确定要删除该份作业吗？")){
            deleteTest(test_id);
           $(this).parent().parent().remove();
            }
        });
        });
        
    function deleteTest(test_id){
       // alert(test_id);
        $.ajax({
            datatype: "json",
            type: "GET",
            url: "doTeacherAction.php?act=deleteTest",
            data: "id=" + test_id,
            success: function (data) {
               var array = JSON.parse(data);
               alert(array);
               window.loaction='set_Homework.php';
            }
        });
        $("input[type='checkbox']").on("click",function(){
          alert("");
        })
    }
</script>
</body>
</html>