<?php

/**
 * This is the Widget for manage a specific Model.
 * 
 
 * @package cmswidgets
 *
 */
class ModelaManageWidget extends CWidget
{
    
    public $visible=true; 
    public $model_name=''; 
 
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
        $model_name=$this->model_name;
        if($model_name!=''){
            
            $model=new $model_name('asearch');            
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET[$model_name]))
                    $model->attributes=$_GET[$model_name];                       
            		$this->render(strtolower($model_name).'/'.strtolower($model_name).'_amanage_widget',array('model'=>$model));
        } else {
            throw new CHttpException(404,t('The requested page does not exist.'));
        }
    }   
}