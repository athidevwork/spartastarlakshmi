<?php 
$this->pageTitle=t("Manage Patient's Information");
$this->pageHint=t('Here you can manage all Info for this Patient'); 

?>


<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Patient')); ?>