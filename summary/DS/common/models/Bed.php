<?php


class Bed extends CActiveRecord
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
		return '{{bed}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		
		
		return array(
			array('created, modified, status, name, source', 'required'),
			array('id, crby, created, modified, status, source', 'numerical', 'integerOnly'=>true),
			array('uid, name, note', 'length', 'max'=>255),
			array('id, name, uid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => t('ID'),
			'name' => t('Bed Name/No.'),
			'source' => t('Room'),
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

	     protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{				
				if($this->uid==''){
                                    $this->uid=uniqid();
                                }                             
                                
			} 
			return true;
		}
		else
			return false;
	}
	    
    public static function GetAll($render=true){    
	           //$objects=self::model()->findAll();    
				
				
				
				$objects= Yii::app()->db->createCommand('SELECT
    tbl_bed.id as id
    , tbl_bed.name as name
    , tbl_cabin.name as floor
FROM tbl_bed
    INNER JOIN tbl_cabin 
        ON (tbl_bed.source = tbl_cabin.id)
GROUP BY tbl_cabin.id')->queryAll();            
               
                $data=array(''=>t("None"));      
                
                if($objects && count($objects) > 0 ){
                    $data = CMap::mergeArray($data,CHtml::listData($objects,'id','name','floor'));                            
                }                
                
                return $data;
        }
        
}