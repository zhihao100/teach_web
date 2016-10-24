<?php
/*
 * 教师登录检测
 * 
 * */
function checkTeacherLogined(){
    if(@$_SESSION['userName'] == '' || @$_SESSION['userId'] == ''){
        alertMes("../login.html", "请先登录!");
    }
}
/*
 * 教师退出登录
 * 
 * */
function logoutTeacher(){
    $_SESSION['userId'] = '';
    $_SESSION['userName'] = '';
    alertMes('../default.php', '退出成功');
}


/*
 * 教师登录信息检测
 * 
 * */
function checkTeacherLogin($arr){
    if (isset($arr['username']) && isset($arr['password'])){
        return true;
    }else{
        alertMes("../login.html", "请输入账号或密码");
        exit;
    }
}
/*
 * 检测注册信息
 * */
function checkTeacher($arr){
   if (!isset($arr['username'])){
       alertMes("addTeacher.php", "请输入工号!");
   }elseif (!isset($arr['pwd1'])){
       alertMes("addTeacher.php", "请输入密码!");
   }elseif (!isset($arr['name'])){
       alertMes("addTeacher.php", "请输入姓名!");
   }elseif (!isset($arr['email'])){
       alertMes("addTeacher.php", "请输入邮箱!");
   }elseif (!isset($arr['department'])){
       alertMes("addTeacher.php", "请输入院系!");
   }else{
       return true;
   }
}
/*
 *添加教师信息 
 **/
function addTeacher(){
    $arr = @$_POST;
    if(checkTeacher($arr)){
        $link = connect();
        $pwd = md5($arr['pwd1']);
        $face = mt_rand(1, 20).'.jpg';
        $iden = 2;
        $joinTime = date("Y-m-d H:i:s");
        $sql = "insert into user (username,pwd,name,email,class_short,face,identified,jointime) values ('{$arr['username']}','{$pwd}','{$arr['name']}','{$arr['email']}','{$arr['department']}','{$face}',{$iden},'{$joinTime}')";
        if(insert($link, $sql)){
            alertMes("listTeacher.php", "添加成功!");
        }else{
            alertMes("addTeacher.php", "该账户已存在,请重新添加!");
        }
    }
}
/*
 * 删除教师信息
 * 
 * */
function deleteTeacher($id){
$link = connect();
    $sql = "delete from user where id={$id}";
    if(delete($link, $sql)){
        $sql = "delete from forumcontent where userId={$id}";
        if(!delete($link, $sql)){
            alertMes("listContent.php", "用户ID为{$id}的用户帖子没有删除成功,请手动删除!");
        }
        $sql = "delete from forumreply where replyuserId={$id}";
        if(!delete($link, $sql)){
            alertMes("listContent.php", "用户ID为{$id}的用户的回复内容没有删除成功,请手动删除!");
        }
        alertMes("listStudent.php", "删除成功!");
    }else{
        alertMes("listStudent.php", "删除失败,请重新删除!");
    }
}












