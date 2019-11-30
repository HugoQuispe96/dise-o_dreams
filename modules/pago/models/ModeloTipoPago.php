<?php

namespace app\modules\pago\models;
use Yii;
use yii\base\Model;

class ModeloTipoPago extends Model{

public $id;
public $nombre;
public $descripcion;
public $precio;
public $interes;

public function rules()
 {
  return [
    ['id', 'integer', 'message' => 'Id incorrecto'],
    ['precio', 'integer', 'message' => 'Necesita ser numero'],
    ['precio', 'required', 'message' => 'Campo requerido'],
    ['interes', 'integer', 'message' => 'Necesita ser numero'],
    ['interes', 'required', 'message' => 'Campo requerido'],
    ['nombre', 'required', 'message' => 'Campo requerido'],
    ['nombre', 'match', 'pattern' => "/^.{6,25}$/", 'message' => 'Mínimo 6 y máximo 50 caracteres'],
    ['nombre', 'match', 'pattern' => "/^[a-záéíóúñ\s ]+$/i", 'message' => 'Sólo se aceptan letras'],
    ['descripcion', 'required', 'message' => 'Campo requerido'],
    ['descripcion', 'match', 'pattern' => "/^.{6,50}$/", 'message' => 'Mínimo 6 y máximo 50 caracteres'],
    ['descripcion', 'match', 'pattern' => "/^[a-záéíóúñ 0-9\s ]+$/i", 'message' => 'Sólo se aceptan letras y numeros'],
  ];
 }

}
