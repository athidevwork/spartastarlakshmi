<?php 
$this->pageTitle=t("Manage Doctor's Information");
$this->pageHint=t('Here you can manage all Info for this Doctors'); 

?>


<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Doctor')); ?>