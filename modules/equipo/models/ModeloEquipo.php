<?php

namespace app\modules\equipo\models;
use Yii;
use yii\base\Model;
use app\modules\equipo\models\Equipos;

class ModeloEquipo extends Model{

    public $nombre;
    public $division;
    public $categoria;
    public $id;

    public function rules()
    {
        return [
            [['nombre', 'division','categoria'], 'required', 'message' => 'Campo requerido'],
            ['nombre', 'match', 'pattern' => "/^.{7,50}$/", 'message' => 'Mínimo 7 y máximo 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[a-záéíóúñ\s ]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['nombre', 'username_existe'],
            ['division', 'match', 'pattern' => "/^[0-9a-záéíóúñ\s ]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['categoria', 'match', 'pattern' => "/^[0-9a-záéíóúñ\s ]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['division', 'match', 'pattern' => "/^.{1,15}$/", 'message' => 'máximo 15 caracteres'],
            ['categoria', 'match', 'pattern' => "/^.{1,15}$/", 'message' => 'máximo 15 caracteres'],


        ];
    }



    public function username_existe($attribute, $params)
    {

     $table = Equipos::find()->where("nombre=:nombre", [":nombre" => $this->nombre]);
      if ($table->count() == 1)
      {
                $this->addError($attribute, "El equipo seleccionado existe");
      }
    }

}
