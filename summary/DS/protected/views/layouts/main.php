<!DOCTYPE html>
<html>
<head>
<?php     
       if(YII_DEBUG)
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, true);
        else
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, false);
			
        $this->renderPartial('application.views.layouts.header',array('backend_asset'=>$backend_asset)); 
?>

<script src="<?php echo Yii::app()->baseUrl.'/common/extensions/ckeditor/ckeditor.js'; ?>"></script>

<!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
 
</head>
<body>
<div class="header"> <a class="logo" href="<?php echo FRONT_SITE_URL; ?>"><img src="<?php echo $backend_asset; ?>/images/logo_small.png" alt="Patient Management System" title="Patient Management System" /></a>
  <ul class="header_menu">
    <li class="list_icon"><a href="#">&nbsp;</a></li>
  </ul>
</div>
<div class="menu">
  <div class="breadLine">
    <div class="arrow"></div>
    <div class="adminControl active"> <?php echo t('Welcome'); ?>, <?php echo user()->getModel('display_name'); ?> </div>
  </div>
  <div class="admin">
    <div class="image"> <img src="<?php echo $backend_asset; ?>/images/users/user.png" class="img-polaroid"/> </div>
    <ul class="control">
      
      
      <li><span class="icon-share-alt"></span> <a href="<?php echo Yii::app()->request->baseUrl; ?>/besite/logout">Logout</a></li>
    </ul>
    
  </div>
  <?php
			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'htmlOptions'=>array('class'=>'navigation'),
			'activeCssClass'=>'active',
			'items'=>array(
					array('label'=>'<span class="isw-grid"></span><span class="text">'.t('Dashboard').'</span>', 'url'=>array('/besite/index') ,
                    'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),    
						
						
						
						array('label'=>'<span class="isw-user"></span><span class="text">'.t('Discharge Summaries').'</span>', 'url'=>'#', 'itemOptions'=>array('class'=>'openable'), 
					    'items'=>array(
						array('label'=>'<span class="icon-th-large"></span><span class="text">'.t('All Summaries').'</span>', 'url'=>array('/bepatient/admin'),
						
						
					     'active'=> ((Yii::app()->controller->id=='patient') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false)
						
					    )),                     
					
						
												
						
						array('label'=>'<span class="isw-user"></span><span class="text">'.t('Dept & Doctors').'</span>', 'url'=>'#', 'itemOptions'=>array('class'=>'openable'), 
					    'items'=>array(
						
						array('label'=>'<span class="icon-th-large"></span><span class="text">'.t('Departments').'</span>', 'url'=>array('/bedept/admin')),
						array('label'=>'<span class="icon-th-large"></span><span class="text">'.t('Doctors').'</span>', 'url'=>array('/bedoctor/admin'),
					     'active'=> ((Yii::app()->controller->id=='resource') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false)
						
					    )),
					
						
						
						
						
					array('label'=>'<span class="isw-list"></span><span class="text">'.t('User').'</span>', 'url'=>'#', 'itemOptions'=>array('class'=>'openable'), 
					       'items'=>array(
						array('label'=>'<span class="icon-th-large"></span><span class="text">'.t('Create User').'</span>', 'url'=>array('/beuser/create')),
						array('label'=>'<span class="icon-th-large"></span><span class="text">'.t('Manage Users').'</span>', 'url'=>array('/beuser/admin'),
						
						      'active'=> ((Yii::app()->controller->id=='beuser') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false
						      ),
						array('label'=>'<span class="icon-th-large"></span><span class="text">'.t('Permission').'</span>', 'url'=>array('/rights/assignment'),'active'=>in_array(Yii::app()->controller->id,array('assignment','authItem')) ?true:false),
					    ),
                         'visible'=>user()->isAdmin ? true : false,   
					    ),
                        
										
										array('label'=>'<span class="isw-grid"></span><span class="text">'.t('Caching').'</span>', 'url'=>array('/becaching/clear') ,
                                   'active'=> ((Yii::app()->controller->id=='becaching') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),  
				),
				
			)); ?>
</div>
<div class="content">
  
  <div class="workplace">
    <div class="row-fluid">
      <div class="span12">
        <div class="page-header">
          <?php if(isset($this->menu)) :?>
          <?php if(count($this->menu) >0 ): ?>
          <div class="header-info">
            <?php
                                       
                                        $this->widget('zii.widgets.CMenu', array(
                                                'items'=>$this->menu,
                                                'htmlOptions'=>array(),
                                        ));
                                       
                                ?>
          </div>
          <?php endif; ?>
          <?php endif; ?>
          <!--
          <h1><?php echo (isset($this->titleImage)&&($this->titleImage!=''))? '<img src="'.$backend_asset.'/'.$this->titleImage.'" />' : ''; ?><?php echo isset($this->pageTitle)? $this->pageTitle : '';  ?> <small>
            <?php if (isset($this->pageHint)&&($this->pageHint!='')) : ?>
            <?php echo "<br/>".$this->pageHint; ?>
            <?php endif; ?>
            </small></h1> --> 
        </div>
      </div>
    </div>
    <?php echo $content; ?> </div>
</div>
</div>

<!-- page -->

</body>
</html>