<?php 
//$menu=Typelist::model()->getTreeItems(34,false);
$this->leftPortlets['ptl.WidgetMenu']=array(); 
?>

<?php
//echo print_r(Typelist::model()->getMenuSubItems()); echo "<br /><br /><br /><br />";
echo print_r(Typelist::model()->getWidth()); echo "<br /><br /><br /><br />";
$this->widget('zii.widgets.CMenu',array(
	'items'=>Typelist::model()->getTreeItems(34,false),
));

print_r(Typelist::model()->filltree(34));
?>

