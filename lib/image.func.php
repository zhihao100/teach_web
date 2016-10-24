<?php
/*
 * 生成验证码
 * 
 * */
function setCaptcha($width = 100, $height = 30, $fontsize = 10){
    $image = imagecreatetruecolor( $width, $height);
    $bgcolor = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $bgcolor);
    $string = '';
    for ($i = 0; $i < 4; $i++){
        //      $fontsize = 10;//字体大小
        $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));//字体颜色
        $data = "abcdefghjkmnpqrstuvwxwABCDEFGHJKMNPQRSTUVWXWZ3456789";
        $length = strlen($data) - 1;
        $fontcontent = substr($data, rand(0,$length), 1);//内容
        $string.=$fontcontent;
        $x = ($i*100 / 4) + rand(5, 10);
        $y = rand(5, 10);

        imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
    }
    //产生点干扰
    for ($i = 0; $i < 500; $i++){
        $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
        imagesetpixel($image, rand(1, 99), rand(1, 99), $pointcolor);
    }
    //产生线干扰
    for ($i = 0; $i < 3; $i++){
        $linecolor = imagecolorallocate($image, rand(50, 220), rand(50, 220), rand(50, 220));
        imageline($image, rand(0, 20), rand(0, 20), rand(80, 90), rand(0, 30), $linecolor);
    }
    header('content-type:image/png');
    imagepng($image);
    imagedestroy($image);
    return $string;
}
