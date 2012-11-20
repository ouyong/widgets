<?php

abstract class VideoFatherXml {

	public $modelName = '';
	public $md5 = '';
	public function returnXml($id) {
		$content = $this->returnArray($id);
		if ($this->md5) {
			$basic = HemsBasic::model()->findByPk($this->md5);
			$content['channel']['cate'] = $basic->config->cate;
			$content['channel']['starring'] = $basic->config->starring;
			$content['channel']['description'] = $basic->config->description;
		}
		$content = ConvertArrayToXml::ToXML($content,'rss');
		return $content;
	}

	public function returnArray($id, $start = 0, $end = null) {
		$arr = $this->getData($id);
		if (empty($arr)) return array();
		return $this->arrStructure($arr, $start, $end);
	}

	public function getData($id){
		$model = new $this->modelName;
		$model = $model->findByPk($id);
		return is_object($model) ? $model->content : array();
	}

	public function isempty($data, $key) {
		return empty($data[$key]) ? '' : $data[$key];
	}

	abstract public function arrStructure($data);
}