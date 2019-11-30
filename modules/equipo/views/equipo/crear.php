<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<h3><?= $msg ?></h3>

<a href="<?= Url::toRoute("equipo/ver")?>">Ir a la lista de equipos</a>

<h1>Crear Equipo</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => true,
 'enableAjaxValidation' => false,
]);
?>
<div class="form-group">
 <?= $form->field($model, "nombre")->input("nombre") ?>
</div>

<div class="form-group">
 <?= $form->field($model, "division")->input("division") ?>
</div>

<div class="form-group">
 <?= $form->field($model, "categoria")->input("categoria") ?>
</div>

<?= Html::submitButton("crear equipo", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
