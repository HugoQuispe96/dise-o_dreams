<?php

namespace app\modules\reporte\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\reporte\models\ModeloReportemensual;
use app\modules\reporte\models\ModeloReporteAnual;
use app\modules\reporte\models\Boleta;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use app\modules\usuarios\models\User;

/**
 * Default controller for the `reporte` module
 */
class ReporteController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function behaviors()
    {
        return [
            'access' => 
            [
                'class' => AccessControl::className(),
                'only' => ['mensual','anual'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['mensual','anual'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isAdministrador();
                        },
                    ],
                ],
                
            ],
        ];
    }
    public function actionMensual()
    {
      $total = 0;
      $resultado = 'algo';
      $meses = array(1=>'Enero',
                    2=>'Febrero',
                    3=>'Marzo',
                    4=>'Abril',
                    5=>'Mayo',
                    6=>'Junio',
                    7=>'Julio',
                    8=>'Agosto',
                    9=>'Septiembre',
                    10=>'Octubre',
                    11=>'Noviembre',
                    12=>'Diciembre');

      $años = array("2019"=>'2019',"2020"=>'2020',"2021"=>'2021',"2022"=>'2022',"2023"=>'2023',"2024"=>'2024',"2025"=>'2025',"2026"=>'2026');
        $model = new ModeloReportemensual;

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {


            if($model->validate())
            {
              $valormes = $model->mes;
              $valoraño = $model->año;

              if ($valormes == 1 or $valormes == 3 or $valormes == 5 or $valormes == 7 or $valormes == 8 or $valormes == 10 or $valormes == 12) {



                  try {


                  $resultado1 = Yii::$app->db->createCommand("SELECT  @rownum:=  @rownum+1 as 'id', u.nombre_usuario as nombre_usuario , t.nombre as nombre_pago, valor as pago
                                                FROM solicitud_pago s, tipo_pago t, boleta b, usuario u,(SELECT @rownum:=0) r
                                                where s.usuario_idusuario = u.id and s.boleta_idboleta = b.id and s.tipopago_idtipopago = t.id and s.estado = 'aprobado' and date(b.fecha) between '$valoraño-$valormes-0' and '$valoraño-$valormes-31'")->queryAll();
                  if ($resultado1 != null) {

                  $resultado = ArrayHelper::index($resultado1,'id');
                  foreach ($resultado as $row) {
                    $total = $total + intval(substr((ArrayHelper::GetValue($row,'pago')),0,strlen(ArrayHelper::GetValue($row,'pago'))));// code...
                  }
                  }
                  else {
                    $total=0;
                  }
                } catch (\Exception $e) {

                }




              }
              else {

                  if ($valormes == 2) {

                    if ($valoraño == 2020 or $valoraño == 2024 or $valoraño == 2028) {
                      try {

                        $resultado1 = Yii::$app->db->createCommand("SELECT  @rownum:=  @rownum+1 as 'id', u.nombre_usuario as nombre_usuario , t.nombre as nombre_pago, valor as pago
                                                      FROM solicitud_pago s, tipo_pago t, boleta b, usuario u,(SELECT @rownum:=0) r
                                                      where s.usuario_idusuario = u.id and s.boleta_idboleta = b.id and s.tipopago_idtipopago = t.id and s.estado = 'aprobado' and date(b.fecha) between '$valoraño-$valormes-0' and '$valoraño-$valormes-29'")->queryAll();

                                                      if ($resultado1 != null) {


                                                      $resultado = ArrayHelper::index($resultado1,'id');
                                                      foreach ($resultado as $row) {
                                                        $total = $total + intval(substr((ArrayHelper::GetValue($row,'pago')),0,strlen(ArrayHelper::GetValue($row,'pago'))));// code...
                                                      }
                                                      }
                                                      else {
                                                        $total=0;
                                                      }

                      }catch (\Exception $e) {


                      }
                    }
                    else {
                      try {

                        $resultado1 = Yii::$app->db->createCommand("SELECT  @rownum:=  @rownum+1 as 'id', u.nombre_usuario as nombre_usuario , t.nombre as nombre_pago, valor as pago
                                                      FROM solicitud_pago s, tipo_pago t, boleta b, usuario u,(SELECT @rownum:=0) r
                                                      where s.usuario_idusuario = u.id and s.boleta_idboleta = b.id and s.tipopago_idtipopago = t.id and s.estado = 'aprobado' and date(b.fecha) between '$valoraño-$valormes-0' and '$valoraño-$valormes-28'")->queryAll();

                                                      if ($resultado1 != null) {


                                                      $resultado = ArrayHelper::index($resultado1,'id');
                                                      foreach ($resultado as $row) {
                                                        $total = $total + intval(substr((ArrayHelper::GetValue($row,'pago')),0,strlen(ArrayHelper::GetValue($row,'pago'))));// code...
                                                      }
                                                      }
                                                      else {
                                                        $total=0;
                                                      }
                      }catch (\Exception $e) {


                      }
                    }
                  }
                  else {
                    try {

                      $resultado1 = Yii::$app->db->createCommand("SELECT  @rownum:=  @rownum+1 as 'id', u.nombre_usuario as nombre_usuario , t.nombre as nombre_pago, valor as pago
                                                    FROM solicitud_pago s, tipo_pago t, boleta b, usuario u,(SELECT @rownum:=0) r
                                                    where s.usuario_idusuario = u.id and s.boleta_idboleta = b.id and s.tipopago_idtipopago = t.id and s.estado = 'aprobado' and date(b.fecha) between '$valoraño-$valormes-0' and '$valoraño-$valormes-30'")->queryAll();

                                                    if ($resultado1 != null) {

                                                    $resultado = ArrayHelper::index($resultado1,'id');
                                                    foreach ($resultado as $row) {
                                                      $total = $total + intval(substr((ArrayHelper::GetValue($row,'pago')),0,strlen(ArrayHelper::GetValue($row,'pago'))));// code...
                                                    }
                                                    }
                                                    else {
                                                      $total=0;
                                                    }
                    }catch (\Exception $e) {


                    }
                  }
              }
            }
            else
            {
            $model->getErrors();
            }
        }
        $model->mes=null;
        $model->año=null;

        return $this->render('mensual', ["model" => $model, "meses" => $meses,"años" => $años,"resultado" => $resultado,"total" => $total ]);
    }
    public function actionAnual()
    {
      $total = 0;
      $resultado = 'algo';
      $años = array("2019"=>'2019',"2020"=>'2020',"2021"=>'2021',"2022"=>'2022',"2023"=>'2023',"2024"=>'2024',"2025"=>'2025',"2026"=>'2026');
      $model = new ModeloReporteAnual;

      if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
      {
          Yii::$app->response->format = Response::FORMAT_JSON;
          return ActiveForm::validate($model);
      }

      if ($model->load(Yii::$app->request->post()))
      {
          if($model->validate())
          {
            $valoraño = $model->año;
            try {

              $resultado1 = Yii::$app->db->createCommand("SELECT  @rownum:=  @rownum+1 as 'id', u.nombre_usuario, b.fecha as fecha_pago , t.nombre as nombre_pago, valor as pago
              FROM solicitud_pago s, tipo_pago t, boleta b, usuario u,(SELECT @rownum:=0) r
              where s.usuario_idusuario = u.id and s.boleta_idboleta = b.id and s.tipopago_idtipopago = t.id and s.estado = 'aprobado' and date(b.fecha) between '$valoraño-01-0' and '$valoraño-12-31'")->queryAll();
              if ($resultado1 != null) {
                $resultado = ArrayHelper::index($resultado1,'id');
                foreach ($resultado as $row) {
                  $total = $total + intval(substr((ArrayHelper::GetValue($row,'pago')),0,strlen(ArrayHelper::GetValue($row,'pago'))));
                }
              }
              else {
                $total=0;
              }
            } catch (\Exception $e) {

            }

          }
          else
          {
          $model->getErrors();
          }
      }
        $model->año=null;

        return $this->render('anual', ["model" => $model,"años" => $años,"resultado" => $resultado,"total" => $total ]);
    }
}
