<?php
class SinaVarietyshowXml extends VideoFatherXml{
	public $modelName = 'SinaVarietyshow';
	
	public function arrStructure($arr, $start = 0, $end = null) {
		$data = $arr['data']['display']['serialinfo'];
		$detailArr = empty($data['detail']) ? array() : $data['detail'];
		$count = count($detailArr)-1;
		$video['channel']['recomends'] = array();
		$video['channel']['items'] = array();
		$end = $end ? $end : $count;
		$video = array(
			'channel'=>array(
						'title'=> $this->isempty($data, 'workName'),//视频名称
						'morepageurl' => '/datasource/getpalyvideopage?md5='.$this->md5,
						'horizontalPoster'=>$this->isempty($data, 'poster'),//视频海报
						'type'=>'综艺',//视频类型
						'starring'=>str_replace('$$', ',', $this->isempty($data, 'host')),//主演
						'editer'=>'',//导演
						'description'=>$this->isempty($data, 'introduction'),//简介/概述
						'region'=>$this->isempty($data, 'region'),//区域
						'cate'=>str_replace('$$', ',',$this->isempty( $data,'type')),//分类
						'createtime' => $this->isempty($data,'resourceTime'),//添加时间
						'updatetime' => $this->isempty($data,'lastmod'),
						'source'=>'新浪',
						'total' =>count($detailArr),
					)
			
		);
		for ($i=$count; $i>$count-10; $i--) {
			if (empty($detailArr[$i])) break;
			$video['channel']['recomends']['recomend'.$i] = array(
			'recommend'=>array(
				'title'=> $this->getTime($detailArr[$i]['date']).$detailArr[$i]['seq'],//标题
				'picurl'=> $detailArr[$i]['singleThumbnails'],//视频图片
				'pageurl'=> $detailArr[$i]['singleLink'],//视频播放地址
				'timelength'=> $detailArr[$i]['length']//视频时长
			));
		}
		for ($i=$start; $i<=$end; $i++) {
			if (empty($detailArr[$i])) break;
			$video['channel']['items']['item'.$i] = array(
				'title'=> $this->getTime($detailArr[$i]['date']).$detailArr[$i]['singleTitle'],//标题
				'picurl'=> $detailArr[$i]['singleThumbnails'],//视频图片
				'pageurl'=> $detailArr[$i]['singleLink'],//视频播放地址
				'timelength'=> $detailArr[$i]['length']//视频时长
			);
		}
		
		return $video;
		
	}
	
	public function getTime($date) {
		$y = substr($date, 0, 4);
		$m = substr($date, 4, 2);
		$t = substr($date, 6, 2);
		return $y.'-'.$m.'-'.$t;
	}
}

?>