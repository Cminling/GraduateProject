<?php
header('content-type:text/html;charest=utf-8;');
include '../Public/conn/conn.php';
$result = mysql_query("select friends from users");
$fd = '';
if($info = mysql_fetch_array($result)){
    $fd = $info['friends'];
}
$friends = explode(',',$fd);
$count = count($friends);  //总数据
$maxPages;		//最大页数

$page=isset($_GET["page"])?$_GET['page']:1;		//当前页号
$pageSize=2;	//每页显示多少条
$maxPages = ceil($count/$pageSize); //采用进一求整法算出最大页数 
//4. 效验当前页数
if($page>$maxPages){
    $page=$maxPages;
}
if($page<1){
    $page=1;
}

//5. 拼装分页sql语句片段
$limit = " limit ".(($page-1)*$pageSize).",{$pageSize}";   //起始位置是当前页减一乘以页大小

if($count>0){
    echo '{"code":0,"msg":"","count":"'."$count".'","data":[';
    $j=1;
    for($i=0;$i<$count;$i++){
        $result1 = mysql_query("select *from friend where fdid='$friends[$i]' {$limit}");
        while($info1 = mysql_fetch_array($result1)){
            $j++;
            echo json_encode(array('fdid'=>$info1['fdid'],'fdname'=>$info1['fdname'],'fdphone'=>$info1['fdphone']));
            if($j<$count+1){
                echo ",";
            }
        }
        
    }
    echo "]}";   
}

$sql = "select *from sw_goods";
$qry = mysql_query($sql);

//实现数据分页
//①引入分页类
include("./Page.class.php");

//②获得总记录条数
$sql = "select *from sw_goods";
$qry = mysql_query($sql);
$total = mysql_num_rows($qry);
$per = 7;

//③实例化分页类对象
$page_obj = new \Component\Page($total,$per);

//④制作sql语句，获得每页信息
//$page_obj->limit: 分页类会根据当前的页码把“limit 偏移量，长度” 给制作好
$sql3 = "select goods_name n,goods_price p,goods_number u,goods_weight w from sw_goods ".$page_obj->limit;
$qry3 = mysql_query($sql3);

//⑤获得页码列表
$pagelist = $page_obj ->fpage(array(3,4,5,6,7,8));


$p = isset($_GET['page'])?$_GET['page']:1;
$num = ($p-1)*$per;//(当前页码-1)*条数
$info = array();
while ($rst3 = mysql_fetch_assoc($qry3)) {
    //$rst3代表每条记录的以为数组信息
    //要把全部的$rst3整合到一起，变为一个二维数组
    $rst3['x'] = ++$num; //设置序号
    $info[] = $rst3;
}
$info[] = $pagelist;

//需要把全部的信息整合到一起，
//json_encode()只能使用一次
echo json_encode($info);//[jn,jn,jn,jn,jn,jn,jn,页码列表]