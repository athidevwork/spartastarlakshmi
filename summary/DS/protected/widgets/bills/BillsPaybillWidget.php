<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class BillsPaybillWidget extends CWidget
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
		
        $model1 = new Payment;                    
        

        // if it is ajax validation request
        $this->performAjaxValidation(array($model1));
        
		
        
		// collect user input data
        if(isset($_POST['Payment']))
        {
                $model1->attributes=$_POST['Payment'];  
								
				$current_time=time();
				$model1->created = $current_time; 
				$valid=$model1->validate();
				 
				  
				   if($valid)
        			{
                		if($model1->save()){     
					
					    
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Bill Information has been Saved Successfully!'));                                                            
                    $model1=new Payment;
					
                    Yii::app()->controller->redirect(array('bepatient/view','id'=>$id));
                } }
        }  
		$model1->patient_id = $model->patient_id ;
		$model1->admit_id = Admit::GetAdmitId($model->patient_id);
		             
        $this->render('cmswidgets.views.bills.paybill_form_widget',array('model1'=>$model1));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='paybill-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
