<?php

abstract class CResult extends CComponent{
	public $model = array();
	public $modelClass = null;
	
	abstract public function render();
}

?>