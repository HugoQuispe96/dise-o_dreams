<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h3>Lista de lugares de entrenamientos</h3>
<table class="table table-bordered">
    <tr>
        <th>Id lugares de entrenamiento</th>
        <th>Nombre</th>
        <th>Dirección   </th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->nombre ?></td>
        <td><?= $row->direccion?></td>
        <td><a href="<?= Url::toRoute(["lugar/actualizar", "id" => $row->id]) ?>">actualizar</a></td>
        <td>
            <a href="#" data-toggle="modal" data-target="#id_<?= $row->id ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_<?= $row->id ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar lugar de entrenamiento</h4>
                              </div>
                              <div class="modal-body">
                                    <p>¿Realmente deseas eliminar el lugar de entrenamiento con id <?= $row->id ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("lugar/borrar"), "POST") ?>
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
