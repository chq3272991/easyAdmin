<?php if (!defined('THINK_PATH')) exit();?><!--精确评估-->
<thead>
<tr>
    <th>选择</th>
    <th>id</th>
    <th>缩略图</th>
    <th>标题</th>
    <th>关键字</th>
    <th>概述</th>
    <th>所属国家</th>
    <th>分类</th>
    <th>发布时间</th>
    <th>浏览次数</th>
    <th>更多操作</th>
</tr>
</thead>
<!-- 循环生成多个tboby -->
<tbody>
<tr v-for="item in list" class="tr_main">
    <td width="3%"><div><input type="checkbox" name="input[]" value="{{item.id}}"/></div></td>
    <td width="3%" name="id" default="0">{{item.id}}</td>
    <td width="5%"><img :src="'../../'+item.picurl" alt="" class="list-img" /></td>
    <td width="10%" name="title" default="1">{{item.title}}</td>
    <td width="10%" name="keywords">{{item.keywords}}</td>
    <td width="12%" name="description"><p class="des">{{item.description}}</p></td>
    <td width="5%" name="mainid" default="3">{{item.mainid|mainid}}[{{item.mainid}}]</td>
    <td width="5%" name="classid" default="4">{{item.classid|infolist_classid}}[{{item.classid}}]</td>
    <td width="8%">{{item.posttime|time}}</td>
    <td width="5%">{{item.hits}}</td>
    <td width="8%">
        <a class="handle_{{item.checkinfo}}" default="{{item.id}}" href="javascript:;"><i class="fa glyphicon glyphicon-pencil"></i>
            {{item.checkinfo|checkinfo}}
        </a>&nbsp;|&nbsp;
        <a class="detail" default="{{item.id}}" href="javascript:;" onclick="observer.helper.openLayer('{{item.id}}','update');return false;"><i class="fa glyphicon glyphicon-tasks"></i>
            编辑
        </a>
    </td>
</tr>
</tbody>