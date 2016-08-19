<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property string $page_id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $parent
 * @property string $layout
 * @property string $slug
 * @property integer $lang
 */
class Admit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{admit}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('patient_id, admit_id,uid, floor, dept, consultant', 'required'),
			array('bed, floor, room, crby, dept, consultant', 'numerical', 'integerOnly'=>true),
			array('content, adate, ddate, reference','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, patient_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		 return array(                    
                    'language' => array(self::BELONGS_TO, 'Language', 'lang'),
                ); 
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => t('ID'),
			'patient_id' => t('Patient ID'),
			'admit_id' => t('Admission ID'),
			'bed' => t('Bed'),
			'room' => t('Room'),
			'Floor' => t('Floor'),
			'adate' => t('Admit Date'),
			'ddate' => t('Discharge Date'),
			'dept' => t('Department'),
			'consultant' => t('Consultant'),
			'reference' => t('Ref By'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('patient_id',$this->patient_id,true);
		$criteria->compare('admit_id',$this->admit_id,true);
		
                
                $sort = new CSort;
                $sort->attributes = array(
                        'id',
                );
                $sort->defaultOrder = 'id DESC';
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort
		));
	}
        
   
        
        
        public static function getPageName($id){
            if($id){
                $page=Pinfo::model()->findByPk($id);
                if($page){
                    return CHtml::encode($page->name);
                } else{
                    return '';
                }
            } else {
                return '';
            }
        }
		
		public static function GetUID($id){
            if($id){
                $page=self::model()->findByPk($id);
                if($page){
                    return $page->uid;
                } else{
                    return '';
                }
            } else {
                return '';
            }
        }
		
		public static function GetPage(){
            $pages=self::model()->with('language')->findAll();                        
            $data=array(0=>t("None"));
            if($pages && count($pages) > 0 ){
               foreach($pages as $t){
                    $data[$t->prop_id]=$t->name.' - '.$t->language->lang_desc ;
                }
            }
            
            return $data;
        }
		
		public static function GetGender($id=true){
			
			if ($id==1) { return "Male"; } else { return "Female"; }
			
		}
		
		
		
		public static function GetMstatus($id=true){
			
			if ($id==1) { return "Single"; } else { return "Married"; }
			
		}
		
		public static function GetAdmitState( $id = true ){
			
			$pat = Patient::model()->findBypk($id);
			$admState = self::model()->findAll(array(
			'condition'=>"patient_id ='".$pat->patient_id."' AND ddate = 0",
		));
			
			if($admState){ return true; } else { return false; } 
			
		}
		
		public static function GetAdmitId( $id = true ){
			
			
			$admState = self::model()->find(array(
			'condition'=>"patient_id ='".$id."' AND ddate = 0",
		));
			
			if($admState){ return $admState->admit_id; } 
			
		}
		
		public static function CheckAvail($bed = true){
			
			
			$admState = self::model()->find(array(
			'condition'=>"ddate = 0 AND bed = ".$bed,
		));
			
			if($admState){ return $admState; } 
			
		}
		
		public static function GetDischargeState($id=true){
			
			$fee = 0;
			$fee = Bills::TotalBill($id) - Payment::TotalPaid($id);
			
			$pat = Patient::model()->findBypk($id);
			$admState = self::model()->findAll(array(
			'condition'=>"patient_id ='".$pat->patient_id."' AND ddate = 0",
		));
			
			if(($admState) && ($fee<=0)){ return true; } else { return false; } 
			
		}
		
		public static function GetAddbillState($id=true){
			
			
			
			$pat = Patient::model()->findBypk($id);
			$admState = self::model()->findAll(array(
			'condition'=>"patient_id ='".$pat->patient_id."' AND ddate = 0",
		));
			
			if($admState){ return true; } else { return false; } 
			
		}
		
		public static function GetPatient($id = true){
            if($id){
                $page=self::model()->find( array(
				'condition'=>"patient_id = '".$id."' AND ddate = 0",
				));
                if($page){
                    return $page;
                } else{
                    return '';
                }
            } else {
                return '';
            }
        }
        
       
        
}