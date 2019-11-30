<?php

namespace app\modules\usuarios\models;
use Yii;
use yii\base\Model;
use app\modules\usuarios\models\Users;

class FormRegister extends Model{
 
    public $nombre_usuario;
    public $contraseña;
    public $contraseña_repeat;
    public $rol;
    public $nombre_completo;
    public $rut;
    public $email;
    public $direccion;
    public $fechanacimiento;
    public $celular;
    
    public function rules()
    {
        return [
            [['nombre_usuario','contraseña', 'contraseña_repeat','rol', 'nombre_completo', 'rut', 'email', 'direccion', 'fechanacimiento', 'celular'], 'required', 'message' => 'Campo requerido'],
            ['nombre_usuario', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['nombre_usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['nombre_usuario', 'username_existe'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['email', 'email_existe'],
            ['contraseña', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['contraseña_repeat', 'compare', 'compareAttribute' => 'contraseña', 'message' => 'Las contraseña no coinciden'],
            ['direccion', 'match', 'pattern' => "/^[0-9a-záéíóúñ\s ]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['direccion', 'match', 'pattern' => "/^.{10,50}$/", 'message' => 'Mínimo 10 y máximo 50 caracteres'],
            ['celular', 'match', 'pattern' => "/^.{8,9}$/i", 'message' => 'formato "98765432"'],
            ['celular', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan números'],
            ['fechanacimiento', 'match', 'pattern' => "/^.{10}$/", 'message' => 'formato: "aaaa-mm-dd"'],
            ['nombre_completo', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['nombre_completo', 'match', 'pattern' => "/^[a-z ]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['rut', 'match', 'pattern' => "/^.{9,10}$/", 'message' => 'Mínimo 9 y máximo 10 caracteres'],
            ['rut', 'match', 'pattern' => "/^[0-9]+-[0-9kK]{1}/", 'message' => 'Formato: 19364321-5'],
        ];
    }
    
    public function email_existe($attribute, $params)
    {
      $table = Users::find()->where("email=:email", [":email" => $this->email]);
      if ($table->count() == 1)
      {
        $this->addError($attribute, "El email seleccionado existe");
      }
    }
    public function username_existe($attribute, $params)
    {
      $table = Users::find()->where("nombre_usuario=:nombre_usuario", [":nombre_usuario" => $this->nombre_usuario]);
      if ($table->count() == 1)
      {
        $this->addError($attribute, "El usuario seleccionado existe");
      }
    }
 
}