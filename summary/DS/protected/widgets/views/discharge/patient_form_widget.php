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
            <div class="span7"><?php echo $form->textField($model, 'name'); ?> <span><?php echo $form->error($model,'name'); ?> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'Age *'); ?></div>
            <div class="span2"><?php echo $form->textField($model, 'age',array('id'=>'txt_name')); ?> <span><?php echo $form->error($model,'age'); ?> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'gender'); ?></div>
            <div class="span3"><?php echo $form->dropDownList($model,'gender', ConstantDefine::GetGender(),array()); ?> <span><?php echo $form->error($model,'gender'); ?> </span> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'mstatus'); ?></div>
            <div class="span3"><?php echo $form->dropDownList($model,'mstatus', ConstantDefine::GetMaritial(),array()); ?>  <span><?php echo $form->error($model,'mstatus'); ?> </span> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'height'); ?></div>
            <div class="span2"><?php echo $form->textField($model, 'height'); ?> <span><?php echo $form->error($model,'height'); ?> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'weight'); ?></div>
            <div class="span2"><?php echo $form->textField($model, 'weight'); ?> <span><?php echo $form->error($model,'weight'); ?> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'bg'); ?></div>
            <div class="span2"><?php echo $form->textField($model, 'bg'); ?> <span><?php echo $form->error($model,'bg'); ?> </span> </div>
            <div class="clear"></div>
          </div>
         
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'guardian'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'guardian'); ?> <span><?php echo $form->error($model,'guardian'); ?>  </span> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'relate'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'relate'); ?> <span><?php echo $form->error($model,'relate'); ?></span> </div>
            <div class="clear"></div>
          </div>
          
        </div>
      </div>
     
      <div class="span6">
        <div class="head">
          <div class="isw-target"></div>
          <h1><?php echo t('Patient ID'); ?></h1>
          <div class="clear"></div>
        </div>
        
        <div class="block-fluid">
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'patient_id'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'patient_id',array('readonly' => true)); ?> <span><?php echo $form->error($model,'patient_id'); ?> </span> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'op_date'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'op_date',array('readonly' => true)); ?> <span><?php echo $form->error($model,'op_date'); ?> </span> </div>
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
            <div class="span5"><?php echo $form->label($model,'address1'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'address1'); ?> <span><?php echo $form->error($model,'address1'); ?> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'address2'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'address2'); ?> <span><?php echo $form->error($model,'address2'); ?> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'city'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'city'); ?> <span><?php echo $form->error($model,'city'); ?> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'pin'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'pin'); ?> <span><?php echo $form->error($model,'pin'); ?> </div>
            <div class="span3"><?php echo $form->label($model,'email'); ?></div>
            <div class="span5"><?php echo $form->textField($model, 'email'); ?> <span><?php echo $form->error($model,'email'); ?> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span2"><?php echo $form->label($model,'tele'); ?></div>
            <div class="span4"><?php echo $form->textField($model, 'tele'); ?> <span><?php echo $form->error($model,'tele'); ?> </div>
            <div class="span2"><?php echo $form->label($model,'mobile'); ?></div>
            <div class="span4"><?php echo $form->textField($model, 'mobile'); ?> <span><?php echo $form->error($model,'mobile'); ?> </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    
    <div class="dr"><span></span></div>
    <div class="row-fluid">
      <div class="span12">
        <div class="head">
          <div class="isw-list"></div>
          <h1>Additional information </h1>
          <div class="clear"></div>
        </div>
        <div class="block-fluid accordion">
          <h3>Insurence Info</h3>
          <div>
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model,'policy_no'); ?></div>
              <div class="span3"> <?php echo $form->textField($model,'policy_no',array()); ?> <span><?php echo $form->error($model,'policy_no'); ?> </div>
              <div class="span3"><?php echo $form->label($model,'policy_name'); ?></div>
              <div class="span3"> <?php echo $form->textField($model,'policy_name', array()); ?> <span><?php echo $form->error($model,'policy_name'); ?> </div>
              <div class="clear"></div>
            </div>
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model,'company'); ?></div>
              <div class="span3"> <?php echo $form->textField($model,'company', array()); ?> <span><?php echo $form->error($model,'company'); ?> </div>
              
              <div class="clear"></div>
            </div>
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model,'sdate'); ?></div>
              <div class="span3">  <?php 
                                        
										$this->widget('cms.extensions.timepicker.EJuiDateTimePicker',array(
                                            'model'=>$model,
                                            'attribute'=>'sdate',

                                            'options'=>array(
                                                'value'=>'12',
                                                'dateFormat'=>'dd-mm-yy',
                                                'timeFormat' => 'hh:mm:ss',
                                                'changeMonth' => true,
                                                'changeYear' => true,
                                                ),

                                            ));  
                                        ?> <span><?php echo $form->error($model,'sdate'); ?> </div>
              <div class="span3"><?php echo $form->label($model,'edate'); ?></div>
              <div class="span3"> <?php 
                                        
										$this->widget('cms.extensions.timepicker.EJuiDateTimePicker',array(
                                            'model'=>$model,
                                            'attribute'=>'edate',

                                            'options'=>array(
                                                'value'=>'12',
                                                'dateFormat'=>'dd-mm-yy',
                                                'timeFormat' => 'hh:mm:ss',
                                                'changeMonth' => true,
                                                'changeYear' => true,
                                                ),

                                            ));  
                                        ?>  <span><?php echo $form->error($model,'edate'); ?> </div>
              <div class="clear"></div>
            </div>
          </div>
          <h3>Doctors Info</h3>
          <div>
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model,'dept'); ?></div>
              <div class="span3"> <?php echo $form->dropDownList($model,'dept', Dept::GetAll(),array()); ?> <span><?php echo $form->error($model,'dept'); ?> </div>
              <div class="span3"><?php echo $form->label($model,'consultant'); ?></div>
              <div class="span3"> <?php echo $form->dropDownList($model,'consultant', Doctor::GetAll(),array()); ?> <span><?php echo $form->error($model,'consultant'); ?> </div>
              <div class="clear"></div>
            </div>
            
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model,'reference'); ?></div>
              <div class="span3"> <?php echo $form->textField($model,'reference',array()); ?> <span><?php echo $form->error($model,'reference'); ?> </div>
             
              <div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit"><?php echo t('Save Patient Info'); ?></button>
        </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff -->
<?php $this->render('cmswidgets.views.patient.patient_form_javascript',array('model'=>$model,'form'=>$form)); ?>
