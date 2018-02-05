<?php

/**
 * This is the model class for table "tblrace".
 *
 * The followings are the available columns in table 'tblrace':
 * @property integer $RaceId
 * @property string $RaceName
 * @property string $Ifms_Code
 * @property string $Ifms_Desc
 * @property string $TransactionDate
 * @property integer $UserId
 * @property integer $KptConvo_Race
 */
class Tblrace extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblrace';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RaceName, TransactionDate, KptConvo_Race', 'required'),
			array('UserId, KptConvo_Race', 'numerical', 'integerOnly'=>true),
			array('RaceName, Ifms_Desc', 'length', 'max'=>30),
			array('Ifms_Code', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('RaceId, RaceName, Ifms_Code, Ifms_Desc, TransactionDate, UserId, KptConvo_Race', 'safe', 'on'=>'search'),
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
			'RaceId' => 'Race',
			'RaceName' => 'Race Name',
			'Ifms_Code' => 'Ifms Code',
			'Ifms_Desc' => 'Ifms Desc',
			'TransactionDate' => 'Transaction Date',
			'UserId' => 'User',
			'KptConvo_Race' => 'Kpt Convo Race',
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

		$criteria->compare('RaceId',$this->RaceId);
		$criteria->compare('RaceName',$this->RaceName,true);
		$criteria->compare('Ifms_Code',$this->Ifms_Code,true);
		$criteria->compare('Ifms_Desc',$this->Ifms_Desc,true);
		$criteria->compare('TransactionDate',$this->TransactionDate,true);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('KptConvo_Race',$this->KptConvo_Race);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblrace the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
