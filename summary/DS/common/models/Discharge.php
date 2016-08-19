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
class Discharge extends CActiveRecord
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
		return '{{discharge}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('pid', 'required'),
			array('dm, cad, asthma, hypertension, ethanol, smoking, pulse, type', 'numerical', 'integerOnly'=>true),
			array('diagnosis, operation, history, past_history, personal_history, family_history, on_examination, investigation, advice_on_discharge, other_consultant, next_visit, weight, palior, cyanosis, edemafeet, oralcavity, icterus, temp, bp, head, cvs, rs, abdomen, cns, genitais, conditionatdischarge, functionalevaluation, invest, diet, physicalactivity, surgical_history, others, clubbing, lymphnodes, prodate, proname, sigmedicine, expiry, source','safe'),
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
			
			'diagnosis'=>t('Diagnosis'),
			'type'=>t('Summary Type'),
			'operation'=>t('Allergies'),
			'history'=>t('Chief Complaint'),
			'past_history'=>t('Past Medical History (Others)'),
			'personal_history'=>t('Clinical Examination During Admission'),
			'family_history'=>t('Course in the Hospital'),
			'on_examination'=>t('Diabetic Advice Medicine'),
			 'advice_on_discharge'=>t('Advice on Discharge'),
			 'investigation'=>t('Medication'),
			 'next_visit'=>t('Follow Up'),
			'other_consultant'=>t('Consultant Referrals'),
			'dm'=>t('History of Diabetes Mellitus'),
			
			'cad'=>'History of Coronary Artery Disease',
			'asthma'=>'History of Asthma',
			'ethanol'=>'Ethanol',
			'smoking'=>'Smoking',
			'weight'=>'Weight',
			'height'=>'Height',
			'palior'=>'Pallor',
			'cyanosis'=>'Cyanosis',
			'edemafeet'=>'Edema Feet',
			'oralcavity'=>'Oral Cavity',
			'icterus'=>'Icterus',
			'temp'=>'Temp',
			'pulse'=>'Pulse',
			'bp'=>'BP',
			'head'=>'Head & ENT',
			'cvs'=>'CVS',
			'rs'=>'RS',
			'abdomen'=>'Abdomen',
			'cns'=>'CNS',
			'genitais'=>'Genitals',
			'functionalevaluation'=>'Functional Evaluation',
			'invest'=>'Investigations',
			'conditionatdischarge'=>'Condition At Discharge',
			'diet'=>'Diet',
			'physicalactivity'=>'Physical Activity',
			'surgical_history'=>'Past Surgical History',
			'others'=>'Others',
			'clubbing'=>'Clubbing',
			'lymphnodes'=>'Lymph Nodes',
			'sigmedicine'=>'Significant Medications Given',
			'hypertension'=>'History of Hypertension',
			'prodate'=> 'Date Of Procedure',
'expiry'=>'Date & Time of Expiry',
			'proname'=>'Nature Of Procedure'
		
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
	
	public function discharge_list( $id=true )
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$pat = Patient::model()->findBypk($id);

		$criteria->condition = "patient_id = '".$pat->patient_id."'";
		
                
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
		
		public static function GetSummaryState($id=true){
			
			$pat = Patient::model()->findBypk($id);
			$admState = self::model()->findAll(array(
			'condition'=>"patient_id ='".$pat->patient_id."'",
		));
			
			if($admState){ return true; } else { return false; } 
			
		}
        
       
        
}