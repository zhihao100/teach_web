<?php
include_once 'lib/image.func.php';
$_SESSION['verify'] = setCaptcha();
var_dump($_SESSION['verify']);
