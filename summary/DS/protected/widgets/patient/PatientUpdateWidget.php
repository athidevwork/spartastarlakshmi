<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class PatientUpdateWidget extends CWidget
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
       $model =  GxcHelpers::loadDetailModel('Patient', $id);
			
        if(isset($_POST['ajax']) && $_POST['ajax']==='patient-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        
        // collect user input data
        if(isset($_POST['Patient']))
        {
                $model->attributes=$_POST['Patient'];  
				$current_time=time();
                $model->modified = $current_time;	
				
				$model->disdate = strtotime($model->disdate);
				
				$model->dob = strtotime($model->dob);	
$model->cdate = strtotime($model->cdate);	  
                if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Patient's information has been updated Successfully!"));                                                            
                    $model=new Patient;
                    Yii::app()->controller->redirect(array('admin'));
                } 
        }  
		
		
		
		$model->disdate = ($model->disdate!=0) ? date('d-m-Y',$model->disdate) : '';
		$model->dob = ($model->dob!=0) ? date('d-m-Y',$model->dob) : '';
		$model->cdate = ($model->cdate!=0) ? date('d-m-Y',$model->cdate) : '';
		              
        $this->render('cmswidgets.views.patient.patient_form_widget',array('model'=>$model));            
    }   
}
