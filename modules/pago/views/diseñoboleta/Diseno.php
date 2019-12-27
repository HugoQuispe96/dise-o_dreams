<?php
namespace app\modules\pago\views\diseñoboleta;
use Yii;

class Diseno{
  public static function getPlantilla($id,$valor,$nombre_usuario,$rut_usuario,$concepto){

    $plantilla = '<body>
    <header class="clearfix">
            <div id="logo">
              <img src ="https://dreamsallstararica.com/wp-content/uploads/elementor/thumbs/cropped-Logo-ogqiwmj3axi8oqofz6i9viyh5cplaudyepy94qclmc.png?fbclid=IwAR3YqGK41WVfUAg1plXpa7SKjPqi_BcY2LQndCsgjJ7ZQwMO7RnQSml2tjo">
            </div>
            <div  id="campany">
            <h2 id="name">Club Dreams All Stars</h2>
            <div>Direccion 123, Arica-Chile</div>
            <div>(+569)87654321</div>
            <div><a href="Dreamsallstarsarica@hotmail.com">Dreamsallstarsarica@hotmail.com</a></div>
            </div>
          </header>
          <h3>Boleta</h3>
          <main>
          <table>
          <thead>
          <tr>
            <th>Número de Boleta</th>
            <th>Nombre de usuario</th>
            <th>Rut</th>
            <th>Fecha de pago</th>
            <th>Concepto</th>
            <th>Monto pagado</th>
            </tr>
          </thead>
              <tr>
                <td>'. $id . '</td>
                <td>'. $nombre_usuario .'</td>
                <td>'. $rut_usuario .'</td>
                <td>'. date('Y-m-d') .'</td>
                <td>'. $concepto .'</td>
                <td>'. $valor .'</td>

              </tr>

          </table>
          </main>
                  </body>';

    return $plantilla;
  }

  public function getCss()
  {
    $css = '
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color:#0087C3;
      text-decoration: none;
    }

    body {
        height: 100%;
        width: 100%;
        position: relative;
        margin:0 auto;
        color: #555555;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    header{
      padding: 10px 0;
      margin-bottom: 20px;
      border-bottom: 1px solid #AAAAAA;
    }

    .logo{
      float:left;
      margin-top: 8px;
    }

    .logo img {
      height: 70px;
    }

    .company {
      float:right;
      text-align: right;
    }
    .details{
      margin-bottom: 50px;
    }
    .client{
      padding-left: 6px;
      border-left: 6px solid #0087C3;
      float: left;
    }

    .client .to{
      color: #777777;
    }

    .name {
      font-size: 1.4em;
      font-weight: normal;
      margin:0;
    }
    table{
        width: 100%;
        text-align: left;
        border-collapse: collapse;
         background: #FFFFFF;
    }

    th, td{
       border: solid 1px #000000;
        padding: 10px;
    }';

    return $css;// code...
  }
}
