<?php
require_once 'include.php';
$arr = $_POST;
if ($arr['id'] == '1') {//学生登录
    if (checkTeacherLogin($arr)) {
        $link = connect();
        $pwd = md5($arr['password']);
        $sql = "select * from user where username='{$arr['username']}' and pwd='{$pwd}' and identified=1";

        $data = fecthOne($link, $sql);
        if (! $data) {
            alertMes("index_user.php", "账号或密码错误，请重新输入！");
        } else {
            $_SESSION['userName'] = $data['name'];
            $_SESSION['userId'] = $data['id'];
            $_SESSION['type'] = $data['identified'];
            $_SESSION['class']=$data['class_short'];
            $_SESSION['name']=$data['name'];
            alertMes("default_user.php", "登陆成功");
        }
    }
}else if($arr['id'] == '2'){//老师登录
    if (checkTeacherLogin($arr)) {
        $link = connect();
        $pwd = md5($arr['password']);
        $sql = "select * from user where username='{$arr['username']}' and pwd='{$pwd}' and identified=2";

        $data = fecthOne($link, $sql);
        if (! $data) {
            alertMes("login.html", "账号或密码错误，请重新输入！");
        } else {
            $_SESSION['userName'] = $data['name'];
            $_SESSION['userId'] = $data['id'];
            alertMes("teacher/index.php", "登陆成功");
        }
    } 
}else if($arr['id'] == '3') {//管理员登录
    if (checkAdmin($arr)) {
        $link = connect();
        $sql = "select * from manager where username='{$arr['username']}' and pwd='{$arr['password']}'";
        $data = fecthOne($link, $sql);
        if (!$data) {
            alertMes("login.html", "账号或密码错误，请重新输入！");
        } else {
            $_SESSION['adminName'] = $data['name'];
            $_SESSION['adminId'] = $data['id'];
            alertMes("./admin/default.php", "登陆成功");
        }
    }
}