<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>详情页</title>
    <link rel="stylesheet" href="/Admin/css/detail.css?v=20161129" />
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/Admin/temps/laydate/laydate.js"></script>
    <script src="/Admin/temps/layer/layer.js"></script>
    <script src="/Admin/js/tools/vue.js"></script>
    <script src="/Admin/js/init.js"></script>

    <link rel="stylesheet" href="/Admin/temps/kindeditor/themes/default/default.css" />
    <script src="/Admin/temps/kindeditor/kindeditor.js"></script>
    <script src="/Admin/temps/kindeditor/lang/zh_CN.js"></script>
</head>
<body id="model">
    <?php echo ($form); ?>
    <?php switch($action): case "update": ?><div class="submit_btn">
                <td align="right" height="40">
                    <input id="submit" type="button" value="修改" onclick="api.iexecute()">
                </td>
            </div><?php break;?>
        <?php case "add": ?><div class="submit_btn">
                <td align="right" height="40">
                    <input id="submit" type="button" value="新增" onclick="api.iexecute()">
                </td>
            </div><?php break;?>
        <?php default: endswitch;?>

    <script src="/Admin/js/helper/detail.js?v=20170118" defer=true></script>
    <script src="/Admin/js/helper/common.js?v=20170118" defer=true></script>
    <script src="/Admin/js/observer/observe.js?v=20170118" defer=true></script>
    <script src="/Admin/js/drawer/<?php echo ($model); ?>.js?v=20170118" defer=true></script>
</body>
</html>