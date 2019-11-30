<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>

<h3>Lista de Alumnos</h3>
<table class="table table-bordered">
  <th>Nombre usuario</th>
  <th>Nombre </th>
  <th>Email</th>
  <th>Direccion</th>
  <th>Rut</th>
  <th>Fecha de nacimiento</th>
  <th>Celular</th>
  <th>Rol</th>
  <th>Modificar</th>
  <th>Eliminar</th>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= substr((ArrayHelper::GetValue($row,'nombre_usuario')),0,strlen(ArrayHelper::GetValue($row,'nombre_usuario'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'nombre_completo')),0,strlen(ArrayHelper::GetValue($row,'nombre_completo'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'email')),0,strlen(ArrayHelper::GetValue($row,'email'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'direccion')),0,strlen(ArrayHelper::GetValue($row,'direccion'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'rut')),0,strlen(ArrayHelper::GetValue($row,'rut'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'fechanacimiento')),0,strlen(ArrayHelper::GetValue($row,'fechanacimiento'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'celular')),0,strlen(ArrayHelper::GetValue($row,'celular'))) ?></td>
      <td><?= substr((ArrayHelper::GetValue($row,'rol')),0,strlen(ArrayHelper::GetValue($row,'rol'))) ?></td>
      <td><a href="<?= Url::toRoute(["usuario/actualizar","id"=>substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id')))])?>">Actualizar</a></td>
      <td>
           <a href="#" data-toggle="modal" data-target="#id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">Eliminar</a>
           <div class="modal fade" role="dialog" aria-hidden="true" id="id_<?= substr((ArrayHelper::GetValue($row,'id')),0,strlen(ArrayHelper::GetValue($row,'id'))) ?>">
                     <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   <h4 class="modal-title">Eliminar alumno</h4>
                             </div>
                             <div class="modal-body">
                                   <p>¿Realmente deseas eliminar al alumno <?= substr((ArrayHelper::GetValue($row,'nombre_usuario')),0,strlen(ArrayHelper::GetValue($row,'nombre_usuario'))) ?>?</p>
                             </div>
                             <div class="modal-footer">
                             <?= Html::beginForm(Url::toRoute("usuario/borrar"), "POST") ?>
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

