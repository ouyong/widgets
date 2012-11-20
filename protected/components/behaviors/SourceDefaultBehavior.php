<?php
/**
 * 修改默认来源
 * Enter description here ...
 * @author nijn
 *
 */
class SourceDefaultBehavior extends CActiveRecordBehavior {

	public function afterSave($event) {
		$owner = $this->getOwner();
		
		$modifier = new EMongoModifier();
		$modifier->addModifier('is_default', 'set', '0');
		$criteria = new EMongoCriteria();
		$criteria->addCond('kid','==', $owner->kid);
		Videodatasource::model()->updateAll($modifier,$criteria);
		
		$modifier = new EMongoModifier();
		$modifier->addModifier('is_default', 'set', '1');
		$criteria = new EMongoCriteria();
		$criteria->addCond('kid','==', $owner->kid);
		$criteria->addCond('source','==', $owner->config->video_source);
		Videodatasource::model()->updateAll($modifier,$criteria);
	}
}

?>