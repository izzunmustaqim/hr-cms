<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */

    public function authenticate() {

        //1=active, 2=just registered, 3=removed
        $user = Tbluser::model()->find("EmailAddress ='" . strtolower($this->username) . "@city.edu.my'");
        if (!isset($user->EmailAddress)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (crypt($this->password, $user->UserPasswordCrypt) !== $user->UserPasswordCrypt) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->setState('UserID', $user->UserId);
            $this->setState('UserFullName', $user->FullName);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

}