<?php 
	require_once 'baiduBCSOP.class.php';
	
	$year = isset($_GET["year"]) ? $_GET["year"] : "2013";
	$month = isset($_GET["month"]) ? $_GET["month"] : "5";
	
	$bcsOp = new baiduBCSOP('lifedata');
	$dir = "/".$year."/".$month."/";
	$res = $bcsOp->findChildDir($dir);
	$urls = array();
	foreach ($res as $object)
	{
		if($object['is_dir']==0){
			$tmp = $bcsOp->getUrlByObject($object['object']);
			array_push($urls,$tmp);
		}
	}
	echo json_encode($urls);
?>