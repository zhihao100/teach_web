<?php
/*
 * 获取章节
 *
 */
function getChapternum($course_id)
{
    $link = connect();
    $i = 1;
    $sql = "SELECT * FROM chapter WHERE c_id={$course_id}";
    $num = getNumRows($link, $sql);//获取章节数
    if(!$num) alertMes("set_Homework.php", "获取章节数失败╮(╯﹏╰）╭");
    $result = mysqli_query($link, $sql);
    echo "<option selected='selected' disabled='disabled'>--请选择章节--</option>";
    while ($arry = mysqli_fetch_assoc($result)) {
        echo "<option value='{$arry['id']}'>第{$arry['ch_num']}章" . " {$arry['ch_name']}</option>";
        $i++;
    }
}
/*
 * 题目录入
 */
function addQuestion($quesInfo)
{

    $type = @$quesInfo['subject_type']or die("请输入题型");
    $link = connect();
    $course_id = @$quesInfo['course'];
    $ch_id = @$quesInfo['chapter'];

    $quesInfo = htmlspecialchars($quesInfo); //格式规范化

    if($type == 1){ //choose
        $title = $quesInfo['title'];
        $a = $quesInfo['A'];
        $b = $quesInfo['B'];
        $c = $quesInfo['C'];
        $d = $quesInfo['D'];
        $answer = $quesInfo['answer'];
//         if(!isset($title) || !isset($a) ||!isset($b) || !isset($c) || !isset($d) || !isset($answer)){
//             alertMes("question_bank.php", "请输入要录入题目的内容!");
//             exit();
//         }
//         $course_id=$quesInfo['course'];
//         $ch_id=$quesInfo['chapter'];
        $t_times = date("Y-m-d H:i:s");
        $query = @"insert into choice_bank(title, option_A, option_B, option_C, option_D, answer, course_id, ch_id,t_time)  VALUES ('{$title}','{$a}','{$b}','{$c}','{$d}','{$answer}',{$course_id},{$ch_id}, '{$t_times}')";
        if(!insert($link, $query)) alertMes("question_bank.php", "添加选择题失败!╮(╯﹏╰）╭");
        else echo "<script>window.location = 'question_bank.php'</script>";
    }else{
        if($type == 2) { //填空题
            $gap_title = $quesInfo['title2'];
            $gap_answer = $quesInfo['answer2'];
            if(!isset($gap_title) || !isset($gap_answer)){
                alertMes("question_bank.php", "请输入要录入题目的内容!");
            }
            $t_times = date("Y-m-d H:i:s");
            $query = @"insert into gap_bank(gap_title, gap_answer, course_id, ch_id, t_times)VALUES ('{$gap_title}','{$gap_answer}',{$course_id},{$ch_id},'{$t_times}')";
            if(!insert($link, $query)) alertMes("question_bank.php", "添加填空题失败!╮(╯﹏╰）╭");
            else echo "<script>window.location = 'question_bank.php'</script>";
        }else{  //简答题
            $short_title = $_POST['title1'];
            $short_answer = $_POST['answer1'];
            if(!isset($gap_title) || !isset($gap_answer)){
                alertMes("question_bank.php", "请输入要录入题目的内容!");
            }
            $t_times = date("Y-m-d H:i:s");
            $query = @"insert into short_bank(short_title, short_answer, course_id, ch_id,t_times)VALUES ('{$short_title}','{$short_answer}',{$course_id},{$ch_id},'{$t_times}')";
            if(!insert($link, $query)) alertMes("question_bank.php", "添加简答题失败!╮(╯﹏╰）╭");
            else echo "<script>window.location = 'question_bank.php'</script>";
        }
    }
}

/*
 * 出卷时获取问题
 */
function getChQuestion($quesInfo){
    $link = connect();
    $course_id = $quesInfo['course_id'];
    $chapter_snum = $quesInfo['chapter_id'];
    $result = mysqli_query($link, "SELECT * FROM choice_bank WHERE course_id=$course_id and ch_id=$chapter_snum");
    $result1 = mysqli_query($link, "SELECT * FROM gap_bank WHERE course_id=$course_id and ch_id=$chapter_snum");
    $result2 = mysqli_query($link, "SELECT * FROM short_bank WHERE course_id=$course_id and ch_id=$chapter_snum");

    while ($arry = @mysqli_fetch_assoc($result)) {
        echo "<tr class='type1'> <td class='num1'>选择题</td>
                    <td class='content1'><a>{$arry['title']}</a></td>
                    <td class='operate1'><label><input type='checkbox' name='check1[]' value={$arry['id']} class='check_box'></label></td>
                </tr>";
    }
    while ($arry1 = @mysqli_fetch_assoc($result1)) {
        echo "<tr class='type2'> <td class='num1'>填空题</td>
                    <td class='content1'><a>{$arry1['gap_title']}</a></td>
                    <td class='operate1'><label><input type='checkbox' name='check2[]' value={$arry1['id']} class='check_box'></label></td>
                </tr>";
    }
    while ($arry2 = @mysqli_fetch_assoc($result2)) {
        echo "<tr class='type3'> <td class='num1'>简答题</td>
                    <td class='content1'><a>{$arry2['short_title']}</a></td>
                    <td class='operate1'><label><input type='checkbox' name='check3[]' value={$arry2['id']} class='check_box'></label></td>
                </tr>";
    }
}
/*
 * 修改题目
 */
