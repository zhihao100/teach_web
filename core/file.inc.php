<?php
/*
 * 表单提交的文件信息检测
 * 
 * */
function checkFile($arr){
    if(is_null($arr['sec_id']) || !is_numeric($arr['sec_id']) || !isset($arr['sec_id'])){
        alertMes("fileUpload.php", "章节设置参数出错!请重新添加!");
    }else{
        return true;
    }

}

 /*
 * 上传课程文件
 * 
 * */
function addFile(){
    $arr = $_POST;
    if(checkFile($arr)){
        $link = connect();
        $fileInfo = $_FILES['file'];
        $f_type = $fileInfo['type'];
        $f_size = ceil($fileInfo['size']/1024).'KB';
        if(ceil($fileInfo['size']/1024)>1024){
            $f_size=ceil($fileInfo['size']/(1024*1024)).'MB';
        }
        $user_id = @$_SESSION['userId'];
        $allowexte = array('rar', 'doc', 'ppt','txt','docx','pptx','wps','jpg','png','mp4','avi');
        $arryFile = uploadFile($fileInfo);
        $sql = "insert into c_file (f_r_name,f_name,f_type,f_size,sec_id,user_id) values('{$arryFile['fileRelname']}','{$arryFile['fileName']}','{$f_type}','{$f_size}',{$arr['sec_id']},{$user_id})";
        if(insert($link, $sql)){
            alertMes("fileUpload.php", "文件上传成功!");
        }else{
            //删除上传的文件//
            ////
            $filename = 'upload/'.$arryFile['fileName'];
            if(!(unlink($filename))){
                exit('文件删除失败!');
            }
            alertMes("fileUpload.php", "文件上传失败!请重新上传!"); 
        }
    }    
}