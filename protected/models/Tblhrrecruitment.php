<?php

/**
 * This is the model class for table "tblhrrecruitment".
 *
 * The followings are the available columns in table 'tblhrrecruitment':
 * @property integer $UserId
 * @property string $UserNo
 * @property string $FullName
 * @property string $ICPassportNo
 * @property string $EmailAddress
 * @property integer $NationalityId
 * @property string $UserDOB
 * @property string $HandSetNo
 * @property string $FaxNo
 * @property string $OffLettPosition
 * @property integer $PositionId
 * @property integer $BranchId
 * @property integer $StatusId
 * @property integer $WorkingStatusId
 * @property string $DateJoin
 * @property string $DateConfirm
 * @property string $DateLast
 * @property string $ContractStart
 * @property string $ContractEnd
 * @property integer $RaceId
 * @property integer $ReligionId
 * @property string $Gender
 * @property integer $MaritalStatusId
 * @property integer $DepartmentId
 * @property string $Remarks
 * @property string $UserName
 * @property string $UserPassword
 * @property string $UserPasswordCrypt
 * @property string $user_password_code
 * @property string $ActivateCode
 * @property string $UserImage
 * @property integer $TypeUser
 * @property integer $Hod1
 * @property integer $Hod2
 * @property integer $StaffLevelId
 * @property integer $CmsAccess
 * @property integer $DCollegeCode
 * @property string $ChangePassword
 * @property string $TransactionDate
 * @property string $ExtensionNo
 */
