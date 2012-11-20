<?php
class Video extends CWidget{
	
	public $model = NULL;
	
	public function init(){
		parent::init();
	}
	
	
	public function run(){
		$this->render('searchVideo',array('data'=>$this->model));
	}
	
}