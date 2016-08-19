<?php $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ; ?>
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
			'htmlOptions'=>array('class'=>'buttons'),
			'activeCssClass'=>'active',
			'items'=>array(
					array('label'=>'<span class="isw-edit"></span>', 'url'=>array('/bepatient/update','id'=>$id)),
					array('label'=>'<span class="isw-print"></span>', 'url'=>array('/bepatient/print','id'=>$id)),
						),
					));
					?>
      <div class="clear"></div>
    </div>
    <div class="headInfo">
      <div class="image"> <a href="#"><?php echo $model->name; ?></a><img src="<?php echo $backend_asset.'/images/'.$model->gender.'.png'; ?>" class="img-polaroid"/> </div>
      <div class="info">
        <address>
        <strong><?php echo $model->age.' Yrs / '.Patient::GetGender($model->gender); ?></strong><br>
        <?php echo $model->address1.', '.$model->address2; ?><br>
        <?php echo $model->city.' - '.$model->zip; ?><br>
        <abbr title="Phone">Phone:</abbr> <?php echo $model->tele.'/'.$model->mobile; ?><br>
        <a href="mailto:<?php echo $model->email; ?>">Email : <?php echo $model->email; ?></a><br>
        </address>
      </div>
      
      <div class="clear"></div>
      <div class="block">
      <table cellpadding="0" cellspacing="0" width="100%" class="table listUsers">
        <tbody>
          <tr>
            <td><p class="about"> 
            <span class="label label-success"><?php echo t('Height'); ?></span> : <?php echo $model->height; ?> Cm <br/>
            <span class="label label-success"><?php echo t('Weight'); ?></span> : <?php echo $model->weight; ?> Kgs <br/>
            <span class="label label-success"><?php echo t('BG'); ?></span> : <?php echo $model->bg; ?> </p>
            <span class="label label-success"><?php echo t('Ref.By'); ?></span> : <?php echo $model->reference; ?> </p>
            
            </td>
            <td><p class="about"> 
            <span class="label label-success"><?php echo t('Policy No.'); ?></span> : <?php echo $model->policy_no; ?><br/>
            <span class="label label-success"><?php echo t('Policy Name'); ?></span> : <?php echo $model->policy_name; ?><br/>
            <span class="label label-success"><?php echo t('Company'); ?></span> : <?php echo $model->company; ?><br/>
            <span class="label label-success"><?php echo t('Policy Date'); ?></span> : <?php echo date('d-m-Y',$model->sdate).'-'.date('d-m-Y',$model->edate); ?><br/>
              </p></td>
            <td><p class="about"> 
            
            <span class="label label-success"><?php echo t('Guardian Name'); ?></span> : <?php echo $model->guardian; ?><br/>
            <span class="label label-success"><?php echo t('Relation'); ?></span> : <?php echo $model->relate; ?><br/>
             <span class="label label-success"><?php echo t('Dept'); ?></span> : <?php echo Dept::GetName($model->dept); ?> <br/>
            <span class="label label-success"><?php echo t('Consultant'); ?></span> : <?php echo Doctor::GetName($model->consultant); ?> <br/>
            </p>
            </td>
          </tr>
        </tbody>
      </table>
      </div>
    </div>
    <div class="block-fluid accordion">
      <h3>Bills</h3>
      <div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
          <thead>
            <tr>
              <th width="60">Date</th>
              <th>Products</th>
              <th width="60">Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="date">Nov 6</span><span class="time">12:35</span></td>
              <td><a href="#">Product #1</a></td>
              <td><span class="price">$400.12</span></td>
            </tr>
            <tr>
              <td><span class="date">Nov 8</span><span class="time">18:42</span></td>
              <td><a href="#">Product #2</a></td>
              <td><span class="price">$800.00</span></td>
            </tr>
            <tr>
              <td><span class="date">Nov 15</span><span class="time">8:21</span></td>
              <td><a href="#">Product #3</a></td>
              <td><span class="price">$879.24</span></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" align="right"><button class="btn btn-small">More...</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <h3>Previous Discharge Summary</h3>
      <div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
          <thead>
            <tr>
              <th width="60">Date</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="date">Oct 6</span><span class="time">12:35</span></td>
              <td>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis.</td>
            </tr>
            <tr>
              <td><span class="date">Oct 8</span><span class="time">18:42</span></td>
              <td>Donec mauris sapien, pellentesque at porta id, varius eu tellus.</td>
            </tr>
            <tr>
              <td><span class="date">Oct 15</span><span class="time">8:21</span></td>
              <td>Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque.</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" align="right"><button class="btn btn-small">More...</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      
    </div>
  </div>
</div>

