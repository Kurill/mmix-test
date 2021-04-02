<?php

namespace backend\models;

use common\models\LoginForm as BaseLoginFormModel;

/**
 * Login form
 */
class LoginForm extends BaseLoginFormModel
{

    /**
     * Finds user by [[username]]
     *
     * @return AdminUser|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = AdminUser::findByUsername($this->username);
        }
        return $this->_user;
    }
}
