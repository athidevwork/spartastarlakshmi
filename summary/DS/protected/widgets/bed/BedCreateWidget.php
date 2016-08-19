<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class BedCreateWidget extends CWidget
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
        $model = new Bed;
                        
        // if it is ajax validation request
        $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Bed']))
        {
                $model->attributes=$_POST['Bed'];  
								
				$current_time=time();
				$model->created = $current_time;
				$model->crby = user()->getId();
				                    
				  $model->uid = uniqid();
				  
				  $valid=$model->validate();
				  
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Bed Added into Floor Successfully!'));                                                            
                    $model=new Bed;
                    Yii::app()->controller->redirect(array('admin'));
                } }
        }                
        $this->render('cmswidgets.views.bed.bed_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='bed-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
