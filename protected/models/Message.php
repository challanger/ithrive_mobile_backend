<?php

/**
 * This is the model class for table "itm_message".
 *
 * The followings are the available columns in table 'itm_message':
 * @property string $id
 * @property integer $category
 * @property string $url
 * @property string $title
 * @property integer $date
 * @property integer $created_by
 * @property integer $created
 * @property integer $updated_by
 * @property integer $updated
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Category $category0
 * @property Users $createdBy
 * @property Users $cupdatedBy
 */
class Message extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return 'itm_message';
	}

        public function init()
        {
            $this->date=time();
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, date, created_by, created, updated_by, updated', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>500),
			array('url','file','types'=>'mp3','safe'=>false,'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, url, title, date, created_by, created, updated_by, updated', 'safe', 'on'=>'search'),
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
			'category0' => array(self::BELONGS_TO, 'Category', 'category'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'cupdatedBy' => array(self::BELONGS_TO, 'Users', 'cupdated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'url' => 'Media URL',
			'title' => 'Title',
			'date' => 'Date',
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
		$criteria->compare('category',$this->category);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function getDate()
        {
            return date("m/d/y",$this->date);
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
