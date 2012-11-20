<?php
/**
 * 视频数据工厂类
 * @access public
 */
class VideoModelFactory {

	/**
	 * 静态方法，返回对应对象
	 * @access public
	 * @param aSource 来源
	 * @param aType 视频类型
	 * @return object
	 * @ParamType aSource 
	 * 来源
	 * @ParamType aType 
	 * 视频类型
	 * @ReturnType object
	 */
	static public function factory($aSource, $aType) {
		$modelName = ucfirst($aSource).ucfirst($aType);
		
		// 根据来源和视频类型，实例模型
		$model = new $modelName;
		
		// 返回实例的模型
		return $model;
	}
}
?>