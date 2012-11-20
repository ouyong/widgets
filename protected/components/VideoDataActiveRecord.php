<?php

abstract class VideoDataActiveRecord extends CMonoActiveRecord{

	protected $_dataObj = null;
	/**
	 * 数据来源
	 * Enter description here ...
	 */
	public function getSourceObj() {
		return VideoSource::model()->findByPk($this->source_id);
	}
	
	public function getDataObj() {
		if ($this->_dataObj == null) {
			$model = VideoModelFactory::factory($this->source, $this->video_type);
			return $model->findByPk($this->object_id);
		}
		return $this->_dataObj;
	}
	
	public function getLastDate() {
		return $this->dataObj->lastDate;
	}
	
	public function getVideoNum() {
		return $this->dataObj->videoNum;
	}
}

?>