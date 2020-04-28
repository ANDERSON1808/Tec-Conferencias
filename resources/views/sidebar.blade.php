
 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-video-camera"></i><span> TEC</span></a>
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
                  <li><a  href="{{route('home') }}"><i class="fa fa-home"></i> INICIO </a>

                  </li>
                  <li><a><i class="fa fa-edit"></i> TRABAJO VIRTUAL<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('conferencia.index') }}">Videconferencias</a> </li>
                      <li><a href="{{route('invitacion')}}">Invitado</a></li>
                      <li><a href="{{route('historico')}}">Historicos</a></li>
                      <li><a href="form_validation.html">Documentos</a></li>
                      <li><a href="form_validation.html">Planes de accion</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i>SESIONES<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('viewSesion') }}">Administrar</a></li>
                      <li><a href="{{ url('viewParticipacion') }}">Participar</a></li>
                      <li><a href="media_gallery.html">Actas</a></li>
                      <li><a href="media_gallery.html">Historico</a></li>
                      <li><a href="media_gallery.html">En vivo</a></li>
                      <li><a href="media_gallery.html">Repositorio</a></li>
                      <li><a href="media_gallery.html">Documentacion</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i>GESTION DOCUMENTAL <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Administrar</a></li>
                      <li><a href="tables_dynamic.html">Areas</a></li>
                      <li><a href="tables_dynamic.html">Traslados</a></li>
                      <li><a href="tables_dynamic.html">Radicacion</a></li>
                      <li><a href="tables_dynamic.html">Diguitalizacion</a></li>
                      <li><a href="tables_dynamic.html">Historico</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> PROYECTOS<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Administrar</a></li>
                      <li><a href="#">Proyectos</a></li>
                      <li><a href="#">Invitados</a></li>
                      <li><a href="#">Gestion de item</a></li>
                    </ul>
                  </li>

                </ul>
              </div>
              <div class="menu_section">
                <h3>Administrativo</h3>
                <ul class="nav side-menu">

                </li>
                  <li><a><i class="fa fa-bug"></i> USUARIOS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('user.view') }}">Administracion</a></li>
                      <li><a href="{{ url('viewRoles') }}">Roles</a></li>
                      <li><a href="project_detail.html">Historico</a></li>
                      <li><a href="contacts.html">Perfil</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> REPORTES</a>

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

              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

