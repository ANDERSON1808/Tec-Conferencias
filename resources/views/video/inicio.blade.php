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
                <h3>VIDEOCONFERENCIAS</h3>
                <p> Crea videoconferecias con tu equipo de trabajo</p>
              </div>
            
              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                  <a href="#" class="modalSubirTrigger" data-toggle="modal" data-target="#exampleModal"><button class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i>  Nueva Videconferencia</button></a>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </div>
                  
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
                    <h2></h2>
                  <a href="#" class="modalInvitar" data-toggle="modal" data-target="#exampleModal"><button type="button" class="btn btn-round btn-success"><i class="fa fa-users" aria-hidden="true"></i>  Agendar Usuarios</button></a>
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
                                <th>Token</th>
                                <th>Fecha Reunion</th>
                                <th>Convocar</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>


                            <tbody>
                            @foreach ($consultaG as $data)
                            @php
                            $x=$data->estado;
                            $conferencia = $data->creador; 
                            $visitante = Auth::user()->id;
                            @endphp

                            @if ($conferencia == $visitante)

                              <tr>
                                <td>{{ $data->nombre }}</td>
                                <td>{{ $data->descripcion }}</td>
                                @if ($x==1)
                                <td class="table-primary">Agendada</td>
                                @else
                                <td class="table-danger">Ejecutada</td>
                                @endif
                                <td>{{$data->contraseña }} </td>
                                <td>{{$data->fecha_r }} </td>
                                @if($x==1 && $conferencia == $visitante )
                                <td> 
                                <a href="{{ route('online',$data->id) }}"  class="btn btn-outline-success" title="Iniciar conferencia" ><i class="fa fa-video-camera" aria-hidden="true">  Iniciar conferencia</i></a>
                                </td>
                                @else 
                                <td>
                                <a onclick="new PNotify({
                                  title: 'Aviso Importante',
                                  text: 'Lo sentimos la reunion ya fue desarrollada.',
                                  styling: 'bootstrap3'
                              });"   class="btn btn-outline-success" title="Iniciar conferencia" disabled ><i class="fa fa-video-camera" disabled aria-hidden="true">  Iniciar conferencia</i></a>
                                </td>
                                @endif

                                <td align="center">
                              
                                <a onClick="modalEditTriger({{$data->id}})" class="btn btn-link" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                              
                                <a onClick="modalDeleteTrigger({{$data->id}})" class="btn btn-link" title="Eliminar" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                </td>
                              </tr>
                         @else

                          @endif
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
    // carga masiva
  $('.modalSubirTrigger').click(function(event){
    event.preventDefault();
        $.ajax({
            url     : "{{url('crear_conferencia')}}",
            method  : 'POST',
            success : function(response){
                $('.modalKu').html(response);
                $('#exampleModalCenter').modal('show');
            }
        });
  });
//**Modal para invitar a conferencia */
    // carga masiva
    $('.modalInvitar').click(function(event){
    event.preventDefault();
        $.ajax({
            url     : "{{url('invitar_usuarios')}}",
            method  : 'POST',
            success : function(response){
                $('.modalKu').html(response);
                $('#exampleModalCenter').modal('show');
            }
        });
  });

//modal_edit.
function modalEditTriger(id){
  event.preventDefault();
      $.ajax({
        url     : "{{url('modal_ver')}}",
        method  : 'POST',
        data    : {
          'id' : id
        },
        success : function(response){
          // console.log(response);
          $('.modalKu').html(response);
          $('#myModal').modal('show');
        }
      });
    }
// MODAL DELETE
function modalDeleteTrigger(id){
      // var r = confirm("Apa anda yakin akan menghapus data?");
      // if (r == true){
        $.ajax({
        url     : "{{url('/delete_lista')}}",
        method  : 'POST',
        data    : {
          'id' : id
        },
        success : function(response){
          console.log(response);
          $('.modalKu').html(response);
          $('#myModalE').modal('show');
          // if (response.status == 'error'){
          //   alert('Delete Error');
          // }else{
          //   alert('Delete Success!!');
          //   window.location.replace('/datasiswa/public/home');
          // }
        }
      });
      // }else{
      //   alert('Delete Canceled!');
      // }
    }

    //Mensaje de error
 
    //Fin de mensaje de error

  </script>
</html>

<?php
}
?>