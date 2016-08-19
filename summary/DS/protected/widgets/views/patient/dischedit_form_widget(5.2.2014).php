<?php
$csrf_token_name = Yii::app()->request->csrfTokenName;
$csrf_token = Yii::app()->request->csrfToken;	
$id = isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
?>

<?php $this->render('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'disch-form',
		//'focus'=>array($model1,'diagnosis'),
		'focus'=>'input[type="text"]:first',
        'enableAjaxValidation'=>true,       
        )); 
?>
<?php echo $form->errorSummary(array($model1)); ?>

<div class="span12">
  <div class="head">
    <div class="isw-mail"></div>
    <h1>Patient's Discharge Summary</h1>
    <div class="clear"></div>
  </div>
  
  <div class="block-fluid tabs">
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'type'); ?></div>
      <div class="span3"><?php echo $form->dropDownList($model1,'type', ConstantDefine::GetType(),array("onchange"=>"get_date_time_expiry()")); ?> <span><?php echo $form->error($model1,'type'); ?> </span> 
      </div>
     <?php if($model1 ->type==2){$display_expiry = 'inline';}else{$display_expiry = 'none';}?>
      <div id="date_time_expiry" style="display:<?php echo $display_expiry;?>">
      <div class="span2"><?php echo $form->label($model1,'expiry'); ?></div>
      <div class="span2"><?php echo $form->textField($model1, 'expiry'); ?> <span><?php echo $form->error($model1,'expiry'); ?> </span> </div>
      </div>

      <div class="clear"></div>
    </div>
    
    <ul>
      <li><a href="#tabs-1">Medical History</a></li>
      <li><a href="#tabs-2">Personal History</a></li>
      <li><a href="#tabs-3">Investigations</a></li>
      <li><a href="#tabs-4">Diabetic Advice Medicine</a></li>
      <li><a href="#tabs-5">Medication</a></li>
      <li><a href="#tabs-6">Follow Up</a></li>
    </ul>
    
<!--------------    Medical History   -------------->

   <div id="tabs-1">
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'operation'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'operation'); ?> <span><?php echo $form->error($model1,'operation'); ?> </span> </div>
      <div class="clear"></div>
    </div>
      <div class="row-form">
          <div class="span2"><?php echo $form->labelEx($model1,'diagnosis'); ?>
</div>
          <div class="span10">
		<?php echo $form->textArea($model1, 'diagnosis', array('id'=>'editor1')); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor1', {
         
    });
</script>
        <span><?php echo $form->error($model1,'diagnosis'); ?> </span> <?php echo $form->hiddenField($model1,'pid',array('value'=>$model1->pid)); ?>
          </div>
          <div class="clear"></div>
        </div>
         <div class="row-form">
	   <div class="span2"> <?php echo $form->labelEx($model1,'proname'); ?></div>
	   <div class="span10">
<?php echo $form->textArea($model1, 'proname', array('id'=>'editor9')); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor9', {
    });
</script>
      </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'history'); ?></div>
      <div class="span10">
<?php echo $form->textArea($model1, 'history', array('id'=>'editor10')); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor10', {
    });
</script>
      </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'dm'); ?></div>
      <div class="span1"><?php echo $form->dropDownList($model1,'dm', ConstantDefine::GetResult(),array()); ?> <span><?php echo $form->error($model1,'dm'); ?> </span> </div>
      
      <div class="span2"><?php echo $form->label($model1,'hypertension'); ?></div>
      <div class="span1"><?php echo $form->dropDownList($model1,'hypertension', ConstantDefine::GetResult(),array()); ?> <span><?php echo $form->error($model1,'hypertension'); ?> </span> </div>
      
      <div class="span2"><?php echo $form->label($model1,'cad'); ?></div>
      <div class="span1"><?php echo $form->dropDownList($model1,'cad', ConstantDefine::GetResult(),array()); ?> <span><?php echo $form->error($model1,'cad'); ?> </span> </div>
      
      <div class="clear"></div>
    </div>
    
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'asthma'); ?></div>
      <div class="span1"><?php echo $form->dropDownList($model1,'asthma', ConstantDefine::GetResult(),array()); ?> <span><?php echo $form->error($model1,'asthma'); ?> </span> </div>
      
      <div class="span2"><?php echo $form->label($model1,'past_history'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'past_history'); ?> <span><?php echo $form->error($model1,'past_history'); ?> </span> </div>
      
      <div class="clear"></div>
    </div>
    
     <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'surgical_history'); ?></div>
      <div class="span10">
