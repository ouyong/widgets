<?php
class CJsonResult extends CResult {
	/* (non-PHPdoc)
	 * @see ToResult::run()
	 */
	public function render() {
		// TODO Auto-generated method stub
		return ConvertArrayToJson::ToJSON($this->model);
	}


}