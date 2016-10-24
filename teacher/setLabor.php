<?php 
include_once '../include.php';
$sql = "select * from lab where user_id={$_SESSION['userId']}";
$pageTotal = getNumRows($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发布实验</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
    <link rel="stylesheet" type="text/css" href="CSS/setLabor.css"/>
</head>
<body>
<div class="content-wrap">
    <div>
        <div id="title_h"><a><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;已布置实验</p></a></div>
        <div id="labor_set_button"><p>发布实验</p></div>
        <div id="labor">
            <table id="table_c" cellpadding="0px" cellspacing="0px">
                <tr>
                    <th class="num">实验编号</th>
                    <th class="content">实验名称</th>
                    <th  class="belong">所属课程</th>
                    <th class="operate">操作</th>
                </tr>
                <?php 
                $pageSize = 5;
                $pageArr = page_set_labor($pageTotal, $pageSize);
                $sql = "select * from lab where user_id={$_SESSION['userId']} limit {$pageArr['offset']},{$pageSize}";
                $result = mysqli_query($link, $sql);
                $i = 0;
                while($data_lab = mysqli_fetch_assoc($result)){
                    $j = $i + 1;
                    $sql = "select * from course where id={$data_lab['c_id']}";
                    $data_c = fecthOne($link, $sql);
                ?>
                <tr>
                    <td class="<?php echo $i%2 == 0?"num1":"num"?>"><?php echo $data_lab['lab_num'];?></td>
                    <td class="<?php echo $i%2 == 0?"content1":"content"?>"><?php echo $data_lab['lab_name'];?></td>
                    <td class="<?php echo $i%2 == 0?"belong1":"belong"?>"><?php echo $data_c['c_name'];?></td>
                    <td class="<?php echo $i%2 == 0?"operate1":"operate"?>"><a  class="modify">修改</a><a style="display: none;"><?php echo $data_lab['id'];?></a>&nbsp;/&nbsp;<a class="delete">删除</a><a style="display: none;"><?php echo $data_lab['id'];?></a></td>
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
    <div id="labor_set" class="display_none">
        <div id="title_hs"><a><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;实验布置</p></a></div><div class='action' style='display: none'></div><div class='lab_id' style='display: none'></div>
        <div id="close_icon"></div>
            <div id="option_list">
            <div id="course">
                <label><select class="op_list" id="c_id">
                    <option class="option_default" selected="selected" disabled="disabled">课程名称</option>
                        <?php
                        $id=$_SESSION['userId'];
                        $query="select * from course WHERE user_id=$id";
                        $result= mysqli_query($link,$query)or die("失败╮(╯﹏╰）╭".mysqli_error($link));
                        while($arry=mysqli_fetch_assoc($result)){
                            echo "<option value={$arry['id']}>{$arry['c_name']}</option>";
                        }
                        ?>
                </select></label>
            </div>
            <div id="lab_num">
                <label>实验编号：<input  class="lab_num" type="text" style="width: 80px" placeholder="请输入数字"></label>
            </div>
        </div>
        <input class="lab_id"  type="hidden" >
            <div id="lab_name">
                <label>实验名称：<input class="lab_name"  type="text" placeholder="请输入实验名称" style="width: 81%"></label>
            </div>
            <div id="lab_aim">
                <label><span id="lab_aim_pt">实验目标：</span><textarea class="lab_obj" placeholder="请输入目标" cols="67" rows="3"></textarea></label>
            </div>
            <div id="lab_content">
                <label><span id="lab_content_pt">实验内容：</span><textarea  class="lab_content" placeholder="请输入内容" cols="67" rows="7"></textarea></label>
            </div>
            <label><input type="submit" value="提交" id="submit"></label>
    </div>
</div>
<script type="" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#labor_set_button").bind("click", function () {
            $(".popup").fadeIn(800);
            $("#labor_set").fadeIn(800);
            $(".action").replaceWith("<div class='action' style='display: none'>addLab</div>");
        });
        $("#labor").on("click",".modify",function(){
            $(".popup").fadeIn(800);
            $("#labor_set").fadeIn(800);
            $(".action").replaceWith("<div class='action' style='display: none'>editLab</div>");
            var lab_id = $(this).next("a").text();
            $(".lab_id").replaceWith("<div class='lab_id' style='display: none'>" + lab_id + "</div>");
            lab_show(lab_id);
        });
    });
    $(function() {
        $("#labor").on("click",".delete",function(){
            var lab_id = $(this).next("a").text();
            if(confirm("确定要删除该实验吗？")){
            deleteLab(lab_id);
            $(this).parent().parent().remove();
            }
        });
        $("#close_icon").bind("click",function(){
            $(".popup").fadeOut(800);
            $("#labor_set").fadeOut(800);
        });
        $("#submit").bind("click",function(){
            var lab_id=$(".lab_id").val();
            var act = $(".action").text();
            var c_id = $(".op_list").val();
            var lab_num=$(".lab_num").val();
            var lab_obj=$(".lab_obj").val();
            var lab_content=$(".lab_content").val();
            var lab_name=$(".lab_name").val();
            if(act == 'addLab'){
                act_lab(act,c_id,lab_content,lab_name,lab_num,lab_obj,lab_id);
            }else if(act == 'editLab'){
                act_lab(act,c_id,lab_content,lab_name,lab_num,lab_obj,lab_id);
            }
        })
    });

    function lab_show(lab_id){
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "doTeacherAction.php",
            data: "lab_id=" + lab_id+"&act=labshow",
            success: function (data) {
                var array = JSON.parse(data);
                $(".op_list option[selected*='selected']").removeAttr("selected","selected");
                $(".op_list option[value='"+array["c_id"]+"']").attr("selected","selected");
                $(".op_list").attr("disabled","true");
                var $html;
                $(".lab_id").val(lab_id);
                $html = "<input class='lab_num' type='text' name='lab_num' style='width: 80px' value='" + array["lab_num"] + "'>";
                $("#lab_num").find("input").replaceWith($html);
                $html = "<input type='text' class='lab_name' name='lab_name' style='width: 81%' value='" + array["lab_name"] + "'>";
                $("#lab_name").find("input").replaceWith($html);
                $html = "<textarea name='lab_obj' class='lab_obj' cols='67' rows='3'>" + array["lab_obj"] + "</textarea>";
                $("#lab_aim").find("textarea").replaceWith($html);
                $html = "<textarea name='lab_content' class='lab_content' cols='67' rows='7'>" + array["lab_content"] + "</textarea>";
                $("#lab_content").find("textarea").replaceWith($html);
            }

        })
    }
    function act_lab(act,c_id,lab_content,lab_name,lab_num,lab_obj,lab_id){
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "doTeacherAction.php",
            data: "act="+ act + "&c_id=" + c_id+"&lab_name="+lab_name+"&lab_content="+lab_content+"&lab_obj="+lab_obj+"&lab_num="+lab_num+"&lab_id="+lab_id,
            success: function (data) {
                var array = JSON.parse(data);
              alert(array);
              window.location= "setLabor.php";
            }
        });
    }
function deleteLab(lab_id){
    $.ajax({
        datatype: "json",
        type: "GET",
        url: "doTeacherAction.php?act=deleteLab",
        data: "id=" + lab_id,
        success: function (data) {
            /*var array = JSON.parse(data);*/
        }
    });
}
</script>
</body>
</html>