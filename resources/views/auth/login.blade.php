
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Finanzas MPR</title>

    @include('libreria')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </head>
  <style type="text/css">

html {
        background: url(images/fondo.jpg) no-repeat center center fixed;
        background-size: cover;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        -o-background-size: cover;
}

</style>
  <body>
  <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>
  <!-- Modal -->
 <!-- Modal -->



 
<div class="container">
 <div class="modal fade"  id="mostrarmodal" role="dialog"   data-backdrop="static">
    <div class="modal-dialog">
    

 
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
        
    
         

                      <section class="login_content">
                        <form method="POST" action="{{ route('login') }}">
                  @csrf


                          <img src="logo/logo_mpr.jpeg" width="200px" height="150px" class="rounded-circle" alt="Cinque Terre">
                          <h1>{{ __('inicio de sesión') }}</h1>
                          <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                          @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                          @enderror
                    </div>
                          <div>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                          @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                          @enderror
                    </div>
                          <div>
                    
                          <button type="submit" class="btn btn-primary">
                                                {{ __('iniciar sesión') }}
                          </button>
                      @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                            @endif
                          </div>

                          <div class="clearfix"></div>

                          <div class="separator">
                            

                            <div class="clearfix"></div>
                            <br />

                            <div>
                              <h1><i class="fa fa-calculator" aria-hidden="true"></i>  Finanzas MPR!</h1>
                              <strong>Copyright © 2020 <a href="#">JDLC technology company</a>.</strong> All rights reserved.
                            </div>
                          </div>
                        </form>
                      </section>
                 
  
          </div>

     </div>

    </div>
  </div>
</div>

@include('script')
  </body>
</html>
