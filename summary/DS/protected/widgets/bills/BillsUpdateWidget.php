<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class BillsUpdateWidget extends CWidget
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
       $model1 =  GxcHelpers::loadDetailModel('Bills', $id);
			
        if(isset($_POST['ajax']) && $_POST['ajax']==='bills-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        
        // collect user input data
        if(isset($_POST['Bills']))
        {
                $model->attributes=$_POST['Bills'];  
				$current_time=time();
                $model->modified = $current_time;			  
                if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t("The Bill's information has been updated Successfully!"));                                                            
                    $model=new Bills;
                    Yii::app()->controller->redirect(array('admin'));
                } 
        }  
		              
        $this->render('cmswidgets.views.bills.bills_form_widget',array('model1'=>$model1));            
    }   
}
