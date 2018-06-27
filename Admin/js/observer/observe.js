/**
 * Created by joker on 2016/11/10.
 * 观察者，动态获取当前页面初始化几个信息：
 * 1）列表模式：model 模型集  field 搜索字段集  join 关联操作  where 搜索条件
 * page 当前页  pageNum 每页容量  order 排序
 * 2）详情模式：action 操作 model 模型  id 当前主键  field 搜索字段  join 关联操作 where 搜索条件
 */
//动态原型方式构造对象
var observer = new Observer();
function Observer(){
    //工具类，含有一些url参数
    this.helper = new Helper();

    this.model = this.helper.model;
    this.field = this.helper.field;
    this.join = this.helper.join;
    this.where = this.helper.where;
    this.page = this.helper.page;
    this.pageNum = this.helper.pageNum;
    this.order = this.helper.order;

    //绑定一些设置的参数
    //刷新初始模式
    if(Observer.prototype.reset == undefined){
        Observer.prototype.reset = function () {
            this.model = this.helper.model;
            this.field = this.helper.field;
            this.join = this.helper.join;
            this.where = this.helper.where;
            this.page = this.helper.page;
            this.pageNum = this.helper.pageNum;
            this.order = this.helper.order;
        }
    }

    if(Observer.prototype.resetPage == undefined) {
        Observer.prototype.resetPage = function () {
            this.page = this.helper.page;
        }
    }

    if(Observer.prototype.resetWhere == undefined) {
        Observer.prototype.resetWhere = function (where) {
            if(where == this.helper.where){
                this.where = this.helper.where;
            }
            //初始化条件，加最新条件
            if(this.helper.where != undefined && where != undefined){
                this.where = this.where+" and "+where;
            }else{
                this.where = where;
            }
            //alert(this.where);
        }
    }
    
    if(Observer.prototype.show == undefined){
        Observer.prototype.show = function(){
            console.log("Observer：model="+this.model+",field="+this.field+",join="+this.join
                +",where="+this.where+",page="+this.page +",pageNum="+this.pageNum+",order="+this.order);
        }
    }
    
    if(Observer.prototype.getList == undefined){
        Observer.prototype.getList = function () {
            var param = {
                'model':this.model,
                'field':this.field,
                'join':this.join,
                'where':this.where,
                'page':this.page,
                'pageNum':this.pageNum,
                'order':this.order
            };
            $.post(MyUrl+"index.php/Interface/getList",param,function (data) {
                //重设每页显示的条数
                $("#form_control option[value='"+param.pageNum+"']").attr("selected",true);
                if(data == 'false'){
                    vim.$set('list','');
                    vim.$set('pageAll',0);
                }else {
                    vim.$set('list',data.data);
                    vim.$set('pageAll',data.pageAll);
                }
            },'json');
        }
    }

    if(Observer.prototype.beforeCompile == undefined){
        Observer.prototype.beforeCompile = function () {
            this.helper.setListTool();
        }
    }

    if(Observer.prototype.compiled == undefined){
        Observer.prototype.compiled = function(){
            this.helper.setListTool2();
            //alert("aaa");
            iframeAutoHeight();
        }
    }

    if(Observer.prototype.getModel == undefined){
        Observer.prototype.getModel = function () {
            var param = {
                'model':this.model,
                'where':this.where
            };
            $.post(MyUrl+"index.php/Interface/getModel",param,function (data) {
                if(data == 'false'){
                    vim.$set('data','');
                }else {
                    vim.$set('data',data.data);
                    observer.modelCompiled();
                }
            },'json');
        }
    }

    if(Observer.prototype.modelCompiled == undefined){
        Observer.prototype.modelCompiled = function () {
            //do something...
            setRadio();
        }
    }
}
