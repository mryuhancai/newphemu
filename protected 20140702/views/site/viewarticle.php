<?php 
$this->topid=$lay;
?>

<?php 
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
	)); 
?>

