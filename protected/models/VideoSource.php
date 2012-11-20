<?php

/**
 * This is the MongoDB Document model class based on table "video_source".
 * @property string $name
 */
class VideoSource extends CMonoActiveRecord
{
	public $source;
	public $name;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VideoSource the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated collection name
	 */
	public function getCollectionName()
	{
		return 'video_source';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source', 'length', 'max'=>50),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('source, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'source' => 'Source',
			'name' => 'Name',
		);
	}
}