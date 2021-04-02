<?php

namespace backend\models;

use common\models\User;

/**
 * AdminUser model
 */
class AdminUser extends User
{
    public static function tableName()
    {
        return '{{%admin_user}}';
    }
}
