<?php

namespace app\modules\equipo\models;
use Yii;
use yii\base\Model;
use app\modules\equipo\models\Asignacionusuario;

class ModeloAsignacion extends Model{

    public $idequipo;
    public $idusuario;

    public function rules()
    {
        return [
            [['idequipo','idusuario'], 'required', 'message' => 'Campo requerido'],


        ];
    }





}
