<?php
defined('BASEPATH') OR exit('No direct script access allowed');
switch ($tipo) {
  case 0:
    $titL='General de Boletas';
    break;
  case 1:
    $titL='Boletas a expirar en 15 dias';
    break;
  case 2:
    $titL='Boletas a expirar en 10 dias';
    break;
  case 3:
    $titL='Boletas a expirar en 5 dias';
    break;
  case 4:
    $titL='Boletas Normales';
    break;
  case 5:
    $titL='Boletas Liberadas';
    break;  
  case 6:
    $titL='Boletas No Liberadas';
    break;  
  default:
    # code...
    break;
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Listado <?php echo $titL;?>
    </h1>
    <?php if($tipo==0){?>
    <ol class="breadcrumb">
      <li><a class="btn btn-success" style="color: #fff;font-weight: bold; margin: 5px;" href="<?php echo base_url('dpdf')?>" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
    </ol>
    <?php }?>
  </section>
  <!-- Main content -->
  <section class="content">
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
                  <th>Nro Registro</th>
                  <th>Emisor</th>
                  <th>Objeto</th>
                  <th>Monto</th>
                  <th>Solicitante</th>
                  <th>Vencimiento</th>
                  <th>Estado</th>
                  <th></th>
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
                      <?php }?>
                      <span class="badge bg-red eliminar2" data-id="<?php echo base_url('boleta/del_boleta/').$row->id;?>"><i class="fa fa-trash"></i></span>
                    </td>
                  </tr>
                  <?php $i++;}?>
                <?php }?>  
                <?php if($tipo==1){?> 
                  <?php $i=1; foreach($boletas as $row){
                    if($row->fin!='')
                      $dif = $row->dif2;
                    else
                      $dif = $row->dif1;
                    if(true){
                      if( $dif>10 && $dif<=15 && $row->estado!='2'){
                        $stat = '<span style="font-size:14px;" class="label bg-green">15 dias</span>';?>
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
                            <a href="<?php echo base_url('boleta/formulario/').$row->id;?>"><span class="badge bg-light-blue"><i class="fa fa-edit"></i></span></a>
                            <span class="badge bg-green liberar" data-id="<?php echo base_url('boleta/lib_boleta/').$row->id;?>"><i class="fa fa-check"></i></span>
                            <span class="badge bg-red eliminar2" data-id="<?php echo base_url('boleta/delBoleta/').$row->id;?>"><i class="fa fa-trash"></i></span>
                          </td>
                        </tr>
                      <?php $i++;}
                    }
                  ?>
                  <?php }?>
                <?php }?>
                <?php if($tipo==2){?> 
                  <?php $i=1; foreach($boletas as $row){
                    if($row->fin!='')
                      $dif = $row->dif2;
                    else
                      $dif = $row->dif1;
                    if(true){
                        if ($dif>5 && $dif<=10 && $row->estado!='2'){ 
                          $stat = '<span style="font-size:14px;" class="label bg-blue">10 dias</span>';?>
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
                              <a href="<?php echo base_url('boleta/formulario/').$row->id;?>"><span class="badge bg-light-blue"><i class="fa fa-edit"></i></span></a>
                              <span class="badge bg-green liberar" data-id="<?php echo base_url('boleta/lib_boleta/').$row->id;?>"><i class="fa fa-check"></i></span>
                              <span class="badge bg-red eliminar2" data-id="<?php echo base_url('boleta/delBoleta/').$row->id;?>"><i class="fa fa-trash"></i></span>
                            </td>
                          </tr>
                        <?php $i++;}
                    }
                  ?>
                  <?php }?>
                <?php }?>
                <?php if($tipo==3){?> 
                  <?php $i=1; foreach($boletas as $row){
                    if($row->fin!='')
                      $dif = $row->dif2;
                    else
                      $dif = $row->dif1;
                    if(true){
                      if ($dif<=5 && $dif>=0 && $row->estado!='2'){ 
                        $stat = '<span style="font-size:14px;" class="label bg-red">5 dias</span>';?>
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
                            <a href="<?php echo base_url('boleta/formulario/').$row->id;?>"><span class="badge bg-light-blue"><i class="fa fa-edit"></i></span></a>
                            <span class="badge bg-green liberar" data-id="<?php echo base_url('boleta/lib_boleta/').$row->id;?>"><i class="fa fa-check"></i></span>
                            <span class="badge bg-red eliminar2" data-id="<?php echo base_url('boleta/delBoleta/').$row->id;?>"><i class="fa fa-trash"></i></span>
                          </td>
                        </tr>
                      <?php $i++;}
                    }
                  ?>
                  <?php }?>
                <?php }?>  
                <?php if($tipo==4){?> 
                  <?php $i=1; foreach($boletas as $row){
                    if($row->fin!='')
                      $dif = $row->dif2;
                    else
                      $dif = $row->dif1;
                    if($dif>15 && $row->estado!='2'){
                      $stat = '<span style="font-size:14px;" class="label bg-green">Normal</span>';?>
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
                          <a href="<?php echo base_url('boleta/formulario/').$row->id;?>"><span class="badge bg-light-blue"><i class="fa fa-edit"></i></span></a>
                          <span class="badge bg-green liberar" data-id="<?php echo base_url('boleta/lib_boleta/').$row->id;?>"><i class="fa fa-check"></i></span>
                          <span class="badge bg-red eliminar2" data-id="<?php echo base_url('boleta/delBoleta/').$row->id;?>"><i class="fa fa-trash"></i></span>
                        </td>
                      </tr>
                    <?php $i++;}
                  ?>
                  <?php }?>
                <?php }?>  
                <?php if($tipo==5){?> 
                  <?php $i=1; foreach($boletas as $row){
                    if($row->estado=='2'){
                      $stat = '<span style="font-size:14px;" class="label bg-green">Liberado</span>';?>
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
                        </td>
                      </tr>
                    <?php $i++;}
                  ?>
                  <?php }?>
                <?php }?>  
                <?php if($tipo==6){?> 
                  <?php $i=1; foreach($boletas as $row){
                    if($row->fin!='')
                      $dif = $row->dif2;
                    else
                      $dif = $row->dif1;
                    if(true){
                      if ($dif<0 && $row->estado!='2'){ 
                        $stat = '<span style="font-size:14px;" class="label bg-black"black>No Liberado</span>';?>
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
                            <a href="<?php echo base_url('boleta/formulario/').$row->id;?>"><span class="badge bg-light-blue"><i class="fa fa-edit"></i></span></a>
                            <span class="badge bg-green liberar" data-id="<?php echo base_url('boleta/lib_boleta/').$row->id;?>"><i class="fa fa-check"></i></span>
                            <span class="badge bg-red eliminar2" data-id="<?php echo base_url('boleta/delBoleta/').$row->id;?>"><i class="fa fa-trash"></i></span>
                          </td>
                        </tr>
                      <?php $i++;}
                    }
                  ?>
                  <?php }?>
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