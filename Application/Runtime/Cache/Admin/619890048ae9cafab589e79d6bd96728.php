<?php if (!defined('THINK_PATH')) exit();?><form id="form">
    <table>
        <tbody class="detail">
        <tr>
            <td>id：</td>
            <td><input name="id" value="{{data.id}}" type="text" readonly="true"></td>
        </tr>

        <tr>
            <td>栏目：</td>
            <td>
                <select name="classid" id="optionsClassid">
                    <option value="14">头条新闻</option>
                    <option value="15">银河快讯</option>
                    <option value="43">常见问题</option>
                    <option value="53">香港保险</option>
                    <option value="180">移民资讯</option>
                    <option value="181">当地教育</option>
                    <option value="182">移民政策</option>
                    <option value="183">移民生活</option>
                    <option value="184">税收福利</option>
                    <option value="190">活动讲座</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>所属国家</td>
            <td>
                <select name="mainid" id="optionsMainid">
                    <option value="-1">请选择</option>
                    <option v-for="item in mainid" value="{{item.value}}">{{item.hit}}</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>标题：</td>
            <td><input name="title" value="{{data.title}}" type="text"></td>
        </tr>

        <tr>
            <td>资讯置顶：</td>
            <td>
                <select name="flag" id="optionsFlag">
                    <option value="">默认</option>
                    <option value="z">置顶</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>文章来源：</td>
            <td><input name="source" value="{{data.source}}" type="text"></td>
        </tr>

        <tr>
            <td>作者：</td>
            <td><input name="author" value="{{data.author}}" type="text"></td>
        </tr>

        <tr>
            <td>缩略图：</td>
            <td>
                <img id="picurl_img" :src="'../../'+data.picurl" class="flag-img">
            </td>
            <td>
                <input id="picurl" value="上传" type="button" class="upload">
                <input name="picurl" value="{{data.picurl}}" type="text" style="display: none">
            </td>
        </tr>

        <tr>
            <td>关键词：</td>
            <td><textarea name="keywords" class="text200">{{data.keywords}}</textarea></td>
        </tr>

        <tr>
            <td>摘要：</td>
            <td><textarea name="description" class="text200">{{data.description}}</textarea></td>
        </tr>
        </tbody>

        <!--正文部分，独占一行-->
        <tbody class="content">
        <tr>
            <td>
                <textarea name="content">{{data.content}}</textarea>
            </td>
        </tr>
        </tbody>

        <tbody class="detail">
        <tr>
            <td>点击量:</td>
            <td><input name="hits" value="{{data.hits}}" type="text"></td>
        </tr>

        <tr>
            <td>排序:</td>
            <td><input name="orderid" value="{{data.orderid}}" type="text"></td>
        </tr>

        <tr>
            <td>发布时间:</td>
            <td>
                <input id="_posttime" class="laydate-icon"  value="{{data.posttime|_curtime}}">
                <input id="posttime"name="posttime" value="{{data.posttime|curtime}}" style="display: none">
            </td>
        </tr>

        <tr>
            <td>是否审核</td>
            <td>
                <input id="checked" type="radio" class="radiobtn" name="checkinfo" value="true">是
                <input id="check" type="radio"  class="radiobtn" name="checkinfo" value="false" checked>否
            </td>
        </tr>
        </tbody>
    </table>
</form>