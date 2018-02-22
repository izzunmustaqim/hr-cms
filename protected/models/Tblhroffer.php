<?php

/**
 * This is the model class for table "tblhroffer".
 *
 * The followings are the available columns in table 'tblhroffer':
 * @property integer $id
 * @property integer $offer_id
 * @property integer $offer_type
 * @property string $date_offer
 * @property string $date_offer_end
 * @property string $date_contract_start
 * @property string $date_contract_end
 * @property integer $duration_id
 * @property string $duration_extra
 * @property integer $duration_hours
 * @property integer $duration_day
 * @property integer $contract_id
 * @property string $title
 * @property string $name
 * @property string $passport_no
 * @property string $short_name
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $city
 * @property string $state
 * @property integer $postcode
 * @property integer $country_id
 * @property integer $position_id
 * @property integer $unitid
 * @property integer $department_id
 * @property string $program_id
 * @property integer $program_id2
 * @property integer $program_id3
 * @property integer $program_id4
 * @property string $subject_id1
 * @property string $subject_id2
 * @property string $subject_id3
 * @property string $subject_id4
 * @property string $subject_id5
 * @property string $classcode_1
 * @property string $classcode_2
 * @property string $classcode_3
 * @property string $classcode_4
 * @property string $classcode_5
 * @property string $external_title
 * @property string $external_extra
 * @property string $advisory_1
 * @property string $advisory_2
 * @property string $advisory_3
 * @property string $report_to_id
 * @property string $salary
 * @property string $date_offer_expired
 * @property string $date_created
 * @property string $date_updated
 * @property string $tech_semester
 * @property integer $user_id
 * @property string $service1
 * @property string $service2
 * @property string $service3
 * @property string $service4
 * @property string $service5
 * @property string $letter_title
 * @property integer $status
 * @property string $cc_name
 * @property string $cc_position
 * @property string $cc_address1
 * @property string $cc_address2
 * @property string $cc_postcode
 * @property string $cc_city
 * @property string $cc_state
 * @property string $sup_contact
 * @property string $sup_email
 * @property string $student_name
 * @property string $student_name2
 * @property string $student_name3
 * @property string $student_name4
 * @property string $student_name5
 * @property string $student_id
 * @property string $student_id2
 * @property string $student_id3
 * @property string $student_id4
 * @property string $student_id5
 * @property string $sup_stage1
 * @property string $sup_stage2
 * @property string $sup_stage3
 * @property string $sup_stage4
 * @property string $sup_stage5
 * @property string $sup_stage6
 * @property string $sup_stage7
 * @property integer $prog_lvlid
 * @property integer $sup_hours
 * @property string $sup_rate
 */
class Tblhroffer extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblhroffer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('offer_id, offer_type, duration_id, duration_hours, duration_day, contract_id, postcode, country_id, position_id, unitid, department_id, program_id2, program_id3, program_id4, user_id, status, prog_lvlid, sup_hours', 'numerical', 'integerOnly' => true),
            array('title, program_id, classcode_1, classcode_2, classcode_3, classcode_4, classcode_5, tech_semester', 'length', 'max' => 50),
            array('name, subject_id1, subject_id2, subject_id3, subject_id4, subject_id5, report_to_id, service1, service2, service3, service4, service5, letter_title, cc_name, cc_position, cc_address1, cc_address2, cc_postcode, cc_city, cc_state, student_name, student_name2, student_name3, student_name4, student_name5', 'length', 'max' => 200),
