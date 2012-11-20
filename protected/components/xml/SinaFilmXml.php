<?php
/**
 * 电影
 * Enter description here ...
 * @author nijn
 *
 */
class SinaFilmXml extends VideoFatherXml{
	public $modelName = 'SinaFilm';

	public function arrStructure($data){
		$display = $data['data']['display'];
		$video = array(
			'channel'=>array(
				'morepageurl' => '/datasource/getpalyvideopage?md5='.$this->md5,
				'title'=> $this->isempty($display, 'workName'),//电影(视频)名称
				'horizontalPoster'=>$this->isempty($display, 'poster'),//电影(视频)海报
				'type'=>'电影',//电影(视频)类型
				'starring'=>str_replace('$$', ',', $this->isempty($display, 'starring')),//主演
				'editer'=>str_replace('$$', ',', $this->isempty($display, 'director')),//导演
				'description'=>$this->isempty($display, 'introduction'),//简介/概述
				'region'=>$this->isempty($display, 'region'),//区域
				'cate'=>str_replace('$$', ',', $this->isempty($display, 'type')),//分类
				'createtime' => $this->isempty($display, 'resourceTime'),//添加时间
				'updatetime' => $this->isempty($data, 'lastmod'),
				'source' => '新浪',
				'total' => '1',
				'items'=>array(
					'item'=> array(
						'title'=>$this->isempty($display, 'workName'),//标题
						'picurl'=>$this->isempty($display, 'poster'),//电影(视频)图片
						'pageurl'=>$this->isempty($display, 'playLink'),//电影(视频)播放地址
						'timelength'=>$this->isempty($display, 'length'),//电影(视频)时长
					)
				),
				'recommends'=>array(
					'reommend'=>array(
						'title'=>$this->isempty($display, 'workName'),//标题
						'picurl'=>$this->isempty($display, 'poster'),//电影(视频)图片
						'pageurl'=>$this->isempty($display, 'playLink'),//电影(视频)播放地址
						'timelength'=>$this->isempty($display, 'length'),//电影(视频)时长
					)
				),
			),
		);
		return $video;
	}

}