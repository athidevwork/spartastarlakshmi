<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class CategoryCreateWidget extends CWidget
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
        $model = new Category; 

        // if it is ajax validation request
        $this->performAjaxValidation(array($model));
        
        // collect user input data
        if(isset($_POST['Category']))
        {
                $model->attributes=$_POST['Category'];  
							
								
				$current_time=time();
				$model->created = $current_time;
				
                $model->modified = $current_time;
				$model->crby = user()->getId();
				//$mseo->crby = $model->crby = Yii::app()->user->user_id;
				                    
				  $model->uid = uniqid();
				  $model->uid;
				  
				  $valid=$model->validate();
				  				  
				   if($valid)
        			{
                		if($model->save()){           
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('People Category Added Successfully!'));                                                            
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
