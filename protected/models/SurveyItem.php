<?php
class SurveyItem extends CMonoActiveRecord{

	public $id;
	public $survey_id;
	public $item_title;
	public $item_vote_count;
	public $item_ratio;
	
	public static function model($className=__CLASS__){
		
		return parent::model($className);
	}
	
	public function getCollectionName() {
		// TODO Auto-generated method stub
		return 'survet_operate_log';
	}

	public function rules(){
		return array(
				array('id, survey_id, item_title,item_vote_count, item_ratio','safe')
		);
	}
	
	public function attributeLabels(){
		return array(
				'id'=>'ID',
				'survey_id'=>'survey_id',
				'item_title'=>'标题',
				'item_vote_count'=>'计票结果',
				'item_ratio'=>'item_ratio'
				);
		
	}
	
}

?>