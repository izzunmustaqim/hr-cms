<?php

/**
 * This is the model class for table "itemlist_due".
 *
 * The followings are the available columns in table 'itemlist_due':
 * @property integer $id
 * @property string $date
 * @property string $due_date
 * @property integer $type_id
 * @property integer $applications_id
 * @property string $amount
 * @property integer $status
 */
class ItemlistDue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'itemlist_due';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id, applications_id, status', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>10),
			array('date, due_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date, due_date, type_id, applications_id, amount, status', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'due_date' => 'Due Date',
			'type_id' => 'Type',
			'applications_id' => 'Applications',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('applications_id',$this->applications_id);
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
	 * @return ItemlistDue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $id
     * @return mixed
     * Return itemlist data
     */
    public function getItemlistdueyear($id,$type,$month,$year){

        $sql = "SELECT * FROM `itemlist_due` WHERE `type_id`=$type and `applications_id`=$id and
        MONTH(`due_date`)=$month and YEAR(`due_date`)=$year";
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     * Return itemlist data
     */
    public function getItemlistdueyearextra($id,$month,$year){

        $sql = "SELECT * FROM `itemlist_due` WHERE  `applications_id`=$id and
        MONTH(`due_date`)=$month and YEAR(`due_date`)=$year";
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        return $data;
    }
}
