<?php
/**
 * Hems数据操作
 * @access public
 */
class HemsDataOperate {

	static public function getInstance() {
		return new self();
	}
	
	/**
	 * 设为默认
	 * @access public
	 * @param string aId 数据主键
	 * @param string aMd5 加密字段
	 * @param string typeid 微件id
	 * @return boolean
	 * @ParamType aId string
	 * 数据主键
	 * @ParamType aMd5 string
	 * 加密字段
	 * @ReturnType boolean
	 */
	public function setDefault($aId, $aMd5, $typeid) {
		$model = $this->getModel($aId);
		// 根据md5查找vidoeDataSource，将所有默认字段改为0，将id查找数据默认字段改为1
		$modifier = new EMongoModifier();
		$modifier->addModifier('is_default', 'set', '0');
		$criteria = new EMongoCriteria();
		$criteria->addCond('md5','==', $aMd5);
		$result = Videodatasource::model()->updateAll($modifier,$criteria);
		
		if ($result['updatedExisting']) {
			$model->is_default = '1';
			return $model->save();
		}
		return false;
	}

	/**
	 * 选用
	 * @access public
	 * @param string aMd5 加密参数
	 * @param sting aKid 关键词id
	 * @param string aSource 视频来源
	 * @param sting aDataid 数据id
	 * @param string aVideoType 视频类型
	 * @param string aKeyword 关键词
	 * @param string aTypeid 微件id
	 * @return boolean
	 * @ParamType aMd5 string
	 * 加密参数
	 * @ParamType aKid sting
	 * 关键词id
	 * @ParamType aSource string
	 * 视频来源
	 * @ParamType aDataid sting
	 * 数据id
	 * @ParamType aVideoType string
	 * 视频类型
	 * @ParamType aKeyword string
	 * 关键词
	 * @ParamType aTypeid string
	 * 微件id
	 * @ReturnType boolean
	 */
	public function selectOf($md5, $kid, $source,  $dataid, $videoType, $keyword, $typeid) {
		
		// 根据source和md5查找 videoDataSource，
		$videoModel = new Videodatasource();
		$videoData = $videoModel->findByAttributes(array('source'=>$source,'md5'=>$md5));
		$obj = is_object($videoData) ? $videoData : $videoModel;
		$message = is_object($videoData) ? '覆盖成功！' : '操作成功！';
		//根据source查找videoSource $sourceObj
		$sourceObj = VideoSource::model()->findByAttributes(array('source'=>$source));
		
		//根据kid,typeid查找hemsBase $baseObj
		$baseObj = HemsBasic::model()->findByAttributes(array('kid'=>$kid,'typeid'=>$typeid));
		if (!is_object($baseObj)) {
			$baseObj = new HemsBasic();
			$baseObj->kid = $kid;
			$baseObj->typeid = $typeid;
			$baseObj->_id = $md5;
			$baseObj->config->video_source = $source;
			$baseObj->config->columns = '视频播放';
			$baseObj->save();
		}
		// 有值为修改，无为添加(根据source和md5查找 videoDataSource)
		//对videoDataSource进行赋值,保存
		//赋值内容(md5,title = keyword，source, source_id, kid, is_default)
		//其中的is_default字段的值，根据source与$baseObj->video_source相等为1，否则为0
		$obj->typeid = $typeid;
		$obj->object_id = $dataid;
		$obj->title = $keyword;
		$obj->md5 = $md5;
		$obj->title = $keyword;
		$obj->source = $source;
		$obj->source_id = $sourceObj->_id;
		$obj->video_type = $videoType;
		$obj->kid = $kid;
		$obj->is_default = $source == $baseObj->config->video_source ? '1' : '0'; 
		if ($obj->save()) {
			$basicModel = HemsBasic::model()->findByPk($obj->md5);
			$basicModel->config->video_source = $obj->source;
			$model = VideoXmlFactory::getInstance()->createClass($obj->video_type, $obj->source);
			$data = $model->returnArray($obj->object_id);
			$basicModel->config->cate = $data['channel']['cate'];
			$basicModel->config->starring = $data['channel']['starring'];
			$basicModel->config->description = $data['channel']['description'];
			$basicModel->save();
			return $message;
		}
		return '操作失败！';
		//返回保存结果
	}

	/**
	 * 排序
	 * @access public
	 * @param int sort 值只能为1或者-1
	 * @param string id 主键id
	 * @param string moveId 移动目标id
	 * @return boolean
	 * @ParamType sort int
	 * 值只能为1或者-1
	 * @ParamType id string
	 * 主键id
	 * @ParamType moveId string
	 * 移动目标id
	 * @ReturnType boolean
	 */
	public function move($sort, $id, $moveId) {
		// 判断moveid是否为空，为空直接返回false
		if (empty($moveId)){
			return false;
		}else {
			// 不为空，根据id查找VideoDataSource表数据 obj
			$model = Videodatasource::model()->findByPk($id);
			//根据moveid查出数据 moveObj
			$moveObj = Videodatasource::model()->findByPk($moveId);
			//obj的排序字段displayorder += sort 
			$model->displayorder += $sort;
			$model->save();
			//moveObj的排序字段display -= sort
			$moveObj->displayorder -= $sort;
			$moveObj->save();
			//对obj和moveObj进行保存，返回保存结果,true或false；
			return true;
		}
	}

	/**
	 * 启用或关闭
	 * @access public
	 * @param string id 数据主键
	 * @param sting status 状态值：1开启，0关闭
	 * @return boolean
	 * @ParamType id string
	 * 数据主键
	 * @ParamType aStatus sting
	 * 状态值：1开启，0关闭
	 * @ReturnType boolean
	 */
	public function open($id, $status) {
		//根据id查找 vidoeDataSource数据
		$model = $this->getModel($id);
		//查找为空，返回false
		if(is_object($model)) {
			//对该条数据的状态值等于status参数
			$model->is_open = $status;
			//进行保存，返回保存结果 true或false
			return $model->save();
			
		}
		return false;
		
		
	}

	/**
	 * 返回数据
	 * @access public
	 * @param sting md5 加密参数
	 * @return array
	 * @ParamType md5 string
	 * 加密参数
	 * @ReturnType array
	 */
	public function search($md5) {
		
		// 条件可使用 EMongoCriteria == yii的Criteria
		$criteria = new EMongoCriteria();
		$criteria->md5 = $md5;
		// 条件为根据默认倒序，排序字段正序
		$criteria->sort('is_default',EMongoCriteria::SORT_DESC);
		$criteria->sort('displayorder',EMongoCriteria::SORT_ASC);
		
		//根据md5查找 VideoDataSource 的数据 findAll
		return Videodatasource::model()->findAll($criteria);
	}

	/**
	 * 返回对象实例
	 * @access public
	 * @param string aId 数据主键
	 * @return object
	 * @ParamType aId string
	 * 数据主键
	 * @ReturnType object
	 */
	public function getModel($aId) {
		$model = new Videodatasource();
		
		// 判断id是为空，
		if (empty($aId)){
			// 为空用直接返回一个new VideoDataSource的实例
			return $model;
		}else {
			// 不为空，根据id查找VideoDataSource的实例返回
			return $model->findByPk($aId);
		}
	}
}
?>