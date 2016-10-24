 <?php 
include_once '../include.php';
 $link=connect();
checkLogined();
$sql = "select * from user where identified=2";
 $sql_class="select * from class";
$result = mysqli_query($link, $sql);
 $result_class = mysqli_query($link, $sql_class);
 $class_amount=getNumRows($link, $sql_class);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加课程信息</title>
<link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;添加课程</h3></div>
<div class="wrap">
<form action="doActionAdmin.php?act=addCourse" method="post">
	<table  cellpadding="0px"  cellspacing="0px" >
    	<tr>
    		<td>课程名:<input type="text" placeholder="请输入课程名称" name="coursename" id="c_name"/></td>
        </tr>
        <tr>
    		<td>任课教师:<label><select name="user_id" id="select1"><option value="0">--请选择任课老师--</option><?php while ($data_user = mysqli_fetch_assoc($result)){?><option value="<?php echo $data_user['id'];?>"><?php echo $data_user['name'];?></option><?php }?></select></label></td>
        </tr>
		<tr>
			<td>所教班级:<div class='wrap_class'><label id="classname">
					<?php
					for($i=0;$i<$class_amount;$i++){
						$class_data=mysqli_fetch_assoc($result_class);
                    echo   "<div class='class_group'><span>".$class_data['class_short']."</span><input type='checkbox' name='check[]' value='".$class_data['id']."'/></div>";
					}
					?>
				</label></div></td>
		</tr>
		<tr>
			<td>课程简介:<div class="small_state"><label><textarea rows="4" cols="47" name="smallstate"></textarea></label></div></td>
		</tr>
    </table>
    <div class="bnt"><input type="submit" value="添加" onclick="return checkInfo()"/></div>
</form>
</div>
<script type="text/javascript">
	function checkInfo() {
		var coursename = document.getElementById('c_name');
		var select1 = document.getElementById('select1');

		if (coursename.value == '') {
			alert('请输入课程名称!');
			return false;
		} else if (select1.value == 0) {
			alert('请选择任课老师!');
			return false;
		} else {
			return true;
		}
	}
</script>
</body>
</html>
