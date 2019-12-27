<?php

namespace app\modules\reporte\models;
use Yii;
use yii\base\Model;

class ModeloReporteAnual extends Model{

public $año;



public function rules()
 {
  return [
   [['año'], 'required', 'message' => 'Campo requerido'],
   
  ];
 }

}
