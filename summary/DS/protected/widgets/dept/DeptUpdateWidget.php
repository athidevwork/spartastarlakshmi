<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class DeptUpdateWidget extends CWidget
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
       $model =  GxcHelpers::loadDetailModel('Dept', $id);
		
            $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Dept']))
        {
                $model->attributes=$_POST['Dept'];  
								
				$current_time=time();
                $model->modified = $current_time;
				//$mseo->crby = $model->crby = user()->getModel('display_name');
				                    
				  $model->uid = uniqid();
				  
				  $valid=$model->validate();
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Department information has been updated Successfully!'));                                                            
                    $model=new Dept;
                    Yii::app()->controller->redirect(array('admin'));
                } }
        }                
        $this->render('cmswidgets.views.dept.dept_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='dept-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
