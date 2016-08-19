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
        'id'=>'paybill-form',
        'enableAjaxValidation'=>true,       
        )); 
?>
  <?php echo $form->errorSummary(array($model1)); ?>
  <div class="span6" style="float:right;"> </div>
  <div class="row-fluid">
  
  <div class="span6">
      <div class="head">
        <div class="isw-mail"></div>
        <h1>Bill History</h1>
        <div class="clear"></div>
      </div>
      <?php $patient_info = Patient::GetPatient($model1->patient_id); ?>
      
      <div class="block-fluid accordion">
      <?php
		$bills_info = Bills::model()->findAll(array(
			'condition'=>"patient_id = '".$model1->patient_id."' AND admit_id = '".Admit::GetAdmitId($model1->patient_id)."'",
			'order'=>'created DESC',
			));
			
			$total = 0;
			
			if($bills_info){ 
	?>
      <h3>Bills</h3>
      <div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
          <thead>
            <tr>
              <th width="75">Date</th>
              <th>Products</th>
              <th width="80">Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
		  	
				foreach ($bills_info as $bi) {
			
		  ?>
            <tr>
              <td><span class="date"><?php echo date('d-M-Y',$bi->created); ?></span><span class="time"><?php echo date('H:m',$bi->created); ?></span></td>
              <td><a href="#"><?php echo $bi->name; ?></a></td>
              <td><span class="price">Rs. <?php echo $bi->amount; ?></span></td>
            </tr>
            <?php  } ?>
          </tbody>
          <?php if((Bills::TotalBill($id) - Payment::TotalPaid($id))>0) { ?>
          <tfoot>
            <tr>
              <td colspan="3" align="right">
              
              <a href="<?php echo FRONT_SITE_URL.'bebills/paybill/'.$id; ?>"><button class="btn btn-small">Need to Pay Rs. <?php echo (Bills::TotalBill($id) - Payment::TotalPaid($id)); ?></button></a></td>
            </tr>
          </tfoot>
          <?php } ?>
        </table>
      </div>
      <?php } ?>
    </div>
      
      
    </div>
    
    <div class="span6">
      <div class="head">
        <div class="isw-target"></div>
        <h1><?php echo t('Payment Info'); ?></h1>
        <div class="clear"></div>
      </div>
      <div class="block-fluid">
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'bill_no'); ?></div>
          <div class="span4"><?php echo $form->textField($model1, 'bill_no'); ?> <span><?php echo $form->error($model1,'bill_no'); ?> </div>
          <div class="clear"></div>
        </div>
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'discount'); ?></div>
          <div class="span2"><?php echo $form->textField($model1, 'discount'); ?> <span><?php echo $form->error($model1,'discount'); ?> </div>
          <div class="clear"></div>
        </div>
        
        
        <div class="row-form">
          <div class="span5"><?php echo $form->label($model1,'amount'); ?></div>
          <div class="span2"><?php echo $form->textField($model1, 'amount'); ?> <span><?php echo $form->error($model1,'amount'); ?> </div>
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
          <button class="btn btn-large" type="submit"><?php echo t('Make Payment'); ?></button>
        </p>
      </div>
    </div>
    <br class="clear" />
    <?php $this->endWidget(); ?>
  </div>
  <!-- form --> 
</div>
<!-- //Render Partial for Javascript Stuff -->

