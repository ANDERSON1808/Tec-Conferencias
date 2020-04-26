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

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                <script  src='https://meet.jit.si/external_api.js'> </script>
                @foreach($conferencia as $client)
                <script>
                $(document).ready(function(){
                var domain ="meet.jit.si";

                var options ={
                    roomName:"{{ $client->nombre}}",
                    width: 1000,
                    height: 700,
                    userInfo : {email: 'andersonl@globalsolutionservice.com' , displayName : 'ANDERSON LOSADA SILVA'},
                    parentNode: document.querySelector('#meet'),
                    interfaceConfigOverwrite: { filmStripOnly: false },

                }

                    var api = new JitsiMeetExternalAPI(domain, options);
                    //api . executeCommand ( 'subject' ,  'New Conference Subject' ) ;

                    });

            </script>
         @endforeach

         @foreach($conferencia as $client)

         @php
        $verificar = $client->idUser;
        $usuario_encasa = Auth::user()->id;
         @endphp


@if ($verificar )
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div id="ji" class="title_left">
                <h3> <i class="fa fa-video-camera" aria-hidden="true">  En linea </i> <i class="fa fa-rss" aria-hidden="true"></i></h3>

              </div>

              <div class="title_right">
              <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">

                    <form action="{{route('terminar')}}" method="post" enctype="multipart/form-data" >
                    <input type="hidden" class="form-control" value="{{$client->idUser}}" name="id" id="id" >

                    <button type="submit" class="btn btn-round btn-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Terminar Conferencia</font></font></button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </div>
                </div>
              <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">

                  <a onClick="modalSubirTrigger({{$client->idUser}})"  title="Editar"> <button type="button" class="btn btn-round btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Invitar usuarios externos</font></font></button></a>

                  <a onClick="modalTemas({{$client->idUser}})"  title="Editar"> <button type="button" class="btn btn-round btn-success"><span style="horizontal-align: inherit;"><span style="horizontal-align: inherit;">Nuevo tema</span></span></button></a>

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




                <div id="meet"  >

                </div>


                  </div>
                </div>
              </div>



                  </div>
                </div>
              </div>



         @else





         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div id="ji" class="title_left">
                <h3> <i class="fa fa-video-camera" aria-hidden="true">  En linea </i> <i class="fa fa-rss" aria-hidden="true"></i></h3>

              </div>

              <div class="title_right">

              <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">


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
                    <h2>Bienvenido a la conferencia {{ $client->nombre}} </h2>
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





                <div style = "border: 2px solid # D5CC5A; overflow: hidden; margin: 1px auto; height:100; max-width: 930px; ">
                <div id="meet"  >


                </div>
                </div>


                  </div>
                </div>
              </div>



                  </div>
                </div>
              </div>




         @endif
        <!-- /page content -->







        @endforeach

        <div class="modal fade" id="modalTemas" tabindex="-1" role="dialog" aria-labelledby="modalTemasTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Invitar Usuarios Internos</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


              <form  method="post"   enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="txtNombre">Nombre</label>

                                    <input type="text" class="form-control" name="txtNombre" id="txtNombre" value=" "
                                        required>
                                </div>

                              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </div>


          </form>

              </div>
            </div>
          </div>
          </div>
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
function modalTemas(id){
          $('#modalTemas').modal('show');
}
  function modalSubirTrigger(id){
  event.preventDefault();
      $.ajax({
        url     : "{{url('invitar_externos')}}",
        method  : 'POST',
        data    : {
          'id' : id
        },
        success : function(response){
          // console.log(response);
          $('.modalKu').html(response);
          $('#exampleModalCenter').modal('show');
        }
      });
    }
  </script>


</html>

