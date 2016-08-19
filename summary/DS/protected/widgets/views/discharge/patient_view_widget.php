<div class="span6">
<div class="head">
  <div class="isw-grid"></div>
  <h1><?php echo t("Patient's Information"); ?></h1>
  <div class="clear"></div>
</div>
<div class="block-fluid">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            
        array('name'=>'patient_id',
			'type'=>'raw',			
			'value'=>CHtml::link($model->patient_id,array("update","id"=>$model->id)),
		    ),
		array('name'=>'op_date',
			'type'=>'raw',			
			'value'=>date('d-m-Y',$model->op_date),
		    ),
			
		array(
			'name'=>'name',
			'type'=>'raw',		
			'value'=>$model->name,
			), 'age','height','weight','bg','guardian','relate',
		array(
            'name'=>'gender',
			'type'=>'raw',			
			'value'=>Patient::GetGender($model->gender),                   
                ), 
		array(
            'name'=>'mstatus',
			'type'=>'raw',			
			'value'=>Patient::GetMstatus($model->mstatus),                   
                ), 'address1','address2','zip', 'tele', 'mobile', 'email','policy_no','policy_name','company',
				
				array('name'=>'sdate',
			'type'=>'raw',			
			'value'=>date('d-m-Y',$model->sdate),
		    ),
		
				array('name'=>'edate',
			'type'=>'raw',			
			'value'=>date('d-m-Y',$model->edate),
		    ),
				array('name'=>'dept',
			'type'=>'raw',			
			'value'=>Dept::GetName($model->dept),
		    ),
				array('name'=>'consultant',
			'type'=>'raw',			
			'value'=>Doctor::GetName($model->consultant),
		    ),'reference',

		  
		 
	),
)); ?>
 <div class="clear"></div>
</div>
</div>