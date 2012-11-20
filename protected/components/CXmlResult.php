<?php

class CXmlResult extends CResult{
	/* (non-PHPdoc)
	 * @see ToResult::run()
	 */
	public function render() {
		// TODO Auto-generated method stub
		$rootname = "root";
		if (is_array($this->model)) {
			$rootname = $this->modelClass.'s';
		} else if (is_object($this->data)) {
			$rootname = $this->modelClass;
		}
		return ConvertArrayToXml::ToXML ($this->model, $rootname);
	}


}

?>