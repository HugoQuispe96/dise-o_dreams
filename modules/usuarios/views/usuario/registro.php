<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <h3 style="text-align:center"><?= $msg ?></h3>
    <h1 style="text-align:center">Registro de usuarios</h1>
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'id' => 'formulario',
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
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

    <div class="col-lg-offset-5 col-lg-11">
        <?= Html::submitButton("Registrar", ["class" => "btn btn-primary "]) ?>
    </div>

    <?php $form->end() ?>
</div>