<?php echo $form->textArea($model1, 'surgical_history', array('id'=>'editor11')); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor11', {
    });
</script>
      </div>
      <div class="clear"></div>
      
   </div>   
      
    </div>
    
<!--------------    Personal History   -------------->

    <div id="tabs-2">
    
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'ethanol'); ?></div>
      <div class="span1"><?php echo $form->dropDownList($model1,'ethanol', ConstantDefine::GetResult(),array()); ?> <span><?php echo $form->error($model1,'ethanol'); ?> </span> </div>
      
      <div class="span1"><?php echo $form->label($model1,'smoking'); ?></div>
      <div class="span1"><?php echo $form->dropDownList($model1,'smoking', ConstantDefine::GetResult(),array()); ?> <span><?php echo $form->error($model1,'smoking'); ?> </span> </div>

      <div class="span1"><?php echo $form->label($model1,'others'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'others'); ?> <span><?php echo $form->error($model1,'others'); ?> </span> </div>

      <div class="clear"></div>
    </div>
    
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'weight'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'weight');?><span><?php echo $form->error($model1,'weight');?> Kgs</span> </div>
      <div class="span1"><?php echo $form->label($model1,'height'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'height');?> <span><?php echo $form->error($model1,'height'); ?> Cms</span> </div>
      <div class="span1"><?php echo $form->label($model1,'palior'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'palior');?> <span><?php echo $form->error($model1,'palior'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'cyanosis'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'cyanosis');?> <span><?php echo $form->error($model1,'cyanosis'); ?> </span> </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'clubbing'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'clubbing');?> <span><?php echo $form->error($model1,'clubbing'); ?> </span> </div>
      <div class="span2"><?php echo $form->label($model1,'edemafeet'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'edemafeet');?> <span><?php echo $form->error($model1,'edemafeet'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'oralcavity'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'oralcavity');?> <span><?php echo $form->error($model1,'oralcavity'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'icterus'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'icterus');?> <span><?php echo $form->error($model1,'icterus'); ?> </span> </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'lymphnodes'); ?></div>
      <div class="span2"><?php echo $form->textField($model1, 'lymphnodes');?> <span><?php echo $form->error($model1,'lymphnodes'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'temp'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'temp');?> <span><?php echo $form->error($model1,'temp'); ?>`F </span> </div>
      <div class="span1"><?php echo $form->label($model1,'pulse'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'pulse');?> <span><?php echo $form->error($model1,'pulse'); ?>per min</span> </div>
      <div class="span1"><?php echo $form->label($model1,'bp'); ?></div>
      <div class="span1"><?php echo $form->textField($model1, 'bp');?> <span><?php echo $form->error($model1,'bp'); ?> </span> mmHg</div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'head'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'head'); ?> <span><?php echo $form->error($model1,'head'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'cvs'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'cvs'); ?> <span><?php echo $form->error($model1,'cvs'); ?> </span> </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'rs'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'rs'); ?> <span><?php echo $form->error($model1,'rs'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'abdomen'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'abdomen'); ?> <span><?php echo $form->error($model1,'abdomen'); ?> </span> </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'cns'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'cns'); ?> <span><?php echo $form->error($model1,'cns'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'genitais'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'genitais'); ?> <span><?php echo $form->error($model1,'genitais'); ?> </span> </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'functionalevaluation'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'functionalevaluation'); ?> <span><?php echo $form->error($model1,'functionalevaluation'); ?> </span> </div>
      <div class="span1"><?php echo $form->label($model1,'diet'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'diet'); ?> <span><?php echo $form->error($model1,'diet'); ?> </span> </div>
      <div class="clear"></div>
    </div>
<div class="row-form">
      <div class="span1"><?php echo $form->label($model1,'physicalactivity'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'physicalactivity'); ?> <span><?php echo $form->error($model1,'physicalactivity'); ?> </span> </div>
      <div class="clear"></div>
    </div>    
    </div>
    
<!--------------    Investigations   -------------->
    <div id="tabs-3">
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'invest'); ?></div>
      <div class="span4"><?php echo $form->textField($model1, 'invest'); ?> <span><?php echo $form->error($model1,'invest'); ?> </span> </div>
      <div class="clear"></div>
    </div>
        <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'other_consultant'); ?></div>
      <div class="span10">
<?php echo $form->textArea($model1, 'other_consultant', array('id'=>'editor12')); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor12', {
    });
</script>
      </div>
      <div class="clear"></div>
    </div>
        
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'family_history'); ?></div>
      <div class="span10">
<?php echo $form->textArea($model1, 'family_history', array('id'=>'editor13')); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor13', {
    });
</script>
      </div>
      <div class="clear"></div>
    </div>
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'sigmedicine'); ?></div>
      <div class="span3"><?php echo $form->textField($model1, 'sigmedicine'); ?> <span><?php echo $form->error($model1,'sigmedicine'); ?> </span> </div>
      
      <div class="span2"><?php echo $form->label($model1,'conditionatdischarge'); ?></div>
      <div class="span3"><?php echo $form->dropDownList($model1,'conditionatdischarge', ConstantDefine::GetDischargecondition(),array()); ?> <span><?php echo $form->error($model1,'conditionatdischarge'); ?> </span> </div>

      <div class="clear"></div>
    </div>
   </div>
   
<!--------------    Physical Activity  -------------->
    <div id="tabs-4">
    <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'on_examination'); ?></div>
       <?php $on_examination_table = $model1-> on_examination;?>
      <div class="span10">        
<?php echo $form->textArea($model1, 'on_examination', array('id'=>'editor14','value'=>$on_examination_table )); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor14', {
    });
</script>
        
      </div>
      <div class="clear"></div>
      </div>
 </div>
 
<!--------------    Medication  -------------->
    <div id="tabs-5">
         <div class="row-form">
      <div class="span2"><?php echo $form->label($model1,'investigation'); ?></div>
       <?php $on_examination_table = $model1-> investigation;?>
      <div class="span10">
<?php echo $form->textArea($model1, 'investigation', array('id'=>'editor15','value'=>$investigation_table )); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor15', {
    });
</script>
      </div>
      <div class="clear"></div>
      </div>
     </div>   
<!--------------    Follow Up  -------------->
    <div id="tabs-6">
        <div class="row-form">
          <div class="span2"><?php echo $form->label($model1,'next_visit'); ?></div>
          <div class="span10">
<?php echo $form->textArea($model1, 'next_visit', array('id'=>'editor16')); ?>
        <script type="text/javascript">
    CKEDITOR.replace( 'editor16', {
    });
</script>
          </div>
          <div class="clear"></div>
        </div>
      </div>
<!--------------    Follow Up  -------------->
 
 </div>
    </div>
    <div class="dr"><span></span></div>
    <div class="clear"></div>
    <div class="row-fluid">
      <div class="span9">
        <p> <?php echo CHtml::submitButton('Generate Summary', array('class'=>'btn btn-large', 'id'=>'Save', 'name'=>'Save', 'confirm' => 'Discharge Summary has been Saved. Are you sure!!')
); ?> <!-- <?php echo CHtml::submitButton('Generate Summary & Discharge',array('class'=>'btn btn-large', 'id'=>'Print', 'name'=>'Print', 'confirm' => 'Discharge Summary has been Generated and Patient Discharged, Are you sure?')
); ?> --> </p>

      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  <!-- form --> 
<!-- //Render Partial for Javascript Stuff --> 
<script>
function get_date_time_expiry() {
	var Discharge_type = jQuery("#Discharge_type").val();
	if(Discharge_type==2)
		jQuery("#date_time_expiry").show();
	else
		jQuery("#date_time_expiry").hide();
}
</script>
