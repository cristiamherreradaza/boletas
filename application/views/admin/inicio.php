<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$lib=0; 
$reg=0; 
$a15=0;
$a10=0;
$a5=0;
$aE=0;
foreach($boletas as $row){
  if($row->fin!='')
    $dif = $row->dif2;
  else
    $dif = $row->dif1;
  if($row->estado!=2){
    if($dif<=15){
      if( $dif>10)
        $a15++;
      else{
        if ($dif>5) 
          $a10++;
        else{
          if($dif>=0)
            $a5++;
          else
            $aE++;
        }
      }
    }
    else{
      $reg++;
    }
  }
  else
    $lib++;
}  
?>
<div class="content-wrapper">
  <section class="content">
      <div class="row">
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $reg;?></h3>
              <p>Boletas Normales</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url('detalle/listado/4');?>" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $a15;?></h3>
              <p>Boletas a 15 Dias</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url('detalle/listado/1');?>" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $a10;?></h3>

              <p>Boletas a 10 Dias</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url('detalle/listado/2');?>" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $a5;?></h3>

              <p>Boletas a 5 Dias</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url('detalle/listado/3');?>" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue">
            <div class="inner">
              <h3><?php echo $lib;?></h3>

              <p>Boletas Liberadas</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url('detalle/listado/5');?>" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
              <h3><?php echo $aE;?></h3>

              <p>Boletas No Liberadas</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url('detalle/listado/6');?>" class="small-box-footer">Ver Listado <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Boletas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped display responsive" width="100%">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nro Poliza</th>
                  <th>Ent. Financiera</th>
                  <th>Detalle</th>
                  <th>Monto</th>
                  <th>A cuenta de</th>
                  <th>Fecha Ven.</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if($tipo==0){?> 
                  <?php $i=1; foreach($boletas as $row){
                    if($row->fin!='')
                      $dif = $row->dif2;
                    else
                      $dif = $row->dif1;
                    if($row->estado!=2){
                      if($dif<=15){
                        if( $dif>10)
                          $stat = '<span style="font-size:14px;" class="label bg-blue">15 dias</span>';
                        else{
                          if ($dif>5) 
                            $stat = '<span style="font-size:14px;" class="label bg-yellow">10 dias</span>';
                          else{
                            if($dif>=0)
                              $stat = '<span style="font-size:14px;" class="label bg-red">5 dias</span>';
                            else
                              $stat = '<span style="font-size:14px;" class="label bg-black">No Liberado</span>';
                          }
                        }
                      }
                      else{
                        $stat = '<span style="font-size:14px;" class="label bg-green">Normal</span>';
                      }
                    }
                    else
                      $stat = '<span style="font-size:14px;" class="label bg-green">Liberado</span>';
                  ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->codigo;?></td>
                    <td><?php echo $row->ent_financiera;?></td>
                    <td><?php echo $row->objeto;?></td>
                    <td><?php echo $row->moneda.' '.number_format($row->monto,2);?></td>
                    <td><?php echo $row->afianzado;?></td>
                    <td><?php if($row->fin!=''){echo $row->fin;}else{echo $row->fn;}?></td>
                    <td><?php echo $stat;?></td>
                    <td>
                      <a href="<?php echo base_url('detalle/boleta/').$row->id;?>"><span class="badge bg-light-green"><i class="fa fa-search"></i></span></a>
                      <?php if($row->estado!='2'){?>
                      <a href="<?php echo base_url('boleta/formulario/').$row->id;?>"><span class="badge bg-light-blue"><i class="fa fa-edit"></i></span></a>
                      <span class="badge bg-green liberar" data-id="<?php echo base_url('boleta/lib_boleta/').$row->id;?>"><i class="fa fa-check"></i></span>
                      <span class="badge bg-red eliminar2" data-id="<?php echo base_url('boleta/del_boleta/').$row->id;?>"><i class="fa fa-trash"></i></span>
                      <?php }?>
                    </td>
                  </tr>
                  <?php $i++;}?>
                <?php }?>  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
<div class="modal modal-danger fade" id="modal-danger">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Eliminar Registro</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <p>Elimniar registro??</p>
                <input type="text" id="id_vue" name="id_vue" hidden="" value="" required>
                <input type="text" id="id_bue" name="id_bue" hidden="" value="" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
          <a id="delB" href="" class="btn btn-outline">Eliminar</a>
        </div>
      </div>
      <!-- /.modal-content -->
  </div>
</div>
<div class="modal modal-success fade" id="modal-liberar">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&&times;</span></button>
          <h4 class="modal-title">Liberar Registro</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <p>Liberar registro??</p>
                <input type="text" id="id_vue" name="id_vue" hidden="" value="" required>
                <input type="text" id="id_bue" name="id_bue" hidden="" value="" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
          <a id="libB" href="" class="btn btn-outline">Liberar</a>
        </div>
      </div>
      <!-- /.modal-content -->
  </div>
</div>