<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<style type="text/css">
body {
	background-image: url(images/%E5%A4%9A%E5%95%A6A%E6%A2%A6.png);
}
</style>
</head>

<body>
<?php
session_start();

if(isset($_POST["button"]))
{
  $a1=$_POST["a1"];
  $a2=$_POST["a2"];
  $id=mysql_connect("localhost","root","123");
  $ok=mysql_select_db("login",$id);
  mysql_query("SET CHARACTER SET uft8");
  $result=mysql_query("select *from denglu where name='$a1' and pass='$a2'",$id);
  $info=mysql_fetch_array($result,MYSQL_ASSOC);
  if($info==true)
  {
	  if($_POST["button"]!=""){
      $checks=$_POST["a3"];
      if($checks==""){
      echo "<script> alert('验证码不能为空');window.location.href='dl.php';</script>";
      }
      if($checks==$_SESSION["check"]){
       header ("location: index.html");
     }
    else{
	echo "<script> alert('您输入的验证码不正确!');window.location.href='dl.php';</script>";
}
}
	  
  }
  else
  {
	  echo "<script>alert('密码错误')</script>";
 }
}
?>
<form id="form1" name="form1" method="post" action=" ">
  <table width="1100" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="363" height="140">&nbsp;</td>
      <td width="605"><h1 style="color:#F00" align="center"><img src="images/20.png" width="583" height="81" /></h1></td>
      <td width="132">&nbsp;</td>
    </tr>
    <tr>
      <td height="351">&nbsp;</td>
      <td align="center"><label for="z"></label>
        <table width="453" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="33" background="images/登录界面a_01.png">&nbsp;</td>
          </tr>
          <tr>
            <td height="33" background="images/登录界面a_02.png">&nbsp;</td>
          </tr>
          <tr>
            <td height="34" background="images/登录界面a_03.png">&nbsp;</td>
          </tr>
          <tr>
            <td height="33" background="images/登录界面a_04.png"><table width="453" height="33" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="154" align="right" valign="bottom">用户名：</td>
                <td width="137" align="center" valign="bottom"><label for="a1"></label>
                  <input name="a1" type="text" id="a1" size="18" /></td>
                <td width="81" align="center" valign="bottom"><a href="register.php">注册</a>&nbsp;</td>
                <td width="81" align="center" valign="bottom">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="33" background="images/登录界面a_05.png">&nbsp;</td>
          </tr>
          <tr>
            <td height="33" background="images/登录界面a_06.png"><table width="453" height="33" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="154" align="right" valign="top">密&nbsp;&nbsp;码：</td>
                <td width="137" align="center" valign="top"><label for="a2"></label>
                  <input name="a2" type="password" id="a2" size="18" /></td>
                <td width="106" align="center" valign="top"><a href="modify1.php">忘记密码</a></td>
                <td width="53">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="33" background="images/登录界面a_07.png"><table width="453" height="33" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="154" align="right" valign="bottom">验证码：</td>
                <td width="71" align="center" valign="bottom"><label for="a3"></label>
                  <input name="a3" type="text" id="a3" size="6" /></td>
                <td width="133" align="center" valign="bottom"><img src="checks.php" width="90" height="28" id="checkpic" onclick="this.src+='?'" />&nbsp;</td>
                <td width="95">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="34" align="center" valign="bottom" background="images/登录界面a_08.png"><input type="submit" name="button" id="button" value="提交" /></td>
          </tr>
          <tr>
            <td height="33" background="images/登录界面a_09.png">&nbsp;</td>
          </tr>
          <tr>
            <td height="33" background="images/登录界面a_10.png">&nbsp;</td>
          </tr>
        </table>
        <table width="453" border="0" cellpadding="0" cellspacing="0">
          <tr>
            
          </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="171" colspan="3" align="center"><p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      <p>&nbsp;</p>	
			<p>&nbsp;</p>      </td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="95" align="center"><p>&nbsp;</p>
        <p>Copyright &copy; 2016.Others name All rights reserved.</p>
      <p>&nbsp;</p></td>
    </tr>
  </table>
</form>

</body>
</html>
