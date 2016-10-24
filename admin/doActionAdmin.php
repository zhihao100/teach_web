<?php
include_once '../include.php';
checkLogined();
//1获取管理员的操作方式
$act = $_REQUEST['act'];
$id = @$_REQUEST['id'];

// var_dump($act);
// var_dump($id);
// exit();
// echo $act;
if ($act == 'addAdmin'){
    addAdmin();
}else if ($act == 'logoutAdmin'){
    logoutAdmin();
}else if ($act == 'editAdmin'){
    editAdmin($id);
}else if ($act == 'deleteAdmin'){
   deleteAdmin($id);
}else if ($act == 'addTeacher'){
    addTeacher();
}else if ($act == 'deleteTeacher'){
    deleteTeacher($id);
}else if ($act == 'addStudent'){
    addStudent();
}else if ($act == 'deleteStudent'){
    deleteStudent($id);
}else if ($act == 'addFatherModule'){
    addFatherModule();
}else if ($act == 'editFatherModule'){
    editFatherModule($id);
}else if ($act == 'deleteFatherModule'){
    deleteFatherModule($id);
}else if ($act == 'addSonModule'){
    addSonModule();
}else if($act == 'editSonModule'){
    editSonModule($id);
}else if($act == 'deleteSonModule'){
    deleteSonModule($id);
}else if($act == 'addCourse'){
    addCourse();
}else if($act == 'editCourse'){
    editCourse($id);
}else if($act == 'deleteCourse'){
    deleteCourse($id);
}else if($act == 'addClass'){
    addClass();
}
else if($act == 'deleteClass'){
    deleteClass($id);
}
















