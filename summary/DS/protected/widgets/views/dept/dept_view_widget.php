<div class="span6">
<div class="head">
  <div class="isw-grid"></div>
  <h1><?php echo t("Department's Information"); ?></h1>
  <div class="clear"></div>
</div>
<div class="block-fluid">
  <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            
        array('name'=>'id',
			'type'=>'raw',			
			'value'=>$model->id,
		    ),
                
		array(
			'name'=>'name',
			'type'=>'raw',		
			'value'=>CHtml::link($model->name,array("update","id"=>$model->id)),
		    ),'note',
	),
)); ?>
  <div class="clear"></div>
</div>
</div>