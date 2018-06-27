/**
 * Created by Administrator on 2016/11/17.
 */
//定义一些基本的参数
var MyUrl = "http://admin.easyAdmin.com/";
//时间戳转 YYYY/mm/dd h:m:s
Vue.filter('time', function (value) {
    return toTime(value*1000,1);
});
//设置laydate默认显示的时间
Vue.filter('_curtime',function (value) {
    if(typeof(value) != 'underfined'){
        if(value.length < 10) {   //有效时间戳为10位或者13位
            var curtime = new Date().getTime();
            return toTime(curtime,1);
        }else {
            return toTime(value*1000,1);
        }
    }
});
//设置posttime字段要提交的时间戳
Vue.filter('curtime',function (value) {
    if(typeof(value) != 'underfined'){
        if(value.length < 10) {   //有效时间戳为10位或者13位
            var curtime = new Date().getTime()+"";
            return curtime.substring(0,10);
        }else {
            return value;
        }
    }
});
Vue.filter('checkinfo',function (value) {
    if(value == 'true'){
        return '已处理';
    }else {
        return '未处理';
    }
});

Vue.filter('infolist_classid',function (value) {
    if(value == '14'){
        return '头条新闻';
    }else if(value == '15'){
        return '银河快讯';
    }else if(value == '43'){
        return '常见问题';
    }else if(value == '53'){
        return '香港保险';
    }else if(value == '180'){
        return '移民资讯';
    }else if(value == '181'){
        return '当地教育';
    }else if(value == '182'){
        return '移民政策';
    }else if(value == '183'){
        return '移民生活';
    }else if(value == '184'){
        return '税收福利';
    }else if(value == '190'){
        return '活动讲座';
    }
});

Vue.filter('admin_levelname',function (value) {
    if(value=='1'){
        return '超级管理员';
    }else if(value=='2'){
        return '普通管理员';
    }
});
Vue.filter('mainid',function (value) {
    var countries = {'0':'不选择','1':'香港','2':'美国','3':'澳大利亚','5':'加拿大','6':'圣基茨','7':'匈牙利','8':'塞浦路斯','9':'葡萄牙','10':'西班牙'
    ,'11':'意大利','12':'希腊','15':'法国','16':'德国','21':'安提瓜'
    ,'22':'瓦努瓦图','23':'菲律宾','24':'爱尔兰','27':'马来西亚','28':'新西兰'};
    for(var i in countries){//用javascript的for/in循环遍历对象的属性
        if(value == i){
            console.log(countries[i]);
            return countries[i];
        }
    }
});


Vue.filter('rebanner_classid',function (value) {
    if(value=='13'){
        return 'PC Banner';
    }else if(value=='42'){
        return 'H5 Banner';
    }else if(value=='14'){
        return '项目Banner';
    }
});

Vue.filter('is',function (value) {
    if(value == 'true'){
        return '是';
    }else{
        return '否';
    }
});

