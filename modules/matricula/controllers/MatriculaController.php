<?php

namespace app\modules\matricula\controllers;
use app\modules\matricula\models\Matricula;

class MatriculaController extends \yii\web\Controller
{
    public function actionGenerarMatricula($id_solicitud)
    {   $matricula = new Matricula;
        $matricula->id_solicitud=$id_solicitud;
        $matricula->estado="Activa";
        $matricula->fecha_vencimiento= date('Y-m-1',strtotime(date("Y-m-d", mktime()) . " + 1 month"));
        $matricula->insert();
        return;
    }

    public function actionVencerMatricula()
    {
        return $this->render('vencer-matricula');
    }

    public function actionVerificarMatricula()
    {
        return $this->render('verificar-matricula');
    }

}
