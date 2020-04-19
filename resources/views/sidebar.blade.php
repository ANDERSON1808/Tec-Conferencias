<?php
    if (Auth::guest()) {
       return redirect('auth.login');
    }else{

?>
 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-calculator"></i><span>  Finanzas MPR!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('/gentelella-master/production/images/img.jpg') }}"alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> INICIO </a>
                   
                  </li>
                  <li><a><i class="fa fa-edit"></i> INGRESOS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">Cuentas de cobro</a></li>
                      <li><a href="form_advanced.html">Cuentas de cobro recurrentes</a></li>
                      <li><a href="form_validation.html">Pagos recibidos</a></li>
                      <li><a href="form_wizards.html">Notas de credito</a></li>
                      <li><a href="form_upload.html">Cotizaciones</a></li>
                      <li><a href="form_buttons.html">Remisiones</a></li>
                      <li><a href="form_buttons.html">Punto de venta</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> GASTOS<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">Pagos</a></li>
                      <li><a href="media_gallery.html">Facturas de proveedores</a></li>
                      <li><a href="typography.html">Pagos recurrentes</a></li>
                      <li><a href="icons.html">Notas debito</a></li>
                      <li><a href="glyphicons.html">Ordenes de compra</a></li>
                      <li><a href="widgets.html">Recepcion de comprobantes</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> CONTACTOS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Todos</a></li>
                      <li><a href="tables_dynamic.html">Clientes</a></li>
                      <li><a href="tables_dynamic.html">Proveedores</a></li>
                      <li><a href="tables_dynamic.html">Solicitudes de actualizacion</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> INVENTARIO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('productos.index')}}">Item de venta</a></li>
                      <li><a href="#">Valor de inventario</a></li>
                      <li><a href="#">Ajustes de inventario</a></li>
                      <li><a href="#">Gestion de item</a></li>
                      <li><a href="{{ route('lista_precios.index')}}">Lista de precios</a></li>
                      <li><a href="{{ route('bodegas.index')}}">Bodegas</a></li>
                      <li><a href="{{ route('categorias.index')}}">Categorias</a></li>
                    </ul>
                  </li>
 
                </ul>
              </div>
              <div class="menu_section">
                <h3>Administrativo</h3>
                <ul class="nav side-menu">
                <li><a><i class="fa fa-clone"></i>BANCOS </a>

                </li>
                  <li><a><i class="fa fa-bug"></i> CONTABILIDAD <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">Catalogo de cuentas</a></li>
                      <li><a href="projects.html">Ajustes contables</a></li>
                      <li><a href="project_detail.html">Asientos contables</a></li>
                      <li><a href="contacts.html">Reportes contables</a></li>
                      <li><a href="profile.html">Informacion exogena</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> REPORTES</a>
                   
                  </li>
                  <li><a><i class="fa fa-windows"></i> POST</a>
                   
                 
                 </li>
                 <li><a><i class="fa fa-windows"></i> CONFIGURACION</a>
                  
                 </li>
                                 
            
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

<?php
}
?>