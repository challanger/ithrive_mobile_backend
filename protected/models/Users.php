<?php

/**
 * This is the model class for table "itm_users".
 *
 * The followings are the available columns in table 'itm_users':
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $active
 * @property string $permission
 * @property integer $created_on
 * @property integer $updated_on
 *
 * The followings are the available model relations:
 * @property Category[] $categories
 * @property Category[] $categories1
 * @property Log[] $logs
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property Slides[] $slides
 * @property Slides[] $slides1
 */
class Users extends CActiveRecord
{
    public $initial_password;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'itm_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, created_on, updated_on', 'numerical', 'integerOnly'=>true),
			array('name, email, password', 'length', 'max'=>100),
			array('permission', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, active, permission, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'categories' => array(self::HAS_MANY, 'Category', 'created_by'),
			'categories1' => array(self::HAS_MANY, 'Category', 'updated_by'),
			'logs' => array(self::HAS_MANY, 'Log', 'user'),
			'messages' => array(self::HAS_MANY, 'Message', 'created_by'),
			'messages1' => array(self::HAS_MANY, 'Message', 'cupdated_by'),
			'slides' => array(self::HAS_MANY, 'Slides', 'created_by'),
			'slides1' => array(self::HAS_MANY, 'Slides', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
                        'password' => 'Password',
			'active' => 'Active',
			'permission' => 'Permission',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
		);
	}
        
        public function getActiveWord()
        {
            if($this->active==1)
                return "Active";
            else 
                return "Disabled";
        }
        
        public function getDateCreated()
        {
            return date("M d Y h:i:s a",$this->created_on);
        }
        
        public function getDateUpdated()
        {
            return date("M d Y h:i:s a",$this->updated_on);
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('permission',$this->permission,true);
		$criteria->compare('created_on',$this->created_on);
		$criteria->compare('updated_on',$this->updated_on);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {
            if($this->isNewRecord)
                $this->created_on=time();
            
            $this->updated_on=time();
            
            return parent::beforeSave();
        }
}