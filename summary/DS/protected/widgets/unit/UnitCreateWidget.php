<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class UnitCreateWidget extends CWidget
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
        $model = new Unit;
                        
        // if it is ajax validation request
        $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Unit']))
        {
                $model->attributes=$_POST['Unit'];  
								
				$current_time=time();
				$model->created = $current_time;
				//$mseo->crby = $model->crby = user()->getModel('display_name');
				                    
				  $model->uid = uniqid();
				  
				  $valid=$model->validate();
				  
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Unit Added Successfully!'));                                                            
                    $model=new Unit;
                    Yii::app()->controller->redirect(array('admin'));
                } }
        }                
        $this->render('cmswidgets.views.unit.unit_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='unit-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
