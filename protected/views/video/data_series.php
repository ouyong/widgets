<style>
.jdetail {
	margin: 0 auto; padding-bottom: 10px;background: #F5F8FC;border:1px solid #B7CBEB;font-size:12px;
}
.jdetail .text .spbf{
	margin:0; padding:10px; overflow:hidden; clear:both;
}
.jdetail .text .spbf li{
	float:left; width:120px; position:relative; list-style:none; margin:5px 2px; _margin:0 10px;
}
.jdetail .text .spbfpage{
	text-align:center; height:30px; line-height:30px; clear:both; margin-top:10px;
}
.jdetail .text .spbfpage span,.jdetail .text .spbfpage a{
	padding:3px 7px; margin:0 3px; font-family:Arial, Helvetica, sans-serif;
}
.jdetail .text .spbfpage .yiiPager li.selected a{
	font-weight:bold;
	border: 0px solid #CAE8FF;
}
.jdetail .text .spbfpage a{
	border:1px solid #CAE8FF; color:#0235cc; text-decoration:none;
}
.spbfpage .yiiPager {
	margin-left : 23px;
}
.yiiPager li {
	float:left;
}
.yiiPager li.page{
	margin-right: 0px;
    margin-top: 0px;
    width: 7%;
}
</style>
<div class="jdetail">
    <div class="text">
    	<ul class="spbf">
    	<?php foreach ($dataProvider->getData() as $data):?>
        	<li><?php echo CHtml::link(CUtil::cut($data['title'], 18,'...'),$data['pageurl'], array('target'=>'_blank','title'=>$data['title']))?></li>
        <?php endforeach;?>
        </ul>
        <div class='spbfpage'>
        <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
			'pages' => $dataProvider->pagination,
        	'header' => '',
        	'maxButtonCount' => 4,
		))?>
		</div>	
    </div>
</div>
	