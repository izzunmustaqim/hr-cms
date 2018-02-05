<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgotPasswordForm extends CFormModel
{
    public $email;
    public $idno;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('email', 'required','message'=>'Please insert a valid email address.'),
            array('email', 'email','message'=>'Please insert a valid email address.'),
            array('idno', 'required','message'=>'Sila masukkan kod pengesahan.'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {

    }


}