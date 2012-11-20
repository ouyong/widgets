<?php
/**
 * 把xml的数据转化为数组，序列化存进表中，取出序列化为数组
 * Enter description here ...
 * @author nijn
 *
 */
class XmlAttBehavior extends CActiveRecordBehavior{

	public $attributes = array();
	
	/**
	 * 将xml的字段序列化存进表中
	 * (non-PHPdoc)
	 * @see CActiveRecordBehavior::beforeSave()
	 */
	public function beforeSave($event) {
		$owner = $this->getOwner();
		foreach ($this->attributes as $attribute) {
			$owner->$attribute = serialize($this->xmlToArray($owner->$attribute));
		}
	}
	
	/**
	 * 将序列化的字段转为数组
	 * (non-PHPdoc)
	 * @see CActiveRecordBehavior::afterFind()
	 */	
	public function afterFind($event) {
		$owner = $this->getOwner();
		foreach ($this->attributes as $attribute) {
			$owner->$attribute = unserialize($owner->$attribute);
		}
	}
	
	/**
	 * 将xml转化为数组
	 * Enter description here ...
	 * @param unknown_type $xml
	 */
	public function xmlToArray($xml) {
		
		return array(); 
	}
}

?>