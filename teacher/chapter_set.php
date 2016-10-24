<?php
include_once '../include.php';
$user_id=$_SESSION['userId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="common/chapter_set.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div>
    <div id="title_course"><p>已开课程</p></div>


    <div id="course_list">
        <table id="table_a" cellpadding="0px" cellspacing="0px">
            <tr class="line1">
                <th>编号</th>
                <th>课程名称</th>
                <th>开课时间</th>
                <th>对应班级</th>
                <th>操作</th>
            </tr>
            <tr class="line2">
                <td>1</td>
                <td>《数据结构》</td>
                <td>2016-3-24</td>
                <td></td>
                <td class="delete_course">申请退课</td>
                <td class="display_none c_id"></td>
            </tr>
        </table>
    </div>

    <div id="title_chapter"><p>章节设置</p></div>
    <div id="set_area">
        <div class="course_op">
            <label><select id="select1" size=1 style="height: 27px"><!--改动-->
                <option selected="selected" disabled="disabled" value='0'>-请选择课程-</option>
            </select></label>
        </div>

        <div id="m_chapter">
            <p>修改章</p>
        </div>

        <div id="add_chapter">
            <p>添加章</p>
        </div>

        <div id="area_find">
        <div id="section_area">
        </div>
        </div>

        <div class="popup display_none" id="popup"></div>

        <div class="popup display_none" id="popup_loading"></div>

        <div class="display_none" id="loading"><img src="../teacher/common/image/loading.gif"></div>

        <div id="course_set" class="display_none"><img class="close" src="../teacher/common/image/close.png">
            <a class="a1">课程名：</a>
            <label><select size="1" style="height: 27px" id="select_course">
            </select></label>
            <a class="a2">请选择班级：</a>

            <label><select size="1" style="height: 27px" id="select_class">
            </select></label>

            <a class="a3">课程简介：</a>
            <label><textarea></textarea></label>

            <div id="submit3"><a>开课</a></div>
        </div>

        <div id="chapter_set" class="display_none"><img class="close" src="../teacher/common/image/close.png">
            <a class="a1">章号 :</a>

            <div class="chapter_input"><label>第<input class="border_none" id="chapter_input"  size= "2" type = "number" min="1" max="10" value="1~100">章</label>
                <hr>
            </div>
            <a class="a2">请输入章名 :</a>

            <div class="chapter_input"><label><input id="ch_name" class="border_none" type="text"></label>
                <hr>
            </div>
            <div id="submit1"><a>提交</a></div><a id="mode" class="display_none"></a>
            <a id="chapter" class="display_none"></a>
        </div>

        <div id="section_set" class="display_none"><img class="close" src="../teacher/common/image/close.png">
            <a class="a1">节号 :</a>

            <div class="section_input"><label>第<input class="border_none" id="section_input"  size= "2" type = "number" min="1" max="10" value="1~100">节</label>
                <hr>
            </div>
            <a class="a2">请输入节名 :</a>

            <div class="section_input"><label><input id="section_name" class="border_none" type="text"></label>
                <hr>
            </div>
            <div id="submit2"><a>提交</a></div><a id="mode_judge" class="display_none"></a>
            <a id="chapter_judge" class="display_none"></a><a id="section_judge" class="display_none"></a><a id="ch_num" class="display_none"></a>
        </div>

    </div>
</div>
<script type="" src="../JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#area_find").on("click", ".extend", function () {
            $(this).addClass("display_none");
            $(this).next(".shrink").removeClass("display_none");
            $(this).nextAll(".section").slideDown(500);
        });
    });
    $(function () {
        $("#area_find").on("click", ".shrink", function () {
            $(this).addClass("display_none");
            $(this).prev(".extend").removeClass("display_none");
            $(this).nextAll(".section").slideUp("slow");
        });
    });
    $(function () {
        $("#add_course").click(function () {
            $("#popup").fadeIn("slow");
            $("#course_set").fadeIn("slow");
        });
        $("#course_list").on("click",".delete_course",function(){
            var user_id = <?php echo $user_id; ?>;
            var c_id = $(this).parent().find(".c_id").text();
            a_d_course(2,user_id,c_id,"","","","","","");
        });

        $("#m_chapter").click(function(){
            alert("点击章名可进行修改");
        });

        $("#add_chapter").click(function () {
            if($("#select1").val() != null) {
                $("#mode").text("1");
                $("#popup").fadeIn("slow");
                $("#chapter_set").fadeIn("slow");
            }
            else {
                alert("请先选择课程");
            }
        });

        $("#set_area").on("click",".m_chapter",function(){
            $("#chapter_input").val($(this).parent().find(".ch_num:first").text());
            $("#ch_name").val($(this).parent().find(".chapter_name:first").text());
            $("#chapter").text($(this).parent().find(".ch_id:first").text());
            $("#mode").text("2");
            $("#popup").fadeIn("slow");
            $("#chapter_set").fadeIn("slow");
        });

        $("#area_find").on("click", ".add_section", function () {
            $("#popup").fadeIn("slow");
            $("#section_set").fadeIn("slow");
            var num1 = $(this).prev().find(".chapter_id:first").text();
            var num2 = $(this).prev().find(".ch_num:first").text();
            $("#chapter_judge").text(num1);//章id
            $("#ch_num").text(num2);
            $("#mode_judge").text("1");//添加
        });
    });
    $(function(){
        $("#area_find").on("click", ".modify", function(){
            $("#popup").fadeIn("slow");
            $("#section_set").fadeIn("slow");
            $("#section_input").val( $(this).parent().parent().find(".sec_num").text());
            $("#section_name").val( $(this).parent().parent().find(".sec_name").text());
            $("#chapter_judge").text($(this).parent().parent().parent().find(".chapter_id").text());
            $("#section_judge").text($(this).parent().parent().find(".section_id").text());
            $("#ch_num").text($(this).parent().parent().parent().find(".ch_num").text());
            $("#mode_judge").text("2");//修改
        })
    });
    $(function () {
        $("#chapter_input").keyup(function () {//控制数字输入
            $(this).val($(this).val().replace(/D|^0/g, ''));
        }).bind("paste", function () {  //CTR+V事件处理
            $(this).val($(this).val().replace(/D|^0/g, ''));
        }).css("ime-mode", "disabled"); //CSS设置输入法不可用

        $("#section_input").keyup(function () {
            $(this).val($(this).val().replace(/D|^0/g, ''));
        }).bind("paste", function () {  //CTR+V事件处理
            $(this).val($(this).val().replace(/D|^0/g, ''));
        }).css("ime-mode", "disabled"); //CSS设置输入法不可用
    });
    $(function(){
        $("#submit1").click(function(){
            var mode = $("#mode").text();
            var ch_num = $("#chapter_input").val();
            var ch_name = $("#ch_name").val();
            var ch_id = $("#chapter").text();
            var c_id = $("#select1").val();
            a_m_ch(mode,ch_num,ch_name,ch_id,c_id);
        })
    });
    $(function(){
        $("#submit2").click(function () {
            var mode = $("#mode_judge").text();
            var sec_num = $("#section_input").val();
            var sec_name = $("#section_name").val();
            var sec_id = $("#section_judge").text();
            var ch_id = $("#chapter_judge").text();
            var ch_num = $("#ch_num").text();
            a_m_d_sec(mode, sec_num, sec_name, sec_id, ch_id, ch_num);
        });
        $("#area_find").on("click", ".delete", function () {
            var sec_id = $(this).parent().parent().find(".section_id").text();
            var ch_id = $(this).parent().parent().parent().find(".chapter_id").text();
            var ch = $(this).parent().parent().parent().find(".ch_num").text();
            var msg = confirm("确认删除？删除后本节对应文件也会全部删除");
            if(msg) {
                a_m_d_sec("3", "", "", sec_id, ch_id, ch);
            }
            else{
                return false;
            }
        });
    });
    $(function(){
        $(".close").click(function () {
            $("#popup").fadeOut("slow");
            $(this).parent().fadeOut("slow");
        });
    });
    $(function () {
        $(function () {
            var user_id =<?php echo $user_id; ?>;
            update_course(1,user_id);
            update_course(2,user_id);
            update_course(3,user_id);
        });
    });

    $(function () {
        $(".course_op").on("change", "#select1", function () {
            var val = $(this).val();
            update_chapter(1,val);//1代表更新章，2代表更新节
        });
    });

    function a_m_ch(mode,ch_num,ch_name,ch_id,c_id){
        var $html="";
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "chapter_set/a_m_ch.php",
            data: "mode=" + mode +"&ch_num=" + ch_num +"&ch_name=" + ch_name + "&ch_id=" + ch_id + "&c_id=" + c_id,
            async:false,
            success: function (data) {
                var array = JSON.parse(data);
                if(array['judge'] == 1){
                    if(mode == 1){
                        $html = $html + "<div class='chapter'><img src='../teacher/common/image/catalogue.png'>&nbsp;&nbsp;<a class='chapter_num m_chapter' id='chapter" + ch_num + "'>第" + ch_num +"章(" + ch_name +")" + "</a>" +"<a class='display_none ch_id' id='ch"+ ch_num +"'>"+ array['ch_id'] +"</a>"+
                                "<a class='display_none chapter_name'>"+ ch_name + "</a>" + "<a class='display_none ch_num'>"+ ch_num + "</a>" +
                                "<div class='sign extend'>+</div><div class='sign shrink display_none'>—</div><hr><div class='section display_none'><ul><a class='display_none chapter_id'>" + array['ch_id'] + "</a><a class='display_none ch_num' id='ch_num"+ ch_num +"'>" + ch_num + "</a>" +
                                "</ul><div class='add_section'><a>添加</a></div><br><br></div></div>";
                        $($html).appendTo("#section_area");
                        $("#chapter_set").fadeOut("slow");
                        $("#popup").fadeOut("slow");
                    }
                    else if(mode == 2){
                        alert("修改成功");
                        $("#chapter" + ch_num).text("第" + ch_num + "章(" + ch_name +")");
                        $("#chapter_set").fadeOut("slow");
                        $("#popup").fadeOut("slow");
                    }
                    else{
                        alert("发生未知错误");
                    }
                }
                else{
                    if(mode == 1){
                        alert("添加失败");
                    }
                    else if(mode == 2){
                        alert("修改失败");
                    }
                    else{
                        alert("发生未知错误");
                    }
                }
            }
        });
    }

    function a_m_d_sec(mode,sec_num,sec_name,sec_id,ch_id,ch){
        var $html="";
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "chapter_set/a_m_d_sec.php",
            data: "mode=" + mode +"&sec_num=" + sec_num +"&sec_name=" + sec_name + "&sec_id=" + sec_id + "&ch_id=" + ch_id,
            async:false,
            success: function (data) {
                if(data == 1){
                    if(mode == 1){
                        alert("添加成功");
                        $("#section_set").fadeOut("slow");
                        $("#popup").fadeOut("slow");
                    }
                    else if(mode == 2){
                        alert("修改成功");
                        $("#section_set").fadeOut("slow");
                        $("#popup").fadeOut("slow");
                    }
                    else if(mode == 3){
                        alert("删除成功");
                    }
                    else{
                        alert("发生未知错误");
                    }
                }
                else{
                    if(mode == 1){
                        alert("添加失败");
                    }
                    else if(mode == 2){
                        alert("修改失败");
                    }
                    else if(mode == 3){
                        alert("删除失败");
                    }
                    else{
                        alert("发生未知错误");
                    }
                }
                $html = $html + update_section(1,2, ch_id, ch);
                $("#ch_num" + ch).parent().parent().replaceWith($html);
            }
        });
    }

    function a_d_course(mode,user_id,c_id,c_name,class_a,class_b,class_c,class_d,c_info){
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "chapter_set/a_d_course.php",
            data: "mode=" + mode + "&user_id=" + user_id + "&c_id=" + c_id + "&c_name" + c_name + "&class_a=" + class_a + "&class_b="+ class_b + "&class_c=" + class_c + "&class_d=" + class_d + "&c_info=" + c_info,
            beforeSend : function(){
                $("#popup_loading").fadeIn("slow");
                $("#loading").fadeIn("slow");
            },
            success: function (data) {
                update_course(2,user_id);
                update_course(3,user_id);
                $("#popup_loading").fadeOut("slow");
                $("#loading").fadeOut("slow");
            }
        })
    }

    function update_course(mode,user_id) {
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "chapter_set/load_course.php",
            data: "user_id=" + user_id,
            success: function (data) {

                var array = JSON.parse(data);
                var $html = "";
                var $i;
               /* if(mode == 1)//开课取消，此功能移到了管理员平台
                {
                    $html = $html + "<select size='1' style='height: 27px'><option selected='selected' disabled='disabled' value='0'>-请选择课程-</option>";
                    for($i = 0; $i < array[0]['c_amount']; $i++) {
                        $html = $html + "<option value='" + array[$i]['id'] + "'>" + array[$i]['c_name'] + "</option>";
                    }
                    $html = $html + "</select>";
                    $("#course_set").find("#select_course").replaceWith($html);
                }*/
                if(mode == 2){//课程列表

                    $html = $html + "<select id='select1' size=1 style='height: 27px'><option selected='selected' disabled='disabled' value='0'>-请选择课程-</option>";
                    for($i = 0; $i < array[0]['c_amount']; $i++) {
                        $html = $html + "<option value='" + array[$i]['id'] + "'>" + array[$i]['c_name'] + "</option>";
                    }
                    $html = $html + "</select>";
                    $(".course_op").find("select").replaceWith($html);
                }
                else if(mode == 3){//章节设置的课程选择

                    $html = $html + "<table id='table_a' cellpadding='0px' cellspacing='0px'><tr class='line1'>"+
                            "<th>编号</th><th>课程名称</th><th>开课时间</th><th>对应班级</th> <th>操作</th></tr>";
                    var $num;
                    for($i = 0; $i < array[0]['c_amount']; $i++) {
                        if($i%2 == 0){
                            $num = 2;
                        }
                        else{
                            $num = 1;
                        }
                        $html = $html + "<tr class='line" + $num + "'><td>" + ($i+1) + "</td><td>《" + array[$i]['c_name'] + "》</td><td>" + array[$i]['c_time'] + "</td><td>"+ array[$i]['classA_name']+ ' '+array[$i]['classB_name'] +' '+array[$i]['classC_name']+' '+ array[$i]['classD_name']+"</td> " +
                                "<td class = 'delete_course'> 申请退课 </td><td class='display_none c_id'>" + array[$i]['id'] +"</td></tr> ";
                    }
                    $html = $html +"</table>";
                    $("#table_a").replaceWith($html);
                    alert(1);
                }
            }
        })
    }

    function update_chapter(mode,c_id) {//更新章
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "chapter_set/load_ch_sec.php",
            data: "mode=" + mode + "&id=" + c_id,
            beforeSend : function(){
                $("#popup_loading").fadeIn("slow");
                $("#loading").fadeIn("slow");
            },
            success: function (data) {
                var array = JSON.parse(data);
                var $html = "";
                /*var $html1 = "";*/
                $html = $html + "<div id='section_area'>";
                for (var $i = 0; $i < array[0]['ch_amount']; $i++) {
                    $html = $html + "<div class='chapter'><img src='../teacher/common/image/catalogue.png'>&nbsp;&nbsp;<a class='chapter_num m_chapter' id='chapter" + array[$i]['ch_num'] + "'>第" + array[$i]['ch_num'] +"章("+ array[$i]['ch_name']+")" + "</a>" +"<a class='display_none ch_id' id='ch"+ array[$i]['ch_num'] +"'>"+ array[$i]['id'] +"</a>"+
                            "<a class='display_none chapter_name'>"+ array[$i]['ch_name'] + "</a>" + "<a class='display_none ch_num'>"+ array[$i]['ch_num'] + "</a>" +
                            "<div class='sign extend'>+</div><div class='sign shrink display_none'>—</div><hr>";
                    $html = $html + update_section(2,2,array[$i]['id'],array[$i]['ch_num']) + "</div>";//1代表更新章，2代表更新节
                }
                $html = $html + "</div>";
                $("#section_area").replaceWith($html);
                $("#popup_loading").fadeOut("slow");
                $("#loading").fadeOut("slow");
            }
        });
    }

    function update_section(act,mode,ch_id,ch) {//更新节
        var $html = "";
        $.ajax({
            datatype: "json",
            type: "POST",
            url: "chapter_set/load_ch_sec.php",
            data: "mode=" + mode + "&id=" + ch_id,
            async:false,
            success: function (data) {
                var array = JSON.parse(data);
                if(act == 2) {
                    $html = $html + "<div class='section display_none'><ul><a class='display_none chapter_id'>" + ch_id + "</a><a class='display_none ch_num' id='ch_num"+ ch +"'>" + ch + "</a>";
                }
                else if(act == 1){
                    $html = $html + "<div class='section'><ul><a class='display_none chapter_id'>" + ch_id + "</a><a class='display_none ch_num' id='ch_num"+ ch +"'>" + ch + "</a>";
                }
                else{
                }
                for (var $i = 0; $i < array[0]['sec_amount']; $i++) {
                    $html = $html + "<li><a class='section_name'>>_" + ch + "-" + ($i+1) + "第" + array[$i]['sec_num'] + "节(" + array[$i]['sec_name'] + ")" + "</a><a class='display_none section_id'>"+ array[$i]['id'] + "</a>" +
                            "<a class='display_none sec_num'>" + array[$i]['sec_num'] + "</a><a class='display_none sec_name'>"+ array[$i]['sec_name'] + "</a>" +
                            "<div class='m_d'><a class='modify'>修改</a>/<a class='delete'>删除</a></div></li>";
                }
                $html = $html + "</ul><div class='add_section'><a>添加</a></div><br><br></div>";
            }
        });
        return $html;
    }
</script>
</body>
</html>
