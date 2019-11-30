<?php

namespace app\modules\lugar\models;
use Yii;
use yii\base\Model;

class ModeloLugarentrenamiento extends Model{

public $id;
public $nombre;
public $direccion;

public function rules()
 {
  return [
   ['id', 'integer', 'message' => 'Id incorrecto'],
   [['nombre','direccion'], 'required', 'message' => 'Campo requerido'],
   ['nombre', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['direccion', 'match', 'pattern' => '/^.{7,50}$/', 'message' => 'Mínimo 7 máximo 50 caracteres'],
   ['direccion', 'match', 'pattern' => '/^[a-záéíóúñ\s0-9 ]+$/i', 'message' => 'Sólo se aceptan letras y números'],

  ];
 }

}
