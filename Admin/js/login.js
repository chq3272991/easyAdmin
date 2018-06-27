/**
 * Created by Administrator on 2016/11/2.
 */
var user,pwd;
$("document").ready(function(){
    read();
    setClickEvent();
});

function read() {
    user = $("#username");
    pwd = $("#password");
    //读取cookie
    var _username =  $.cookie('galaxy_username');
    var _password =  $.cookie('galaxy_password');
    if( _username != 'null' ){
        user.val(_username);
    }
    if( _password != 'null' ){
        pwd.attr("type","password");
        pwd.val(_password);
    }
}

function setClickEvent() {
    user.bind('input propertychange', function() {
        //console.log($(this).val());
        if($("#remember").prop("checked")){
            $.cookie('galaxy_username',$(this).val(),{expires:7,path:'/'});    //cookie保存7天,cookie路径为网站的根目录
        }else {
            $.cookie('galaxy_username',$(this).val(),{expires:1,path:'/'});    //cookie保存7天,cookie路径为网站的根目录
        }
    });
    pwd.bind('input propertychange', function() {
        //console.log($(this).val());
        if($("#remember").prop("checked")){
            $.cookie('galaxy_password',$(this).val(),{expires:7,path:'/'});
        }else {
            $.cookie('galaxy_password',{expires:1,path:'/'});
        }
    });


    $("#remember").click(function () {
        if(this.checked) {
            //记录当前用户名和密码
            //记住密码
            var username = user.val();
            var password = pwd.val();
            $.cookie('galaxy_username',username,{expires:7,path:'/'});    //cookie保存7天,cookie路径为网站的根目录
            $.cookie('galaxy_password',password,{expires:7,path:'/'});
        } else {
            //只保存一天
            $.cookie('galaxy_username',username,{expires:1,path:'/'});    //cookie保存7天,cookie路径为网站的根目录
            $.cookie('galaxy_password',password,{expires:1,path:'/'});
        }
    });
}


























