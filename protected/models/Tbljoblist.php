<?php

/**
 * This is the model class for table "tbljoblist".
 *
 * The followings are the available columns in table 'tbljoblist':
 * @property integer $JobListId
 * @property integer $DepartmentId
 * @property integer $PositionId
 * @property integer $WorkingStatusId
 * @property integer $GenderId
 * @property string $BranchName
 * @property string $JobResponsibility
 * @property string $JobRequirements
 * @property string $CloseDate
 */
class Tbljoblist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbljoblist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepartmentId, PositionId, WorkingStatusId, GenderId', 'numerical', 'integerOnly'=>true),
			array('BranchName', 'length', 'max'=>100),
			array('JobResponsibility, JobRequirements', 'length', 'max'=>1000),
			array('CloseDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('JobListId, DepartmentId, PositionId, WorkingStatusId, GenderId, BranchName, JobResponsibility, JobRequirements, CloseDate', 'safe', 'on'=>'search'),
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
			'JobListId' => 'Job List',
			'DepartmentId' => 'Department',
			'PositionId' => 'Position',
			'WorkingStatusId' => 'Working Status',
			'GenderId' => 'Gender',
			'BranchName' => 'Branch Name',
			'JobResponsibility' => 'Job Responsibility',
			'JobRequirements' => 'Job Requirements',
			'CloseDate' => 'Close Date',
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

		$criteria->compare('JobListId',$this->JobListId);
		$criteria->compare('DepartmentId',$this->DepartmentId);
		$criteria->compare('PositionId',$this->PositionId);
		$criteria->compare('WorkingStatusId',$this->WorkingStatusId);
		$criteria->compare('GenderId',$this->GenderId);
		$criteria->compare('BranchName',$this->BranchName,true);
		$criteria->compare('JobResponsibility',$this->JobResponsibility,true);
		$criteria->compare('JobRequirements',$this->JobRequirements,true);
		$criteria->compare('CloseDate',$this->CloseDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tbljoblist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getJoblist(){

		//$StudentId = Yii::app()->user->getState('UserID');
		
		$sql="
		SELECT
		tbljoblist.JobListId,
		tbljoblist.JobResponsibility,
		tbljoblist.JobRequirements,
		tbljoblist.CloseDate,
		tbldepartment.DepartmentDesc,
		tblposition.PositionName,
		tblworkingstatus.WorkingStatusDesc,
		tblgender.GenderName,
		tbluser.FullName,
		tbljoblist.StatusId
		FROM
		tbljoblist
		INNER JOIN tbldepartment ON tbljoblist.DepartmentId = tbldepartment.DepartmentId
		INNER JOIN tblposition ON tbljoblist.PositionId = tblposition.PositionId
		INNER JOIN tblworkingstatus ON tbljoblist.WorkingStatusId = tblworkingstatus.WorkingStatusId
		INNER JOIN tblgender ON tbljoblist.GenderId = tblgender.GenderId
		INNER JOIN tbluser ON tbljoblist.UserId = tbluser.UserId ";
		$data=Yii::app()->db->createCommand($sql)		 
		->queryAll();
		
            /*->select('*')
            ->from('tbl_studentfund tsf')
            ->join('tbl_fund tf', 'tf.fundid = tsf.fundid')
            ->where('tsf.ProgramRegId=:id', array(':id'=>$id))
            ->queryAll();*/

        return $data;
    }
	

}
