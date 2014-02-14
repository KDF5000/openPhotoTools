<?php 
	require_once './libs/bcs.class.php';
	
	$bucket = 'demo' . time () . "-" . rand ( 1000, 999 );
	$baiduBcs = new BaiduBCS();
	$array =  array();
	//创建一个bucket
	$response = $baiduBcs->create_bucket($bucket);
	if($response->isOK()){ 
		echo 'create succeefully';
	}else{
		echo "failed to create a bucket";
	}
	echo '<br/>--------------------------------------------<br/>';
	//获取bucket的列表
	$buketList = $baiduBcs->list_bucket();
	if($buketList->isOK()){
		print_r($buketList->body);
	}else{
		echo '获取失败';
	}
	
	echo '<br/>--------------------------------------------<br/>';
	//上传一个对象
	$object = '/test/test.txt';
	$uploadFile = './test.txt';
	$upRes = $baiduBcs->create_object($bucket, $object, $uploadFile);
	if($upRes->isOK()){
		echo "upload file $object to $bucket"; 
	}else{
		echo 'failed to upload file'.$object;
	}
	echo '<br/>--------------------------------------------<br/>';
	//下载指定对象
	/**
	如果没有指定$opt则可以通过返回值的body属性获得object的内容，如果指定则会见文件写到writeTofile指定的文件内
	 */
	$downloadTo = './test'. time ().'.txt';
	$opt = array("fileWriteTo"=>$downloadTo);
	$getRes = $baiduBcs->get_object($bucket, $object,$opt);
	if($getRes->isOK()){
		print_r($getRes->body);
	}else{
		echo 'failed to get '.$object;
	}
	echo '<br/>--------------------------------------------<br/>';
// 	//删除对象
// 	$delRes = $baiduBcs->delete_object($bucket, $object);
// 	if($delRes->isOK()){
// 		echo '删除'.$object.'成功';
// 	}else{
// 		echo '删除'.$object.'失败';
// 	}
// 	echo '<br/>--------------------------------------------<br/>';
// 	$delBuckRes = $baiduBcs->delete_bucket ( $bucket);
// 	if (! $delBuckRes->isOK ()) {
// 		die ( "Delete bucket failed." );
// 	}
// 	echo "Delete bucket[$bucket] success\n";
// 	echo '<br/>--------------------------------------------<br/>';

	$returnIfno = $baiduBcs->get_object_info($bucket, $object);
	if($returnIfno->isOK()){
		print_r($returnIfno->header);
	}else{
		echo 'faild to get info';
	}
	echo '<br/>--------------------------------------------<br/>';
?>