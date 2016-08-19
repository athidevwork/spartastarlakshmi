
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
        <div class="span5"><?php echo $form->textField($model1, 'adate',array('readonly' => true)); ?> <span><?php echo $form->error($model1,'adate'); ?> </span> </div>
        <div class="clear"></div>
      </div>
      
      <div class="row-form">
        <div class="span5"><?php echo $form->label($model1,'bed'); ?></div>
        <div class="span5"><?php echo $form->dropDownList($model1,'bed', Bed::GetAll(),array()); ?> <span><?php echo $form->error($model1,'bed'); ?> </span> </div>
        <div class="clear"></div>
      </div>
      
      </div>
    </div>
    <div class="dr"><span></span></div>
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit"><?php echo t('Process the Admission'); ?></button>
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
