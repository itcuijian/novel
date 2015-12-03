<?php
header('Content-Type:text/html;charset=utf-8'); 
ini_set('date.timezone','Asia/Shanghai');

define( 'ROOT_PATH', realpath(dirname(dirname(__FILE__))) );

 // $uid = intval( $_REQUEST['uid'] );
 // echo $uid;

$targetFolder = ROOT_PATH.'/uploads/'.date("Ymd").'/';
$ret = array();

if( !is_dir($targetFolder) ){
        mkdir($targetFolder	,0777,true);
    }


if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$fileTypes = array('jpg','jpeg','gif','png');
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	$new_name = date("YmdHis").mt_rand(100, 1000).'.'.$fileParts['extension'];
	$targetFile = $targetFolder.$new_name;

	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		if(!file_exists($targetFile)){
			$ret['result_code'] = 0;
        	$ret['result_des'] = 'upload failure';
		}
		else{
			$ret['result_code'] = 1;
			$ret['result_des'] = '/novel/uploads/'.date("Ymd").'/'.$new_name;
		}
	} else {
		$ret['result_code'] = 102;
    	$ret['result_des'] = '图片类型不正确。';
	}
}
else{
	$ret['result_code'] = 101;
	$ret['result_des'] = "获取不到上传文件。";
}
exit(json_encode($ret));
?>