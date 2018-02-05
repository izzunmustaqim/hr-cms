<?php

/**
 * This is the model class for table "tblhrcandidate".
 *
 * The followings are the available columns in table 'tblhrcandidate':
 * @property integer $UserId
 * @property string $FullName
 * @property string $ICPassportNo
 * @property string $EmailAddress
 * @property integer $NationalityId
 * @property string $UserDOB
 * @property string $HandSetNo
 * @property integer $RaceId
 * @property integer $ReligionId
 * @property string $Gender
 * @property string $Remarks
 * @property integer $StaffId
 * @property string $Date
 * @property integer $StatusId
 */
class Tblhrcandidate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhrcandidate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NationalityId, RaceId, ReligionId, StaffId, StatusId', 'numerical', 'integerOnly'=>true),
			array('FullName', 'length', 'max'=>180),
			array('ICPassportNo', 'length', 'max'=>16),
			array('EmailAddress', 'length', 'max'=>150),
			array('HandSetNo', 'length', 'max'=>15),
			array('Gender', 'length', 'max'=>2),
			array('Remarks', 'length', 'max'=>250),
			array('UserDOB, Date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('UserId, FullName, ICPassportNo, EmailAddress, NationalityId, UserDOB, HandSetNo, RaceId, ReligionId, Gender, Remarks, StaffId, Date, StatusId', 'safe', 'on'=>'search'),
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
			'UserId' => 'User',
			'FullName' => 'Full Name',
			'ICPassportNo' => 'Icpassport No',
			'EmailAddress' => 'Email Address',
			'NationalityId' => 'Nationality',
			'UserDOB' => 'User Dob',
			'HandSetNo' => 'Hand Set No',
			'RaceId' => 'Race',
			'ReligionId' => 'Religion',
			'Gender' => 'Gender',
			'Remarks' => 'Remarks',
			'StaffId' => 'Staff',
			'Date' => 'Date',
			'StatusId' => 'Status',
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

		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('FullName',$this->FullName,true);
		$criteria->compare('ICPassportNo',$this->ICPassportNo,true);
		$criteria->compare('EmailAddress',$this->EmailAddress,true);
		$criteria->compare('NationalityId',$this->NationalityId);
		$criteria->compare('UserDOB',$this->UserDOB,true);
		$criteria->compare('HandSetNo',$this->HandSetNo,true);
		$criteria->compare('RaceId',$this->RaceId);
		$criteria->compare('ReligionId',$this->ReligionId);
		$criteria->compare('Gender',$this->Gender,true);
		$criteria->compare('Remarks',$this->Remarks,true);
		$criteria->compare('StaffId',$this->StaffId);
		$criteria->compare('Date',$this->Date,true);
		$criteria->compare('StatusId',$this->StatusId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblhrcandidate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
