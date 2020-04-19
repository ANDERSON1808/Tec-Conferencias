<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('Finanzas MPR','Finanzas MPR')</title>
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
                  @foreach($categorias as $client)
                  <h2>{{ $client->nombre}}</h2> 
                    @endforeach

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

   
                  @foreach($categorias as $client)

                  <div class="col-md-6 col-sm-12  form-group">
                        <label for="exampleFormControlInput1">Categoria</label>
                        <textarea class="form-control" rows="3"  disabled>{{ $client->nombre}}</textarea>
                    </div>
                    <div class="col-md-6 col-sm-12  form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea class="form-control" rows="3"  disabled>{{ $client->descripcion}}</textarea>
                    </div>
                   
                    <div align="center" class="col-md-12 col-sm-12  form-group">
                    <img src="{{ asset('/img/'. $client->imagen) }}" width="300" height="300"  class="rounded" alt="Cinque Terre">

                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @endforeach



                    <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Item de la categoria<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Referencia</th>
                          <th>Precio</th>
                          <th>Descripcion</th>
                          <th>Acciones</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Tiger</td>
                          <td>Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          <td  align="center">
                          <a   class="btn btn-link" title="ver detalle" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a  class="btn btn-link" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                <a  class="btn btn-link" title="Desactivar" ><i class="fa fa-magic" aria-hidden="true"></i></a>
                                <a  class="btn btn-link" title="Eliminar" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                          
                        </tr>
                       
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
  
</html>