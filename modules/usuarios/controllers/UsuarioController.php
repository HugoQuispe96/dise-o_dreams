<?php

namespace app\modules\usuarios\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\usuarios\models\FormRegister;
use app\modules\usuarios\models\ModeloActualizarusuario;
use app\modules\usuarios\models\Users;
use app\modules\usuarios\models\User;
use app\modules\usuarios\models\LoginForm;
use yii\helpers\ArrayHelper;


class UsuarioController extends Controller
{   public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['actualizar','borrar','register','ver','randKey'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['actualizar','borrar','register','ver','randKey'],
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            return User::isAdministrador();
                        },
                    ],
                ], 
            ],
        ];
    }
    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
 
    public function actionRegister()
    {
        $model = new FormRegister;
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
                $table = new Users;
                $table->nombre_usuario = $model->nombre_usuario;
                $table->contraseña = crypt($model->contraseña, Yii::$app->params["salt"]);
                $table->rol = $model->rol;
                $table->nombre_completo = $model->nombre_completo;
                $table->rut = $model->rut;
                $table->email = $model->email;
                $table->direccion = $model->direccion;
                $table->fechanacimiento = $model->fechanacimiento;
                $table->celular = $model->celular;
                $table->authKey = $this->randKey("abcdef0123456789", 200);
                $table->accessToken = $this->randKey("abcdef0123456789", 200);
                if ($table->insert())
                {
                    $model->nombre_usuario = null;
                    $model->contraseña = null;
                    $model->contraseña_repeat = null;
                    $model->rol=null;
                    $model->nombre_completo= null;
                    $model->rut=null;
                    $model->email=null;
                    $model->direccion=null;
                    $model->fechanacimiento=null;
                    $model->celular=null;
                    $msg = "Enhorabuena, se creo el usuario con exito";
                }
                else
                {
                    $msg = "Ha ocurrido un error al llevar a cabo tu registro";
                }
                
            }
            else
            {
                $model->getErrors();
            }
        }
        return $this->render("registro", ["model" => $model, "msg" => $msg]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->contraseña = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionVer()
    {
        $array = Yii::$app->db->createCommand('SELECT * FROM usuario')->queryAll();
        $items = ArrayHelper::index($array, 'id');
        return $this->render("ver", ["items" => $items]);
    }
    public function actionActualizar()
    {
        $model = new ModeloActualizarusuario;
        $msg=null;

        if (Yii::$app->request->get("id")) {
            $id=Html::encode($_GET["id"]);
            if ((int) $id) {
                $table = Users::findOne($id);
                if($table){
                    $model->id= $table->id;                    
                    $model->nombre_usuario= $table->nombre_usuario;
                    $model->rol= $table->rol; 
                    $model->nombre_completo= $table->nombre_completo;
                    $model->direccion= $table->direccion;
                    $model->email= $table->email;
                    $model->rut= $table->rut;
                    $model->celular= $table->celular;
                    $model->fechanacimiento= $table->fechanacimiento;
                }
                else {
                    return $this->redirect(["/usuarios/usuario/ver"]);
                }
            }else {
                return $this->redirect(["/usuarios/usuario/ver"]);
            }
        }
        else {
            return $this->redirect(["/usuarios/usuario/ver"]);
        }
        
        if($model->load(Yii::$app->request->post()))
        {
            if ($model->validate()) {
                $table = Users::findOne($model->id);
                if ($table ) {
                    $table->id= $model->id;                    
                    $table->nombre_usuario= $model->nombre_usuario;
                    $table->rol= $model->rol; 
                    $table->nombre_completo= $model->nombre_completo;
                    $table->direccion= $model->direccion;
                    $table->email= $model->email;
                    $table->rut= $model->rut;
                    $table->celular= $model->celular;
                    $table->fechanacimiento= $model->fechanacimiento;

                    if ($table->update()) {
                        $msg="El alumno seleccionado ha sido actualizado";
                    }
                    else {
                        $msg="El alumno seleccionado no ha sido actualizado";
                    }
                }
                else {
                $msg= "El alumnos no ha sido encontrado";
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
            $id_alumno = Html::encode($_POST["id_"]);
            if((int) $id_alumno)
            {


              try {
                  Users::deleteAll("id=:id", [":id" => $id_alumno]);
                  echo "Usuario con id $id_alumno eliminado con éxito, redireccionando ...";
                  echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/ver")."'>";
              } catch (\Exception $e) {
                echo "Ha ocurrido un error al eliminar el alumno por estar asociado a otra tabla, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/ver")."'>";
              }
            }
            else
            {
                echo "Ha ocurrido un error al eliminar el alumno, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("usuario/ver")."'>";
            }
        }
        else
        {
            return $this->redirect(["usuario/ver"]);
        }
    }
}