<?php
	echo '<h3>'.$data->title.'</h3>';
	foreach($data->hm_dc_did as $dccontent)
	{
		echo CHtml::decode($dccontent->content);
	}
?>
