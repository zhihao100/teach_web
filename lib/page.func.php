<?php
header("Content-type:text/html;charset=utf8");
function page($pageTotal, $pageSize, $buttonNum=5){
    $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
//     $pageTotal = 121; // 总共的记录条数
//     $pageSize = 5; // 每页显示的记录条数
//     $buttonNum = 6; // 显示的按钮数
    $offset = ($page - 1) * $pageSize;
    $URL = $_SERVER['REQUEST_URI'];
    $urlArry = parse_url($URL);
    $path ="../teacher/showQuestions.php";
    $query = @$urlArry['query']; // 拆解参数
    if (isset($query)) {
        parse_str($query, $queryArry);
        unset($queryArry['page']);
        if (empty($queryArry)) {
            $url = $path . '?page=';
        } else {
            $other = http_build_query($queryArry);
            $url = $path . '?' . $other . '&page=';
        }
    } else {
        $url = $path . '?page=';
    }

    $pageNum = ceil($pageTotal / $pageSize); // 计算得到的总页数
    if ($page > $pageNum) {
        $page = $pageNum;
    }
    $html = '';
    if ($buttonNum >= $pageNum) {
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = 1; $i <= $pageNum; $i ++) {
            if ($page == $i) {
                $html.="<li class='selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>$i </a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    } else {
        $startBtn = $page - 2;
        if ($startBtn < 1) {
            $startBtn = 1;
        }
        $endBtn = $startBtn + $buttonNum - 1;
        if ($endBtn > $pageNum) {
            $startBtn = $pageNum - $buttonNum + 1;
            $endBtn = $pageNum;
        }
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = $startBtn; $i <= $endBtn; $i ++) {
            if ($page == $i) {
                $html.="<li class='selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>{$i}</a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    }
    return array('offset'=>$offset,'html'=>$html,'pageall'=>$pageTotal);
}


function page1($pageTotal, $pageSize,$type, $chapter_id,$buttonNum=5){
    $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
//     $pageTotal = 121; // 总共的记录条数
//     $pageSize = 5; // 每页显示的记录条数
//     $buttonNum = 6; // 显示的按钮数
    $offset = ($page - 1) * $pageSize;
    $URL = $_SERVER['REQUEST_URI'];
    $urlArry = parse_url($URL);
    $path ="../teacher/showQuestions.php";
    $query = @$urlArry['query']; // 拆解参数
    if (isset($query)) {
        parse_str($query, $queryArry);
        unset($queryArry['page']);
        if (empty($queryArry)) {
            $url = $path . '?page=';
        } else {
            $other = http_build_query($queryArry);
            $url = $path . '?' . $other . '&page=';
        }
    } else {
        $url = $path . '?page=';
    }

    $pageNum = ceil($pageTotal / $pageSize); // 计算得到的总页数
    if ($page > $pageNum) {
        $page = $pageNum;
    }
    $html = '';
    if ($buttonNum >= $pageNum) {
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}&pageall={$pageTotal}'>上一页</a></li>";
        }
        for ($i = 1; $i <= $pageNum; $i ++) {
            if ($page == $i) {
                $html.="<li  class='selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}&pageall={$pageTotal}'>$i </a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}&pageall={$pageTotal}'>下一页</a></li>";
        }
    } else {
        $startBtn = $page - 2;
        if ($startBtn < 1) {
            $startBtn = 1;
        }
        $endBtn = $startBtn + $buttonNum - 1;
        if ($endBtn > $pageNum) {
            $startBtn = $pageNum - $buttonNum + 1;
            $endBtn = $pageNum;
        }
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}&pageall={$pageTotal}'>上一页</a></li>";
        }
        for ($i = $startBtn; $i <= $endBtn; $i ++) {
            if ($page == $i) {
                $html.="<li class='active selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}&pageall={$pageTotal}'>{$i}</a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}&course_id=3&offset={$offset}&pageall={$pageTotal}'>下一页</a></li>";
        }
    }
    return array('offset'=>$offset,'html'=>$html,'pageall'=>$pageTotal);
}
function getPage($link){
    $type=$_POST['type'];
    $chapter_id=$_POST['chapter'];
    $course_id=$_POST['course'];
    switch($type) {
        case 1:
            $sql = "SELECT * FROM choice_bank WHERE course_id=$course_id and ch_id=$chapter_id";
            $result = mysqli_query($link, $sql);
            $pagetoal = mysqli_num_rows($result);
            $num = 5;
            $arr = page1($pagetoal, $num, $type, $chapter_id);
            $data = json_encode($arr);
            return $data;
            break;
        case 2:
            $sql = "SELECT * FROM gap_bank WHERE course_id=$course_id and ch_id=$chapter_id";
            $result = mysqli_query($link, $sql);
            $pagetoal = mysqli_num_rows($result);
            $num = 5;
            $arr = page1($pagetoal, $num, $type, $chapter_id);
            $data = json_encode($arr);
            return $data;
            break;
        case 3:
            $sql = "SELECT * FROM short_bank WHERE course_id=$course_id and ch_id=$chapter_id";
            $result = mysqli_query($link, $sql);
            $pagetoal = mysqli_num_rows($result);
            $num = 5;
            $arr = page1($pagetoal, $num, $type, $chapter_id);
            $data = json_encode($arr);
            return $data;
            break;
    }
}
function page_set_labor($pageTotal, $pageSize,$buttonNum=5){
    $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
//     $pageTotal = 121; // 总共的记录条数
//     $pageSize = 5; // 每页显示的记录条数
//     $buttonNum = 6; // 显示的按钮数
    $offset = ($page - 1) * $pageSize;
    $URL = $_SERVER['REQUEST_URI'];
    $urlArry = parse_url($URL);
    $path ="../teacher/setLabor.php";
    $query = @$urlArry['query']; // 拆解参数
    if (isset($query)) {
        parse_str($query, $queryArry);
        unset($queryArry['page']);
        if (empty($queryArry)) {
            $url = $path . '?page=';
        } else {
            $other = http_build_query($queryArry);
            $url = $path . '?' . $other . '&page=';
        }
    } else {
        $url = $path . '?page=';
    }

    $pageNum = ceil($pageTotal / $pageSize); // 计算得到的总页数
    if ($page > $pageNum) {
        $page = $pageNum;
    }
    $html = '';
    if ($buttonNum >= $pageNum) {
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}&pageall={$pageTotal}'>上一页</a></li>";
        }
        for ($i = 1; $i <= $pageNum; $i ++) {
            if ($page == $i) {
                $html.="<li  class='selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}&pageall={$pageTotal}'>$i </a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}&pageall={$pageTotal}'>下一页</a></li>";
        }
    } else {
        $startBtn = $page - 2;
        if ($startBtn < 1) {
            $startBtn = 1;
        }
        $endBtn = $startBtn + $buttonNum - 1;
        if ($endBtn > $pageNum) {
            $startBtn = $pageNum - $buttonNum + 1;
            $endBtn = $pageNum;
        }
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}&pageall={$pageTotal}'>上一页</a></li>";
        }
        for ($i = $startBtn; $i <= $endBtn; $i ++) {
            if ($page == $i) {
                $html.="<li class='active selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}&pageall={$pageTotal}'>{$i}</a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}&course_id=3&offset={$offset}&pageall={$pageTotal}'>下一页</a></li>";
        }
    }
    return array('offset'=>$offset,'html'=>$html,'pageall'=>$pageTotal);
}
function page_set_homework($pageTotal, $pageSize,$buttonNum=5){
    $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
//     $pageTotal = 121; // 总共的记录条数
//     $pageSize = 5; // 每页显示的记录条数
//     $buttonNum = 6; // 显示的按钮数
    $offset = ($page - 1) * $pageSize;
    $URL = $_SERVER['REQUEST_URI'];
    $urlArry = parse_url($URL);
    $path ="../teacher/set_Homework.php";
    $query = @$urlArry['query']; // 拆解参数
    if (isset($query)) {
        parse_str($query, $queryArry);
        unset($queryArry['page']);
        if (empty($queryArry)) {
            $url = $path . '?page=';
        } else {
            $other = http_build_query($queryArry);
            $url = $path . '?' . $other . '&page=';
        }
    } else {
        $url = $path . '?page=';
    }

    $pageNum = ceil($pageTotal / $pageSize); // 计算得到的总页数
    if ($page > $pageNum) {
        $page = $pageNum;
    }
    $html = '';
    if ($buttonNum >= $pageNum) {
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}&pageall={$pageTotal}'>上一页</a></li>";
        }
        for ($i = 1; $i <= $pageNum; $i ++) {
            if ($page == $i) {
                $html.="<li  class='selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}&pageall={$pageTotal}'>$i </a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}&pageall={$pageTotal}'>下一页</a></li>";
        }
    } else {
        $startBtn = $page - 2;
        if ($startBtn < 1) {
            $startBtn = 1;
        }
        $endBtn = $startBtn + $buttonNum - 1;
        if ($endBtn > $pageNum) {
            $startBtn = $pageNum - $buttonNum + 1;
            $endBtn = $pageNum;
        }
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}&pageall={$pageTotal}'>上一页</a></li>";
        }
        for ($i = $startBtn; $i <= $endBtn; $i ++) {
            if ($page == $i) {
                $html.="<li class='active selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}&pageall={$pageTotal}'>{$i}</a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}&course_id=3&offset={$offset}&pageall={$pageTotal}'>下一页</a></li>";
        }
    }
    return array('offset'=>$offset,'html'=>$html,'pageall'=>$pageTotal);
}
function page_admin($pageTotal, $pageSize, $buttonNum=5){
    $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
//     $pageTotal = 121; // 总共的记录条数
//     $pageSize = 5; // 每页显示的记录条数
//     $buttonNum = 6; // 显示的按钮数
    $offset = ($page - 1) * $pageSize;
    $URL = $_SERVER['REQUEST_URI'];
    $urlArry = parse_url($URL);
    $path = $urlArry['path'];
    $query = @$urlArry['query']; // 拆解参数
    if (isset($query)) {
        parse_str($query, $queryArry);
        unset($queryArry['page']);
        if (empty($queryArry)) {
            $url = $path . '?page=';
        } else {
            $other = http_build_query($queryArry);
            $url = $path . '?' . $other . '&page=';
        }
    } else {
        $url = $path . '?page=';
    }

    $pageNum = ceil($pageTotal / $pageSize); // 计算得到的总页数
    if ($page > $pageNum) {
        $page = $pageNum;
    }
    $html = '';
    if ($buttonNum >= $pageNum) {
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = 1; $i <= $pageNum; $i ++) {
            if ($page == $i) {
                $html.="<li class='active'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>$i </a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    } else {
        $startBtn = $page - 2;
        if ($startBtn < 1) {
            $startBtn = 1;
        }
        $endBtn = $startBtn + $buttonNum - 1;
        if ($endBtn > $pageNum) {
            $startBtn = $pageNum - $buttonNum + 1;
            $endBtn = $pageNum;
        }
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = $startBtn; $i <= $endBtn; $i ++) {
            if ($page == $i) {
                $html.="<li class='active'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>{$i}</a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    }
    return array('offset'=>$offset,'html'=>$html);
}
function page_dohomework($pageTotal, $pageSize, $buttonNum=5){
    $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
//     $pageTotal = 121; // 总共的记录条数
//     $pageSize = 5; // 每页显示的记录条数
//     $buttonNum = 6; // 显示的按钮数
    $offset = ($page - 1) * $pageSize;
    $URL = $_SERVER['REQUEST_URI'];
    $urlArry = parse_url($URL);
    $path ="../teacher/dohomework.php";
    $query = @$urlArry['query']; // 拆解参数
    if (isset($query)) {
        parse_str($query, $queryArry);
        unset($queryArry['page']);
        if (empty($queryArry)) {
            $url = $path . '?page=';
        } else {
            $other = http_build_query($queryArry);
            $url = $path . '?' . $other . '&page=';
        }
    } else {
        $url = $path . '?page=';
    }

    $pageNum = ceil($pageTotal / $pageSize); // 计算得到的总页数
    if ($page > $pageNum) {
        $page = $pageNum;
    }
    $html = '';
    if ($buttonNum >= $pageNum) {
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = 1; $i <= $pageNum; $i ++) {
            if ($page == $i) {
                $html.="<li class='selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>$i </a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    } else {
        $startBtn = $page - 2;
        if ($startBtn < 1) {
            $startBtn = 1;
        }
        $endBtn = $startBtn + $buttonNum - 1;
        if ($endBtn > $pageNum) {
            $startBtn = $pageNum - $buttonNum + 1;
            $endBtn = $pageNum;
        }
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = $startBtn; $i <= $endBtn; $i ++) {
            if ($page == $i) {
                $html.="<li class='selected'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>{$i}</a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    }
    return array('offset'=>$offset,'html'=>$html,'pageall'=>$pageTotal);
}
function page_all($pageTotal, $pageSize, $buttonNum=5){
    $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
//     $pageTotal = 121; // 总共的记录条数
//     $pageSize = 5; // 每页显示的记录条数
//     $buttonNum = 6; // 显示的按钮数
    $offset = ($page - 1) * $pageSize;
    $URL = $_SERVER['REQUEST_URI'];
    $urlArry = parse_url($URL);
    $path = $urlArry['path'];
    $query = @$urlArry['query']; // 拆解参数
    if (isset($query)) {
        parse_str($query, $queryArry);
        unset($queryArry['page']);
        if (empty($queryArry)) {
            $url = $path . '?page=';
        } else {
            $other = http_build_query($queryArry);
            $url = $path . '?' . $other . '&page=';
        }
    } else {
        $url = $path . '?page=';
    }

    $pageNum = ceil($pageTotal / $pageSize); // 计算得到的总页数
    if ($page > $pageNum) {
        $page = $pageNum;
    }
    $html = '';
    if ($buttonNum >= $pageNum) {
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = 1; $i <= $pageNum; $i ++) {
            if ($page == $i) {
                $html.="<li class='active'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>$i </a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    } else {
        $startBtn = $page - 2;
        if ($startBtn < 1) {
            $startBtn = 1;
        }
        $endBtn = $startBtn + $buttonNum - 1;
        if ($endBtn > $pageNum) {
            $startBtn = $pageNum - $buttonNum + 1;
            $endBtn = $pageNum;
        }
        if ($page > 1) {
            $prev = $page - 1;
            $html.="<li><a href='{$url}{$prev}'>上一页</a></li>";
        }
        for ($i = $startBtn; $i <= $endBtn; $i ++) {
            if ($page == $i) {
                $html.="<li class='active'>{$i}</li>";
            } else {
                $html.="<li><a href='{$url}{$i}'>{$i}</a></li>";
            }
        }
        if ($page < $pageNum) {
            $next = $page + 1;
            $html.="<li><a href='{$url}{$next}'>下一页</a></li>";
        }
    }
    return array('offset'=>$offset,'html'=>$html);
}

