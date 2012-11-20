<?php
class VideoSearch extends CComponent{
	
	public function init(){
		parent::init();
	}
	
	public function run($soruce, $type, $keyword, $video_date){
		$criteria = new EMongoCriteria();
		$criteria->keyword = $keyword;
		$criteria->video_type = $type;
		$criteria->video_date = new MongoRegex("/{$video_date}.*/i");
		$model = VideoKeywords::model()->find($criteria);
		if (is_object($model)) {
			$source = VideoSource::model()->findByPk($model->source_id);
			$class = VideoFactory::getInstance()->createClass($type, $soruce);
			return $class->returnArray($model->object_id);
		}
		return array();
	}
}