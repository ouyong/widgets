<?php

class VoteMark extends CMonoActiveRecord {
	
	public $ip;
	public $nickname;
	public $mark_time;
	public $survey_id;
	
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
	public function getCollectionName() {
	
		return 'vote_mark';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		
		return array(
				
				array('ip', 'length', 'max'=>50),
				array('nickname', 'length', 'max'=>100),
				array('survey_id', 'length', 'max'=>10),
				array('ip, nickname, mark_time, survey_id', 'safe'),
				);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
				'ip' => 'Ip',
				'nickname' => 'NickName',
				'mark_time' => 'MarkTime',
				'survey_id' => 'SurveyId',
				);
	}
}

?>