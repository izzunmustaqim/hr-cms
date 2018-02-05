<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $this->layout='//default/main_layout';
		$this->render('index');
	}

    public function actionAddworking()
    {

        $id = Yii::app()->getRequest()->getParam('id');

        $this->layout='//default/main_layout';
        if (isset($_POST['submit'])){

            if($id==NULL){
                $model = new Tblhrworkingpermit();
            }else{
                $model = Tblhrworkingpermit::model()->findByPk($id);
            }
            $model->attributes = $_POST['Tblhrworkingpermit'];

            if ($model->validate()) {

                $model->FullName = $_POST['Tblhrworkingpermit']['FullName'];
                $model->ICPassportNo = $_POST['Tblhrworkingpermit']['ICPassportNo'];
                $model->DepartmentId = $_POST['Tblhrworkingpermit']['DepartmentId'];
                $model->WorkingStatusId = $_POST['Tblhrworkingpermit']['WorkingStatusId'];
                $model->Remarks = $_POST['Tblhrworkingpermit']['Remarks'];
                $model->PermitNo = $_POST['Tblhrworkingpermit']['PermitNo'];
                $model->StartDate = $_POST['Tblhrworkingpermit']['StartDate'];
                $model->ExpiryDate = $_POST['Tblhrworkingpermit']['ExpiryDate'];
                $model->Date = date("Y-m-d");
                $model->StaffId = Yii::app()->user->getState('UserID');
                $model->StatusId = 1;

                if($model->save(true)){
                    $this->redirect(Yii::app()->homeUrl . 'permit/default/working');
                }

            }else{
                $this->render('addworking',array('model'=>$model));
            }


        }else{

            if($id==NULL){
                $model = new Tblhrworkingpermit();
            }else{
                $model = Tblhrworkingpermit::model()->findByPk($id);
            }

            $this->render('addworking',array('model'=>$model));
        }

    }

    public function actionWorking()
    {
        $this->layout='//default/main_layout';
        $data =  Tblhrworkingpermit::model()->findAll(array('order'=>'id desc'));
        $this->render('working',array('data'=>$data));
    }

    public function actionAddteaching()
    {

        $id = Yii::app()->getRequest()->getParam('id');

        $this->layout='//default/main_layout';
        if (isset($_POST['submit'])){

            if($id==NULL){
                $model = new Tblhrteachingpermit();
            }else{
                $model = Tblhrteachingpermit::model()->findByPk($id);
            }
            $model->attributes = $_POST['Tblhrteachingpermit'];


            if ($model->validate()) {

                $model->FullName = $_POST['Tblhrteachingpermit']['FullName'];
                $model->ICPassportNo = $_POST['Tblhrteachingpermit']['ICPassportNo'];
                $model->DepartmentId = $_POST['Tblhrteachingpermit']['DepartmentId'];
                $model->WorkingStatusId = $_POST['Tblhrteachingpermit']['WorkingStatusId'];
                $model->Remarks = $_POST['Tblhrteachingpermit']['Remarks'];
                $model->Date = date("Y-m-d");
                $model->DateModified = date("Y-m-d H:m:s");
                $model->StaffId = Yii::app()->user->getState('UserID');
                $model->StatusId = 1;

                if($model->save(true)){
                    $this->redirect(Yii::app()->homeUrl . 'permit/default/teaching');
                }

            }else{
                $this->render('addteaching',array('model'=>$model));
            }


        }else{

            if($id==NULL){
                $model = new Tblhrteachingpermit();
            }else{
                $model = Tblhrteachingpermit::model()->findByPk($id);
            }

            $this->render('addteaching',array('model'=>$model));
        }

    }

    public function actionTeaching()
    {
        $this->layout='//default/main_layout';
        $data =  Tblhrteachingpermit::model()->findAll(array('order'=>'id desc'));
        $this->render('teaching',array('data'=>$data));
    }


}