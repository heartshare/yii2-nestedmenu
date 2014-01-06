<?php
/**
 * @package pb_menu\views
 */
?>
<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
	<?php echo CHtml::encode($data->info); ?>
	<br />


</div>