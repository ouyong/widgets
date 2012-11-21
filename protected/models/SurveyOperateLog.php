<?php
class SurveyOperateLog extends CMonoActiveRecord{
	
	public $id;
	public $opt_type;
	public $opt_time;
	public $opt_name;
	public $opt_content;
	public $survey_id;
	
	public static function model($className = __CLASS__){
		
		return parent::model($className);
	}
	
	public function getCollectionName() {
		// TODO Auto-generated method stub
		return 'survet_operate_log';
	}
	
	public function rules() {
		return array(
				array('id, opt_type, opt_time,opt_name, opt_content','safe')
		);
	}
	
	public function attributeLabels(){
		
		return array(
				'id'=>'Id',
				'opt_type'=>'类型',
				'opt_time'=>'时间',
				'opt_name'=>'名称',
				'opt_content'=>'内容',
				'survey_id'=>'survey_id',
				
				);
	}

}

?>