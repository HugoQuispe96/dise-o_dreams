<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<a href="<?= Url::toRoute("horario/crear") ?>">Crear un nuevo dia de entrenamiento</a>



<h3>Lista de dias de entrenamientos</h3>
<table class="table table-bordered">
    <tr>
        <th>Id dia de entrenamiento</th>
        <th>equipo</th>
        <th>Lugar de entrenamiento</th>
        <th>Profesor asignado</th>
        <th>Dia</th>
        <th>Hora Inicio</th>
        <th>Hora Termino</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($items as $row): ?>
      <tr>
        <td><?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'nombre_equipo')),0,strlen(ArrayHelper::GetValue($row,'nombre_equipo'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'nombre_lugar')),0,strlen(ArrayHelper::GetValue($row,'nombre_lugar'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'nombre_profesor')),0,strlen(ArrayHelper::GetValue($row,'nombre_profesor'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'dia')),0,strlen(ArrayHelper::GetValue($row,'dia'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'Hora_inicio')),0,strlen(ArrayHelper::GetValue($row,'Hora_inicio'))) ?></td>
        <td><?= substr((ArrayHelper::GetValue($row,'Hora_fin')),0,strlen(ArrayHelper::GetValue($row,'Hora_fin'))) ?></td>
        <td><a href="<?= Url::toRoute(["horario/actualizar","id"=>substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id')))])?>">Actualizar</a></td>
        <td>
             <a href="#" data-toggle="modal" data-target="#id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">Eliminar</a>
             <div class="modal fade" role="dialog" aria-hidden="true" id="id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                       <div class="modal-dialog">
                             <div class="modal-content">
                               <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                     <h4 class="modal-title">Eliminar dia de entrenamiento</h4>
                               </div>
                               <div class="modal-body">
                                     <p>¿Realmente deseas eliminar dia de entrenamiento <?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>?</p>
                               </div>
                               <div class="modal-footer">
                               <?= Html::beginForm(Url::toRoute("horario/borrar"), "POST") ?>
                                     <input type="hidden" name="id_" value="<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                     <button type="submit" class="btn btn-primary">Eliminar</button>
                               <?= Html::endForm() ?>
                              </div>
                             </div><!-- /.modal-content -->
                       </div><!-- /.modal-dialog -->
             </div><!-- /.modal -->
         </td>

      </tr>

    <?php endforeach ?>
</table>
