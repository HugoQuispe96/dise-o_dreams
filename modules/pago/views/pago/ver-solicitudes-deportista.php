<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>
<h3>Lista de Solicitudes</h3>
<table class="table table-bordered">
  <th>ID</th>
  <th>Concepto</th>
  <th>Estado</th>
  <th>Ver más</th>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'nombre')),0,strlen(ArrayHelper::GetValue($row,'nombre'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'estado')),0,strlen(ArrayHelper::GetValue($row,'estado'))) ?></td>
    </tr>

  <?php endforeach ?>
</table>
