<?php $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ; ?>
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
        'id'=>'bills-form',
        'enableAjaxValidation'=>true,       
        )); 
?>
  <?php echo $form->errorSummary(array($model1)); ?>
  <div class="span6" style="float:right;"> </div>
  <div class="row-fluid">
  
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
        <?php echo Patient::GetGender($patient_info->gender).'/'.$patient_info->age; ?> Yrs<br>
        <?php echo $patient_info->address1.', '.$patient_info->address2; ?><br>
        <?php echo $patient_info->city.', '.$patient_info->zip; ?><br>
        <?php echo $patient_info->relate.' : '.$patient_info->guardian; ?><br>
        <abbr title="Phone">Phone:</abbr> <?php echo $patient_info->tele; ?> <abbr title="Phone">Mobile:</abbr> <?php echo $patient_info->mobile; ?>
        </address>
        <address>
        <strong>Full Name</strong><br>
        <a href="mailto:<?php echo $patient_info->email; ?>"><?php echo $patient_info->email; ?></a>
        </address>
      </div>
    </div>
    
    <div class="span6">
      <div class="head">
        <div class="isw-target"></div>
        <h1><?php echo t('Patient'); ?></h1>
        <div class="clear"></div>
      </div>
      <div class="block-fluid">
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'name'); ?></div>
          <div class="span7"><?php echo $form->textField($model1, 'name'); ?> <span><?php echo $form->error($model1,'name'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'billno'); ?></div>
          <div class="span2"><?php echo $form->textField($model1, 'billno'); ?> <span><?php echo $form->error($model1,'billno'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'amount'); ?></div>
          <div class="span2"><?php echo $form->textField($model1, 'amount'); ?> <span><?php echo $form->error($model1,'amount'); ?> </span> </div>
          <?php echo $form->hiddenField($model1,'patient_id',array()); ?>
          <?php echo $form->hiddenField($model1,'admit_id',array()); ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit"><?php echo t('Add Bill Info'); ?></button>
        </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff -->

