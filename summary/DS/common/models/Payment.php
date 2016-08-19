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
class Payment extends CActiveRecord
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
		return '{{payment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('amount', 'required'),
			array('discount, bill_no, patient_id, admit_id', 'length', 'max'=>255),
			array('amount', 'type', 'type'=>'float'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, amount', 'safe', 'on'=>'search'),
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
			'admit_id' => t('Admissioin ID'),
			'amount' => t('Amount'),
			'discount' => t('Discount if any..'),
			'created' => t('Bill Date'),
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
	
	
	
	public static function TotalPaid($id = true){
            
			$total = 0;
			
			if($id){
			
			$pat = Patient::model()->findBypk($id);
				
			
			$bills_info = self::model()->findAll(array(
			'condition'=>"patient_id = '".$pat->patient_id."' AND admit_id = '".Admit::GetAdmitId($pat->patient_id)."'",
			'order'=>'created DESC',
			));
			
			
			
			if($bills_info){ 
				foreach ($bills_info as $bi) {
					$total += ($bi->amount + $bi->discount);
				}
			}
				
			}
			return $total;
        }
        
   
        
		public static function GetPatient($id = true){
            if($id){
                $page=self::model()->find( array(
				'condition'=>"patient_id = '".$id."'",
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
        
       
        
}