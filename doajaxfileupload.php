<?php
	require_once 'getImgInfo.php';
	$base_dir = "upload/";
	$error = "";
	$msg = "";
	$year = "unknow";
	$month = "unknow";
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}
	else if(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
		$response = array(
				"code"=>1,
				"error"=>$error,
				"msg"=>"/upload/".$_FILES['fileToUpload']['name'],
				"year"=>$year,
				"month"=>$month
		);
	}else 
	{
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "upload/".$_FILES['fileToUpload']['name']);
		$filePath = $base_dir.$_FILES['fileToUpload']['name'];
		$imgInfo = new getImgInfo();
		$info = $imgInfo->getImgInfo($filePath);
		$year = substr($info['DateTimeOriginal'], 0,4);
		$year = $year ? $year : "unknow";
		$month = substr($info['DateTimeOriginal'],5,2);
		$month = $month ? $month : "unknow";
		//根据年月存放文件
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
		$newFilePath =  $base_dir.$year."/".$month."/".$_FILES['fileToUpload']['name'];
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
	}		

	echo json_encode($response);
?>