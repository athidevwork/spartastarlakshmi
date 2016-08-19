
<div class="workplace">
<div class="form">
  <?php $this->render('cmswidgets.views.notification'); ?>
  <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'discharge-form',
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
      <?php $admit_info = Admit::GetPatient($patient_info->patient_id); ?>
      <div class="block">
        <h5> Patient ID : <?php echo $patient_info->patient_id; ?> </h5>
        <h5> Admission ID : <?php echo $admit_info->admit_id; ?> </h5>
        <address>
        <strong><?php echo $patient_info->name; ?></strong><br>
        <?php echo Patient::GetGender($patient_info->gender).'/'.$patient_info->age; ?> Yrs<br>
        <?php echo $patient_info->address1.', '.$patient_info->address2; ?>,
        <?php echo $patient_info->city.', '.$patient_info->zip; ?><br>
        <?php echo $patient_info->relate.' : '.$patient_info->guardian; ?><br>
        <abbr title="Phone">Phone:</abbr> <?php echo $patient_info->tele; ?> <abbr title="Phone">Mobile:</abbr> <?php echo $patient_info->mobile; ?>
        </address>
        <address>
        
        <a href="mailto:<?php echo $patient_info->email; ?>"><?php echo $patient_info->email; ?></a>
        </address>
        <?php echo $form->hiddenField($model1,'patient_id',array('value'=>$patient_info->patient_id)); ?>
        <?php echo $form->hiddenField($model1,'admit_id',array('value'=>$admit_info->admit_id)); ?>
      </div>
    </div>
    </div>
    
    <div class="row-fluid">
    <div class="span12">
      <div class="head">
        <div class="isw-mail"></div>
        <h1>Patient's Discharge Summary</h1>
        <div class="clear"></div>
      </div>
      <div class="block-fluid">
      <div class="row-form">
            <div class="span2"><?php echo $form->label($model1,'diagnosis'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'diagnosis'); ?> <span><?php echo $form->error($model1,'diagnosis'); ?> </div>
            
            
            
            
            
            
            
            
            
            <div class="span2"><?php echo $form->label($model1,'operation'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'operation'); ?> <span><?php echo $form->error($model1,'operation'); ?> </div>
            <div class="clear"></div>
          </div>
          
     <div class="row-form">
            
            <div class="span2"><?php echo $form->label($model1,'history'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'history'); ?> <span><?php echo $form->error($model1,'history'); ?></span> </div>
             <div class="span2"><?php echo $form->label($model1,'past_history'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'past_history'); ?> <span><?php echo $form->error($model1,'past_history'); ?> </div>
            <div class="clear"></div>
          </div>
          
     <div class="row-form">
           
            <div class="span2"><?php echo $form->label($model1,'personal_history'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'personal_history'); ?> <span><?php echo $form->error($model1,'personal_history'); ?></span> </div>
             <div class="span2"><?php echo $form->label($model1,'family_history'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'family_history'); ?> <span><?php echo $form->error($model1,'family_history'); ?> </div>
            <div class="clear"></div>
          </div>
          
     <div class="row-form">
            <div class="span2"><?php echo $form->label($model1,'investigation'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'investigation'); ?> <span><?php echo $form->error($model1,'investigation'); ?> </div>
           
            <div class="clear"></div>
          </div>
     <div class="row-form">
            <div class="span2"><?php echo $form->label($model1,'on_examination'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'on_examination'); ?> <span><?php echo $form->error($model1,'on_examination'); ?></span> </div>
            <div class="span2"><?php echo $form->label($model1,'operation_notes'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'operation_notes'); ?> <span><?php echo $form->error($model1,'operation_notes'); ?></span> </div>
            <div class="clear"></div>
          </div>   
          
     <div class="row-form">
            <div class="span2"><?php echo $form->label($model1,'treatment_given'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'treatment_given'); ?> <span><?php echo $form->error($model1,'treatment_given'); ?> </div>
            <div class="span2"><?php echo $form->label($model1,'condition_at_discharge'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'condition_at_discharge'); ?> <span><?php echo $form->error($model1,'condition_at_discharge'); ?></span> </div>
            <div class="clear"></div>
          </div>
          
     <div class="row-form">
            <div class="span2"><?php echo $form->label($model1,'advice_on_discharge'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'advice_on_discharge'); ?> <span><?php echo $form->error($model1,'advice_on_discharge'); ?> </div>
            <div class="span2"><?php echo $form->label($model1,'other_consultant'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'other_consultant'); ?> <span><?php echo $form->error($model1,'other_consultant'); ?></span> </div>
            <div class="clear"></div>
          </div>
     <div class="row-form">
            <div class="span2"><?php echo $form->label($model1,'next_visit'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'next_visit'); ?> <span><?php echo $form->error($model1,'next_visit'); ?> </div>
            <div class="span2"><?php echo $form->label($model1,'medical_officer'); ?></div>
            <div class="span4"><?php echo $form->textArea($model1, 'medical_officer'); ?> <span><?php echo $form->error($model1,'medical_officer'); ?></span> </div>
            <div class="clear"></div>
          </div>
      
    </div>
    </div>
    
    <div class="dr"><span></span></div>
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit"><?php echo t('Generate Summary'); ?></button>
        </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff -->
<?php $this->render('cmswidgets.views.patient.patient_form_javascript',array('model'=>$model1,'form'=>$form)); ?>
