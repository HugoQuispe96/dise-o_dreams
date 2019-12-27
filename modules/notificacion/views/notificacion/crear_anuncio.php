<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


ini_set('date.timezone','America/Santiago');
$hoy = date("Y-m-d");
?>

<h3><?= $msg ?></h3>

<h1>Crear Notificacion</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => true,
 'enableAjaxValidation' => false,
]);
?>

<div class="form-group">
 <?= $form->field($model, "mensaje")->input("Mensaje") ?>
</div>
<div class="form-group">
 <?= $form->field($model, "dias")->input("dias") ?>
</div>
<div class="form-group">
 <?= $form->field($model, "fecha")->dropDownList([
    $hoy => $hoy,

]); ?>
</div>






<?= Html::submitButton("crear notificacion", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
