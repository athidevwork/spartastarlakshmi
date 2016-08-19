<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class PatientCreateWidget extends CWidget
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
        $model = new Patient;

        // if it is ajax validation request
        $this->performAjaxValidation(array($model));	
        
		// collect user input data
        if(isset($_POST['Save']))
        {
                $model->attributes = $_POST['Patient'];  
								
				$current_time = time();
				$model->created = $current_time;  
				$model->crby = user()->getId();
				
				//$model->disdate = strtotime($model->disdate);
				//$model->dob = strtotime($model->dob);
				//$model->cdate = strtotime($model->cdate);        
				 
				  
				$model->uid = uniqid();
				$valid = $model->validate();
				 
				  
				   if($valid)
        			{
                		if($model->save()){     
					
                    	user()->setFlash('success',t('Patient Information has been Saved Successfully!'));                                                            
                   		//$model=new Patient;
						Yii::app()->controller->redirect(array('discharge','id'=>$model->primaryKey));
                } 
				
				}
				
				//$model->disdate = date('d-M-Y', $model->disdate);
				//$model->cdate   = date('d-M-Y', $model->cdate);
				//$model->dob     = date('d-M-Y', $model->dob);
				
				
        }  
		
		           
        $this->render('cmswidgets.views.patient.patient_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='patient-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
