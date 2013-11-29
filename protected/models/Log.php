<?php

/**
 * This is the model class for table "itm_log".
 *
 * The followings are the available columns in table 'itm_log':
 * @property string $id
 * @property integer $user
 * @property string $message
 * @property integer $date
 *
 * The followings are the available model relations:
 * @property Users $user0
 */
class Log extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Log the static model class
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
		return 'itm_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, date', 'numerical', 'integerOnly'=>true),
			array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, message, date', 'safe', 'on'=>'search'),
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
			'user0' => array(self::BELONGS_TO, 'Users', 'user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'message' => 'Message',
			'date' => 'Date',
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
		$criteria->compare('user',$this->user);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('date',$this->date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}