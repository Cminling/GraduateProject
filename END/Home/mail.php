  <?php
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
    
    <link rel="stylesheet" href="../Public/plugins/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="../Public/css/index.css"  />
    <script type="text/javascript" src="../Public/js/jquery.js"></script>
    <script type="text/javascript" src="../Public/js/jquery.form.js"></script> 	     
		<title>发送邮件</title>
    <style>
    min-width:200px;
    width:expression_r(document.body.clientWidth < 200 ? "200px": "auto" );
    </style>
	<script>	
	$(function () {
		var bar = $('.bar');
		var percent = $('.percent');
		var showimg = $('#showimg');
		var progress = $(".progress");
		var files = $(".files");
		var btn = $(".btn span");
		$("#fileupload").wrap("<form id='myupload' action='upload.php' method='post' enctype='multipart/form-data'></form>");
		$("#fileupload").change(function () {
			$("#myupload").ajaxSubmit({
				dataType: 'json',
 				beforeSubmit: function(){	
					var file = document.getElementById('fileupload').files;    //获取上传的文件  
					var fileName = file[0].name;
					var fileSize = (file[0].size / (1024*1024)).toFixed(2);
					//alert(fileSize);
					// 获取文件的格式为.txt、.xsl、.csv  
					var fileFormat = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
					// 文件大小不超过200KB；  
					if (fileSize > 5) {
						alert("允许上传最大5M的文件！");
						return false;
					}
					// 校验文件格式  					
						if (fileFormat.match(/.exe|.bat|.com|.dll|.sys/)) {
							alert("不允许上传可执行文件！");
							return false;
						}
							return true;														
				}, 
				beforeSend: function () {
					showimg.empty();
					progress.show();
					var percentVal = '0%';
					bar.width(percentVal);
					percent.html(percentVal);
					btn.html("上传中...");
				},
				uploadProgress: function (event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					bar.width(percentVal);
					percent.html(percentVal);
				},
				success: function (data) {
					files.html("<b>" + data.name + "(" + data.size + "M)</b> <span class='delimg' rel='" + data.pic + "'>删除</span>");
					var img = "files/" + data.pic;
					showimg.html("<img src='" + img + "'style='width:100px;height:100px;'>");
					btn.html("添加附件");
				},
				error: function (xhr) {
					btn.html("上传失败");
					bar.width('0')
					files.html(xhr.responseText);
				},
       
			});
		});

		$(document).on("click", ".delimg", function () {
			var pic = $(this).attr("rel");
			$.post("upload.php?act=delimg", { imagename: pic }, function (msg) {
				if (msg == 1) {
					files.html("删除成功.");
					showimg.empty();
					progress.hide();  
				} else {
					alert(msg);
				}
			});
		});
	});
	</script>
    
	</head>
	<body>
		<ul class="layui-nav layui-bg-black">
			<img src="../Public/img/QQ图片20171030202112副本.png" class="layui-nav-img ">
			<img src="../Public/img/1509366290_476555.png" style="height: 30px;">
			<li class="layui-nav-item" >
        <a href="javascript:;"><img src="../Public/img/kakasu.jpg" class="layui-nav-img "><?php echo $_SESSION['realName'] ?></a>
        <dl class="layui-nav-child">
          <dd><a href="javascript:;">修改密码</a></dd>
          <dd><a href="javascript:;">安全管理</a></dd>
          <dd><a href="./logout.php">注销</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"> 	
        <a href="home.php">短信</a>
      </li>
      <li class="layui-nav-item">
        <a href="">邮件<span class="layui-badge-dot"></span></a>
      </li>
      <li class="layui-nav-item">
        <div id="help"><a href="javascript:;">帮助</a></div>
      </li>
    </ul>
    <ul class="layui-nav layui-nav-tree layui-nav-side layui-bg-black" style="margin-top: 97px;margin-bottom: 20px;">
      <li class="layui-nav-item layui-nav-itemed">
        <a href="javascript:;">联系人管理</a>
        <dl class="layui-nav-child">
          <div id="ADDfriend"><a href="javascript:;" >添加联系人</a></div>
          <dd><a href="./DELfriend.html">删除联系人</a></dd>     
        </dl>
      </li>
      <li class="layui-nav-item"><a href="">联系人</a></li>
      <div></div>
    </ul>
	  <div class="home-tips shadow">
      <i style="float:left;line-height:17px;" class="fa fa-volume-up">公告：</i>
        <div class="home-tips-container">                   	
          <span style="display: none;"><p>如果你觉得网站做得还不错，点个赞吧！</p></span>                   	
          <span style="display: block;"><p>正在建设中！</p></span>
        </div>
    </div>
    
    <div class="layui-main" style="margin-top: 30px;">
      <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend >发送邮件</legend>
      </fieldset>
      <form class="layui-form layui-form-pane" name="form1" id="form1" method="post" action="Send_Mail.php" enctype="multipart/form-data">
        <div class="layui-form-item" >
          <label class="layui-form-label" >收件人</label>
          <div class="layui-input-inline" style="float: left;width:70%;">
            <input type="text" name="receiver" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item" >
          <label class="layui-form-label" >标题</label>
          <div class="layui-input-inline" style="float: left;width:70%;">
            <input type="text" name="title" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
          </div>
        </div>                     
      
        <div class="btn">
          <span>添加附件</span>
          <input id="fileupload" type="file" name="mypic">
        </div>
        <div class="progress">
          <span class="bar"></span>
          <span class="percent">0%</span>
        </div>
        <div class="files"></div>

        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label" style="width:79.69%;">正文内容</label>
          <div class="layui-input-block">
            <textarea name="content"  class="textarea"></textarea>
          </div>
        </div>

        <div class="layui-form-item" style="clear: both;">
            <div class="layui-inline">
              <label class="layui-form-label">注册的邮箱</label>
              <div class="layui-input-inline">
                <input type="tel" name="fromMail" lay-verify="phone" autocomplete="off" class="layui-input">
              </div>     
            </div>
        </div>

        <div class="layui-form-item">       
          <input type="submit" name="send" id="send" value="立即发送" class="layui-btn" />
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </form>
    </div>

    <script src="../Public/plugins/layui/layui.js" charset="UTF-8"></script>
    <script >
      layui.use(['form', 'layedit', 'laydate','element'], function(){
        var element = layui.element; 
        var form = layui.form
        ,layer = layui.layer
        ,layedit = layui.layedit
        ,laydate = layui.laydate;
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
              index++;    //下标更新
              if (index >= $announcement.length) {
                index = 0;
              }
              $announcement.eq(index).stop(true, true).fadeIn().siblings('span').fadeOut();  //下标对应的图片显示，同辈元素隐藏
            }, interval);
          }
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
        form.on('submit(demo1)', function(data){
          layer.alert(JSON.stringify(data.field), {
            title: '最终的提交信息'
          })
          return false;
        });
      }); 

    $('#ADDfriend').on('click', function () {
        layer.open({
          type:2,
          title:['添加联系人','font-size: 18px;padding-left: 50px;color:blue;'],
          content:['ADDfriend.html'],           
          area:['380px','280px'],
          shadeClose:true,
        });
    });
    $('#help').on('click', function () {
        layer.open({
          type:1,
          title:['帮助','font-size: 18px;padding-left: 50px;'],
          content:'<div style="padding: 20px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">欢迎使用培正快信系统，在这里您可以发送短信和邮件，谢谢你的支持 ^_^</div>',           
          area:'250px;',
          shade:0.8,
          btn:'朕已阅',
        });
    });
     
    </script>
	</body>
</html>

    <?php 
      }else{
        echo "<script>
        alert('您还没有登录！');window.location.href='login.html';</script>";
      }
    ?>
