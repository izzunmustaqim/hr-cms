<?php

/**
 * This is the model class for table "tblhrworkingpermit".
 *
 * The followings are the available columns in table 'tblhrworkingpermit':
 * @property integer $id
 * @property string $Date
 * @property string $FullName
 * @property string $ICPassportNo
 * @property integer $DepartmentId
 * @property integer $WorkingStatusId
 * @property string $PermitNo
 * @property string $StartDate
 * @property string $ExpiryDate
 * @property string $Remarks
 * @property integer $StaffId
 * @property integer $StatusId
 */
class Tblhrworkingpermit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhrworkingpermit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepartmentId, WorkingStatusId, StaffId, StatusId', 'numerical', 'integerOnly'=>true),
			array('FullName, PermitNo', 'length', 'max'=>100),
			array('ICPassportNo', 'length', 'max'=>30),
			array('Date, StartDate, ExpiryDate, Remarks', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Date, FullName, ICPassportNo, DepartmentId, WorkingStatusId, PermitNo, StartDate, ExpiryDate, Remarks, StaffId, StatusId', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'Date' => 'Date',
			'FullName' => 'Full Name',
			'ICPassportNo' => 'Icpassport No',
			'DepartmentId' => 'Department',
			'WorkingStatusId' => 'Working Status',
			'PermitNo' => 'Permit No',
			'StartDate' => 'Start Date',
			'ExpiryDate' => 'Expiry Date',
			'Remarks' => 'Remarks',
			'StaffId' => 'Staff',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('Date',$this->Date,true);
		$criteria->compare('FullName',$this->FullName,true);
		$criteria->compare('ICPassportNo',$this->ICPassportNo,true);
		$criteria->compare('DepartmentId',$this->DepartmentId);
		$criteria->compare('WorkingStatusId',$this->WorkingStatusId);
		$criteria->compare('PermitNo',$this->PermitNo,true);
		$criteria->compare('StartDate',$this->StartDate,true);
		$criteria->compare('ExpiryDate',$this->ExpiryDate,true);
		$criteria->compare('Remarks',$this->Remarks,true);
		$criteria->compare('StaffId',$this->StaffId);
		$criteria->compare('StatusId',$this->StatusId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblhrworkingpermit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
