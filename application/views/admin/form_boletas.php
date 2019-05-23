<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($tipo=='reg'){
  $fTit='Crear Boleta';
  $fSpa='';
  $tip='';
  $cat='';
  $af='';
  $em='';
  if(isset($id) && $id!=''){
    $fTit='Crear Ampliación';
    foreach ($boleta as $row) {
      $tip=$row->tipo;
      $cat=$row->categoria;
      $af=$row->afianzado;
      $em=$row->empresa;
    }    
  }
}
if ($tipo=='upd'){
  $fTit='Editar Boleta';
  if ($vigencia!='no') {
    foreach($boleta as $row){
      if($row->fin!='')
          $dif = $row->dif2;
      else
        $dif = $row->dif1;
      if($row->estado!=2){
        if($dif<=15){
          if( $dif>10)
            $fSpa = '<span style="font-size:14px;" class="label bg-blue">'.$dif.' dias</span>';
          else{
            if ($dif>5) 
              $fSpa = '<span style="font-size:14px;" class="label bg-yellow">'.$dif.' dias</span>';
            else{
              if($dif>=0)
                $fSpa = '<span style="font-size:14px;" class="label bg-red">'.$dif.' dias</span>';
              else
                $fSpa = '<span style="font-size:14px;" class="label bg-black">'.$dif.' dias</span>';
            }
          }
        }
        else{
          $fSpa = '<span style="font-size:14px;" class="label bg-green">'.$dif.' dias</span>';
        }
      }
      else
        $fSpa = '<span style="font-size:14px;" class="label bg-green">Liberado</span>';
    }
  }
  else{
   $fTit='Editar Ampliación'; 
   $fSpa=''; 
  }
  foreach ($boleta as $res) {
    if($res->respaldo!=''){
      $fSpa .= '<a class="btn btn-social btn-success" style="float:right;" href="'.base_url('assets/respaldo/'.$res->respaldo).'" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar Respaldo</a>';
    }
    else{
      $fSpa .= '<a class="btn btn-social btn-danger" style="float:right;" href="javascript:;"><i class="fa fa-file-pdf-o"></i> Sin Respaldo</a>';
    }
  }
}if ($tipo=='regU'){
  $fTit='Crear Usuario';
  $fSpa='';
}
if ($tipo=='updU'){
  $fTit='Actualizar Usuario';
  $fSpa='';
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $fTit.' '.$fSpa;?>
    </h1>
  </section>
<?php if($tipo=='reg'){?>
  <!-- Main content -->
  <section class="content">
    <?php $att = array('id' => 'formBR','class'=>'','autocomplete'=>'off','enctype'=>'multipart/form-data'); echo form_open('boleta/add_boleta',$att); ?>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos generales</h3>
            </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Boleta:</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Tipo</label>
                            <select id="tipo" name="tipo" class="form-control" required <?php if($tip!=''){echo 'disabled';}?>>
                              <option disabled <?php if($tip==''){echo 'selected';}?>>Selecciona Tipo</option>
                              <option value="Boleta" <?php if($tip=='Boleta'){echo 'selected';}?>>Boleta</option>
                              <option value="Poliza" <?php if($tip=='Poliza'){echo 'selected';}?>>Poliza</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Categoria</label>
                            <select id="cat" name="cat" class="form-control" required <?php if($cat!=''){echo 'disabled';}?>>
                              <option disabled <?php if($cat==''){echo 'selected';}?>>Selecciona Categoria</option>
                              <option value="Cumplimiento de Contrato" <?php if($cat=='Cumplimiento de Contrato'){echo 'selected';}?>>Cumplimiento de Contrato</option>
                              <option value="Seriedad de Propuesta" <?php if($cat=='Seriedad de Propuesta'){echo 'selected';}?>>Seriedad de Propuesta</option>
                              <option value="Correcta Inversion de Anticipo" <?php if($cat=='Correcta Inversion de Anticipo'){echo 'selected';}?>>Correcta Inversion de Anticipo</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="afi">Por cuenta de:</label>
                      <input <?php if($af!=''){?>readonly<?php }?> type="text" class="form-control" id="afi" name="afi" placeholder="Ingresar a cuenta de" required value="<?php echo $af;?>">
                    </div>
                    <div class="form-group">
                      <label for="emp">A nombre de:</label>
                      <input <?php if($em!=''){?>readonly<?php }?> type="text" class="form-control" id="emp" name="emp" placeholder="Ingresar nombre" required value="<?php echo $em;?>">
                    </div>    
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputPassword1">Datos del Pago:</label>
                    <div class="form-group">
                      <input type="text" class="form-control" id="enf" name="enf" placeholder="Entidad Financiera" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="npl" name="npl" placeholder="Codigo" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Monto:</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="bs" name="bs" placeholder="Monto" required>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <select id="moneda" name="moneda" class="form-control" required>
                              <option disabled selected>Selecciona Moneda</option>
                              <option value="BS">BS</option>
                              <option value="USD">USD</option>
                              <option value="EUR">EUR</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
					    <label>Respaldo PDF:</label>
					    <input type="file" accept="application/pdf" size="5" class="form-control" id="res" name="res" placeholder="Agregar Respaldo">
					</div>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Detalles</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group">
                      <textarea class="form-control" id="obj" name="obj" rows="3" placeholder="Objeto" required></textarea>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" id="obs" name="obs" rows="3" placeholder="Observaciones"></textarea>
                    </div>
                  </div>
              </div>    
            </div>
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Vigencia</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                      <label>Rango de Fechas</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="vig" name="vig">
                        <input type="text" id="ini" name="ini" hidden="" value="" required>
                        <input type="text" id="fin" name="fin" hidden="" value="" required>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if(isset($id) && $id!=''){$vid=$id;}else{$vid='no';}?>
      <input type="text" id="id" name="id" hidden="" value="<?php echo$vid;?>" required>
    <?php echo form_close(); ?>
    <!-- /.row -->
  </section>
<?php }?>
<?php if($tipo=='upd'){?>
  <section class="content">
      <div class="row">
      <?php $att = array('id' => 'formBU','class'=>'','autocomplete'=>'off','enctype'=>'multipart/form-data');if($vigencia!='no'){echo form_open('boleta/upd_boleta',$att);}else{echo form_open('boleta/upd_vigencia',$att);} ?>
        <?php foreach($boleta as $row){$idB=$row->id;?>
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos generales</h3>
            </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Boleta:</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Tipo</label>
                            <select id="tipo" name="tipo" class="form-control" required <?php if($vigencia=='no')echo 'disabled';?>>
                              <option disabled>Selecciona Tipo</option>
                              <option value="Boleta" <?php if($row->tipo=='Boleta')echo 'selected';?>>Boleta</option>
                              <option value="Poliza" <?php if($row->tipo=='Poliza')echo 'selected';?>>Poliza</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Categoria</label>
                            <select id="cat" name="cat" class="form-control" required <?php if($vigencia=='no')echo 'disabled';?>>
                              <option disabled>Selecciona Categoria</option>
                              <option <?php if($row->categoria=='Cumplimiento de Contrato')echo 'selected';?> value="Cumplimiento de Contrato">Cumplimiento de Contrato</option>
                              <option <?php if($row->categoria=='Seriedad de Propuesta')echo 'selected';?> value="Seriedad de Propuesta">Seriedad de Propuesta</option>
                              <option <?php if($row->categoria=='Correcta Inversion de Anticipo')echo 'selected';?> value="Correcta Inversion de Anticipo">Correcta Inversion de Anticipo</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="afi">Por cuenta de:</label>
                          <input <?php if($vigencia=='no'){echo 'readonly';}?> type="text" class="form-control" id="afi" name="afi" placeholder="Ingresar a cuenta de" required value="<?php echo $row->afianzado;?>">
                        </div>
                        <div class="col-md-6">
                          <label for="emp">A nombre de:</label>
                          <input <?php if($vigencia=='no'){echo 'readonly';}?> type="text" class="form-control" id="emp" name="emp" placeholder="Ingresar nombre" required value="<?php echo $row->empresa;?>">
                        </div>
                      </div>
                    </div>    
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputPassword1">Datos del Pago:</label>
                    <div class="form-group">
                      <input type="text" class="form-control" id="enf" name="enf" placeholder="Entidad Financiera" required value="<?php echo $row->ent_financiera;?>">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="npl" name="npl" placeholder="Numero de Poliza" required value="<?php echo $row->codigo;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Monto:</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="bs" name="bs" placeholder="Monto Bs." required value="<?php echo $row->monto;?>">
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <select id="moneda" name="moneda" class="form-control" required>
                              <option disabled selected>Selecciona Moneda</option>
                              <option <?php if($row->moneda=='BS')echo 'selected';?> value="BS">BS</option>
                              <option <?php if($row->moneda=='USD')echo 'selected';?> value="USD">USD</option>
                              <option <?php if($row->moneda=='EUR')echo 'selected';?> value="EUR">EUR</option>
                            </select>
                          </div>
                          <input type="text" id="id_b" name="id_b" hidden="" value="<?php echo $row->id;?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
					    <label>Actualizar Respaldo PDF:</label>
					    <input type="file" accept="application/pdf" size="5" class="form-control" id="res" name="res" placeholder="Actualizar Respaldo">
					</div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detalles</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="obj">Objeto:</label>
                  <textarea class="form-control" id="obj" name="obj" rows="3" placeholder="Objeto" required><?php echo $row->objeto;?></textarea>
                </div>
                <div class="form-group">
                  <label for="obs">Observaciones:</label>
                  <textarea class="form-control" id="obs" name="obs" rows="3" placeholder="Observaciones"><?php echo $row->obs;?></textarea>
                </div>
              </div>
              <div class="form-group">
                  <label>Fechas:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="vig" name="vig" data-i="<?php if($vigencia!='no'){echo $row->ini;}else{echo$row->inicio;}?>" data-f="<?php if($vigencia!='no'){echo $row->fn;}else{echo$row->fin;}?>">
                    <input type="text" id="ini" name="ini" hidden="" value="<?php if($vigencia!='no'){echo $row->ini;}else{echo$row->inicio;}?>" required>
                    <input type="text" id="fin" name="fin" hidden="" value="<?php if($vigencia!='no'){echo $row->fn;}else{echo$row->fin;}?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>
              </div>
          </div>
        </div>
        <?php }?> 
      <?php echo form_close(); ?>
      <?php if($vigencia!='no'){?>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Vigencia</h3>
              <?php $att = array('id' => 'formBR','class'=>'','autocomplete'=>'off','enctype'=>'multipart/form-data'); echo form_open('boleta/add_vigencia',$att); ?>       
              <input type="text" id="id_v" name="id_v" hidden="" value="<?php echo $idB;?>" required>
              <button type="submit" class="btn btn-primary">Adicionar Ampliación</button>
              <?php echo form_close(); ?>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Codigo</th>
                    <th>Fin</th>
                    <th>Opciones</th>
                  </tr>
                  <?php $i=1;foreach($vigencia as $row){?>
                  <tr>
                    <td><?php echo $i.'.';?></td>
                    <td><?php echo $row->codigo;?></td>
                    <td><?php echo $row->fin;?></td>
                    <td>
                      <a href="<?php echo base_url('boleta/formulario/').$row->id.'/no';?>"><span class="badge bg-light-blue" data-idb="<?php echo $idB;?>" data-id="<?php echo $row->id;?>" data-in="<?php echo $row->fecha_inicio;?>" data-fi="<?php echo $row->fecha_fin;?>">editar</span></a>
                      <span class="badge bg-red eliminar" data-idb="<?php echo $idB;?>" data-id="<?php echo $row->id;?>">eliminar</span>
                    </td>
                  </tr>
                  <?php $i++;}?>
                </table>
                </div>
                <div class="box-footer">
                </div>
            </div>
          </div>
        </div>
      <?php }?>
      </div>
  </section>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modificar fechas</h4>
        </div>
        <div class="modal-body">
          <?php $att = array('id' => 'formBR','class'=>'','autocomplete'=>'off','enctype'=>'multipart/form-data'); echo form_open('boleta/upd_vigencia',$att); ?>       
            <div class="form-group">
              <label>Fechas:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="vigu" name="vigu">
                <input type="text" id="iniu" name="iniu" hidden="" value="" required>
                <input type="text" id="finu" name="finu" hidden="" value="" required>
                <input type="text" id="id_vu" name="id_vu" hidden="" value="" required>
                <input type="text" id="id_bu" name="id_bu" hidden="" value="" required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Modificar</button>
        </div>
        <?php echo form_close(); ?>  
      </div>
      <!-- /.modal-content -->
    </div>
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
          <?php $att = array('id' => 'formBR','class'=>'','autocomplete'=>'off','enctype'=>'multipart/form-data'); echo form_open('boleta/del_vigencia',$att); ?>       
            <div class="form-group">
              <p>Elimniar registro??</p>
                <input type="text" id="id_vue" name="id_vue" hidden="" value="" required>
                <input type="text" id="id_bue" name="id_bue" hidden="" value="" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline">Eliminar</button>
        </div>
      </div>
      <?php echo form_close(); ?>  
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php }?>
<?php if($tipo=='regU'){?>
  <!-- Main content -->
  <section class="content">
   
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Usuarios</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <thead>
                  <th>#</th>
                  <th>Usuario</th>
                  <th>Nombre(s) y Apellido(s)</th>
                  <th>Opciones</th>
                </thead>
                <tbody>
                  <?php $i=1;foreach($users as $us){?>
                  <tr>
                    <td><?php echo$i;$i++;?></td>
                    <td><?php echo$us->usuario;?></td>
                    <td><?php echo$us->nombre;?></td>
                    <td>
                      <a href='<?php echo base_url("inicio/usuario/$us->id");?>'><span class="badge bg-green"><i class="fa fa-edit"></i></span></a>
                      <a class="eliminar2" href="#" data-id='<?php echo base_url("inicio/dU/$us->id");?>'><span class="badge bg-red"><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </div>  
        </div>
    <?php $att = array('id' => 'formBR','class'=>'','autocomplete'=>'off','enctype'=>'multipart/form-data'); echo form_open('inicio/add_u',$att); ?>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Personales</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="afi">Usuario:</label>
                <input type="text" class="form-control" id="afi" name="afi" placeholder="Ingresar Nombre" required>
              </div>
              <div class="form-group">
                <label for="afi">Nombre(s) y Apellido(s):</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Ingresar Nombre" required>
              </div>
              <div class="form-group">
                <label for="emp">Contraseña:</label>
                <input type="password" class="form-control" id="emp" name="emp" placeholder="Ingresar Contraseña" required>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Crear Usuario</button>
            </div>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
    <!-- /.row -->
  </section>
<?php }?>  
<?php if($tipo=='updU'){?>
  <!-- Main content -->
  <section class="content">
    
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Usuarios</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped">
                <thead>
                  <th>#</th>
                  <th>Usuario</th>
                  <th>Nombre(s) y Apellido(s)</th>
                  <th>Opciones</th>
                </thead>
                <tbody>
                  <?php $i=1;foreach($users as $us){?>
                  <tr>
                    <td><?php echo$i;$i++;?></td>
                    <td><?php echo$us->usuario;?></td>
                    <td><?php echo$us->nombre;?></td>
                    <td>
                      <a href='<?php echo base_url("inicio/usuario/$us->id");?>'><span class="badge bg-green"><i class="fa fa-edit"></i></span></a>
                      <a class="eliminar2" href="#" data-id='<?php echo base_url("inicio/dU/$us->id");?>'><span class="badge bg-red"><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </div>  
        </div>
    <?php $att = array('id' => 'formBR','class'=>'','autocomplete'=>'off','enctype'=>'multipart/form-data'); echo form_open('inicio/updU',$att); ?>
        <div class="col-md-6">
          <!-- general form elements -->
          <?php foreach($user as $row){$idB=$row->id;?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Personales</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="afi">Usuario:</label>
                  <input type="text" class="form-control" id="afi" name="afi" placeholder="Ingresar Nombre" required value="<?php echo $row->usuario;?>">
                </div>
                <div class="form-group">
                  <label for="afi">Nombre(s) y Apellido(s):</label>
                  <input type="text" class="form-control" id="nom" name="nom" placeholder="Ingresar Nombre" required value="<?php echo $row->nombre;?>">
                </div>
                <div class="form-group">
                  <label for="emp">Contraseña:</label>
                  <input type="password" class="form-control" id="emp" name="emp" placeholder="Ingresar Contraseña" value="<?php echo $row->pass;?>">
                  <label for="emp2">Nueva Contraseña:</label>
                  <input type="password" class="form-control" id="emp2" name="emp2" placeholder="Nueva Contraseña" value="">
                  <input type="text" name="id_u" id="id_u" value="<?php echo $row->id;?>" hidden>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Actulizar Datos</button>
              </div>
          </div>
          <?php }?>
        </div>
      </div>
    <?php echo form_close(); ?>
    <!-- /.row -->
  </section>
<?php }?>  
  <!-- /.content -->
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
