  <?php
    header('content-type:text/html;charset=utf-8;'); 
    session_start();  
    if(isset($_SESSION['admin_name'])){
  ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>培正快信系统--用户有话说</title>
    <link rel="stylesheet" href="../Public/plugins/layui/css/layui.css">
</head>

<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo" style="width: 280px;">
            <img src="../Public/img/QQ图片20171030202112副本.png" class="layui-nav-img ">
            <img src="../Public/img/1509366290_476555.png" style="height: 30px;">                
                后台管理
            </div>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="../Public/img/tx2.jpg" class="layui-nav-img"><?php echo $_SESSION['admin_rname']; ?>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="">基本资料</a>
                        </dd>
                        <dd>
                            <a href="">安全设置</a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="">退了</a>
                </li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item layui-nav-itemed">
                        <a class="" href="javascript:;">用户管理</a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="./MGuser.php">用户列表</a>
                            </dd>
                            <dd>
                                <a href="./MGshorts.php">用户短信记录</a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="">用户有话说</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="layui-body">
            <div style="padding: 15px;">即将支持</div>
        </div>

        <div class="layui-footer">
            © 2017-2018广东培正学院敏敏童鞋
        </div>
    </div>
    <script src="../Public/plugins/layui/layui.js"></script>
    <script>
        layui.use('element', function () {
            var element = layui.element;

        });
    </script>
</body>

</html>
<?php 
    }else{
    echo "<script>
    alert('您不是管理员或者没有登录！');window.location.href='login.html';</script>";
    }
?>