<?php

namespace app\modules\lugar\models;
use Yii;
use yii\db\ActiveRecord;

class Lugarentrenamiento extends ActiveRecord{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'lugar';
    }

}
