<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../Public/plugins/layui/css/layui.css" media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
    <style>
    .demo, .demoTable{
        margin:20px auto 0 auto;
        width:910px;
    }
    </style>
</head>

<body>
    <div class="demoTable">
        搜索联系人：
        <div class="layui-inline">
            <input class="layui-input" name="keyword" id="demoReload" autocomplete="off">
        </div>
        <button class="layui-btn" data-type="reload">搜索</button>
    </div>
    <div class="demo">
        <table class="layui-hide" id="test" lay-filter="demo"></table>
    </div>
    <script type="text/html" id="barDemo">
         <a class="layui-btn layui-btn-danger layui-btn-small" lay-event="del">删除</a>
    </script>


    <script src="../Public/plugins/layui/layui.js" charset="utf-8"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
    <script>
layui.use(['table','form'], function () {
    var table = layui.table,
        form  = layui.form;
    table.render({
        elem: '#test'
        , id: 'idTest'
        , width: 900
        , height: 490
        , url: './dealMGuser.php' //数据接口
        , limit: 10
        , limits: [5,10]
        , page: true
        , cols: [[ //表头
                { checkbox: true,fixed:true}
            ,{ field: 'id', title: '序号', width:100, sort: true}
            , { field: 'uname', title: '用户名', width: 150 }
            , { field: 'rname', title: '真实姓名', width: 150 }
            , { field: 'phone', title: '手机号码', width: 150, sort: true }
            , { field: 'mail', title: '邮箱', width: 200, sort: true }
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
                    url: './DELfriend.php',
                    type: 'post',
                    data: { id: data.fdid },
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