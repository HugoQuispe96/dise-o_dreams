<?php

namespace app\modules\horario\models;
use Yii;
use yii\db\ActiveRecord;

class Diaentrenamiento extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'dia_entrenamiento';
    }

}
