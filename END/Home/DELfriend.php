<?php
session_start();
$user_id = $_SESSION['id'];
include '../Public/conn/conn.php';
$id = $_POST['id'];
$fd = '';
$rs = mysql_query("select friends from users");
if($info = mysql_fetch_array($rs)){
    $fd_arr = explode(",",$info['friends']); //用户朋友列表打散成数组
    array_splice($fd_arr,array_search($id,$fd_arr),1);//查找朋友列表中要删除的id的键名并移除
    //var_dump($fd_arr);
    $new_fd = implode(",",$fd_arr);//把删除后的数组转为字符串
    $rs1 = mysql_query("update users set friends='$new_fd' where id='$user_id'");
    if($rs1)
        echo json_encode(array('state'=>1,'msg'=>'删除成功'));
}
