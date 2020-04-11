<?php
  session_start();
  header('content-type:text/html;charset=utf-8;'); 
  include '../Public/conn/conn.php';
  
  if(isset($_POST['login'])){
      $userName=$_POST['userName'];
      $passWord=md5($_POST['passWord']);
      //$chkCode=$_POST['chkCode'];
      $sql="select * from users where uname='$userName' and password='$passWord'";
      $result=mysql_query($sql);
      if($rows=mysql_fetch_array($result)){
        /*if(strtolower($chkCode)!=strtolower($_SESSION["VerifyCode"])){
          echo "<script>alert('验证码错误！！');location.href='login.html'<script>"; 
        }   */   
        $_SESSION['id']       = $rows['id']; //用来添加删除好友
        $_SESSION['userName'] = $userName;   //非法登录，注销
        $_SESSION['passWord'] = $passWord;    //发送短信
        $_SESSION['realName'] = $rows['rname']; //修改密码
        $_SESSION['fromPhone']= $rows['phone']; //修改密码
        echo "<script>location.href='home.php'</script>";
      }else{
        echo "<script>alert('用户名或密码错误！！');location.href='login.html'</script>"; 
       /*echo $passWord; */    
      }
    
  }
?>