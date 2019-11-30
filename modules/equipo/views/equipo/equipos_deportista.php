<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<h3>Mis equipos</h3>
<table class="table table-bordered">
    <tr>
        <th>Nombre</th>
        <th>Division</th>
        <th>Categoria</th>
    </tr>
    <?php foreach ($items as $row): ?>
      <tr>
        <td><?= substr((ArrayHelper::GetValue($row,'nombre')),0,strlen(ArrayHelper::GetValue($row,'nombre'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'division')),0,strlen(ArrayHelper::GetValue($row,'division'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'categoria')),0,strlen(ArrayHelper::GetValue($row,'categoria'))) ?></td>
      </tr>
    <?php endforeach ?>
</table>