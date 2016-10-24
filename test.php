<?php
//获得视频文件的缩略图
function getVideoCover($file,$time,$name) {
    if(empty($time))$time = '1';//默认截取第一秒第一帧
    $strlen = strlen($file);
    // $videoCover = substr($file,0,$strlen-4);
    // $videoCoverName = $videoCover.'.jpg';//缩略图命名
    //exec("ffmpeg -i ".$file." -y -f mjpeg -ss ".$time." -t 0.001 -s 320x240 ".$name."",$out,$status);
    $str = "ffmpeg -i ".$file." -y -f mjpeg -ss 3 -t ".$time." -s 320x240 ".$name;
    //echo $str."</br>";
    $result = system($str);
}

//获得视频文件的总长度时间和创建时间

function getTime($file)
{
    $vtime = exec("ffmpeg -i " . $file . " 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");//总长度
    $ctime = date("Y-m-d H:i:s", filectime($file));//创建时间
    //$duration = explode(":",$time);
    // $duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);//转化为秒
    return array('vtime' => $vtime,
        'ctime' => $ctime
    );
}

var_dump(getTime('1.mp4'));