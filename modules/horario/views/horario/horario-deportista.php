<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<h3>Lista de dias de entrenamientos</h3>
<table class="table table-bordered">
    <tr>
        <th>Equipo</th>
        <th>Lugar de entrenamiento</th>
        <th>Profesor asignado</th>
        <th>Dia</th>
        <th>Hora Inicio</th>
        <th>Hora Termino</th>
    </tr>
    <?php foreach ($items as $row): ?>
      <tr>
        <td><?= substr((ArrayHelper::GetValue($row,'nombre_equipo')),0,strlen(ArrayHelper::GetValue($row,'nombre_equipo'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'nombre_lugar')),0,strlen(ArrayHelper::GetValue($row,'nombre_lugar'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'nombre_profesor')),0,strlen(ArrayHelper::GetValue($row,'nombre_profesor'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'dia')),0,strlen(ArrayHelper::GetValue($row,'dia'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'Hora_inicio')),0,strlen(ArrayHelper::GetValue($row,'Hora_inicio'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'Hora_fin')),0,strlen(ArrayHelper::GetValue($row,'Hora_fin'))) ?></td>
      </tr>
    <?php endforeach ?>
</table>