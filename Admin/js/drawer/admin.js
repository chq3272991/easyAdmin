/**
 * Created by Administrator on 2016/11/23.
 */
var vim;
$(document).ready(function () {
    vim = new Vue({
        el:"#model",
        data:{
            data:'',          //列数据
        },
        ready:function () {
            observer.getModel();
            resetUI();
        },
        methods:{
            finish:function(){
                if(observer.helper.action == 'update'){
                    var levelname = vim.data.levelname;
                    $("#optionsLevelname option[value='"+levelname+"']").attr("selected",true);
                    setClickEvent();
                }
            }
        },
        watch:{
            'data':'finish'
        }
    });
});

function resetUI() {
    if(observer.helper.action == 'add'){
        $("#loginip").hide();
        $("#logintime").hide();
        //新建管理员
        $("#pwd").attr("name","password");
        //隐藏修改密码的按钮
        $("#resetPwd").hide();
    }
}

function setClickEvent() {
    //重设密码
    $("#resetPwd").click(function () {
        var pwd = $("#pwd").val();
        var id = vim.data.id;
        var param = {'id':id,'pwd':pwd};
        $.post(MyUrl+"index.php/Interface/resetPwd",param,function (data) {
            if(data=='true'){
                layer.msg('密码修改成功！');
            }else{
                layer.msg('当前密码与旧密码一致！');
            }
        });
    });
}
