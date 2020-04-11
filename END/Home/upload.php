<?php
header("content-type:text/html;charest=utf-8;");
$action = @$_GET['act']; 
if($action=='delimg'){ //删除图片 
    $filename = $_REQUEST['imagename'];
    echo 'filename'.$filename; 
    if(!empty($filename)){ 
        unlink('files/'.$filename); //删除文件
        echo '1'; 
    }else{ 
        echo '删除失败.'; 
    } 
}else{ //上传图片 
	if(!file_exists('files/')){
		mkdir('files/');
	}
    $picname = $_FILES['mypic']['name']; 
    $picsize = $_FILES['mypic']['size']; 
    $pictype = substr(strrchr($picname,"."),1);//获取文件扩展名; 
    if ($picname != "") { 

        $rand = rand(100, 999); 
        $pics = date("YmdHis") . $rand . "." .$pictype; //命名图片名称
        //中文名的文件出现问题，所以需要转换编码格式
        //$filename = iconv("UTF-8","gb2312",$picname);  
        //上传路径 
        $pic_path = "files/". $pics; 
        
       move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path); 
    } 
    $size = round($picsize/(1024*1024),2); //转换成kb 
    $arr = array( 
        'name'=>$picname, 
        'pic'=>$pics, 
        'size'=>$size,
        'path'=>$pic_path
    ); 
    $js_string = json_encode($arr);
    $data = file_put_contents('file.json',$js_string);
    echo $js_string; //输出json数据 
} 


?>