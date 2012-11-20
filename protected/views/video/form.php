<?php $form = $this->beginWidget('CActiveForm',array(
	'method' => 'post'
));?>
<div class="tcdiv" id="tianjia">
  <div style="font-size:12px;height:20px;margin-left:10px;margin-top:4px;">添加视频</div>
  <div id="nav2_content">
   	<div>
	      <table cellspacing="0" cellspacing="0" class="tableshuru">
		    <tbody>
			   <tr>
			    <td width="25%">视频标题：</td>
				<td width="75%"><input type="text" id="title" class="input1" size="30" /></td>
			   </tr>
			   <tr>
			    <td width="25%">链接：</td>
				 <td width="75%"><input type="text" id="url" value="http://" class="input1" size="30" /></td>
			   </tr>
			   <tr>
					<td width="25%">图片链接：</td>
					<td width="75%">
						<input id="imageurla" class="input1" type="text" size="30" value="">
						<a  href="javascript:void(0);">上传</a>
						<input type="hidden" value="">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span id="showmsg" style="color:red;">请输入以http://开头的图片链接地址或上传本地图片(允许上传2M以内的JPG、 GIF、PNG格式图片)</span>
					</td>
				</tr>
				<tr>
			    <td width="25%">时长：</td>
				 <td width="75%"><input type="text" id="url" value="" class="input1" size="30" /></td>
			   </tr>
			   <tr>
			    <td width="25%">画质：</td>
				 <td width="75%"><input type="text" id="url" value="" class="input1" size="30" /></td>
			   </tr>
			   <tr>
			    <td width="25%">来源：</td>
				 <td width="75%"><input type="text" id="url" value="" class="input1" size="30" /></td>
			   </tr>
			   <tr>
			     <td width="25%">加精：</td>
				 <td width="75%"><span id="weijiajing">未加精</span>　<a href="javascript:void(0);" onclick="tanchu('jiajing<?php echo $k;?>','<?php echo $k;?>');">设置</a></td>
			   </tr>
			    <tr>
			     <td width="25%">置顶：</td>
				 <td width="75%"><span id="weizhiding">未置顶</span>　<a href="javascript:void(0);" onclick="tanchu('zhiding<?php echo $k;?>','<?php echo $k;?>');">设置</a></td>
			   </tr>
			   <tr>
					<td width="25%">上传时间：</td>
					<td width="75%">
					<input id="upload_time" class="Wdate" type="text" size="30" onfocus="WdatePicker({isShowClear:false,dateFmt:'yyyy-MM-dd'})">
					</td>
				</tr>
			   <tr>
			     <td colspan="2" class="tdcenter">
			     	 <?php echo CHtml::submitButton('确定')?>
			    	 <?php echo CHtml::button('取消',array('type'=>'reset'))?>
			     </td>
			   </tr>
			</tbody>
		  </table>
	</div>
  </div> 
  </div>
 <?php $this->endWidget();?>