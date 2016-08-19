<?php
if(YII_DEBUG)
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, true);
        else
            $backend_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('cms.assets.backend'), false, -1, false);
?>
<?php $this->pageTitle=SITE_NAME; ?>

<p><?php echo t('Make your Apps your own idea'); ?></p>

<!-- 
<div class="row-fluid">
  <div class="span12">
    <div class="widgetButtons">
      <div class="bb"><a href="#"><span class="ibw-edit"></span></a></div>
      <div class="bb"> <a href="#"><span class="ibw-folder"></span></a>
        <div class="caption red">31</div>
      </div>
      <div class="bb"><a href="#"><span class="ibw-plus"></span></a></div>
      <div class="bb"><a href="#"><span class="ibw-favorite"></span></a></div>
      <div class="bb"> <a href="#"><span class="ibw-mail"></span></a>
        <div class="caption green">31</div>
      </div>
      <div class="bb"><a href="#"><span class="ibw-settings"></span></a></div>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="span4">
    <div class="wBlock red">
      <div class="dSpace">
        <h3>booking statistics</h3>
        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--130,190,260,230,290,400,340,360,390--> <!-- </span> <span class="number">60%</span> </div>
      <div class="rSpace"> <span>$1,530 <b>amount paid</b></span> <span>$2,102 <b>in queue</b></span> <span>$11,100 <b>total</b></span> </div>
    </div>
  </div>
  <div class="span4">
    <div class="wBlock green">
      <div class="dSpace">
        <h3>Properties</h3>
        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--> <!-- </span> <span class="number">2,513</span> </div>
      <div class="rSpace"> <span>351 <b>active</b></span> <span>2102 <b>De-Active</b></span> <span>100 <b>removed</b></span> </div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="span4">
    <div class="wBlock blue">
      <div class="dSpace">
        <h3>Last visits</h3>
        <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--240,234,150,290,310,240,210,400,320,198,250,222,111,240,221,340,250,190--> <!--</span> <span class="number">6,302</span> </div>
      <div class="rSpace"> <span>65% <b>New</b></span> <span>35% <b>Returning</b></span> <span>00:05:12 <b>Average time on site</b></span> </div>
    </div>
  </div>
</div>
-->