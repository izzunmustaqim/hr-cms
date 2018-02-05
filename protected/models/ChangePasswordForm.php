<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangePasswordForm extends CFormModel
{
    public $password;
    public $password_confirm;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('password, password_confirm', 'required', 'message' => 'Please insert a valid password'),
            array('password', 'length', 'min' => 6, 'max' => 24,'tooShort'=>'Password too short. (Minimum 6 character).','tooLong'=>'Password too long. (Maximum 24 aksara).'),
            array('password_confirm', 'compare', 'compareAttribute'=>'password', 'message' => 'Your password not match.'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {

    }


}