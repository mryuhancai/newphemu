<?php $this->beginContent(); ?>

<?php if($this->topid==8):  ?>
	
	<?php echo $content; ?>
<?php else: ?>

	<div class="container_16">
	<div class="content-left left">
	

<?php
$this->widget('zii.widgets.CMenu',array(
	'items'=>Typelist::model()->getMenuItems($this->topid,true),
));
?>

     <?php 
/*    	  $loadmodels=Typelist::model()->items($this->topid);
	  //print_r($loadmodels);
	  foreach($loadmodels as $modelskey=>$modelsvalue)
		{
			 foreach($modelsvalue as $key=>$value)
			{
				echo '<div class="navigation-text">';
				echo CHtml::link(CHtml::encode($value),Yii::app()->createUrl('site/view', array(
						'linkid'=>$key,
						'typename'=>$value,
				)));
				echo '</div> ';
			}
		} */
	?>
    </div><!--left end-->
	
	
		 <div class="grid_3 alpha"> 
			<?php //foreach($this->leftPortlets as $class=>$properties) $this->widget($class,$properties); ?>	
		 </div> 
		 
		     <div class="content-right right">
<?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs)); ?>
			<?php echo $content; ?>
      
    </div>
		 
		 

	</div>
	<div class="clear"></div>
<?php endif; ?>
<?php $this->endContent(); ?>