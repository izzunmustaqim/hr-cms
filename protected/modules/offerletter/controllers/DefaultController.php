<?php

class DefaultController extends Controller
{
    protected function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $user = Yii::app()->user;
        if($user->isGuest) {
            $this->redirect(Yii::app()->user->loginUrl);
            return false;
        }
        return true;

    }

    public function actionIndex()
    {
        $this->layout='//default/main_layout';
        $this->render('index');
    }

    public function actionAdd()
    {

        $id = Yii::app()->getRequest()->getParam('id');

        $this->layout='//default/main_layout';
        if (isset($_POST['submit'])){

            if($id==NULL){
                $model = new Tblhroffer();
            }else{
                $model = Tblhroffer::model()->findByPk($id);
            }
            $model->attributes = $_POST['Tblhroffer'];

		
            if ($model->validate()) {

                $running_no = Tblhrmaster::model()->getRunningNo($_POST['Tblhroffer']['offer_type'],$_POST['Tblhroffer']['offer_type']);

                $model->title = $_POST['Tblhroffer']['title'];
                $model->name = $_POST['Tblhroffer']['name'];
                $model->short_name = $_POST['Tblhroffer']['short_name'];
                $model->address1 = $_POST['Tblhroffer']['address1'];
                if($_POST['Tblhroffer']['address2']){
                    $model->address2 = $_POST['Tblhroffer']['address2'];
                }
				if($_POST['Tblhroffer']['address3']){
                    $model->address2 = $_POST['Tblhroffer']['address3'];
                }
                $model->city = $_POST['Tblhroffer']['city'];
                $model->state = $_POST['Tblhroffer']['state'];
                $model->postcode = $_POST['Tblhroffer']['postcode'];
                $model->country_id = $_POST['Tblhroffer']['country_id'];
                $model->offer_id = $running_no[0]['number'];
                $model->offer_type = $_POST['Tblhroffer']['offer_type'];
                $model->date_offer = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_offer']));
                if($_POST['Tblhroffer']['date_offer_end']!=NULL) {
                    $model->date_offer_end = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_offer_end']));
                }else{
                    $model->date_offer_end = NULL;
                }
                if($_POST['Tblhroffer']['date_contract_start']!=NULL){
                    $model->date_contract_start = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_contract_start']));
                }else{
                    $model->date_contract_start = NULL;
                }
                if($_POST['Tblhroffer']['date_contract_end']!=NULL){
                    $model->date_contract_end = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_contract_end']));
                }else{
                    $model->date_contract_end = NULL;
                }
                if($_POST['Tblhroffer']['contract_id']!=NULL){
                    $model->contract_id = $_POST['Tblhroffer']['contract_id'];
                }else{
                    $model->contract_id = NULL;
                }
                if($_POST['Tblhroffer']['duration_id']!=NULL){
                    $model->duration_id = $_POST['Tblhroffer']['duration_id'];
                }else{
                    $model->duration_id = NULL;
                }
                if($_POST['Tblhroffer']['program_id']!=NULL){
                    $model->program_id = $_POST['Tblhroffer']['program_id'];
                }else{
                    $model->program_id = NULL;
                }
                if($_POST['Tblhroffer']['program_id2']!=NULL){
                    $model->program_id2 = $_POST['Tblhroffer']['program_id2'];
                }else{
                    $model->program_id2 = NULL;
                }
                if($_POST['Tblhroffer']['program_id3']!=NULL){
                    $model->program_id3 = $_POST['Tblhroffer']['program_id3'];
                }else{
                    $model->program_id3 = NULL;
                }
                if($_POST['Tblhroffer']['program_id4']!=NULL){
                    $model->program_id4 = $_POST['Tblhroffer']['program_id4'];
                }else{
                    $model->program_id4 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id1']!=NULL){
                    $model->subject_id1 = $_POST['Tblhroffer']['subject_id1'];
                }else{
                    $model->subject_id1 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id2']!=NULL){
                    $model->subject_id2 = $_POST['Tblhroffer']['subject_id2'];
                }else{
                    $model->subject_id2 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id3']!=NULL){
                    $model->subject_id3 = $_POST['Tblhroffer']['subject_id3'];
                }else{
                    $model->subject_id3 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id4']!=NULL){
                    $model->subject_id4 = $_POST['Tblhroffer']['subject_id4'];
                }else{
                    $model->subject_id4 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id5']!=NULL){
                    $model->subject_id5 = $_POST['Tblhroffer']['subject_id5'];
                }else{
                    $model->subject_id5 = NULL;
                }
                if($_POST['Tblhroffer']['passport_no']!=NULL){
                    $model->passport_no = $_POST['Tblhroffer']['passport_no'];
                }else{
                    $model->passport_no = NULL;
                }
				 if($_POST['Tblhroffer']['classcode_1']!=NULL){
                    $model->classcode_1 = $_POST['Tblhroffer']['classcode_1'];
                }else{
                    $model->classcode_1 = NULL;
                }
				 if($_POST['Tblhroffer']['classcode_2']!=NULL){
                    $model->classcode_2 = $_POST['Tblhroffer']['classcode_2'];
                }else{
                    $model->classcode_2 = NULL;
                }
				if($_POST['Tblhroffer']['classcode_3']!=NULL){
                    $model->classcode_3 = $_POST['Tblhroffer']['classcode_3'];
                }else{
                    $model->classcode_3 = NULL;
                }
				if($_POST['Tblhroffer']['classcode_4']!=NULL){
                    $model->classcode_4 = $_POST['Tblhroffer']['classcode_4'];
                }else{
                    $model->classcode_4 = NULL;
                }
				if($_POST['Tblhroffer']['classcode_5']!=NULL){
                    $model->classcode_5 = $_POST['Tblhroffer']['classcode_5'];
                }else{
                    $model->classcode_5 = NULL;
                }
				
				 if($_POST['Tblhroffer']['service1']!=NULL){
                    $model->service1 = $_POST['Tblhroffer']['service1'];
                }else{
                    $model->service1 = NULL;
                }
				 if($_POST['Tblhroffer']['service2']!=NULL){
                    $model->service2 = $_POST['Tblhroffer']['service2'];
                }else{
                    $model->service2 = NULL;
                }
				if($_POST['Tblhroffer']['service3']!=NULL){
                    $model->service3 = $_POST['Tblhroffer']['service3'];
                }else{
                    $model->service3 = NULL;
                }
				if($_POST['Tblhroffer']['service4']!=NULL){
                    $model->service4 = $_POST['Tblhroffer']['service4'];
                }else{
                    $model->service4 = NULL;
                }
				if($_POST['Tblhroffer']['service5']!=NULL){
                    $model->service5 = $_POST['Tblhroffer']['service5'];
                }else{
                    $model->service5 = NULL;
                }
				$model->tech_semester = $_POST['Tblhroffer']['tech_semester'];
                $model->position_id = $_POST['Tblhroffer']['position_id'];
				
				if($_POST['Tblhroffer']['unitid']!=NULL){
                    $model->unitid = $_POST['Tblhroffer']['unitid'];
                }else{
                    $model->unitid = NULL;
                }
				//$model->unitid = $_POST['Tblhroffer']['unitid'];
                $model->department_id = $_POST['Tblhroffer']['department_id'];
                $model->report_to_id = $_POST['Tblhroffer']['report_to_id'];
                $model->salary = $_POST['Tblhroffer']['salary'];
				$model->duration_day = $_POST['Tblhroffer']['duration_day'];
				$model->duration_hours = $_POST['Tblhroffer']['duration_hours'];
				$model->letter_title = $_POST['Tblhroffer']['letter_title'];
                /*$model->date_created = date('Y-m-d H:i:s');*/
                $model->user_id = Yii::app()->user->getState('UserID');
				$model->cc_name = $_POST['Tblhroffer']['cc_name'];
				$model->cc_position = $_POST['Tblhroffer']['cc_position'];
				$model->cc_address1 = $_POST['Tblhroffer']['cc_address1'];
				$model->cc_address2 = $_POST['Tblhroffer']['cc_address2'];
				$model->cc_postcode = $_POST['Tblhroffer']['cc_postcode'];
				$model->cc_city = $_POST['Tblhroffer']['cc_city'];
				$model->cc_state = $_POST['Tblhroffer']['cc_state'];
				$model->sup_contact = $_POST['Tblhroffer']['sup_contact'];
				$model->sup_email = $_POST['Tblhroffer']['sup_email'];
				$model->student_name = $_POST['Tblhroffer']['student_name'];
				$model->student_id = $_POST['Tblhroffer']['student_id'];
				$model->student_name2 = $_POST['Tblhroffer']['student_name2'];
				$model->student_id2 = $_POST['Tblhroffer']['student_id2'];
				$model->student_name3 = $_POST['Tblhroffer']['student_name3'];
				$model->student_id3 = $_POST['Tblhroffer']['student_id3'];
				$model->student_name4 = $_POST['Tblhroffer']['student_name4'];
				$model->student_id4 = $_POST['Tblhroffer']['student_id4'];
				$model->student_name5 = $_POST['Tblhroffer']['student_name5'];
				$model->student_id5 = $_POST['Tblhroffer']['student_id5'];
				$model->sup_stage1 = $_POST['Tblhroffer']['sup_stage1'];
				$model->sup_stage2 = $_POST['Tblhroffer']['sup_stage2'];
				$model->sup_stage3 = $_POST['Tblhroffer']['sup_stage3'];
				$model->sup_stage4 = $_POST['Tblhroffer']['sup_stage4'];
				$model->sup_stage5 = $_POST['Tblhroffer']['sup_stage5'];
				$model->sup_stage6 = $_POST['Tblhroffer']['sup_stage6'];
				$model->sup_stage7 = $_POST['Tblhroffer']['sup_stage7'];
				$model->prog_lvlid = $_POST['Tblhroffer']['prog_lvlid'];
				$model->sup_hours = $_POST['Tblhroffer']['sup_hours'];
				$model->sup_rate = $_POST['Tblhroffer']['sup_rate'];

                if($model->save(true)){

                    Tblhrmaster::model()->updateRunningNo($_POST['Tblhroffer']['offer_type'],$running_no[0]['number']);
                    $this->redirect(Yii::app()->homeUrl . 'offerletter/default/list');

                }
	// kalau xnk guna just commentkan ni untuk ape? untuk tgk data ape yang dia parse dari form
		//$this->getData($_POST);

            }else{
                $this->render('add',array('model'=>$model));
            }


        }else{

            if($id==NULL){
                $model = new Tblhroffer();
            }else{
                $model = Tblhroffer::model()->findByPk($id);
            }

            $this->render('add',array('model'=>$model));
        }

    }

    public function actionEdit()
    {

        $id = Yii::app()->getRequest()->getParam('id');
        $this->layout='//default/main_layout';

        if (isset($_POST['submit'])){

            $model = Tblhroffer::model()->findByPk($id);
            $model->attributes = $_POST['Tblhroffer'];


            if ($model->validate()) {

                $model->title = $_POST['Tblhroffer']['title'];
                $model->name = $_POST['Tblhroffer']['name'];
                $model->short_name = $_POST['Tblhroffer']['short_name'];
                $model->address1 = $_POST['Tblhroffer']['address1'];
                if($_POST['Tblhroffer']['address2']){
                    $model->address2 = $_POST['Tblhroffer']['address2'];
                }
				if($_POST['Tblhroffer']['address3']){
                    $model->address2 = $_POST['Tblhroffer']['address3'];
                }
                $model->city = $_POST['Tblhroffer']['city'];
                $model->state = $_POST['Tblhroffer']['state'];
                $model->postcode = $_POST['Tblhroffer']['postcode'];
                $model->country_id = $_POST['Tblhroffer']['country_id'];
                $model->offer_type = $_POST['Tblhroffer']['offer_type'];
                $model->date_offer = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_offer']));
				
                if($_POST['Tblhroffer']['date_offer_end']!=NULL) {
                    $model->date_offer_end = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_offer_end']));
                }else{
                    $model->date_offer_end = NULL;
                }
                if($_POST['Tblhroffer']['date_contract_start']!=NULL){
                    $model->date_contract_start = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_contract_start']));
                }else{
                    $model->date_contract_start = NULL;
                }
                if($_POST['Tblhroffer']['date_contract_end']!=NULL){
                    $model->date_contract_end = date('Y-m-d', strtotime($_POST['Tblhroffer']['date_contract_end']));
                }else{
                    $model->date_contract_end = NULL;
                }
                if($_POST['Tblhroffer']['contract_id']!=NULL){
                    $model->contract_id = $_POST['Tblhroffer']['contract_id'];
                }else{
                    $model->contract_id = NULL;
                }
                if($_POST['Tblhroffer']['duration_id']!=NULL){
                    $model->duration_id = $_POST['Tblhroffer']['duration_id'];
                }else{
                    $model->duration_id = NULL;
                }
                if($_POST['Tblhroffer']['duration_extra']!=NULL){
                    $model->duration_extra = $_POST['Tblhroffer']['duration_extra'];
                }else{
                    $model->duration_extra = NULL;
                }
                if($_POST['Tblhroffer']['program_id']!=NULL){
                    $model->program_id = $_POST['Tblhroffer']['program_id'];
                }else{
                    $model->program_id = NULL;
                }
                if($_POST['Tblhroffer']['program_id2']!=NULL){
                    $model->program_id2 = $_POST['Tblhroffer']['program_id2'];
                }else{
                    $model->program_id2 = NULL;
                }
                if($_POST['Tblhroffer']['program_id3']!=NULL){
                    $model->program_id3 = $_POST['Tblhroffer']['program_id3'];
                }else{
                    $model->program_id3 = NULL;
                }
                if($_POST['Tblhroffer']['program_id4']!=NULL){
                    $model->program_id4 = $_POST['Tblhroffer']['program_id4'];
                }else{
                    $model->program_id4 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id1']!=NULL){
                    $model->subject_id1 = $_POST['Tblhroffer']['subject_id1'];
                }else{
                    $model->subject_id1 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id2']!=NULL){
                    $model->subject_id2 = $_POST['Tblhroffer']['subject_id2'];
                }else{
                    $model->subject_id2 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id3']!=NULL){
                    $model->subject_id3 = $_POST['Tblhroffer']['subject_id3'];
                }else{
                    $model->subject_id3 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id4']!=NULL){
                    $model->subject_id4 = $_POST['Tblhroffer']['subject_id4'];
                }else{
                    $model->subject_id4 = NULL;
                }
                if($_POST['Tblhroffer']['subject_id5']!=NULL){
                    $model->subject_id5 = $_POST['Tblhroffer']['subject_id5'];
                }else{
                    $model->subject_id5 = NULL;
                }
                if($_POST['Tblhroffer']['external_title']!=NULL){
                    $model->external_title = $_POST['Tblhroffer']['external_title'];
                }else{
                    $model->external_title = NULL;
                }
                if($_POST['Tblhroffer']['external_extra']!=NULL){
                    $model->external_extra = $_POST['Tblhroffer']['external_extra'];
                }else{
                    $model->external_extra = NULL;
                }
                if($_POST['Tblhroffer']['advisory_1']!=NULL){
                    $model->advisory_1 = $_POST['Tblhroffer']['advisory_1'];
                }else{
                    $model->advisory_1 = NULL;
                }
                if($_POST['Tblhroffer']['advisory_2']!=NULL){
                    $model->advisory_2 = $_POST['Tblhroffer']['advisory_2'];
                }else{
                    $model->advisory_2 = NULL;
                }
                if($_POST['Tblhroffer']['advisory_3']!=NULL){
                    $model->advisory_3 = $_POST['Tblhroffer']['advisory_3'];
                }else{
                    $model->advisory_3 = NULL;
                }
				
				 if($_POST['Tblhroffer']['classcode_1']!=NULL){
                    $model->classcode_1 = $_POST['Tblhroffer']['classcode_1'];
                }else{
                    $model->classcode_1 = NULL;
                }
				 if($_POST['Tblhroffer']['classcode_2']!=NULL){
                    $model->classcode_2 = $_POST['Tblhroffer']['classcode_2'];
                }else{
                    $model->classcode_2 = NULL;
                }
				if($_POST['Tblhroffer']['classcode_3']!=NULL){
                    $model->classcode_3 = $_POST['Tblhroffer']['classcode_3'];
                }else{
                    $model->classcode_3 = NULL;
                }
				if($_POST['Tblhroffer']['classcode_4']!=NULL){
                    $model->classcode_4 = $_POST['Tblhroffer']['classcode_4'];
                }else{
                    $model->classcode_4 = NULL;
                }
				if($_POST['Tblhroffer']['classcode_5']!=NULL){
                    $model->classcode_5 = $_POST['Tblhroffer']['classcode_5'];
                }else{
                    $model->classcode_5 = NULL;
                }
				
						 if($_POST['Tblhroffer']['service1']!=NULL){
                    $model->service1 = $_POST['Tblhroffer']['service1'];
                }else{
                    $model->service1 = NULL;
                }
				 if($_POST['Tblhroffer']['service2']!=NULL){
                    $model->service2 = $_POST['Tblhroffer']['service2'];
                }else{
                    $model->service2 = NULL;
                }
				if($_POST['Tblhroffer']['service3']!=NULL){
                    $model->service3 = $_POST['Tblhroffer']['service3'];
                }else{
                    $model->service3 = NULL;
                }
				if($_POST['Tblhroffer']['service4']!=NULL){
                    $model->service4 = $_POST['Tblhroffer']['service4'];
                }else{
                    $model->service4 = NULL;
                }
				if($_POST['Tblhroffer']['service5']!=NULL){
                    $model->service5 = $_POST['Tblhroffer']['service5'];
                }else{
                    $model->service5 = NULL;
                }

                $model->position_id = $_POST['Tblhroffer']['position_id'];
				
				if($_POST['Tblhroffer']['unitid']!=NULL){
                    $model->unitid = $_POST['Tblhroffer']['unitid'];
                }else{
                    $model->unitid = NULL;
                }
				
                $model->department_id = $_POST['Tblhroffer']['department_id'];
                $model->report_to_id = $_POST['Tblhroffer']['report_to_id'];
                $model->salary = $_POST['Tblhroffer']['salary'];
				$model->duration_day = $_POST['Tblhroffer']['duration_day'];
				$model->duration_hours = $_POST['Tblhroffer']['duration_hours'];
				$model->letter_title = $_POST['Tblhroffer']['letter_title'];
                /*$model->date_updated = date('Y-m-d H:i:s');*/
                $model->status = $_POST['Tblhroffer']['status'];
				$model->cc_name = $_POST['Tblhroffer']['cc_name'];
				$model->cc_position = $_POST['Tblhroffer']['cc_position'];
				$model->cc_address1 = $_POST['Tblhroffer']['cc_address1'];
				$model->cc_address2 = $_POST['Tblhroffer']['cc_address2'];
				$model->cc_postcode = $_POST['Tblhroffer']['cc_postcode'];
				$model->cc_city = $_POST['Tblhroffer']['cc_city'];
				$model->cc_state = $_POST['Tblhroffer']['cc_state'];
				$model->sup_contact = $_POST['Tblhroffer']['sup_contact'];
				$model->sup_email = $_POST['Tblhroffer']['sup_email'];
				$model->student_name = $_POST['Tblhroffer']['student_name'];
				$model->student_id = $_POST['Tblhroffer']['student_id'];
				$model->student_name2 = $_POST['Tblhroffer']['student_name2'];
				$model->student_id2 = $_POST['Tblhroffer']['student_id2'];
				$model->student_name3 = $_POST['Tblhroffer']['student_name3'];
				$model->student_id3 = $_POST['Tblhroffer']['student_id3'];
				$model->student_name4 = $_POST['Tblhroffer']['student_name4'];
				$model->student_id4 = $_POST['Tblhroffer']['student_id4'];
				$model->student_name5 = $_POST['Tblhroffer']['student_name5'];
				$model->student_id5 = $_POST['Tblhroffer']['student_id5'];
				$model->sup_stage1 = $_POST['Tblhroffer']['sup_stage1'];
				$model->sup_stage2 = $_POST['Tblhroffer']['sup_stage2'];
				$model->sup_stage3 = $_POST['Tblhroffer']['sup_stage3'];
				$model->sup_stage4 = $_POST['Tblhroffer']['sup_stage4'];
				$model->sup_stage5 = $_POST['Tblhroffer']['sup_stage5'];
				$model->sup_stage6 = $_POST['Tblhroffer']['sup_stage6'];
				$model->sup_stage7 = $_POST['Tblhroffer']['sup_stage7'];
				$model->prog_lvlid = $_POST['Tblhroffer']['prog_lvlid'];
				$model->sup_hours = $_POST['Tblhroffer']['sup_hours'];
				$model->sup_rate = $_POST['Tblhroffer']['sup_rate'];


                if($model->save(true)){

                    $this->redirect(Yii::app()->homeUrl . 'offerletter/default/edit/id/'.$id);

                }

            }else{
                $this->render('add',array('model'=>$model));
            }


        }else{

            $model = Tblhroffer::model()->findByPk($id);
            $this->render('add',array('model'=>$model));
        }

    }

    public function actionList()
    {
        $this->layout='//default/main_layout';
        $data =  Tblhroffer::model()->findAll(array('order'=>'id desc'));
        $this->render('list',array('data'=>$data));
    }

    public function actionType()
    {
        $this->layout='//default/main_layout';
        $data =  Tblhrletter::model()->findAll(array('order'=>'id asc'));
        $this->render('type',array('data'=>$data));
    }

    public function actionTypeadd()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $this->layout='//default/main_dashboard';

        if (isset($_POST['submit'])){

            if($id==NULL){
                $model = new Tblhrletter();
            }else{
                $model = Tblhrletter::model()->findByPk($id);
            }
            $model->attributes = $_POST['Tblhrletter'];

            if ($model->validate()) {

                $model->code = $_POST['Tblhrletter']['code'];
                $model->description = $_POST['Tblhrletter']['description'];
                $model->type = $_POST['Tblhrletter']['type'];
                $model->job_status = $_POST['Tblhrletter']['job_status'];
                $model->status = $_POST['Tblhrletter']['status'];

                if($model->save(true)){
                    if($id==NULL) {
                        $this->redirect(Yii::app()->homeUrl . 'offerletter/default/type');
                    }else{
                        $this->redirect(Yii::app()->homeUrl . 'offerletter/default/typeadd/id/'.$id);
                    }
                }

            }else{
                $this->render('typeadd',array('model'=>$model));
            }


        }

        if($id==NULL){
            $model = new Tblhrletter();
        }else{
            $model = Tblhrletter::model()->findByPk($id);
        }
        $this->render('typeadd',array('model'=>$model)); 

    }

    public function actionHonor()
    {
        $data =  Tblhrhonorific::model()->findAll();
        $this->layout='//default/main_dashboard';
        $this->render('honor',array('data'=>$data));
    }

    public function actionHonoradd()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $this->layout='//default/main_dashboard';

        if (isset($_POST['submit'])){

            if($id==NULL){
                $model = new Tblhrhonorific();
            }else{
                $model = Tblhrhonorific::model()->findByPk($id);
            }
            $model->attributes = $_POST['Tblhrhonorific'];

            if ($model->validate()) {

                $model->title = $_POST['Tblhrhonorific']['title'];
                $model->title_code = $_POST['Tblhrhonorific']['title_code'];

                if($model->save(true)){
                    if($id==NULL) {
                        $this->redirect(Yii::app()->homeUrl . 'offerletter/default/honor');
                    }else{
                        $this->redirect(Yii::app()->homeUrl . 'offerletter/default/honoradd/id/'.$id);
                    }
                }

            }else{
                $this->render('honoradd',array('model'=>$model));
            }


        }

        if($id==NULL){
            $model = new Tblhrhonorific();
        }else{
            $model = Tblhrhonorific::model()->findByPk($id);
        }
        $this->render('honoradd',array('model'=>$model));

    }

    public function actionPrintlog()
    {
        $data =  Tblhrprintlog::model()->findAll();
        $this->layout='//default/main_dashboard';
        $this->render('print',array('data'=>$data));
    }
}