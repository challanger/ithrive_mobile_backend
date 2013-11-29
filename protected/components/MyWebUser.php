<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyWebUser
 *
 * @author appleuser
 */
class MyWebUser extends CWebUser {
    /**
     * check if the user has permission to be here
     * @param type $role
     * @return boolean
     */
    public function has_permission($role)
    {
        if((is_array($role)))
        {
            if(isset(Yii::app()->user->permission))
            {
                if(in_array($role, Yii::app()->user->permission))
                    return true;
                else 
                    return false;
            }
            else 
                return false; 
        }
        else
        {
            if((isset(Yii::app()->user->permission))&&(Yii::app()->user->permission==$role))
                return true;
            else 
                return false; 
        }
    }
}

?>
