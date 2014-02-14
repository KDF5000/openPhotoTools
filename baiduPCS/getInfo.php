<?php
	require_once('BaiduPCS.class.php');
	//设置access_token
	$access_token = '23.a1af3a5569394104ee4316b6e6548aab.2592000.1391407249.3928023289-1611452';
	$pcs = new BaiduPCS($access_token);
	
	if(!($data = $pcs->getQuota())){
		return ;
	}
	else{
		echo $data;
	}
?>