<?php
defined('BASEPATH') OR exit('No direct script access allowed');
foreach($boleta as $row){
  if($row->fin!='')
    $dif = $row->dif2;
  else
    $dif = $row->dif1;
  if($row->estado!=2){
    if($dif<=15){
      if( $dif>10)
        $stat = '<span style="font-size:14px;" class="label bg-blue">'.$dif.' dias</span>';
      else{
        if ($dif>5) 
          $stat = '<span style="font-size:14px;" class="label bg-yellow">'.$dif.' dias</span>';
        else{
          $stat = '<span style="font-size:14px;" class="label bg-red">'.$dif.' dias</span>';
        }
      }
    }
    else{
      $stat = '<span style="font-size:14px;" class="label bg-green">'.$dif.' dias</span>';
    }
  }
  else{
    $stat = '<span style="font-size:14px;" class="label bg-green">Liberado</span>';
  }
  if($row->respaldo!=''){
    $stat .= '<a class="btn btn-social btn-success" style="margin-left:10px;" href="'.base_url('assets/respaldo/'.$row->respaldo).'" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar Respaldo</a>';
  }
  else{
    $stat .= '<a class="btn btn-social btn-danger" style="margin-left:10px;" href="javascript:;"><i class="fa fa-file-pdf-o"></i> Sin Respaldo</a>';
  }
}
$BolI='';
foreach ($boleta as $row) {
  $BolI=$row->id;
  break;
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detalle de la Boleta
      <?php echo $stat;?>
    </h1>
    <ol class="breadcrumb">
      <li><a id="print" class="btn btn-success" style="color: #fff;font-weight: bold; margin: 5px;" href="#" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</a></li>
    </ol>
  </section>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <?php foreach($boleta as $row){$if=new DateTime($row->ini);$ff=new DateTime($row->fn);?>
                <div class="col-xs-6">
                    <div class="box-header">
                      <h3 class="box-title">Datos Generales</h3>
                    </div>
                    <div class="box-body">
                      <dl class="dl-horizontal">
                        <dt>Tipo</dt>
                        <dd><?php echo $row->tipo;?></dd>
                        <dt>Categoria</dt>
                        <dd><?php echo $row->categoria;?></dd>
                        <dt>Por cuenta de</dt>
                        <dd><?php echo $row->afianzado;?></dd>
                        <dt>A nombre de</dt>
                        <dd><?php echo $row->empresa;?></dd>
                      </dl>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box-header">
                      <h3 class="box-title">Datos del Pago</h3>
                    </div>
                    <div class="box-body">
                      <dl class="dl-horizontal">
                        <dt>Entidad Finaciera</dt>
                        <dd><?php echo $row->ent_financiera;?></dd>
                        <dt>Número de Registro</dt>
                        <dd><?php echo $row->codigo;?></dd>
                        <dt>Monto</dt>
                        <dd><?php echo $row->moneda.' '.number_format($row->monto,2);?></dd>
                        <dt>Fecha Inicio</dt>
                        <dd><?php echo $if->format('d/m/Y H:m');?></dd>
                        <dt>Fecha Fin</dt>
                        <dd><?php echo $ff->format('d/m/Y H:m');?></dd>
                      </dl>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="box-header">
                    <h3 class="box-title">Detalle</h3>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="box-body">
                      <dl class="dl-horizontal">
                        <dt>Objeto</dt>
                        <dd><?php echo $row->objeto;?></dd>
                      </dl>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="box-body">
                      <dl class="dl-horizontal">
                        <dt>Observaciones</dt>
                        <dd><?php echo $row->obs;?></dd>
                      </dl>
                  </div>
                </div>
              </div>
              <?php }?>
              <?php if(count($vigencia)>0){?>
              <div class="row">
                <div class="col-xs-12">
                  <div class="box-header">
                    <h3 class="box-title">Fechas</h3>
                  </div>
                </div>
                <div class="col-md-offset-1 col-md-10 col-xs-offset-0 col-xs-12">
                  <div class="box-body">
                    <table class="table table-bordered table-striped">
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Nro. Registro</th>
                        <th>Emisor</th>
                        <th>Objeto</th>
                        <th>Monto</th>
                        <th>Solicitante</th>
                        <th>Vencimiento</th>
                      </tr>
                      <?php $i=1; foreach($vigencia as $row){
                        $vfi= new DateTime($row->inicio);
                        $vff= new DateTime($row->fin);
                        $refA = ($row->respaldo != '')?base_url('assets/respaldo/'.$row->respaldo):'javascript:;';
                      ?>
                      <tr>
                        <td><?php echo $i.'.';?></td>
                        <td><a href="<?php echo $refA;?>" target="_blank"><?php echo $row->codigo;?></a></td>
                        <td><?php echo $row->ent_financiera;?></td>
                        <td><?php echo $row->objeto;?></td>
                        <td><?php echo $row->moneda.' '.$row->monto;?></td>
                        <td><?php echo $row->afianzado;?></td>
                        <td><?php echo $vff->format('d/m/Y H:m');?></td>
                      </tr>
                      <?php $i++;}?>
                    </table>
                  </div>
                </div>
              </div>
              <?php }?>
              <div class="row">
                <div class="col-xs-12">
                  <div class="datos">
                    <p><strong>Eladorado por </strong><?php echo $this->session->userdata('user')?></p>
                    <p><strong>Fecha </strong><?php echo date('d/m/Y H:s')?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
