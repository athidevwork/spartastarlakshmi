<?php 
	$this->pageTitle=t('Manage Unit Information');
	$this->pageHint=t('Here you can manage all Unit for the Hospital'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Unit')); ?>