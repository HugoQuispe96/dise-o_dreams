<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("lugar/ver") ?>">Lista de lugares</a>

<h1>Crear Lugar de entrenamiento</h1>
<h3><?= $msg ?></h3>
<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>
<div class="form-group">
 <?= $form->field($model, "nombre")->input("nombre") ?>
</div>
<div class="form-group">
 <?= $form->field($model, "direccion")->input("direccion") ?>
</div>

<?= Html::submitButton("Crear", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>