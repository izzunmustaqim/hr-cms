<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $user_login
 * @property string $user_password
 * @property string $user_name
 * @property string $user_icno
 * @property string $user_email
 * @property integer $user_status
 * @property string $user_registration_date
 * @property integer $user_activation_code
 * @property string $user_password_code
 * @property integer $user_type
 * @property string $user_last_login
 * @property string $user_register_by
 * @property string $user_register_date
 * @property string $user_edit_by
 * @property string $user_edit_date
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_registration_date', 'required'),
			array('user_status, user_activation_code, user_type', 'numerical', 'integerOnly'=>true),
			array('user_login, user_password_code', 'length', 'max'=>30),
			array('user_password', 'length', 'max'=>100),
			array('user_name, user_email', 'length', 'max'=>120),
			array('user_icno', 'length', 'max'=>12),
			array('user_register_by, user_edit_by', 'length', 'max'=>50),
			array('user_last_login, user_register_date, user_edit_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, user_login, user_password, user_name, user_icno, user_email, user_status, user_registration_date, user_activation_code, user_password_code, user_type, user_last_login, user_register_by, user_register_date, user_edit_by, user_edit_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_login' => 'User Login',
			'user_password' => 'User Password',
			'user_name' => 'User Name',
			'user_icno' => 'User Icno',
			'user_email' => 'User Email',
			'user_status' => 'User Status',
			'user_registration_date' => 'User Registration Date',
			'user_activation_code' => 'User Activation Code',
			'user_password_code' => 'User Password Code',
			'user_type' => 'User Type',
			'user_last_login' => 'User Last Login',
			'user_register_by' => 'User Register By',
			'user_register_date' => 'User Register Date',
			'user_edit_by' => 'User Edit By',
			'user_edit_date' => 'User Edit Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_login',$this->user_login,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_icno',$this->user_icno,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_status',$this->user_status);
		$criteria->compare('user_registration_date',$this->user_registration_date,true);
		$criteria->compare('user_activation_code',$this->user_activation_code);
		$criteria->compare('user_password_code',$this->user_password_code,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('user_last_login',$this->user_last_login,true);
		$criteria->compare('user_register_by',$this->user_register_by,true);
		$criteria->compare('user_register_date',$this->user_register_date,true);
		$criteria->compare('user_edit_by',$this->user_edit_by,true);
		$criteria->compare('user_edit_date',$this->user_edit_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
