<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class DoctorCreateWidget extends CWidget
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
        $model = new Doctor;
		//$mseo = new Seo;
		//$mseo1 = new Pageseo;
                        
        

        // if it is ajax validation request
        $this->performAjaxValidation(array($model));
        
        // collect user input data
        if(isset($_POST['Doctor']))
        {
                $model->attributes=$_POST['Doctor'];  
								
				$current_time=time();
				$model->created = $current_time;
				$model->crby = user()->getId();
                             
				$model->uid = uniqid();
				  
				$valid=$model->validate();
				 
				  
				   if($valid)
        			{
                		if($model->save()){     
					
					    
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Doctor Added Successfully!'));                                                            
                    $model=new Doctor;
					
                    //Yii::app()->controller->redirect(array('admin'));
                } }
        }   
		             
        $this->render('cmswidgets.views.doctor.doctor_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='doctor-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
