<?php
$mode = $_POST['mode'];
$user_id = $_POST['user_id'];
$c_id = $_POST['c_id'];
date_default_timezone_set('PRC');
$c_time = date("Y-m-d H:m:s");
$c_name = $_POST['c_name'];
$class_a = $_POST['class_a'];
$class_b = $_POST['class_b'];
$class_c = $_POST['class_c'];
$class_d = $_POST['class_d'];
$c_info = $_POST['c_info'];
$conn = mysql_connect('localhost', 'root', '25de65b6e7') or die ('connect failed' . mysql_error($conn));
mysql_select_db('teach_web', $conn) or die ('select database failed' . mysql_error($conn));
mysql_query("SET NAMES UTF8", $conn);
if($mode == "1") {
    $sql = "insert into course(c_name ,user_id, c_info, classA, classB, classC, classD, c_time) values('$c_name', '$user_id' , '$c_info' , '$class_a' , '$class_b', '$class_c', '$class_d','$c_time')";
    $result = mysql_query($sql, $conn);
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}
else if($mode == 2){
    $sql = "delete from course where id=$c_id limit 1";
    $result = mysql_query($sql, $conn);
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}