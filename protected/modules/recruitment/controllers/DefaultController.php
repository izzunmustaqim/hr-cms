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
                $model = new Tblhrcandidate();
            }else{
                $model = Tblhrcandidate::model()->findByPk($id);
            }
            $model->attributes = $_POST['Tblhrcandidate'];


            if ($model->validate()) {

                $model->FullName = $_POST['Tblhrcandidate']['FullName'];
                $model->ICPassportNo = $_POST['Tblhrcandidate']['ICPassportNo'];
                $model->EmailAddress = $_POST['Tblhrcandidate']['EmailAddress'];
                $model->NationalityId = $_POST['Tblhrcandidate']['NationalityId'];
                $model->UserDOB = $_POST['Tblhrcandidate']['UserDOB'];
                $model->HandSetNo = $_POST['Tblhrcandidate']['HandSetNo'];
                $model->RaceId = $_POST['Tblhrcandidate']['RaceId'];
                $model->ReligionId = $_POST['Tblhrcandidate']['ReligionId'];
                $model->Gender = $_POST['Tblhrcandidate']['Gender'];
                $model->Remarks = $_POST['Tblhrcandidate']['Remarks'];
                $model->Date = date("Y-m-d");
                $model->StaffId = Yii::app()->user->getState('UserID');
                $model->StatusId = 1;

                if($model->save(true)){
                    $this->redirect(Yii::app()->homeUrl . 'recruitment/default/list');
                }

            }else{
                $this->render('add',array('model'=>$model));
            }


        }else{

            if($id==NULL){
                $model = new Tblhrcandidate();
            }else{
                $model = Tblhrcandidate::model()->findByPk($id);
            }

            $this->render('add',array('model'=>$model));
        }

    }

    public function actionList()
    {
        $this->layout='//default/main_layout';
        $data =  Tblhrcandidate::model()->findAll(array('order'=>'UserId desc'));
        $this->render('list',array('data'=>$data));
    }

    public function actionIntegration()
    {
        $this->layout='//default/main_layout';
        $data =  Tblhrcandidate::model()->findAll(array('order'=>'UserId desc'));
        $this->render('Integration',array('data'=>$data));
    }

}