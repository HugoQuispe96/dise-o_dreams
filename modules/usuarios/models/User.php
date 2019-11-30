<?php

namespace app\modules\usuarios\models;
use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    
    public $id;
    public $nombre_usuario;
    public $contraseña;
    public $rol;
    public $nombre_completo;
    public $rut;
    public $email;
    public $direccion;
    public $fechanacimiento;
    public $celular;
    public $authKey;
    public $accessToken;
    public $activate;

    /**
     * @inheritdoc
     */
    
    /* busca la identidad del usuario a través de su $id */

    public static function findIdentity($id)
    {
        
        $user = Users::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("id=:id", ["id" => $id])
                ->one();
        
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    
    /* Busca la identidad del usuario a través de su token de acceso */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $users = Users::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                ->all();
        
        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    
    /* Busca la identidad del usuario a través del username */
    public static function findByUsername($nombre_usuario)
    {
        $users = Users::find()
                ->where("activate=:activate", ["activate" => 1])
                ->andWhere("nombre_usuario=:nombre_usuario", [":nombre_usuario" => $nombre_usuario])
                ->all();
        
        foreach ($users as $user) {
            if (strcasecmp($user->nombre_usuario, $nombre_usuario) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->id;
    }
    public function isProfesor()
    {
        if(Yii::$app->user->identity->rol == "profesor")
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function isAdministrador()
    {
        if(Yii::$app->user->identity->rol == "administrador")
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function isDeportista()
    {
        if(Yii::$app->user->identity->rol == "deportista")
        {
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    
    /* Regresa la clave de autenticación */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    
    /* Valida la clave de autenticación */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($contraseña)
    {
        /* Valida el password */
        if (crypt($contraseña, $this->contraseña) == $this->contraseña)
        {
        return $contraseña === $contraseña;
        }
    }
};