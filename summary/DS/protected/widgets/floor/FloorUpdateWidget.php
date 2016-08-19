<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class FloorUpdateWidget extends CWidget
{
    
    public $visible=true; 
 
    public function init()
    {
        
    }
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    { 
        
       $id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
       $model =  GxcHelpers::loadDetailModel('Floor', $id);
		
            $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Floor']))
        {
                $model->attributes=$_POST['Floor'];  
								
				$current_time=time();
                $model->modified = $current_time;
				//$mseo->crby = $model->crby = user()->getModel('display_name');
				                    
				  $model->uid = uniqid();
				  
				  $valid=$model->validate();
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Floor information has been updated Successfully!'));                                                            
                    $model=new Floor;
                    Yii::app()->controller->redirect(array('admin'));
                } }
        }                
        $this->render('cmswidgets.views.floor.floor_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='floor-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
