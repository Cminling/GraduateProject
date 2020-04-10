<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户注册</title>
<style type="text/css">
body {
	background-image: url(images/13000.jpg);
	background-repeat: no-repeat;
}
</style>
</head>

<body>
<?php
  if(isset($_POST["button"]))
  {
	$a1=$_POST["a1"];
	$a2=$_POST["a2"];
	$a3=$_POST["a3"];
	$id=mysql_connect("localhost","root","123");
	$ok=mysql_select_db("login",$id);
	mysql_query("SET CHARACTER SET utf8");
	$result=mysql_query("insert into denglu values('$a1','$a2','$a3')",$id);
    if($result==true)
	{
		echo "<script> alert('注册成功！');window.location.href='dl.php'</script>";
	}
	else
	{
		echo "<script> alert('请认真填写信息！');</script>";
	}
  }
?>
<form id="form1" name="form1" method="post" action="">
  <table width="1343" height="528" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="340" height="209">&nbsp;</td>
      <td colspan="2" align="center"><img src="images/用户注册.png" width="257" height="96" /></td>
      <td width="323">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
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
      <td height="173" align="center"><p>密保问题：</p>
        <p>&nbsp;</p>
      <p>密保答案：</p></td>
      <td><p>
        <label for="a3"></label>
        <label for="aa"></label>
        <select name="aa" id="aa">
          <option>今天天气怎么样</option>
        </select>
      </p>
        <p>&nbsp;</p>
        <p>
          <input type="text" name="a3" id="a3" />
      </p></td>
      <td rowspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="button" id="button" value="提交" /></td>
      <td><input type="reset" name="button2" id="button2" value="重置" /></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center"><p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>Copyright &copy; 2016.Others name All rights reserved.      </p>
      <p>&nbsp;</p></td>
    </tr>
  </table>
</form>
</body>
</html>
