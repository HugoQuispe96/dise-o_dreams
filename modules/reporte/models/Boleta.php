<?php

namespace app\modules\reporte\models;
use Yii;
use yii\db\ActiveRecord;

class Boleta extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'boleta';
    }

}
