<?php
namespace app\modules\pago\views\diseñoboleta;
use Yii;

class Diseno_solicitud{
  public static function getPlantilla($id,$estado,$concepto,$monto,$interes){

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
            <div>Cuenta corriente: 10.1578.256</div>
          </header>
          <h3>Comprobante de solicitud</h3>
          <main>
          <table>
          <thead>
          <tr>
            <th>Número de solicitud</th>
            <th>Estado de solicitud</th>
            <th>Concepto de pago</th>
            <th>Fecha de creacion</th>
            <th>Monto</th>
          </tr>
          </thead>
              <tr>
                <td>'. $id . '</td>
                <td>'. $estado .'</td>
                <td>'. $concepto .'</td>
                <td>'. date('Y-m-d') .'</td>
                <td>'. $monto .'</td>
              </tr>

          </table>
          </main>
          <h4>En caso de ser un pago atrasado, se cobrara un cargo adicional de '. $interes . '</h4>

          <h5>Este documento no es valido como boleta de pago, solo es un comprobante de solicitud</h5>
          
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
