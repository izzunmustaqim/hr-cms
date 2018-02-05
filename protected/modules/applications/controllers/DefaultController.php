<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAdd()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $this->layout='//default/main_dashboard';
        if (isset($_POST['submit'])){

            if($id==NULL){
                $model = new Applications();
            }else{
                $model = Applications::model()->findByPk($id);
            }

            $model->attributes = $_POST['Applications'];
            if ($model->validate()) {
                $model->name = $_POST['Applications']['name'];
                $model->date = date('Y-m-d H:i:s');
                $model->category_id = $_POST['Applications']['category_id'];
                $model->user_id = Yii::app()->user->getState('UserID');
                if($model->save(true)){
                    $this->redirect(Yii::app()->homeUrl . 'applications/default/list');
                }

            }else{
                $this->render('add',array('model'=>$model));
            }

        }else{

            if($id==NULL){
                $model = new Applications();
            }else{
                $model = Applications::model()->findByPk($id);
            }

            $this->render('add',array('model'=>$model));
        }

    }

    public function actionList()
    {
        $category = Category::model()->findAll();
        $this->layout='//default/main_dashboard';
        $this->render('list',array('category'=>$category));
    }

    public function actionItemlist()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $data = Applications::model()->findByPk($id);
        $category = Category::model()->findAllByAttributes(array('category_id'=>$data['category_id']));
        $this->layout='//default/main_dashboard';
        $this->render('itemlist',array('data'=>$data,'category'=>$category));
    }

    public function actionLog()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $type= Yii::app()->getRequest()->getParam('type');
        $log_e = EmailLog::model()->getLog($id,$type);
        $data = Applications::model()->findByPk($id);
        $category = Category::model()->findAllByAttributes(array('category_id'=>$data['category_id']));
        $type_e = Type::model()->findAllByAttributes(array('type_id'=>$type));
        $this->layout='//default/main_dashboard';
        $this->render('log',array('log_e'=>$log_e,'data'=>$data,'category'=>$category,'type_desc'=>$type_e));
    }

    public function actionSummary()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $type= Yii::app()->getRequest()->getParam('type');
        $data = Applications::model()->findByPk($id);
        $category = Category::model()->findAllByAttributes(array('category_id'=>$data['category_id']));
        $type = Type::model()->findAllByAttributes(array('type_id'=>$type));
        $this->layout='//default/main_dashboard';
        $this->render('summary',array('data'=>$data,'category'=>$category,'type_desc'=>$type));
    }

    public function actionSummarydetails()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $data = Applications::model()->findByPk($id);
        $category = Category::model()->findAllByAttributes(array('category_id'=>$data['category_id']));
        $this->layout='//default/main_dashboard';
        $this->render('summary_details',array('data'=>$data,'category'=>$category));
    }

    public function actionAddtype()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $app_id = Yii::app()->getRequest()->getParam('app_id');
        $this->layout='//default/main_dashboard';

        if (isset($_POST['submit'])){

            if($app_id==NULL){
                $model = new Itemlist();
            }else{
                $model = Itemlist::model()->findByPk($id);
            }
            $model->attributes = $_POST['Itemlist'];
            if ($model->validate()) {
                $model->date = date('Y-m-d H:i:s');
                $model->type_id = $_POST['Itemlist']['type_id'];
                $model->day = $_POST['Itemlist']['day'];
                if(!$app_id){
                    $model->applications_id = $id;
                }
                if($model->save(true)){
                    if(!$app_id) {
                        $this->redirect(Yii::app()->homeUrl . 'applications/default/itemlist/id/' . $id);
                    }else{
                        $this->redirect(Yii::app()->homeUrl . 'applications/default/itemlist/id/' . $app_id);
                    }
                }
            }else{
                $this->render('addtype',array('model'=>$model));
            }

        }else{

            $item = Itemlist::model()->getItemlist($app_id);
            if($app_id==NULL){
                $model = new Itemlist();
            }else{
                $model = Itemlist::model()->findByPk($id);
            }
            $this->render('addtype',array('model'=>$model,'item'=>$item));
        }

    }

    public function actionAddpayment()
    {
        $id = Yii::app()->getRequest()->getParam('id');
        $this->layout='//default/main_dashboard';
        if (isset($_POST['submit'])){
            $model = new ItemlistPaid();
            $model->attributes = $_POST['ItemlistPaid'];
            if ($model->validate()) {
                $model->date = date('Y-m-d');
                $model->payment_date = $_POST['ItemlistPaid']['payment_date'];
                $model->category_id = $_POST['ItemlistPaid']['category_id'];
                $model->type_id = $_POST['ItemlistPaid']['type_id'];
                $model->applications_id = $_POST['ItemlistPaid']['applications_id'];
                $model->amount = $_POST['ItemlistPaid']['amount'];
                $model->reference_no = $_POST['ItemlistPaid']['reference_no'];
                if($model->save(true)){
                    if($_POST['ItemlistPaid']['category_id']==1){
                        $this->redirect(Yii::app()->homeUrl . 'applications/default/itemlist/id/'.$_POST['ItemlistPaid']['applications_id']);
                    }else{
                        $this->redirect(Yii::app()->homeUrl . 'applications/default/summary/id/'.$_POST['ItemlistPaid']['applications_id']);
                    }
                }
            }else{
                $this->render('addpayment',array('model'=>$model));
            }

        }else{
            $model = new ItemlistPaid();
            $this->render('addpayment',array('model'=>$model));
        }

    }
}