<?php
/*
 * 检测表单提交的信息
 * 
 * */
function checkFatherModule($arr){
    if (!isset($arr['modulename'])){
        alertMes("addFatherModule.php", "请输入父版块名称!");
    }else{
          return true;  
        }
}
/*
 * 添加父版块信息
 * 
 * */
function addFatherModule(){
    $arr = $_POST;
    if (checkFatherModule($arr)){
        $link = connect();
        $sql = "insert into forumfathermodule (modulename) values ('{$arr['modulename']}')";
        if (insert($link, $sql)){
            alertMes("listFatherModule.php", "添加父版块信息成功!");
        }else{
            alertMes("addFatherModule.php", "该父版块名称已存在,请重新添加!");
        }
    }
}
/*
 * 更新父版块信息
 * 
 * */
function editFatherModule($id){
    $arr = $_POST;
    $link = connect();
    $sql = "update forumfathermodule set modulename='{$arr['modulename']}' where id={$id}";
    if (update($link, $sql)){
        alertMes("listFatherModule.php", "修改成功!");
    }else{
        alertMes("listFatherModule.php", "修改失败,请重新修改!");
    }
}
/*
 * 删除父版块信息
 * 
 * */
function deleteFatherModule($id){
    $link = connect();
    $sql1 = "select * from forumsonmodule where fathermoduleId={$id}";
    $numRows = getNumRows($link, $sql1);//判断父版块下是否存在子版块
    if ($numRows == 0) {
        $sql2 = "delete from forumfathermodule where id={$id}";
        if (delete($link, $sql2)) {
            alertMes("listFatherModule.php", "删除成功!");
        } else {
            alertMes("listFatherModule.php", "删除失败,请重新删除!");
        }
    } else {
        alertMes("listSonModule.php", "请先删除该板块下的子版块!");
    }
}

/*
 * 检测表单提交的信息
 * 
 * */
function checkSonModule($arr){
    if (!isset($arr['modulename'])){
        alertMes("addSonModule.php", "请输入子版块名称!");
    }else{
        return true;
    }
}
/*
 *添加子版块信息
 * */
function addSonModule(){
    $arr = $_POST;
    if (checkSonModule($arr)){
        $link = connect();
        $sql = "insert into forumsonmodule (fathermoduleId,modulename,info,hostId) values ({$arr['fathermoduleId']},'{$arr['modulename']}','{$arr['content']}',{$arr['hostId']})";
        if (insert($link, $sql)){
            alertMes("listSonModule.php", "添加子版块信息成功!");
        }else{
            alertMes("addSonModule.php", "存在该子版块,请重新添加!");
        }
    }
}
/*
 * 修改子版块信息
 * 
 * */
function editSonModule($id){
    $arr = $_POST;
    $link = connect();
    $sql = "update forumsonmodule set fathermoduleId={$arr['fathermoduleId']},modulename='{$arr['modulename']}',info='{$arr['content']}',hostId={$arr['hostId']} where id={$id}";
    if (update($link, $sql)){
        alertMes("listSonModule.php", "修改成功!");
    }else{
        alertMes("listSonModule.php", "修改失败,请重新修改!");
    }
}
/*
 * 删除子版块信息
 * 
 * */
function deleteSonModule($id){
    $link = connect();
    $sql = "select * from forumcontent where sonmoduleId={$id}";
    $contentRows = getNumRows($link, $sql);
    if ($contentRows == 0) {
        $sql = "delete from forumsonmodule where id={$id}";
        if (delete($link, $sql)) {
            alertMes("listSonModule.php", "删除成功!");
        } else {
            alertMes("listSonModule.php", "删除失败,请重新删除!");
        }
    }else{
        alertMes("content.php", "请先删除该子版块下的帖子!");
    }
}










