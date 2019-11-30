<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("pago/ver_tipo_pago") ?>">Lista de tipos de pago</a>

<h1>Crear tipo de pago</h1>
<h3><?= $msg ?></h3>
<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>
<div class="form-group">
    <?= $form->field($model, "nombre")->input("nombre") ?>   
    <?= $form->field($model, "descripcion")->input("descripcion") ?> 
    <?= $form->field($model, "precio")->input("precio") ?>   
    <?= $form->field($model, "interes")->input("interes") ?>  
</div>

<?= Html::submitButton("Crear", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>