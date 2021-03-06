<?php if (!defined('THINK_PATH')) exit();?><!--成功案例-->
<thead>
<tr>
    <th>选择</th>
    <th>id</th>
    <th>图片</th>
    <th>标题</th>
    <th>分类</th>
    <th>所属国家</th>
    <th>点击量</th>
    <th>排序</th>
    <th>发布时间</th>
    <th>预览</th>
    <th>是否审核</th>
    <th>查看详情</th>
</tr>
</thead>
<!-- 循环生成多个tboby -->
<tbody>
<tr v-for="item in list" class="tr_main">
    <td width="3%"><div><input type="checkbox" name="input[]" value="{{item.id}}"/></div></td>
    <td width="3%" name="id" default="0">{{item.id}}</td>
    <td width="7%"><img :src="'../../'+item.picurl" alt="" class="list-img" /></td>
    <td width="10%" name="title" default="1">{{item.title}}</td>
    <td width="3%">{{item.classid|rebanner_classid}}</td>
    <td width="3%" name="mainid" default="3">{{item.mainid|mainid}}[{{item.mainid}}]</td>
    <td width="3%">{{item.hits}}</td>
    <td width="3%">{{item.orderid}}</td>
    <td width="8%">{{item.posttime|time}}</td>
    <td width="3%"><a href="{{item.linkurl}}" target="_blank">链接</a></td>
    <td width="5%"><a class="handle_{{item.checkinfo}}" default="{{item.id}}" href="javascript:;"><i class="fa glyphicon glyphicon-pencil"></i>
        {{item.checkinfo|checkinfo}}
    </a></td>
    <td width="5%"><a class="detail" default="{{item.id}}" href="javascript:;" onclick="observer.helper.openLayer('{{item.id}}','update');return false;"><i class="fa glyphicon glyphicon-tasks"></i>
        编辑
    </a></td>
</tr>
</tbody>