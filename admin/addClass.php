<?php
include_once '../include.php';
checkLogined();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加班级</title>
    <link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;添加班级</h3></div>
<div class="wrap">
    <form action="doActionAdmin.php?act=addClass" method="post">
        <table  cellpadding="0px"  cellspacing="0px">
            <tr>
                <td>学校:<input type="text"  name="school" id="school" value="湖北工业大学"/></td>
            </tr>
            <tr>
                <td class="td1">院系:<input type="text" placeholder="请输入院系" name="department" id="department" /></td>
            </tr>
            <tr>
                <td>专业:<input type="text" placeholder="请输入专业(全称)" name="major" id="major" /></td>
            </tr>
            <tr>
                <td class="td1">年级:<input type="number" placeholder="请输入年级(数字)" name="grade" id="grade" /></td>
            </tr>
            <tr>
                <td>班级序号:<input type="number"  placeholder="请输入班级序号(数字)" name="class_num" id="class_num" /></td>
            </tr>
            <tr>
                <td class="td1">班级简称:<input type="text"  placeholder="请输入班级简称，例如13电科1" name="class_short" id="class_short" /></td>
            </tr>
        </table>
        <div class="bnt"><input type="submit" value="添加" onclick=" return checkInfo()" /></div>
    </form>
</div>
<script type="text/javascript">
    function checkInfo(){
        var school = document.getElementById('school');
        var department = document.getElementById('department');
        var major = document.getElementById('major');
        var class_num = document.getElementById('class_num');
        var grade = document.getElementById('grade');
        var class_short = document.getElementById('class_short');
        if (school.value==''){
            alert('请输入学校!');
            return false;
        }else if (department.value==''){
            alert('请输入院系!');
            return false;
        }else if( major.value==''){
            alert('请输入专业!');
            return false;
        }else if (class_num.value==''){
            alert('请输入班级序号');
            return false;
        }else if (grade.value==''){
            alert('请输入年级!');
            return false;
        }else if (class_short.value==''){
            alert('请输入年级!');
            return false;
        }else{
            return true;
        }
    }
</script>
</body>
</html>