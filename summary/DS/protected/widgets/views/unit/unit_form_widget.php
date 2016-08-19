<div class="workplace">
  <div class="form">
    <?php $this->render('cmswidgets.views.notification'); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'unit-form',
        'enableAjaxValidation'=>true,       
        )); 
?>
    <?php echo $form->errorSummary($model); ?>
    <div class="span6" style="float:right;"> </div>
    <div class="row-fluid">
      <div class="span6">
        <div class="head">
          <div class="isw-target"></div>
          <h1>Unit</h1>
          <div class="clear"></div>
        </div>
        <div class="block-fluid">
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'name'); ?></div>
            <div class="span7"> <?php echo $form->textField($model, 'name', array()); ?> <span><?php echo $form->error($model,'name'); ?> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'note'); ?></div>
            <div class="span7"> <?php echo $form->textArea($model, 'note', array()); ?> <span><?php echo $form->error($model,'note'); ?> </div>
            <div class="clear"></div>
          </div>
          <div class="row-form">
            <div class="span5"><?php echo $form->label($model,'status'); ?></div>
            <div class="span7"> <?php echo $form->dropDownList($model,'status',  ConstantDefine::getPageStatus(),array()); ?> <span><?php echo $form->error($model,'status'); ?> </div>
            <div class="clear"></div>
          </div>
        </div>
         <div class="dr"><span></span></div>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit">Save</button>
        </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff -->
<?php $this->render('cmswidgets.views.unit.unit_form_javascript',array('model'=>$model,'form'=>$form)); ?>
