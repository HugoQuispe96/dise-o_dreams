<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>

<h3>Lista de Solicitudes</h3>
<table class="table table-bordered">
  <th>id</th>
  <th>Nombre de usuario</th>
  <th>Estado</th>
  <th>Tipo de pago</th>
  <th>Aprobar</th>
  <th>Rechazar</th>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'nombre_usuario')),0,strlen(ArrayHelper::GetValue($row,'nombre_usuario'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'estado')),0,strlen(ArrayHelper::GetValue($row,'estado'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'nombre_tipo_pago')),0,strlen(ArrayHelper::GetValue($row,'nombre_tipo_pago'))) ?></td>
      <td>
           <a href="#" data-toggle="modal" data-target="#id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">✔</a>
           <div class="modal fade" role="dialog" aria-hidden="true" id="id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                     <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title">Aprobar Solicitud</h4>
                             </div>
                             <div class="modal-body">
                                   <p>¿Realmente deseas aprobar la solicitud <?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>?</p>
                             </div>
                             <div class="modal-footer">
                             <?= Html::beginForm(Url::toRoute("pago/aprobar-solicitud"), "POST") ?>
                                   <input type="hidden" name="id_" value="<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                                   <input type="hidden" name="tipopago" value="<?= substr((ArrayHelper::GetValue($row,'tipopago_idtipopago')),0,strlen(ArrayHelper::GetValue($row,'tipopago_idtipopago'))) ?>">
                                   <input type="hidden" name="usuario" value="<?= substr((ArrayHelper::GetValue($row,'usuario_idusuario')),0,strlen(ArrayHelper::GetValue($row,'usuario_idusuario'))) ?>">
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                   <button type="submit" class="btn btn-primary">Aceptar</button>
                             <?= Html::endForm() ?>
                            </div>
                           </div><!-- /.modal-content -->
                     </div><!-- /.modal-dialog -->
           </div><!-- /.modal -->
       </td>
       <td>
           <a href="#" data-toggle="modal" data-target="#id2_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">X</a>
           <div class="modal fade" role="dialog" aria-hidden="true" id="id2_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                     <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title">Rechazar Solicitud</h4>
                             </div>
                             <div class="modal-body">
                                   <p>¿Realmente deseas rechazar la solicitud <?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>?</p>
                             </div>
                             <div class="modal-footer">
                             <?= Html::beginForm(Url::toRoute("pago/rechazar-solicitud"), "POST") ?>
                                   <input type="hidden" name="id_" value="<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                                    <h4 style="text-align:center">Mensaje de rechazo:</h4>
                                    <input type="text" name="mensaje" size="75"><br><br><br>
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                   <button type="submit" class="btn btn-primary">Aceptar</button>
                             <?= Html::endForm() ?>
                            </div>
                           </div><!-- /.modal-content -->
                     </div><!-- /.modal-dialog -->
           </div><!-- /.modal -->
       </td>

    </tr>

  <?php endforeach ?>
</table>
