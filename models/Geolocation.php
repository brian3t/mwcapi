<?php

namespace app\models;

use \app\models\base\Geolocation as BaseGeolocation;

/**
 * This is the model class for table "geolocation".
 */
class Geolocation extends BaseGeolocation
{
    public function beforeValidate()
    {
        if (empty($this->id)){
            $this->id = uniqid() . uniqid();
        }
        return parent::beforeValidate();
    }
}
