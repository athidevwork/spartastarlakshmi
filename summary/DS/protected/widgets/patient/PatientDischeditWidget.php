<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class PatientDischeditWidget extends CWidget
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
       
	   //$model =  GxcHelpers::loadDetailModel('Patient', $id);
	   
	   
	   
	   $model1 =  GxcHelpers::loadDetailModel('Discharge', $id);
	   
	   $model = Patient::model()->find(array(
	   			'condition'=>'id = :PID',
				'params' => array(':PID'=>$model1->pid)
	   )); 
	   
	  
			
        if(isset($_POST['ajax']) && $_POST['ajax']==='discharge-form')
        {
                echo CActiveForm::validate($model1);
                Yii::app()->end();
        }
        
        // collect user input data
        if(isset($_POST['Save']))
        {
                $model1->attributes=$_POST['Discharge'];  
				$current_time=time();
                $model1->created = $current_time;	
				$model1->crby = user()->getId();
						  
                if($model1->save()){           
                   
                    user()->setFlash('success',t("The Patient's Discharge Summary Has been Updated!"));                               
                   
                    Yii::app()->controller->redirect(array('dprint','id'=>$model1->id));
                } 
        }  
		              
        $this->render('cmswidgets.views.patient.dischedit_form_widget',array('model1'=>$model1));            
    }   
}
