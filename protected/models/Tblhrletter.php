<?php

/**
 * This is the model class for table "tblhrletter".
 *
 * The followings are the available columns in table 'tblhrletter':
 * @property integer $id
 * @property string $code
 * @property string $description
 * @property integer $type
 * @property integer $job_status
 * @property integer $status
 */
class Tblhrletter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhrletter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, job_status, status', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>4),
			array('description', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, description, type, job_status, status', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'description' => 'Description',
			'type' => 'Type',
			'job_status' => 'Job Status',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('job_status',$this->job_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblhrletter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $id
     * @return mixed
     * Return type name
     */
    public function getType($id){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tblhrletter')
            ->where('id=:id', array(':id'=>$id))
            ->queryAll();

        foreach($data as $data){
            echo $data['code'];/*echo " - ";if($data['type']==1) { echo "Academic";} else { echo "Non-Academic";};*/
        }

    }

    /**
     * @param $id
     * @return mixed
     * Return type name
     */
    public function getPrintcode($id){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tblhrletter')
            ->where('id=:id', array(':id'=>$id))
            ->queryAll();

        foreach($data as $data){
            echo $data['code'];
        }

    }
}
