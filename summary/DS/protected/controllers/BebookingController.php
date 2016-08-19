<?php
/**
 * Backend Object Controller.
 * 
 
 * @package backend.controllers
 *
 */
class BebookingController extends BeController
{
        public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 
		 
	}
        
        /**
	 * The function that do Create new Object
	 * 
	 */
	public function actionAvailability()
	{            
		$this->render('booking_availability');
	}
	
	public function actionLoadprovince()
	{  
	if(isset($_POST['region_id'])) {
		
		$data = Cabin::model()->findAll(array(
    			'select'=>'t.name, t.id',
				'condition'=>'source = '.(int) $_POST['region_id'],
    			'group'=>'t.name',
   				'distinct'=>true,
				)); 		
			$data = CHtml::listData($data,'id','name');
            $dropDownCities = "<option value=''>Select Room</option>"; 
			$dropDownDistricts = "<option value=''>Select Bed</option>"; 
            foreach($data as $value=>$name) {
				
				//if( Admit::CheckAvail( $value ) == '' )				
                $dropDownCities .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			}
           
 
            // return data (JSON formatted)
            echo CJSON::encode(array(
              'dropDownCities'=>$dropDownCities,
			  'dropDownDistricts'=>$dropDownDistricts
            ));           
	}
		
	}
	
	public function actionLoadsummary()
	{  
	if(isset($_POST['region_id'])) {
		
		$data = Dsummary::model()->findByPk((int) $_POST['region_id']);
		 		
                
 
            // return data (JSON formatted)
            echo CJSON::encode(array(
              'diagnosis'=>$data->diagnosis,
			  'operation'=>$data->operation,
			  'history'=>$data->history,
			  'past_history'=>$data->past_history,
			  'personal_history'=>$data->personal_history,
			  'family_history'=>$data->family_history,
			  'on_examination'=>$data->on_examination,
			  'investigation'=>$data->investigation,
			  'operation_notes'=>$data->operation_notes,
			  'treatment_given'=>$data->treatment_given,
			  'condition_at_discharge'=>$data->condition_at_discharge,
			  'advice_on_discharge'=>$data->advice_on_discharge,
			  'other_consultant'=>$data->other_consultant,
			  'next_visit'=>$data->next_visit,
			  'medical_officer'=>$data->medical_officer,
			  'consultant'=>$data->consultant,
			  'ref_by'=>$data->ref_by,
            ));           
	}
		
	}
	
	public function actionLoadtown()
	{  
	if(isset($_POST['province_id'])) {
       
		$data = Bed::model()->findAll(array(
    			'select'=>'t.name, t.id',
				'condition'=>'source = '.(int) $_POST['province_id'],
    			'group'=>'t.name',
   				'distinct'=>true,
				));            
               
            $data = CHtml::listData($data,'id','name');
            echo "<option value=''>Select Beds</option>"; 
            foreach($data as $value=>$name) {
				
				if( Admit::CheckAvail( $value ) == '' )				
                //$dropDownDistricts .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			}
	}
		
	}
	
	public function actionLoaddoctor()
	{  
	if(isset($_POST['region_id'])) {
       
		$data = Doctor::model()->findAll(array(
    			'select'=>'t.name, t.id',
				'condition'=>'category = '.(int) $_POST['region_id'],
    			'group'=>'t.name',
   				'distinct'=>true,
				));            
               
            $data = CHtml::listData($data,'id','name');
            echo "<option value=''>Select Consultant</option>"; 
            foreach($data as $value=>$name) {
				
				//if( Admit::CheckAvail( $value ) == '' )				
                //$dropDownDistricts .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			}
	}
		
	}
	
	
	

	
          
        
}