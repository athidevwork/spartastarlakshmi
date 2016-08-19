<?php 
$this->pageTitle=t("Manage Patient's Discharge Summary");
$this->pageHint=t('Here you can manage all Info for this Patient'); 

?>


<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Discharge')); ?>