<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class PatientDischWidget extends CWidget
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
	   
	   $admitid = Admit::model()->find(array(
	   		'condition'=>'patient_id = :PID AND adate >= 0 AND ddate = 0',
			'params'=>array(':PID'=> $model->patient_id),
	   ));
	   
	   $dis_id = Discharge::model()->find(array(
	   		'condition'=>'patient_id = :PID AND admit_id = :AID',
			'params'=>array(':PID'=> $admitid->patient_id, ':AID'=> $admitid->admit_id),
	   ));
	   
	   if($dis_id) { $model1 =  GxcHelpers::loadDetailModel('Discharge', $dis_id->id); }
	   
	   else
	   
	   { $model1 = new Discharge; }
			
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
				$model1->uid = uniqid();		  
                if($model1->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Patient's Discharge Summary Has been Generated!"));   
					                                  
                    $model=new Patient;
                    Yii::app()->controller->redirect(array('view','id'=>$id));
                } 
        }  
		
		if(isset($_POST['Print']))
        {
                $model1->attributes=$_POST['Discharge'];  
				$current_time=time();
                $model1->created = $current_time;	
				$model1->crby = user()->getId();
				$model1->uid = uniqid();		  
                if($model1->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Patient's Discharge Summary Has been Generated and Discharged!"));   
					
					$AdmitInfo = Admit::GetPatient($model1->patient_id);                 
					
					Admit::model()->updateByPk($AdmitInfo->id, array('ddate'=>time()));
					$aupdate = Patient::model()->find(array(
						'condition'=>'patient_id = :PID',
						'params'=>array(':PID'=>$model1->patient_id)));
					$aupdate->astatus = 0;
					$aupdate->save();
					                                  
                    $model=new Patient;
                    Yii::app()->controller->redirect(array('view','id'=>$id));
                } 
        } 
		
		$model1->patient_id = $model->patient_id ;
		              
        $this->render('cmswidgets.views.patient.disch_form_widget',array('model1'=>$model1));            
    }   
}
