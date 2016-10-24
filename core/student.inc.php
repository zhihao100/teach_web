<?php
/*
 * 检测注册信息
 * */
function checkStudent($arr){
    if (!isset($arr['username'])){
        alertMes("addStudent.php", "请输入学号!");
    }elseif (!isset($arr['pwd1'])){
        alertMes("addStudent.php", "请输入密码!");
    }elseif (!isset($arr['name'])){
        alertMes("addStudent.php", "请输入姓名!");
    }elseif (!isset($arr['email'])){
        alertMes("addStudent.php", "请输入邮箱!");
    }elseif (!isset($arr['class_short'])){
        alertMes("addStudent.php", "请输入班级简称!");
    }else{
        return true;
    }
}
/*
 *添加学生信息
 **/
function addStudent(){
    $arr = @$_POST;
    if(checkStudent($arr)){
        $link = connect();
        $pwd = md5($arr['pwd1']);
        $face = mt_rand(1, 20).'.jpg';
        $iden = 1;
        $joinTime = date("Y-m-d H:i:s");
        $sql = "insert into user (username,pwd,name,email,class_short,face,identified,jointime) values ('{$arr['username']}','{$pwd}','{$arr['name']}','{$arr['email']}','{$arr['class_short']}','{$face}',{$iden},'{$joinTime}')";
        if(insert($link, $sql)){
            alertMes("listStudent.php", "添加成功!");
        }else{
            alertMes("addStudent.php", "该账户已存在,请重新添加!");
        }
    }
}
/*
 *删除学生信息
 *
 * */
function deleteStudent($id){
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
function deleteClass($id){
    $link = connect();
    $sql = "delete from class where id={$id}";
    if(delete($link, $sql)){
        alertMes("listClass.php", "删除成功!");
    }else{
        alertMes("listClass.php", "删除失败,请重新删除!");
    }
}