<?php
$mode = $_POST['mode'];
$ch_num = $_POST['ch_num'];
$ch_name = $_POST['ch_name'];
$ch_id = $_POST['ch_id'];
$c_id = $_POST['c_id'];
$conn = mysql_connect('localhost', 'root', '25de65b6e7') or die ('connect failed' . mysql_error($conn));
mysql_select_db('teach_web', $conn) or die ('select database failed' . mysql_error($conn));
mysql_query("SET NAMES UTF8", $conn);
if($mode == "1") {
    $sql = "insert into chapter(ch_num ,ch_name, c_id) values('$ch_num', '$ch_name' , '$c_id')";
    $result = mysql_query($sql, $conn);
    $data = array();
    $data['ch_id'] = mysql_insert_id();
    if ($result) {
        $data['judge'] = "1";
    } else {
        $data['judge'] = "0";
    }
}
else if($mode == "2"){
    $sql = "update chapter set ch_num = '$ch_num',ch_name = '$ch_name' where id= $ch_id limit 1";
    $result = mysql_query($sql, $conn);
    if ($result) {
        $data['judge'] = "1";
    } else {
        $data['judge'] = "0";
    }
}
$string = json_encode($data);
echo $string;