/**
 * Created by Administrator on 2016/11/10.
 * 一些共用的工具类helper,封装一些共用的操作，如setTool、openLayer；
 * 其他一些工具方法，不具有全局共用性的，不添加到helper里
 * <!--转义规则
 *   # 用来标志特定的文档位置 %23
 *  % 对特殊字符进行编码 %25
 *  & 分隔不同的变量值对 %26
 *  + 在变量值中表示空格 %2B
 *  \ 表示目录路径 %2F
 *  = 用来连接键和值 %3D
 *  ? 表示查询字符串的开始 %3F -->
 */
var timer = new Timer();
var api = new Api();
var helper = new Helper();
function Helper(){
    this.url = $(window.parent.document).find("#R_iframe").attr("src");  //列表url
    if(this.url == undefined){
        this.url = window.location.href;        //详情页url
    }
    //list
    this.model = getParamVals(this.url).model;  //underfined
    this.field = getParamVals(this.url).field;  //underfined
    this.join = getParamVals(this.url).join;    //underfined
    this.where = decodeUrl(getParamVals(this.url).where);  //如想构造where classid=14 ， 传递过来可能是classid%3D14,替换=为等
    this.page = getParamVals(this.url).page;   //underfined
    this.pageNum = getParamVals(this.url).pageNum;  //underfined
    this.order = getParamVals(this.url).order;  //underfined

    //detail
    this.action = getParamVals(this.url).action;

    //iframe
    this.iframe = $(window.parent.document).find("#R_iframe");
    //显示浏览器的屏幕的最大可用工作空间
    this.width = window.screen.availWidth;
    this.height = window.screen.availHeight;

    //设置列表一些操作工具
    if(Helper.prototype.setListTool == undefined){
        Helper.prototype.setListTool = function () {
            resetFrameHeight();
            setToolTop();
            timer.setListTimer();
        }
    }

    //文本渲染之后，重设列表左侧的选择框
    if(Helper.prototype.setListTool2 == undefined){
        Helper.prototype.setListTool2 = function () {
            toolAfer();
        }
    }

    //打开列表项详情页,参数id、操作action
    if(Helper.prototype.openLayer == undefined){
        Helper.prototype.openLayer = function (id,action) {
            //获取当前浏览器最大宽高
            var width = this.width *0.7+"px";
            var height = this.height *0.7+"px";
            console.log(width+"--"+height+",id="+id);
            layer.open({
                type: 2,
                title: '更多操作',
                skin: 'layui-layer-molv', //墨绿风格
                maxmin: true,
                shadeClose: true, //点击遮罩关闭层
                area : [width , height],
                content: 'showdetail?'+"action="+action+"&model="+this.model+'&where=id%3D'+id
            });
        }
    }

    if(Helper.prototype.closeLayer == undefined){
        Helper.prototype.closeLayer = function () {
            layer.closeAll('iframe');
        }
    }
}

/**
 * 一些取数据的接口
 * @constructor
 */
function Api(){
    // 获取所有国家类别
    if(Api.prototype.getMaintype == undefined){
        Api.prototype.getMaintype = function(key){
            //转换id -> value   classname ->hit
            var param = {'model':'maintype','pageNum':'0','field':'id as value,classname as hit'};
            $.post(MyUrl+"index.php/Interface/getList",param,function (data) {
                if(data == 'false'){
                    vim.$set(key,'');
                }else {
                    vim.$set(key,data.data);
                }
            },'json');
        }
    }

    //获取所有项目id和名称
    if(Api.prototype.getProjects == undefined){
        Api.prototype.getProjects = function(key){
            var param = {'model':'reimmiprogram','pageNum':'0','field':'projectid as value,ptitle as hit'};
            $.post(MyUrl+"index.php/Interface/getList",param,function (data) {
                if(data == 'false'){
                    vim.$set(key,'');
                }else {
                    vim.$set(key,data.data);
                }
            },'json');
        }
    }

    //update、add操作
    if(Api.prototype.iexecute == undefined){
        Api.prototype.iexecute = function () {
            //询问是否修改
            layer.confirm('您确定要修改？',{btn:['确定','取消'],skin: 'layui-layer-molv'},function () {
                var param = $("#form").serialize();
                $.post(MyUrl+"index.php/Interface/"+helper.action+"/"+helper.model,param,function (data) {
                    var status = data['status'];
                    if(status == '1'){
                        layer.msg('更新成功！', {icon: 1});
                        window.setTimeout(function () {
                            //关闭当前提出框，并刷新列表
                            window.parent.observer.helper.closeLayer();
                            window.parent.observer.getList();
                        },'1500');
                    }else{
                        layer.msg('更新失败！', {icon: 0});
                    }
                },'json');
            },function () {
                //取消操作
            });
        }
    }
    
    //uploadFile，上传图片
    if(Api.prototype.uploadFile == undefined){
        Api.prototype.uploadFile = function (obj) {
            $('#'+obj).click(function() {
                var editor = KindEditor.editor({
                    uploadJson : MyUrl+'index.php/Interface/uploadFile',
                    allowFileManager : true
                });
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        showRemote : false,
                        imageUrl : $(".cpicurl").val(),
                        //上传文件后执行的回调函数，获取上传图片的路径
                        clickFn : function(url, title, width, height, border, align) {
                            console.log(url);
                            $("input[name='"+obj+"']").val(url);
                            //刷新当前图片
                            $("#"+obj+"_img").attr("src","../../"+url);
                            editor.hideDialog();
                        }
                    });
                });
            });
        }
    }
    
    if(Api.prototype.getObscureInfo == undefined){
        Api.prototype.getObscureInfo = function () {
            var param = {'obscureid':vim.data.id};
            $.post(MyUrl+"index.php/Interface/getObscureInfo",param,function (data) {
                $(".more").css("display","block");
                vim.$set('more',data);
            },'json');
        }
    }
}

