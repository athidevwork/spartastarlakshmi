<?php 
$this->pageTitle=t("Manage Patient's Bills");
$this->pageHint=t('Here you can manage all Info About bills'); 

?>


<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Bills')); ?>