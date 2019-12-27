<?php

namespace app\modules\notificacion\controllers;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\notificacion\models\ModeloNotificacion;
use app\modules\notificacion\models\Notificaciones;
use yii\filters\AccessControl;
use app\modules\usuarios\models\User;


class NotificacionController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['crear_anuncio'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['crear_anuncio'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isAdministrador();
                        },
                    ],
                ], 
            ],
        ];
    }

    public function actionCrear_anuncio()
    {

        $model = new ModeloNotificacion;


        $msg = null;


        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }


        if ($model->load(Yii::$app->request->post()))
        {
        if($model->validate())
        {

        $table = new Notificaciones;

        $table->mensaje = $model->mensaje;
        $fecha = date("Y-m-d",strtotime($model->fecha."+ $model->dias days"));
        $table->fecha = $fecha;


        if ($table->insert())
        {


            $model->mensaje = null;

            $msg = "Enhorabuena, se creo la notificacion";
        }
        else
        {
            $msg = "Ha ocurrido un error al llevar a cabo el registro";
        }

        }
        else
        {
        $model->getErrors();
        }
        }
        return $this->render("crear_anuncio", ["model" => $model, "msg" => $msg]);
    }

}
