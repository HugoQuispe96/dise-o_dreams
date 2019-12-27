<?php

namespace app\modules\horario\controllers;
use Yii;
use app\modules\horario\models\ModeloDiaentrenamiento;
use app\modules\horario\models\Diaentrenamiento;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\filters\AccessControl;
use app\modules\usuarios\models\User;

class HorarioController extends \yii\web\Controller
{   public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['actualizar','borrar','crear','ver'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['actualizar','borrar','crear','ver'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isAdministrador();
                        },
                    ],
                ], 
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['horario_deportista'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['horario_deportista'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isDeportista();
                        },
                    ],
                ], 
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['horario_profesor'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['horario_profesor'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isProfesor();
                        },
                    ],
                ], 
            ],
        ];
    }
    public function actionActualizar()
    {
        $model = new ModeloDiaentrenamiento;
        $msg=null;

        if (Yii::$app->request->get("id")) {
            $id=Html::encode($_GET["id"]);
            if ((int) $id) {
                $table = Diaentrenamiento::findOne($id);
                if($table){

                    $model->id= $table->id;
                    $model->equipo_idequipo= $table->equipo_idequipo;
                    $model->lugar_idlugar= $table->lugar_idlugar;
                    $model->usuario_idusuario= $table->usuario_idusuario;
                    $model->dia= $table->dia;
                    $model->Hora_inicio= $table->Hora_inicio;
                    $model->Hora_fin= $table->Hora_fin;

                }
                else {
                    return $this->redirect(["horario/ver"]);
                }
            }else {

                return $this->redirect(["horario/ver"]);
            }
        }
        else {
            return $this->redirect(["horario/ver"]);
        }
        if($model->load(Yii::$app->request->post()))
        {
            if ($model->validate()) {

                $table = Diaentrenamiento::findOne($model->id);
                if ($table) {
                    $table->id= $model->id;
                    $table->equipo_idequipo= $model->equipo_idequipo;
                    $table->lugar_idlugar= $model->lugar_idlugar;
                    $table->usuario_idusuario= $model->usuario_idusuario;
                    $table->dia= $model->dia;
                    $table->Hora_inicio= $model->Hora_inicio;
                    $table->Hora_fin= $model->Hora_fin;
                    if ($table->update() ) {
                        $msg="El dia de entrenamiento ha sido actualizada";
                    }
                    else {
                        $msg="Error, el dia de entrenamiento seleccionada no ha sido actualizada";
                    }
                }
                else {
                    $msg= "Error,el dia de entrenamiento no ha sido encontrada";
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

                    Diaentrenamiento::deleteAll("id=:id", [":id" => $id]);
                    echo "el dia de entrenamiento con id $id eliminado con éxito, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("horario/ver")."'>";

                } catch (\Exception $e) {

                    echo "Ha ocurrido un error al eliminar el dia de entrenamiento por estar asociado a otra tabla, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='1; ".Url::toRoute("horario/ver")."'>";

                }
            }
            else
            {
                echo "Ha ocurrido un error al eliminar el dia de entrenamiento, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("horario/ver")."'>";
            }
        }
        else
        {
            return $this->redirect(["horario/ver"]);
        }
    }

    public function actionCrear()
    {
        $model = new ModeloDiaentrenamiento;
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
                $table = new Diaentrenamiento;
                $table->dia = $model->dia;
                $table->Hora_inicio = $model->Hora_inicio;
                $table->Hora_fin = $model->Hora_fin;
                $table->lugar_idlugar = $model->lugar_idlugar;
                $table->equipo_idequipo = $model->equipo_idequipo;
                $table->usuario_idusuario = $model->usuario_idusuario;

                if ($table->insert())
                {
                    $model->dia = null;
                    $model->Hora_inicio = null;
                    $model->Hora_fin = null;
                    $model->lugar_idlugar = null;
                    $model->equipo_idequipo = null;
                    $model->usuario_idusuario = null;

                    $msg = "Enhorabuena, se registro un dia de entrenamiento";
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
        return $this->render("crear", ["model" => $model, "msg" => $msg]);
    }
    public function actionVer()
    {
       $array = Yii::$app->db->createCommand('SELECT d.id id, e.nombre nombre_equipo,l.nombre nombre_lugar,u.nombre_completo nombre_profesor,d.dia dia,d.Hora_inicio Hora_inicio,d.Hora_fin Hora_fin FROM dia_entrenamiento d, equipo e, lugar l, usuario u WHERE d.equipo_idequipo=e.id and d.lugar_idlugar=l.id and d.usuario_idusuario=u.id')->queryAll();
       $items = ArrayHelper::index($array, 'id');
       return $this->render("ver", ["items" => $items]);
    }
    public function actionHorario_deportista()
    {
        $id=Yii::$app->user->identity->id;
        $consulta="SELECT d.id id, e.nombre nombre_equipo,l.nombre nombre_lugar,u.nombre_completo nombre_profesor,d.dia dia,d.Hora_inicio ,d.Hora_fin  
        FROM dia_entrenamiento d, equipo e, lugar l, usuario u, equipo_tiene_usuarios etu
        WHERE d.equipo_idequipo=e.id and d.lugar_idlugar=l.id and d.usuario_idusuario=u.id and etu.idequipo=e.id and etu.idusuario=".$id;
        if((int)$id){
            $array = Yii::$app->db->createCommand($consulta)->queryAll();
            $items = ArrayHelper::index($array, 'id');
        }else {
            return $this->redirect(["/site/index"]);
        }             
        return $this->render("horario-deportista", ["items" => $items]);
    }
    public function actionHorario_profesor()
    {
        $id=Yii::$app->user->identity->id;
        $consulta="SELECT d.id id, e.nombre nombre_equipo,l.nombre nombre_lugar, d.dia dia,d.Hora_inicio ,d.Hora_fin  
        FROM dia_entrenamiento d, equipo e, lugar l
        WHERE d.equipo_idequipo=e.id and d.lugar_idlugar=l.id and d.usuario_idusuario=".$id;
        if((int)$id){
            $array = Yii::$app->db->createCommand($consulta)->queryAll();
            $items = ArrayHelper::index($array, 'id');
        }else {
            return $this->redirect(["/site/index"]);
        }             
        return $this->render("horario-profesor", ["items" => $items]);
    }

}
