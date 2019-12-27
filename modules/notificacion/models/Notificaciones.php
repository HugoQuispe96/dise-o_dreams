<?php

namespace app\modules\notificacion\models;
use Yii;
use yii\db\ActiveRecord;

class Notificaciones extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'notificacion';
    }

}
