

<div class="workplace">
  <div class="form">
    <?php $this->render('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'usercreate-form',
        'enableAjaxValidation'=>true,       
        )); 
?>
    <?php echo $form->errorSummary(array($model)); ?>
    <div class="span6" style="float:right;"> </div>
    <div class="row-fluid">
      <div class="span6">
        <div class="head">
          <div class="isw-user"></div>
          <h1><?php echo t('User'); ?></h1>
          <div class="clear"></div>
        </div>
        <div class="block-fluid">
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'email'); ?></div>
            <div class="span7"> <?php echo $form->textField($model, 'email'); ?> <span><?php echo $form->error($model,'email'); ?></span> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'username'); ?></div>
            <div class="span7"> <?php echo $form->textField($model, 'username'); ?> <span><?php echo $form->error($model,'username'); ?> </span> </div>
            <div class="clear"></div>
          </div>
          
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'display_name'); ?></div>
            <div class="span7"> <?php echo $form->textField($model, 'display_name'); ?> <span><?php echo $form->error($model,'display_name'); ?> </span> </div>
            <div class="clear"></div>
          </div>
          
           <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'password'); ?></div>
            <div class="span7"> <?php echo $form->passwordField($model, 'password'); ?> <span><?php echo $form->error($model,'password'); ?> </span> </div>
            <div class="clear"></div>
          </div>
          
        </div>
      </div>
    </div>    
    <div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit"><?php echo t('Save'); ?></button>
          <button class="btn btn-large btn-warning" type="cancel"><?php echo t('Cancel'); ?></button>
        </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
    <script type="text/javascript">    
    CopyString('#UserCreateForm_email','#UserCreateForm_username','email');
    CopyString('#UserCreateForm_email','#UserCreateForm_display_name','email');
</script>
  </div>
  <!-- form --> 
</div>