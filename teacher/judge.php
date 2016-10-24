<?php
include_once '../include.php';
$ch = @$_POST['choose'];
$c_id = @$_POST['c_id'];
$ch_id= @$_POST['ch_id'];
if(!isset($ch)){
    alertMes("fileUpload.html", "{$ch}参数错误!");
}
if(0 == $ch){//查询chapter数据表
    if(!isset($c_id) || !is_numeric($c_id)){
        alertMes("fileUpload.html", "{$c_id}参数错误!");
    }
    $chapter = array(array());
    $i = 0;
    $sql = "select * from chapter where c_id={$c_id}";
    $chNumRows = getNumRows($link, $sql);
    $chapter[$i]['num'] = $chNumRows;
    $result = mysqli_query($link, $sql);
    while($data_chapter = @mysqli_fetch_assoc($result)){
        $chapter[$i]['ch_id'] = $data_chapter['id'];
        $chapter[$i]['ch_name'] = $data_chapter['ch_name'];
        $chapter[$i]['ch_num'] = $data_chapter['ch_num'];
        $i++;
    }
    
 // var_dump($chapter);
  echo  json_encode($chapter);

}else if(1 == $ch){
    if(!isset($ch_id)){
        alertMes("fileUpload.html", "{$ch_id}参数错误!");
    }
    $section = array(array());
    $i = 0;
    $sql = "select * from section where ch_id={$ch_id}";
    $secNumRows = getNumRows($link, $sql);
    $section[$i]['num'] = $secNumRows;
    $result = mysqli_query($link, $sql);
    while($data_section = @mysqli_fetch_assoc($result)){
        $section[$i]['sec_id'] = $data_section['id'];
        $section[$i]['sec_name'] = $data_section['sec_name'];
        $section[$i]['sec_num'] = $data_section['sec_num'];
        $i++;
    }
    echo json_encode($section);

}else{
    echo json_encode("error!");
}
