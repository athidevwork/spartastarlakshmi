<?php

/**
 * This is the Widget for Creating new Page 
 * 
 
 * @package  cmswidgets.page
 *
 */
class DsummaryCreateWidget extends CWidget
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
        $model = new Dsummary;
		//$mseo = new Seo;
		//$mseo1 = new Pageseo;
                        
        

        // if it is ajax validation request
        $this->performAjaxValidation(array($model));
        
		
        
		// collect user input data
        if(isset($_POST['Dsummary']))
        {
                $model->attributes=$_POST['Dsummary'];  
								
				$current_time=time();
				$model->created = $current_time;  
				$model->crby = user()->getId();
				 $model1->prodate = strtotime($model1->prodate);  
				
				$valid = $model->validate();
				 
				  
				   if($valid)
        			{
                		if($model1->save()){     
					
					    
                    
                    //Start to save the Page Block
                    user()->setFlash('success',t('Discharge Summary has been Saved Successfully!'));                                                            
                    $model1=new Dsummary;
					Yii::app()->controller->redirect(array('admin'));
						}}
					$model1->prodate= date('d-M-Y', $model1->prodate);
                
        }   
			             
        $this->render('cmswidgets.views.dsummary.dsummary_form_widget',array('model1'=>$model));            
    }   
	
	protected function performAjaxValidation($models)
	{
    	if(isset($_POST['ajax']) && $_POST['ajax']==='dsummary-form')
        {
                echo CActiveForm::validate($models);
                Yii::app()->end();
        }
	}
}
