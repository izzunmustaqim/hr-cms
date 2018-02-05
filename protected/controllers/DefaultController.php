 <?php

class DefaultController extends Controller
{

    public $title = array();

	public function actionIndex()
	{
        $this->layout='//default/index';
        $this->render('home');
	}

    public function actionRegister()
    {
        $this->title= 'Register New Account';
        $model=new ForgotPasswordForm;
        $this->layout='//default/main_login_v2';
        if (isset($_POST['ForgotPasswordForm'])) {
            $model->attributes = $_POST['ForgotPasswordForm'];
            if ($model->validate()) {

                $Tblstudent = Tblstudent::model()->find("StudEmail ='".$model->email."' and StudentNo ='" .$model->idno."'");
                if ($Tblstudent) {

                    //set 18 digit code
                    $Tblstudent->user_password_code =  rand(10000000, 99999999).time();

                    if ($Tblstudent->save(false)) {

                        $request = new PasswordRequests;
                        $request->request_email = $model->email;
                        $request->request_code = $Tblstudent->user_password_code;
                        $request->save(false);

                        // Trigger sending email
                        $this->sendEmailRegister($model->email,$Tblstudent->user_password_code,$Tblstudent->StudentNo);
                        $status = 1;

                    }

                }else{
                    $status = 2;
                }
            }

        }else{
            $status = 0;
        }

        $this->render('register',array('model'=>$model,'status'=>$status));

    }

