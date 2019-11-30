<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\rol\models\Roles;
?>

<h3><?= $msg ?></h3>
<h1>Actualizar Usuario</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => true,
 'enableAjaxValidation' => false,
]);
?>
<div class="form-group">
    <?= $form->field($model, "nombre_usuario")->input("nombre_usuario") ?>   
    </div>

    <div class="form-group">
    <?= $form->field($model, "contraseña")->input("password") ?>   
    </div>

    <div class="form-group">
    <?= $form->field($model, "contraseña_repeat")->input("password") ?>   
    </div>

    <div class="form-group">
        <?= $form->field($model, "rol")->dropDownList(['administrador' => 'administrador', 'profesor' => 'profesor', 'deportista' => 'deportista    '],['prompt'=>'Seleccionar rol'])?>
    </div>

    <div class="form-group">
    <?= $form->field($model, "nombre_completo")->input("nombre_completo") ?>   
    </div>

    <div class="form-group">
    <?= $form->field($model, "rut")->input("rut") ?>   
    </div>

    <div class="form-group">
    <?= $form->field($model, "email")->input("email") ?>   
    </div>

    <div class="form-group">
    <?= $form->field($model, "direccion")->input("direccion") ?>   
    </div>

    <div class="form-group">
    <?= $form->field($model, "fechanacimiento")->input("fechanacimiento") ?>   
    </div>

    <div class="form-group">
    <?= $form->field($model, "celular")->input("celular") ?>   
    </div>
    
    <?= $form->field($model, "id")->input("hidden")->label(false) ?>

<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>



<?php $form->end() ?>