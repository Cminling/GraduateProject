<?php
header("content-type:text/css;charest=utf-8;");
include '../Public/conn/conn.php';
$sql = "select * from note";
$qry = mysql_query($sql);
$count = mysql_num_rows($qry); //总数据条数
$limit = $_GET['limit'];  //获取前端传来的限制
$page = $_GET['page'];   //获取前端传来的页码
$offset = ($page-1)*$limit;  //计算偏移量

$tj = "1=1";
if(!empty($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $tj= "uname like '%{$keyword}%' or realname like '%{$keyword}%' or msgtype like '%{$keyword}%' or tophone like '%{$keyword}%' or note like '%{$keyword}$' or formphone like '%{$keyword}%'";   
}
$lt = " limit "."{$offset}".",{$limit}";
$sql2 = "select * from note where {$tj} {$lt}";
$result = mysql_query($sql2);   
echo '{"code":0,"msg":"","count":'."$count".',"data":';
while($info = mysql_fetch_array($result)){
$arr[]=array('id'=>$info['id'],'uname'=>$info['uname'],'rname'=>$info['realname'],'msgtype'=>$info['msgtype'],'tophone'=>$info['tophone'],'note'=>$info['note'],'formphone'=>$info['formphone'],'datetime'=>$info['datetime']);
}
echo json_encode($arr);
echo "}";

       
