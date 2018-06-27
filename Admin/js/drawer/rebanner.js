/**
 * Created by Administrator on 2016/11/23.
 */
var vim;
$(document).ready(function () {
    vim = new Vue({
        el:"#model",
        data:{
            data:'',          //列数据
            mainid:''          //所有国家
        },
        ready:function () {
            observer.getModel();
            //获取国家
            api.getMaintype('mainid');
            //do something
            setClickEvent();
        },
        methods:{
            finish:function(){
                if(observer.helper.action == 'update'){
                    var classid = vim.data.classid;
                    if(classid != undefined){
                        $("#optionsClassid option[value='"+classid+"']").attr("selected",true);
                    }
                }
            },
            setMainid:function () {
                var mainid = vim.data.mainid;
                if(mainid != undefined){
                    $("#optionsMainid option[value='"+mainid+"']").attr("selected",true);
                }
            }
        },
        watch:{
            'data':'finish',
            'mainid':'setMainid'
        }
    });
});

function setClickEvent() {
    //更新发布时间
    timer.setDetailTimer('posttime');
    //更新预览图片
    api.uploadFile('picurl');
}
