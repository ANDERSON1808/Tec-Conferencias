
    <!-- jQuery -->
    <script src="{{ asset('/gentelella-master/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/gentelella-master/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/gentelella-master/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('/gentelella-master/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('/gentelella-master/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('/gentelella-master/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('/gentelella-master/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/gentelella-master/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('/gentelella-master/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('/gentelella-master/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('/gentelella-master/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('/gentelella-master/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('/gentelella-master/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('/gentelella-master/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/gentelella-master/build/js/custom.min.js') }}"></script>


    <!-- Datatables -->
    <script src="{{ asset('/gentelella-master/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
      <!-- PNotify -->
    <script src="{{ asset('/gentelella-master/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('/gentelella-mastervendors/pnotify/dist/pnotify.nonblock.js') }}"></script>


  <script src="{{ asset('/gentelella-master/vendors/validator/multifield.js') }}"></script>
  <script src="{{ asset('/gentelella-master/vendors/validator/validator.js') }}"></script>
 <!-- Switchery -->
 <script src="{{ asset('/gentelella-master/vendors/switchery/dist/switchery.min.js') }}"></script>

  <!-- FullCalendar -->
  <script src="{{ asset('/gentelella-master/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('/gentelella-master/vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>


    <script type="text/javascript">
        $(function () {
            $.get("notificaciones",function(data){
                console.log(data);
                var contador = 0;
                var color = 'style="background-color: turquoise;"';
                 $.each(data, function (key, reg) {
                     if(reg.visualizacion =="visualizado"){
                        color = '';
                     }else{
                     contador++;
                        color = 'style="background-color: turquoise;"';
                     }
                    //     $("#slcRoles").append("<option value=" + reg.id + ">" + reg.nombre +   "</option>");
                    // $("#slcRoles").dropdown();
                        $("#ulNotificaciones").append(' <li class="nav-item" '+color+'>'+
                     ' <a class="dropdown-item">'+
                        '<a><icon class="glyphicon glyphicon-facetime-video">   </icon></a>'+
                        '<span>'+
                          '<a><span>'+reg.tema+'</span></a>'+
                          '<br> <span class="time">'+reg.fecha+'</span> <br>'+
                        '</span>'+
                        '<span class="message">'+ reg.descripcion+
                        '</span>'+
                      '</a>'+
                    '</li>')
                    });
                    $("#ulNotificaciones").append(
                     '<li class="nav-item">'+
                      '<div class="text-center">'+
                        '<a class="dropdown-item">'+
                         ' <strong>See All Alerts</strong>'+
                          '<i class="fa fa-angle-right"></i>'+
                      '  </a>'+
                     ' </div>'+
                   ' </li>');
            $("#btnNotification").html(contador);
            });
            $.get("cantNotificaciones",function(data){
                console.log(data);
            });

        });
    </script>
