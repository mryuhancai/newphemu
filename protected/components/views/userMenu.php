<ul>
	<li><?php echo CHtml::link('添加购物记录',array('shopping/create')); ?></li>	
	<li><?php echo CHtml::link('管理购物记录',array('shopping/admin')); ?></li>
	<li><?php echo CHtml::link('新建物品',array('item/create')); ?></li>	
	<li><?php echo CHtml::link('管理物品',array('item/admin')); ?></li>
	<li><?php echo CHtml::link('新建物品类',array('itemtype/create')); ?></li>	
	<li><?php echo CHtml::link('管理物品类',array('itemtype/admin')); ?></li>
	<li><?php echo CHtml::link('登出',array('site/logout')); ?></li>
</ul>