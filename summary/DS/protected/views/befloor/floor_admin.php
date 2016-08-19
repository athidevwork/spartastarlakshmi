<?php 
	$this->pageTitle=t('Manage Floor Information');
	$this->pageHint=t('Here you can manage all Floor for the Unit'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Floor')); ?>