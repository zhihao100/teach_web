<?php
$mode = $_POST['mode'];
$id = $_POST['id'];

$conn = mysql_connect('localhost', 'root', '25de65b6e7') or die ('connect failed' . mysql_error($conn));
mysql_select_db('teach_web', $conn) or die ('select database failed' . mysql_error($conn));
mysql_query("SET NAMES UTF8", $conn);
if($mode == 1) {
    $result = mysql_query("select * from chapter where c_id={$id}", $conn);
    $data = array();
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $data[$i]['id'] = $row['id'];
        $data[$i]['ch_num'] = $row['ch_num'];
        $data[$i]['ch_name'] = $row['ch_name'];
        $data[$i]['c_id'] = $row['c_id'];
        $i++;
    }
    $data[0]['ch_amount'] = $i;
}
else if($mode == 2)
{
    /*$data[0]['id']=1;
    $data[0]['sec_num'] = 1;
    $data[0]['sec_name'] = 2;
    $data[0]['ch_id'] = 1;*/
    $result = mysql_query("select * from section where ch_id={$id}", $conn);
    $data = array();
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $data[$i]['id'] = $row['id'];
        $data[$i]['sec_num'] = $row['sec_num'];
        $data[$i]['sec_name'] = $row['sec_name'];
        $data[$i]['ch_id'] = $row['ch_id'];
        $i++;
    }
    $data[0]['sec_amount'] = $i;
}
$string = json_encode($data);
echo $string;