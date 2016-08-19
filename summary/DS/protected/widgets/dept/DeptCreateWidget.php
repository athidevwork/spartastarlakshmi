<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class DeptCreateWidget extends CWidget
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
        $model = new Dept;
                        
        // if it is ajax validation request
        $this->performAjaxValidation($model);
        
        // collect user input data
        if(isset($_POST['Dept']))
        {
                $model->attributes=$_POST['Dept'];  
								
				$current_time=time();
				$model->created = $current_time;
				$model->crby = user()->getId();
				//$mseo->crby = $model->crby = user()->getModel('display_name');
				                    
				  $model->uid = uniqid();
				  
				  $valid=$model->validate();
				  
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Department Added Successfully!'));                                                            
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
