<?php
session_start();
if(isset($_SESSION['admin_name'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户列表</title>
    <link rel="stylesheet" type="text/css" href="../Public/plugins/layui/css/layui.css">
    <link rel="stylesheet" href="../Public/css/index.css" type="text/css">
    <script src="../Public/js/jquery.js"></script>
    <style>
    body{
        font-family: "宋体", Arial, Lucida, Verdana, Helvetica, sans-serif;
        background-image:url('../Public/img/bg5.jpg');
    }
    </style>

</head>
<script>
    function checkall(qx) {
        var ck = document.getElementsByClassName("ck");
        if (qx.checked) {
            for (i = 0; i < ck.length; i++) {
                ck[i].setAttribute("checked", "checked");
            }
        }
        else {
            for (var i = 0; i < ck.length; i++) {
                ck[i].removeAttribute("checked");
            }
        }
    }

</script>

<body style="overflow:auto;">
    <div class="layui-header">
        <ul class="layui-nav layui-bg-black">
            <img src="../Public/img/QQ图片20171030202112副本.png" class="layui-nav-img ">
            <img src="../Public/img/1509366290_476555.png" style="height: 30px;">
            <li class="layui-nav-item" >
                <a href="javascript:;"><img src="../Public/img/zzx.jpg" class="layui-nav-img "><?php echo $_SESSION['admin_rname']; ?></a>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item"><a href="./logout.php">退了</a></li>
        </ul>
    </div>
    <div id="list">
        <form id="search" action=" " method="get" class="showusr">
            <input type="text" name="keywords" value="" class="textbox" placeholder="请输入查询内容" />
            <input type="submit" class="su" value="提交查询" />
        </form>
        <form id="showlist" action="deletUser.php" method="get" class="showusr">
    <?php 
    include '../Public/conn/conn.php';
	
    $wherelist = array();//封装搜索条件的数组
    $urllist = array(); //封装搜索条件的url数组
    //判断关键字是否有值，若有则封装此搜索条件
	if(!empty($_GET['keywords'])){
		$wherelist[]="rname like '%{$_GET['keywords']}%' or uname like '%{$_GET['keywords']}%' or phone like '%{$_GET['keywords']}%' or mail like '%{$_GET['keywords']}%'";
		$urllist[]="keywords={$_GET['keywords']}";
	}
	//组装搜索条件
	if(count($wherelist)>0){
		$where = " where ".implode(" and ",$wherelist);
		$url = "&".implode("&",$urllist);
	}	
				
	$page=isset($_GET["page"])?$_GET['page']:1;		//当前页号
	$pageSize=8;	//每页显示数据量
	$maxRows;		//总数据量
    $maxPages;		//最大页数
    $showPage = 5; //显示页码个数
						
	@$sql = "select * from users {$where}";
	$res = mysql_query($sql);
	$maxRows =mysql_num_rows($res); 
    $maxPages = ceil($maxRows/$pageSize); 
    $pageoffset = ($page-1)*$pageSize; //偏移量
						
	//效验当前页数
	if($page>$maxPages){
		$page=$maxPages;
	}
	if($page<1){
	    $page=1;
	}
						
	// 拼装分页sql语句片段
	$limit = " limit "."{$pageoffset}".",{$pageSize}"; 
	//======================================
					
	@$sql = "select * from users {$where} {$limit}";
	@$result = mysql_query(@$sql);

	?>
    <table class="layui-table info-table">
        <thead>
        <tr>
            <th><input type='checkbox' id='dx' value='' '' name='dx' onclick='checkall(this)' /></th>
            <th>序号</th>
            <th>用户名</th>
            <th>真实姓名</th>
            <th>手机号码</th>
            <th>邮箱</th>
            <th><a href='javascript:void(0);'><input type='submit' id='del' value='删除' /></a></th>
        </tr>
        </thead>
    <?php
	if($result==true){
	    while($row = mysql_fetch_assoc($result)){
            echo "<tr>";
            echo "<td><input type='checkbox' name='del[]' value='".$row['id']."'"." class='ck' /></td>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['uname']}</td>";
            echo "<td>{$row['rname']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['mail']}</td>";
            echo "<td>&nbsp;</td>";
            echo "</tr>";
	}
	?>
    </table>
    <div id="pg">
    <?php
    $url = !empty($url)?$url:"";
        
    $page_banner="<div class='pageview' >";
    
    if($page > 1){
    $page_banner.="<a href='".$_SERVER['PHP_SELF']."?page= 1{$url}' class='prev-link link' >首页</a>";
    $page_banner.="<a href='".$_SERVER['PHP_SELF']."?page=".($page-1)."{$url}' class='prev-link link'><上一页</a>";
    }
    else{
        $page_banner.="<span class='prev-link link'> <a>首页</a></span>";
        $page_banner.="<span class='prev-link link'> <a><上一页</a></span>";
    }
    $start=1;
    $end = $maxPages;

    if($maxPages >$showPage) {
        if($page >$pageoffset+1){
            $page_banner.="...";
        }
        if($page > $pageoffset){
        $start =$page - $pageoffset;
            $end=$maxPages > $page+$pageoffset ? $page+$pageoffset :$maxPages;
        }
        else{
        $start=1;
        $end=$maxPages > $showPage ? $showPage : $maxPages;
        }
        if($page + $pageoffset > $maxPages){
        $start=$start-($page+$pageoffset-$end);
        }
    } 


    for($i=$start;$i<=$end;$i++){
        if($page==$i){ 
        $page_banner.="<span class ='link'>$i</span>";
        }else{  
            $page_banner.="<a href='".$_SERVER['PHP_SELF']."?page=".$i."{$url} class='link'>$i</a>";
        }
    }

    if($maxPages>$showPage&&$maxPages>$page+$pageoffset){
        $page_banner.="...";
    }
    if($page <$maxPages){
        $page_banner.="<a href='".$_SERVER['PHP_SELF']."?page=".($page+1)."{$url}'' class='link next'>下一页></a>";
        $page_banner.="<a href='".$_SERVER['PHP_SELF']."?page=".($maxPages)."{$url}'' class='link next'>尾页</a>";
    }
    else{
        $page_banner.="<span class ='disable'> <a>尾页</a></span>";
        $page_banner.="<span class ='link next'> <a>下一页></a></span>";
    }
    $page_banner.="共{$maxPages}页";
    echo $page_banner;
        }
?>
         </div>
         </form>
    </div>
</body>
</html>
<?php
}else{
    echo "<meta charset='UTF-8'>";
    echo "<script>
    alert('您还没有登录！');window.location.href='login.html';</script>";
}
?>