<?php

class VideoController extends Controller
{
	public $layout = '//layouts/column3';
	
	public function getParams() {
		return array(
			'kid' => isset($_GET['kid']) ? $_GET['kid'] : '33682',
			'md5' => isset($_GET['md5']) ? $_GET['md5'] : 'd89092d19ac43d750197945ed72ec66e',
			'typeid' => isset($_GET['typeid']) ? $_GET['typeid'] : '60',
			'keyword' =>isset($_GET['keyword']) ? $_GET['keyword'] : '测试-地图8',
		);
	}

	/**
	 * 自动更新
	 * Enter description here ...
	 */
	public function actionSync($isall = 0) {
		$video = new VideoSync();
		$video->sync($isall);
		echo 'successfully!!!';die;
	}
	
	/**
	 * 返回xml结构数据
	 * Enter description here ...
	 * @param unknown_type $source
	 * @param unknown_type $type
	 * @param unknown_type $dataid
	 */
	public function actionDataXml($source, $type, $dataid, $md5) {
		$model = VideoXmlFactory::getInstance()->createClass($type,$source);
		$model->md5 = $md5;
		$xml = $model->returnXml($dataid);
		header('content-type:text/xml');
		echo $xml;die;
	}
	
	/**
	 * 上移/下移
	 * Enter description here ...
	 * @param unknown_type $dataid
	 * @param unknown_type $sort
	 * @param unknown_type $moveId
	 */
	public function actionMove($dataid, $sort, $moveId) {
		$message = HemsDataOperate::getInstance()->move($sort, $dataid, $moveId) ? '操作成功！' : '操作失败！';
		echo json_encode(array('message'=>$message,'url'=>Yii::app()->request->urlReferrer));
		Yii::app()->end();
	}
	
	/**
	 * 设为默认
	 * Enter description here ...
	 * @param unknown_type $dataid
	 * @param unknown_type $md5
	 * @param unknown_type $typeid
	 */
	public function actionSetDefault($dataid, $md5, $typeid) {
		$message = HemsDataOperate::getInstance()->setDefault($dataid, $md5, $typeid) ? '操作成功！' : '操作失败！';
		echo json_encode(array('message'=>$message,'url'=>Yii::app()->request->urlReferrer));
		Yii::app()->end();
	}
	
	/**
	 * 启用/关闭
	 * Enter description here ...
	 * @param unknown_type $dataid
	 * @param unknown_type $status
	 */
	public function actionOpen($dataid, $status) {
		$message = HemsDataOperate::getInstance()->open($dataid, $status) ? '操作成功！' : '操作失败！';
		echo json_encode(array('message'=>$message,'url'=>Yii::app()->request->urlReferrer));
		Yii::app()->end();
	}
	
	/**
	 * 列表
	 * Enter description here ...
	 * @param unknown_type $kid
	 * @param unknown_type $md5
	 * @param unknown_type $typeid
	 * @param unknown_type $keyword
	 */
	public function actionIndex($kid = '33682', $md5 = 'd89092d19ac43d750197945ed72ec66e', $typeid = '60', $keyword = '测试-地图8')
	{
		$model = ConfigOperate::getInstance()->setColumns($kid, $typeid);

		$this->render('index',array(
									'data'=>HemsDataOperate::getInstance()->search($md5),
									'model'=>$model
								));
	}
	
	
	/**
	 * 查看剧集
	 * Enter description here ...
	 * @param unknown_type $source
	 * @param unknown_type $type
	 * @param unknown_type $id
	 */
	public function actionViewSeries ($source, $type, $dataid) {
		$this->renderPartial('view_series',array(
			'title' => '查看剧集',
		));
	}
	
	public function actionDataSeries ($source, $type, $dataid) {
		$data = VideoSearchOperate::getInstance()->viewSeries($source, $type, $dataid);
		$dataProvider = new CArrayDataProvider($this->componentArr($data['channel']['title'],$data['channel']['items']), array(
			'pagination' => array('pageSize' => 12),
			'keyField' => 'title',
		));
		
		$this->renderPartial('data_series',array(
			'dataProvider' => $dataProvider,
		));
	}
	
	public function componentArr($name, $data) {
		$arr = array();
		foreach ($data as $one) {
			if (is_numeric($one['title'])) $one['title'] = $name.$one['title'];
			$arr[] = $one;
		}
		return $arr;
	}
	
	/**
	 * 自动更新搜索
	 * Enter description here ...
	 */
	public function actionManualUpdate($kid, $typeid, $keyword){
		$model = ConfigOperate::getInstance()->getHemsConfigSearch($kid, $typeid, empty($_GET['HemsConfig']) ? array() : $_GET['HemsConfig']);
		$model->keyword = $model->keyword ? $model->keyword : $keyword;
		$data = array();
		if (isset($_GET['HemsConfig'])) {
			$data = VideoSearchOperate::getInstance()->search(
				$_GET['HemsConfig']['keyword'], 
				$_GET['HemsConfig']['video_type'], 
				$_GET['HemsConfig']['video_date'], 
				$_GET['HemsConfig']['video_source']
			);
		}
		$this->render('manualUpdate',array(
			'data' => $data,
			'model' => $model
		));
	}
	
	/**
	 * 选用
	 * Enter description here ...
	 * @param unknown_type $kid
	 * @param unknown_type $typeid
	 * @param unknown_type $md5
	 * @param unknown_type $source
	 * @param unknown_type $dataid
	 * @param unknown_type $videoType
	 * @param unknown_type $keyword
	 */
	public function actionSelectOf($kid, $typeid, $md5, $source, $dataid, $videoType, $keyword) {
		$message = HemsDataOperate::getInstance()->selectOf($md5, $kid, $source, $dataid, $videoType, $keyword, $typeid);
		echo json_encode(array('message'=>$message,'url'=>Yii::app()->request->urlReferrer));
		Yii::app()->end();
	}
	
	/**
	 * 设置
	 * Enter description here ...
	 * @param unknown_type $kid
	 * @param unknown_type $typeid
	 * @param unknown_type $keyword
	 */
	public function actionSaveSet($kid, $typeid, $keyword, $md5){
		$model = ConfigOperate::getInstance()->set($kid, $typeid,$md5, isset($_POST['HemsConfig']) ? $_POST['HemsConfig'] : array());
		if (!is_object($model)) {
			$this->redirect($this->createUrl('index', $this->getParams()));
		}
		$model->config->keyword =  $model->config->keyword ? $model->config->keyword : $keyword;
		
		$this->renderPartial('set',array(
			'model' =>$model->config,
			'title' => '设置'
		));
	}
	
}