

<?php $this->beginContent(); ?>

<?php if(Yii::app()->layout=='print'): ?>

	<?php echo $content; ?>

<?php else: ?>

	<div class="container_16">
	<div class="content-left left">
	<?php 
 $loadmodels=Typelist::model()->items(8);
foreach($loadmodels as $models)
{
	 foreach($models as $key=>$value)
	{
		switch($key)
		{
			case 8: $a[]=$value;break;
			case 9: $b[]=$value;break;
			case 10: $c[]=$value;break;
			case 11: $d[]=$value;break;
			case 12: $e[]=$value;break;
			case 13: $f[]=$value;break;			
		}
	}
}
$al=array($a[0]=>$b);
$bl=array($a[1]=>$c);
$cl=array($a[2]=>$d);
$dl=array($a[3]=>$e);
$el=array($a[4]=>$f);
$all=$al+$bl+$cl+$dl+$el;
?>	
<?php 

foreach ($all as $allkey=>$allvalue)
{
	$main[$allkey]=$this->renderPartial("products/pages/_content1",array('data'=>$allvalue),true,true);
}
/* foreach ($a as $key=>$value)
{  
	$main[$value]=$this->renderPartial("products/pages/_content1",array('data'=>$all),true,true);
} */
?>
	

	
<?php $this->widget('zii.widgets.jui.CJuiAccordion', array(
    'id'=>'accordion',
	'panels'=>$main,
	'options'=>array(
		'collapsible'=>true,
		'active'=>0,
		'animated'=>'bounceslide',
		'navigation'=>true,
	    'icons'=>array(
		'header'=>'ui-icon-plus',//ui-icon-circle-arrow-e
		'headerSelected'=>'ui-icon-circle-arrow-s',//ui-icon-circle-arrow-s, ui-icon-minus
			 ),

	),
	'htmlOptions'=>array(
	    'class'=>'Name of specific class which I want to change extracted from Firebug',
		'style'=>'width:200px;height:auto;'
	),
)); ?>
    </div><!--left end-->
<?php 
//print_r($this);
?>
	
		<!-- <div class="grid_3 alpha"> 
			<?php// foreach($this->leftPortlets as $class=>$properties) $this->widget($class,$properties); ?>	
		 </div> -->
		 
		     <div class="content-right right">
<?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs)); ?>
			<?php echo $content; ?>
      
    </div>
		 
		 

	</div>
	<div class="clear"></div>
<?php endif; ?>
<?php $this->endContent(); ?>