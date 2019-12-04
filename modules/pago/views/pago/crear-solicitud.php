<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\pago\models\TipoPago;
?>

<h3><?= $msg ?></h3>

<h1>Crear solicitud de pago</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => true,
 'enableAjaxValidation' => false,
]);
?>

<div class="form-group">

  <?= $form->field($model, "tipopago_idtipopago")->dropDownList(ArrayHelper::map(TipoPago::find()->all(),'id','nombre'),['prompt'=>'seleccionar tipo de pago'])?>

</div>

<?= Html::submitButton("Crear", ["class" => "btn btn-primary"]) ?>



<?php $form->end() ?>