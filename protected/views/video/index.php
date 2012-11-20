<script>
$().ready(function() {
	$('#set').click(function() {
		tanchuceng(420,500,'wtop','wleft', $(this).attr('href'));
		return false;
	});
	$('.view-series').click(function() {
		tanchuceng(420,500,'wtop','wleft', $(this).attr('href'));
		return false;
	});
});

</script>
   <div class="main">
      <div class="bqdivmain">
	  <div class="bqborder mrb10">
	   <div class="bqtabletop">
	      <h3>
	      	<?php  
	      	if(!empty($model->config->columns)){
	      				echo CHtml::value($model, 'config.columns');
	      			}else{
	      				echo "视频播放";
	      	};?>
	      </h3>
		  <img width="15" height="15" id="btn80452a613677e957c92648d3d2f2fec4" src="http://d3m.zhongsou.com/images/topjtbg.gif">
	   </div>
	   </div>
	   <div id="mainbody80452a613677e957c92648d3d2f2fec4">
	    <div class="bqtableline" id='nav'>
	        <div class="cfr bqfr">
		       <ul>
				<li><a id='set' class="bqsz" href="<?php echo $this->createUrl('video/saveSet',$this->getParams())?>">设置</a></li>
			     <li><a class="handnew" href="<?php echo $this->createUrl('manualUpdate',$this->getParams());?>">手动更新</a></li>
		      </ul>
		  </div>
		  <div class="clear"></div>
	   </div>
  <!-- 设置弹出层 -->
	<div> 
      <table cellspacing="0" cellpadding="0" class="tableliebiao">
	    	<thead>
	    		<tr>
					<td width="15%">来源</td>
					<td width="20%">标题</td>
					<td width="15%">最新更新时间</td>
					<td width="15%">视频数</td>
					<td width="15%">状态</td>
					<td width="15%">操作</td>
		 		</tr>
			</thead>
			<tbody> 
			<!-- ***************************显示的视频列表*************************** -->
			<?php foreach ($data as $key=>$one):?>
			
		 	<tr class="0" style="">
		 		<?php if ($one->is_default == 1) {?>
				<td class='xinlang'>
					<?php echo CHtml::value($one, 'sourceObj.name').'(默认)'?>
				<?php } else {?>
				<td>
					<?php echo CHtml::value($one, 'sourceObj.name')?>
				<?php }?>
				</td>
				<td><a><?php echo CHtml::value($one, 'title')?></a></td>
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
				<td><?php echo Yii::app()->enum->lookUp('video.isOpen',CHtml::value($one,'is_open')); ?></td>
				<td>
					<a class='ajax-link' href="<?php echo $this->createUrl('setDefault',array_merge($this->getParams(),array('dataid'=>$one->_id, 'md5'=>$one->md5))); ?>">设为默认</a>
					<?php if ($one->is_open == 0) : ?>
						<a class='ajax-link' href="<?php echo $this->createUrl('open',array('dataid'=>$one->_id,'status'=>1)); ?>">启用</a>
					<?php else:?>
						<a  class='ajax-link' href="<?php echo $this->createUrl('open',array('dataid'=>$one->_id,'status'=>0)); ?>">禁用</a>
					<?php endif;?>
					<a class='ajax-link' href="<?php  echo $this->createUrl('move',array('dataid'=>$one->_id,'sort'=>-1,'moveId'=> empty($data[$key-1]) ? '' : $data[$key-1]->_id )); ?>">上移</a>
					<a class='ajax-link' href="<?php echo $this->createUrl('move',array('dataid'=>$one->_id , 'sort'=>1 , 'moveId' => empty($data[$key+1])? '' : $data[$key+1]->_id )); ?>">下移</a>
				</td>
			</tr>
			<?php endforeach;?>
			</tbody> 
	 	 </table>
	   </div>
	</div>
	</div>	
</div>
