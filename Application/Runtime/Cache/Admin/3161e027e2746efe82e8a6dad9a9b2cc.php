<?php if (!defined('THINK_PATH')) exit();?><!--精确评估-->
<thead>
<tr>
    <th>选择</th>
    <th>id</th>
    <th>用户名</th>
    <th>手机</th>
    <th>邮箱</th>
    <th>项目</th>
    <th>是否通过</th>
    <th>完成时间</th>
    <th>来源</th>
    <th>平台</th>
    <th>更多操作</th>
</tr>
</thead>
<!-- 循环生成多个tboby -->
<tbody>
<tr v-for="item in list" class="tr_main">
    <td><div><input type="checkbox" name="input[]" value="{{item.id}}"/></div></td>
    <td name="id" default="0">{{item.id}}</td>
    <td name="username" default="1">{{item.username}}</td>
    <td name="mobile" default="2">{{item.mobile}}</td>
    <td>{{item.email}}</td>
    <td>{{item.project}}</td>
    <td>{{item.content}}</td>
    <td>{{item.posttime|time}}</td>
    <td>{{item.source}}</td>
    <td name="platform">{{item.platform}}</td>
    <td>
        <a class="handle_{{item.checkinfo}}" default="{{item.id}}" href="javascript:;"><i class="fa glyphicon glyphicon-pencil"></i>
            {{item.checkinfo|checkinfo}}
        </a>&nbsp;|&nbsp;
        <a class="detail" default="{{item.id}}" href="javascript:;" onclick="observer.helper.openLayer('{{item.id}}','read');return false;"><i class="fa glyphicon glyphicon-tasks"></i>
        详情
    </a></td>
</tr>
</tbody>