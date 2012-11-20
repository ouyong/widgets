<?php
/**
 * HemsBase操作类
 * @access public
 */
class ConfigOperate {
	static public function getInstance() {
		return new self();
	}
	
	/**
	 * 搜索model
	 * Enter description here ...
	 * @param unknown_type $kid 关键词id
	 * @param unknown_type $typeid 微件id
	 * @param array $get GET值
	 */
	public function getHemsConfigSearch($kid, $typeid, $get = array()) {
		if(empty($get)) {
			$model = HemsBasic::model()->findByAttributes(array('kid'=>(string)$kid, 'typeid'=>(string)$typeid));
			
			return is_object($model) ? $model->config : new HemsConfig();
		}
		$model = new HemsConfig();
		$model->attributes = $get;
		return $model;
	}
	
	/**
	 * 设置操作
	 * @access public
	 * @param string aKid 关键词id
	 * @param string aTypeid 微件id
	 * @param array aConfigArr HemsBase中的config的字段：
	 * keyword:关键词
	 * columns:栏目
	 * video_date:视频年代
	 * video_type:视频类型
	 * video_source:默认来源
	 * is_open:是否开启
	 * @ParamType aKid string
	 * 关键词id
	 * @ParamType aTypeid string
	 * 微件id
	 * @ParamType aConfigArr array
	 * HemsBase中的config的字段：
	 * keyword:关键词
	 * columns:栏目
	 * video_date:视频年代
	 * video_type:视频类型
	 * video_source:默认来源
	 * is_open:是否开启
	 */
	public function set($kid, $typeid, $md5, $configArr) {
		
		$criteria = new EMongoCriteria();
		$criteria->kid = (string) $kid;
		$criteria->typeid = (string) $typeid;
		$obj = HemsBasic::model()->find($criteria);
		$model = new HemsBasic();
		$model->config->columns = CHtml::value($obj, 'config.columns') ? CHtml::value($obj, 'config.columns') : '视频播放';
		if (is_object($obj)) {
			$model->attributes = $obj->attributes;
			$model->config = $obj->config;
		}
		// 判断configArr是否为空
		if(!empty($configArr)) {
			HemsBasic::model()->deleteAll($criteria);
			
			//不为空对HemsBase的数据进行保存
			$model->config = $configArr;
			$model->kid = $kid;
			$model->typeid = $typeid;
			$model->_id = $md5;
			//返回是否保存成功
			return $model->save();
		}
		
		return $model;
		
	}
	
	/**
	 * 获取视频栏目名
	 * 
	 * */
	public function setColumns($kid, $typeid) {
		$model = HemsBasic::model()->findByAttributes(array(
			'kid' => (string) $kid,
			'typeid' => (string) $typeid,
		));
		$model =  is_object($model) ? $model : new HemsBasic();
		//$model->config->columns = CHtml::value($model, 'config.columns') ? CHtml::value($model, 'config.columns') : '视频播放';
		
		return $model;
		
	}
}
?>