<?php 
	$this->pageTitle=t('Manage Cabin of Floor');
	$this->pageHint=t('Here you can manage all Cabin for the Floor'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Cabin')); ?>