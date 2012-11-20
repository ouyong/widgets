<?php

class HemsBasic extends CMonoActiveRecord{
	public $ifdone;
	public $igid;
	public $kid;
	public $typeid;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/* (non-PHPdoc)
	 * @see EMongoDocument::getCollectionName()
	 */
	public function getCollectionName() {
		// TODO Auto-generated method stub
		return 'hems_basic';
	}

	public function rules() {
		return array(
			array('ifdone, igid, kid, typeid', 'safe', 'on'=>'search')
		);
	}
	
	public function embeddedDocuments() {
	    return array(
	        'config' => 'HemsConfig',
	    );
	}
	
	protected function beforeSave() {
		$this->ifdone = 1;
		return parent::beforeSave();
	}
    
	
	public function attributeLabels() {
		return array(
			'ifdone' => 'ifdone',
			'igid' => 'igid',
			'kid' => 'kid',
			'typeid' => 'typeid',
		);
	}
	
	public function behaviors() {
		return array_merge(parent::behaviors(), array(
			'sourceDefault' => 'application.components.behaviors.SourceDefaultBehavior'
		));
	}
}

?>