<?php
$arr = array(''=>'全部');
$maxData = date('Y');
for ($i=$maxData; $i>=1990; $i--) {
	$arr[$i] = $i;
}
return $arr;