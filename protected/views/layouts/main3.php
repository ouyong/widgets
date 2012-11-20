<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<?php $cs = Yii::app()->clientScript?>
	<?php $cs->registerCoreScript('jquery')?>
	<?php $cs->registerScriptFile(Yii::app()->baseUrl.'/scripts/tanchuceng.js')?>
	<?php $cs->registerCssFile(Yii::app()->baseUrl.'/css/tc.css')?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/video.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/return.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/htcss.css" />
</head>

<body>

<div class="container" id="page">
	<script>
		var jsroot = '';
		$().ready(function() {
			$('.ajax-link').live('click',function() {
				$.get($(this).attr('href'),function(json) {
					json = eval("("+json+")");
					alert(json.message)
					window.location.href = json.url;	
				});
				return false;
			});
		});
	</script>

	<div id="mainmenu">
	</div><!-- mainmenu -->

	<?php echo $content; ?>

	<div class="clear"></div>
</div><!-- page -->

</body>
</html>
