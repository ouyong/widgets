<?php

class VideoSync extends CComponent{

	public $url = '';
	public $source = null;
	public $type = null;
	protected $_config = null;
	
	protected function getConfig() {
		if (!$this->_config) {
			$this->_config = include Yii::app()->basePath.'/config/video/config.php';
		}
		return $this->_config;
	}
	
	public function sync($isAll = false) {
		foreach ($this->config as $source=>$value){
			foreach ($value as $videoType=>$v){
				if (is_array($v)){
					$this->url = $isAll ? $v['all_url'] : $v['increment_url'];
					$this->source = $source;
					$this->type = $videoType;
					if (!$this->convert()) {
						Yii::trace('数据保存错误', 'videoSync');
					}
				}
			}
		}
	}
	
 	protected function mapping($modelName, $o2) {
        $model = new $modelName;
        $model->content = $o2->asXML();
        if ($model->save()) {
        	return $model->_id;
        }else 
	    	return false;
    }
    
    
	protected function saveXml(){
		ini_set('max_execution_time', '18000');
		$result = true;
		//先用综艺来做事例varietyshow
	    $xml = simplexml_load_file($this->url, 'SimpleXMLElement', LIBXML_NOCDATA);
	    $modelStr = ucfirst($this->source).ucfirst($this->type);
		
	    foreach ($xml as $url){
	    	$vkeywords = new VideoKeywords();//关键词表
	    	$configaArr = isset($this->_config[$this->source][$this->type]) ? $this->_config[$this->source][$this->type]['attributes'] : array();
	    	$criteria = new EMongoCriteria();
	    	foreach ($configaArr as $key=>$one) {
	    		$value = (string)CHtml::value($url, $one);
	    		$criteria->$key = new MongoRegex("/{$value}.*/i");
	    	}
	    	$criteria->source_id = $this->_config[$this->source]['id'];
	    	$criteria->source = $this->source;
	    	$criteria->video_type = $this->type;
	    	if ($vkeywords->find($criteria)) continue;
	    	$id  = $this->mapping($modelStr, $url);
	    	$result = $result && $id;
	    	if ($result) {
	    		foreach ($configaArr as $key=>$one) {
		    		$vkeywords->$key = (string)CHtml::value($url, $one);
		    	}
		    	$vkeywords->source_id = $this->_config[$this->source]['id'];
		    	$vkeywords->source = $this->source;
		    	$vkeywords->video_type = $this->type;
		    	$vkeywords->object_id = $id;
		    	$result = $result && $vkeywords->save();
	    	} else 
	    		continue;
	    	
	    }
	    return $result;
	}
	
	/**
	 *
	 * Enter description here ...
	 */
	public function convert() {
		return $this->saveXml();
	}
	
}

?>