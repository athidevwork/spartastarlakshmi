<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class PatientDischargeWidget extends CWidget
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
	   
	   $model1 = new Discharge; 
			
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
				
				//if (is_array($_POST['diagnosis'])) {
						//$model1->diagnosis = implode("|",$_POST['diagnosis']);
				//} 
				
				//if (is_array($_POST['other_consultant'])) {
						//$model1->other_consultant = implode("|",$_POST['other_consultant']);
				//} 
				
                if($model1->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Patient's Discharge Summary Has been Generated!"));   
					                                  
                    //$model=new Patient;
                    Yii::app()->controller->redirect(array('dprint','id'=>$model1->primaryKey));
                } 
        }  
		
		$model1->pid = $id;
		            
        $this->render('cmswidgets.views.patient.discharge_form_widget',array('model1'=>$model1));            
    }   
}
