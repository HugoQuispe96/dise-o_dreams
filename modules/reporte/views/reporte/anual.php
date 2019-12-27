<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>



<h1>Crear Reporte</h1>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<div class="form-group">
  <?= $form->field($model, "año")->dropDownList($años,['prompt'=>'seleccionar año'])?>
</div>

<?= Html::submitButton("Crear_reporte", ["class" => "btn btn-primary"]) ?>

<h1>Reporte Anual:</h1>
<table class="table table-bordered">
  <th>Id</th>
  <th>Nombre de usuario</th>
  <th>Fecha de pago</th>
  <th>Nombre de pago</th>
  <th>Monto</th>
<?php foreach ((array) $resultado as $row ): ?>

<tr>
  <td><?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?></td>
  <td><?= substr((ArrayHelper::GetValue($row,'nombre_usuario')),0,strlen(ArrayHelper::GetValue($row,'nombre_usuario'))) ?></td>
  <td><?= substr((ArrayHelper::GetValue($row,'fecha_pago')),0,strlen(ArrayHelper::GetValue($row,'fecha_pago'))) ?></td>
  <td><?= substr((ArrayHelper::GetValue($row,'nombre_pago')),0,strlen(ArrayHelper::GetValue($row,'nombre_pago'))) ?></td>
  <td><?= substr((ArrayHelper::GetValue($row,'pago')),0,strlen(ArrayHelper::GetValue($row,'pago'))) ?></td>
</tr>

<?php endforeach; ?>
<th></th>
<th></th>
<th></th>
<th>Total</th>
<th><?= $total ?></th>

</table>
<?php $form->end() ?>
