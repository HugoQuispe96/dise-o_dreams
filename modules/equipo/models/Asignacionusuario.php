<?php

namespace app\modules\equipo\models;
use Yii;
use yii\db\ActiveRecord;

class Asignacionusuario extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'equipo_tiene_usuarios';
    }

}
