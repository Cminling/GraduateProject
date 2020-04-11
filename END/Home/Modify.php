<?php 
    session_start();
    header("Content-type:text/html;charset=utf8");
    if(isset($_SESSION['userName'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>培正快信-修改密码</title>
    <link rel="stylesheet" href="../Public/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="../Public/plugins/layui/css/layui.css" type="text/css" />
    <link rel="stylesheet" href="../Public/css/modify.css" type="text/css" />
    <script type="text/javascript" src="../Public/js/jquery.js"></script>
    <style>
        body{
            min-width:1024px;
            width:expression((documentElement.clientWidth < 1024) ? "1024px" : "auto" ); 
            max-height:768px;
        }
        .s-tabcell:before {content: '';display:inline-block;height:100%;width:0;vertical-align:middle;}
        .d-ib {display: inline-block;}
        header .info {height: 98px;}
        header .d-ib {vertical-align: middle;}
    </style>
</head>

<body>
<!--     <header class="layui-nav">
        <div class="logo">
            <img class="layui-nav-img" src="../Public/img/logo.png" alt="">
            <img id="title" src="../Public/img/1509366290_476555.png" style="height: 30px;">
        </div>
        <div class="info s-tabcell">
            <span class='user_name d-ib'>/<?php //echo $_SESSION['realName']  ?></span>
            <img src='../Public/img/014615492.jpg' class="layui-nav-img">
            <span class="d-ib" style="color:#5f5f5f">|<a href="./logout.php">退出登录</a></span>
        </div>
    </header> -->
	<ul class="layui-nav header layui-bg-black">
		<img src="../Public/img/QQ图片20171030202112副本.png" class="layui-nav-img ">
		<img src="../Public/img/1509366290_476555.png" style="height: 30px;">
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item" > 
            <a href="javascript:;">
                <img src="../Public/img/tx2.jpg" class="layui-nav-img"><?php echo $_SESSION['realName']  ?>
            </a>
        </li>
        <li class="layui-nav-item">
            <a href="./logout.php">退出登录</a>
        </li>
    </ul>   
    <div class="bg">
        <p class="title">修改密码</p>    
        <form action="./Modify/checkCode.php" method="post">
        <div class="inputcontent">
            <div class="form-group">
                <input type="text" name="rname" required="required" id="rname" class="j-rname" placeholder="请输入注册的真实姓名"/>
            </div>          
            <div class="form-group">
                <input type="text" name="tel" id="tel_num" class="j-telphone" placeholder="请输入注册的手机号码" />
                <span class="tel-msg"></span>
            </div>
            <div class="form-group">
                <input type="text" name="vrify1" id="vrify1" placeholder="验证码" />
                <input id="btnSendCode" type="button" class="code-btn" value="免费获取验证码" />
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="请输入新密码" />
            </div>
            <div class="form-group">
                <input type="password" name="repassword" id="repassword" placeholder="再一次输入新密码" />
            </div>
            <div class="js-help-info error"></div>
            <div class="form-group" style="padding-left:87px">
                <input type="submit" name="modify" id="modify" value="确认" />
            </div>
            </div>       
        </form>
    </div>
    <footer style="background-image: url('../Public/img/bg5_footer.jpg')">Copyright © 2017-2018广东培正学院敏敏童鞋</footer>
    <script type="text/javascript" src="../Public/js/Modify.js"></script>
    <script type="text/javascript" src="../Public/plugins/layui/layui.js"></script>
    <script>
    layui.use('element', function(){
    var element = layui.element;
    });
    </script>
</body>

</html>
<?php
  }else{
    echo "<script>
    alert('登陆后可以修改密码！');window.location.href='login.html';</script>";
  }

?>