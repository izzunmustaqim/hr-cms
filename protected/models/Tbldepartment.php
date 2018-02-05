<?php

/**
 * This is the model class for table "tbldepartment".
 *
 * The followings are the available columns in table 'tbldepartment':
 * @property integer $DepartmentId
 * @property integer $DeptCatId
 * @property string $DepartmentDesc
 * @property integer $StatusId
 * @property integer $HODUserId
 * @property integer $UserId
 * @property string $TransactionDate
 */
class Tbldepartment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbldepartment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepartmentDesc, StatusId, UserId, TransactionDate', 'required'),
			array('DeptCatId, StatusId, HODUserId, UserId', 'numerical', 'integerOnly'=>true),
			array('DepartmentDesc', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('DepartmentId, DeptCatId, DepartmentDesc, StatusId, HODUserId, UserId, TransactionDate', 'safe', 'on'=>'search'),
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
			'DepartmentId' => 'Department',
			'DeptCatId' => 'Dept Cat',
			'DepartmentDesc' => 'Department Desc',
			'StatusId' => 'Status',
			'HODUserId' => 'Hoduser',
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

		$criteria->compare('DepartmentId',$this->DepartmentId);
		$criteria->compare('DeptCatId',$this->DeptCatId);
		$criteria->compare('DepartmentDesc',$this->DepartmentDesc,true);
		$criteria->compare('StatusId',$this->StatusId);
		$criteria->compare('HODUserId',$this->HODUserId);
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
	 * @return Tbldepartment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAcademicBreakdown(){

        $data = Yii::app()->db->createCommand()
            ->select('tdc.DeptCatDesc as DeptCatDesc,COUNT(*) as total')
            ->from('tbldepartment tdp')
            ->join('tbldepartmentcategory tdc', 'tdp.DeptCatId = tdc.DeptCatId')
            ->join('tbluser tu', 'tdp.DepartmentId = tu.DepartmentId')
            ->where('tu.StatusId=1')
            ->group('tdc.DeptCatId')
            ->queryAll();

        return $data;
    }

    public function getDepartmentcount(){


        $data = Yii::app()->db->createCommand()
            ->select('tdp.DepartmentDesc as DepartmentDesc,COUNT(*) as total')
            ->from('tbldepartment tdp')
            ->join('tbldepartmentcategory tdc', 'tdp.DeptCatId = tdc.DeptCatId')
            ->join('tbluser tu', 'tdp.DepartmentId = tu.DepartmentId')
            ->where('tu.StatusId=1')
            ->group('tdp.DepartmentId')
            ->order('tdp.DepartmentDesc','ASC')
            //->limit(5)
            ->queryAll();

        return $data;

    }


    // non academic count
    public function getDepartmentNonAcademicCount(){

        $data = Yii::app()->db->createCommand()
            ->select('tdp.DepartmentDesc as DepartmentDesc,COUNT(*) as total')
            ->from('tbldepartment tdp')
            ->join('tbldepartmentcategory tdc', 'tdp.DeptCatId = tdc.DeptCatId')
            ->join('tbluser tu', 'tdp.DepartmentId = tu.DepartmentId')
            ->where('tu.StatusId=1')
            ->andwhere('tdp.DeptCatId=2')
            ->group('tdp.DepartmentId')
            ->order('tdp.DepartmentDesc','ASC')
            //->limit(5)
            ->queryAll();

        return $data;

    }

    // academic count
    public function getDepartmentAcademicCount(){

        $data = Yii::app()->db->createCommand()
            ->select('tdp.DepartmentDesc as DepartmentDesc,COUNT(*) as total')
            ->from('tbldepartment tdp')
            ->join('tbldepartmentcategory tdc', 'tdp.DeptCatId = tdc.DeptCatId')
            ->join('tbluser tu', 'tdp.DepartmentId = tu.DepartmentId')
            ->where('tu.StatusId=1')
            ->andwhere('tdp.DeptCatId=1')
            ->group('tdp.DepartmentId')
            ->order('tdp.DepartmentDesc','ASC')
            //->limit(5)
            ->queryAll();

        return $data;

    }
	
	public function getDepartment(){
        $sql = "SELECT
	tbldepartment.DepartmentId,
	tbldepartment.DepartmentDesc,
	tbldepartment.DeptCatId
	FROM
	tbldepartment
	WHERE tbldepartment.ShowId = 1
	AND tbldepartment.StatusId = 1
	ORDER BY tbldepartment.DeptCatId,tbldepartment.DepartmentDesc ";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;

    }
}
