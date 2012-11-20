<?php $this->beginContent('//layouts/tanchuceng', array('title'=>$title))?>
	<!-- 设置弹出层 -->
	<?php $form = $this->beginWidget('CActiveForm',array(
		'method' => 'post',
	));?>
<script type="text/javascript">
<!--
$('#submit').click(function() {
	alert('操作成功！');
});
//-->
</script>
<div >
	<table cellspacing="0" class="tableshuru">
		    <tbody>	
		    	<tr>
			    	<td width="20%" class="leftMargin">栏目名：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->textField($model,'columns'); ?>
			    	</td>
			   </tr>
			   <tr>
			    	<td class="leftMargin">关键词：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->textField($model,'keyword');?>
			    	</td>
			   </tr>
			   <tr>
			    	<td  class="leftMargin">视频年代：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->dropDownList($model,'video_date',Yii::app()->enum->options('video.videoDate'));?>
			    	</td>
			   </tr>
			   <tr>
			    	<td class="leftMargin">视频类型：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->dropDownList($model,'video_type',Yii::app()->enum->options('video.videoType'));?>
			    	</td>
			   </tr>
			   <tr>
			    	<td class="leftMargin">视频来源：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->dropDownList($model,'video_source',Yii::app()->enum->options('video.videoSource'));?>
					</td>
			   </tr>
			    <tr>
			    	<td class="leftMargin">类别：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->textField($model,'cate');?>
			    		<font style='color:gray'>(多类别用“,”隔开)</font>
					</td>
			   </tr>
			    <tr>
			    	<td class="leftMargin">主演：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->textField($model,'starring');?>
			    		<font style='color:gray'>(多主演用“,”隔开)</font>
					</td>
			   </tr>
			    <tr>
			    	<td class="leftMargin">简介：</td>
			    	<td class="rightMargin" align='left'>
			    		<?php echo $form->textArea($model,'description',array('rows'=>5,'cols'=>35));?>
					</td>
			   </tr>		
			   <tr style='display:none'>
			    	<td class="leftMargin">是否启用：</td>
			    	<td class="rightMargin" align='left'><?php echo $form->radioButtonList($model,'is_open',Yii::app()->enum->options('video.isOpen'),array('separator'=>''));?></td>
			   </tr>	   
			   <tr>
			     <td class="tdcenter" colspan="2">
			     	<?php echo CHtml::submitButton('确定',array('id'=>'submit')); ?>
			     	<?php echo CHtml::button('取消',array('onclick'=>'tanchuclose(this)'))?>
			     </td>
			   </tr>
			</tbody>
		  </table>
</div>
 <?php $this->endWidget();?>
 <?php $this->endContent()?>
