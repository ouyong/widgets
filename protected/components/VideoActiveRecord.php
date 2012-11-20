<?php
abstract class VideoActiveRecord extends CMonoActiveRecord{

	public function behaviors() {
		return array_merge(parent::behaviors(), array(
			'serializeAttr' => array(
				'class' => 'application.components.behaviors.SerializeAttrBehavior',
				'attributes' => array(
					'content',
				),
			),
		));
	}
	
	abstract public function getLastDate();
	
	abstract public function getVideoNum();
}