<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class DsummaryUpdateWidget extends CWidget
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
       $model1 =  GxcHelpers::loadDetailModel('Dsummary', $id);
			
        if(isset($_POST['ajax']) && $_POST['ajax']==='dsummary-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        
        // collect user input data
        if(isset($_POST['Dsummary']))
        {
                $model1->attributes=$_POST['Dsummary'];  
				$current_time=time();
                $model1->modified = $current_time;	
				
                if($model1->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Discharge Summary has been updated Successfully!"));                                                            
                    $model1=new Dsummary;
                    Yii::app()->controller->redirect(array('admin'));
                } 
        }  
		              
        $this->render('cmswidgets.views.dsummary.dsummary_form_widget',array('model1'=>$model1));            
    }   
}
