<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class DoctorUpdateWidget extends CWidget
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
       $model =  GxcHelpers::loadDetailModel('Doctor', $id);
			
        if(isset($_POST['ajax']) && $_POST['ajax']==='doctor-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        
        // collect user input data
        if(isset($_POST['Doctor']))
        {
                $model->attributes=$_POST['Doctor'];  
				$current_time=time();
                $model->modified = $current_time;				  
                if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Doctor's information has been updated Successfully!"));                                                            
                    $model=new Doctor;
                    Yii::app()->controller->redirect(array('admin'));
                } 
        }                
        $this->render('cmswidgets.views.doctor.doctor_form_widget',array('model'=>$model));            
    }   
}
