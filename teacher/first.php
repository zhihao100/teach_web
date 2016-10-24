<?php
include_once '../include.php';
$link=connect();
$course_id =@$_POST['course'];
$type= @$_POST['type'];
$chapter_id =@$_POST['chapter'];
$num=5;
$i=0;
if($type==1){
    $sql = "SELECT * FROM choice_bank WHERE course_id=$course_id and ch_id=$chapter_id limit 0,$num";
    $result = mysqli_query($link, $sql);
    $chNumRows = getNumRows($link, $sql);
    $arry = array(array());
    $arry[$i]["num"]=$chNumRows;
    $arry[$i]['type']=$type;
    while($arr = mysqli_fetch_assoc($result)){
        $arry[$i]["title"]=$arr['title'];
        $arry[$i]["id"]=$arr['id'];
        $arry[$i]["time"]=$arr['t_time'];
        $i++;
    }
}
if($type==2){
    $sql = "SELECT * FROM gap_bank WHERE course_id=$course_id and ch_id=$chapter_id limit 0,$num";
    $result = mysqli_query($link, $sql);
    $chNumRows = getNumRows($link, $sql);
    $arry = array(array());
    $arry[$i]["num"]=$chNumRows;
    $arry[$i]['type']=$type;
    while($arr = mysqli_fetch_assoc($result)){
        $arry[$i]["title"]=$arr['gap_title'];
        $arry[$i]["id"]=$arr['id'];
        $arry[$i]["time"]=$arr['t_time'];
        $i++;
    }
}
if($type==3){
    $sql = "SELECT * FROM short_bank WHERE course_id=$course_id and ch_id=$chapter_id limit 0,$num";
    $result = mysqli_query($link, $sql);
    $chNumRows = getNumRows($link, $sql);
    $arry = array(array());
    $arry[$i]["num"]=$chNumRows;
    $arry[$i]['type']=$type;
    while($arr = mysqli_fetch_assoc($result)){
        $arry[$i]["title"]=$arr['short_title'];
        $arry[$i]["id"]=$arr['id'];
        $arry[$i]["time"]=$arr['t_time'];
        $i++;
    }
}
$data = json_encode($arry);
echo $data;
