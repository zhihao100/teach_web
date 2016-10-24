<?php
header("content-type:text/html;charset=utf8");
function alertMes($url, $mes){
    echo "<script>alert('{$mes}');</script>";
    echo "<script>window.location='{$url}';</script>";

}
//文件上传
function uploadFile($fileInfo){
    $exte = pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
    // 获取上传文件的扩展名
    $maxsize = 52428800;
// 针对图片设置的标志位    $flag = false;
    $filePath = "upload";
    $allowexte = array('doc','png', 'jpg', 'jpeg', 'gif', 'bmp', 'rar','zip','docx', 'ppt','pptx','xls','xlsx','txt','pdf','c','cpp','mp4','avi');
    // 1.判断文件上传错误信息,只有错误信息为0或UPLOAD_ERRO_OK时上传成功
    if ($fileInfo['error'] == 0) {
        // 3.判断文件是否满足设定的上传大小

        if ($fileInfo['size'] > $maxsize) {
            exit("上传文件过大超过了系统设置的最大上传大小" . $maxsize /(1024*1024) .'M');
        }
         //4.判断上传文件类型是否满足设置的条件

        if (!in_array($exte, $allowexte)) {
            exit("上传文件类型非法");
        }
        // 5.检测上传的图片是否为真是图片,对于其他文件可以不做检测
        // $flag = false;
//        if ($flag) {
//            // getimagsize($filename)如果上传成功返回文件信息数组，失败返回false；
//            if (! getimagesize($fileInfo['tmp_name'])) {
//                exit("上传图片类型不是真实的类型");
//            }
//        }
        // 6.检测上传文件是否同过POST方式上传
        if (! is_uploaded_file($fileInfo['tmp_name'])) {
            exit("文件不是通过POST方式上传的");
        }
        // 7.将上传的文件移动到指定的地方
        // $filePath = "upload";
        // 判断指定路径是否存在,如果不存在就创建该文件
        if (! file_exists($filePath)) {
            mkdir($filePath, 0777, true);
            chmod($filePath, 0777);
        }
        $uniFilename = md5(uniqid(microtime(true), true)); // 随机产生一个文件名，防止上传的文件名相同时产生覆盖
        $destination = $filePath . '/' . $uniFilename . '.' . $exte;
        if (!@move_uploaded_file($fileInfo['tmp_name'], $destination)) {
            exit("文件上传失败");
        }
        echo "文件".$fileInfo['name']."上传成功！<br />";
        return array('fileName'=>$uniFilename.'.'.$exte, 'fileRelname'=>$fileInfo['name'],'type'=>$fileInfo['type'],'size'=>$fileInfo['size']);
    } else {
        // 错误信息匹配
        $meg="";
        switch ($fileInfo['error']) {

            case 1:
                $meg = "上传文件大小超过PHP配置文件中MAX_UPLOAD_SIZE的大小";
                break;
            case 2:
                $meg =  "上传文件超过了表单设置的最大大小";
                break;
            case 3:
                $meg =  "文件被部分上传";
                break;
            case 4:
                $meg =  "没有上传文件！";
                break;
            case 6:
                $meg =  "没有找到临时文件";
                break;
            case 7:
            case 8:
                $meg =  "系统错误";
                break;
        }
        echo $meg;
    }
}
