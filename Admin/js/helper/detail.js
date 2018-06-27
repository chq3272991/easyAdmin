/**
 * Created by Administrator on 2016/11/17.
 */
function initEditor(name) {
    //获取form表单的宽高:
    var editor = KindEditor.create("textarea[name='"+name+"']", {
        width : $("#form").width()*0.8,
        height: 500,
        uploadJson : MyUrl+'index.php/Interface/uploadFile',
        allowFileManager : true,
        afterBlur: function () {
            this.sync();
        }
    });
}

//设置单选框
function setRadio(){
    var obj = $("#checked");
    if(obj != undefined){
        console.log('checkinfo init...');
        if(vim.data.checkinfo == 'true'){
            $("#checked").attr("checked","checked");
            $("#check").removeAttr("checked");
        }else{
            $("#check").attr("checked","checked");
        }
    }
}