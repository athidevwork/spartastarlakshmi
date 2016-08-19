<?php


class Doctor extends CActiveRecord
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
		return '{{people}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		
		
		return array(
			array('status, name, display_name, category, address1, country, zip, email', 'required'),
			array('id, crby, created, modified, status, category', 'numerical', 'integerOnly'=>true),
			array('uid, name, skype, display_name, address1, zip, address2, town, province, email2, fax', 'length', 'max'=>255),
			
			array('bank_details, note','length','max'=>1000),
			array('email', 'email'),
            array('email','unique'),
			array('tele, mobile', 'my_required'),
			array('id, name, uid, display_name, user_url', 'safe', 'on'=>'search'),
		);
	}
	
	public function my_required($attribute_name, $params)
{
    if (empty($this->tele) && empty($this->mobile) ) 
	{
        $this->addError($attribute_name, Yii::t('user', 'At least 1 contact number must be filled up properly'));

        return false;
    }

    return true;
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
			'name' => t('Name'),
			'display_name' => t('Display Name'),
			'address1' => t('Address Line 1'),
			'address2' => t('Address Line 2'),
			'town' => t('City'),
			'skype' => t('Skype ID'),
			'province' => t('State'),
			'country' => t('Country'),
			'zip' => t('ZIP Code'),
			'tele' => t('Telephone Number'),
			'mobile' => t('Mobile Phone Number'),
			'fax' => t('FAX'),
			'email' => t('Primary email ID'),
			'email2' => t('Additional email id'),
			'bank_details' => t('Bank Details'),
			'category' => t('Department'),
			'note' => t('Notes'),
			'status' => t('Active Status'),
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

		//$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('display_name',$this->display_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tele',$this->tele,true);
		
                
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
        
    
	
	
	public static function GetName($id){    
		                       
               
            $models=self::model()->find(array(
		    'condition'=>'`id`=:id',
		    'params'=>array(':id'=>$id)));
			
			$items = t("None");
			
			if(count($models)>0){                
                
                        $items = $models->name;
                
	    	} 
			return $items;
        }

	
	    
    public static function GetAll($render=true){    
	           //$objects=self::model()->findAll();    
				
				$objects = self::model()->findAll(array(
    			'select'=>'t.name, t.id',
    			'group'=>'t.name',
   				'distinct'=>true,
				));            
               
                $data=array(''=>t("None"));      
                
                if($objects && count($objects) > 0 ){
                    $data = CMap::mergeArray($data,CHtml::listData($objects,'id','name'));                            
                }                
                
                return $data;
        }
		
	public static function GetOwner($render=true){    
	           //$objects=self::model()->findAll();    
				
				$objects = self::model()->findAll(array(
    			'select'=>'t.name, t.id',
    			'group'=>'t.name',
   				'distinct'=>true,
				'condition'=>'category=101',
				));            
               
                $data=array(''=>t("None"));      
                
                if($objects && count($objects) > 0 ){
                    $data = CMap::mergeArray($data,CHtml::listData($objects,'id','name'));                            
                }                
                
                return $data;
        }
        
}