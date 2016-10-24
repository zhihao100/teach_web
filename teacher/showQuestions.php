<?php
require_once '../include.php';
$link=connect();
@$showtype=$_COOKIE['showtype'];
@$course_id=$_COOKIE["course_id"];
@$chapter_id=$_COOKIE["chapter"];

@$pageall=$_GET['pageall'];
@$page=$_GET['page'];
$num=5;
if($page==null){
   @$offset = 0;
}else {
    @$offset = ($page - 1) * $num;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>题库录入-显示</title>
    <link rel="stylesheet" type="text/css" href="CSS/bank-show.css" />
    <link href="CSS/bank_modify.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        function ChangeSelect(obj) {
            var n = obj.selectedIndex; //获取第一个列表中选中的项的序列
            var val = obj.options[n].value;  //获取第一个列表中选择的项的值
            var request = new XMLHttpRequest();//获取数据库中章节
            request.open("GET", "doTeacherAction.php?course_id=" + val + "&act=" + "getChapternum");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        document.getElementById("chapter1").innerHTML = request.responseText;
                    }
                }
            }
        }
        </script>
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;题库录入-显示</h3></div>
<!-- main-wrap start -->
<div class="main-wrap">
    <div class="select">
        <label><select onchange="ChangeSelect(this)" name="course" id="course1">
            <option selected="selected" disabled="disabled">--请选择课程--</option>
            <?php
            $id=$_SESSION['userId'];
            $query="select * from course WHERE user_id=$id";
            $result= mysqli_query($link,$query)or die("失败╮(╯﹏╰）╭".mysql_error());
            while($arry=mysqli_fetch_assoc($result)){
                if($course_id!=$arry['id']) {
                    echo "<option value={$arry['id']}>{$arry['c_name']}</option>";
                }else{
                    echo "<option value={$arry['id']} selected='selected'>{$arry['c_name']}</option>";
                }
            }
            ?>
        </select></label>
        <label><select name="chapter" id="chapter1" >
            <option selected="selected" disabled="disabled">--请选择章节--</option>
            <?php
           if(@$course_id!=null){
               $query="select * from chapter WHERE c_id=$course_id";
               $result= mysqli_query($link,$query)or die("失败╮(╯﹏╰）╭".mysql_error());
               $i=1;
               while($arry=mysqli_fetch_assoc($result)){
                   if($chapter_id!=$arry['id']) {
                       echo "<option value={$arry['id']}>第{$i}章 {$arry['ch_name']}</option>";
                   }else{
                       echo "<option value={$arry['id']} selected='selected'>第{$i} 章{$arry['ch_name']}</option>";
                   }
                   $i++;
               }
           }
            ?>

        </select></label>
        <label><select  name="type" id="type">
            <option selected="selected" disabled="disabled">--请选择题型--</option>
            <?php
       if(@$showtype==1){
           echo  "<option value=1 selected='selected'>选择题</option>";
       }else{
           echo "<option value=1 >选择题</option>";
   }
            if(@$showtype==2){
                echo  "<option value=2 selected='selected'>填空题</option>";
            }else{
                echo "<option value=2 >填空题</option>";
            }
            if(@$showtype==3){
                echo  "<option value=3 selected='selected'>简答题</option>";
            }else{
                echo "<option value=3 >简答题</option>";
            }
            ?>
        </select></label>
    </div>
    <div class="info">
        <table  cellpadding="0px" cellspacing="0px" width="100%" id="table" >
            <?php
            switch($showtype){
                case 1:
                    $result =mysqli_query($link,"SELECT * FROM choice_bank WHERE course_id=$course_id and ch_id=$chapter_id limit $offset,$num");
                    echo "<th>类型</th><th>题目</th><th>录入时间</th><th>操作</th>";
                    while(@$arry=mysqli_fetch_assoc($result)) {
                        echo " <tr class='type1'><td>选择题</td>
                <td>{$arry['title']}</td>
                <td>{$arry['t_time']}</td>
                <td><span class='edit'><button class='modify' value='{$arry['id']}'>修改</button></span><span class='delete'><button class='del' value='{$arry['id']}'>删除</button></span></td>
            </tr>";
                    }
                    break;
                        case 2:
            $result =mysqli_query($link,"SELECT * FROM gap_bank WHERE course_id=$course_id and ch_id=$chapter_id limit $offset,$num");
            echo "<th>类型</th><th>题目</th><th>录入时间</th><th>操作</th>";
            while(@$arry=mysqli_fetch_assoc($result)) {
                echo " <tr class='type2'><td>填空题</td>
                <td>{$arry['gap_title']}</td>
                <td>{$arry['t_time']}</td>
                <td><span class='edit'><button class='modify' value='{$arry['id']}'>修改</button></span><span class='delete'><button class='del' value='{$arry['id']}'>删除</button></span></td>
            </tr>";
            }
                        break;
            case 3:
            $result =mysqli_query($link,"SELECT * FROM short_bank WHERE course_id=$course_id and ch_id=$chapter_id limit $offset,$num");
            echo "<th>类型</th><th>题目</th><th>录入时间</th><th>操作</th>";
            while(@$arry=mysqli_fetch_assoc($result)) {
                echo " <tr class='type3'><td>简答题</td>
                <td>{$arry['short_title']}</td>
                <td>{$arry['t_time']}</td>
                <td><span class='edit'><button class='modify' value='{$arry['id']}'>修改</button></span><span class='delete'><button class='del' value='{$arry['id']}'>删除</button></span></td>
            </tr>";
            }
                break;
            }
            ?>
        </table>
    </div>
    <div class="page">
        <ul>
            <?php    $pageSize = 5;
            @$pageArr = page($_COOKIE['pageall'], $pageSize);
            echo $pageArr['html'];?>
        </ul>
    </div>
