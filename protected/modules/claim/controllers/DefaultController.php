<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $this->layout='//default/main_layout';
		$this->render('index');
	}
}