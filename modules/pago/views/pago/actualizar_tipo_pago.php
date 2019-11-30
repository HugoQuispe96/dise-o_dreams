<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("pago/ver_tipo_pago") ?>">Ver tipos de pago</a>

<h1>Editar tipo de pago con id : <?= Html::encode($_GET["id"]) ?></h1>

<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "nombre")->input("nombre") ?>
</div>

<div class="form-group">
 <?= $form->field($model, "descripcion")->input("descripcion") ?>
</div>

<div class="form-group">
 <?= $form->field($model, "precio")->input("precio") ?>
</div>

<div class="form-group">
 <?= $form->field($model, "interes")->input("interes") ?>
</div>




<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
