<?php
/**
 * Backend Caching Controller.
 * 
 
 * @package backend.controllers
 *
 */
class BecachingController extends BeController{
    
       
    public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
             $this->menu=array(
                  
            );
		 
	}
                 
     /**
	 * The function that do clear Cache 
	 * 
	 */
	public function actionClear()
	{                
		$this->render('clear_cache');
	}
        
       
       
}