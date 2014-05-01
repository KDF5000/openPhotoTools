<?php
class getImgInfo {
	function getImgInfo($imgPath){
		$imgBrifInfo = array();
		$imgInfoAll = exif_read_data($imgPath,0,1);
		foreach($imgInfoAll as $section => $arrValue){ 
            foreach($arrValue as $key => $value){ 
                    $infoAllKey[] = $key; 
                    $infoAllValue[] = $value; 
                } 
         } 
         $infoAll = array_combine($infoAllKey,$infoAllValue);
         $briefInfo =  array(
         		'FileName'=>$infoAll['FileName'],
         		'DateTimeOriginal'=>$infoAll['DateTimeOriginal'],
         		'FileDateTime'=>$infoAll['FileDateTime'],
         		'FileSize'=>$infoAll['FileSize'],
         		'Height'=>$infoAll['Height'],
         		'Width'=>$infoAll['Width']
         );
         return $briefInfo;
	}
}

?>