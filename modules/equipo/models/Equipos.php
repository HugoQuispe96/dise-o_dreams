<?php

namespace app\modules\equipo\models;
use Yii;
use yii\db\ActiveRecord;

class Equipos extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'equipo';
    }

}
