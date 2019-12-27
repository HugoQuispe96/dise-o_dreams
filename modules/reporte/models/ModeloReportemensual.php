<?php

namespace app\modules\reporte\models;
use Yii;
use yii\base\Model;

class ModeloReportemensual extends Model{

public $mes;
public $año;



public function rules()
 {
  return [
   [['mes','año'], 'required', 'message' => 'Campo requerido'],
   
  ];
 }

}
