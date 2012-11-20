<?php $this->beginContent('//layouts/tanchuceng', array('title'=>$title))?>
<script>
	$().ready(function() {
		$.get('<?php echo $this->createUrl('dataSeries',array('source'=>$_GET['source'],'type'=>$_GET['type'],'dataid'=>$_GET['dataid']));?>', function(html) {
			$('#data-content').html(html);
		});
		$('.yiiPager li a').live('click',function() {
			$.get($(this).attr('href'), function(html) {
				$('#data-content').html(html);
			});
			return false;
		});
	});
</script>
<!-- 设置弹出层 -->
<div id='data-content'>
</div>
 <?php $this->endContent()?>
