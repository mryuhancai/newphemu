<?php 
$this->topid=$gettopid;
?>


<?php
	echo '<div class="program-text">';
    if(is_object($model))
    {
    	echo  CHtml::decode($model->content);
    }
    else 
    {
    	if(is_array($model))
    	{
    		foreach($model as $mode)
    		{
    			echo print_r($mode->title);
    		}
    	}
    }
/*     foreach($model as $mode)
    {
    	if(is_object($mode))
    	{
    			
    	}
    	else
    	{
    		echo  CHtml::decode($model->content);
    	};
    } */
//     echo print_r($model);
// 	echo  CHtml::decode($model->content);
	echo '</div>';
?>