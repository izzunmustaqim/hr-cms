<?php

/**
 * This is the model class for table "applications_record".
 *
 * The followings are the available columns in table 'applications_record':
 * @property integer $id
 * @property string $date_apply
 * @property string $date
 * @property integer $application_id
 * @property integer $type_id
 * @property string $ref_no
 * @property string $amount
 * @property integer $status
 */
class ApplicationsRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'applications_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, type_id, status', 'numerical', 'integerOnly'=>true),
			array('ref_no', 'length', 'max'=>30),
			array('amount', 'length', 'max'=>10),
			array('date_apply, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_apply, date, application_id, type_id, ref_no, amount, status', 'safe', 'on'=>'search'),
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
			'date_apply' => 'Date Apply',
			'date' => 'Date',
			'application_id' => 'Application',
			'type_id' => 'Type',
			'ref_no' => 'Ref No',
			'amount' => 'Amount',
			'status' => 'Status',
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
		$criteria->compare('date_apply',$this->date_apply,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('application_id',$this->application_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('ref_no',$this->ref_no,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationsRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
