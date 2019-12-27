<?php

namespace app\modules\matricula\controllers;
use app\modules\matricula\models\Matricula;
use yii\filters\AccessControl;
use app\modules\usuarios\models\User;

class MatriculaController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['generarmatricula'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['generarmatricula'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isAdministrador();
                        },
                    ],
                ], 
            ],
        ];
    }
    public function actionGenerarMatricula($id_solicitud)
    {   $matricula = new Matricula;
        $matricula->id_solicitud=$id_solicitud;
        $matricula->estado="Activa";
        $matricula->fecha_vencimiento= date('Y-m-1',strtotime(date("Y-m-d", mktime()) . " + 1 month"));
        $matricula->insert();
        return;
    }
}
