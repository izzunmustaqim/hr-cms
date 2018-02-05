<?php

/**
 * This is the model class for table "tblprogram".
 *
 * The followings are the available columns in table 'tblprogram':
 * @property integer $ProgramId
 * @property string $ProgramCode
 * @property string $ProgramName
 * @property string $ProgramCode2
 * @property string $ProgramName2
 * @property string $ProgramCode3
 * @property string $ProgramName3
 * @property integer $FacultyId
 * @property integer $SchoolId
 * @property integer $ProgramType
 * @property integer $ProgramFromId
 * @property integer $ProgramStatus
 * @property string $ProgramContent
 * @property double $MinCreditHours
 * @property double $ActCreditHours
 * @property double $StudyDurationFT
 * @property double $StudyDurationPT
 * @property integer $AcadCalTypeId
 * @property integer $NoOfSem
 * @property string $MQACode
 * @property string $MQAStatus
 * @property string $MQAExpDate
 * @property double $FullPaymentFT
 * @property double $FullPaymentPT
 * @property double $RepeatSubjFee
 * @property double $CreditExamptionFee
 * @property double $TransferCreditFee
 * @property double $ReferralFee
 * @property string $Syllubes
 * @property string $ProgramFeeDoc
 * @property string $TransactionDate
 * @property integer $UserId
 * @property string $EMSProgramCode
 * @property string $ProgramDesc
 * @property string $MQRCode
 * @property string $MQRExpDate
 * @property integer $ProgSubFieldId
 * @property integer $LearningMethodId
 * @property integer $NecDetailId
 * @property integer $PracticalStatusId
 * @property integer $ProgMajorId
 * @property integer $HideId
 * @property integer $ReportGroup
 * @property string $Ifms_Code
 * @property string $Ifms_Desc
 * @property string $ExtensionDateFrom
 * @property string $ExtensionDateTo
 * @property string $StudenNewtIntakePermision
 */
