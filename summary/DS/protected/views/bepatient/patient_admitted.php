<?php 
$this->pageTitle=t("Manage Admitted Patients");
$this->pageHint=t('Here you can manage all Info for this Patient'); 

?>


<?php $this->widget('cmswidgets.ModelaManageWidget',array('model_name'=>'Patient')); ?>