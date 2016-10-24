$(function(){
    //重新加载时数据

    //var chapter_id= $("#chapter1").val();
    //var course_id= $("#course1").val();
    //var type=$("#type").val();
    //$.ajax({
    //        datatype: "json",
    //        type: "POST",
    //        url: "first.php",
    //        data: "chapter=" + chapter_id +"&course="+course_id+"&type="+type,
    //        success: function (data) {
    //            var arry= JSON.parse(data);
    //            var num=arry[0]["num"];
    //            var i=0;
    //            $("#table").html(null);
    //            var header= "<th>"+"类型"+"</th><th>"+"题目"+"</th><th>"+"录入时间"+"</th><th>"+"操作"+"</th>";
    //            $("#table").append(header);
    //            if(arry[0]['type']==1){
    //                for(i;i<num;i++){
    //                    var html= "<tr class='type1'><td style='border:1px solid white'>"+"选择题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
    //                    $("#table").append(html);
    //                }
    //            }
    //            if(arry[0]['type']==2){
    //                for(i;i<num;i++){
    //                    var html= "<tr class='type2'><td style='border:1px solid white'>"+"填空题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
    //                    $("#table").append(html);
    //                }
    //            }
    //            if(arry[0]['type']==3){
    //                for(i;i<num;i++){
    //                    var html= "<tr class='type3'><td style='border:1px solid white'>"+"简答题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
    //                    $("#table").append(html);
    //                }
    //            }
    //        }
    //    }
    //)
    //课程变化时页码数据
    $("#course1").on("change", function () {
        var course_id= $("#course1").val();
        document.cookie="course_id="+course_id;
    });
    //类型变化时数据
    $("#type").on("change",function(){
        var chapter_id= $("#chapter1").val();
        var course_id= $("#course1").val();
        var type=$("#type").val();
        document.cookie="showtype="+type;
        $.ajax({
                datatype: "json",
                type: "POST",
                url: "doTeacherAction.php",
                data: "chapter=" + chapter_id +"&course="+course_id+ "&act=" + "getPage"+"&type="+type,
                success: function (data) {
                    var array = JSON.parse(data);
                    $("ul").html(array['html']);
                    document.cookie="pageall="+array['pageall'];
                }
            }
        );
        $.ajax({
                datatype: "json",
                type: "POST",
                url: "first.php",
                data: "chapter=" + chapter_id +"&course="+course_id+"&type="+type,
                success: function (data) {
                    var arry= JSON.parse(data);
                    var num=arry[0]["num"];
                    var i=0;
                    $("#table").html(null);
                    var header= "<th>"+"类型"+"</th><th>"+"题目"+"</th><th>"+"录入时间"+"</th><th>"+"操作"+"</th>";
                    $("#table").append(header);
                    if(arry[0]['type']==1){
                        for(i;i<num;i++){
                            var html= "<tr class='type1'><td style='border:1px solid white'>"+"选择题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
                            $("#table").append(html);
                        }
                    }
                    if(arry[0]['type']==2){
                        for(i;i<num;i++){
                            var html= "<tr class='type2'><td style='border:1px solid white'>"+"填空题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
                            $("#table").append(html);
                        }
                    }
                    if(arry[0]['type']==3){
                        for(i;i<num;i++){
                            var html= "<tr class='type3'><td style='border:1px solid white'>"+"简答题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
                            $("#table").append(html);
                        }
                    }
                }
            }
        )
    });
    //章节变化时数据
    $("#chapter1").on("change",function(){
        var chapter_id= $("#chapter1").val();
        var course_id= $("#course1").val();
        document.cookie="chapter="+chapter_id;
        var type=$("#type").val();
        $.ajax({
                datatype: "json",
                type: "POST",
                url: "doTeacherAction.php",
                data: "chapter=" + chapter_id +"&course="+course_id+ "&act=" + "getPage"+"&type="+type,
                success: function (data) {
                    var array = JSON.parse(data);
                    $("ul").html(array['html']);
                    document.cookie="pageall="+array['pageall'];
                }
            }
        );
        $.ajax({
                datatype: "json",
                type: "POST",
                url: "first.php",
                data: "chapter=" + chapter_id +"&course="+course_id+"&type="+type,
                success: function (data) {
                    var arry= JSON.parse(data);
                    var num=arry[0]["num"];
                    var i=0;
                    $("#table").html(null);
                    var header= "<th>"+"类型"+"</th><th>"+"题目"+"</th><th>"+"录入时间"+"</th><th>"+"操作"+"</th>";
                    $("#table").append(header);
                    if(arry[0]['type']==1){
                        for(i;i<num;i++){
                            var html= "<tr class='type1'><td style='border:1px solid white'>"+"选择题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
                            $("#table").append(html);
                        }
                    }
                    if(arry[0]['type']==2){
                        for(i;i<num;i++){
                            var html= "<tr class='type2'><td style='border:1px solid white'>"+"填空题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
                            $("#table").append(html);
                        }
                    }
                    if(arry[0]['type']==3){
                        for(i;i<num;i++){
                            var html= "<tr class='type3'><td style='border:1px solid white'>"+"简答题"+"</td> <td style='border:1px solid white'>"+arry[i]['title']+"</td><td style='border:1px solid white'>"+arry[i]['time']+"</td> <td style='border:1px solid white'><span class='edit'><button class='modify'value="+arry[i]['id']+">"+"修改"+"</button></span><span class='delete'><button class='del' value="+arry[i]['id']+">"+"删除"+"</button></span></td> </tr>";
                            $("#table").append(html);
                        }
                    }
                }
            }
        )
    });
    //题目修改时显示
    $("#table").on("click",".modify",function() {/*动态效果*/
        var id = $(this).val();
        var type=$(this).parent().parent().parent().attr("class");
        document.cookie="Question_id="+id;
        switch(type)
        {
            case "type1":
                $.ajax({
                        datatype: "json",
                        type: "POST",
                        url: "doTeacherAction.php",
                        data: "Question_id=" + id + "&act=" + "modifyQuestion1",
                        success: function (data) {
                            var array = JSON.parse(data);
                            $(".popup").fadeIn(800);
                            $("#content").fadeIn(800);
                            $("#title").find(".text_box").val(array['title']);
                            $("#A").find(".text_box").val(array['option_A']);
                            $("#B").find(".text_box").val(array['option_B']);
                            $("#C").find(".text_box").val(array['option_C']);
                            $("#D").find(".text_box").val(array['option_D']);
                            $("#T").find(".modify_t").val(array['answer']);
                            $("#upfile0").val(array['T_R_image']);
                            $("#upfile1").val(array['A_R_image']);
                            $("#upfile2").val(array['B_R_image']);
                            $("#upfile3").val(array['C_R_image']);
                            $("#upfile4").val(array['D_R_image']);
                        }
                    }
                );
                break;
            case "type2":
                $.ajax({
                        datatype: "json",
                        type: "POST",
                        url: "doTeacherAction.php",
                        data: "Question_id=" + id + "&act=" + "modifyQuestion2",
                        success: function (data) {
                            var array = JSON.parse(data);
                            $(".popup").fadeIn(800);
                            $("#content1").fadeIn(800);
                            $("#title1").find("textarea").val(array['gap_title']);
                            $("#answer1").find("textarea").val(array['gap_answer']);
                            $("#upfile5").val(array['Title_R_image']);
                            $("#upfile6").val(array['Answer_R_image']);


                        }
                    }
                );
                break;
            case "type3":
                $.ajax({
                        datatype: "json",
                        type: "POST",
                        url: "doTeacherAction.php",
                        data: "Question_id=" + id + "&act=" + "modifyQuestion3",
                        success: function (data) {
                            var array = JSON.parse(data);
                            $(".popup").fadeIn(800);
                            $("#content2").fadeIn(800);
                            $("#title2").find("textarea").val(array['short_title']);
                            $("#answer2").find("textarea").val(array['short_answer']);
                            $("#upfile7").val(array['Title_R_image']);
                            $("#upfile8").val(array['Answer_R_image']);

                        }
                    }
                );
                break;
        }
    });
    //题目修改提交时做限制判断
    $("#myform1,#myform2,#myform3").submit(function(){
        var $title0=$("#modify_title0").val();
        var $answer0=$("#modify_answer0").val();
        var $title1=$("#modify_title1").val();
        var $answer1=$("#modify_answer1").val();
        var $title2=$("#modify_title2").val();
        var $answer2=$("#modify_answer2").val();
        if($title0==""&&$title1==""&&$title2==""){
            alert("题目不能为空！");
            return false;
        }else if($answer0==""&&$answer1==""&&$answer2==""){
            alert("答案不能为空！");
            return false;
        }else{
            return true;
        }
    });

    //题目删除
    $("#table").on("click",".del",function() {
        if(confirm("确认要删除此题吗？")) {
            var id = $(this).val();
            var type = $(this).parent().parent().parent().attr("class");
            $.ajax(
                {
                    dataType: "json",
                    type: "POST",
                    url: "doTeacherAction.php",
                    data: "Question_id=" + id + "&act=" + "deleteQuestion" + "&type=" + type,
                    success: function (){
                    }
                }
            );
            $(this).parent().parent().parent().remove();
        }
    });
//修改close按钮
    $(".close_modify").on("click",function(){
        $(".popup").fadeOut(800);
        $(".content_modify").fadeOut(800);
    });

    //填空题添加空格按钮
    $("#fill_blank").bind("click",function(){
        $('#title1 textarea').val($('#title1 textarea').val()+'_____');
    });
    $("#fill_answer").bind("click",function(){
        $('#answer1 textarea').val($('#answer1 textarea').val()+'_____');
    });

});
