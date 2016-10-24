<?php
/*
 * 检测用户是否登陆
 * 
 * */
function checkUserLogined(){
    if(@$_SESSION['userName'] == '' || @$_SESSION['userId'] == ''){
        alertMes("../login.html", "请先登录!");
    }
}
/*
 * 检测用户提交的信息
 * 
 * */
 function checkUser($arr){
     if(!isset($arr['username']) || !isset($arr['password']) || is_null($arr['username']) || is_null($arr['password'])){
         alertMes("login.html", "输入信息错误,请确保是合法输入!");
     }else{
         return true;
     }
 }
 /*
  * 用户退出登录
  * 
  * */
 function loginoutUser(){
     $_SESSION['userId'] = '';
     $_SESSION['userName'] = '';
     alertMes('../default.php', '退出成功');
 }