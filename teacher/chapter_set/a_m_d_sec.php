<?php
$mode = $_POST['mode'];
$sec_num = $_POST['sec_num'];
$sec_name = $_POST['sec_name'];
$sec_id = $_POST['sec_id'];
$ch_id = $_POST['ch_id'];
$conn = mysql_connect('localhost', 'root', '25de65b6e7') or die ('connect failed' . mysql_error($conn));
mysql_select_db('teach_web', $conn) or die ('select database failed' . mysql_error($conn));
mysql_query("SET NAMES UTF8", $conn);
if($mode == "1") {
    $sql = "insert into section(sec_num ,sec_name, ch_id) values('$sec_num', '$sec_name' , '$ch_id')";
    $result = mysql_query($sql, $conn);
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}
else if($mode == 2){
    $sql = "update section set sec_num = '$sec_num',sec_name = '$sec_name' where id= $sec_id limit 1";
    $result = mysql_query($sql, $conn);
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}
else if($mode == 3){
    $sql = "delete from section where id=$sec_id limit 1";
    $result = mysql_query($sql, $conn);
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}