<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>找回密码</title>
<style type="text/css">
body {
	background-image: url(images/13000.jpg);
	background-repeat: no-repeat;
}
</style>
<script type="text/javascript">
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
</script>
</head>

<body>
<?php
  if(isset($_POST["button"]))
  {
	$a1=$_POST["a1"];
	$a2=$_POST["a2"];
	$id=mysql_connect("localhost","root","123");
	$ok=mysql_select_db("login",$id);
	mysql_query("SET CHARACTER SET utf8");
	$result=mysql_query("select *from denglu where name='$a1'",$id);
	$info=mysql_fetch_array($result,MYSQL_ASSOC);
    if($info==true)
	{
		 $result1=mysql_query("update denglu set pass='$a2' where name='$a1'",$id);
	     if($result1==true)
	   {
		echo "<script> alert('成功修改密码！');window.location.href='dl.php';</script>";
	   }
	   	else
	  {
		echo "<script> alert('修改密码不成功！');window.location.href='modify1.php';</script>";
	  }
	}
	else
	{
		echo "<script> alert('用户名错误！');window.location.href='modify2.php';</script>";
	}
  }
?>

<form id="form1" name="form1" method="post" action="">
  <table width="1343" height="589" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="340" height="209">&nbsp;</td>
      <td colspan="2" align="center"><h1>找回密码</h1></td>
      <td width="323">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td width="340" align="center">用户名：</td>
      <td width="340"><label for="a1"></label>
      <input type="text" name="a1" id="a1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">密码：</td>
      <td><label for="a2"></label>
      <input type="password" name="a2" id="a2" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="199" rowspan="2">&nbsp;</td>
      <td align="right"><input name="button" type="submit" id="button" onblur="MM_popupMsg('修改密码成功')" value="提交" /></td>
      <td><label for="a3"></label></td>
      <td rowspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Copyright &copy; 2016.Others name All rights reserved.</p>
      <p>&nbsp;</p></td>
    </tr>
  </table>
</form>
</body>
</html>
