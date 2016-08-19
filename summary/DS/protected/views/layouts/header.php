<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />


    <?php
	
	$cs=Yii::app()->clientScript;
    $cssCoreUrl = $cs->getCoreScriptUrl();
    $cs->registerCoreScript('jquery');
    $cs->registerCoreScript('jquery.ui');
	
	$cs->registerCssFile($backend_asset.'/css/stylesheets.css');
    //$cs->registerCssFile($backend_asset.'/css/stylesheet.css');
    $cs->registerCssFile($backend_asset.'/css/icons.css');
    $cs->registerCssFile($backend_asset.'/css/bootstrap.css');
    $cs->registerCssFile($backend_asset.'/css/bootstrap-responsive.css');
    $cs->registerCssFile($backend_asset.'/css/fullcalendar.css');
    $cs->registerCssFile($backend_asset.'/css/ui.css');
    $cs->registerCssFile($backend_asset.'/css/select2.css');
    $cs->registerCssFile($backend_asset.'/css/uniform.default.css');
    $cs->registerCssFile($backend_asset.'/css/validation.css');
    $cs->registerCssFile($backend_asset.'/css/mCustomScrollbar.css');
    $cs->registerCssFile($backend_asset.'/css/cleditor.css');
    $cs->registerCssFile($backend_asset.'/css/fancybox/jquery.fancybox.css');
    $cs->registerCssFile($backend_asset.'/css/login.css');
    //$cs->registerCssFile($backend_asset.'/css/fullcalendar.print.css');
    
    $cs->registerScriptFile($backend_asset.'/js/plugins/jquery/jquery.mousewheel.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/cookie/jquery.cookies.2.2.0.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/bootstrap.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/charts/excanvas.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/charts/jquery.flot.js', CClientScript::POS_HEAD);    
    $cs->registerScriptFile($backend_asset.'/js/plugins/charts/jquery.flot.stack.js', CClientScript::POS_HEAD);    
    $cs->registerScriptFile($backend_asset.'/js/plugins/charts/jquery.flot.pie.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/charts/jquery.flot.resize.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/sparklines/jquery.sparkline.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/fullcalendar/fullcalendar.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/select2/select2.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/uniform/uniform.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/maskedinput/jquery.maskedinput-1.3.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/validation/languages/jquery.validationEngine-en.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/validation/jquery.validationEngine.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/animatedprogressbar/animated_progressbar.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/qtip/jquery.qtip-1.0.0-rc3.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($backend_asset.'/js/plugins/cleditor/jquery.cleditor.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/actions.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/charts.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/cookies.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/plugins.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/plugins/fancybox/jquery.fancybox.pack.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/plugins/dataTables/jquery.dataTables.min.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/plugins/cleditor/jquery.cleditor.js', CClientScript::POS_HEAD);
	$cs->registerScriptFile($backend_asset.'/js/backend.js', CClientScript::POS_HEAD);
    ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
