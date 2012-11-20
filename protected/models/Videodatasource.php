<?php

class Videodatasource extends VideoDataActiveRecord{
	public $md5;
	public $kid;
	public $title;
	/**
	 * 来源值：vidoesource->name
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $source;
	/**
	 * 来源id
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $source_id;
	/**
	 * 视频类型
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $video_type;
	/**
	 * 微件id
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $typeid;
	/**
	 * 数据id
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $object_id;
	/**
	 * 是否为默认
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $is_default;
	public $is_open;
	public $createtime;
	public $updatetime;
	public $isjing;
	public $jingtime;
	public $isnew;
	public $isdig;
	public $dingtime;
	public $displayorder;
	public $operflag;
		
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/* (non-PHPdoc)
	 * @see EMongoDocument::getCollectionName()
	 */
	public function getCollectionName() {
		// TODO Auto-generated method stub
		return 'playvideodatasource';
	}

	public function rules() {
		return array(
			array('md5, kid, title, source, createtime, updatetime, isjing, jingtime, isnew, isdig, dingtime, displayorder, operflag', 'safe'),
		);
	}

	public function attributeLabels() {
		return array(
			'md5' => 'md5',
			'kid' => 'kid',
			'title' => '标题',
			'source' => '来源',
			'createtime' => '创建时间',
			'updatetime' => '修改时间',
			'isjing' => '是否加精',
			'jingtime' => '加精时间',
			'isnew' => '是否为新',
			'isdig' => '是否置顶',
			'dingtime' => '置顶时间',
			'displayorder' => '排序',
			'is_default' => '是否为默认',
			'is_open' => '是否启用',
			'operflag' => 'operflag'
		);
	}
	
	protected function beforeSave() {
		if ($this->isNewRecord) {
			$this->is_open ='1';
			$this->displayorder = '0';
		}
		return parent::beforeSave();
	}
	
}

?>