/**
 * laydate时间工具
 * @constructor
 */
function Timer(){
    this.t1 = "";  //YYYY/MM/DD hh:mm:ss
    this.t2 = "";  //YYYY/MM/DD hh:mm:ss

    //列表页时间区间选择
    if(Timer.prototype.setListTimer == undefined){
        Timer.prototype.setListTimer = function () {
            //设置时间区间选择
            laydate.skin('molv');  //加载皮肤，参数lib为皮肤名
            var start = {
                elem: '#start',
                format: 'YYYY/MM/DD hh:mm:ss',
                max: laydate.now(), //设定最大日期为当前日期
                //max: '2099-06-16 23:59:59', //最大日期
                istime: true,
                istoday: false,
                choose: function(datas){
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas //将结束日的初始值设定为开始日
                    timer.t1 = datas; //这里不能用this，this指向laydate对象
                    timer.search();
                }
            };
            var end = {
                elem: '#end',
                format: 'YYYY/MM/DD hh:mm:ss',
                max: laydate.now(),
                //max: '2099-06-16 23:59:59',
                istime: true,
                istoday: false,
                choose: function(datas){
                    start.max = datas; //结束日选好后，重置开始日的最大日期
                    timer.t2 = datas;  //这里不能用this，this指向laydate对象
                    timer.search();
                }
            };
            laydate(start);
            laydate(end);
        }
    }

    //详情页给时间戳设置点击响应时间
    if(Timer.prototype.setDetailTimer == undefined){
        Timer.prototype.setDetailTimer = function (elem) {
            laydate({
                elem: '#_'+elem, //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
                event: 'click', //响应事件。如果没有传入event，则按照默认的click
                format: 'YYYY/MM/DD hh:mm:ss',
                //max: laydate.now(),
                max: '2099-06-16 23:59:59',
                istime: true,
                istoday: true,
                choose: function(datas){     //这里有个bug，点击今天是不会触发choose方法，要点击确定
                    datas = new Date(datas).getTime()/1000;  //获得转换转换之后的时间戳
                    $('#'+elem).attr("value",datas);  //修改当前时间为当前时间
                }
            });
        }
    }

    if(Timer.prototype.search == undefined){
        Timer.prototype.search = function () {
           // alert(this.t1+"--"+this.t2);
            if(this.t1 != "" && this.t2 != ""){
                //end.start,start.max
                // start = start.replace(/-/g,'/'); // 将-替换成/，因为下面这个构造函数只支持/分隔的日期字符串
                var t1 = new Date(this.t1).getTime()/1000; // 构造一个日期型数据，值为传入的字符串，转换为时间戳
                var t2 = new Date(this.t2).getTime()/1000; // 构造一个日期型数据，值为传入的字符串，转换为时间戳
                //这里注意的是，php时间戳为10位（数据库存放的），js、java的时间戳为13位
                //一般数据库时间戳定义为posttime
                observer.resetPage();
                observer.resetWhere('galaxy_'+observer.model+".posttime between "+t1+" and "+t2);
                observer.getList();
            }
        }
    }
}

//解析url，对于where条件中特殊符号进行转义
function decodeUrl(str){
    if(str == undefined){
        return;
    }
    var rules = ['%23','%25','%26','%2B','%2F','%3D','%3F'];
    var vals = ['#','%','&','+','\\','=','?'];
    for(var i =0 ; i<rules.length ; i++){
        if(str.indexOf(rules[i]) != -1){
            return str.replace(rules[i],vals[i]);
        }
    }
}

/**
 * 传递url
 * @param url
 * @returns {{}}
 */
function getParamVals(url){
    var item,value,obj={},
        href=url,
        str=href.substr(href.lastIndexOf('?')+1),
        arr=str.split('&');
    for(var i=0;i<arr.length;i++){
        item=arr[i].split('=');
        obj[item[0]]=item[1];
    }
    return obj;
}

function toTime(date,n){
    var month,day,m,s;
    if(n==1){//如果n=1,返回日期+时间格式
        date= new Date(parseFloat(date));
        month=date.getMonth()+1;
        day=date.getDate();
        m=date.getMinutes();
        s=date.getSeconds();
        month=month<10?"0"+month:month;
        day=day<10?"0"+day:day;
        m=m<10?"0"+m:m;
        s=s<10?"0"+s:s;
        return date.getFullYear()+"/"+month+"/"+day+" "+date.getHours()+":"+m+":"+s;
    }
    if(n==2){//如果n=2,返回日期格式
        date= new Date(parseFloat(date));
        month=date.getMonth()+1;
        day=date.getDate();
        month=month<10?"0"+month:month;
        day=day<10?"0"+day:day;
        return date.getFullYear()+"-"+month+"-"+day;
    }
    if(n==3){//如果n=3,返回日期+时间，没有秒
        date= new Date(parseFloat(date));
        month=date.getMonth()+1;
        day=date.getDate();
        m=date.getMinutes();
        s=date.getSeconds();
        month=month<10?"0"+month:month;
        day=day<10?"0"+day:day;
        m=m<10?"0"+m:m;
        return date.getFullYear()+"-"+month+"-"+day+" "+date.getHours()+":"+m;
    }
}




