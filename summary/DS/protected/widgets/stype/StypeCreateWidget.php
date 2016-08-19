<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class StypeCreateWidget extends CWidget
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
        $model = new Stype;
                        
        // if it is ajax validation request
        $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Stype']))
        {
                $model->attributes=$_POST['Stype'];  
								
				$current_time=time();
				$model->created = $current_time;
				$model->crby = user()->getId();
				
				  
				  $valid=$model->validate();
				  
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Discharge summary type Added Successfully!'));                                                            
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
