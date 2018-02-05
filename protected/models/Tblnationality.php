<?php

/**
 * This is the model class for table "tblnationality".
 *
 * The followings are the available columns in table 'tblnationality':
 * @property integer $NationalityId
 * @property string $NationalityName
 * @property string $Ifms_Code
 * @property string $Ifms_Desc
 * @property string $Ifms_CodeCountry
 * @property string $Ifms_DescCountry
 * @property integer $Default
 * @property string $TransactionDate
 * @property integer $UserId
 * @property integer $KptConvo_Nationality
 */
class Tblnationality extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblnationality';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NationalityName, TransactionDate, KptConvo_Nationality', 'required'),
			array('Default, UserId, KptConvo_Nationality', 'numerical', 'integerOnly'=>true),
			array('NationalityName', 'length', 'max'=>50),
			array('Ifms_Code', 'length', 'max'=>80),
			array('Ifms_Desc, Ifms_DescCountry', 'length', 'max'=>30),
			array('Ifms_CodeCountry', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('NationalityId, NationalityName, Ifms_Code, Ifms_Desc, Ifms_CodeCountry, Ifms_DescCountry, Default, TransactionDate, UserId, KptConvo_Nationality', 'safe', 'on'=>'search'),
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
			'NationalityId' => 'Nationality',
			'NationalityName' => 'Nationality Name',
			'Ifms_Code' => 'Ifms Code',
			'Ifms_Desc' => 'Ifms Desc',
			'Ifms_CodeCountry' => 'Ifms Code Country',
			'Ifms_DescCountry' => 'Ifms Desc Country',
			'Default' => 'Default',
			'TransactionDate' => 'Transaction Date',
			'UserId' => 'User',
			'KptConvo_Nationality' => 'Kpt Convo Nationality',
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

		$criteria->compare('NationalityId',$this->NationalityId);
		$criteria->compare('NationalityName',$this->NationalityName,true);
		$criteria->compare('Ifms_Code',$this->Ifms_Code,true);
		$criteria->compare('Ifms_Desc',$this->Ifms_Desc,true);
		$criteria->compare('Ifms_CodeCountry',$this->Ifms_CodeCountry,true);
		$criteria->compare('Ifms_DescCountry',$this->Ifms_DescCountry,true);
		$criteria->compare('Default',$this->Default);
		$criteria->compare('TransactionDate',$this->TransactionDate,true);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('KptConvo_Nationality',$this->KptConvo_Nationality);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblnationality the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
