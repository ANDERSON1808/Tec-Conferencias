

<!-- Bootstrap -->
<link href="{{ asset('/gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('/gentelella-master/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('/gentelella-master/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('/gentelella-master/build/css/custom.min.css') }}" rel="stylesheet">



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Invitar Usuarios externos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      




<!-- Smart Wizard -->
<p>Siga los siguientes pasos para invitar usuarios externos</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                            <br />
                                             
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                            Paso 2<br />
                                             
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                            Paso 3<br />
                                             
                          </span>
                          </a>
                        </li>
                      
                      </ul>
                    <div id="step-1">

                        <div class="form-group row">
                          
                        </div>
                    </div>
                          

                      <div id="step-2">
                      <center>  <h2 class="StepTitle">INFORMACION</h2>
                        <p>
                        Por favor copie el siguiente link. 
                        </p>
                        </center>
                        <div class="form-group">
                        <center> <label for="exampleInputEmail1">Videoconferencia</label></center>
                        @foreach($conferencia as $client)
                                <input type="text" class="form-control" disabled  aria-describedby="emailHelp" value="{{$client->conferencia}}">
                         @endforeach   
                        </div>
                      </div>
                      <div id="step-3">
               
                      <center><h2 class="StepTitle">ENVIAR INVITACION</h2>
                         <p>
                        Puede enviar el link por alguno de los siguientes medios:
                        </p> </center>
                        
  

                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col"> <a  href="https://web.whatsapp.com/"  target="_blank"><img src="{{URL::asset('logo/124034.png')}}"  width="100px" height="100px" class="img-thumbnail"></a></th>
                            <th scope="col"> <a  href="https://mail.google.com/mail/u/0/#inbox"  target="_blank"><img src="{{URL::asset('logo/gmail.png')}}"  width="100px" height="100px" class="img-thumbnail"></a></th>
                            <th scope="col"> <a  href="https://www.facebook.com/"  target="_blank"><img src="{{URL::asset('logo/face.jpg')}}"  width="100px" height="100px" class="img-thumbnail"></a></th>
                            <th scope="col"> <a  href="https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1587767799&rver=7.0.6737.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fmail%2f0%2finbox%3fnlp%3d1%26RpsCsrfState%3d339333f2-b67d-fcb9-aab3-5f93fb15c2ad&id=292841&aadredir=1&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=90015"  target="_blank"><img src="{{URL::asset('logo/outloo.jpg')}}"  width="100px" height="100px" class="img-thumbnail"></a></th>
                            </tr>
                        </thead>
                        </table>
                       

                      </div>

                    </div>
                    <!-- End SmartWizard Content -->
                   <!-- jQuery -->
    <script src="{{ asset('/gentelella-master/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
   <script src="{{ asset('/gentelella-master/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/gentelella-master/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('/gentelella-master/vendors/nprogress/nprogress.js') }}"></script>
    <!-- jQuery Smart Wizard -->
    <script src="{{ asset('/gentelella-master/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/gentelella-master/build/js/custom.min.js') }}"></script>




      

                             
            

    </div>
  </div>
</div>
</div>


