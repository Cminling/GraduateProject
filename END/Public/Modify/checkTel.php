<?php
//session_start();
// ajax检测号码是否注册
  header("content-type:text/html;charset=utf-8");//设置页面编码格式
  include '../conn/conn.php';
    $tel = $_POST['phones'];
    $rname = $_POST['rname'];
    $sql=mysql_query("select * from users where phone='$tel' and rname='$rname'");//执行查询语句
    $result = mysql_fetch_array($sql);
    if(!$result){//当没有查询记录时
      echo json_encode(array('flag' => 0, 'errorInfo' => '不存在该用户,真实姓名和手机号码不匹配'));
    }else{
      echo json_encode(array('flag' => 1, 'errorInfo' => '已注册'));     
    }
    // echo json_encode(array('flag' =>(int)($_SESSION['usercode'] == $_POST['code'])));

  
