<?php
header('content-type:text/html;charest=utf-8;');
include '../Public/conn/conn.php';
session_start();
$result = mysql_query("select friends from users where id ={$_SESSION['id']}");
$fd = '';
if($info = mysql_fetch_array($result)){
    $fd = $info['friends'];
}
$friends = explode(',',$fd);
$count = count($friends); //数据总条数
$limit = $_GET['limit'];  //获取前端传来的限制数量
$page = $_GET['page'];   //获取前端传来的页码
$offset = ($page-1)*$limit;  //计算偏移量
// $lt = " limit "."{$offset}".",{$limit}"; //拼装limit

/* if($count>0){
    echo '{"code":0,"msg":"","count":'."$count".',"data":[';
    $j=1;
    for($i=0;$i<$count;$i++){
        $result1 = mysql_query("select *from friend where fdid='$friends[$i]' limit 5");
        while($info1 = mysql_fetch_array($result1)){
            $j++;
            echo json_encode(array('fdid'=>$info1['fdid'],'fdname'=>$info1['fdname'],'fdphone'=>$info1['fdphone']));
            if($j<$count+1){
                echo ",";
            }
        }        
    }
    echo "]}";   
} */
    echo '{"code":0,"msg":"","count":'."$count".',"data":';
    for($i=0;$i<$count;$i++){
        $result1 = mysql_query("select *from friend where fdid='$friends[$i]'");
        while($info1 = mysql_fetch_array($result1)){
            $arr[] = array('fdid'=>$info1['fdid'],'fdname'=>$info1['fdname'],'fdphone'=>$info1['fdphone']);
        }        
    }
    $pagedata=array_slice($arr,$offset,$limit); 
        echo json_encode($pagedata);
    echo "}";   
