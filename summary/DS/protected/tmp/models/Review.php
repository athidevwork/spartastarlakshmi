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
class Review extends CActiveRecord
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
		return '{{review}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fname, title, description, rating, lang', 'required'),
			array('lang, status, rating', 'numerical', 'integerOnly'=>true),
			array('fname, lname, title, parent', 'length', 'max'=>255),
            array('guid','safe'),
                        
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fname, title, description, parent, lang', 'safe', 'on'=>'search'),
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
			'fname' => t('First Name'),
			'lname' => t('Last Name'),
			'title' => t('Title'),
			'description' => t('Description'),
			'parent' => t('Parent'),
			'lang' => t('Language'),
                        'guid' => t('Guid'),
                        'status' => t('Status'),
                        'display_image' => t('Photo'),
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
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('lang',$this->lang);
                
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
        
        protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{				
				if($this->guid==''){
                                    $this->guid=uniqid();
                                }                             
                                
			} 
			return true;
		}
		else
			return false;
	}
        
        
       
        
       
        
}