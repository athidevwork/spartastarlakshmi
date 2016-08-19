<?php

/**
 * This is the Widget for update the Content.
 * 
 
 * @package  cmswidgets.object
 *
 */
class CategoryUpdateWidget extends CWidget
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
       $model =  GxcHelpers::loadDetailModel('Category', $id);
	   
       $this->performAjaxValidation(array($model));
        
        // collect user input data
        if(isset($_POST['Category']))
        {
                $model->attributes=$_POST['Category'];  
				
				$current_time=time();
				$model->created = $current_time;
				
                $model->modified = $current_time;
				
				                    
				  $model->uid = uniqid();
				  
				  
				  $valid=$model->validate();
				  
       			   
				  
				   if($valid)
        			{
                		if($model->save() ){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('People Category has been updated Successfully!'));                                                            
                    $model=new Category;
                    Yii::app()->controller->redirect(array('admin'));
                } }
        }                
        $this->render('cmswidgets.views.category.category_form_widget',array('model'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
