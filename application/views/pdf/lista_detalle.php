<html><head><meta charset="utf-8"><link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>"><style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      text-align: center;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: 0px;
      right: 0px;
      height: auto;
    }
    table{
    }
    table th{
      text-align: center;
      vertical-align: middle;
      font-size: 11px;
    }
    table td{
      text-transform: lowercase;
      font-size: 11px;
    }
  </style></head><body class="sidebar-mini wysihtml5-supported skin-black-light sidebar-collapse"><div class="wrapper"><header class="main-header"> contenido cabecera</header><section id="content" class="content"><div class="row"><div class="col-xs-10"><div class="box"><div class="box-body"><div class="row"><?php foreach($boleta as $row){?><div class="col-xs-6"><div class="box-header"><h3 class="box-title">Datos Generales</h3></div><div class="box-body"><dl class="dl-horizontal"><dt>Por cuenta de</dt><dd><?php echo $row->afianzado;?></dd><dt>A nombre de</dt><dd><?php echo $row->empresa;?></dd></dl></div></div><div class="col-xs-6"><div class="box-header"><h3 class="box-title">Datos del Pago</h3></div><div class="box-body"><dl class="dl-horizontal"><dt>Entidad Finaciera</dt><dd><?php echo $row->ent_financiera;?></dd><dt>Número de Poliza</dt><dd><?php echo $row->poliza;?></dd><dt>Bs.</dt><dd><?php echo number_format($row->bs,2);?></dd><dt>$us.</dt><dd><?php echo number_format($row->us,2);?></dd></dl></div></div></div><div class="row"><div class="col-xs-12"><div class="box-header"><h3 class="box-title">Detalle</h3></div></div><div class="col-xs-6"><div class="box-body"><dl class="dl-horizontal"><dt>Objeto</dt><dd><?php echo $row->objeto;?></dd></dl></div></div><div class="col-xs-6"><div class="box-body"><dl class="dl-horizontal"><dt>Observaciones</dt><dd><?php echo $row->obs;?></dd></dl></div></div></div><?php }?><div class="row"><div class="col-xs-12"><div class="box-header"><h3 class="box-title">Fechas</h3></div></div><div class="col-xs-offset-3 col-xs-6 col-xs-12"><div class="box-body"><table class="table table-bordered table-striped"><tr><th style="width: 10px">#</th><th>Fecha Inicio</th><th>Fecha Fin</th></tr><?php $i=1; foreach($vigencia as $row){
                        $vfi= new DateTime($row->fecha_inicio);
                        $vff= new DateTime($row->fecha_fin);
                      ?><tr><td><?php echo $i.'.';?></td><td><?php echo $vfi->format('d/m/Y');?></td><td><?php echo $vff->format('d/m/Y');?></td></tr><?php $i++;}?></table></div></div></div></div></div></div></div></section></div><footer class="main-footer"><strong>Copyright &copy; 2018.</strong>Derechos Reservados </footer></body></html>