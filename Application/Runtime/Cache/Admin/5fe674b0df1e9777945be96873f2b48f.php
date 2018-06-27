<?php if (!defined('THINK_PATH')) exit();?><thead>
<tr>
    <th>选择</th>
    <th>id</th>
    <th>用户名</th>
    <th>管理组</th>
    <th>登录时间</th>
    <th>登录IP</th>
    <th>是否审核</th>
    <th>更多操作</th>
</tr>
</thead>
<tbody v-for="item in list" class="tr_main">
<td><div><input type="checkbox" name="input[]" value="{{item.id}}"></div></td>
<td name="id" default="0">{{item.id}}</td>
<td name="username" default="1">{{item.username}}</td>
<td>{{item.levelname|admin_levelname}}</td>
<td>{{item.logintime|time}}</td>
<td>{{item.loginip}}</td>
<td>{{item.checkinfo}}</td>
<td>
    <a class="detail" default="{{item.id}}" href="javascript:;" onclick="observer.helper.openLayer('{{item.id}}','update');return false;"><i class="fa glyphicon glyphicon-tasks"></i>
        编辑</a>
</td>
</tbody>