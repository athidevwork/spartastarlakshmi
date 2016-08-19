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
class Patient extends CActiveRecord
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
		return '{{patient}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('name, gender, age, roomno, ipno, mrdno, regno, admdate, dept, consultant, uid', 'required'),
			array('age, gender, dept, consultant, pin', 'numerical', 'integerOnly'=>true),
			array('name,reference, address', 'length', 'max'=>255),
			
			array('name, roomno, ipno, dob, mrdno, regno, city, admdate, disdate, cdate, ward','safe'),
			array('name, admdate, disdate, consultant', 'safe', 'on'=>'search'),
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
			
			'name' => t('Patient Name'),
			'age' => t('Age'),
			'gender' => t('Gender'),
			'address' => t('Address Line1'),
			'ipno' => t('IP No'),
			'city'=>t('Address Line2'),
			'pin'=>t('Mobile No'),
			'regno'=>t('Reg No'),
			'mrdno'=>t('MRD No'),
			'roomno' => t('Room No'),
			'dob' => t('Date of Birth'),
			'dept' => t('Department'),
			'consultant' => t('Consultant'),
			'admdate' => t('Date & Time of Admission'),
			'disdate' => t('Date of Discharge'),
			'cdate'=>t('Date'),
			'reference' => t('Ref. By'),
			'ward'=>t('Ward')
			
			
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
		$criteria->compare('admdate',$this->admdate,true);
		$criteria->compare('disdate',$this->disdate,true);
		$criteria->compare('ipno',$this->ipno,true);
		$criteria->compare('regno',$this->regno,true);
		$criteria->compare('mrdno',$this->mrdno,true);
		
		
                
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
	
		public function asearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('admdate',$this->admdate,true);
		$criteria->compare('disdate',$this->disdate,true);
		$criteria->compare('ipno',$this->ipno,true);
		$criteria->compare('regno',$this->regno,true);
		$criteria->compare('mrdno',$this->mrdno,true);
		
		
		
		
		$criteria->condition = '`astatus` = 1';
		
                
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