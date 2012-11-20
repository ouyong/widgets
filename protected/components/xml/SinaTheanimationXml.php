<?php
/**
 * 动漫
 * Enter description here ...
 * @author nijn
 *
 */
class SinaTheanimationXml extends VideoFatherXml{
	public $modelName = 'SinaTheanimation';
	
	public function arrStructure($arr, $start = 0, $end = null) {
		$data = $arr['data']['display']['serialinfo'];
		$detailArr = empty($data['detail']) ? array() : $data['detail'];
		$count = count($detailArr)-1;
		$video['channel']['recomends'] = array();
		$video['channel']['items'] = array();
		$end = $end ? $end : $count;
		$video = array(
			'channel'=>array(
						'title'=>$this->isempty($data, 'workName'),//视频名称
						'horizontalPoster'=>$this->isempty($data, 'poster'),//视频海报
						'morepageurl' => '/datasource/getpalyvideopage?md5='.$this->md5,
						'type'=>'动漫',//视频类型
						'starring'=>'',//主演
						'editer'=>'',//导演
						'description'=>$this->isempty($data, 'introduction'),//简介/概述
						'region'=>$this->isempty($data, 'region'),//区域
						'cate'=>str_replace('$$', ',', $this->isempty($data, 'type')),//分类
						'createtime' => '',//添加时间
						'updatetime' => $this->isempty($arr, 'lastmod'),
						'source'=>'新浪',
						'total' => empty($data['totalnumber']) ? 1 : $data['totalnumber'],
					),
			
		);
		for ($i=$count; $i>$count-10; $i--) {
			if (empty($detailArr[$i])) break;
				$video['channel']['recomends']['recomend'.$i] = array(
					'title'=> $detailArr[$i]['seq'],//标题
					'picurl'=> $detailArr[$i]['singleThumbnails'],//视频图片
					'pageurl'=> $detailArr[$i]['singleLink'],//视频播放地址
					'timelength'=> $detailArr[$i]['singleTime']//视频时长
				);
		}
		
		for ($i=$start; $i<=$end; $i++) {
			if (empty($detailArr[$i])) break;
			$video['channel']['items']['item'.$i] = array(
				'title'=> $detailArr[$i]['seq'],//标题
				'picurl'=> $detailArr[$i]['singleThumbnails'],//视频图片
				'pageurl'=> $detailArr[$i]['singleLink'],//视频播放地址
				'timelength'=> $detailArr[$i]['singleTime']//视频时长
			);
		}
		return $video;
		
	}
}

?>