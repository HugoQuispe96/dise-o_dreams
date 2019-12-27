<?php

namespace app\modules\equipo\controllers;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\equipo\models\ModeloBusqueda;
use app\modules\usuarios\models\Users;
use app\modules\usuarios\models\User;
use app\modules\equipo\models\Equipos;
use app\modules\equipo\models\ModeloEquipo;
use app\modules\equipo\models\ModeloActualizarequipo;
use app\modules\equipo\models\ModeloAsignacion;
use app\modules\equipo\models\Asignacionusuario;
use yii\filters\AccessControl;

class EquipoController extends \yii\web\Controller
{   
    public function behaviors()
    {
        return [
            'access' => 
            [
                'class' => AccessControl::className(),
                'only' => ['actualizar','borrar','crear','ver','borrar_asignacion','ver_asignaciones','asignar_alumno','ver_equipo'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['actualizar','borrar','crear','ver','borrar_asignacion','ver_asignaciones','asignar_alumno','ver_equipo'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isAdministrador();
                        },
                    ],
                ], 
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['equipos_deportista'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['equipos_deportista'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isDeportista();
                        },
                    ],
                ], 
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['equipos_profesor'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['equipos_profesor'],
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
        $model = new ModeloActualizarequipo;
        $msg=null;
        if(Yii::$app->request->get("id")) {
            $id=Html::encode($_GET["id"]);
            if ((int) $id) {
                $table = Equipos::findOne($id);
                if($table){
                    $model->id= $table->id;
                    $model->nombre= $table->nombre;
                    $model->categoria= $table->categoria;
                    $model->division= $table->division;
                }
                else {
                    return $this->redirect(["equipo/ver"]);
                }
            }else {
                return $this->redirect(["equipo/ver"]);
            }
        }
        else {
            return $this->redirect(["equipo/ver"]);
        }
        if($model->load(Yii::$app->request->post()))
        {
            if ($model->validate()) {
                $table = Equipos::findOne($model->id);
                if ($table) {
                    $table->id= $model->id;
                    $table->nombre = $model->nombre;
                    $table->categoria = $model->categoria;
                    $table->division = $model->division;
                    if ($table->update() ) {
                    $msg="El equipo seleccionado ha sido actualizado";
                    }
                    else {
                    $msg="El equipo seleccionado no ha sido actualizado";
                    }
                }
                else {
                    $msg= "El equipo no ha sido encontrado";
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
            $idequipo = Html::encode($_POST["id_"]);
            if((int) $idequipo)
            {
              try {
                Equipos::deleteAll("id=:id", [":id" => $idequipo]);
                echo "el equipo con id $idequipo eliminado con éxito, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("equipo/ver")."'>";
              } catch (\Exception $e) {
                echo "Ha ocurrido un error al eliminar el equipo por que esta asociado a otras tablas de la base de datos, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("equipo/ver")."'>";
              }
            }
            else
            {
              echo "Ha ocurrido un error al eliminar el equipo, redireccionando ...";
              echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("equipo/ver")."'>";
            }
        }
        else
        {
            return $this->redirect(["equipo/ver"]);
        }
    }

    public function actionCrear()
    {
        $model = new ModeloEquipo;
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
                $table = new Equipos;
                $table->nombre = $model->nombre;
                $table->division = $model->division;
                $table->categoria = $model->categoria;
                if ($table->insert())
                {
                    $model->nombre = null;
                    $model->division = null;
                    $model->categoria = null;
                    $msg = "Enhorabuena, se creo el equipo";
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
        $table = new Equipos;
        $model = $table->find()->all();
        return $this->render("ver",["model"=>$model]);
    }

    public function actionBorrar_asignacion(){

        if(Yii::$app->request->post())
        {
            $id = Html::encode($_POST["id_"]);
            $id1 = Html::encode($_POST["id1_"]);
            try {

                $id_usuario = Users::find()->where(['id' => $id1])->one();

            } catch (\Exception $e) {

            }

            try {

                $id_equipo = Equipos::find()->where(['id' => $id])->one();

            } catch (\Exception $e) {
            

            }

            if((int) $id_equipo->id and (int) $id_usuario->id)
            {

                try {

                Yii::$app->db->createCommand("DELETE FROM equipo_tiene_usuarios where idequipo = '$id_equipo->id' and idusuario = '$id_usuario->id'")->queryAll();

                }catch (\Exception $e) {

                echo "La asignacion se ha eliminado con éxito, redireccionando ...";
                echo "<meta http-equiv='refresh' content='1; ".Url::toRoute("equipo/ver")."'>";

                }

            }
            else
            {
                echo "1 Ha ocurrido un error al eliminar la asignacion se ha eliminado con éxito, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("equipo/ver")."'>";
            }
        }
        else
        {
            return $this->redirect(["equipo/ver"]);
        }
    }
   
    public function actionVer_asignaciones()
    {
        $form = new ModeloBusqueda;
        $search = null;
        if($form->load(Yii::$app->request->get()))
        {
            if ($form->validate() )
            {
                $search = Html::encode($form->q);

                    try {
                    $array = Yii::$app->db->createCommand("SELECT eq.nombre nombre_equipo, u.nombre_completo nombre_usuario, u.nombre_usuario nombre  FROM equipo_tiene_usuarios e, equipo eq, usuario u where e.idequipo = eq.id and u.id = e.idusuario and eq.nombre like '%$search%' ")->queryAll();

                    } catch (\Exception $e) {
                        echo "Ha ocurrido un error, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("equipo/ver_asignaciones")."'>";
                    }

                $model =$array;
            }
            else
            {
                $form->getErrors();
            }
        }
        else
        {
            $array = Yii::$app->db->createCommand('SELECT eq.nombre nombre_equipo, u.nombre_completo nombre_usuario, u.nombre_usuario nombre FROM equipo_tiene_usuarios e, equipo eq, usuario u where e.idequipo = eq.id and u.id = e.idusuario')->queryAll();
            $model = $array;

        }
        return $this->render("ver_asignaciones", ["model" => $model, "form" => $form, "search" => $search]);
    }
   
    public function actionAsignar_alumno(){

        $model = new ModeloAsignacion;
        $msg = null;
        $select = (null);
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new Asignacionusuario;
                for ($i=0; $i<count($model->idusuario)  ; $i++) {
                    $table->idequipo = $model->idequipo;
                    $table->idusuario= $model->idusuario[$i];
                    try {

                        $table->insert();

                    } catch (\Exception $e) {

                    }
                }
                if ($i==count($model->idusuario))
                {
                    $msg = "Enhorabuena registro guardado correctamente";
                    $model->idequipo=null;
                    $model->idusuario=null;

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
        return $this->render("asignar_alumno", ['model' => $model, 'msg' => $msg]);
    }
    public function actionEquipos_profesor()
    {
        $id=Yii::$app->user->identity->id;
        $consulta="SELECT e.id, e.nombre, e.division, e.categoria 
            FROM dia_entrenamiento d, equipo e 
            WHERE d.equipo_idequipo=e.id and d.usuario_idusuario=".$id;
        if((int)$id){
            $array = Yii::$app->db->createCommand($consulta)->queryAll();
            $items = ArrayHelper::index($array, 'id');
        }else {
            return $this->redirect(["/site/index"]);
        }             
        return $this->render("equipos_profesor", ["items" => $items]);
    }
    public function actionEquipos_deportista()
    {
        $id=Yii::$app->user->identity->id;
        $consulta="select a.* from equipo_tiene_usuarios b, equipo a where a.id = b.idequipo and idusuario = ".$id;
        if((int)$id){
            $array = Yii::$app->db->createCommand($consulta)->queryAll();
            $items = ArrayHelper::index($array, 'id');
        }else {
            return $this->redirect(["/site/index"]);
        }             
        return $this->render("equipos_deportista", ["items" => $items]);
    }
    public function actionVer_equipo()
    {   if(Yii::$app->request->get("id")) {
            $id=Html::encode($_GET["id"]);
            if ((int) $id) {
                $consulta="select b.id as id, b.nombre_completo as nombre from equipo_tiene_usuarios a, usuario b where a.idusuario=b.id and a.idequipo =".$id;
                $array = Yii::$app->db->createCommand($consulta)->queryAll();
                $items = ArrayHelper::index($array, 'id');
            }else {
                return $this->redirect(["equipo/ver"]);
            }
        }
        else {
            return $this->redirect(["equipo/ver"]);
        }
        return $this->render("ver-equipo", ["items" => $items, "id" => $id]);
    }
}
