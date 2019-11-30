<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\equipo\models\Equipos;
use app\modules\usuarios\models\Users;
$this->title = 'Asignar usuarios';
$this->params['breadcrumbs'][] = ['label' => 'Lista de asignaciones', 'url' => ['equipo/ver_asignaciones']];
?>

<h3><?=$msg?></h3>
<h1>Asignar</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => true,
 'enableAjaxValidation' => false,
]);
?>

<div class="form-group">

  <?= $form->field($model, "idequipo")->dropDownList(ArrayHelper::map(Equipos::find()->all(),'id','nombre'),['prompt'=>'seleccionar Equipo'])?>

</div>

<div class="form-group">


  <?= $form->field($model,'idusuario')->checkBoxList(ArrayHelper::map(Users::find()->where("rol='deportista'")->All(),'id','nombre_completo'),['prompt'=>'seleccionar los integrantes del equipo']);
  ?>
</div>

<?= Html::submitButton("Asignar", ["class" => "btn btn-primary"]) ?>



<?php $form->end() ?>
