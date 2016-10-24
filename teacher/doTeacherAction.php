<?php
include_once '../include.php';
$act = @$_POST['act'];
$id = @$_POST['id'];

$act1 = @$_GET['act'];
$id1 = @$_GET['id'];
$id2 = @$_GET['course_id'];
switch($act1){
    case "logout" :
        logoutTeacher();
        break;
    case "deleteLab" :
        deleteLab($id1);
        break;
    case "getChapternum" :
        getChapternum($id2);
        break;
    case "addQuestion" :
        $quesInfo = @$_POST;
        addQuestion($quesInfo);
        break;
    case "addTest" :
        addTest();
        break;
    case "deleteTest" :
        deleteTest($id1);
        break;
}

switch($act){
    case "getChQuestion" :
        $quesInfo = @$_POST;
        getChQuestion($quesInfo);
        break;
    case  'labshow' :
       labshow($link);
        break;
    case  'uploadFile' :
        addFile();
        break;
    case "addLab" :
        $labInfo = @$_POST;
        addLab($labInfo);
        break;
    case "addScore" :
        addScore($link);
        break;
    case "editLab" :
        $labInfo = @$_POST;
        editLab($labInfo);
        break;
    case "modifyQuestion1" :
        $data=modify_Question($link);
           echo $data;
        break;
    case "getPage" :
        $data = getPage($link);
   echo $data;
        break;
    case "modifyQuestion2" :
        $data=modify_Question2($link);
    echo $data;
        break;
    case "modifyQuestion3" :
  $data=modify_Question3($link);
  echo $data;
        break;
    case "deleteQuestion":
        delete_Question($link);
        break;
    case "editQuestion":
        edit_Question($link);
       alertMes("showQuestions.php","修改成功！");
        break;
    case "question_up" :
        question_up_withimg($link);
        break;
    case "searchTest" :
        searchTest($link);
        break;
    case "searchFirst" :
        searchFirst($link);
        break;
    case "searchLab" :
        searchLab($link);
        break;
    case "searchFirstLab" :
        searchFirstLab($link);
        break;
    case "searchFirstScore" :
        searchFirstScore($link);
        break;
    case "get_answer" :
        get_answer($link);
        break;
    case "get_Sanswer" :
        get_Sanswer($link);
        break;

}

