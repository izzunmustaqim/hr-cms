<?php

class DefaultController extends Controller
{
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
                $model = new Tblhrtraining();
            }else{
                $model = Tblhrtraining::model()->findByPk($id);
            }
            $model->attributes = $_POST['Tblhrtraining'];


            if ($model->validate()) {

                $model->title = $_POST['Tblhrtraining']['title'];
                $model->date = $_POST['Tblhrtraining']['date'];
                $model->type = $_POST['type'];
                $model->venue = $_POST['Tblhrtraining']['venue'];
                $model->user_id = Yii::app()->user->getState('UserID');

                if($model->save(true)){
                    $this->redirect(Yii::app()->homeUrl . 'training/default/list');
                }

            }else{
                $this->render('add',array('model'=>$model));
            }


        }else{

            if($id==NULL){
                $model = new Tblhrtraining();
            }else{
                $model = Tblhrtraining::model()->findByPk($id);
            }

            $this->render('add',array('model'=>$model));
        }

    }

    public function actionList()
    {
        $this->layout='//default/main_layout';
        $data =  Tblhrtraining::model()->findAll(array('order'=>'id desc'));
        $this->render('list',array('data'=>$data));
    }

    public function actionReport()
    {
        $this->layout='//default/main_layout';
        $this->render('report');
    }
}