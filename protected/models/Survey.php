<?php

class  Survey extends CMonoActiveRecord{
	
	public $title;
	public $picpath;
	public $vote_type;
	public $creater_id;
	public $creater_nickname;
	public $creater_email;
	public $keyword;
	public $create_time;
	public $vote_count;
	public $vote_start_time;
	public $vote_end_time;
	public $audit_type;
	public $audit_name;
	public $audit_date;
	public $audit_state;
	public $md5;
	
	/**
	 * 
	 * @param unknown_type $className
	 * @return Ambigous <EMongoDocument, unknown, multitype:>
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see EMongoDocument::getCollectionName()
	 */
	public function getCollectionName()
	{
		return 'survey';
	}
	
	public function rules(){
		return array(
			array('title, picpath, md5','length','max'=>125),
			array('vote_type, creater_id, creater_nickname, vote_count, audit_type, audit_state','type','integer'),
			array('keyword','length','max'=>64),
			array('audit_name','length','max'=>255),
			array('title, picpath, vote_type, creater_id, creater_nickname, creater_email, keyword, create_time, vote_count, vote_start_time, vote_end_time, audit_type, audit_name, audit_date, audit_state, md5','safe'),
		);
	}
	
	
	/**
	 * 
	 * @return multitype:string
	 */
	public function attributeLabels(){
		return array(
				'title'=>'标题',
				'picpath'=>'图片地址',
				'vote_type'=>'投票类型',
				'creater_id'=>'创建者id',
				'creater_nickname'=>'创建者的昵称',
				'creater_email'=>'创建者的email',
				'keyword'=>'关键词',
				'create_time'=>'创建时间',
				'vote_count'=>'投票总数',
				'vote_start_time'=>'投票开始时间',
				'vote_end_time'=>'投票结束时间',
				'audit_type'=>'审核类型',
				'audit_name'=>'审核人名字',
				'audit_date'=>'审核日期',
				'audit_state'=>'审核状态',
				'md5'=>'md5',
		);
	}
	
}