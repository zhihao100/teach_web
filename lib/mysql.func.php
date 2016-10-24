<?php
/*
 * 连接数据库*/
function connect(){
    $link = mysqli_connect(DB_HOST, DB_NAME, DB_PWD) or die("数据库无法连接.ERROR:" . mysqli_connect_errno() . ":" . mysqli_connect_error());
    mysqli_set_charset($link, CHARSET);
    mysqli_select_db($link, DB_DATABASE) or die("数据库无法打开.ERROR:".mysqli_errno($link).":".mysqli_error($link));
    if(!$link) {
        die("no connect");
    }
    return $link;
}
/*
 *添加数据 
 */
function insert($link, $sql){
   $result = mysqli_query($link, $sql);
   return $result;
}
/*
 *得到数据的所有条数
 * */
function getNumRows($link, $sql){
    $result = mysqli_query($link, $sql);
    $numRows = mysqli_num_rows($result);
    return $numRows;
}
/*
 * 获取一条数据
 * */
function fecthOne($link, $sql){
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}
/*
 *获取所有数据
 * */
function fechAll($link, $sql){
  $rows=[];
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 0){
        return false;
    }else{
        while(@$row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
        }
        return $rows;
    }
}
/*
 * 更新数据
 * */
function update($link, $sql){
    $result = mysqli_query($link, $sql);
    return $result;
}

/*
 * 删除数据
 * */
function delete($link ,$sql){
    $result = mysqli_query($link, $sql);
    return $result;
}

