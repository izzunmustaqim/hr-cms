<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $this->layout='//default/main_layout';
		$this->render('index');
	}

    public function actionList()
    {
        $this->layout='//default/main_layout';
        $data =  Tbluser::model()->getStaff();
        $this->render('list',array('data'=>$data));
    }
}