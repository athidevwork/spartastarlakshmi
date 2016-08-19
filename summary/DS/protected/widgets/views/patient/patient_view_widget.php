<?php $id = isset($_GET['id']) ? (int) ($_GET['id']) : 0 ; ?>
<?php     
       if(YII_DEBUG)
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, true);
        else
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, false);
        
?>

<div class="span6"> </div>
<div class="row-fluid">
  <div class="span8">
    <div class="head">
      <div class="isw-users"></div>
      <h1><?php echo $model->name; ?><?php echo t("'s Information"); ?></h1>
      <?php
			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'htmlOptions'=>array('class'=>'buttons','target'=>'_blank'),
			'activeCssClass'=>'active',
			'items'=>array(
					array('label'=>'<span class="isw-edit"></span>', 'url'=>array('/bepatient/update','id'=>$id)),
					
						),
					));
					?>
      <div class="clear"></div>
    </div>
    <div class="headInfo">
      <div class="image"> <a href="#"><?php echo $model->name; ?></a><img src="<?php echo $backend_asset.'/images/'.$model->gender.'.png'; ?>" class="img-polaroid"/> </div>
      <div class="info">
        <address>
        <strong> <?php
		
		if( $model->age != 0 ) 			
			{ echo $model->age.' / '; } 
			
		else 
		
		  {
			   if( ($model->dob <= time()) && ($model->dob != 0) ) { echo dateDiff($model->dob).' / '; } 
		  }
		?>
		
		
		<?php echo Patient::GetGender($model->gender); ?> </strong><br>
        <?php echo $model->address; ?><br>
        <?php echo $model->city.' - '.$model->pin; ?><br>
       
      </div>
      <div class="clear"></div>
      <div class="block">
        <table cellpadding="0" cellspacing="0" width="100%" class="table listUsers">
          <tbody>
            <tr>
              <td><p class="about"> <span class="label label-success"><?php echo t('Room No'); ?></span> : <?php echo $model->roomno; ?> <br/>
                
                  <span class="label label-success"><?php echo t('MRD No'); ?></span> : <?php echo $model->mrdno; ?> <br/>
                   <span class="label label-success"><?php echo t('Reg No'); ?></span> : <?php echo $model->regno; ?> <br/>
                 <span class="label label-success"><?php echo t('IP No'); ?></span> : <?php echo $model->ipno; ?>  <br/>
                </p></td>
              <td><p class="about">
                 <span class="label label-success"><?php echo t('Admission Date'); ?></span> : <?php echo ($model->admdate!=0) ? $model->admdate : ''; ?><br/>
                  <span class="label label-success"><?php echo t('Discharge Date'); ?></span> : <?php echo ($model->disdate!=0) ? date('d/m/Y',$model->disdate) : ''; ?><br/>
                </p></td>
              <td><p class="about"> 
                 
                  <span class="label label-success"><?php echo t('Department'); ?></span> : <?php echo Dept::GetName($model->dept); ?> <br/>
                  <span class="label label-success"><?php echo t('Consultant'); ?></span> : <?php echo Doctor::GetName($model->consultant); ?> <br/>
                   <span class="label label-success"><?php echo t('Ref.By'); ?></span> : <?php echo $model->reference; ?>
                </p></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="block-fluid accordion">     
      <?php
			$dis_info = Discharge::model()->findAll(array(
			'condition'=>"pid = '".$model->id."'",
			'order'=>'created DESC',
			));
			
			if($dis_info){ 
	?>
      <h3>Discharge Summary(s)</h3>
      <div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
          <thead>
            <tr>
              <th width="60">Date</th>
              <th>Discharge Information</th>
              <th width="60">Print</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dis_info as $di) { ?>
            <tr>
              <td><span class="date"><?php echo date('d-M-Y',$di->created); ?></span><span class="time"><?php echo date('H:m',$di->created); ?></span></td>
              <td><?php echo $di->diagnosis; ?></td>
              <td><a href="<?php echo FRONT_SITE_URL.'bepatient/dprint/'.$di->id; ?>" target="_blank">
                <button class="btn btn-small">Preview</button> </a>
              <?php // echo FRONT_SITE_URL ;?>
                 
                 <a href="<?php echo FRONT_SITE_URL.'bepatient/dischedit/'.$di->id; ?>" >
                <button class="btn btn-small">Edit</button>
                </a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
