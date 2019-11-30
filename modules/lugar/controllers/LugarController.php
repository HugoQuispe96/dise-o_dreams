<?php

namespace app\modules\lugar\controllers;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\lugar\models\ModeloLugarentrenamiento;
use app\modules\lugar\models\Lugarentrenamiento;


class LugarController extends \yii\web\Controller
{
    public function actionActualizar()
    {
        $model = new ModeloLugarentrenamiento;
        $msg=null;

        if (Yii::$app->request->get("id")) {
            $id=Html::encode($_GET["id"]);
            if ((int) $id) {
                $table = Lugarentrenamiento::findOne($id);
                if($table){
                    $model->id= $table->id;
                    $model->nombre= $table->nombre;
                    $model->direccion= $table->direccion;
                }
                else {
                    return $this->redirect(["lugar/ver"]);
                }
            }else {
                return $this->redirect(["lugar/ver"]);
            }
        }
        else {

            return $this->redirect(["lugar/ver"]);
        }
        if($model->load(Yii::$app->request->post()))
        {
            if ($model->validate()) {
                $table = Lugarentrenamiento::findOne($model->id);
                if ($table) {
                    $table->id= $model->id;
                    $table->nombre = $model->nombre;
                    $table->direccion = $model->direccion;
                    if ($table->update() ) {
                        $msg="El lugar de entrenamiento seleccionado ha sido actualizado";
                    }
                    else {
                        $msg="El lugar de entrenamiento seleccionado no ha sido actualizado";
                    }
                }
                else {
                    $msg= "El lugar de entrenamiento no ha sido encontrado";
                }
            }
            else {
                $model->getErrors();
            }
        }
        return $this->render("actualizar",["model"=>$model,"msg"=>$msg]);
    }

    public function actionBorrar()
    {
        if(Yii::$app->request->post())
        {
            $id = Html::encode($_POST["id_"]);
            if((int) $id)
            {
                try {
                    Lugarentrenamiento::deleteAll("id=:id", [":id" => $id]);
                    echo "el equipo con id $id eliminado con éxito, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("lugar/ver")."'>";
                } catch (\Exception $e) {
                    echo "Ha ocurrido un error al eliminar el equipo por estar en otra tabla, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("lugar/ver")."'>";
                }
            }
            else
            {
                echo "Ha ocurrido un error al eliminar el equipo, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("lugar/ver")."'>";
            }
        }
        else
        {
            return $this->redirect(["lugar/ver"]);
        }
    }

    public function actionCrear()
    {
        $model = new ModeloLugarentrenamiento;
        $msg = null;
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new Lugarentrenamiento;
                $table->nombre = $model->nombre;
                $table->direccion = $model->direccion;
                if ($table->insert())
                {
                    $msg = "Enhorabuena registro guardado correctamente";
                    $model->nombre = null;
                    $model->direccion = null;
                }
                else
                {
                    $msg = "Ha ocurrido un error al insertar el registro";
                }
            }
            else
            {
                $model->getErrors();
            }
        }
        return $this->render("crear", ['model' => $model, 'msg' => $msg]);
    }

    public function actionVer()
    {
        $table= new Lugarentrenamiento;
        $model = $table::find()->all();
        return $this->render("ver",["model"=>$model]);
    }

}
