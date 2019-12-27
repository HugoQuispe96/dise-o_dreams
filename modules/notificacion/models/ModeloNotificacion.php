<?php

namespace app\modules\notificacion\models;
use Yii;
use yii\base\Model;

class ModeloNotificacion extends Model{


public $mensaje;

public $fecha;
public $dias;


public function rules()
 {
  return [
   ['dias', 'integer', 'message' => 'numero de dias incorrecto'],
   [['mensaje','fecha','dias'], 'required', 'message' => 'Campo requerido'],
   ['mensaje', 'match', 'pattern' => '/^[0-9a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['mensaje', 'match', 'pattern' => '/^.{5,10000}$/', 'message' => 'Mínimo 5 caracteres'],
   ['dias', 'match', 'pattern' => '/^[0-9]+$/i', 'message' => 'Sólo se aceptan números'],
  ];
 }

}
