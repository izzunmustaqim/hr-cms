<?php

/**
 * This is the model class for table "tblhod".
 *
 * The followings are the available columns in table 'tblhod':
 * @property integer $HodId
 * @property string $HodDesc
 * @property integer $UserId
 * @property integer $StatusId
 * @property string $TransactionTime
 * @property integer $StaffId
 */
class Tblhod extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HodDesc, UserId, StatusId, TransactionTime, StaffId', 'required'),
			array('UserId, StatusId, StaffId', 'numerical', 'integerOnly'=>true),
			array('HodDesc', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('HodId, HodDesc, UserId, StatusId, TransactionTime, StaffId', 'safe', 'on'=>'search'),
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
			'HodId' => 'Hod',
			'HodDesc' => 'Hod Desc',
			'UserId' => 'User',
			'StatusId' => 'Status',
			'TransactionTime' => 'Transaction Time',
			'StaffId' => 'Staff',
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

		$criteria->compare('HodId',$this->HodId);
		$criteria->compare('HodDesc',$this->HodDesc,true);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('StatusId',$this->StatusId);
		$criteria->compare('TransactionTime',$this->TransactionTime,true);
		$criteria->compare('StaffId',$this->StaffId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblhod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $id
     * @return mixed
     * Return hod
     */
    public function getHod(){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tblhod th')
            ->join('tbluser tu', 'th.UserId = tu.UserId')
            ->queryAll();

        return $data;
    }
}
