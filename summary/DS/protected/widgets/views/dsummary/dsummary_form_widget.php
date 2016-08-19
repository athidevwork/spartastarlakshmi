
<div class="workplace">
<div class="form">
  <?php $this->render('cmswidgets.views.notification'); ?>
  <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'dsummary-form',
        'enableAjaxValidation'=>true,       
        )); 
?>
  <?php echo $form->errorSummary(array($model1)); ?>  
  <div class="row-fluid">
    <div class="span12">
      <div class="head">
        <div class="isw-mail"></div>
        <h1>Patient's Discharge Summary</h1>
        <div class="clear"></div>
      </div>
      <div class="block-fluid">
      
      <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'name'); ?></div>
          <div class="span10"><?php echo $form->textField($model1, 'name'); ?> <span><?php echo $form->error($model1,'name'); ?> </span> </div>
          <div class="clear"></div>
        </div>
      
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'diagnosis'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'diagnosis'); ?> <span><?php echo $form->error($model1,'diagnosis'); ?> </span> </div>
           <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'operation'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'operation'); ?> <span><?php echo $form->error($model1,'operation'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'history'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'history'); ?> <span><?php echo $form->error($model1,'history'); ?></span> </div>
           <div class="clear"></div>
        </div>
       <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'past_history'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'past_history'); ?> <span><?php echo $form->error($model1,'past_history'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'personal_history'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'personal_history'); ?> <span><?php echo $form->error($model1,'personal_history'); ?></span> </div>
         <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'family_history'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'family_history'); ?> <span><?php echo $form->error($model1,'family_history'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'investigation'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'investigation'); ?> <span><?php echo $form->error($model1,'investigation'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'on_examination'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'on_examination'); ?> <span><?php echo $form->error($model1,'on_examination'); ?></span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'operation_notes'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'operation_notes'); ?> <span><?php echo $form->error($model1,'operation_notes'); ?></span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'treatment_given'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'treatment_given'); ?> <span><?php echo $form->error($model1,'treatment_given'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'condition_at_discharge'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'condition_at_discharge'); ?> <span><?php echo $form->error($model1,'condition_at_discharge'); ?></span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
           <div class="span2"><?php echo $form->label($model1,'consultant'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'consultant'); ?> <span><?php echo $form->error($model1,'next_visit'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'other_consultant'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'other_consultant'); ?> <span><?php echo $form->error($model1,'other_consultant'); ?></span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'next_visit'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'next_visit'); ?> <span><?php echo $form->error($model1,'next_visit'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'medical_officer'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'medical_officer'); ?> <span><?php echo $form->error($model1,'medical_officer'); ?></span> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
        <div class="span2"><?php echo $form->label($model1,'advice_on_discharge'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'advice_on_discharge'); ?> <span><?php echo $form->error($model1,'advice_on_discharge'); ?> </span> </div>
          <div class="clear"></div>
        </div>
        <div class="row-form">
         
          <div class="span2"><?php echo $form->label($model1,'ref_by'); ?></div>
          <div class="span10"><?php echo $form->textArea($model1, 'ref_by'); ?> <span><?php echo $form->error($model1,'medical_officer'); ?></span> </div>
          <div class="clear"></div>
        </div>
        
      </div>
    </div>
    <div class="dr"><span></span></div>
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p> <?php echo CHtml::submitButton('Generate Summary', array('class'=>'btn btn-large', 'id'=>'Save', 'name'=>'Save', 'confirm' => 'Discharge Summary has been Saved. Are you sure!!')
); ?>  </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff --> 
