<?php 
	/*
	 * 对bucket的操作
	 * 作者：孔德飞
	 * 时间：2014.1.12
	 */
require_once './libs/bcs.class.php';

	class baiduBCSOP{
		private $baiduBcs;
		private  $bucket;

		function __construct($bucket){
			$this->baiduBcs = new BaiduBCS();
			$this->bucket = $bucket;
		}
		
		function setBucket($bucket){
			$this->bucket = $bucket;
		}
		//将object转化为数组
		function objToArray($obj){
			$res = array();
			foreach ($obj as $key=>$val){
				if(gettype($val)=="array" || gettype($val)=="object" )
				{
					$res[$key] = $this->objToArray($val);
				}
				else
				{
					$res[$key] = $val;
				}
			}
			return $res;
		}
		//递归找出所有的对象
		function findAllObject($bucket,$dir='/'){
			$res = $this->baiduBcs->list_object_by_dir($bucket,$dir);
			$resArray = array();
			$objectArray = array();
			if($res->isOK()){
				$temp = json_decode($res->body);
				$resArray = $this->objToArray($temp);
			}
			$object_total = $resArray['object_total'];
			if($object_total==0){
				return ;
			}
			foreach ($resArray['object_list'] as $object){
				if($object['is_dir'] == 1){
					$objectArray = array_merge($objectArray,$this->findAllObject($bucket,$object['object']));
				}else{
					array_push($objectArray, $object['object']);
				}
			}
			return $objectArray;
		}
		//根据目录找到下面所有的子目录或者文件
		function findChildDir($dir){		
			$res = $this->baiduBcs->list_object_by_dir($this->bucket,$dir);
			$resArray = array();
			$objectArray = array();
			if($res->isOK()){
				$temp = json_decode($res->body);
				$resArray = $this->objToArray($temp);
			}
			$object_total = $resArray['object_total'];
			if($object_total==0){
				return ;
			}
			foreach ($resArray['object_list'] as $object){
					array_push($objectArray, array('object'=>$object['object'],'is_dir'=>$object['is_dir']));
			}
			return $objectArray;
		}
		//通过制定对象生成url
		function getUrlByObject($object){
			$baiduBcs = new BaiduBCS();
			return $baiduBcs->generate_get_object_url($this->bucket, $object);
		}
	}
?>