function modify_Question($link){
    $id=$_POST['Question_id'];
    $sql="select * from choice_bank WHERE id=$id";
    $res=mysqli_query($link,$sql);
    $arry=mysqli_fetch_assoc($res);
    $data=json_encode($arry);
    return $data;
}
function modify_Question2($link){
    $id=$_POST['Question_id'];
    $sql="select * from gap_bank WHERE id=$id";
    $res=mysqli_query($link,$sql);
    $arry=mysqli_fetch_assoc($res);
    $data=json_encode($arry);
    return $data;
}
function modify_Question3($link){
    $id=$_POST['Question_id'];
    $sql="select * from short_bank WHERE id=$id";
    $res=mysqli_query($link,$sql);
    $arry=mysqli_fetch_assoc($res);
    $data=json_encode($arry);
    return $data;
}
/*
 * 带图上传
 */
function question_up_withimg($link){
    $type = @$_POST['subject_type']or die("请输入题型");
    $time = date("Y-m-d H:i:s");
    @session_start();
    $user_id=$_SESSION['userId'];
    $arry=$_FILES;
    $j=0;
    $arryfileinfo=array(array());
    foreach($arry as $path){
        if($path['name']==null){
        }else{
            $arryfileinfo[$j]=uploadFile($path);
        }
        $j++;
    }
    if($type==1){
        $title = $_POST['title'];
        $a = $_POST['A'];
        $b = $_POST['B'];
        $c = $_POST['C'];
        $d = $_POST['D'];
        $t = $_POST['T'];
        $course_id=@$_POST['course'];
        $chapter_id=@$_POST['chapter'];
        $query = @"insert into choice_bank(title,option_A, option_B, option_C, option_D, answer, course_id, ch_id,user_id,A_image,A_R_image,B_image,B_R_image,C_image,C_R_image,D_image,D_R_image,T_image,T_R_image,t_time)  VALUES ('$title','$a','$b','$c','$d','$t',$course_id,$chapter_id,$user_id,'{$arryfileinfo[1]['fileName']}','{$arryfileinfo[1]['fileRelname']}','{$arryfileinfo[2]['fileName']}','{$arryfileinfo[2]['fileRelname']}','{$arryfileinfo[3]['fileName']}','{$arryfileinfo[3]['fileRelname']}','{$arryfileinfo[4]['fileName']}','{$arryfileinfo[4]['fileRelname']}','{$arryfileinfo[0]['fileName']}','{$arryfileinfo[0]['fileRelname']}','$time')";
        mysqli_query($link,$query) or die("未选择课程或章节，请重新录入╮(╯﹏╰）╭".mysqli_error());
        alertMes("question_bank.php", "题目录入成功!");
    }else{
        if($type==2) {
            $course_id = @$_POST['course'];
            $chapter_id = @$_POST['chapter'];
            $title_gap = $_POST['title2'];
            $answer = $_POST['answer2'];
            @$query = @"insert into gap_bank(gap_title, gap_answer, course_id, ch_id,user_id,Title_image,Title_R_image,Answer_image,Answer_R_image,t_time)   VALUES ('$title_gap','$answer',$course_id,$chapter_id,$user_id,'{$arryfileinfo[7]['fileName']}','{$arryfileinfo[7]['fileRelname']}','{$arryfileinfo[8]['fileName']}','{$arryfileinfo[8]['fileRelname']}','$time')";
            mysqli_query($link,$query) or die("未选择课程或章节，请重新录入╮(╯﹏╰）╭");
            alertMes("question_bank.php", "题目录入成功!");
        }else{
            $course_id =@ $_POST['course'];
            $chapter_id = @$_POST['chapter'];
            $title_gap = $_POST['title1'];
            $answer = $_POST['answer1'];
            $query = @"insert into short_bank(short_title, short_answer, course_id, ch_id,user_id,Title_image,Title_R_image,Answer_image,Answer_R_image,t_time)   VALUES ('$title_gap','$answer',$course_id,$chapter_id,$user_id,'{$arryfileinfo[5]['fileName']}','{$arryfileinfo[5]['fileRelname']}','{$arryfileinfo[6]['fileName']}','{$arryfileinfo[6]['fileRelname']}','$time')";
            @mysqli_query($link,$query) or die("未选择课程或章节，请重新录入╮(╯﹏╰）╭");
            alertMes("question_bank.php", "题目录入成功!");
        }
    }
}