</div>
<!-- main-wrap end -->
<div class="popup display_none"></div><!--透明层-->
<form action="doTeacherAction.php" enctype="multipart/form-data" method="post" id="myform1">
    <input type="hidden" name="Question_id1">
    <input type="hidden" name="type" value=1>
    <input type="hidden" name="act" value="editQuestion">
    <div id="content" class="display_none content_modify"><!--选择题内容-->
        <div class="title_hs"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;试题修改</p></div>
        <div class="close_modify"></div>
        <div class="modify_wrap">
            <div id="title" class="choice_modify_box"><span>题目:</span><label><input name="title" type="text" class="text_box" id="modify_title0"></label>
                <div class="pic_box"><label><input type="text" size="10" name="upfile0" id="upfile0" class="up_pic1"></label>
                    <input name="filename" id="file" type="button" value="选择图片" onclick="path0.click()" class="up_pic2">
                    <input id="path0" type="file" name="file0" style="display:none" onchange="upfile0.value=this.value">
                </div>
            </div>

            <div id="A" class="choice_modify_box"><span>A  ：</span><label><input name="A" class="text_box" type="text"/></label>
                <div class="pic_box"><label><input type="text" size="10" name="upfile1" id="upfile1" class="up_pic1"></label>
                    <input name="filename" id="file" type="button" value="选择图片" onclick="path1.click()" class="up_pic2">
                    <input id="path1" type="file" name="file1" style="display:none" onchange="upfile1.value=this.value">
                </div>
            </div>

            <div id="B" class="choice_modify_box"><span>B  ：</span><label><input name="B" class="text_box" type="text"/></label>
                <div class="pic_box"><label><input type="text" size="10" name="upfile2" id="upfile2" class="up_pic1"></label>
                    <input name="filename" id="file" type="button" value="选择图片" onclick="path2.click()" class="up_pic2">
                    <input id="path2" type="file" name="file2" style="display:none" onchange="upfile2.value=this.value">
                </div>
            </div>

            <div id="C" class="choice_modify_box"><span>C  ：</span><label><input name="C" class="text_box" type="text"/></label>
                <div class="pic_box"><label><input type="text" size="10" name="upfile3" id="upfile3" class="up_pic1"></label>
                    <input name="filename" id="file" type="button" value="选择图片" onclick="path3.click()" class="up_pic2">
                    <input id="path3" type="file" name="file3" style="display:none" onchange="upfile3.value=this.value">
                </div>
            </div>

            <div id="D" class="choice_modify_box"><span>D  ：</span><label><input name="D" class="text_box" type="text"/></label>
                <div class="pic_box"><label><input type="text" size="10" name="upfile4" id="upfile4" class="up_pic1"></label>
                    <input name="filename" id="file" type="button" value="选择图片" onclick="path4.click()" class="up_pic2">
                    <input id="path4" type="file" name="file4" style="display:none" onchange="upfile4.value=this.value">
                </div>
            </div>
            <div class="modify_answer">
                <div id="T"><span>T  ：</span><label><input name="T" type="text" class="modify_t" id="modify_answer0"></label></div>
                <input type="hidden" name="Question_id1">
                <input type="hidden" name="type" value=1>
                <input type="hidden" name="act" value="editQuestion">
                <div>
                    <label><input type="submit" value="提交" id="submit" class="btn"></label>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="doTeacherAction.php" enctype="multipart/form-data" method="post" id="myform2">
    <input type="hidden" name="Question_id2">
    <input type="hidden" name="type" value=2>
    <input type="hidden" name="act" value="editQuestion">
    <div id="content1" class="display_none content_modify"><!--填空题内容-->
        <div class="title_hs"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;试题修改</p></div>
        <div class="close_modify"></div>
        <div class="modify_wrap">
        <div id="title1" class="area_modify_box"><span>题目：</span><label><textarea  name="title1" rows="6" cols="60" id="modify_title1"></textarea></label>
            <div class="area_pic_box"><label><input type="text" size="10" name="upfile5" id="upfile5" class="up_pic3"></label>
                <input name="filename" id="file" type="button" value="选择图片" onclick="path5.click()" class="up_pic4">
                <input id="path5" type="file" name="file5" style="display:none" onchange="upfile5.value=this.value">
            </div>
            <div class="blank_btn">
                <input name="fill_blank" id="fill_blank" type="button" value="添加空格"  class="add_blank">
            </div>
        </div>
            <hr style="width: 100% ;">
        <div id="answer1" class="area_modify_box"><span>答案：</span><label><textarea  name="answer1" rows="6" cols="60" id="modify_answer1"></textarea></label>
            <div class="area_pic_box"><label><input type="text" size="10" name="upfile6" id="upfile6" class="up_pic3"></label>
                <input name="filename" id="file" type="button" value="选择图片" onclick="path6.click()" class="up_pic4">
                <input id="path6" type="file" name="file6" style="display:none" onchange="upfile6.value=this.value">
            </div>
            <div class="blank_btn">
                <input name="fill_answer" id="fill_answer" type="button" value="添加空格"  class="add_blank">
            </div>
        </div>
        <div class="modify_answer">
            <label><input type="submit" value="提交" id="submit" class="btn"></label>
        </div>
    </div>
    </div>
