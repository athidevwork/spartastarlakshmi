<?php

$csrf_token_name = Yii::app()->request->csrfTokenName;
$csrf_token = Yii::app()->request->csrfToken;	

?>

<div class="workplace">
<div class="form">
  <?php $this->render('cmswidgets.views.notification'); ?>
  <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'admit-form',
        'enableAjaxValidation'=>true,       
        )); 
?>
  <?php echo $form->errorSummary(array($model1)); ?>
  <div class="span6" style="float:right;"> </div>
  <div class="row-fluid">
    
    <div class="span6">
      <div class="head">
        <div class="isw-mail"></div>
        <h1>Admission Info</h1>
        <div class="clear"></div>
      </div>
      <div class="block-fluid">
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'patient_id'); ?></div>
          <div class="span5"><?php echo $form->textField($model1, 'patient_id',array('readonly' => true)); ?> <span><?php echo $form->error($model1,'patient_id'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'admit_id'); ?></div>
          <div class="span5"><?php echo $form->textField($model1, 'admit_id',array('readonly' => true)); ?> <span><?php echo $form->error($model1,'admit_id'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'adate'); ?></div>
          <div class="span5"><?php 
                                        
										$this->widget('cms.extensions.timepicker.EJuiDateTimePicker',array(
                                            'model'=>$model1,
                                            'attribute'=>'adate',

                                            'options'=>array(
                                                'value'=>'12',
                                                'dateFormat'=>'dd-mm-yy',
                                                'timeFormat' => 'hh:mm:ss',
                                                'changeMonth' => true,
                                                'changeYear' => true,
                                                ),

                                            ));  
                                        ?> <span><?php echo $form->error($model1,'adate'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'floor'); ?></div>
          
        
        <div class="span7"><?php echo $form->dropDownList($model1,'floor',  Floor::GetAll(), array(
                        'ajax' => array(
                            'type' => 'POST',
							'dataType'=>'json',
                            'url' => FRONT_SITE_URL.'bebooking/loadprovince',
							'data'=>array('region_id'=>'js:this.value',$csrf_token_name => $csrf_token),
							
							'success'=>'function(data) {
                            $("#Admit_room").html(data.dropDownCities);
							$("#Admit_bed").html(data.dropDownDistricts);
                            
                        }',
							
                            
                        )
                    )); ?> <span><?php echo $form->error($model1,'floor'); ?> </span> </div>
        
        
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'room'); ?></div>
          <div class="span5"><?php echo $form->dropDownList($model1,'room',array(), array(
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => FRONT_SITE_URL.'bebooking/loadtown',
							'data'=>array('province_id'=>'js:this.value',$csrf_token_name => $csrf_token),							
							'update'=>'#Admit_bed',
                        )
                    )); ?> <span><?php echo $form->error($model1,'room'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'bed'); ?></div>
          <div class="span5"><?php echo $form->dropDownList($model1,'bed',array()); ?> <span><?php echo $form->error($model1,'bed'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
              <div class="span3"><?php echo $form->label($model1,'dept'); ?></div>
              <div class="span3"> <?php echo $form->dropDownList($model1,'dept', Dept::GetAll(), array(
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => FRONT_SITE_URL.'bebooking/loaddoctor',
							'data'=>array('region_id'=>'js:this.value',$csrf_token_name => $csrf_token),
							'update'=>'#Admit_consultant',
                        )
                    )); ?> <span><?php echo $form->error($model1,'dept'); ?> </span> </div>
              <div class="span3"><?php echo $form->label($model1,'consultant'); ?></div>
              <div class="span3"> <?php echo $form->dropDownList($model1,'consultant', array()); ?> <span><?php echo $form->error($model1,'consultant'); ?> </span> </div>
              <div class="clear"></div>
            </div>
            <div class="row-form">
              <div class="span3"><?php echo $form->label($model1,'reference'); ?></div>
              <div class="span3"> <?php echo $form->textField($model1,'reference',array()); ?> <span><?php echo $form->error($model1,'reference'); ?> </span> </div>
              <div class="clear"></div>
            </div>
        
      </div>
    </div>
    
    <div class="span6">
      <div class="head">
        <div class="isw-mail"></div>
        <h1>Patient's Info</h1>
        <div class="clear"></div>
      </div>
      <?php $patient_info = Patient::GetPatient($model1->patient_id); ?>
      <div class="block">
        <h5> ID : <?php echo $patient_info->patient_id; ?> </h5>
        <address>
        <strong><?php echo $patient_info->name; ?></strong><br>
        <?php if( ($patient_info->dob <= time()) && ($patient_info->dob != 0) ) { echo dateDiff($patient_info->dob).' / '; } ?><?php echo Patient::GetGender($patient_info->gender); ?><br>
        <?php echo $patient_info->address1.', '.$patient_info->address2; ?><br>
        <?php echo $patient_info->city.', '.$patient_info->zip; ?><br>
        <?php echo $patient_info->relate.' : '.$patient_info->guardian; ?><br>
        <abbr title="Phone">Phone:</abbr> <?php echo $patient_info->tele; ?> <abbr title="Phone">Mobile:</abbr> <?php echo $patient_info->mobile; ?>
        </address>
        <address>
        <a href="mailto:<?php echo $patient_info->email; ?>"><?php echo $patient_info->email; ?></a>
        </address>
      </div>
    </div>
    
    <div class="dr"><span></span></div>
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p>
          
          <?php echo CHtml::submitButton('Process The Admission', array('class'=>'btn btn-large', 'id'=>'Save', 'name'=>'Save', 'confirm' => 'Patient has been admitted. Are you sure!!')
); ?>

 <?php echo CHtml::submitButton('Admit and Print admission Slip', array('class'=>'btn btn-large', 'id'=>'Print', 'name'=>'Print', 'confirm' => 'Patient has been admitted. Are you sure!!')
); ?>
          
        </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff --> 
