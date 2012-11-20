<?php

/**
 * This is the MongoDB Document model class based on table "video_keywords".
 */
class VideoKeywords extends VideoDataActiveRecord
{
	public $keyword;
	public $video_date;
	public $object_id;
	public $source_id;
	public $video_type;
	public $source;
	
	protected $_dataObj = null;

	/**
	 * Returns the static model of the specified AR class.
	 * @return VideoKeywords the static model class
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
		return 'video_keywords';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyword', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('video_type,keyword, video_date, object_id, source_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'keyword' => 'Keyword',
			'video_date' => 'Video Date',
			'object_id' => 'Object',
			'source_id' => 'Source',
			'video_type' => 'Video Type'
		);
	}
	
}