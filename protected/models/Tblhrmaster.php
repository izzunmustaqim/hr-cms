<?php

/**
 * This is the model class for table "tblhrmaster".
 *
 * The followings are the available columns in table 'tblhrmaster':
 * @property integer $id
 * @property string $code
 * @property string $description
 * @property integer $type
 * @property integer $job_status
 * @property integer $number
 * @property integer $status
 */
class Tblhrmaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblhrmaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, job_status, number, status', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>8),
			array('description', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, description, type, job_status, number, status', 'safe', 'on'=>'search'),
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
			'number' => 'Number',
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
		$criteria->compare('number',$this->number);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblhrmaster the static model class
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
    public function getRunningNo($id,$type){

        if(($type!=40)){

            $data = Yii::app()->db->createCommand()
                ->select('number')
                ->from('tblhrmaster')
                ->where('id=:id', array(':id'=>$id))
                ->queryAll();

        }else{

            $data = Yii::app()->db->createCommand()
                ->select('number')
                ->from('tblhrmaster t')
                ->where('id=:id and type=:type', array(':id'=>$id,':type'=>$type))
                ->queryAll();
        }

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     * Return nothing, update value
     */
    public function updateRunningNo($id,$add){

        $add = $add + 1;
        $data = array("number" => $add);

        $update = Yii::app()->db->createCommand()->update('tblhrmaster', $data, 'id=:id', array(':id'=>$id));
    }

    /**
     * @param $id
     * @return mixed
     * Return type name
     */
    public function getType($id){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tblhrmaster')
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
            ->from('tblhrmaster')
            ->where('id=:id', array(':id'=>$id))
            ->queryAll();

        foreach($data as $data){
            echo $data['code'];
        }

    }
	
    public function getLetter(){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tblhrmaster thm')
			->where('thm.status=1')
			->order('thm.code,thm.type')
            ->queryAll();

        return $data;
    }

    
}
