<?php
include($_SERVER['DOCUMENT_ROOT'].'/LLsystem/config.php');
include_once(Root_Path."/model/admin_login.php");
include_once(Root_Path."/model/navbar.php");
include_once(Root_Path."/model/slideshow.php");
$fun=$_GET['fun'];
$res="";
switch ($fun){
  case "changepwd":
  $newpwd=$_POST["newpwd"];
  $uname=$_COOKIE['user'];
  $res=update_pwd($uname,$newpwd);
  $res=['succ'=>$res];
  break;
  case "login":
  $uname=$_POST["uname"];
  $pwd=$_POST["pwd"];
  $res=get_user($uname,$pwd);
  if(count($res)!=1){
    $res=["succ"=>false,"errcode"=>-1];
  }else{
   $res=["succ"=>true,"errcode"=>-1];
 }
 break;
 case "add_nav":
 $name=$_POST["name"];
 $href=$_POST["href"];
 $pid=$_POST["pid"];
 $res=add_nav($name,$href,$pid);
 $res=['succ'=>$res];
 break;
 case "delete_nav":
 $id=$_POST["id"];
 $res=delete_nav($id);
 $res=['succ'=>$res];
 break;
 case "update_nav":
 $id=$_POST["id"];
 $name=$_POST["name"];
 $href=$_POST["href"];
 $res=update_nav($name,$href,$id);
 $res=['succ'=>$res];
 break;
 case "get_second_nav":
 $pid=$_POST["pid"];
 $res=get_second_nav($pid);
 break;
 case "add_slider_pic":
 //$url=$_POST['url'];
 if(array_key_exists('file',$_FILES)){
  $file = $_FILES['file'];
  $upload_path=Root_Path."/admin/images/slider/";//记录路径
  $extension=explode(".",$file['name'])[1];
  $fileName=time().'.'.$extension;
  move_uploaded_file($file['tmp_name'],$upload_path.$fileName);
  if(is_file($upload_path.$fileName)){
    $res=["succ"=>true,"fileName"=>$fileName];
  }else{
    $res=["succ"=>flase,"errcode"=>1];//1表示上传失败
  }
}else{
  $res=["succ"=>flase,"errcode"=>2];//2表示未找到文件
}
break;
 case "add_slider_Info":
 $pid=$_POST["pid"];
 $res=get_second_nav($pid);
 break; 
}
echo json_encode($res);
?>