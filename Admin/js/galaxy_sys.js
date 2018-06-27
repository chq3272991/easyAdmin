/**
 * Created by Administrator on 2016/10/31.
 */
$("document").ready(function(){
    init();
    Slide();
    /*iframeAutoHeight()*/
});

/* 左侧分类下拉菜单 */
function Slide(){
    $(".classify_h").click(function(){
        if($(this).siblings("ul").css("display")=="none"){
            $(this).siblings("ul").slideDown(1000);
            $(this).parent("div").css({"border-left":"4px solid #19a9d5"});
            $(this).children("b").removeClass("glyphicon-chevron-left");
            $(this).children("b").addClass("glyphicon-chevron-down");
        }else{
            $(this).siblings("ul").slideUp(1000);
            $(this).parent("div").css({"border-left":"none"});
            $(this).children("b").removeClass("glyphicon-chevron-down");
            $(this).children("b").addClass("glyphicon-chevron-left");
        }
    });

    /* a标签点击事件 */
    $("a").click(function(event){
        event.preventDefault();           //a标签阻止默认事件
        //alert($(this).attr("href"));
        //alert($(this).attr("href")+'&random='+Math.floor(Math.random()*100000) );
        $("a").css("color","");
        $(this).css("color","#7266ba");
        $("#R_iframe").attr("src",$(this).attr("href"));

    });
}

function init(){
    var _username =  $.cookie('galaxy_username');
    if(_username == undefined){
        window.location.href = MyUrl;  //返回登录页面
    }else{
        //提示层  展开首页工作台
        //layer.msg('通知提醒....');
    }
}







































