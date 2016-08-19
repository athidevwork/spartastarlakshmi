<div class="workplace">
  <div class="form">
  
   <div class="row-fluid">
    
    <div class="span6">
    
        <div class="head">
          <div class="isw-target"></div>
          <h1><?php echo t('Roll'); ?></h1>
          <div class="clear"></div>
        </div>
      
      <div class="block-fluid">


<?php $form=$this->beginWidget('CActiveForm'); ?>
	
    
     <div class="row-form">
            
            <div class="span7"> <?php echo $form->dropDownList($model,'itemname',  $itemnameSelectOptions); ?> <span><?php echo $form->error($model,'itemname'); ?> </span>  </div>
            <div class="clear"></div>
          </div>
        
      
      </div>
    
	<div class="row-fluid">
      <div class="span9">
        <p>
          <button class="btn btn-large" type="submit">Save</button>
          
        </p>
      </div>
    </div>
	
	

<?php $this->endWidget(); ?>
 </div> </div>
</div>
</div></div>