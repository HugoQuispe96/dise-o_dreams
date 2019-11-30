<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login'; 
?>
<div class="site-login">
    <h1 style="text-align: center">Inicio de sesion</h1>

    <p style="text-align: center">Rellene los campos con la informacion correspondiente:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'nombre_usuario')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'contraseña')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-3 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-5 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
