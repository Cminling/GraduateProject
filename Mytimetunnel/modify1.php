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
</head>

<body>
<?php
  if(isset($_POST["button"]))
  {
	$a1=$_POST["a1"];
	$a3=$_POST["a3"];
	$id=mysql_connect("localhost","root","123");
	$ok=mysql_select_db("login",$id);
	mysql_query("SET CHARACTER SET utf8");
	$result=mysql_query("select *from denglu where name='$a1' and mibao='$a3'",$id);
	$info=mysql_fetch_array($result,MYSQL_ASSOC);
    if($info==true)
	{   
        header ("Location:modify2.php");
	}
	else
	{
	   echo "<script> alert('用户名或密保答案错误！');window.location.href='modify1.php';</script>";
	}
  }
?>
<form id="form1" name="form1" method="post" action="">
  <table width="1343" height="521" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="340" height="209">&nbsp;</td>
      <td colspan="2" align="center"><h1>找回密码</h1></td>
      <td width="323">&nbsp;</td>
    </tr>
    <tr>
      <td height="46">&nbsp;</td>
      <td width="340" align="center">用户名：</td>
      <td width="340"><label for="a1"></label>
      <input type="text" name="a1" id="a1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="209">&nbsp;</td>
      <td align="center"><p>&nbsp;</p>
        <p>密码保问题：</p>
        <p>&nbsp;</p>
        <p>答案：</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <td><p>
        <label for="a2"></label>
        </p>
        <p>
          <label for="s1"></label>
          <select name="s1" id="s1">
            <option>今天天气怎么样</option>
          </select>
        </p>
        <p>&nbsp;</p>
        <p>
          <label for="a3"></label>
          <input type="text" name="a3" id="a3" />
        </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="199" rowspan="2">&nbsp;</td>
      <td align="right"><input type="submit" name="button" id="button" value="提交" /></td>
      <td>&nbsp;</td>
      <td rowspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="193" align="center"><p>&nbsp;</p>
      <p>Copyright &amp;copy; 2016.Others name All rights reserved.</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    </tr>
  </table>
</form>
</body>
</html>
