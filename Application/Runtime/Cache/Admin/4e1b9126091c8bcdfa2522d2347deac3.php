<?php if (!defined('THINK_PATH')) exit();?><form id="form">
    <table>
        <tbody class="detail">

        <tr>
            <td>id：</td>
            <td><input name="id" value="{{data.id}}" type="text" readonly="true"></td>
        </tr>

        <tr>
            <td>标题：</td>
            <td><input name="title" value={{data.title}}></td>
        </tr>

        <tr>
            <td>分类：</td>
            <td>
                <select name="classid" id="optionsClassid" disabled>
                    <option value="13">PC Banner</option>
                    <option value="42">H5 Banner</option>
                    <option value="14">项目Banner</option>
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
            <td>预览图：</td>
            <td>
                <img id="picurl_img" :src="'../../'+data.picurl" class="flag-img">
            </td>
            <td>
                <input id="picurl" value="上传" type="button" class="upload">
                <input name="picurl" value="{{data.picurl}}" type="text" style="display: none">
            </td>
        </tr>

        <tr>
            <td>链接:</td>
            <td><input name="linkurl" value="{{data.linkurl}}" type="text"></td>
        </tr>

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