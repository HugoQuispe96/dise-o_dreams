<?php

namespace app\modules\pago\controllers;
use Yii;
use Mpdf\Mpdf;
use app\modules\pago\models\ModeloTipoPago;
use app\modules\pago\models\TipoPago;
use app\modules\pago\models\ModeloSolicitud;
use app\modules\pago\models\Solicitud;
use app\modules\pago\models\Boleta;
use app\modules\matricula\controllers\MatriculaController;
use app\modules\usuarios\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class PagoController extends \yii\web\Controller
{  public function actionAprobarSolicitud()
    {   if(Yii::$app->request->post())
        {
            $id_solicitud = Html::encode($_POST["id_"]);
            $id_tipo_pago = Html::encode($_POST["tipopago"]);
            $id_usuario = Html::encode($_POST["usuario"]);
            if((int) $id_solicitud)
            {
                try {    
                    $solicitud = Solicitud::findOne($id_solicitud);
                    $boleta = new Boleta;
                    $tipo_pago = TipoPago::findOne($id_tipo_pago);
                    $usuario = Users::findOne($id_usuario);
                    if($solicitud){
                        $boleta->fecha = new \yii\db\Expression('NOW()');
                        $boleta->valor = $tipo_pago->precio;
                        $boleta->insert();
                        $solicitud->estado= "Aprobado";
                        $solicitud->boleta_idboleta= $boleta->id;
                        $solicitud->update();
                        if($tipo_pago->nombre=="Matricula"){
                            MatriculaController::actionGenerarMatricula($id_solicitud);
                        }
                        $this->actionGenerarBoleta($boleta->id, $boleta->valor, $usuario->nombre_completo, $usuario->rut, $tipo_pago->nombre);
                        
                    }
                    else {
                        return $this->redirect(["pago/ver-solicitudes"]);
                    }
                        echo "La solicitud con id $id_solicitud ha sido aprobada con éxito, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver-solicitudes")."'>";
                } catch (\Exception $e) {
                    echo "Ha ocurrido un error al aprobar la solicitud, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver-solicitudes")."'>";
                }
            }
            else
            {
                echo "Ha ocurrido un error al aprobar la solicitud, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver-solicitudes")."'>";
            }
        }
        else
        {
            return $this->redirect(["pago/ver-solicitudes"]);
        }
    }

    public function actionCrearSolicitud()
    {
        $model = new ModeloSolicitud;
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
                $table = new Solicitud;
                $table->usuario_idusuario = Yii::$app->user->identity->id;
                $table->estado = "Pendiente";
                $table->boleta_idboleta = null;
                $table->tipopago_idtipopago = $model->tipopago_idtipopago;

                if ($table->insert())
                {
                    $model->tipopago_idtipopago = null;

                    $msg = "Enhorabuena, se registro una solicitud de pago";
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
        return $this->render("crear-solicitud", ["model" => $model, "msg" => $msg]);
    }

    public function actionGenerarBoleta($id,$valor,$nombre_usuario,$rut_usuario,$concepto)
    {   
        $boleta = new Mpdf();
        $boleta->WriteHTML("Boleta numero:\t".$id);
        $boleta->WriteHTML("Nombre de usuario:\t".$nombre_usuario);
        $boleta->WriteHTML("Rut usuario:\t".$rut_usuario);
        $boleta->WriteHTML("Fecha de pago:\t".date('Y-m-d'));
        $boleta->WriteHTML("Concepto:\t".$concepto);
        $boleta->WriteHTML("Monto pagado:\t".$valor);
        $boleta->Output();
        exit;
    }

    public function actionRechazarSolicitud()
    {
        if(Yii::$app->request->post())
        {
            $id_solicitud = Html::encode($_POST["id_"]);
            $mensaje = Html::encode($_POST["mensaje"]);
            if((int) $id_solicitud)
            {
                try {
                    $table = Solicitud::findOne($id_solicitud);
                    if($table){
                        $table->estado= "Rechazada";
                        $table->update();
                    }
                    else {
                        return $this->redirect(["pago/ver-solicitudes"]);
                    }
                    echo "La solicitud con id $id_solicitud ha sido rechazada, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver-solicitudes")."'>";
                } catch (\Exception $e) {
                    echo "Ha ocurrido un error al rechazar la solicitud, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver-solicitudes")."'>";
                }
            }
            else
            {
                echo "Ha ocurrido un error al rechazar la solicitud, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver-solicitudes")."'>";
            }
        }
        else
        {
            return $this->redirect(["pago/ver-solicitudes"]);
        }
    }

    public function actionVerSolicitudes()
    {   $array = Yii::$app->db->createCommand('select a.id, b.nombre_completo nombre_usuario, a.usuario_idusuario, a.estado, c.nombre nombre_tipo_pago, a.tipopago_idtipopago 
        from solicitud_pago a, usuario b, tipo_pago c 
        where a.tipopago_idtipopago = c.id and a.usuario_idusuario = b.id and a.estado = "Pendiente"')->queryAll();
        $items = ArrayHelper::index($array, 'id');
        return $this->render("ver-solicitudes", ["items" => $items]);
    }

    public function actionActualizar_tipo_pago()
    {
        $model = new ModeloTipoPago;
        $msg=null;

        if (Yii::$app->request->get("id")) {
            $id=Html::encode($_GET["id"]);
            if ((int) $id) {
                $table = TipoPago::findOne($id);
                if($table){
                    $model->id= $table->id;
                    $model->nombre= $table->nombre;
                    $model->descripcion= $table->descripcion;
                    $model->precio= $table->precio;
                    $model->interes= $table->interes;
                }
                else {
                    return $this->redirect(["pago/ver_tipo_pago"]);
                }
            }else {

                return $this->redirect(["pago/ver_tipo_pago"]);
            }
        }
        else {

            return $this->redirect(["pago/ver_tipo_pago"]);
        }
        if($model->load(Yii::$app->request->post()))
        {
            if ($model->validate()) {

                $table = TipoPago::findOne($model->id);
                if ($table) {

                  $table->id= $model->id;
                  $table->nombre= $model->nombre;
                  $table->descripcion= $model->descripcion;
                  $table->precio = $model->precio;
                  $table->interes = $model->interes;

                  if ($table->update() ) {

                    $msg="El tipo de pago ha sido actualizado";

                  }
                  else {
                    $msg="Error, el tipo de pago seleccionada no ha sido actualizado";
                  }

                }
                else {
                  $msg= "Error, el tipo de pago no ha sido encontrado";
                }
            }
            else {

                $model->getErrors();
            }
        }
        return $this->render("actualizar_tipo_pago",["model"=>$model,"msg"=>$msg]);
    }

    public function actionBorrar_tipo_pago()
    {
        if(Yii::$app->request->post())
        {
            $id = Html::encode($_POST["id_"]);
            if((int) $id)
            {

              try {

                TipoPago::deleteAll("id=:id", [":id" => $id]);
                echo "El tipo de pago con id $id ha sido eliminado con éxito, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver_tipo_pago")."'>";

              } catch (\Exception $e) {

                echo "Ha ocurrido un error al eliminar el tipo de pago por estar asociado a otra tabla, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver_tipo_pago")."'>";

              }
            }
            else
            {
                echo "Ha ocurrido un error al eliminar el tipo de pago, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("pago/ver_tipo_pago")."'>";
            }
        }
        else
        {
            return $this->redirect(["pago/ver_tipo_pago"]);
        }
    }

    public function actionCrear_tipo_pago()
    {
        $model = new ModeloTipoPago;

        $msg = null;

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new TipoPago;
                $table->nombre = $model->nombre;
                $table->descripcion = $model->descripcion;
                $table->precio = $model->precio;
                $table->interes = $model->interes;

                if ($table->insert())
                {
                    $model->nombre = null;
                    $model->descripcion = null;
                    $model->precio = null;
                    $model->interes = null;

                    $msg = "Enhorabuena, se creo el tipo de pago";
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
        return $this->render("crear_tipo_pago", ["model" => $model, "msg" => $msg]);
    }

    public function actionVer_tipo_pago()
    {
        $table= new TipoPago;
        $model = $table::find()->all();
        return $this->render("ver_tipo_pago",["model"=>$model]);
    }

}