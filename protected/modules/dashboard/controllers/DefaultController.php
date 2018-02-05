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
        $this->layout='//default/main_dashboard';
		$this->render('index');
	}
	
	// Academic Calendar
    public function actionManual()
    {
        $file= Yii::app()->getRequest()->getParam('file');
		//echo $file;
		//die;

       $filepath = 'file/'.$file;

        header('Content-type: application/docx');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($filepath));
        header('Accept-Ranges: bytes');

        // Render the file
        @readfile($filepath);

    }




}