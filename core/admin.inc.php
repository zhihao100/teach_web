<?php

/*
 * 检测管理员的登录信息
 * */
function checkAdmin($arr){
    if (isset($arr['username']) && isset($arr['password'])){
        return true;
    }else{
       alertMes("../login.html", "请输入账号或密码");
       exit;
    }
}
/*
 * 检测管理员是否已经登录
 * */
function checkLogined(){
    if (@$_SESSION['adminName'] == '' || @$_SESSION['adminId'] == ''){
        alertMes('../login.html', '请先登陆');
    }
}
/*
 * 管理员退出登录
 * */
function logoutAdmin(){
    $_SESSION['adminId'] = '';
    $_SESSION['adminName'] = '';
    alertMes('../login.html', '退出成功');
}
/*
 * 添加管理员
 * */

function addAdmin(){
    $arr = $_POST;
    $link = connect();
    $sql = "insert into manager (username,pwd,name,email,profession) values ('{$arr['username']}','{$arr['pwd1']}','{$arr['name']}','{$arr['email']}','{$arr['profession']}')";
    if(insert($link, $sql)){
        alertMes("listAdmin.php", "添加成功!");
    }else{
        alertMes("addAdmin.php", "该账户已存在,请重新添加!");
    }
}
/*
 * 更新管理员信息
 * */
function editAdmin($id){
    $arr = $_POST;
    $link = connect();
    $sql = "update manager set username='{$arr['username']}',pwd='{$arr['pwd']}',name='{$arr['name']}',email='{$arr['email']}',profession='{$arr['profession']}' where id={$id}";
    if(update($link, $sql)){
        alertMes("listAdmin.php", "修改成功!");
    }else{
        alertMes("listAdmin.php", "修改失败,请重新修改!");
    }
    
}
/*
 *删除管理员信息
 * */
function deleteAdmin($id){
    $link = connect();
    $sql = "delete from manager where id='{$id}'";
    if(delete($link, $sql)){
        alertMes("listAdmin.php", "删除成功!");
    }else{
        alertMes("listAdmin.php", "删除失败,请重新删除!");
    }
}