class Tblprogram extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblprogram';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ProgramCode, ProgramName, ProgramCode2, ProgramCode3, ProgramName3, FacultyId, SchoolId, ProgramType, ProgramFromId, ProgramStatus, ActCreditHours, StudyDurationFT, StudyDurationPT, AcadCalTypeId, MQAStatus, Syllubes, ProgramFeeDoc, TransactionDate, EMSProgramCode, ProgramDesc, ProgSubFieldId, LearningMethodId, NecDetailId, PracticalStatusId', 'required'),
			array('FacultyId, SchoolId, ProgramType, ProgramFromId, ProgramStatus, AcadCalTypeId, NoOfSem, UserId, ProgSubFieldId, LearningMethodId, NecDetailId, PracticalStatusId, ProgMajorId, HideId, ReportGroup', 'numerical', 'integerOnly'=>true),
			array('MinCreditHours, ActCreditHours, StudyDurationFT, StudyDurationPT, FullPaymentFT, FullPaymentPT, RepeatSubjFee, CreditExamptionFee, TransferCreditFee, ReferralFee', 'numerical'),
			array('ProgramCode, ProgramCode2, ProgramCode3', 'length', 'max'=>25),
			array('ProgramName, ProgramName2, ProgramName3, ProgramDesc', 'length', 'max'=>255),
			array('MQACode, MQAStatus, MQRCode, StudenNewtIntakePermision', 'length', 'max'=>50),
			array('EMSProgramCode', 'length', 'max'=>55),
			array('Ifms_Code', 'length', 'max'=>15),
			array('Ifms_Desc', 'length', 'max'=>150),
			array('ProgramContent, MQAExpDate, MQRExpDate, ExtensionDateFrom, ExtensionDateTo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ProgramId, ProgramCode, ProgramName, ProgramCode2, ProgramName2, ProgramCode3, ProgramName3, FacultyId, SchoolId, ProgramType, ProgramFromId, ProgramStatus, ProgramContent, MinCreditHours, ActCreditHours, StudyDurationFT, StudyDurationPT, AcadCalTypeId, NoOfSem, MQACode, MQAStatus, MQAExpDate, FullPaymentFT, FullPaymentPT, RepeatSubjFee, CreditExamptionFee, TransferCreditFee, ReferralFee, Syllubes, ProgramFeeDoc, TransactionDate, UserId, EMSProgramCode, ProgramDesc, MQRCode, MQRExpDate, ProgSubFieldId, LearningMethodId, NecDetailId, PracticalStatusId, ProgMajorId, HideId, ReportGroup, Ifms_Code, Ifms_Desc, ExtensionDateFrom, ExtensionDateTo, StudenNewtIntakePermision', 'safe', 'on'=>'search'),
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
			'ProgramId' => 'Program',
			'ProgramCode' => 'Program Code',
			'ProgramName' => 'Program Name',
			'ProgramCode2' => 'Program Code2',
			'ProgramName2' => 'Program Name2',
			'ProgramCode3' => 'Program Code3',
			'ProgramName3' => 'Program Name3',
			'FacultyId' => 'Faculty',
			'SchoolId' => 'School',
			'ProgramType' => 'Program Type',
			'ProgramFromId' => 'Program From',
			'ProgramStatus' => 'Program Status',
			'ProgramContent' => 'Program Content',
			'MinCreditHours' => 'Min Credit Hours',
			'ActCreditHours' => 'Act Credit Hours',
			'StudyDurationFT' => 'Study Duration Ft',
			'StudyDurationPT' => 'Study Duration Pt',
			'AcadCalTypeId' => 'Acad Cal Type',
			'NoOfSem' => 'No Of Sem',
			'MQACode' => 'Mqacode',
			'MQAStatus' => 'Mqastatus',
			'MQAExpDate' => 'Mqaexp Date',
			'FullPaymentFT' => 'Full Payment Ft',
			'FullPaymentPT' => 'Full Payment Pt',
			'RepeatSubjFee' => 'Repeat Subj Fee',
			'CreditExamptionFee' => 'Credit Examption Fee',
			'TransferCreditFee' => 'Transfer Credit Fee',
			'ReferralFee' => 'Referral Fee',
			'Syllubes' => 'Syllubes',
			'ProgramFeeDoc' => 'Program Fee Doc',
			'TransactionDate' => 'Transaction Date',
			'UserId' => 'User',
			'EMSProgramCode' => 'Emsprogram Code',
			'ProgramDesc' => 'Program Desc',
			'MQRCode' => 'Mqrcode',
			'MQRExpDate' => 'Mqrexp Date',
			'ProgSubFieldId' => 'Prog Sub Field',
			'LearningMethodId' => 'Learning Method',
			'NecDetailId' => 'Nec Detail',
			'PracticalStatusId' => 'Practical Status',
			'ProgMajorId' => 'Prog Major',
			'HideId' => 'Hide',
			'ReportGroup' => 'Report Group',
			'Ifms_Code' => 'Ifms Code',
			'Ifms_Desc' => 'Ifms Desc',
			'ExtensionDateFrom' => 'Extension Date From',
			'ExtensionDateTo' => 'Extension Date To',
			'StudenNewtIntakePermision' => 'Studen Newt Intake Permision',
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

		$criteria->compare('ProgramId',$this->ProgramId);
		$criteria->compare('ProgramCode',$this->ProgramCode,true);
		$criteria->compare('ProgramName',$this->ProgramName,true);
		$criteria->compare('ProgramCode2',$this->ProgramCode2,true);
		$criteria->compare('ProgramName2',$this->ProgramName2,true);
		$criteria->compare('ProgramCode3',$this->ProgramCode3,true);
		$criteria->compare('ProgramName3',$this->ProgramName3,true);
		$criteria->compare('FacultyId',$this->FacultyId);
		$criteria->compare('SchoolId',$this->SchoolId);
		$criteria->compare('ProgramType',$this->ProgramType);
		$criteria->compare('ProgramFromId',$this->ProgramFromId);
		$criteria->compare('ProgramStatus',$this->ProgramStatus);
		$criteria->compare('ProgramContent',$this->ProgramContent,true);
		$criteria->compare('MinCreditHours',$this->MinCreditHours);
		$criteria->compare('ActCreditHours',$this->ActCreditHours);
		$criteria->compare('StudyDurationFT',$this->StudyDurationFT);
		$criteria->compare('StudyDurationPT',$this->StudyDurationPT);
		$criteria->compare('AcadCalTypeId',$this->AcadCalTypeId);
		$criteria->compare('NoOfSem',$this->NoOfSem);
		$criteria->compare('MQACode',$this->MQACode,true);
		$criteria->compare('MQAStatus',$this->MQAStatus,true);
		$criteria->compare('MQAExpDate',$this->MQAExpDate,true);
		$criteria->compare('FullPaymentFT',$this->FullPaymentFT);
		$criteria->compare('FullPaymentPT',$this->FullPaymentPT);
		$criteria->compare('RepeatSubjFee',$this->RepeatSubjFee);
		$criteria->compare('CreditExamptionFee',$this->CreditExamptionFee);
		$criteria->compare('TransferCreditFee',$this->TransferCreditFee);
		$criteria->compare('ReferralFee',$this->ReferralFee);
		$criteria->compare('Syllubes',$this->Syllubes,true);
		$criteria->compare('ProgramFeeDoc',$this->ProgramFeeDoc,true);
		$criteria->compare('TransactionDate',$this->TransactionDate,true);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('EMSProgramCode',$this->EMSProgramCode,true);
		$criteria->compare('ProgramDesc',$this->ProgramDesc,true);
		$criteria->compare('MQRCode',$this->MQRCode,true);
		$criteria->compare('MQRExpDate',$this->MQRExpDate,true);
		$criteria->compare('ProgSubFieldId',$this->ProgSubFieldId);
		$criteria->compare('LearningMethodId',$this->LearningMethodId);
		$criteria->compare('NecDetailId',$this->NecDetailId);
		$criteria->compare('PracticalStatusId',$this->PracticalStatusId);
		$criteria->compare('ProgMajorId',$this->ProgMajorId);
		$criteria->compare('HideId',$this->HideId);
		$criteria->compare('ReportGroup',$this->ReportGroup);
		$criteria->compare('Ifms_Code',$this->Ifms_Code,true);
		$criteria->compare('Ifms_Desc',$this->Ifms_Desc,true);
		$criteria->compare('ExtensionDateFrom',$this->ExtensionDateFrom,true);
		$criteria->compare('ExtensionDateTo',$this->ExtensionDateTo,true);
		$criteria->compare('StudenNewtIntakePermision',$this->StudenNewtIntakePermision,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tblprogram the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getProgramList(){

        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tblprogram')
            ->where('ProgramStatus = 1')
            ->group('ProgramName3')
			->order('ProgramName3')
            ->queryAll();

        return $data;
    }
}
