<?php

	require_once 'BaiduPCS.class.php';
	//请根据实际情况更新$access_token
	$access_token = '23.a1af3a5569394104ee4316b6e6548aab.2592000.1391407249.3928023289-1611452';
	
	$pcs = new BaiduPCS($access_token);
	echo $pcs->getQuota();
?>