<?php
/**
 * Backend Object Controller.
 * 
 
 * @package backend.controllers
 *
 */
class BeBillsController extends BeController
{
        public function __construct($id,$module=null)
	{
		 
		 parent::__construct($id,$module);
		 $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
                 $this->menu=array(
                        
                        array('label'=>t('Back to Patient Info'), 'url'=>array('bepatient/view','id'=>$id),'linkOptions'=>array('class'=>'btn btn-mini')),
						array('label'=>t('List Bills'), 'url'=>array('admin','id'=>$id),'linkOptions'=>array('class'=>'btn btn-mini')),
                );
		 
	}
        
        /**
	 * The function that do Create new Object
	 * 
	 */
	public function actionCreate()
	{                
		$this->render('bills_create');
	}

        
         /**
         * The function that do Update Object
         * 
         */
	public function actionUpdate()
	{            
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
          
              
              $this->render('bills_update');
	}
	
	public function actionPaybill()
	{            
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
              $this->render('bills_paybill');
	}
	
	
        
         /**
	 * The function that do View User
	 * 
	 */
	public function actionView()
	{         
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
			  
		$this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('Add Bills'), 'url'=>array('bebills/addbill','id'=>$id),'linkOptions'=>array('class'=>'btn btn-mini'))
					
						
                            
                        )
                    );
          
		$this->render('patient_view');
	}
        /**
	 * The function that do Manage Object
	 * 
	 */
	public function actionAdmin()
	{                
		$this->render('bills_admin');
	}
        
    
	public function actionDelete($id)
	{                            
            GxcHelpers::deleteModel('Bills', $id);
	}
          
        
}