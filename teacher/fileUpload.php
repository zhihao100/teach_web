<?php
include_once '../include.php';
$link = connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>文件上传</title>
    <link rel="stylesheet" type="text/css" href="CSS/dohomework.css" />

    <style>

        .btn-style-02 {
            border:1px #028fbd solid;
            -webkit-box-shadow:inset 0 0 1px #fff;
            -moz-box-shadow:inset 0 0 1px #fff;
            box-shadow:inset 0 0 1px #fff;
            -webkit-border-radius:4px;
            -moz-border-radius:4px;
            border-radius:4px;
            text-shadow:1px 1px 0 #45a1d6;
            background-color:#31c0f0;
            background-image: -webkit-gradient(linear, 0 0%, 0 100%, from(#31c0f0), to(#1cabda));
            background-image: -webkit-linear-gradient(top, #31c0f0 0%, #1cabda 100%);
            background-image: -moz-linear-gradient(top, #31c0f0 0%, #1cabda 100%);
            background-image: -ms-linear-gradient(top, #31c0f0 0%, #1cabda 100%);
            background-image: -o-linear-gradient(top, #31c0f0 0%, #1cabda 100%);
            background-image: linear-gradient(top, #31c0f0 0%, #1cabda 100%);
        }
        .btn-style-02:hover {
            background-color:#1cabda;
            background-image: -webkit-gradient(linear, 0 0%, 0 100%, from(#1cabda), to(#31c0f0));
            background-image: -webkit-linear-gradient(top, #1cabda 0%, #31c0f0 100%);
            background-image: -moz-linear-gradient(top, #1cabda 0%, #31c0f0 100%);
            background-image: -ms-linear-gradient(top, #1cabda 0%, #31c0f0 100%);
            background-image: -o-linear-gradient(top, #1cabda 0%, #31c0f0 100%);
            background-image: linear-gradient(top, #1cabda 0%, #31c0f0 100%);
        }
        #input{
            border-style:none;
            padding:8px 30px;
            line-height:24px;
            color:#fff;
            font:16px "Microsoft YaHei", Verdana, Geneva, sans-serif;
            cursor:pointer;
            margin-right:60px;
        }
    </style>
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;文件上传</h3></div>
<div style="margin-top:50px;"></div>
<form action="doTeacherAction.php" method="post" enctype="multipart/form-data">
    <div class="select" align="center">
        <label><select name="select1" id="select1">
            <option >--选择课程--</option>
            <?php
            $sql = "select * from course where user_id={$_SESSION['userId']}";
            $result = mysqli_query($link, $sql);
            // var_dump(mysqli_fetch_assoc($result));exit();
            while($data_course = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $data_course['id'];?>"><?php echo $data_course['c_name'];?></option>
            <?php }?>
        </select></label>
    </div>
    <br/>
    <div class="select" align="center">
        <label><select name="select2" class="select" id="select2" onchange="ChangeSelect1(this)" >
            <option >--选择章--</option>
        </select></label>
    </div>
    <br/>
    <div class="select" align="center">
        <label><select name="sec_id"  class="select" id="select3" >
            <option >--选择节--</option>
        </select></label>
    </div>
    <br/>
    <input type="hidden" name="act" value="uploadFile">
    <div align="center" style="margin-right: 100px">
       <label> <input  align="center"  type="text" size="20" name="upfile" id="upfile" style="border:1px solid  #e2e2e2;height:38px;width:170px"></label>
        <input  align="center"  name="filename" id="file" type="button" value="选择文件" onclick="path.click()" style="border:10px solid #e2e2e2;background:#e2e2e2">
        <input id="path"   type="file" name="file" style="display:none" onchange="upfile.value=this.value">
    </div>
    <br/>
    <div class="main" align="center" style="margin-right: 100px" >
        <!--css3自定义渐变圆角按钮样式-->
        <input type="submit" class="btn-style-02" value="上传" id="input" onclick="return checkInfo()" />
        <!--css3自定义渐变圆角按钮样式-->
    </div>
</form>
<script  type="text/javascript" language="javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".select").on("change", "#select1", (function () {
                var val1 = $(this).val();
                chapter_set(0, val1, "");
            })
        );
    });
    $(function () {
        $(".select").on("change", "#select2", (function () {
                var val2 = $(this).val();
                chapter_set(1, "", val2);
            })
        );
    });
    function chapter_set(choose, c_id, ch_id) {
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "judge.php",
            data: "choose=" + choose + "&c_id=" + c_id + "&ch_id=" + ch_id,
            success: function (data) {
                var array = JSON.parse(data);
                if(choose == 0){
                    var num1 = array[0]['num'];
                    var $html1 = " <select name='select2' id='select2' class='select'><option >--选择章--</option>";
                    for(var $i=0; $i < num1; $i ++){
                        var $j = $i + 1;
                        $html1 = $html1 + "<option value='"+ array[$i]['ch_id'] +"'>"+array[$i]['ch_num'] + ' '+array[$i]['ch_name'] + "</option>";
                    }
                    $html1 = $html1 +"</select>";
                    $("#select2").replaceWith($html1);
                }else if(choose == 1){
                    var num2 = array[0]['num'];
                    var $html2 = " <select name='sec_id' id='select3' class='select'><option>--选择节--</option>";
                    for(var $m=0; $m < num2; $m ++){
                        var $n = $m + 1;
                        $html2 = $html2 + "<option value='"+ array[$m]['sec_id'] +"'>"+array[$m]['sec_num']+' ' + array[$m]['sec_name'] + "</option>";
                    }
                    $html2 = $html2 +"</select>";
                    $("#select3").replaceWith($html2);
                }
            }
        })
    }
    function checkInfo(){
        var file = document.getElementById('file');
        if(file.value == ""){
            alert('请选择文件并输入文件名!');
            return false;
        }
        return true;
    }
</script>
</body>
</html>