<html><head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
 </head>
  <body class="sidebar-mini wysihtml5-supported skin-black-light sidebar-collapse"><div class="wrapper">
    <header class="main-header">contenido cabecera
    </header><section id="content" class="content">
      <div class="row"><div class="col-xs-12">
        <div class="box"><div class="box-body"><table id="example1" class="table table-bordered table-striped" width="100%"><thead><tr><th>#</th><th>Nro. Registro</th><th>Emisor</th><th>Objeto</th><th>Monto</th><th>Solicitante</th><th>$Vencimiento</th></tr></thead><tbody><?php $i=1; foreach($boletas as $row){
                    $f1 = new DateTime($row->inicio);
                    $f2 = new DateTime($row->fin);
                  ?><tr><td valign="middle"><?php echo $i;?></td><td valign="middle"><?php echo $row->codigo;?></td><td valign="middle"><?php echo $row->ent_financiera;?></td><td valign="middle"><?php echo $row->objeto;?></td><td valign="middle"><?php echo $row->moneda.' '.number_format($row->monto,2);?></td><td valign="middle"><?php echo $row->afianzado;?></td><td valign="middle"><?php echo $f2->format('d/m/Y');?>
                    </td></tr><?php $i++;}?></tbody></table></div></div></div></div></section></div>
                  <footer class="main-footer">
                      <strong>Copyright &copy; 2018.</strong> Programa de Mejora de la Gestión Municipal </footer>
                    </body>
                  </html>