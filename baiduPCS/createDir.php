<?php

	require_once 'BaiduPCS.class.php';
	//请根据实际情况更新$access_token与$appName参数
	$access_token = '21.3d5f9af47d9595765d2d9996ab0402ce.2592000.1391492134.3928023289-1611452';
	//应用目录名
	$appName = 'iLife';
	//应用根目录
	$root_dir = '/apps' . '/' . $appName . '/';

	//要创建的目录路径
	$path = $root_dir . '.1.1.1.';

	$pcs = new BaiduPCS($access_token);
	$result = $pcs->listFiles('/测试应用');

	echo $result;
?>