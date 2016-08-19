<?php     
       if(YII_DEBUG)
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, true);
        else
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, false);
			
        $this->renderPartial('application.views.layouts.header',array('backend_asset'=>$backend_asset)); 
?>
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="loginBox">
  <div class="loginHead"> <img src="<?php echo $backend_asset; ?>/images/logo_small.png" alt="Patient Management System" title="Patient Management System" /> </div>
  <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-content',
	'htmlOptions'=>array('class'=>'form-horizontal'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
  <div class="notification noteinformation png_bg">
    <div>
      <?php //if (user()->isGuest) echo 'Guest'; else echo 'Member' ; ?>
    </div>
  </div>
  <div class="control-group"> <?php echo $form->error($model,'username',array('style'=>'text-align:right')); ?> <?php echo $form->label($model,'username'); ?> <?php echo $form->textField($model,'username',array('class'=>'text-input')); ?> </div>
  <div class="clear"></div>
  <div class="control-group"> <?php echo $form->error($model,'password',array('style'=>'text-align:right')); ?> <?php echo $form->label($model,'password'); ?> <?php echo $form->passwordField($model,'password',array('class'=>'text-input')); ?> </div>
  <div class="clear"></div>
  <div class="control-group" style="margin-bottom: 5px;"> <?php echo $form->checkBox($model,'rememberMe',array('style'=>'display:inline')); ?> <?php echo $form->label($model,'rememberMe',array('class'=>'checkbox')); ?> <?php echo $form->error($model,'rememberMe'); ?> </div>
  <div class="clear"></div>
  <div class="form-actions"> <?php echo CHtml::submitButton(t('Get My Area'),array('class'=>'btn btn-large')); ?> </div>
  <br class="clear" />
  <?php $this->endWidget(); ?>
</div>
<!-- form --> 

