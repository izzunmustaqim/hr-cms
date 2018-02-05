<?php

/**
 * This is the model class for table "tblprogramtype".
 *
 * The followings are the available columns in table 'tblprogramtype':
 * @property integer $ProgramTypeId
 * @property string $ProgramTypeName
 * @property string $ProgramTypeCode
 * @property string $CodeLevel
 * @property integer $StatusId
 * @property string $TransactionDate
 * @property integer $UserId
 * @property integer $KptConvo_ProgType
 * @property string $Ifms_Code
 * @property string $Ifms_Desc
 */
class Tblprogramtype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblprogramtype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ProgramTypeName, TransactionDate, UserId', 'required'),
			array('StatusId, UserId, KptConvo_ProgType', 'numerical', 'integerOnly'=>true),
			array('ProgramTypeName', 'length', 'max'=>50),
			array('ProgramTypeCode', 'length', 'max'=>1),
			array('CodeLevel', 'length', 'max'=>2),
			array('Ifms_Code', 'length', 'max'=>3),
			array('Ifms_Desc', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ProgramTypeId, ProgramTypeName, ProgramTypeCode, CodeLevel, StatusId, TransactionDate, UserId, KptConvo_ProgType, Ifms_Code, Ifms_Desc', 'safe', 'on'=>'search'),
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
			'ProgramTypeId' => 'Program Type',
			'ProgramTypeName' => 'Program Type Name',
			'ProgramTypeCode' => 'Program Type Code',
			'CodeLevel' => 'Code Level',
			'StatusId' => 'Status',
			'TransactionDate' => 'Transaction Date',
			'UserId' => 'User',
			'KptConvo_ProgType' => 'Kpt Convo Prog Type',
			'Ifms_Code' => 'Ifms Code',
			'Ifms_Desc' => 'Ifms Desc',
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

		$criteria->compare('ProgramTypeId',$this->ProgramTypeId);
		$criteria->compare('ProgramTypeName',$this->ProgramTypeName,true);
		$criteria->compare('ProgramTypeCode',$this->ProgramTypeCode,true);
		$criteria->compare('CodeLevel',$this->CodeLevel,true);
		$criteria->compare('StatusId',$this->StatusId);
		$criteria->compare('TransactionDate',$this->TransactionDate,true);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('KptConvo_ProgType',$this->KptConvo_ProgType);
		$criteria->compare('Ifms_Code',$this->Ifms_Code,true);
		$criteria->compare('Ifms_Desc',$this->Ifms_Desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblprogramtype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
