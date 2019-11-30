<?php

namespace app\modules\pago\models;
use Yii;
use yii\db\ActiveRecord;

class Solicitud extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'solicitud_pago';
    }

}