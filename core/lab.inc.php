<?php

/*
 * 检测提交的实验信息
 * 
 * */
function checkLab($arr){
    if(!isset($arr['c_id']) || !isset($arr['lab_num']) || !is_numeric($arr['lab_num']) ||
        !isset($arr['lab_name']) || !isset($arr['lab_obj']) || !isset($arr['lab_content'])){
        alertMes("index_user.php", "添加的信息出现错误,请重新添加!");
    }else{
        return true;
    }
}
/*
 * 添加实验信息
 * 
 * */
function addLab($labInfo){
    $arr = $labInfo;
    $link = connect();
    $sql = "select * from lab where c_id={$arr['c_id']} and lab_num={$arr['lab_num']}";
 $sql_class="select * from course where id={$arr['c_id']}";
    $result=mysqli_query($link, $sql_class);
    $classes=mysqli_fetch_assoc($result);

    if(getNumRows($link, $sql))
    {
        echo json_encode("该实验号已经存在,请重新添加!");
        //alertMes("setLabor.php", "该实验号已经存在,请重新添加!");
        exit();
    }
    if(checkLab($arr)){
        $lab_time = date("Y-m-d H:i:s");
        $user_id = @$_SESSION['userId'];
        $sql = "insert into lab(lab_num,lab_name,lab_obj,lab_content,c_id,lab_time,user_id,class_A,class_B,class_C,class_D) values({$arr['lab_num']},'{$arr['lab_name']}','{$arr['lab_obj']}','{$arr['lab_content']}'
        ,{$arr['c_id']},'{$lab_time}','{$user_id}','{$classes['classA']}','{$classes['classB']}','{$classes['classC']}','{$classes['classD']}')";
        if(insert($link, $sql)){
            echo json_encode("添加成功!");
        }else{
            echo json_encode("添加失败,请重新添加!");
        }
    }
}
/*
 * 删除实验信
 * 
 * */
function deleteLab($id){
    $sql = "delete from lab where id={$id}";
    $link = connect();
    if(delete($link, $sql)){
        alertMes("setLabor.php", "删除成功!");
    }else{
        alertMes("setLabor.php", "删除失败,请重新删除!");
    }
}
/*
 * 修改实验信息
 *
 * */
function editLab($labInfo){
    $arr = $labInfo;
    $name=$arr['lab_name'];
    $content=$arr['lab_content'];
    $num=$arr['lab_num'];
//    $c_id=$arr['c_id'];
    $lab_obj=$arr['lab_obj'];
    $sql = "update lab set lab_name=$name,lab_content=$content,lab_obj=$lab_obj,lab_num=$num where id={$arr['lab_id']}";
    $link = connect();
    if(update($link, $sql)){
        echo json_encode("修改成功!");
    }else{
        echo json_encode("修改失败,请重新修改!");
    }
}
function labshow($link){
    $lab_id = @$_POST['lab_id'];
    if(!isset($lab_id))
    {
        echo json_encode($lab_id."参数错误!");
        exit();
    }
    $sql = "select * from lab where id={$lab_id}";
    $data_lab = fecthOne($link, $sql);
    echo json_encode($data_lab);
}




