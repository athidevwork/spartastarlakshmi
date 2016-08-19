<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class StypeUpdateWidget extends CWidget
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
       $model =  GxcHelpers::loadDetailModel('Stype', $id);
		
            $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Stype']))
        {
                $model->attributes=$_POST['Stype'];  
								
				$current_time=time();
                $model->modified = $current_time;
				  
				  $valid=$model->validate();
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Discharge Summary Type has been updated Successfully!'));                                                            
                    $model=new Stype;
                    Yii::app()->controller->redirect(array('admin'));
                } }
        }                
        $this->render('cmswidgets.views.stype.stype_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='stype-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
