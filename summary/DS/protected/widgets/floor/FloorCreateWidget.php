<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class FloorCreateWidget extends CWidget
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
        $model = new Floor;
                        
        // if it is ajax validation request
        $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Floor']))
        {
                $model->attributes=$_POST['Floor'];  
								
				$current_time=time();
				$model->created = $current_time;
				$model->crby = user()->getId();
				                    
				  $model->uid = uniqid();
				  
				  $valid=$model->validate();
				  
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Floor Added Successfully!'));                                                            
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
