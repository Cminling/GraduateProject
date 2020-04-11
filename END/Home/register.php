<?php
header('content-type:text/html;charset=utf-8;'); 
if(isset($_POST['register'])){
 	$uname=$_POST["uname"];
	$password=md5($_POST["password"]);
	$repassword=md5($_POST["repassword"]);
	$rname=$_POST["rname"];
	$phone=$_POST["phone"];
	$mail=$_POST["mail"];
	include("../Public/conn/conn.php");

       $sql="INSERT INTO users(uname,password,rname,phone,mail) VALUES('$uname','$password','$rname','$phone','$mail')";	
	   $result=mysql_query($sql, $conn);		
	   if($result==true)
	   {
		  echo "<script>alert('注册成功，点击确定返回登录页面！');
	      window.location.href='login.html';
	      </script>";
	   }
	   else
	   {
	      echo "数据添加失败，错误信息：";
	   }
    
}

?>