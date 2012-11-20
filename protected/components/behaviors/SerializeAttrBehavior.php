<?php

class SerializeAttrBehavior extends CActiveRecordBehavior{
	
	public $attributes = array();
	
	public function beforeSave($event){
		$owner = $this->getOwner();
		
		foreach ($this->attributes as $attribute) {
			$owner->$attribute = serialize($this->XmlToArray($owner->$attribute));
		}
		
	}
	
	public function afterFind($event){
		$owner = $this->getOwner();
		foreach ($this->attributes as $attribute){
			$owner->$attribute = unserialize($owner->$attribute);
		}
		
	}
	
	
	// Xml 转 数组, 不包括根键
	public function XmlToArray($xml){
		return json_decode(json_encode((array) simplexml_load_string($xml)),1);
	}
	
}

?>