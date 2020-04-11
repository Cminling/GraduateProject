<?php
  namespace Qcloud\Sms\Demo;
  header('content-type:text/html;charset=utf-8;'); 
  session_start();
  
  if(isset($_SESSION['userName'])){
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
    <link rel="stylesheet" href="../Public/plugins/layui/css/layui.css" media="all" />
    <title></title>

  </head>

  <body>
    <ul class="layui-nav layui-bg-black">
      <img src="../Public/img/QQ图片20171030202112副本.png" class="layui-nav-img ">
      <img src="../Public/img/1509366290_476555.png" style="height: 30px;">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="../Public/img/kakasu.jpg" class="layui-nav-img ">
          <?php echo $_SESSION['realName'] ?>
        </a>
        <dl class="layui-nav-child">
          <dd>
            <a href="./Modify.php">修改密码</a>
          </dd>
          <dd>
            <a href="javascript:;">安全管理</a>
          </dd>
          <dd>
            <a href="./logout.php">注销</a>
          </dd>
          </dd>
        </dl>
      </li>
      <li class="layui-nav-item">

        <a href="javascript:;">短信</a>
      </li>
      <li class="layui-nav-item">
        <a href="mail.php">邮件
          <span class="layui-badge-dot"></span>
        </a>
      </li>

      <li class="layui-nav-item">
        <div id="help">
          <a href="javascript:;">帮助</a>
        </div>
      </li>
    </ul>
    <ul class="layui-nav layui-nav-tree layui-nav-side layui-bg-black" style="margin-top: 97px;margin-bottom: 20px;">
      <li class="layui-nav-item layui-nav-itemed">
        <a href="javascript:;">联系人管理</a>
        <dl class="layui-nav-child">
          <div id="ADDfriend">
            <a href="javascript:;">添加联系人</a>
          </div>
          <dd>
            <a href="./DELfriend.html">删除联系人</a>
          </dd>
        </dl>
      </li>
      <li class="layui-nav-item">
        <a href="">联系人</a>
      </li>
      <div></div>
    </ul>
    <div class="home-tips shadow">
      <i style="float:left;line-height:17px;" class="fa fa-volume-up">公告：</i>
      <div class="home-tips-container">
        <span style="display: none;">
          <p>如果你觉得网站做得还不错，点个赞吧！</p>
        </span>

        <span style="display: block;">
          <p>正在建设中！</p>
        </span>
      </div>
    </div>

    <div class="layui-main" style="margin-top: 50px;">
      <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>信息群发</legend>
      </fieldset>
      <form class="layui-form layui-form-pane" name="form1" method="post">
        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label" style="width:808px" ;>接收的手机号</label>
          <div class="layui-input-block">
            <textarea name="ToPhone" placeholder="允许输入最多10个手机号码，并用半角逗号分隔开" class="textarea"></textarea>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">短信类型</label>
          <div class="layui-input-block" style="width:100px;">
            <select name="select" id="select">
              <option value="会议通知">会议通知</option>
              <option value="活动通知">活动通知</option>
            </select>
          </div>
        </div>
        <div style="overflow: auto; zoom: 1;">
          <div class="layui-form-item" style="float: left;">
            <label class="layui-form-label" style="width: 60px;">时间</label>
            <div class="layui-input-inline" style="float: left;">
              <input type="text" name="time" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item" style="float: left;">
            <label class="layui-form-label" style="width: 60px;">地点</label>
            <div class="layui-input-inline" style="float: left;">
              <input type="text" name="place" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item" style="float:left;">
            <label class="layui-form-label" style="width: 100px;">会议/活动</label>
            <div class="layui-input-inline" style="float: left;">
              <input type="text" name="something" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div style="clear：both;"></div>
        </div>
        <div class="layui-form-item" style="clear: both;">
          <div class="layui-inline">
            <label class="layui-form-label">注册的号码</label>
            <div class="layui-input-inline">
              <input type="tel" name="FromPhone" lay-verify="phone" autocomplete="off" class="layui-input">
            </div>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">注册密码</label>
          <div class="layui-input-inline">
            <input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <input type="submit" name="send" value="立即发送" class="layui-btn" />
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </form>
      <div class='wrap'>
        <div class='row'>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
        </div>
        <div class='row'>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
        </div>
        <div class='row'>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
        </div>
        <div class='row'>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
          <div class='cube'>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
            <div class='face'></div>
          </div>
        </div>
      </div>
    </div>

    <script src="../Public/plugins/layui/layui.js" charset="UTF-8"></script>
    <script>
      layui.use(['form', 'layedit', 'laydate', 'element', 'layer'], function () {
        var element = layui.element;
        var form = layui.form,
          layer = layui.layer,
          layedit = layui.layedit,
          laydate = layui.laydate;
        var $ = layui.jquery;
        $(function () {
          //播放公告
          playAnnouncement(3000);
        });

        function playAnnouncement(interval) {
          var index = 0;
          var $announcement = $('.home-tips-container>span');
          //自动轮换
          setInterval(function () {
            index++; //下标更新
            if (index >= $announcement.length) {
              index = 0;
            }
            $announcement.eq(index).stop(true, true).fadeIn().siblings('span').fadeOut(); //下标对应的图片显示，同辈元素隐藏
          }, interval);
        }

        //自定义验证规则下拉菜单
        form

        //日期
        laydate.render({
          elem: '#date'
        });
        laydate.render({
          elem: '#date1'
        });

        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');


        //监听提交
        form.on('submit(demo1)', function (data) {
          layer.alert(JSON.stringify(data.field), {
            title: '最终的提交信息'
          })
          return false;
        });

        $('#ADDfriend').on('click', function () {
          layer.open({
            type: 2,
            title: ['添加联系人', 'font-size: 18px;padding-left: 50px;color:blue;'],
            content: ['ADDfriend.html'],
            area: ['380px', '280px'],
            shadeClose: true,
          });
        });

        $('#help').on('click', function () {
          layer.open({
            type: 1,
            title: ['帮助', 'font-size: 18px;padding-left: 50px;'],
            content: '<div style="padding: 20px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">欢迎使用培正快信系统，在这里您可以发送短信和邮件，谢谢你的支持 ^_^</div>',
            area: '250px;',
            shade: 0.8,
            btn: '朕已阅',
          });
        });
      });
    </script>
  </body>

  </html>

  <?php 
  require_once './Send_Short.php';

  }else{
    echo "<script>
    alert('您还没有登录！');window.location.href='login.html';</script>";
  }
?>