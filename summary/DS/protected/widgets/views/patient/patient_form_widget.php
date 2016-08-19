<?php
                    $mycs=Yii::app()->getClientScript();                    
                    if(YII_DEBUG)
                        $ckeditor_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.ckeditor'), false, -1, true);				
						                    
                    else
                        $ckeditor_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.ckeditor'), false, -1, false);				
						                    	
                    
                    $urlScript_ckeditor= $ckeditor_asset.'/ckeditor.js';
                    $urlScript_ckeditor_jquery=$ckeditor_asset.'/adapters/jquery.js';
                    $mycs->registerScriptFile($urlScript_ckeditor, CClientScript::POS_HEAD);
                    $mycs->registerScriptFile($urlScript_ckeditor_jquery, CClientScript::POS_HEAD);   
					
					                 
?>
<?php

$csrf_token_name = Yii::app()->request->csrfTokenName;
$csrf_token = Yii::app()->request->csrfToken;	

?>

<div class="workplace">
<div class="form">
  <?php $this->render('cmswidgets.views.notification'); ?>
  <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'patient-form',
        'enableAjaxValidation'=>true,       
        )); 
?>
  <?php echo $form->errorSummary(array($model)); ?>
  <div class="span6" style="float:right;"> </div>
  <div class="row-fluid">
    <div class="span6">
      <div class="head">
        <div class="isw-target"></div>
        <h1><?php echo t('Patient'); ?></h1>
        <div class="clear"></div>
      </div>
      <div class="block-fluid">
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'name'); ?></div>
          <div class="span7"><?php echo $form->textField($model, 'name'); ?> <span><?php echo $form->error($model,'name'); ?></span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'Age'); ?></div>
          <div class="span2"><?php echo $form->textField($model, 'age'); ?> <span><?php echo $form->error($model,'age'); ?></span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'dob'); ?></div>
          <div class="span3">
            <?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'model' => $model,
    			'attribute' => 'dob',
				'options'=>array(
                                                'value'=>'12',
                                                'dateFormat'=>'dd-mm-yy',
                                              
                                                ),
				));
			?>
            <span><?php echo $form->error($model,'dob'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'gender'); ?></div>
          <div class="span3"><?php echo $form->dropDownList($model,'gender', ConstantDefine::GetGender(),array()); ?> <span><?php echo $form->error($model,'gender'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
          <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'ward'); ?></div>
          <div class="span3"><?php echo $form->textField($model, 'ward'); ?> <span><?php echo $form->error($model,'ward'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'roomno'); ?></div>
          <div class="span2"><?php echo $form->textField($model, 'roomno'); ?> <span><?php echo $form->error($model,'roomno'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'ipno'); ?></div>
          <div class="span2"><?php echo $form->textField($model, 'ipno'); ?> <span><?php echo $form->error($model,'ipno'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'mrdno'); ?></div>
          <div class="span2"><?php echo $form->textField($model, 'mrdno'); ?> <span><?php echo $form->error($model,'mrdno'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'regno'); ?></div>
          <div class="span5"><?php echo $form->textField($model, 'regno'); ?> <span><?php echo $form->error($model,'regno'); ?> </span> </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="span6">
      <div class="head">
        <div class="isw-target"></div>
        <h1><?php echo t('Date Info'); ?></h1>
        <div class="clear"></div>
      </div>
      
      <div class="block-fluid">
      
      <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'cdate'); ?></div>
          <div class="span3">
            <?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'model' => $model,
    			'attribute' => 'cdate',
				'options'=>array(
                                                'value'=>'12',
                                                'dateFormat'=>'dd-mm-yy',
                                              
                                                ),
				));
			?>
            <span><?php echo $form->error($model,'cdate'); ?> </span> </div>
              <div class="clear"></div>
      </div>
        
           <div class="row-form">
      <div class="span5"><?php echo $form->label($model,'admdate'); ?></div>
      <div class="span5"><?php echo $form->textField($model, 'admdate'); ?> <span><?php echo $form->error($model,'admdate'); ?> </span> </div>
      <div class="clear"></div>
    </div>
             
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'disdate'); ?></div>
          <div class="span5">
            <?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'model' => $model,
    			'attribute' => 'disdate',
				'options'=>array(
                                                'value'=>'12',
                                                'dateFormat'=>'dd-mm-yy',
                                              
                                                ),
				));
			?>
            <span><?php echo $form->error($model,'disdate'); ?> </span> </div>
              <div class="clear"></div>
      </div>
      </div>
    </div>
    <div class="span6">
      <div class="head">
        <div class="isw-target"></div>
        <h1><?php echo t('Address Info'); ?></h1>
        <div class="clear"></div>
      </div>
      <div class="block-fluid">
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'address'); ?></div>
          <div class="span5"><?php echo $form->textField($model, 'address'); ?> <span><?php echo $form->error($model,'address'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'city'); ?></div>
          <div class="span5"><?php echo $form->textField($model, 'city'); ?> <span><?php echo $form->error($model,'city'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model,'pin'); ?></div>
          <div class="span5"><?php echo $form->textField($model, 'pin'); ?> <span><?php echo $form->error($model,'pin'); ?> </span></div>
         
          <div class="clear"></div>
        </div>
        <div class="row-form">
          
      </div>
    </div>
    </div>
    <div class="dr"><span></span></div>
    <div class="row-fluid">
      <div class="span12">
        <div class="head">
          <div class="isw-list"></div>
          <h1>Doctor's Info </h1>
          <div class="clear"></div>
        </div>
       
          <div>
           <div class="block-fluid">
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model,'dept'); ?></div>
              <div class="span3"> <?php echo $form->dropDownList($model,'dept', Dept::GetAll(), array(
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => FRONT_SITE_URL.'bebooking/loaddoctor',
							'data'=>array('region_id'=>'js:this.value',$csrf_token_name => $csrf_token),
							'update'=>'#Patient_consultant',
                        )
                    )); ?> <span><?php echo $form->error($model,'dept'); ?> </span> </div>
              <div class="span3"><?php echo $form->label($model,'consultant'); ?></div>
              <div class="span3"> <?php echo $form->dropDownList($model,'consultant', array()); ?> <span><?php echo $form->error($model,'consultant'); ?> </span> </div>
              <div class="clear"></div>
            </div>
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model,'reference'); ?></div>
              <div class="span3"> <?php echo $form->textField($model,'reference',array()); ?> <span><?php echo $form->error($model,'reference'); ?> </span> </div>
              <div class="clear"></div>
            </div>
           </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p> <?php echo CHtml::submitButton('Save Patient Info', array('class'=>'btn btn-large', 'id'=>'Save', 'name'=>'Save', 'confirm' => 'Patient Info has been Saved. Are you sure!!')
); ?> </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff --> 

