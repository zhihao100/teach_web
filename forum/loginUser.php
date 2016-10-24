<?php
include_once '../include.php';
$arr = $_POST;
if (checkUser($arr)) {
    $link = connect();
    $pwd = md5($arr['password']);
    $sql = "select * from user where username='{$arr['username']}' and pwd='{$pwd}'";
    $data = fecthOne($link, $sql);
    if (! $data) {
        alertMes("../login.html", "账号或密码错误，请重新输入！");
    } else {
        $_SESSION['userName'] = $data['name'];
        $_SESSION['userId'] = $data['id'];
        alertMes("index_user.php", "登陆成功");
    }
}