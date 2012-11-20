<script>
$().ready(function() {
	$('.view-series').click(function() {
		tanchuceng(420,500,'wtop','wleft', $(this).attr('href'));
		return false;
	});
});

//选用
function changeisnew(typeid,tablename,md5tag,kid,title,url,description){

		var params = "typeid=" + typeid + "&tablename=" + tablename + "&md5tag=" + md5tag + "&kid=" + kid + "&title=" + title + "&url=" + url + "&description=" + description + "&isnew=1" + "&isdig=0" + "&isjing=0" + "&jingtime=0" + "&dingtime=0";
		handledata('post',jsroot+"searchsource/chooseaddinfo",params,'json',dataResponse);
}

function dataResponse(request){
	 if(request.code==1){
	 	alert(request.msg);	
	 }else{
	 	alert(request.msg);
	 	return false;
	 }
}

</script>
<div class="htcontainer">
	<div class="main">
	      <div class="bqdivmain">
		  <div class="bqborder mrb10">
		   <div class="bqtabletop">
		      <h3>视频搜索</h3>
			  <img width="15" height="15" id="btne4e0215ebc45dba3ce85d777ca8f1deb" src="http://d3m.zhongsou.com/images/topjtbg.gif">
		   </div>
		   <div style="height:auto;" class="bqtableline">
		        <div class="cfr bqfr">
			       <ul>
				     <li><a href="<?php echo Yii::app()->createUrl('video/index',$this->getParams())?>">返回</a></li>
				  </ul>
			  </div>
			<?php $form = $this->beginWidget('CActiveForm',array(
				'method' => 'get',
				'action' => $this->createUrl('manualUpdate',$this->getParams()),
				'htmlOptions' => array(
					'id' => 'manual'
				),
			));?>
		      <div class="cfl mrl10 gray">
		      	<ul>
		       <li>关键词：<?php echo $form->textField($model,'keyword');?></li>
		       <li>类型：<?php echo $form->dropDownList($model,'video_type',Yii::app()->enum->options('video.videoType'));?></li>
		       <li>年代：<?php echo $form->dropDownList($model,'video_date',Yii::app()->enum->options('video.videoDate'));?></li>
		       <li>网站来源：<?php echo $form->dropDownList($model,'video_source',Yii::app()->enum->options('video.videoSource'));?></li>
			  <li><?php echo CHtml::submitButton('确定',array('name'=>'search'))?></li>
			  </ul>
			  <?php $this->endWidget();?>
			  </div>
		  <div class="clear"></div>
	   </div>
	   <div id="mainbodye4e0215ebc45dba3ce85d777ca8f1deb">
	      <table cellspacing="0" cellpadding="0" style="table-layout:fixed" class="tableliebiao">
		    <thead>
		     <tr>
		     	<td style="word-break:break-all word-wrap:break-word">来源</td>
				<td style="word-break:break-all word-wrap:break-word">标题</td>
				<td style="word-break:break-all word-wrap:break-word">最新更新时间</td>
				<td style="word-break:break-all word-wrap:break-word">视频数</td>
				<td style="word-break:break-all word-wrap:break-word">操作</td>
			 </tr>
			</thead>
			<tbody> 
			<!-- 视频手动搜索 -->
			<?php if (!empty($data)):?>
			<?php foreach ($data as $one):?>
			<tr class="0" style="">
				<td><?php echo CHtml::value($one, 'sourceObj.name')?></td>
				<td><?php echo CHtml::value($one, 'keyword')?></td>
				<td><?php echo CHtml::value($one, 'lastDate')?></td>
				<td>
					<?php #echo Chtml::value($one,'videoNum');
					echo CHtml::link(Chtml::value($one,'videoNum'), $this->createUrl('viewSeries',array(
							'source' => $one->source,
							'type' => $one->video_type,
							'dataid' => $one->object_id
						)),
						array('class'=>'view-series')
					)?>
				</td>
				<td><?php echo 
				CHtml::link('选用',$this->createUrl('selectOf',array_merge(
					$this->getParams(),array(
						'source'=>$model->video_source,
						'videoType' => $model->video_type,
						'dataid' => $one->object_id,
						'keyword' => $model->keyword
					))),
					array(
						'class' => 'ajax-link'
					));?>
				</td>
			</tr>
			<?php endforeach;?>
			<?php endif;?>
			</tbody> 
		  </table> 
	  </div>
	  </div>
	</div>
</div>
</div>
	
	
	
	