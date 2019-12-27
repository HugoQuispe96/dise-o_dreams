<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>

<h3>Lista de deportistas</h3>
<table class="table table-bordered">
  <th>Nombre</th>
  <th>Eliminar</th>
  <?php foreach ($items as $row ): ?>
    <tr>
      <td><?= substr((ArrayHelper::GetValue($row,'nombre')),0,strlen(ArrayHelper::GetValue($row,'nombre'))) ?></td>
      <td>
           <a href="#" data-toggle="modal" data-target="#id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">Eliminar</a>
           <div class="modal fade" role="dialog" aria-hidden="true" id="id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                     <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title">Eliminar equipo</h4>
                             </div>
                             <div class="modal-body">
                                   <p>¿Realmente deseas eliminar el alumno <?= substr((ArrayHelper::GetValue($row,'nombre')),0,strlen(ArrayHelper::GetValue($row,'nombre'))) ?>?</p>
                             </div>
                             <div class="modal-footer">
                             <?= Html::beginForm(Url::toRoute("equipo/borrar_asignacion"), "POST") ?>
                                   <input type="hidden" name="id1_" value="<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                                   <input type="hidden" name="id_" value="<?= $id?>">
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