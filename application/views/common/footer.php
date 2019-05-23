
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.0
        </div>
        <strong>Derechos Reservados</strong> Programa de Mejora de la Gestión Municipal
        <div class="foot">
          <img src="<?php echo base_url('assets/img/foot.jpg');?>">  
          <p>www.oopp.gob.bo</p>
          <p>Av. Mariscal Santa Cruz, Esq. Calle Oruro, Edif. Centro de Comunicaciones La Paz, 5º piso, teléfonos: (591) -2- 2119999 – 2156600</p>
        </div>
      </footer>
     <div class="control-sidebar-bg"></div>
  </div>
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js');?>"></script>
  <script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
  <script src="<?php echo base_url('assets/datable/datatables.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>
  <script src="<?php echo base_url('assets/js/custom.js');?>"></script>
  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
  </script>
<script>
  $(function () {
    var i=$('#vig').attr('data-i');
    var f=$('#vig').attr('data-f');
    $('#vig').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      locale: {
        format: 'YYYY-MM-DD HH:mm',
        separator: " - ",
        applyLabel: "Aplicar",
        cancelLabel: "Cancelar",
        fromLabel: "De",
        toLabel: "a",
        customRangeLabel: "Personalizar",
        weekLabel: "M",
        daysOfWeek: [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        monthNames: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        firstDay: 1
      },
      startDate: i, 
      endDate: f
    },
    function(start, end, label) {
      $('#ini').val(start.format('YYYY-MM-DD HH:mm'));
      $('#fin').val(end.format('YYYY-MM-DD HH:mm'));
    });
  });
</script>
<script type="text/javascript">
  $('.editar').click(
    function(){
      $('#iniu').val('');
      $('#finu').val('');
      $('#id_vu').val($(this).attr('data-id'));
      $('#id_bu').val($(this).attr('data-idb'));
      $('#vigu').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        locale: {
          format: 'YYYY-MM-DD HH:mm',
          separator: " - ",
          applyLabel: "Aplicar",
          cancelLabel: "Cancelar",
          fromLabel: "De",
          toLabel: "a",
          customRangeLabel: "Personalizar",
          weekLabel: "M",
          daysOfWeek: [
              "Dom",
              "Lun",
              "Mar",
              "Mie",
              "Jue",
              "Vie",
              "Sab"
          ],
          monthNames: [
              "Enero",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
              "Agosto",
              "Septiembre",
              "Octubre",
              "Noviembre",
              "Diciembre"
          ],
          firstDay: 1
        },
        startDate: $(this).attr('data-in'), 
        endDate: $(this).attr('data-fi')
      },
      function(start, end, label) {
        $('#iniu').val(start.format('YYYY-MM-DD HH:mm'));
        $('#finu').val(end.format('YYYY-MM-DD HH:mm'));
      });
      $('#modal-default').modal('show');
    }
  );
  $('.eliminar').click(
    function(){
      $('#id_vue').val($(this).attr('data-id'));
      $('#id_bue').val($(this).attr('data-idb'));
      $('#modal-danger').modal('show');
    }
  );
  $('.eliminar2').click(
    function(){
      $('#delB').attr('href',$(this).attr('data-id'));
      $('#modal-danger').modal('show');
    }
  );
  $('.liberar').click(
    function(){
      $('#libB').attr('href',$(this).attr('data-id'));
      $('#modal-liberar').modal('show');
    }
  );
</script>
<script type="text/javascript">
  $(function () {
    $('#example1').DataTable({
      responsive: true,
      language: {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
      },
    });
  });
</script>
</body>
</html>
