/**
 * Created by Administrator on 2016/11/17.
 */
//恢复默认的窗口高度
function resetFrameHeight(){
    //重设当前窗口
    helper.iframe.ready(function () {
        helper.iframe.height(helper.height*0.9);
    });
}

/* 引入iframe高度 ，在被引入界面中加该代码*/
function iframeAutoHeight(){
    helper.iframe.ready(function () {
        var main = helper.iframe;
        var thisheight = $(document).height();
        main.height(thisheight);
    });
}

/**
 * 设置列表右上角的工具栏
 */
function setToolTop() {
    //设置右上角一些按钮事件
    $("#close").click(function(){
        $(this).parent("div").parent("div").siblings("div").slideUp();
        $("#chevron").children().removeClass("glyphicon-chevron-down");
        $("#chevron").children().addClass("glyphicon-chevron-up");
    });
    $("#chevron").click(function(){
        $(this).parent("div").parent("div").siblings("div").slideDown();
        $(this).children().removeClass("glyphicon-chevron-up");
        $(this).children().addClass("glyphicon-chevron-down");
    });
    $("#refresh").click(function () {
        //强制刷新
        $(window.parent.document).find("#R_iframe").attr("src",helper.url);
        // window.parent.getElementById('R_iframe').contentWindow.location.reload(true);
        // observer.reset();
        // observer.getList();
    });

    //设置每页容量
    $("#form_control").click(function(){
        if( $(this).val() != observer.pageNum){
            resetFrameHeight();
            observer.pageNum = $(this).val();
            observer.getList();
        };
    });

    //设置搜索
    $("#search").click(function () {
        //判断当前搜索框的分类
        var key = $("#optionsSearch").val();  //0:id  1:名称 2:手机 3:国家 4：分类
        var map = $("#optionsCondition").val(); //EQ  LIKE  EGT ELT
        var value = $("#searchCon").val();
        var where = "";
        //获取搜索框内容
        //判断设置了name属性的td，作为搜索的对象
        key = $(".tr_main").eq(0).find("td[default='"+key+"']").attr("name");

        if(map == 'like'){
            where += key +" "+map+"'%"+value+"%'";
        }else{
            where += key +" "+map+""+value+"";
        }
        if(key == undefined){
            layer.msg("无效搜索！");
        }else{
            //if like
            observer.resetPage();
            observer.resetWhere(where);
            observer.getList();
        }
    });
    //重置搜索
    $("#reset").click(function () {
        $("#searchCon").val("");
        observer.resetPage();
        observer.resetWhere(observer.helper.where);
        observer.getList();
    });
    
}

/* 左侧选择选择框 */
function toolAfer(){
    //左边勾选框
    $("input[type=checkbox]").each(function(){
        $(this).click(function(){
            if($(this).attr("checked")){
                $(this).attr("checked",false);
                $(this).parent().css({"width":"20px","height":"20px","background":"url('http://admin.galaxy-immi.com/Admin/img/check.png') no-repeat 0 0","background-size":"100% 100%"});
            }else{
                $(this).attr("checked",true);
                $(this).parent().css({"width":"20px","height":"20px","background":"url('http://admin.galaxy-immi.com/Admin/img/checked.png') no-repeat 0 0","background-size":"100% 100%"});
            }
        });
        if($(this).attr("checked")){
            $(this).parent().css({"width":"20px","height":"20px","background":"url('http://admin.galaxy-immi.com/Admin/img/checked.png') no-repeat 0 0","background-size":"100% 100%"});
        }else{
            $(this).parent().css({"width":"20px","height":"20px","background":"url('http://admin.galaxy-immi.com/Admin/img/check.png') no-repeat 0 0","background-size":"100% 100%"});
        }
    });

    //处理操作
    $(".handle_false").click(function () {
        var obj = $(this);
        var id = $(this).attr("default");
        var param = {'model':helper.model,'id':id};
        $.post(MyUrl+"index.php/Interface/setCheckInfo",param,function (data) {
            if(data == "true"){
                //提示层
                layer.msg('处理完成....');
                obj.attr("class","handle_true");
                var html = obj.html().replace('未处理','已处理');
                obj.html(html);
            }
        },'json');
    });

    //批量删除
    $(".delete").click(function () {
        var arr = [];
        //循环当前所有被选择的checkbox
        $("input[type=checkbox][checked]").each(function(){
            arr.push($(this).val());
        });
        if(arr.length == 0){
            layer.msg("请勾选需要删除的列表项");
            return false;
        }
        //询问是否确认删除，ids
        layer.confirm('您确定要删除所选列表项：'+arr, {
            btn: ['确定','取消'] //按钮
        }, function(){
            //确认删除操作
            var param = {'model':helper.model,'ids':arr};
            $.post(MyUrl+"index.php/Interface/delete",param,function (data) {
                var status = data['status'];
                if(status == '1'){
                    layer.msg('删除成功！', {icon: 1});
                    //刷新当前列表
                    observer.getList();
                }else{
                    layer.msg('删除失败！', {icon: 0});
                }
            },'json');

        }, function(){
            //清空勾选
        });
    });
}
