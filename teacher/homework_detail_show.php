 <?php 
include_once '../include.php';
$test_id = @$_GET['id'];
$sql = "select * from test where id={$test_id}";
$sql_c = "select * from test_choice where test_id={$test_id}";
$sql_g = "select * from test_gap where test_id={$test_id}";
$sql_s = "select * from test_short where test_id={$test_id}";
 $result_c = mysqli_query($link, $sql_c);
 $result_g = mysqli_query($link, $sql_g);
 $result_s = mysqli_query($link, $sql_s);
 $num_c=mysqli_num_rows($result_c);
 $num_g=mysqli_num_rows($result_g);
 $num_s=mysqli_num_rows($result_s);
 $total_c=$num_c*2;
 $total_g=$num_g*4;
 $total_s=$num_s*10;
 $total_score= $total_c+ $total_g+ $total_s;
$data_t = fecthOne($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 <title><?php echo $data_t['test_title'];?></title>
    <link rel="stylesheet" href="CSS/homework_detail.css">
</head>
<body>
<!--作业具体内容-->
<div class="homework_content">
    <h1 style="text-align: center;"><?php echo $data_t['test_title'];?></h1>
        <div class="choice_content">
            <span>一:选择题（2×<?php echo  $num_c ?>=<?php echo  $total_c ?>）分</span><span style="float:right">(总分：<?php echo  $total_score ?>)</span>
            <ol>
            <?php 
                $result_c = mysqli_query($link, $sql_c);
                while($data_c = mysqli_fetch_assoc($result_c)){
            ?>
                <li class="choice_list">
                    <div><?php echo $data_c['question'];?></div>
                    <ol class="choices_text" style=" list-style-type: upper-latin;">
                        <li value="A"><?php echo $data_c['A'];?></li>
                        <li value="B"><?php echo $data_c['B'];?></li>
                        <li value="C"><?php echo $data_c['C'];?></li>
                        <li value="D"><?php echo $data_c['D'];?></li>
                    </ol>
                   <ol class="choices_picture">
                        <li><img src="upload/<?php echo $data_c['T_image']?>" alt="<?php echo $data_c['T_R_image']?>"><span><?php echo $data_c['T_image'] == NULL ? "" : "题目图"?></span></li>
                        <li value="A"><img src="upload/<?php echo $data_c['A_image']?>" alt=""><span><?php echo $data_c['A_image'] == NULL ? "" : "A"?></span></li>
                        <li value="B"><img src="upload/<?php echo $data_c['B_image']?>" alt=""><span><?php echo $data_c['B_image'] == NULL ? "" : "B"?></span></li>
                        <li value="C"><img src="upload/<?php echo $data_c['C_image']?>" alt=""><span><?php echo $data_c['C_image'] == NULL ? "" : "C"?></span></li>
                        <li value="D"><img src="upload/<?php echo $data_c['D_image']?>" alt=""><span><?php echo $data_c['D_image'] == NULL ? "" : "D"?></span></li>
                    </ol>
                </li>
                <?php }?>
            </ol>
        </div>
        <div class="filling_content">
            <span>二:填空题（4×<?php echo  $num_g ?>=<?php echo  $total_g ?>）分</span>
            <ol>
            <?php 
            $result_g = mysqli_query($link, $sql_g);
            while($data_g = mysqli_fetch_assoc($result_g)){
            ?>
                <li class="filling_list"><div><?php echo $data_g['gap_question'];?></div>
                    <ol class="filling_picture">
                        <li><img src="upload/<?php echo $data_g['title_image']?>" alt="<?php echo $data_g['title_r_image'];?>"><span><?php echo $data_g['title_image'] == NULL ? "" : "题目图"?></span></li>
                    </ol>
                </li>
                <?php }?>
            </ol>
        </div>
        <div class="subjective_content">
            <span>三:简答题（10×<?php echo  $num_s ?>=<?php echo  $total_s ?>）分</span>
            <ol>
            <?php 
            $result_s = mysqli_query($link, $sql_s);
            while($data_s = mysqli_fetch_assoc($result_s)){
            ?>
                <li class="subjective_list"><div><?php echo $data_s['short_question'];?></div><br>
                    <ol class="subjective_picture">
                        <li><img src="upload/<?php echo $data_s['title_image']?>" alt="<?php echo $data_s['title_r_image']?>"><span><?php echo $data_s['title_image'] == NULL ? "" : "题目图"?></span></li>
                    </ol>
                </li>
                <?php }?>
            </ol>
        </div>
</div>
<script src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        //各类题型图片动态输出
        $(".choices_picture li img,.filling_picture li img,.subjective_picture li img").each(function () {
            var $html = $(this).attr("src");
            if ($html == "upload/") {
                $(this).parent().empty();
            }
        });
        //选择题文本动态输出
        $(".choices_text li").each(function () {
            var $txt = $(this).text();
            if ($txt == "") {
               $(this).remove();
            }
        });
    });
</script>
</body>
</html>
