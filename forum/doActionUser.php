<?php
include_once '../include.php';
$act = @$_REQUEST['act'];
$id = @$_REQUEST['id'];
$contentId = @$_REQUEST['contentId'];
if($act == 'publish'){
    publish();
}else if($act == 'logoutUser'){
    logoutUser();
}else if($act == 'reply'){
    reply($id);
}else if($act == 'quote'){
    quote($id, $contentId);
}