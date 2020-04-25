<?php
    if (Auth::guest()) {
      return redirect('/auth/login');
    }else{
      
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('Tec videoconferencia','Tec | Videconferencias')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Libreria -->
    @include('libreria')

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">


<!-- Sidebar -->
@include('sidebar')
 <!-- Header -->
@include('header')

@yield('content')
 <!-- page content -->
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>INVITACIONES A CONFERENCIAS</h3>
                <p> Gestion integra de trabajo.</p>
              </div>
            
              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  
                </div>
              </div>
            </div>
            @if(Session::has('message'))
            <script>
							  window.onload = function() {
								new PNotify({
                                  title: 'Perfecto.',
                                  text: '{{ Session::get('message') }}',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
								};
							  </script>
            @elseif(Session::has('error'))
                              
            <script>
							  window.onload = function() {
                  new PNotify({
                                  title: 'Error.',
                                  text: '{{ Session::get('error') }}',
                                  type: 'error',
                                  hide: false,
                                  styling: 'bootstrap3'
                              });
								};
							  </script>
            @endif
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2</h2>
                  
                    <ul class="nav navbar-right panel_toolbox">
                  
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          

                          <table id="datatable-keytable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Nombre de la conferencia</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Fecha Reunion</th>
                                <th>Accion</th>
                              </tr>
                            </thead>


                            <tbody>
                            @foreach ($consultaG as $data)
                            @php
                            $x=$data->estado;
                            $conferencia = $data->creador; 
                            $visitante = Auth::user()->id;
                            $puedo_iniciar= $data-> indica_inicio;
                            @endphp

                            @foreach ($invitado as $dat)
                            @php
                                $invitados= $dat->cod_usuario ;

                                @endphp
                            
                            @if ($invitados == $visitante)
                         
                            <tr>
                                <td>{{ $data->nombre }}</td>
                                <td>{{ $data->descripcion }}</td>
                                @if ($x==1)
                                <td class="table-primary">Agendada</td>
                                @else
                                <td class="table-danger">Ejecutada</td>
                                @endif
                                <td>{{$data->fecha_r }} </td>
                                @if($x==1 &&  $puedo_iniciar==1 )
                                <td>
                                <a href="{{ route('online',$data->id) }}"  class="btn btn-outline-success" title="Iniciar conferencia" ><i class="fa fa-video-camera" aria-hidden="true">Unirse a la conferencia</i></a>
                                </td>
                                @else 
                                <td>
                                <a onclick="new PNotify({
                                  title: 'Aviso Importante',
                                  text: 'La conferencia no ha iniciado aun.',
                                  styling: 'bootstrap3'
                              });"  class="btn btn-outline-success" title="Iniciar conferencia" ><i class="fa fa-video-camera" aria-hidden="true">Unirse a la conferencia</i></a>
                                </td>
                                <td>
                                <a onclick="new PNotify({
                                  title: 'Aviso Importante',
                                  text: 'Lo sentimos la reunion ya fue desarrollada.',
                                  styling: 'bootstrap3'
                              });"   class="btn btn-outline-success" title="Iniciar conferencia" disabled ><i class="fa fa-video-camera" disabled aria-hidden="true">  Unirse a la conferencia</i></a>
                                </td>
                                @endif

                              </tr>


                            @else 

                            @endif

                            @endforeach
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



                  </div>
                </div>
              </div>
         
        <!-- /page content -->

@include('footer')
<div class="modalKu"></div>
@include('script')
</div>
    </div>
    </body>
    <script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); 
 
   
  </script>
</html>

<?php
}
?>