<?php

namespace app\modules\pruebas\controllers;
use app\modules\usuarios\models\User;
use yii\filters\AccessControl;

class PruebaController extends \yii\web\Controller
{   public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['administrador'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['administrador'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isAdministrador();
                        },
                    ],
                ],
                
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['profesor'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['profesor'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isProfesor();
                        },
                    ],
                ],  
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['deportista'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['deportista'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isDeportista();
                        },
                    ],
                ],
            ],
        ];
    }
    public function actionAdministrador()
    {
        return $this->render('administrador');
    }

    public function actionDeportista()
    {
        return $this->render('deportista');
    }

    public function actionProfesor()
    {
        return $this->render('profesor');
    }

}
