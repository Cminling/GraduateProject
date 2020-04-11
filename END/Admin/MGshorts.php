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
    <title>培正快信系统--用户短信记录</title>
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
                                <a href="javascript:;">用户短信记录</a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="./saywhat.php">用户有话说</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="layui-body">
            <div style="padding: 15px;">
                <div class="demoTable">
                    搜索关键词：
                    <div class="layui-inline">
                        <input class="layui-input" name="keyword" id="demoReload" autocomplete="off">
                    </div>
                    <button class="layui-btn" data-type="reload">搜索</button>
                </div>
                <table class="layui-hide" id="test" lay-filter="demo"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-danger layui-btn-small" lay-event="del">删除</a>
                </script>
            </div>
        </div>

        <div class="layui-footer">
            © 2017-2018广东培正学院敏敏童鞋
        </div>
    </div>
    <script src="../Public/plugins/layui/layui.js"></script>
    <script>
    layui.use(['element','table','form'], function () {
        var element = layui.element,
            table = layui.table,
            form  = layui.form;
        table.render({
            elem: '#test'
            , id: 'idTest'
            , width: 1100
            , height: 450
            , url: './dealMGshorts.php' //数据接口
            , limit: 9
            , limits: [9]
            , page: true
            , cols: [[ //表头
                    { checkbox: true,fixed:true}
                ,{ field: 'id', title: '序号', width:90, sort: true}
                , { field: 'uname', title: '用户名', width: 130 }
                , { field: 'rname', title: '真实姓名', width: 120 }
                , { field: 'msgtype', title: '短信类型', width: 100}
                , { field: 'tophone', title: '发送手机号', width: 120}
                , { field: 'note', title: '短信内容', width: 250 }
                , { field: 'formphone', title: '接收手机号', width: 120 }
                , { field: 'datetime', title: '发送时间', width: 170, sort: true }
                , { fixed: 'right', width: 100, align: 'center', toolbar: '#barDemo' }
            ]]
            , id: 'testReload'
        });
        //传递关键词到后台
        var $ = layui.$, active = {
            reload: function () {
                var demoReload = $('#demoReload');
                table.reload('testReload', {
                    where: {
                        keyword: demoReload.val()
                    }
                });
            }
        };

        $('.demoTable .layui-btn').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
        //监听表格复选框选择
        table.on('checkbox(demo)', function (obj) {
            console.log(obj)
        });

        //监听工具条
        table.on('tool(demo)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data //获得当前行数据
                , layEvent = obj.event; //获得 lay-event 对应的值
            if (layEvent === 'del') {
                layer.confirm('真的删除行么', function (index) {
                    console.log(data);
                    $.ajax({
                        url: './deleShorts.php',
                        type: 'post',
                        data: { id: data.id },
                        dataType: 'json',
                        success: function (data) {
                            if (data.state == 1) {
                                obj.del();
                                layer.close(index);
                                layer.msg("删除成功", { icon: 6 });
                            } else {
                                layer.msg("删除失败", { icon: 5 });
                            }
                        }
                    });
                });
            }
        });

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