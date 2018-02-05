<?php

/**
 * This is the model class for table "tblfaculty".
 *
 * The followings are the available columns in table 'tblfaculty':
 * @property integer $FacultyId
 * @property string $FacultyCode
 * @property string $FacultyName
 * @property string $FacultyName2
 * @property integer $CoordinatorId
 * @property integer $StatusId
 * @property string $TransactionDate
 * @property integer $UserId
 */
class Tblfaculty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblfaculty';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FacultyCode, FacultyName, FacultyName2, TransactionDate', 'required'),
			array('CoordinatorId, StatusId, UserId', 'numerical', 'integerOnly'=>true),
			array('FacultyCode', 'length', 'max'=>10),
			array('FacultyName, FacultyName2', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('FacultyId, FacultyCode, FacultyName, FacultyName2, CoordinatorId, StatusId, TransactionDate, UserId', 'safe', 'on'=>'search'),
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
			'FacultyId' => 'Faculty',
			'FacultyCode' => 'Faculty Code',
			'FacultyName' => 'Faculty Name',
			'FacultyName2' => 'Faculty Name2',
			'CoordinatorId' => 'Coordinator',
			'StatusId' => 'Status',
			'TransactionDate' => 'Transaction Date',
			'UserId' => 'User',
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

		$criteria->compare('FacultyId',$this->FacultyId);
		$criteria->compare('FacultyCode',$this->FacultyCode,true);
		$criteria->compare('FacultyName',$this->FacultyName,true);
		$criteria->compare('FacultyName2',$this->FacultyName2,true);
		$criteria->compare('CoordinatorId',$this->CoordinatorId);
		$criteria->compare('StatusId',$this->StatusId);
		$criteria->compare('TransactionDate',$this->TransactionDate,true);
		$criteria->compare('UserId',$this->UserId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblfaculty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
