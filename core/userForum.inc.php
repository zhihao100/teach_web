<?php
/*
 * 检测$_GET提交过来的id信息
 * 
 * */
function checkGetById($id){
    if(!is_numeric($id) || is_null($id) || !isset($id)){
        return false;
    }else{
        return true;
    }
}
/*
 * 检测$_GET提交过来的act信息
 * */
function checkGetByAct($act){
    if(is_numeric($act) || is_null($act) || !isset($act)){
        return false;
    }else{
        return true;
    }
}
/*
 * 检测发表的帖子信息
 * 
 * */
function checkInfo($arr){
    if(is_null($arr['sonmoduleId']) || is_null($arr['title']) || is_null($arr['content']) || !isset($arr['sonmoduleId']) || !isset($arr['title']) || !isset($arr['content'])){
        alertMes("index_user.php", "输入信息错误!");
    }else{
        return true;
    }
}
/*
 * 发表帖子
 * 
 * */
 function publish(){
     $arr = $_POST;
     if(checkInfo($arr)){
         $link = connect();
         $publishTime = date("Y-m-d H:i:s");
         $floorId = $_SESSION['userId'];
         $times = 0;
         $sql = "insert into forumcontent (sonmoduleId,title,content,time,userId,times) values ('{$arr['sonmoduleId']}','{$arr['title']}','{$arr['content']}','{$publishTime}',{$floorId},{$times})";
         if(insert($link, $sql)){
            alertMes("listSonModule.php?id={$arr['sonmoduleId']}", "发表成功!");
         }else{
             alertMes("listSonModule.php?id={$arr['sonmoduleId']}", "发表失败!,请重新发表!");
         }
     }
     
 }
 /*
  * 检测回复的帖子内容
  * 
  * */
 function checkReplyInfo($arr){
     if(!isset($arr['contentreply']) || is_null($arr['contentreply'])){
         alertMes("index_user.php", "请输入回复内容,不要做非法操作!");
         return false;
     }else{
         return true;
     }
 }
/*
 * 回复帖子内容
 * 
 * */
 function reply($id){
     $arr = $_POST;
     if(checkReplyInfo($arr)){
         $link = connect();
         $replycontent = nl2br(htmlspecialchars($arr['contentreply']));
         $contentId = $id;
         $quoteId = 0;
         $replyUserId = $_SESSION['userId'];
         $replyTime = date("Y-m-d H:i:s");
         $sql = "insert into forumreply (contentId,quoteId,contentreply,replyuserId,replytime) values ({$contentId},{$quoteId},'{$replycontent}',{$replyUserId},'{$replyTime}')";
         if(insert($link, $sql)){
             alertMes("showContent.php?id={$contentId}", "回复成功!");
         }else{
             alertMes("ishowContent.php?id={$contentId}", "回复失败,请重新回复!");
         }
     }
 }

/*
 * 引用帖子回复内容
 * 
 * */
 function quote($id, $contentId){
     $arr = $_POST;
     if(checkReplyInfo($arr)){
         $link = connect();
         $contentid = $contentId;
         $quoteId = $id;
         $replycontent = nl2br(htmlspecialchars($arr['contentreply']));
         $replyUserId = $_SESSION['userId'];
         $replyTime = date("Y-m-d H:i:s");
         $sql = "insert into forumreply (contentId,quoteId,contentreply,replyuserId,replytime) values ({$contentid},{$quoteId},'{$replycontent}',{$replyUserId},'{$replyTime}')";
         if(insert($link, $sql)){
             alertMes("showContent.php?id={$contentid}", "回复成功!");
         }else{
             alertMes("ishowContent.php?id={$contentid}", "回复失败,请重新回复!");
         } 
     }
 }
/*
 * 退出
 *
 * */
function logoutUser(){
    $_SESSION['userId'] = '';
    $_SESSION['userName'] = '';
    alertMes('../forum/onlineforum.php', '退出成功');
}


























