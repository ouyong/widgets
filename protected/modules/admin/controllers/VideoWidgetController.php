<?php

class VideoWidgetController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

/** 
	 * 添加视频微件
	 */
	public function actionAddVideowidget(){
		$this->render('addVideowidget');
	}
	
	/**
	 * 高级设置参数
	 * 
	 */
	public function actionSettingVideoWidget(){
		
		$this->render('settingVideoWidget');
	}
	
	/**
	 * 修改微件的所有参数保存
	 * 
	 */
	public function actionUpdateVideoWidget(){
		$this->render('updateVideoWidget');
	}
	
	/**
	 * 自动更新 设置搜索选项条件
	 * 
	 */
	public function actionSettingAutomaticUpdate(){
		$this->render('settingAutomaticUpdate');
	}
	
	/**
	 * 自动更新 设置搜索选项条件
	 * 
	 */
	public function actionAddVideoContent(){
		$this->render('addVideoContent');
	}
}