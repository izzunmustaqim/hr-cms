<?php

/**
 * This is the model class for table "tblcountry".
 *
 * The followings are the available columns in table 'tblcountry':
 * @property integer $CountryId
 * @property string $CountryName
 * @property string $CountryCode
 * @property string $Ifms_Code
 * @property integer $CountryNo
 * @property integer $StatusId
 * @property integer $KptConvo_Country
 */
class Tblcountry extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblcountry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CountryName, CountryCode, Ifms_Code, CountryNo', 'required'),
			array('CountryNo, StatusId, KptConvo_Country', 'numerical', 'integerOnly'=>true),
			array('CountryName', 'length', 'max'=>50),
			array('CountryCode', 'length', 'max'=>3),
			array('Ifms_Code', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CountryId, CountryName, CountryCode, Ifms_Code, CountryNo, StatusId, KptConvo_Country', 'safe', 'on'=>'search'),
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
			'CountryId' => 'Country',
			'CountryName' => 'Country Name',
			'CountryCode' => 'Country Code',
			'Ifms_Code' => 'Ifms Code',
			'CountryNo' => 'Country No',
			'StatusId' => 'Status',
			'KptConvo_Country' => 'Kpt Convo Country',
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

		$criteria->compare('CountryId',$this->CountryId);
		$criteria->compare('CountryName',$this->CountryName,true);
		$criteria->compare('CountryCode',$this->CountryCode,true);
		$criteria->compare('Ifms_Code',$this->Ifms_Code,true);
		$criteria->compare('CountryNo',$this->CountryNo);
		$criteria->compare('StatusId',$this->StatusId);
		$criteria->compare('KptConvo_Country',$this->KptConvo_Country);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblcountry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
