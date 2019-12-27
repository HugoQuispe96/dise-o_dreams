<?php
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->title = 'Dreams All Stars Arica';
?>
<div class="site-index">

  <h2>Notificaciones</h2>
    <table id="tabladiseno" class="table table-bordered">
      <th>¡Noticia!</th>

      <?php foreach ($items as $row ): ?>
        <tr>
          <td><?= substr((ArrayHelper::GetValue($row,'mensaje')),0,strlen(ArrayHelper::GetValue($row,'mensaje'))) ?></td>
        </tr>

      <?php endforeach ?>
    </table>
</div>