<?php
$user_id = $_POST['user_id'];

$conn = mysql_connect('localhost', 'root', '25de65b6e7') or die ('connect failed' . mysql_error($conn));
mysql_select_db('teach_web', $conn) or die ('select database failed' . mysql_error($conn));
mysql_query("SET NAMES UTF8", $conn);
$result = mysql_query("select * from course where user_id={$user_id}", $conn);
$data = array();
$i = 0;
while ($row = mysql_fetch_array($result)) {
    $data[$i]['id'] = $row['id'];
    $data[$i]['c_name'] = $row['c_name'];
    $data[$i]['c_info'] = $row['c_info'];
    $data[$i]['c_time'] = $row['c_time'];
    $data[$i]['classA_name'] = $row['classA_name'];
    $data[$i]['classB_name'] = $row['classB_name'];
    $data[$i]['classC_name'] = $row['classC_name'];
    $data[$i]['classD_name'] = $row['classD_name'];
    $i++;
}
$data[0]['c_amount'] = $i;
$string = json_encode($data);
echo $string;