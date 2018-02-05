<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $this->layout='//default/main_layout';
		$this->render('index');
	}

    public function actionRunning()
    {
        $data =  Tblhrmaster::model()->findAllByAttributes(array('status'=>1),array('order'=>'id asc'));
        $this->layout='//default/main_layout';
        $this->render('running',array('data'=>$data));
    }

    public function actionHoliday()
    {
        $data =  Tblleaveholiday::model()->getHolidaydate();
        $this->layout='//default/main_layout';
        $this->render('holiday',array('data'=>$data));
    }
}