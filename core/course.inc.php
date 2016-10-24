<?php
/*
 * 检测表单提交的信息
 * 
 * */
function checkCourse($arr){
    if (!isset($arr['coursename']) || is_null($arr['coursename'])){
        alertMes("addCourse.php", "请输入课程名!");
    }else{
        return true;
    }
}
/*
 * 课程添加
 * 
 * */
function addCourse(){
    $arr = $_POST;
    if (checkCourse($arr)){
        $link = connect();
        $sql = "select * from course where c_name='{$arr['coursename']}' and user_id={$arr['user_id']}";
//         var_dump(fecthOne($link, $sql));exit();
        if(fecthOne($link, $sql)){
            alertMes("addCourse.php", "该信息已经存在,请重新添加!");
        }
        $c_time = date("Y-m-d H:i:s");
        $checked=$arr['check'];
        $classA= @$checked['0'];
        $classB=@$checked['1'];
        $classC= @$checked['2'];
        $classD= @$checked['3'];
        $classes_name=array();
        foreach($checked as $id){
            $sql= "select * from class where id=$id ";
            $class_selected=mysqli_query($link,$sql);
            $arry=@mysqli_fetch_assoc($class_selected);
            $class_name= $arry['class_short'];
      $classes_name[]= $class_name;
        }
        $classA_name=@$classes_name['0'];
        $classB_name=@$classes_name['1'];
        $classC_name=@$classes_name['2'];
        $classD_name=@$classes_name['3'];

        $sql = "insert into course (c_name,user_id,c_time,c_info,classA,classB,classC,classD,classA_name,classB_name,classC_name,classD_name) value('{$arr['coursename']}',{$arr['user_id']},'{$c_time}','{$arr['smallstate']}','{$classA}','{$classB}','{$classC}','{$classD}','{$classA_name}','{$classB_name}','{$classC_name}','{$classD_name}')";
        if(insert($link, $sql)){
            alertMes("listCourse.php", "添加课程信息成功!");
        }else{
            alertMes("addCourse.php", "添加课程信息失败!");
        }
    }
}
/*
 * 修改课程信息
 * 
 * */
function editCourse($id){
    $arr = $_POST;
    $link = connect();
    $sql = "select * from course where c_name='{$arr['coursename']}' and user_id={$arr['user_id']}";
    if(fecthOne($link, $sql)){
        alertMes("listCourse.php", "该信息已经存在,请重修改!");
        exit();
    }
    $c_time = date("Y-m-d H:i:s");
    $sql = "update course set c_name='{$arr['coursename']}',user_id={$arr['user_id']},c_time='{$c_time}' where id={$id}";
    if(update($link, $sql)){
        alertMes("listCourse.php", "课程信息修改成功!");
    }else{
        alertMes("listCourse.php", "课程信息修改失败!请重新修改!");
    }
}
/*
 * 删除课程信息
 * 
 * */
function deleteCourse($id){
    $arr = $_POST;
    $link = connect();
    $sql = "select * from chapter where c_id={$id}";
    if(fechAll($link, $sql)){
        alertMes("listCourse.php", "该课程存在章节信息,不能删除!");
    }else{
        $sql = "delete from course where id={$id}";
        if(delete($link, $sql)){
            alertMes("listCourse.php", "删除课程信息成功!");
        }else{
            alertMes("listCourse.php", "删除课程信息失败,请重新删除!");
        }
    }
}
function addClass(){
    $arr = $_POST;
    $link = connect();
    $department=$arr['department'];
    $school=$arr['school'];
   $class_num= $arr['class_num'];
    $major=$arr['major'];
    $grade=$arr['grade'];
    $sql = "select * from class where major='$major' AND class_num=$class_num";
    if(fecthOne($link, $sql)){
        alertMes("addClass.php", "该信息已经存在,请重修改!");
        exit();
    }
    $sql = "insert into class (school, department, major, class_num, grade,class_short)  value('$school','$department','$major','$class_num','$grade','{$arr['class_short']}')";
    if(insert($link, $sql)){
        alertMes("addClass.php", "添加班级信息成功!");
    }else{
        alertMes("addClass.php", "添加班级信息失败!");
    }
}

