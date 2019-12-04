<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<h3>Lista de Equipos</h3>
<table class="table table-bordered">
  <th>id</th>
  <th>nombre</th>
  <th>division</th>
  <th>categoria</th>
  <th>Modificar</th>
  <th>Eliminar</th>
  <?php foreach ($model as $row ): ?>
    <tr>
      <td><?= $row->id?></td>
      <td><?= $row->nombre?></td>
      <td><?= $row->division?></td>
      <td><?= $row->categoria?></td>

      <td><a href="<?= Url::toRoute(["equipo/actualizar","id"=>$row->id])?>">Actualizar</a></td>

      <td>
           <a href="#" data-toggle="modal" data-target="#id_<?= $row->id ?>">Eliminar</a>
           <div class="modal fade" role="dialog" aria-hidden="true" id="id_<?= $row->id ?>">
                     <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title">Eliminar equipo</h4>
                             </div>
                             <div class="modal-body">
                                   <p>¿Realmente deseas eliminar el equipo <?= $row->id ?>?</p>
                             </div>
                             <div class="modal-footer">
                             <?= Html::beginForm(Url::toRoute("equipo/borrar"), "POST") ?>
                                   <input type="hidden" name="id_" value="<?= $row->id ?>">
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