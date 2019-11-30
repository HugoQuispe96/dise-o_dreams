<?php

namespace app\modules\pago\models;
use Yii;
use yii\db\ActiveRecord;

class TipoPago extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'tipo_pago';
    }

}