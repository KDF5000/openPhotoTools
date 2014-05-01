<?php
  /*require_once 'getImgInfo.php';
  $getImgInfo = new getImgInfo();
  $info = $getImgInfo->getImgInfo('Penguins.jpg');
  echo substr($info['DateTimeOriginal'], 0,4);
  echo substr($info['DateTimeOriginal'], 5,2);*/
  /*  $base_dir = "upload/";
	$fso   = opendir($base_dir);
	echo $base_dir."<hr/>"   ;
	while($flist=readdir($fso)){
		echo $flist."<br/>" ;
	}
	closedir($fso);*/
	$base_dir = "upload/";
	$year = "2014";
	$month = "2";
	$filePath = $base_dir."Penguins.jpg";
	if(!$yearDir = opendir($base_dir.$year)){
	      if(!mkdir($base_dir.$year)){
				$error = "创建目录失败"; 
				return ;
			}
	}
	if(!opendir($base_dir.$year."/".$month)){
		if(!mkdir($base_dir.$year."/".$month)){
			$error = "创建目录失败";
			return ;
		}
	}
	$newFilePath =  $base_dir.$year."/".$month."/"."Desert.jpg";
	if(file_exists($newFilePath)){
		$error = "文件已经存在";
	}
	else{
		if(copy($filePath, $newFilePath))
		{
			if(unlink ($filePath)){
				$filePath = $newFilePath;
			}
		}
	}

	///////////////
	$response = array(
			"code"=>1,
			"error"=>$error,
			"msg"=>$filePath,
			"year"=>$year,
			"month"=>$month
	);
	print_r($response);
?>