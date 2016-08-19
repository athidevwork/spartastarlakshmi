<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class PatientAdmitWidget extends CWidget
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
	   $model1 = new Admit;
			
        if(isset($_POST['ajax']) && $_POST['ajax']==='admit-form')
        {
                echo CActiveForm::validate($model1);
                Yii::app()->end();
        }
        
        // collect user input data
        if(isset($_POST['Save']))
        {
                $model1->attributes=$_POST['Admit'];  
				$current_time=time();
                $model1->created = $current_time;
				$model->crby = user()->getId();
				$model1->adate = strtotime($model1->adate);	
				$model1->uid = uniqid();		  
                if($model1->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Patient's information has been updated Successfully!"));                    
					$aupdate = Patient::model()->find(array(
						'condition'=>'patient_id = :PID',
						'params'=>array(':PID'=>$model1->patient_id)));
					$aupdate->astatus = 1;
					$aupdate->save();
					                                        
                    $model=new Patient;
                    Yii::app()->controller->redirect(array('admin'));
                } 
        }  
		
		 if(isset($_POST['Print']))
        {
                $model1->attributes=$_POST['Admit'];  
				$current_time=time();
                $model1->created = $current_time;
				$model->crby = user()->getId();
				$model1->adate = strtotime($model1->adate);	
				$model1->uid = uniqid();		  
                if($model1->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Patient's information has been updated Successfully!"));                    
					$aupdate = Patient::model()->find(array(
						'condition'=>'patient_id = :PID',
						'params'=>array(':PID'=>$model1->patient_id)));
					$aupdate->astatus = 1;
					$aupdate->save();
					                                        
                    Yii::app()->controller->redirect(array('aprint','id'=>$model1->primaryKey));
                } 
        }  
		
		$model1->patient_id = $model->patient_id ;
		$model1->admit_id = IP_PREFIX.(Yii::app()->db->createCommand()->select('max(id) as max')->from('tbl_admit')->queryScalar()+1);
		$model1->adate = date('d-m-Y H:i:s',time());
		              
        $this->render('cmswidgets.views.patient.admit_form_widget',array('model1'=>$model1));            
    }   
}
