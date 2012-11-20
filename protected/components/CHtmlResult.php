<?php
/**
 * 转换为Html类型
 * Enter description here ...
 * @author nijn
 *
 */
class CHtmlResult extends CResult{
	public $controller = null;
	public $ownerModel = null;
	public function render() {
		$action = $this->controller->getAction();
		ob_start();
		$this->controller->render($action->id,array(
			'data' => $this->model,
			'model' => is_object($this->ownerModel) ? $this->ownerModel : new $this->ownerModel
		));
		$content = ob_get_clean();
		return $content;
	}
}