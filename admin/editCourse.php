<?php 
include_once '../include.php';
checkLogined();
$id = $_REQUEST['id'];
$sql = "select * from course where id={$id}";
$data_course = fecthOne($link, $sql);
$sql = "select * from user where identified=2";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改课程信息</title>
<link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;修改课程</h3></div>
<div class="wrap">
<form action="doActionAdmin.php?act=editCourse&id=<?php echo $data_course['id'];?>" method="post">
	<table border="0px" cellpadding="0px" width="100%" cellspacing="0px">
    	<tr>
    		<td class="td1">课程名:</td><td class="td2"><input type="text" value="<?php echo $data_course['c_name']?>" name="coursename" id="coursename"/></td>
        </tr>
        <tr>
        	<td class="td1">任课教师:</td><td class="td2"><select name="user_id" id="select1" style="width: 270px; height:40px; padding:5px; border:none; border-radius:2px;text-align:center;"><option value="0">--请选择任课老师--</option><?php while ($data_user = mysqli_fetch_assoc($result)){?><option value="<?php echo $data_user['id'];?>"><?php echo $data_user['name'];?></option><?php }?></select></td>
        </tr>
    </table>
    <div class="bnt"><input type="submit" value="修改" onclick="return checkInfo()" /></div>
</form>
</div>
<script type="text/javascript">
	function checkInfo(){
		var coursename = document.getElementById('coursename');
		var select1 = document.getElementById('select1');

		if (coursename.value == ''){
			alert('请输入课程名称!');
			return false;
		}else if(select1.value == 0){
			alert('请选择任课教师!');
			return false;
		}
		return true;
	}
</script>
</body>
</html>