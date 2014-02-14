
<?php 
	require_once 'baiduBCSOP.class.php';
//

//	$bcsOp = new baiduBCSOP('lifedata');
//	echo "<img src='./fold.png' width='200' height='200'></img>";
	//测试获取所有对象
//	$allobject = $bcsOp->findAllObject('lifedata','/');

// 	foreach ($allobject as $imgUIL){
// 		$imgUrl =  $bcsOp->getUrlByObject($imgUIL);
// 		echo "<img src='$imgUrl' name='$imgUIL'width='200'height='200'></img>";
// 	}
// 	echo '<br/>';
// 	$childDir = $bcsOp->findChildDir('/');
	
// 	echo "<a href='#'>".$childDir[0]['object']."</a><br/>";

/****************************************************************************************
*初始化等操作
*****************************************************************************************/
	$bcsOp = new baiduBCSOP('lifedata');
	$dir = '/';
	if(isset($_GET['dir'])){
		$dir = $_GET['dir'];
	}
	$childDir = $bcsOp->findChildDir($dir);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="./jquery.js"></script>
	<title>MyLife</title>
<style>
	div.img{
	  margin:3px;
	  border:1px solid #bebebe;
	  height:auto;
	  width:auto;
	  float:left;
	  text-align:center;
	}
	div.img img{
	  margin:3px;
	  border:1px solid #bebebe;
	}
	div.img a:hover img{
	  border:1px solid #333333;
	}
	div.desc{
	  text-align:center;
	  font-weight:normal;
	  width:150px;
	  font-size:12px;
	  margin:10px 5px 10px 5px;
    }
</style>
</head>
<body>
<?php 
	foreach($childDir as $tmp){
		echo "<div class='img'>";
		if($tmp['is_dir']==1){
			echo "<a><img class='img_fold' alt='{$tmp['object']}' src='./fold.png'name='{$tmp['object']}'></img></a>";
		}else{
			$imgUrl =  $bcsOp->getUrlByObject($tmp['object']);
			echo "<a><img class='' alt='{$tmp['object']}'src='{$imgUrl}'  name='{$tmp['object']}'></img></a>";
		}
		echo "<div class='desc'>{$tmp['object']}</div>";
		
		echo "</div>";
	}
?>
</body>
</html>
<script>
$(document).ready(function($) {
	$('.img_fold').click(function(event) {
		/* Act on the event */
			var dir = $(this).attr('name');
			alert(dir);
			location.href = "demo2.php?dir="+ dir;
	});
});
</script>