function delete_Question($link){
    $Question_id = @$_POST['Question_id'];
    @$type=$_POST['type'];
    if($type=='type1') {
        $getimage = "select * from choice_bank WHERE id={$Question_id}";
        $image = mysqli_query($link, $getimage);
        $imagearry = mysqli_fetch_assoc($image);
        unlink("upload/" . $imagearry["T_image"]);
        unlink("upload/" . $imagearry["A_image"]);
        unlink("upload/" . $imagearry["B_image"]);
        unlink("upload/" . $imagearry["C_image"]);
        unlink("upload/" . $imagearry["D_image"]);
        $query = "delete from choice_bank WHERE id={$Question_id}";
        mysqli_query($link, $query) or die();
        echo "sucess";
    }
    if($type=='type2') {
        $getimage="select * from gap_bank WHERE id={$Question_id}";
        $image= mysqli_query($link,$getimage);
        $imagearry=mysqli_fetch_assoc($image);
        unlink("upload/".$imagearry["Title_image"]);
        unlink("upload/".$imagearry["Answer_image"]);
        $query = "delete from gap_bank WHERE id={$Question_id}";
        mysqli_query($link,$query) or die();
        echo "sucess";
    }else {
        $getimage="select * from short_bank WHERE id={$Question_id}";
        $image= mysqli_query($link,$getimage);
        $imagearry=mysqli_fetch_assoc($image);
        unlink("upload/".$imagearry["Title_image"]);
        unlink("upload/".$imagearry["Answer_image"]);
        $query = "delete  from short_bank WHERE id={$Question_id}";
        mysqli_query($link,$query) or die();
        echo "sucess";
    }
}
function edit_Question($link){
    $Question_id=$_COOKIE['Question_id'];
    @$type1=$_POST['type'];
    $count=0;
    $arryfile=array(array());
    switch($type1){
        case 1:
            $sql="select * from choice_bank WHERE id={$Question_id}";
            $result=mysqli_query($link,$sql);
            $arry=mysqli_fetch_assoc($result);
            foreach($_FILES as $file){
                if($file['name']==null){
                    switch($count){
                        case 0:
                            $arryfile[$count]=array('fileName'=>$arry['T_image'], 'fileRelname'=>$arry['T_R_image']);
                            break;
                        case 1:
                            $arryfile[$count]=array('fileName'=>$arry['A_image'], 'fileRelname'=>$arry['A_R_image']);
                            break;
                        case 2:
                            $arryfile[$count]=array('fileName'=>$arry['B_image'], 'fileRelname'=>$arry['B_R_image']);
                            break;
                        case 3:
                            $arryfile[$count]=array('fileName'=>$arry['C_image'], 'fileRelname'=>$arry['C_R_image']);
                            break;
                        case 4:
                            $arryfile[$count]=array('fileName'=>$arry['D_image'], 'fileRelname'=>$arry['D_R_image']);
                            break;
                    }
                }else{
                    switch($count){
                        case 0:
                            @unlink('upload/'.$arry['T_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                        case 1:
                            @unlink('upload/'.$arry['A_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                        case 2:
                            @unlink('upload/'.$arry['B_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                        case 3:
                            @unlink('upload/'.$arry['C_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                        case 4:
                            @unlink('upload/'.$arry['D_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                    }
                }
                $count++;
            }
            $A=$_POST['A'];
            $B=$_POST['B'];
            $C=$_POST['C'];
            $D=$_POST['D'];
            $T=$_POST['T'];
            $title=$_POST['title'];
            $A_image=$arryfile[1]['fileName'];
            $A_R_image=$arryfile[1]['fileRelname'];
            $B_image=$arryfile[2]['fileName'];
            $B_R_image=$arryfile[2]['fileRelname'];
            $C_image=$arryfile[3]['fileName'];
            $C_R_image=$arryfile[3]['fileRelname'];
            $D_image=$arryfile[4]['fileName'];
            $D_R_image=$arryfile[4]['fileRelname'];
            $T_image=$arryfile[0]['fileName'];
            $T_R_image=$arryfile[0]['fileRelname'];
            $sql=@"update choice_bank set title='{$title}',option_A='{$A}',option_B='{$B}',option_C='{$C}',option_D='{$D}',answer='{$T}',A_image='{$A_image}',A_R_image='{$A_R_image}',B_image='{$B_image}',B_R_image='{$B_R_image}',C_image='{$C_image}',C_R_image='{$C_R_image}',D_image='{$D_image}',D_R_image='{$D_R_image}',T_image='{$T_image}',T_R_image='{$T_R_image}' WHERE id={$Question_id}";
            mysqli_query($link,$sql)or die();
            break;
        case 2:
            $sql="select * from gap_bank WHERE id={$Question_id}";
            $result=mysqli_query($link,$sql);
            $arry=mysqli_fetch_assoc($result);
            foreach($_FILES as $file){
                if($file['name']==null){
                    switch($count){
                        case 0:
                            $arryfile[$count]=array('fileName'=>$arry['Title_image'], 'fileRelname'=>$arry['Title_R_image']);
                            break;
                        case 1:
                            $arryfile[$count]=array('fileName'=>$arry['Answer_image'], 'fileRelname'=>$arry['Answer_R_image']);
                            break;
                    }
                }else{
                    switch($count){
                        case 0:
                            @unlink('upload/'.$arry['Title_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                        case 1:
                            @unlink('upload/'.$arry['Answer_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                    }
                }
                $count++;
            }
            $title1=$_POST['title1'];
            $answer1=$_POST['answer1'];
            $Answer1_image=$arryfile[1]['fileName'];
            $Answer1_R_image=$arryfile[1]['fileRelname'];
            $Title_image=$arryfile[0]['fileName'];
            $Title_R_image=$arryfile[0]['fileRelname'];
            $sql=@"update gap_bank set gap_title='{$title1}',gap_answer='{$answer1}',Title_image='{$Title_image}',Title_R_image='{$Title_R_image}',Answer_image='{$Answer1_image}',Answer_R_image='{$Answer1_R_image}'WHERE id={$Question_id}";
            mysqli_query($link,$sql)or die();
            break;
        case 3:
            $sql="select * from short_bank WHERE id={$Question_id}";
            $result=mysqli_query($link,$sql);
            $arry=mysqli_fetch_assoc($result);
            foreach($_FILES as $file){
                if($file['name']==null){
                    switch($count){
                        case 0:
                            $arryfile[$count]=array('fileName'=>$arry['Title_image'], 'fileRelname'=>$arry['Title_R_image']);
                            break;
                        case 1:
                            $arryfile[$count]=array('fileName'=>$arry['Answer_image'], 'fileRelname'=>$arry['Answer_R_image']);
                            break;
                    }
                }else{
                    switch($count){
                        case 0:
                            @unlink('upload/'.$arry['Title_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                        case 1:
                            @unlink('upload/'.$arry['Answer_image']);
                            $arryfile[$count]=uploadFile($file);
                            break;
                    }
                }
                $count++;
            }
            $title1=$_POST['title2'];
            $answer1=$_POST['answer2'];
            $Answer1_image=$arryfile[1]['fileName'];
            $Answer1_R_image=$arryfile[1]['fileRelname'];
            $Title_image=$arryfile[0]['fileName'];
            $Title_R_image=$arryfile[0]['fileRelname'];
            $sql=@"update short_bank set short_title='{$title1}',short_answer='{$answer1}',Title_image='{$Title_image}',Title_R_image='{$Title_R_image}',Answer_image='{$Answer1_image}',Answer_R_image='{$Answer1_R_image}'WHERE id={$Question_id}";
            mysqli_query($link,$sql)or die();
            break;
            break;
    }

}
/*
 * addTest
 * 
 * */
function addTest()
{
//    var_dump($_POST);exit();
    $link=connect();
    $arr = @$_POST;
    $name = @$arr['Test_name'];
    $course_id = @$arr['course1'];

    $sql_classes="select classA,classB,classC,classD from course where id=$course_id";
    $classes=mysqli_query($link,$sql_classes);
    $classes_result=mysqli_fetch_assoc($classes);
    $classA=@$classes_result["classA"];
    $classB=@$classes_result["classB"];
    $classC=@$classes_result["classC"];
    $classD=@$classes_result["classD"];


    $ch_id = @$arr['chapter1'];
    $sql = "select * from test where course_id={$course_id} and ch_id={$ch_id} and test_title='{$name}'";
    if(getNumRows($link, $sql)) {alertMes("set_Homework.php", "该测试名已经在该课程下的该章节中存在!");exit();}
    $a = @$_POST['check1']; if(!isset($a)) {alertMes("set_Homework.php", "请输入选择题╮(╯﹏╰）╭");exit();}
    $b = @$_POST['check2']; if(!isset($b)) {alertMes("set_Homework.php","请输入填空题╮(╯﹏╰）╭");exit();}
    $c = @$_POST['check3']; if(!isset($c)) {alertMes("set_Homework.php","请输入简答题╮(╯﹏╰）╭");exit();}
    $num1 = count($_POST['check1']);
    $num2 = count($_POST['check2']);
    $num3 = count($_POST['check3']);
    $t_time = date("Y-m-d H:i:s");
    $query = "INSERT INTO test(test_title,choice_num,gap_num,short_num,course_id,ch_id,t_time,user_id,class_A,class_B,class_C,class_D) VALUES ('{$name}',{$num1},{$num2},{$num3},{$course_id},{$ch_id},'{$t_time}','{$_SESSION['userId']}','$classA','$classB','$classC','$classD')";
    if(!insert($link, $query)){alertMes("set_Homework.php", "发布作业失败!");exit();}
    $sql = "select id from test where test_title='{$name}'";
    $data_test = fecthOne($link, $sql);
    foreach(@$_POST['check1'] as $check1){
        $sql = "select * from choice_bank WHERE id={$check1} ";
        if(!getNumRows($link, $sql)) {alertMes("set_Homework.php", "查询选择题失败╮(╯﹏╰）╭");exit();}
        $selectarry = fecthOne($link, $sql);
//         var_dump($selectarry);
        $question = nl2br(htmlspecialchars($selectarry['title']));
        $A = nl2br(htmlspecialchars($selectarry['option_A']));
        $B = nl2br(htmlspecialchars($selectarry['option_B']));
        $C = nl2br(htmlspecialchars($selectarry['option_C']));
        $D = nl2br(htmlspecialchars($selectarry['option_D']));
        $answer = nl2br(htmlspecialchars($selectarry['answer']));
        $A_image = $selectarry['A_image'];   $A_r_image = $selectarry['A_R_image'];
        $B_image = $selectarry['B_image'];   $B_r_image = $selectarry['B_R_image'];
        $C_image = $selectarry['C_image'];   $C_r_image = $selectarry['C_R_image'];
        $D_image = $selectarry['D_image'];   $D_r_image = $selectarry['D_R_image'];
        $T_image = $selectarry['T_image'];   $T_r_image = $selectarry['T_R_image'];
        $sql = "INSERT INTO test_choice(question, test_id, A, B, C, D, answer, A_image, A_R_image, B_image, B_R_image, 
        C_image, C_R_image, D_image, D_R_image, T_image, T_R_image)  
        VALUES('{$question}',{$data_test['id']},'{$A}','{$B}','{$C}','{$D}','{$answer}','{$A_image}','{$A_r_image}','{$B_image}',
        '{$B_r_image}','{$C_image}','{$C_r_image}','{$D_image}','{$D_r_image}','{$T_image}','{$T_r_image}')";
        
        if(!insert($link, $sql)){
            $sql = "delete from test where test_title='{$name}'";
            if(!delete($link, $sql)) alertMes("set_Homework.php", "删除测试题失败╮(╯﹏╰）╭");
            alertMes("set_Homework.php", "插入选择题失败╮(╯﹏╰）╭");
            exit();
        }
    }
    foreach (@$_POST['check2'] as $check2) {
        $gap = "select * from gap_bank WHERE id={$check2}";
        if(!getNumRows($link, $gap)) {alertMes("set_Homework.php", "查询填空题失败1╮(╯﹏╰）╭");exit();}
        $gaparry = fecthOne($link, $gap);
   
        $gap_question = nl2br(htmlspecialchars($gaparry['gap_title']));
        $answer = nl2br(htmlspecialchars($gaparry['gap_answer']));
        $title_image = @$gaparry['Title_image'];     $title_r_image = @$gaparry['Title_R_image'];
        $answer_image = @$gaparry['Answer_image'];   $answer_r_image = @$gaparry['A_R_image'];
        
        $query = "INSERT INTO test_gap(gap_question, test_id, answer, title_image, title_r_image, answer_image, answer_r_image)
        VALUES ('{$gap_question}',{$data_test['id']},'{$answer}','{$title_image}','{$title_r_image}','{$answer_image}','{$answer_r_image}')";
        
        if(!insert($link, $query)) {
            $sql = "delete from test where test_title='{$name}'";
            if(!delete($link, $sql)) alertMes("set_Homework.php", "删除测试题失败╮(╯﹏╰）╭");
            alertMes("set_Homework.php", "插入填空题失败╮(╯﹏╰）╭");
            exit();
        }
    }
    foreach (@$_POST['check3'] as $check3) {
        $short = "select * from short_bank WHERE id={$check3}";
        if(!getNumRows($link, $short)) {alertMes("set_Homework.php", "查询简答题失败╮(╯﹏╰）╭");exit();}
        $shortarry = fecthOne($link, $short);
  
        $short_question = nl2br(htmlspecialchars($shortarry['short_title']));
        $answer = nl2br(htmlspecialchars($shortarry['short_answer']));
        $title_image = @$shortarry['Title_image'];    $title_r_image = @$shortarry['Title_R_image'];
        $answer_image = @$shortarry['Answer_image'];  $answer_r_image = @$shortarry['A_R_image'];
        
        $query = "INSERT INTO test_short(short_question, test_id, answer, title_image, title_r_image, answer_image, answer_r_image)
        VALUES('{$short_question}',{$data_test['id']},'{$answer}','{$title_image}','{$title_r_image}','{$answer_image}','{$answer_r_image}')";
        
        if(!insert($link, $query)) {
            $sql = "delete from test where test_title='{$name}'";
            if(!delete($link, $sql)) alertMes("set_Homework.php", "删除测试题失败╮(╯﹏╰）╭");
            alertMes("set_Homework.php", "插入简答题失败╮(╯﹏╰）╭");
            exit();
        }
    }
    alertMes("set_Homework.php", "添加成功!");
}
/*
 * deleteTest
 *
 * */
function deleteTest($id)
{
    $link = connect();
    $sql = "delete  from test_choice where test_id={$id}";
    $sql1 = "delete  from test_gap where test_id={$id}";
    $sql2 = "delete  from test_short where test_id={$id}";
    // echo json_encode($sql);
   // echo json_encode(delete($link, $sql));
    if (! delete($link, $sql)) {
        // alertMes("set_Homework.php", "删除选择题失败!");
        echo json_encode("删除选择题失败!");
    } else if (! delete($link, $sql1)) {
            echo json_encode("删除填空题失败!");
    } else if (! delete($link, $sql2)) {
            echo json_encode("删除简答题失败!");
    } else {
             $sql = "delete from test where id={$id}";
              if (! delete($link, $sql))
                //alertMes("set_Homework.php", "删除失败!");
                 echo json_encode("删除失败!");
               else
                  echo json_encode("删除成功!");
            }
}
function searchTest($link){
    @$course_id=$_POST['course_id'];
    //获取试题id
    $sql_test="select * from test where course_id={$course_id}";
    $test_res=mysqli_query($link,$sql_test);

    //获取班级id
    $sql_class="select * from course WHERE id=$course_id";
    $class_res=mysqli_query($link,$sql_class);
    $arr_class=mysqli_fetch_assoc($class_res);

    $arr=array("class_id","class_name","test_id","test_name");
    $arr['class_id']=array($arr_class['classA'],$arr_class['classB'],$arr_class['classC'],$arr_class['classD']);
    $arr['class_name']=array($arr_class['classA_name'],$arr_class['classB_name'],$arr_class['classC_name'],$arr_class['classD_name']);
    $i=0;
    $arr_testid=array();
    $arr_testname[$i]=array();
    while($arr_t=mysqli_fetch_assoc($test_res)){
        $arr_testid[$i]=$arr_t['id'];
        $arr_testname[$i]=$arr_t['test_title'];
        $i++;
    }
    $arr['test_id']=$arr_testid;
    $arr['test_name']=$arr_testname;
    echo json_encode($arr);
}
function searchFirst($link){
    $test_id=$_COOKIE['test_id'];
    $course_id=  $_COOKIE['course_id'];
    $class_id=$_COOKIE['class_id'];
    $num=5;
    $sql_done="select * from test_score WHERE class_id={$class_id}";
    $result_done=mysqli_query($link,$sql_done);
    $sum_id='';
    while(@$data_done=mysqli_fetch_assoc($result_done)){
        $data_id=$data_done['answer_id'];
        $sum_id=$sum_id.' and '. 'answer.id<>'.$data_id;
    }
    $sql="select answer.class_id,class.class_short,test.test_title,answer.test_id,answer.course_id,course.c_name,user.username,answer.student_id from answer inner JOIN test on answer.test_id=test.id INNER JOIN class on answer.class_id=class.id INNER JOIN course on answer.course_id=course.id INNER JOIN user ON answer.student_id=user.id WHERE answer.test_id=$test_id and answer.course_id=$course_id and answer.class_id=$class_id ".$sum_id." limit 0,$num";
    $result=mysqli_query($link,$sql) or die("".mysqli_error());
    $test_info=array(array());
    $i=0;
    while($arr=mysqli_fetch_assoc($result)){
        $test_info[$i]['class_id']=$arr['class_id'];
        $test_info[$i]['class_name']=$arr['class_short'];
        $test_info[$i]['test_name']=$arr['test_title'];
        $test_info[$i]['test_id']=$arr['test_id'];
        $test_info[$i]['course_id']=$arr['course_id'];
        $test_info[$i]['course_name']=$arr['c_name'];
        $test_info[$i]['student_name']=$arr['username'];
        $test_info[$i]['student_id']=$arr['student_id'];
        $i++;
    }
    $test_info[0]['length']=$i;
   echo  json_encode($test_info);
}
function searchLab($link){
    @$course_id=$_POST['course_id'];
    //获取试题id
    $sql_lab="select * from lab where course_id={$course_id}";
    $lab_res=mysqli_query($link,$sql_lab);

    //获取班级id
    $sql_class="select * from course WHERE id=$course_id";
    $class_res=mysqli_query($link,$sql_class);
    $arr_class=mysqli_fetch_assoc($class_res);

    $arr=array("class_id","class_name","test_id","test_name");
    $arr['class_id']=array($arr_class['classA'],$arr_class['classB'],$arr_class['classC'],$arr_class['classD']);
    $arr['class_name']=array($arr_class['classA_name'],$arr_class['classB_name'],$arr_class['classC_name'],$arr_class['classD_name']);
    $i=0;
    $arr_labid=array();
    $arr_labname[$i]=array();
    while($arr_t=mysqli_fetch_assoc($lab_res)){
        $arr_labid[$i]=$arr_t['id'];
        $arr_labname[$i]=$arr_t['lab_name'];
        $i++;
    }
    $arr['lab_id']=$arr_labid;
    $arr['lab_name']=$arr_labname;
    echo json_encode($arr);
}
function searchFirstLab($link){
    $test_id=$_COOKIE['test_id'];
    $course_id=  $_COOKIE['course_id'];
    $class_id=$_COOKIE['class_id'];
    $num=5;
    $sql_done="select * from test_score WHERE class_id={$class_id}";
    $result_done=mysqli_query($link,$sql_done);
    $sum_id='';
    while(@$data_done=mysqli_fetch_assoc($result_done)){
        $data_id=$data_done['answer_id'];
        $sum_id=$sum_id.' and '. 'answer.id<>'.$data_id;
    }
    $sql="select answer.class_id,class.class_short,test.test_title,answer.test_id,answer.course_id,course.c_name,user.username,answer.student_id from answer inner JOIN test on answer.test_id=test.id INNER JOIN class on answer.class_id=class.id INNER JOIN course on answer.course_id=course.id INNER JOIN user ON answer.student_id=user.id WHERE answer.test_id=$test_id and answer.course_id=$course_id and answer.class_id=$class_id ".$sum_id." limit 0,$num";
    $result=mysqli_query($link,$sql) or die("".mysqli_error());
    $test_info=array(array());
    $i=0;
    while($arr=mysqli_fetch_assoc($result)){
        $test_info[$i]['class_id']=$arr['class_id'];
        $test_info[$i]['class_name']=$arr['class_short'];
        $test_info[$i]['test_name']=$arr['test_title'];
        $test_info[$i]['test_id']=$arr['test_id'];
        $test_info[$i]['course_id']=$arr['course_id'];
        $test_info[$i]['course_name']=$arr['c_name'];
        $test_info[$i]['student_name']=$arr['username'];
        $test_info[$i]['student_id']=$arr['student_id'];
        $i++;
    }
    $test_info[0]['length']=$i;
    echo  json_encode($test_info);
}
//批改界面信息
function get_answer($link){
$answer_id=$_POST['answer_id'];
    $answer_test=array(array());
    //选择题答案
    $sql_choice="select answer_choice.choice_answer,answer.test_id,class.class_short,answer.class_id,answer.student_id,answer.course_id,answer.teacher_id,user.name from answer INNER join answer_choice ON answer.id=answer_choice.answer_id INNER JOIN class on class.id=answer.class_id INNER JOIN user on user.id=answer.student_id WHERE answer.id=$answer_id";
$answer_choice=mysqli_query($link,$sql_choice);
   $tmp=mysqli_fetch_assoc($answer_choice);
    $arr_choice=$tmp['choice_answer'];
    $answer_test[15][1]=$tmp['class_id'];
    $answer_test[15][2]=$tmp['course_id'];
    $answer_test[15][3]=$tmp['teacher_id'];
    $answer_test[15][4]=$tmp['student_id'];
    $answer_test[15][5]=$tmp['test_id'];
    $test_id=$tmp['test_id'];
    $class_short=$tmp['class_short'];
    $answer_test[9][0]=$tmp['name'];
    //填空题答案
    $sql_gap="select answer_gap.gap_answer1 from answer INNER join answer_gap ON answer.id=answer_gap.answer_id WHERE answer.id=$answer_id";
    $answer_gap=mysqli_query($link,$sql_gap);
    $tmp=mysqli_fetch_assoc($answer_gap);
    $arr_gap=$tmp['gap_answer1'];
    //简单题答案
    $sql_short="select * from answer INNER JOIN answer_short on answer.id=answer_short.answer_id WHERE answer.id=$answer_id";
    $answer_short=mysqli_query($link,$sql_short);
    $i=0;
    $answer_test[0][0]=$arr_choice;//选择题答案
    $answer_test[1][0]=$arr_gap;//填空题答案
    while($tmp=mysqli_fetch_assoc($answer_short)){
        $answer_test[2][$i]=$tmp['answer_short'];//简答题答案
        $answer_test[13][$i]=$tmp['image'];
        $i++;
    }
    $i=0;
//获取试题选择题内容
    $sql_choice="select * from test INNER  JOIN test_choice ON test.id=test_choice.test_id WHERE test.id=$test_id";
    $test_chice=mysqli_query($link,$sql_choice);
    while($tmp=mysqli_fetch_assoc($test_chice)){
        $answer_test[0][1]=$tmp['test_title'];//试卷题目
        $answer_test[3][$i]=$tmp["answer"];//选择题正确答案
        $answer_test[4][$i]=$tmp["question"];//选择题题目

        $i++;
    }
 //获取试题填空题内容
    $sql_gap="select * from test INNER  JOIN test_gap ON test.id=test_gap.test_id WHERE test.id=$test_id";
    $test_gap=mysqli_query($link,$sql_gap);
    $i=0;
    while($tmp=mysqli_fetch_assoc($test_gap)){
        $answer_test[5][$i]=$tmp["answer"];//填空题正确答案
        $answer_test[6][$i]=$tmp["gap_question"];//填空题题目
        $answer_test[11][$i]=$tmp["title_image"];
        $i++;

    }

    //获取试题简答题内容
    $sql_short="select * from test INNER  JOIN test_short ON test.id=test_short.test_id WHERE test.id=$test_id";
    $test_short=mysqli_query($link,$sql_short);
    $i=0;
    while($tmp=mysqli_fetch_assoc($test_short)){
        $answer_test[7][$i]=$tmp["answer"];//简答题答案
        $answer_test[8][$i]=$tmp["short_question"];//简答题问题
        $answer_test[12][$i]=$tmp["title_image"];//简答题图片
        $answer_test[14][$i]=$tmp["answer_image"];//简答题图片
        $i++;
    }
    $answer_test[15][0]=$answer_id;
    //获取班级
  $answer_test[10][0]=$class_short;
     echo json_encode($answer_test);
}
function searchFirstScore($link){
    $test_id=$_COOKIE['test_id'];
    $course_id=  $_COOKIE['course_id'];
    $class_id=$_COOKIE['class_id'];
    $num=5;
    $sql_done="select * from test_score INNER JOIN class ON class.id=test_score.class_id INNER JOIN course ON course.id=test_score.course_id INNER JOIN test ON test.id=test_score.test_id INNER JOIN user ON user.id=test_score.student_id
WHERE test_score.test_id=$test_id and test_score.course_id=$course_id and test_score.class_id=$class_id limit 0,$num";
    $result_done=mysqli_query($link,$sql_done);
    $score_info=array(array());
    $i=0;
    while($arr=mysqli_fetch_assoc($result_done)){
        $score_info[$i]['class_id']=$arr['class_id'];
        $score_info[$i]['class_name']=$arr['class_short'];
        $score_info[$i]['test_name']=$arr['test_title'];
        $score_info[$i]['test_id']=$arr['test_id'];
        $score_info[$i]['course_id']=$arr['course_id'];
        $score_info[$i]['course_name']=$arr['c_name'];
        $score_info[$i]['student_name']=$arr['username'];
        $score_info[$i]['student_id']=$arr['student_id'];
        $i++;
    }
    $score_info[0]['length']=$i;
    echo  json_encode($score_info);
}
function addScore($link){
 $_arr=$_POST;
  $sql_inset="insert into test_score(class_id, student_id, test_id, teacher_id, course_id, answer_id, test_score) VALUES ({$_arr['class_id']},
{$_arr['student_id']},{$_arr['test_id']},{$_arr['teacher_id']},{$_arr['course_id']},{$_arr['answer_id']},{$_arr['score']})";
   mysqli_query($link,$sql_inset);
    echo "成功提交成绩";
}

//学生已做作业界面的题目及答案
 function get_Sanswer($link){
     $answer_id=$_POST['answer_id'];
     $answer_test=array(array());
     //选择题答案
     $sql_choice="select answer_choice.choice_answer,answer.test_id,class.class_short,answer.class_id,answer.student_id,answer.course_id,answer.teacher_id,user.name from answer INNER join answer_choice ON answer.id=answer_choice.answer_id INNER JOIN class on class.id=answer.class_id INNER JOIN user on user.id=answer.student_id WHERE answer.id=$answer_id";
     $answer_choice=mysqli_query($link,$sql_choice);
     $tmp=mysqli_fetch_assoc($answer_choice);
     $arr_choice=$tmp['choice_answer'];
     $answer_test[15][1]=$tmp['class_id'];
     $answer_test[15][2]=$tmp['course_id'];
     $answer_test[15][3]=$tmp['teacher_id'];
     $answer_test[15][4]=$tmp['student_id'];
     $answer_test[15][5]=$tmp['test_id'];
     $test_id=$tmp['test_id'];
     $class_short=$tmp['class_short'];
     $answer_test[9][0]=$tmp['name'];
     //填空题答案
     $sql_gap="select answer_gap.gap_answer1 from answer INNER join answer_gap ON answer.id=answer_gap.answer_id WHERE answer.id=$answer_id";
     $answer_gap=mysqli_query($link,$sql_gap);
     $tmp=mysqli_fetch_assoc($answer_gap);
     $arr_gap=$tmp['gap_answer1'];
     //简单题答案
     $sql_short="select * from answer INNER JOIN answer_short on answer.id=answer_short.answer_id WHERE answer.id=$answer_id";
     $answer_short=mysqli_query($link,$sql_short);
     $i=0;
     $answer_test[0][0]=$arr_choice;//选择题答案
     $answer_test[1][0]=$arr_gap;//填空题答案
     while($tmp=mysqli_fetch_assoc($answer_short)){
         $answer_test[2][$i]=$tmp['answer_short'];//简答题答案
         $answer_test[13][$i]=$tmp['image'];
         $i++;
     }
     $i=0;
//获取试题选择题内容
     $sql_choice="select * from test INNER  JOIN test_choice ON test.id=test_choice.test_id WHERE test.id=$test_id";
     $test_chice=mysqli_query($link,$sql_choice);
     while($tmp=mysqli_fetch_assoc($test_chice)){
         $answer_test[0][1]=$tmp['test_title'];//试卷题目
         $answer_test[3][$i]=$tmp["answer"];//选择题正确答案
         $answer_test[4][$i]=$tmp["question"];//选择题题目
         $answer_test["A"][$i]=$tmp['A'];
         $answer_test["B"][$i]=$tmp['B'];
         $answer_test["C"][$i]=$tmp['C'];
         $answer_test["D"][$i]=$tmp['D'];
         $answer_test["T_image"][$i]=$tmp['T_image'];
         $answer_test["A_image"][$i]=$tmp['A_image'];
         $answer_test["B_image"][$i]=$tmp['B_image'];
         $answer_test["C_image"][$i]=$tmp['C_image'];
         $answer_test["D_image"][$i]=$tmp['D_image'];
         $answer_test["T_image"][$i]=$tmp['T_image'];
         $i++;
     }
     //获取试题填空题内容
     $sql_gap="select * from test INNER  JOIN test_gap ON test.id=test_gap.test_id WHERE test.id=$test_id";
     $test_gap=mysqli_query($link,$sql_gap);
     $i=0;
     while($tmp=mysqli_fetch_assoc($test_gap)){
         $answer_test[5][$i]=$tmp["answer"];//填空题正确答案
         $answer_test[6][$i]=$tmp["gap_question"];//填空题题目
         $answer_test[11][$i]=$tmp["title_image"];
         $i++;

     }

     //获取试题简答题内容
     $sql_short="select * from test INNER  JOIN test_short ON test.id=test_short.test_id WHERE test.id=$test_id";
     $test_short=mysqli_query($link,$sql_short);
     $i=0;
     while($tmp=mysqli_fetch_assoc($test_short)){
         $answer_test[7][$i]=$tmp["answer"];//简答题答案
         $answer_test[8][$i]=$tmp["short_question"];//简答题问题
         $answer_test[12][$i]=$tmp["title_image"];//简答题图片
         $answer_test[14][$i]=$tmp["answer_image"];//简答题图片
         $i++;
     }
     $answer_test[15][0]=$answer_id;
     //获取班级
     $answer_test[10][0]=$class_short;
     echo json_encode($answer_test);
 }









