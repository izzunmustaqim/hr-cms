<?php

/**
 * This is the model class for table "tblworkingstatus".
 *
 * The followings are the available columns in table 'tblworkingstatus':
 * @property integer $WorkingStatusId
 * @property string $WorkingStatusDesc
 * @property integer $UserId
 * @property string $TransactionDate
 */
class Tblworkingstatus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblworkingstatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('WorkingStatusDesc, UserId, TransactionDate', 'required'),
			array('UserId', 'numerical', 'integerOnly'=>true),
			array('WorkingStatusDesc', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('WorkingStatusId, WorkingStatusDesc, UserId, TransactionDate', 'safe', 'on'=>'search'),
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
			'WorkingStatusId' => 'Working Status',
			'WorkingStatusDesc' => 'Working Status Desc',
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

		$criteria->compare('WorkingStatusId',$this->WorkingStatusId);
		$criteria->compare('WorkingStatusDesc',$this->WorkingStatusDesc,true);
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
	 * @return Tblworkingstatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getStaffBreakdown(){

        $data = Yii::app()->db->createCommand()
            ->select('tws.WorkingStatusDesc as WorkingStatusDesc, count(*) as total')
            ->from('tblworkingstatus tws')
            ->join('tbluser tu', 'tws.WorkingStatusId = tu.WorkingStatusId')
            ->where('tu.StatusId=1')
            ->group('tws.WorkingStatusId')
            ->queryAll();

        return $data;
    }
	
	public function getEmploymentType(){
        $sql = "SELECT
		tblworkingstatus.WorkingStatusId,
		tblworkingstatus.WorkingStatusDesc
		FROM
		tblworkingstatus
		WHERE tblworkingstatus.ShowId = 1";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;

    }
	
	

}
