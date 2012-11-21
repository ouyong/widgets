<?php

class SurveyCateRelated extends CMonoActiveRecord {
	
	public $category_name;
	public $survey_id;
	public $category_id;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VideoSource the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	/**
	 * @return string the associated collection name
	 */
	public function getCollectionName() {
	
		return 'survey_cate_related';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
				array('category_name', 'length', 'max'>=50),
				array('survey_id', 'length', 'max'=>10),
				array('category_id', 'length', 'max'=>10),
				array('category_name, survey_id, category_id', 'safe'), 
				);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		
		return array(
				'category_name' => 'CategoryName',
				'survey_id' => 'SurveyId',
				'category_id' => 'CategoryId',
				);
		
	}
	
}

?>