<?php if (!defined('THINK_PATH')) exit();?><form id="form">
    <table>
        <tbody class="detail">
        <tr>
            <td>id:</td>
            <td><input name="id" value="{{data.id}}" type="text" readonly="true"></td>
        </tr>
        <tr>
            <td>名字：</td>
            <td><input name="username" value="{{data.username}}" type="text"></td>
        </tr>
        <tr>
            <td>重设密码：</td>
            <td><input id="pwd" name="" value="" type="password"></td>
            <td><input id="resetPwd" value="重设密码" type="button"></td>
        </tr>
        <tr>
            <td>管理组：</td>
            <td><select name="levelname" id="optionsLevelname">
                <option value="1">超级管理员</option>
                <option value="2">普通管理员</option>
            </select></td>
        </tr>
        <tr>
            <td>是否审核：</td>
            <td>
                <input id="checked" type="radio" class="radiobtn" name="checkinfo" value="true">是
                <input id="check" type="radio"  class="radiobtn" name="checkinfo" value="false" checked>否
            </td>
        </tr>

        <tr id="logintime">
            <td>登录时间:</td>
            <td>{{data.logintime|time}}</td>
        </tr>
        <tr id="loginip">
            <td>登录ip：</td>
            <td>{{data.loginip}}</td>
        </tr>
        </tbody>
    </table>
</form>