<div class="workplace">
<div class="form">
<?php $this->render('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'userupdate-form',
        'enableAjaxValidation'=>true,       
        )); 
?>

<?php echo $form->errorSummary($model); ?>

<div class="row-fluid">
      <div class="span4">
        <div class="head">
          <div class="isw-target"></div>
          <h1><?php echo t('Tour'); ?></h1>
          <div class="clear"></div>
        </div>
<div class="block-fluid">
<div class="row-form">
        <?php echo $form->labelEx($model,'display_name'); ?>
        <?php echo $form->textField($model,'display_name'); ?>
        <?php echo $form->error($model,'display_name'); ?>
</div>
<div class="row-form">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
</div>
<div class="row-form">
        <?php echo $form->labelEx($model,'user_url'); ?>
        <?php echo $form->textField($model,'user_url'); ?>
        <?php echo $form->error($model,'user_url'); ?>
</div>
<div class="row-form">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
</div>
    
<div class="row-form">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',ConstantDefine::getUserStatus()); ?>
        <?php echo $form->error($model,'status'); ?>                                  
</div>
</div>
</div></div>
<div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit"><?php echo t('Save'); ?></button>
        </p>
      </div>
    </div>
    <br class="clear" />

<?php $this->endWidget(); ?>


</div><!-- form -->
</div>