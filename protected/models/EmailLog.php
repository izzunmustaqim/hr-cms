<?php

/**
 * This is the model class for table "email_log".
 *
 * The followings are the available columns in table 'email_log':
 * @property integer $id
 * @property string $date
 * @property integer $application_id
 * @property integer $category_id
 * @property integer $type_id
 * @property string $month
 * @property integer $year
 * @property integer $status
 */
class EmailLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, category_id, type_id, year, status', 'numerical', 'integerOnly'=>true),
			array('month', 'length', 'max'=>10),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date, application_id, category_id, type_id, month, year, status', 'safe', 'on'=>'search'),
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
			'application_id' => 'Application',
			'category_id' => 'Category',
			'type_id' => 'Type',
			'month' => 'Month',
			'year' => 'Year',
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
		$criteria->compare('application_id',$this->application_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmailLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $id
     * @return mixed
     * Return evaluation data
     */
    public function getLog($id,$type){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('email_log')
            ->where('application_id=:id', array(':id'=>$id))
            ->andWhere('type_id=:type', array(':type'=>$type))
            ->queryAll();

        return $data;
    }
}
