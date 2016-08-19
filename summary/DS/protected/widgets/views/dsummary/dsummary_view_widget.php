<div class="span6">
<div class="head">
  <div class="isw-grid"></div>
  <h1><?php echo t("Discharge Summary Information"); ?></h1>
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
		    ),
			'diagnosis', 'operation', 'history', 'past_history', 'personal_history', 'family_history', 'on_examination', 'investigation', 'operation_notes', 'treatment_given', 'condition_at_discharge', 'consultant', 'other_consultant', 'next_visit', 'medical_officer','advice_on_discharge','ref_by'
	),
)); ?>
  <div class="clear"></div>
</div>
</div>