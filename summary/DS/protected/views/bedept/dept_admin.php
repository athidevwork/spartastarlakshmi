<?php 
	$this->pageTitle=t('Manage Department Information');
	$this->pageHint=t('Here you can manage all Departments'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Dept')); ?>