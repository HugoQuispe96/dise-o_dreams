<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\sidenav\SideNav;
use app\modules\usuarios\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="cabecera" >
        <?php
        NavBar::begin([
            'brandImage' => 'https://dreamsallstararica.com/wp-content/uploads/elementor/thumbs/cropped-Logo-ogqiwmj3axi8oqofz6i9viyh5cplaudyepy94qclmc.png',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
                'style' => 'background-color: #474747;; border-bottom: 2.5px groove; height: 10%;'
            ],
        ]);
        $navItems=[
        ];
        if (Yii::$app->user->isGuest) {
            array_push($navItems, ['label' => 'Volver a pagina principal', 'url' => 'http://dreamsallstararica.com/']);
            array_push($navItems, ['label' => 'Ingresar', 'url' => ['/usuarios/usuario/login']]);
        } else {
            array_push($navItems,['label' => 'Logout (' . Yii::$app->user->identity->nombre_usuario . ')',
                'url' => ['/usuarios/usuario/logout'],
                'linkOptions' => ['data-method' => 'post']]);
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $navItems,
        ]);
        NavBar::end();
        ?>
    </div>
    <div class="row">
        <div class="col-sm-2">
        <?php
            if (Yii::$app->user->isGuest) {

            }else if(User::isAdministrador()){
                echo SideNav::widget([
                    'type' => SideNav::TYPE_PRIMARY,
                    'heading' => 'Opciones',
                    'items' => [
                        [
                            'label' => 'Usuarios',
                            'icon' => 'user',
                            'items' => [
                                ['label' => 'Registro', 'url' => ['/usuarios/usuario/register']],
                                ['label' => 'Ver usuarios', 'url' => ['/usuarios/usuario/ver']],
                            ],
                        ],
                        [
                            'label' => 'Equipos',
                            'icon' => 'user',
                            'items' => [
                                ['label' => 'Nuevo equipo', 'url' => ['/equipo/equipo/crear']],
                                ['label' => 'Ver equipos', 'url' => ['/equipo/equipo/ver']],
                                [   'label' => 'Asignaciones',
                                    'items' => [
                                        ['label' => 'Nueva asignacion', 'url' => ['/equipo/equipo/asignar_alumno']],
                                        ['label' => 'Ver asignaciones', 'url' => ['/equipo/equipo/ver_asignaciones']],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'label' => 'Lugares',
                            'icon' => 'user',
                            'items' => [
                                ['label' => 'Nuevo Lugar', 'url' => ['/lugar/lugar/crear']],
                                ['label' => 'Ver lugares', 'url' => ['/lugar/lugar/ver']],
                            ],
                        ],
                        [
                            'label' => 'Horario',
                            'icon' => 'user',
                            'items' => [
                                ['label' => 'Nuevo horario', 'url' => ['/horario/horario/crear']],
                                ['label' => 'Ver horarios', 'url' => ['/horario/horario/ver']],
                            ],
                        ],
                        [
                            'label' => 'Pagos',
                            'icon' => 'user',
                            'items' => [
                                [   'label' => 'Tipo de pagos',
                                    'icon' => 'user',
                                    'items' => [
                                        ['label' => 'Nuevo tipo de pago', 'url' => ['/pago/pago/crear_tipo_pago']],
                                        ['label' => 'Ver tipos de pago', 'url' => ['/pago/pago/ver_tipo_pago']],
                                    ],
                                ],
                                ['label' => 'Solicitudes pendientes', 'url' => ['/pago/pago/ver-solicitudes']],
                            ],
                        ],
                        ['label' => 'Mi Perfil', 'url' => ['/pruebas/prueba/administrador'], 'icon' => 'user'],
                    ],
                ]); 
            }else if(User::isProfesor()){
                echo SideNav::widget([
                    'type' => SideNav::TYPE_PRIMARY,
                    'heading' => 'Opciones',
                    'items' => [
                        ['label' => 'Mis Horarios', 'url' => ['/horario/horario/horario_profesor'], 'icon' => 'user'],
                        ['label' => 'Mis equipos', 'url' => ['/equipo/equipo/equipos_profesor'], 'icon' => 'user'],
                        [
                            'url' => ['/site/index'],
                            'label' => 'Home',
                            'icon' => 'home'
                        ],
                        [
                            'label' => 'Help',
                            'icon' => 'question-sign',
                            'items' => [
                                ['label' => 'About', 'icon'=>'info-sign', 'url'=> ['/site/about']],
                                ['label' => 'Contact', 'icon'=>'phone', 'url'=>['/site/contact']],
                            ],
                        ],
                        ['label' => 'Mi perfil', 'url' => ['/pruebas/prueba/profesor'], 'icon' => 'user'],
                    ],
                ]); 
            }else if(User::isDeportista()){
                echo SideNav::widget([
                    'type' => SideNav::TYPE_PRIMARY,
                    'heading' => 'Opciones',
                    'items' => [
                        ['label' => 'Mis Horarios', 'url' => ['/horario/horario/horario_deportista'], 'icon' => 'user'],
                        ['label' => 'Mis equipos', 'url' => ['/equipo/equipo/equipos_deportista'], 'icon' => 'user'],
                        [
                            'label' => 'Pagos',
                            'icon' => 'question-sign',
                            'items' => [
                                ['label' => 'Nueva solicitud', 'icon'=>'info-sign', 'url'=> ['/pago/pago/crear-solicitud']],
                                ['label' => 'Solicitudes realizadas', 'icon'=>'phone', 'url'=>['/pago/pago/ver-solicitudes-deportista']],
                            ],
                        ],
                        ['label' => 'Mi perfil', 'url' => ['/pruebas/prueba/deportista'], 'icon' => 'user'],
                    ],
                ]); 
            }
        ?>
        </div>
        <div class="col-sm-10">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <p class="pull-left">&copy;Dreams All Stars <?= date('Y') ?></p>
            <p class="pull-right"> Desarrollado por estudiantes de la Universidad de Tarapacá</p>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>