    public function actionLogin()
    {
        $model = new LoginForm;
        if ($_POST) {
            $model->attributes = $_POST;

            if(!$model->validate() && $model->login()) {
                $this->redirect(Yii::app()->baseUrl.'/dashboard/default');
            }

            if($model->login()) {
                $this->redirect(Yii::app()->baseUrl.'/dashboard/default');
            }
        }

        $this->layout='//default/main_login';
        $this->render('login',array('model'=>$model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionDashboard()
    {
        $this->layout='//default/main_dashboard';
        $this->render('dashboard');
    }

    public function actionProfile()
    {
        $msgimg = "";
        if (isset($_POST['img'])==1) {

                // Directory
                $DocumentDirectory = 'profile';
                Tblstudentimages::model()->deleteAllByAttributes(array('StudentId'=>Yii::app()->user->getState('UserID')));
                $model = New Tblstudentimages();
                $model->StudentId = Yii::app()->user->getState('UserID');
                $file = CUploadedFile::getInstance($model,'sl_path');
                if($file->name){
                    $model_name = 'doc_' . time() . '_' . $file->name;
                    $fileUrl = $DocumentDirectory.'/'.$model_name;
                    $file->saveAs($fileUrl);
                }
                $model->ImageType = $file->type;
                $fp = fopen($fileUrl, 'r');
                $content = fread($fp, filesize($fileUrl));
                fclose($fp);
                $model->ImageData = $content;

                if ($model->save(false)) {
                    $this->redirect(Yii::app()->baseURL . '/default/profile');
                }

        }

        $data = Tblstudent::model()->getStudentProfileByID(Yii::app()->user->getState('UserID'));
        $this->layout='//default/main_dashboard';
        $this->render('profile',array('data'=>$data,'msg'=>$msgimg));
    }

    public function actionChangepassword(){

        $confirm = Yii::app()->getRequest()->getParam('confirm');$new = Yii::app()->getRequest()->getParam('new');

        // find the student by id
        $Tblstudent = Tblstudent::model()->find("StudentId ='" .Yii::app()->user->getState('UserID')."'");
        if($Tblstudent){

            if($new=="$confirm"){

                $Tblstudent->StudPassword =  $new;
                $Tblstudent->StudPasswordCrypt =  $this->password_encryption($new);
                $Tblstudent->user_password_code =  NULL;
                if ($Tblstudent->save(false)) {
                    // Trigger sending email
                    $this->sendEmailRecoverSuccess($Tblstudent->StudEmail,$Tblstudent->StudentNo);
                }
                echo 1;

            }else{
                echo 2;
            }
        }
    }

    public function actionForgot()
    {
        $this->title= 'Password Recovery';
        $model=new ForgotPasswordForm;
        $this->layout='//default/main_login_v2';
        $status = 0;

        if (isset($_POST['ForgotPasswordForm'])) {
            $model->attributes = $_POST['ForgotPasswordForm'];
            if ($model->validate()) {

                $Tblstudent = Tblstudent::model()->find("StudEmail ='".$model->email."' and StudentNo ='" .$model->idno."'");
                if ($Tblstudent) {

                    //set 18 digit code
                    $Tblstudent->user_password_code =  rand(10000000, 99999999).time();

                    if ($Tblstudent->save(false)) {

                        $request = new PasswordRequests;
                        $request->request_email = $model->email;
                        $request->request_code = $Tblstudent->user_password_code;
                        $request->save(false);

                        // Trigger sending email
                        $this->sendEmailRecover($model->email,$Tblstudent->user_password_code,$Tblstudent->StudentNo);
                        $status = 1;
                    }

                }else{
                    $status = 2;
                }
            }

        }else{
            $status = 0;
        }

        $this->render('forgot',array('model'=>$model,'status'=>$status));

    }

    public function actionAuthenticate()
    {
        $id_authenticate = Yii::app()->getRequest()->getParam('id');
        $this->title= 'Password Recovery Authentication';
        $model=new ChangePasswordForm();
        $this->layout='//default/main_login_v2';
        $status = 0;

        if (strlen($id_authenticate)<16) {

            $this->redirect(Yii::app()->baseURL . '/default/login');

        }else{

            $Tblstudent = Tblstudent::model()->find("user_password_code ='" .$id_authenticate."'");


            if($Tblstudent){

            if (isset($_POST['ChangePasswordForm'])) {

                $id_authenticate = Yii::app()->getRequest()->getParam('id');
                $model->attributes = $_POST['ChangePasswordForm'];
                if ($model->validate()) {
                    if ($Tblstudent) {

                        // mcrypt password
                        $Tblstudent->StudPassword =  $_POST['ChangePasswordForm']['password'];
                        $Tblstudent->StudPasswordCrypt =  $this->password_encryption($_POST['ChangePasswordForm']['password']);
                        $Tblstudent->user_password_code =  NULL;
                        if ($Tblstudent->save(false)) {

                            // Trigger sending email
                            $this->sendEmailRecoverSuccess($Tblstudent->StudEmail,$Tblstudent->StudentNo);
                            $status = 1;
                        }

                    }else{
                        $status = 2;
                    }
                }

            }else{
                $status = 0;
            }

            }else{
                $this->redirect(Yii::app()->baseURL . '/default/login');
            }

        }

        $this->render('authenticate',array('model'=>$model,'status'=>$status));

    }

    public function sendEmailRegister($email,$code,$idno){

        $base =  $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;

        $html = '<div bgcolor="#f5f7fa" style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#8d8d8d;line-height:20px">
            <table cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody>
                <tr>
                    <td valign="top">
                        <table width="598" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td align="left" style="padding:0px" valign="middle">
                                    <table style="border-radius:3px 3px 0 0;padding:0px;width:100%">
                                        <tbody>
                                        <tr>
                                            <td align="left" height="10" style="line-height:1px;font-size:0px;padding:0px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding:0px 0 0 15px;font-family:Helvetica,Arial,sans-serif;font-size:12px;color:#82a0c3" valign="middle"><div><a href="http://www.city.edu.my/" target="_blank"><img src="http://www.sakaix.net/cityu/logo_email.png" width="247" height="96" alt="Student Portal Logo" border="0"></a></div></td>
                                        </tr>
                                        <tr>
                                            <td align="left" height="10" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding:0px" valign="middle">
                                    <table style="background:#ffffff;padding:0px;width:100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td height="15" style="line-height:1px;font-size:0px;padding:0px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 15px;text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:bold;color:#000000;line-height:1.4em" valign="middle">
                                                <div>Thanks for register with CityU Student Portal</div></td>
                                        </tr>
                                        <tr>
                                            <td height="15" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="left" style="padding:0px" valign="middle">
                                    <table style="background:#ffffff;padding:0px" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <img src="http://www.sakaix.net/cityu/logo_welcome.png" width="600" height="180" alt="Welcome to Student Portal CityU" style="width:100%;min-height:auto" tabindex="0">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="25" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="598" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff" bgcolor="#ffffff" align="center">
                                        <tbody>
                                        <tr>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                            <td style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#666666;line-height:20px">To access Student Portal, first click the button below and verify your account.</td>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="20" colspan="3" style="line-height:1px;font-size:1px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                            <td style="text-align:center;font-size:12px;line-height:20px;font-family:Helvetica,Arial,sans-serif;color:#3966a0"><a href="'.$base.'/default/authenticate/id/'.$code.'" style="text-decoration:none;color:#3966a0;outline:0 none;border:0px" target="_blank">
                                                    <img src="http://www.sakaix.net/cityu/verify.png" width="240" height="46" alt="Verify Your Email" style="outline:0 none;border:0px"></a></td>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="20" colspan="3" style="line-height:1px;font-size:1px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                            <td style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#666666;line-height:20px">
                                                <h5 style="color:#bb141b;font-weight:bold">Your Account Details:</h5>
                                                <p>Login Email: <a href="mailto:'.$email.'" target="_blank">'.$email.'</a></p>
                                                <p>Student No: <a href="#">'.$idno.'</a></p>
                                                <p>You’re currently registered with CityU College. After your account has been verified, you can use all the function in the student portal.
                                                    Get more details <a style="color:#bb141b;font-weight:bold" href="http://localhost/sp-dev/default/faq" target="_blank">here</a> on how to use the portal.</p>
                                                <p>We hope you love using the student portal! Please feel free to reach out with any questions or comments.</p>
                                                <p>Happy Studying!<br>
                                                    The CMS Team</p>
                                            </td>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="15" colspan="3" style="line-height:1px;font-size:1px">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>';

        $mail = new YiiMailer();
        $mail->From = 'noreply@city.edu.my';
        $mail->FromName = 'System Admin';
        $mail->setTo($email);
        $mail->setSubject('Registration @ Student Portal CityU');
        $mail->setBody($html);
        $mail->send();

    }

    public function sendEmailRecover($email,$code,$idno){

        $base =  $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;

        $html = '<div bgcolor="#f5f7fa" style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#8d8d8d;line-height:20px">
        <table cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
            <tr>
                <td valign="top">
                    <table width="598" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td align="left" style="padding:0px" valign="middle">
                                <table style="border-radius:3px 3px 0 0;padding:0px;width:100%">
                                    <tbody>
                                    <tr>
                                        <td align="left" height="10" style="line-height:1px;font-size:0px;padding:0px">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="padding:0px 0 0 15px;font-family:Helvetica,Arial,sans-serif;font-size:12px;color:#82a0c3" valign="middle"><div><a href="http://www.city.edu.my/" target="_blank"><img src="http://www.sakaix.net/cityu/logo_email.png" width="247" height="96" alt="Student Portal Logo" border="0"></a></div></td>
                                    </tr>
                                    <tr>
                                        <td align="left" height="10" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="padding:0px" valign="middle">
                                <table style="background:#ffffff;padding:0px;width:100%" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <td height="15" style="line-height:1px;font-size:0px;padding:0px">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0 15px;text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:bold;color:#000000;line-height:1.4em" valign="middle">
                                            <div>Password recovery for CityU Student Portal</div></td>
                                    </tr>
                                    <tr>
                                        <td height="15" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td align="left" style="padding:0px" valign="middle">
                                <table style="background:#ffffff;padding:0px" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                    <tr>
                                        <td>
                                          <img src="http://www.sakaix.net/cityu/logo_recover.png" width="600" height="180" alt="Welcome to Student Portal CityU" style="width:100%;min-height:auto" tabindex="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="598" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff" bgcolor="#ffffff" align="center">
                                    <tbody>
                                    <tr>
                                        <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                        <td style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#666666;line-height:20px">To recover your access to Student Portal, do click button below and follow the instruction</td>
                                        <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="20" colspan="3" style="line-height:1px;font-size:1px">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                        <td style="text-align:center;font-size:12px;line-height:20px;font-family:Helvetica,Arial,sans-serif;color:#3966a0"><a href="'.$base.'/default/authenticate/id/'.$code.'" style="text-decoration:none;color:#3966a0;outline:0 none;border:0px" target="_blank">
                                                <img src="http://www.sakaix.net/cityu/recover.png" width="240" height="46" alt="Verify Your Email" style="outline:0 none;border:0px"></a></td>
                                        <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="20" colspan="3" style="line-height:1px;font-size:1px">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                        <td style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#666666;line-height:20px">
                                            <h5 style="color:#bb141b;font-weight:bold">Your Account Details:</h5>
                                            <p>Login Email: <a href="mailto:'.$email.' target="_blank">'.$email.'</a></p>
                                            <p>Student No: <a href="#">'.$idno.'</a></p>
                                            <p>You’re currently registered with CityU College. If you did not do this password recovery request, just ignore this email or inform us.</p>
                                            <p>We hope you love using the student portal! Please feel free to reach out with any questions or comments.</p>
                                            <p>Happy Studying!<br>
                                                The CMS Team</p>
                                        </td>
                                        <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="15" colspan="3" style="line-height:1px;font-size:1px">&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>';

        $mail = new YiiMailer();
        $mail->setFrom('noreply@city.edu.my', 'System Admin');
        $mail->setTo($email);
        $mail->setSubject('Password Recovery @ Student Portal CityU');
        $mail->setBody($html);
        $mail->send();

    }

    public function sendEmailRecoverSuccess($email,$idno){

        $html = '<div bgcolor="#f5f7fa" style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#8d8d8d;line-height:20px">
            <table cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody>
                <tr>
                    <td valign="top">
                        <table width="598" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td align="left" style="padding:0px" valign="middle">
                                    <table style="border-radius:3px 3px 0 0;padding:0px;width:100%">
                                        <tbody>
                                        <tr>
                                            <td align="left" height="10" style="line-height:1px;font-size:0px;padding:0px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding:0px 0 0 15px;font-family:Helvetica,Arial,sans-serif;font-size:12px;color:#82a0c3" valign="middle"><div><a href="http://www.city.edu.my/" target="_blank"><img src="http://www.sakaix.net/cityu/logo_email.png" width="247" height="96" alt="Student Portal Logo" border="0"></a></div></td>
                                        </tr>
                                        <tr>
                                            <td align="left" height="10" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding:0px" valign="middle">
                                    <table style="background:#ffffff;padding:0px;width:100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td height="15" style="line-height:1px;font-size:0px;padding:0px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 15px;text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:24px;font-weight:bold;color:#000000;line-height:1.4em" valign="middle">
                                                <div>Password Changes for CityU Student Portal</div></td>
                                        </tr>
                                        <tr>
                                            <td height="15" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="left" style="padding:0px" valign="middle">
                                    <table style="background:#ffffff;padding:0px" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                        <tr>
                                            <td>
                                              <img src="http://www.sakaix.net/cityu/passwordsuccess.png" width="600" height="180" alt="Welcome to Student Portal CityU" style="width:100%;min-height:auto" tabindex="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="25" style="line-height:1px;font-size:0px;padding:0x">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="598" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff" bgcolor="#ffffff" align="center">
                                        <tbody>
                                        <tr>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                            <td style="margin:0px;font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#666666;line-height:20px">
                                                <h5 style="color:#bb141b;font-weight:bold">Your Account Details:</h5>
                                                <p>Login Email: <a href="mailto:'.$email.' target="_blank">'.$email.'</a></p>
                                                <p>Student No: <a href="#">'.$idno.'</a></p>
                                                <p>We just want to inform that you have success updating you account password. You’re currently registered with CityU College. If you did not do this password recovery changes, just ignore this email or inform us as soon as possible.</p>
                                                <p>We hope you love using the student portal! Please feel free to reach out with any questions or comments.</p>
                                                <p>Happy Studying!<br>
                                                    The CMS Team</p>
                                            </td>
                                            <td width="38" style="font-size:1px;line-height:1px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="15" colspan="3" style="line-height:1px;font-size:1px">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>';

        $mail = new YiiMailer();
        $mail->setFrom('noreply@city.edu.my', 'System Admin');
        $mail->setTo($email);
        $mail->setSubject('Password Change Success @ Student Portal CityU');
        $mail->setBody($html);
        $mail->send();

    }

}