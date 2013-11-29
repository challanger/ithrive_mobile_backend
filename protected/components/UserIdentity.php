<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        private $_id;
        private $_permission;
        private $_name;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
                $record=  Users::model()->findByAttributes(array('email'=>$this->username));
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
		if($record==null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($record->password!==crypt($this->password,$record->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
                {
                        $this->_id=$record->id;
                        $this->setState('permission',$record->permission);
                        $this->setState('title',$record->name);
                        $this->_permission=$record->permission;
                        $this->_name=$record->name;
			$this->errorCode=self::ERROR_NONE;
                }
		return !$this->errorCode;
	}
        
        
        public function getId()
        {
            return $this->_id;
        }
        
        public function getName() 
        {
            return $this->_name;
        }
}