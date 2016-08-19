 <div class="head">
                        <div class="isw-grid"></div>
                        <h1><?php echo t("Doctor's Info"); ?></h1>                               
                        <div class="clear"></div>
                    </div>
                    <div class="block-fluid table-sorting">
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
		array('name'=>'category',
			'type'=>'raw',			
			'value'=>Dept::GetName($model->category),
		    ),
			
		array('name'=>'email',
			'type'=>'raw',			
			'value'=>$model->email,
		    ),
		
		array('name'=>'address1',
			'type'=>'raw',			
			'value'=>$model->address1,
		    ),
		array('name'=>'address2',
			'type'=>'raw',			
			'value'=>$model->address2,
		    ),
		array('name'=>'town',
			'type'=>'raw',			
			'value'=>$model->town,
		    ),
		array('name'=>'province',
			'type'=>'raw',			
			'value'=>$model->province,
		    ),
		array('name'=>'country',
			'type'=>'raw',			
			'value'=>$model->country,
		    ),
		array('name'=>'zip',
			'type'=>'raw',			
			'value'=>$model->zip,
		    ),
		array('name'=>'tele',
			'type'=>'raw',			
			'value'=>$model->tele,
		    ),
		array('name'=>'mobile',
			'type'=>'raw',			
			'value'=>$model->mobile,
		    ),
		array('name'=>'fax',
			'type'=>'raw',			
			'value'=>$model->fax,
		    ),
		array('name'=>'bank_details',
			'type'=>'raw',			
			'value'=>$model->bank_details,
		    ),
	),
)); ?>
 <div class="clear"></div>
                    </div>
