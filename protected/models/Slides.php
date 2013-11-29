<?php

/**
 * This is the model class for table "itm_slides".
 *
 * The followings are the available columns in table 'itm_slides':
 * @property string $id
 * @property string $imageurl
 * @property string $link
 * @property string $caption
 * @property integer $starts
 * @property integer $expires
 * @property integer $created_by
 * @property integer $created
 * @property integer $updated_by
 * @property integer $updated
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property Users $updatedBy
 */
class Slides extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Slides the static model class
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
		return 'itm_slides';
	}
        
        public function init() 
        {
            $this->starts=time();
            $this->expires=time();
        }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('starts, expires, created_by, created, updated_by, updated', 'numerical', 'integerOnly'=>true),
			array('imageurl, link, caption', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, imageurl, link, caption, starts, expires, created_by, created, updated_by, updated', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'Users', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'imageurl' => 'Imageurl',
			'link' => 'Link',
			'caption' => 'Caption',
			'starts' => 'Starts',
			'expires' => 'Expires',
			'created_by' => 'Created By',
			'created' => 'Created',
			'updated_by' => 'Updated By',
			'updated' => 'Updated',
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
		$criteria->compare('imageurl',$this->imageurl,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('starts',$this->starts);
		$criteria->compare('expires',$this->expires);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getDateStarts() 
        {
            return date("m/d/y",$this->starts);
        }
        
        public function getDateExpires()
        {
            return date("m/d/y",$this->expires);
        }
        
        public function beforeSave()
        {
            if($this->isNewRecord)
            {
                $this->created=time();
                $this->created_by=Yii::app()->user->getID();
            }
            
            $this->updated=time();
            $this->updated_by=Yii::app()->user->getID();
            
            return parent::beforeSave();
        }
}