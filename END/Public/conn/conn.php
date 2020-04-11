<?php
$conn = mysql_connect("localhost","root","123") or die("数据连接失败");
mysql_select_db('pzinfor',$conn);
mysql_set_charset("utf8");

?>