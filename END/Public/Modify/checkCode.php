<?php
session_start();
header("content-type:text/html;charest:utf-8;");
include('../conn/conn.php');
$phone      = $_POST['phone'];
$rname      = $_POST['rname'];
$password   = md5($_POST['password']);
$result = mysql_query("update users set password='$password' where rname='$rname' and phone='$phone'");
if($result){
    echo json_encode(array('status' =>(int)($_SESSION['usercode'] == $_POST['code'])));    
}else{
    echo json_encode(array('status' =>2));
}
