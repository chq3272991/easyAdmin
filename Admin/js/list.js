/**
 * Created by Administrator on 2016/11/10.
 * 列表页构造器模板
 */
var vim;
$(document).ready(function () {
    vim = new Vue({
        el:"#list",
        data:{
            pageAll:'',        //总页数
            list:''          //列数据
        },
        ready:function () {
            observer.beforeCompile();
            observer.getList();
        },
        methods:{
            finish:function(){
                observer.compiled();
            },
            changePage:function () {
                iframeAutoHeight();  //当前页面总数变化，说明每页容量变化，需要改变高度
                //alert("总页数："+vim.allpage);
                //去除当前分页的对象，重新生成
                $("#pageDiv").html("<div class='tcdPageCode'></div>");
                $(".tcdPageCode").createPage({
                    pageCount:vim.pageAll,
                    current:1,
                    backFn:function(p){
                        // alert("当前请求页码："+p+"，当前每页数量："+pageNum);
                        observer.page = p;
                        observer.getList();
                    }
                });
            }
        },
        watch:{
            'list':'finish',
            'pageAll':'changePage'
        }
    });
});