class Tblhrrecruitment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhrrecruitment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserNo, FullName, ICPassportNo, EmailAddress, NationalityId, HandSetNo, PositionId, BranchId, WorkingStatusId, RaceId, Gender, MaritalStatusId, DepartmentId, UserName, ChangePassword, TransactionDate, ExtensionNo', 'required'),
			array('NationalityId, PositionId, BranchId, StatusId, WorkingStatusId, RaceId, ReligionId, MaritalStatusId, DepartmentId, TypeUser, Hod1, Hod2, StaffLevelId, CmsAccess, DCollegeCode', 'numerical', 'integerOnly'=>true),
			array('UserNo, ExtensionNo', 'length', 'max'=>10),
			array('FullName', 'length', 'max'=>180),
			array('ICPassportNo', 'length', 'max'=>16),
			array('EmailAddress', 'length', 'max'=>150),
			array('HandSetNo, FaxNo', 'length', 'max'=>15),
			array('OffLettPosition, UserPassword', 'length', 'max'=>80),
			array('Gender', 'length', 'max'=>2),
			array('Remarks, ActivateCode', 'length', 'max'=>250),
			array('UserName', 'length', 'max'=>50),
			array('UserPasswordCrypt, UserImage', 'length', 'max'=>100),
			array('user_password_code', 'length', 'max'=>30),
			array('UserDOB, DateJoin, DateConfirm, DateLast, ContractStart, ContractEnd', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('UserId, UserNo, FullName, ICPassportNo, EmailAddress, NationalityId, UserDOB, HandSetNo, FaxNo, OffLettPosition, PositionId, BranchId, StatusId, WorkingStatusId, DateJoin, DateConfirm, DateLast, ContractStart, ContractEnd, RaceId, ReligionId, Gender, MaritalStatusId, DepartmentId, Remarks, UserName, UserPassword, UserPasswordCrypt, user_password_code, ActivateCode, UserImage, TypeUser, Hod1, Hod2, StaffLevelId, CmsAccess, DCollegeCode, ChangePassword, TransactionDate, ExtensionNo', 'safe', 'on'=>'search'),
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
			'UserNo' => 'User No',
			'FullName' => 'Full Name',
			'ICPassportNo' => 'Icpassport No',
			'EmailAddress' => 'Email Address',
			'NationalityId' => 'Nationality',
			'UserDOB' => 'User Dob',
			'HandSetNo' => 'Hand Set No',
			'FaxNo' => 'Fax No',
			'OffLettPosition' => 'Off Lett Position',
			'PositionId' => 'Position',
			'BranchId' => 'Branch',
			'StatusId' => 'Status',
			'WorkingStatusId' => 'Working Status',
			'DateJoin' => 'Date Join',
			'DateConfirm' => 'Date Confirm',
			'DateLast' => 'Date Last',
			'ContractStart' => 'Contract Start',
			'ContractEnd' => 'Contract End',
			'RaceId' => 'Race',
			'ReligionId' => 'Religion',
			'Gender' => 'Gender',
			'MaritalStatusId' => 'Marital Status',
			'DepartmentId' => 'Department',
			'Remarks' => 'Remarks',
			'UserName' => 'User Name',
			'UserPassword' => 'User Password',
			'UserPasswordCrypt' => 'User Password Crypt',
			'user_password_code' => 'User Password Code',
			'ActivateCode' => 'Activate Code',
			'UserImage' => 'User Image',
			'TypeUser' => 'Type User',
			'Hod1' => 'Hod1',
			'Hod2' => 'Hod2',
			'StaffLevelId' => 'Staff Level',
			'CmsAccess' => 'Cms Access',
			'DCollegeCode' => 'Dcollege Code',
			'ChangePassword' => 'Change Password',
			'TransactionDate' => 'Transaction Date',
			'ExtensionNo' => 'Extension No',
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
		$criteria->compare('UserNo',$this->UserNo,true);
		$criteria->compare('FullName',$this->FullName,true);
		$criteria->compare('ICPassportNo',$this->ICPassportNo,true);
		$criteria->compare('EmailAddress',$this->EmailAddress,true);
		$criteria->compare('NationalityId',$this->NationalityId);
		$criteria->compare('UserDOB',$this->UserDOB,true);
		$criteria->compare('HandSetNo',$this->HandSetNo,true);
		$criteria->compare('FaxNo',$this->FaxNo,true);
		$criteria->compare('OffLettPosition',$this->OffLettPosition,true);
		$criteria->compare('PositionId',$this->PositionId);
		$criteria->compare('BranchId',$this->BranchId);
		$criteria->compare('StatusId',$this->StatusId);
		$criteria->compare('WorkingStatusId',$this->WorkingStatusId);
		$criteria->compare('DateJoin',$this->DateJoin,true);
		$criteria->compare('DateConfirm',$this->DateConfirm,true);
		$criteria->compare('DateLast',$this->DateLast,true);
		$criteria->compare('ContractStart',$this->ContractStart,true);
		$criteria->compare('ContractEnd',$this->ContractEnd,true);
		$criteria->compare('RaceId',$this->RaceId);
		$criteria->compare('ReligionId',$this->ReligionId);
		$criteria->compare('Gender',$this->Gender,true);
		$criteria->compare('MaritalStatusId',$this->MaritalStatusId);
		$criteria->compare('DepartmentId',$this->DepartmentId);
		$criteria->compare('Remarks',$this->Remarks,true);
		$criteria->compare('UserName',$this->UserName,true);
		$criteria->compare('UserPassword',$this->UserPassword,true);
		$criteria->compare('UserPasswordCrypt',$this->UserPasswordCrypt,true);
		$criteria->compare('user_password_code',$this->user_password_code,true);
		$criteria->compare('ActivateCode',$this->ActivateCode,true);
		$criteria->compare('UserImage',$this->UserImage,true);
		$criteria->compare('TypeUser',$this->TypeUser);
		$criteria->compare('Hod1',$this->Hod1);
		$criteria->compare('Hod2',$this->Hod2);
		$criteria->compare('StaffLevelId',$this->StaffLevelId);
		$criteria->compare('CmsAccess',$this->CmsAccess);
		$criteria->compare('DCollegeCode',$this->DCollegeCode);
		$criteria->compare('ChangePassword',$this->ChangePassword,true);
		$criteria->compare('TransactionDate',$this->TransactionDate,true);
		$criteria->compare('ExtensionNo',$this->ExtensionNo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblhrrecruitment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