//            array('passport_no', 'length', 'max' => 20),
            array('short_name, city, state, sup_contact, sup_email, student_id, student_id2, student_id3, student_id4, student_id5', 'length', 'max' => 100),
            array('address1, address2, address3', 'length', 'max' => 255),
            array('salary, sup_stage1, sup_stage2, sup_stage3, sup_stage4, sup_stage5, sup_stage6, sup_stage7, sup_rate', 'length', 'max' => 10),
            array('date_offer, date_offer_end, date_contract_start, date_contract_end, duration_extra, external_title, external_extra, advisory_1, advisory_2, advisory_3, date_offer_expired, date_created, date_updated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, offer_id, offer_type, date_offer, date_offer_end, date_contract_start, date_contract_end, duration_id, duration_extra, duration_hours, duration_day, contract_id, title, name, passport_num, passport_no, short_name, address1, address2, address3, city, state, postcode, country_id, position_id, unitid, department_id, program_id, program_id2, program_id3, program_id4, subject_id1, subject_id2, subject_id3, subject_id4, subject_id5, classcode_1, classcode_2, classcode_3, classcode_4, classcode_5, external_title, external_extra, advisory_1, advisory_2, advisory_3, report_to_id, salary, date_offer_expired, date_created, date_updated, tech_semester, user_id, service1, service2, service3, service4, service5, letter_title, status, cc_name, cc_position, cc_address1, cc_address2, cc_postcode, cc_city, cc_state, sup_contact, sup_email, student_name, student_name2, student_name3, student_name4, student_name5, student_id, student_id2, student_id3, student_id4, student_id5, sup_stage1, sup_stage2, sup_stage3, sup_stage4, sup_stage5, sup_stage6, sup_stage7, prog_lvlid, sup_hours, sup_rate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'offer_id' => 'Offer',
            'offer_type' => 'Offer Type',
            'date_offer' => 'Date Offer',
            'date_offer_end' => 'Date Offer End',
            'date_contract_start' => 'Date Contract Start',
            'date_contract_end' => 'Date Contract End',
            'duration_id' => 'Duration',
            'duration_extra' => 'Duration Extra',
            'duration_hours' => 'Duration Hours',
            'duration_day' => 'Duration Day',
            'contract_id' => 'Contract',
            'title' => 'Title',
            'name' => 'Name',
//            'passport_no' => 'Passport No',
            'short_name' => 'Short Name',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'address3' => 'Address3',
            'city' => 'City',
            'state' => 'State',
            'postcode' => 'Postcode',
            'country_id' => 'Country',
            'position_id' => 'Position',
            'unitid' => 'Unitid',
            'department_id' => 'Department',
            'program_id' => 'Program',
            'program_id2' => 'Program Id2',
            'program_id3' => 'Program Id3',
            'program_id4' => 'Program Id4',
            'subject_id1' => 'Subject Id1',
            'subject_id2' => 'Subject Id2',
            'subject_id3' => 'Subject Id3',
            'subject_id4' => 'Subject Id4',
            'subject_id5' => 'Subject Id5',
            'classcode_1' => 'Classcode 1',
            'classcode_2' => 'Classcode 2',
            'classcode_3' => 'Classcode 3',
            'classcode_4' => 'Classcode 4',
            'classcode_5' => 'Classcode 5',
            'external_title' => 'External Title',
            'external_extra' => 'External Extra',
            'advisory_1' => 'Advisory 1',
            'advisory_2' => 'Advisory 2',
            'advisory_3' => 'Advisory 3',
            'report_to_id' => 'Report To',
            'salary' => 'Salary',
            'date_offer_expired' => 'Date Offer Expired',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'tech_semester' => 'Tech Semester',
            'user_id' => 'User',
            'service1' => 'Service1',
            'service2' => 'Service2',
            'service3' => 'Service3',
            'service4' => 'Service4',
            'service5' => 'Service5',
            'letter_title' => 'Letter Title',
            'status' => 'Status',
            'cc_name' => 'Cc Name',
            'cc_position' => 'Cc Position',
            'cc_address1' => 'Cc Address1',
            'cc_address2' => 'Cc Address2',
            'cc_postcode' => 'Cc Postcode',
            'cc_city' => 'Cc City',
            'cc_state' => 'Cc State',
            'sup_contact' => 'Sup Contact',
            'sup_email' => 'Sup Email',
            'student_name' => 'Student Name',
            'student_name2' => 'Student Name2',
            'student_name3' => 'Student Name3',
            'student_name4' => 'Student Name4',
            'student_name5' => 'Student Name5',
            'student_id' => 'Student',
            'student_id2' => 'Student Id2',
            'student_id3' => 'Student Id3',
            'student_id4' => 'Student Id4',
            'student_id5' => 'Student Id5',
            'sup_stage1' => 'Sup Stage1',
            'sup_stage2' => 'Sup Stage2',
            'sup_stage3' => 'Sup Stage3',
            'sup_stage4' => 'Sup Stage4',
            'sup_stage5' => 'Sup Stage5',
            'sup_stage6' => 'Sup Stage6',
            'sup_stage7' => 'Sup Stage7',
            'prog_lvlid' => 'Prog Lvlid',
            'sup_hours' => 'Sup Hours',
            'sup_rate' => 'Sup Rate',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('offer_id', $this->offer_id);
        $criteria->compare('offer_type', $this->offer_type);
        $criteria->compare('date_offer', $this->date_offer, true);
        $criteria->compare('date_offer_end', $this->date_offer_end, true);
        $criteria->compare('date_contract_start', $this->date_contract_start, true);
        $criteria->compare('date_contract_end', $this->date_contract_end, true);
        $criteria->compare('duration_id', $this->duration_id);
        $criteria->compare('duration_extra', $this->duration_extra, true);
        $criteria->compare('duration_hours', $this->duration_hours);
        $criteria->compare('duration_day', $this->duration_day);
        $criteria->compare('contract_id', $this->contract_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('passport_num', $this->passport_num, true);
        $criteria->compare('passport_no', $this->passport_no, true);
        $criteria->compare('short_name', $this->short_name, true);
        $criteria->compare('address1', $this->address1, true);
        $criteria->compare('address2', $this->address2, true);
        $criteria->compare('address3', $this->address3, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('postcode', $this->postcode);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('position_id', $this->position_id);
        $criteria->compare('unitid', $this->unitid);
        $criteria->compare('department_id', $this->department_id);
        $criteria->compare('program_id', $this->program_id, true);
        $criteria->compare('program_id2', $this->program_id2);
        $criteria->compare('program_id3', $this->program_id3);
        $criteria->compare('program_id4', $this->program_id4);
        $criteria->compare('subject_id1', $this->subject_id1, true);
        $criteria->compare('subject_id2', $this->subject_id2, true);
        $criteria->compare('subject_id3', $this->subject_id3, true);
        $criteria->compare('subject_id4', $this->subject_id4, true);
        $criteria->compare('subject_id5', $this->subject_id5, true);
        $criteria->compare('classcode_1', $this->classcode_1, true);
        $criteria->compare('classcode_2', $this->classcode_2, true);
        $criteria->compare('classcode_3', $this->classcode_3, true);
        $criteria->compare('classcode_4', $this->classcode_4, true);
        $criteria->compare('classcode_5', $this->classcode_5, true);
        $criteria->compare('external_title', $this->external_title, true);
        $criteria->compare('external_extra', $this->external_extra, true);
        $criteria->compare('advisory_1', $this->advisory_1, true);
        $criteria->compare('advisory_2', $this->advisory_2, true);
        $criteria->compare('advisory_3', $this->advisory_3, true);
        $criteria->compare('report_to_id', $this->report_to_id, true);
        $criteria->compare('salary', $this->salary, true);
        $criteria->compare('date_offer_expired', $this->date_offer_expired, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('tech_semester', $this->tech_semester, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('service1', $this->service1, true);
        $criteria->compare('service2', $this->service2, true);
        $criteria->compare('service3', $this->service3, true);
        $criteria->compare('service4', $this->service4, true);
        $criteria->compare('service5', $this->service5, true);
        $criteria->compare('letter_title', $this->letter_title, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cc_name', $this->cc_name, true);
        $criteria->compare('cc_position', $this->cc_position, true);
        $criteria->compare('cc_address1', $this->cc_address1, true);
        $criteria->compare('cc_address2', $this->cc_address2, true);
        $criteria->compare('cc_postcode', $this->cc_postcode, true);
        $criteria->compare('cc_city', $this->cc_city, true);
        $criteria->compare('cc_state', $this->cc_state, true);
        $criteria->compare('sup_contact', $this->sup_contact, true);
        $criteria->compare('sup_email', $this->sup_email, true);
        $criteria->compare('student_name', $this->student_name, true);
        $criteria->compare('student_name2', $this->student_name2, true);
        $criteria->compare('student_name3', $this->student_name3, true);
        $criteria->compare('student_name4', $this->student_name4, true);
        $criteria->compare('student_name5', $this->student_name5, true);
        $criteria->compare('student_id', $this->student_id, true);
        $criteria->compare('student_id2', $this->student_id2, true);
        $criteria->compare('student_id3', $this->student_id3, true);
        $criteria->compare('student_id4', $this->student_id4, true);
        $criteria->compare('student_id5', $this->student_id5, true);
        $criteria->compare('sup_stage1', $this->sup_stage1, true);
        $criteria->compare('sup_stage2', $this->sup_stage2, true);
        $criteria->compare('sup_stage3', $this->sup_stage3, true);
        $criteria->compare('sup_stage4', $this->sup_stage4, true);
        $criteria->compare('sup_stage5', $this->sup_stage5, true);
        $criteria->compare('sup_stage6', $this->sup_stage6, true);
        $criteria->compare('sup_stage7', $this->sup_stage7, true);
        $criteria->compare('prog_lvlid', $this->prog_lvlid);
        $criteria->compare('sup_hours', $this->sup_hours);
        $criteria->compare('sup_rate', $this->sup_rate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tblhroffer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
