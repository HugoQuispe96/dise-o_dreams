<?php

namespace app\modules\horario\models;
use Yii;
use yii\base\Model;

class ModeloDiaentrenamiento extends Model{

public $id;
public $dia;
public $Hora_fin;
public $Hora_inicio;
public $lugar_idlugar;
public $equipo_idequipo;
public $usuario_idusuario;


public function rules()
 {
  return [
   [['dia','Hora_inicio','Hora_fin','lugar_idlugar','equipo_idequipo','usuario_idusuario'], 'required', 'message' => 'Campo requerido'],
   ['dia', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['Hora_inicio', 'match', 'pattern' => '/^[:0-9]+$/i', 'message' => 'Sólo se aceptan formato "hh:mm"'],
   ['Hora_fin', 'match', 'pattern' => '/^[:0-9]+$/i', 'message' => 'Sólo se aceptan formato "hh:mm"'],
   ['Hora_inicio', 'match', 'pattern' => '/^.{5}$/', 'message' => 'solo 5 caracteres'],
   ['Hora_fin', 'match', 'pattern' => '/^.{5}$/', 'message' => 'solo 5 caracteres'],

  ];
 }

}
