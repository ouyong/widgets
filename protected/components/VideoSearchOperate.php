<?php
/**
 * 视频搜索类
 * @access public
 */
class VideoSearchOperate {

	static public function getInstance() {
		return new self();
	}
	
	
	/**
	 * 自动更新搜索
	 * @access public
	 * @param string Keyword 关键词
	 * @param string Video_type 视频类型
	 * @param string Vidoe_date 视频年代
	 * @param string Vidoe_source 视频来源
	 * @return array
	 * @ParamType Keyword string
	 * 关键词
	 * @ParamType Video_type string
	 * 视频类型
	 * @ParamType Vidoe_date string
	 * 视频年代
	 * @ParamType Vidoe_source string
	 * 视频来源
	 * @ReturnType array
	 */
	public function search($Keyword, $Video_type, $Video_date, $Video_source) {
		// 根据来源查找videoSource查找来源模型
		$videoSource = VideoSource::model()->find(array('source' => $Video_source)); //创建来源模型
		// 根据关键词，年代，来源id 查找VideoKeywords是否有匹配的数据，findAll
		// 关键词需要模糊查询
		$criteria = new EMongoCriteria();
		$criteria->keyword = new MongoRegex("/{$Keyword}.*/i");
		$criteria->video_type = $Video_type;
		$criteria->video_date = new MongoRegex("/{$Video_date}.*/i");
		$criteria->source_id = $videoSource->_id;
		return VideoKeywords::model()->findAll($criteria);
	}

	/**
	 * 查看剧集
	 * @access public
	 * @param string Source 来源
	 * @param string Type 视频类型
	 * @param string Id 数据主键_id
	 * @return array
	 * @ParamType Source string
	 * 来源
	 * @ParamType Type string
	 * 视频类型
	 * @ParamType Id string
	 * 数据主键_id
	 * @ReturnType array
	 */
	public function viewSeries($Source, $Type, $Id) {
		$model = VideoXmlFactory::getInstance()->createClass($Type, $Source);
		return $model->returnArray($Id);
	}
}
?>