<?php 
	$this->pageTitle=t('Manage Beds of Cabin');
	$this->pageHint=t('Here you can manage all Beds for the Cabin'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Bed')); ?>