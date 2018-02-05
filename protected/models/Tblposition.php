<?php

/**
 * This is the model class for table "tblposition".
 *
 * The followings are the available columns in table 'tblposition':
 * @property integer $PositionId
 * @property string $PositionName
 * @property integer $PositionGradeId
 * @property integer $UserId
 * @property string $TransactionDate
 */
class Tblposition extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblposition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PositionName, PositionGradeId, UserId, TransactionDate', 'required'),
			array('PositionGradeId, UserId', 'numerical', 'integerOnly'=>true),
			array('PositionName', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PositionId, PositionName, PositionGradeId, UserId, TransactionDate', 'safe', 'on'=>'search'),
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
			'PositionId' => 'Position',
			'PositionName' => 'Position Name',
			'PositionGradeId' => 'Position Grade',
			'UserId' => 'User',
			'TransactionDate' => 'Transaction Date',
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

		$criteria->compare('PositionId',$this->PositionId);
		$criteria->compare('PositionName',$this->PositionName,true);
		$criteria->compare('PositionGradeId',$this->PositionGradeId);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('TransactionDate',$this->TransactionDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblposition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $id
     * @return mixed
     * Return position with head name
     */
    public function getPosition(){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tblposition tp')
            ->join('tblpositiongrade tpg', 'tp.PositionGradeId = tpg.PositionGradeId')
            ->queryAll();

        return $data;
    }
}
