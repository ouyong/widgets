<?php

class HemsConfig extends EMongoEmbeddedDocument {

	public $keyword;
	public $columns;
	public $updatetime;
	public $video_date;
	public $video_type;
	public $video_source;
	public $cate;
	public $starring;
	public $description;
	public $is_open;
	
	public function rules() {
		return array(
			array('starring, cate, description, video_type, video_source, video_date, updatetime, keyword, columns','safe'),
		);
	}
	
	
	public function attributeLabels() {
		return array(
			'keyword' => '关键词',
			'columns' => '栏目名',
			'updatetime' => '修改时间',
			'video_date' => '视频年代',
			'video_type' => '视频类型',
			'video_source' => '默认来源',
			'cate' => '类别',
			'starring' => '主演',
			'description' => '简介',
			'is_open' => '是否启用'
		);
	}
	
}

?>