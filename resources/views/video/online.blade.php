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

       


 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div id="ji" class="title_left">
                <h3> <i class="fa fa-video-camera" aria-hidden="true">  En linea </i> <i class="fa fa-rss" aria-hidden="true"></i></h3>
               
              </div>
             
              <div class="title_right">
        
              <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                  
                    <button type="button" class="btn btn-round btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Invitar usuarios externos</font></font></button>
                    
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

