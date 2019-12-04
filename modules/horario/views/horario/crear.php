<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\usuarios\models\Users;
use app\modules\lugar\models\Lugarentrenamiento;
use app\modules\equipo\models\Equipos;

?>

<h3><?= $msg ?></h3>

<h1>Crear dia de entrenamiento</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => true,
 'enableAjaxValidation' => false,
]);
?>

<div class="form-group">
  <?= $form->field($model, "dia")->dropDownList(['Lunes' => 'Lunes', 'Martes' => 'Martes', 'Miercoles' => 'Miercoles', 'Jueves' => 'Jueves', 'Viernes' => 'Viernes', 'Sabado' => 'Sabado', 'Domingo' => 'Domingo'],['prompt'=>'seleccionar dia del entrenamiento'])?>
</div>

<div class="form-group">
 <?= $form->field($model, "Hora_inicio")->input("Hora_inicio") ?>
</div>


<div class="form-group">
 <?= $form->field($model, "Hora_fin")->input("Hora_fin") ?>
</div>

<div class="form-group">

  <?= $form->field($model, "lugar_idlugar")->dropDownList(ArrayHelper::map(Lugarentrenamiento::find()->all(),'id','nombre'),['prompt'=>'seleccionar lugar de entrenamiento'])?>

</div>

<div class="form-group">

  <?= $form->field($model, "equipo_idequipo")->dropDownList(ArrayHelper::map(Equipos::find()->all(),'id','nombre'),['prompt'=>'seleccionar Equipo'])?>

</div>

<div class="form-group">

  <?= $form->field($model, "usuario_idusuario")->dropDownList(ArrayHelper::map(Users::find()->where(['rol'=>"profesor"])->all(),'id','nombre_completo'),['prompt'=>'seleccionar Profesor asignado'])?>

</div>

<?= Html::submitButton("Crear", ["class" => "btn btn-primary"]) ?>



<?php $form->end() ?>