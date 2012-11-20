<?php
class VideoXmlFactory {


	static private $instance = null;

	private function __construct() {}

	static public function getInstance() {

		if(self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function createClass($type, $source) {

		if($type != null && $source != null) {

			$className = ucfirst($source).ucfirst($type).'Xml';
            return new $className;
		}
		return null;
	}

}