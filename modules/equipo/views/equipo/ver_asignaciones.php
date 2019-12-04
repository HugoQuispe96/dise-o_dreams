<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use app\modules\equipo\models\Equipos;

$this->title = 'Lista de usuario';
?>

<?php $f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("equipo/ver_asignaciones"),
    "enableClientValidation" => true,
]);
?>

<div class="form-group">
    <?= $f->field($form, "q")->input("buscar")->dropDownList(ArrayHelper::map(Equipos::find()->all(),'nombre','nombre'),['prompt'=>'Buscar por equipo']) ?>
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>

<h3>lista de asignaciones</h3>
<table class="table table-bordered">

    <tr>
        <th>Nombre del Equipo</th>
        <th>Nombre del alumno</th>
        <th>Nombre del usuario</th>
        <th></th>

    </tr>

    <?php foreach($model as $row): ?>
        <tr>

          <td><?= $equipo = substr((ArrayHelper::GetValue($row,'nombre_equipo')),0,strlen(ArrayHelper::GetValue($row,'nombre_equipo'))) ?></td>
          <td><?= substr((ArrayHelper::GetValue($row,'nombre_usuario')),0,strlen(ArrayHelper::GetValue($row,'nombre_usuario'))) ?></td>
          <td><?= $usuario = substr((ArrayHelper::GetValue($row,'nombre')),0,strlen(ArrayHelper::GetValue($row,'nombre'))) ?></td>
          <td>
               <a href="#" data-toggle="modal" data-target="#id_">Eliminar</a>
               <div class="modal fade" role="dialog" aria-hidden="true" id="id_">
                         <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                       <h4 class="modal-title">Eliminar asignacion</h4>
                                 </div>
                                 <div class="modal-body">
                                       <p>¿Realmente deseas eliminar la asignacion?</p>
                                       <input type="text" name="id_" value="<?= $equipo ?>">
                                       <input type="text" name="id1_" value="<?= $usuario ?>">
                                 </div>
                                 <div class="modal-footer">
                                 <?= Html::beginForm(Url::toRoute("equipo/borrar_asignacion"), "POST") ?>
                                       <input type="hidden" name="id_" value="<?= $equipo ?>">
                                       <input type="hidden" name="id1_" value="<?= $usuario ?>">
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
