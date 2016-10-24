<?php
include_once '../include.php';

$course_id = @$_GET['course_id'];
$ch_id = @$_GET['ch_id'];

$i=1;
$j=1;
$k=1;
$result =mysqli_query($link,"SELECT * FROM choice_bank WHERE course_id={$course_id} and ch_id={$ch_id}")or die("失败╮(╯﹏╰）╭");
$result1 =mysqli_query($link,"SELECT * FROM gap_bank WHERE course_id={$course_id} and ch_id={$ch_id}")or die("失败╮(╯﹏╰）╭");
$result2 =mysqli_query($link,"SELECT * FROM short_bank WHERE course_id={$course_id} and ch_id={$ch_id}")or die("失败╮(╯﹏╰）╭");

echo "<th>类型</th><th>题目</th><th>录入时间</th><th>操作</th>";
while($arry=mysqli_fetch_assoc($result)) {
    if ($i==1) {
        echo " <tr class='type1' style='border:1px solid white'><td style='border:1px solid white'>选择题</td>
        <td style='border:1px solid white'>{$arry['title']}</td>
        <td style='border:1px solid white'>{$arry['t_time']}</td>
        <td style='border:1px solid white'><span class='edit'><button class='modify'value={$arry['id']}>修改</button></span><span class='delete'><button>删除</button></span></td>
        </tr>";
        $i++;
    }else{
        echo " <tr class='type1'style='border:1px solid white'><td style='border:1px solid white'>选择题</td>
        <td style='border:1px solid white'>{$arry['title']}</td>
        <td style='border:1px solid white'>{$arry['t_time']}</td>
        <td style='border:1px solid white'><span class='edit'><button class='modify'value={$arry['id']}>修改</button></span><span class='delete'><button>删除</button></span></td>
        </tr>";
        $i--;
    }
}
while($arry1=mysqli_fetch_assoc($result1)){
    if ($i==1) {
        echo " <tr  class='type2'><td style='border:1px solid white'>填空题</td>
        <td style='border:1px solid white'>{$arry1['gap_title']}</td>
        <td style='border:1px solid white'>{$arry1['t_time']}</td>
        <td style='border:1px solid white'><span class='edit'><button class='modify'value={$arry1['id']}>修改</button></span><span class='delete'><button>删除</button></span></td>
        </tr>";
        $i++;
    }else{
        echo " <tr  class='type2'><td style='border:1px solid white'>填空题</td>
        <td style='border:1px solid white'>{$arry1['gap_title']}</td>
        <td style='border:1px solid white'>{$arry1['t_time']}</td>
        <td style='border:1px solid white'><span class='edit'><button class='modify'value={$arry1['id']}>修改</button></span><span class='delete'><button>删除</button></span></td>
        </tr>";
        $i--;
    }
}
while($arry2=mysqli_fetch_assoc($result2)){
    if ($i==1) {
        echo " <tr class='type3'><td style='border:1px solid white'>简答题</td>
        <td style='border:1px solid white'>{$arry2['short_title']}</td>
        <td style='border:1px solid white'>{$arry2['t_time']}</td>
        <td style='border:1px solid white'><span class='edit'><button class='modify' value={$arry2['id']}>修改</button></span><span class='delete'><button>删除</button></span></td>
        </tr>";
        $i++;
    }else{
        echo " <tr  class='type3'><td style='border:1px solid white'>简答题</td>
        <td style='border:1px solid white'>{$arry2['short_title']}</td>
        <td style='border:1px solid white'>{$arry2['t_time']}</td>
        <td style='border:1px solid white'><span class='edit'><button class='modify' value={$arry2['id']}>修改</button></span><span class='delete'><button>删除</button></span></td>
        </tr>";
        $i--;
    }
}