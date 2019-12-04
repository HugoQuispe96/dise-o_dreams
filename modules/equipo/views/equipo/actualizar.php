<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<h1>Editar al equipo id <?= Html::encode($_GET["id"]) ?></h1>

<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "nombre")->input("text") ?>
</div>

<div class="form-group">
 <?= $form->field($model, "categoria")->input("text") ?>
</div>


<div class="form-group">
 <?= $form->field($model, "division")->input("text") ?>
</div>

<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>