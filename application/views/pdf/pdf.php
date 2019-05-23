<html><head><title>Reporte PDF</title><meta charset='utf-8'><link rel='stylesheet' href='<?php echo base_url("assets/bower_components/bootstrap/dist/css/bootstrap.min.css");?>'><link rel='stylesheet' href='<?php echo base_url("assets/css/custom_pdf.css");?>'></head><body>
<header class='main-header'><img src='<?php echo base_url("assets/img/head.png");?>'></header><footer><div class='foot'><p class='number'></p><img src='<?php echo base_url("assets/img/foot.jpg");?>'><p>www.oopp.gob.bo</p><p>Av. Mariscal Santa Cruz, Esq. Calle Oruro, Edif. Centro de Comunicaciones La Paz, 5º piso, teléfonos: (591) -2- 2119999 – 2156600</p></div></footer>
	<section id='content'>
		<div class='row'>
			<div class='col-xs-12'>
				<h3>Listado General</h4>
				<div class='datos'><p><strong>Elaborado por </strong><?php echo $this->session->userdata('user')?></p><p><strong>Fecha </strong><?php echo date('d/m/Y H:s')?></p></div>	
				<table class='table table-bordered table-striped' width="100%">
					<thead><tr><th>#</th><th>Registro</th><th>Emisor</th><th>Objeto</th><th>Vencimiento</th><th>Monto</th></tr></thead>
					<tbody><?php $i=1;foreach($boletas as $b){?><tr><td><?php echo$i;$i++;?></td><td style='white-space: nowrap;'><?php echo$b->codigo;?></td><td><?php echo$b->ent_financiera;?></td><td><?php echo$b->objeto;?></td><td><?php if($b->fin!=''){echo $b->fin;}else{echo $b->fn;}?></td><td style='white-space: nowrap;'><?php echo $b->moneda.' '.number_format($b->monto,2);?></td></tr><?php if($b->fin!=''){$j=1;foreach($this->vigencias_model->getVigencia2($b->id) as $v){?><tr><td><?php echo($i-1).'.'.$j;$j++;?></td><td style='white-space: nowrap;'><?php echo$v->codigo;?></td><td><?php echo$v->ent_financiera;?></td><td><?php echo$v->objeto;?></td><td><?php echo $v->fin;?></td><td style='white-space: nowrap;'><?php echo $v->moneda.' '.number_format($v->monto,2);?></td></tr><?php }};?><?php }?></tbody>
				</table>	
			</div>
		</div>
	</section>
</body></html>