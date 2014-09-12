
<div class="Blue_panel_with_menu clearfix">
<div class="panel_blue_container">
<ul class="left_navigation clearfix">
<?php 
	foreach($data as $key=>$value)
	{
		echo '<li>';
		echo CHtml::link(CHtml::encode($value),Yii::app()->createUrl('mysite/viewabout', array(
				'tid'=>$key,
				'typename'=>$value,
		)));
		echo '</li>';
	}
?>
</ul>
</div>
</div>
	