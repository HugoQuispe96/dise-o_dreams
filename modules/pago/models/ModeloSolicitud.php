<?php

namespace app\modules\pago\models;
use Yii;
use yii\base\Model;

class ModeloSolicitud extends Model{

public $id;
public $usuario_idusuario;
public $estado;
public $boleta_idboleta;
public $tipopago_idtipopago;

public function rules()
 {
  return [
    [['tipopago_idtipopago'], 'required', 'message' => 'Campo requerido'],
  ];
 }

}