</form>
<form action="doTeacherAction.php" enctype="multipart/form-data" method="post" id="myform3">
    <input type="hidden" name="Question_id3">
    <input type="hidden" name="type" value=3>
    <input type="hidden" name="act" value="editQuestion">
    <div id="content2" class="display_none content_modify"><!--简答题内容-->
        <div class="title_hs"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;试题修改</p></div>
        <div  class="close_modify"></div>
        <div class="modify_wrap">
        <div  id="title2" class="area_modify_box"><span>题目：</span><label><textarea  name="title2" rows="6" cols="60" id="modify_title2"></textarea></label>
            <div class="area_pic_box"><label><input  type="text" size="10" name="upfile7" id="upfile7" class="up_pic3"></label>
                <input   name="filename" id="file" type="button" value="选择图片" onclick="path7.click()" class="up_pic4">
                <input id="path7"   type="file" name="file7" style="display:none" onchange="upfile7.value=this.value">
            </div>
        </div>
            <hr style="width: 100% ;color:#ffffff">
        <div id="answer2" class="area_modify_box"><span>答案：</span><label><textarea  name="answer2" rows="6" cols="60" id="modify_answer2"></textarea></label>
            <div class="area_pic_box"><label><input  type="text" size="10" name="upfile8" id="upfile8" class="up_pic3"></label>
                <input   name="filename" id="file" type="button" value="选择图片" onclick="path8.click()" class="up_pic4">
                <input id="path8"   type="file" name="file8" style="display:none" onchange="upfile8.value=this.value">
            </div>
        </div>
        <div class="modify_answer">
            <label><input type="submit" value="提交" id="submit" class="btn"></label>
        </div>
    </div>
    </div>
</form>
<script type="text/javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="JS/Question.js"></script>
</body>
</html>