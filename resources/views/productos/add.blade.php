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
               



                <div class="page-title">
              <div class="title_left">
                <h4>Nuevo ítem de venta</h4>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group row pull-right top_search">
                  
                </div>
              </div>
            </div>

            <div class="clearfix"></div>





<!-- form input mask -->
<div class="col-md-6 col-sm-12  ">
                <div class="x_panel">
                 
                  <div class="x_content">
                    <br />
                




                 
          <form  action="{{route('crear_producto')}}" method="post" novalidate enctype="multipart/form-data">
                  
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align">Nombre<span
                          class="required">*</span></label>
                      <div class="col-md-9 col-sm-9">
                        <input class="form-control" data-validate-length-range="4" data-validate-words="1" name="nombre"
                          placeholder="nombre del producto" required="required" />
                      </div>
                    </div>


                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align">Precio de venta <span
                          class="required">*</span></label>
                      <div class="col-md-9 col-sm-9">
                        <input class="form-control" type="number" class='number' name="precio_venta"
                          data-validate-minmax="1,10000000000" required='required'></div>
                    </div>


                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Relacionar con una lista</h4>
                        </a>

                       
                        <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                       
                            <table class="table table-striped" id="tablaProductos">
                             
                            </table>
                            <a onclick="Agrega()" class="btn btn-link" title="Agregar" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva lista</a>
                          </div>
                        </div>
                      </div>
                      </div>  
                     

                      <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align">Impuesto <span
                          class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 ">
                          <select class="form-control" name="impuesto" >
                            <option value="1">Ninguno-(0%)</option>
                            <option value="2"> Iva-(0%)</option>
                            <option value="3">Iva-(5%)</option>
                            <option value="4">Iva-(19%)</option>
                            <option value="5">Ico-(8%)</option>
                          </select>
                        </div>
                      </div>

                      <div class="field item form-group" >
                      <label class="col-form-label col-md-3 col-sm-3  label-align">Unidad <span
                          class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 " id="medi">
                          <select class="select2_group form-control" name="unidad_medida">
                          <option value="" selected disabled>Seleciona la unidad de medida</option>
                          <option value="1">no aplica</option>
                            <optgroup label="Unidad">
                            <option value="2">unidad</option>
                            <option value="3">servicio</option>
                              <option value="4">pieza</option>
                              <option value="5">miliar</option>
                            </optgroup>
                            <optgroup label="Longitud">
                            <option value="6">centimetro</option>
                            <option value="7">metro</option>
                            <option value="8">pulgada</option>
                            <option value="9">pie</option>
                              <option value="10">centimetro cuadrado</option>
                              <option value="11">centimetro cuadrado</option>
                              <option value="12">metro cuadrado</option>
                              <option value="13">pulgada cuadrada</option>
                            </optgroup>
                            <optgroup label="Volumen">
                              <option value="14">mililitro</option>
                              <option value="15">litro</option>
                              <option value="16">galon</option>
                            
                            </optgroup>
                            <optgroup label="Peso">
                              <option value="17">Gramo</option>
                              <option value="18">Kilogramo</option>
                              <option value="19">Tonelada</option>
                              <option value="20">Libra</option>
                           
                            </optgroup>
                           
                          </select>
                        </div>
                      </div>
                   
                      <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align">Referencia<span
                          class="required">*</span></label>
                      <div class="col-md-9 col-sm-9">
                        <input class="form-control" data-validate-length-range="4" data-validate-words="1" name="referencia"
                          placeholder="Referencia del producto" required="required" />
                      </div>
                    </div>

                    <div class="field item form-group">
                   <label class="col-form-label col-md-3 col-sm-3  label-align">Descripcion<span
                          class="required">*</span></label>
                          <div class="col-md-9 col-sm-9 ">
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion"></textarea>
                    </div>
                    </div>

                    <div class="field item form-group">

                    <label class="col-form-label col-md-3 col-sm-3  label-align">Inventariable<span
                          class="required">*</span></label>
                        
                          <div class="col-md-9 col-sm-9 ">
                              <input type="checkbox" class="js-switch" name="check" id="check" value="1" onchange="javascript:showContent()"  checked /> 
                              </div>
                    </div>
                 

                  </div>
                </div>
              </div>
              <!-- /form input mask -->

              <!-- form color picker -->
              <div class="col-md-6 col-sm-12  ">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br/>


                    <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3  label-align">Categoria <span
                          class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 ">
                       <a href="#" class="modalSubirTrigger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> Crear una categoria</a>  
                        <br/>
                          <select class="form-control" requered name="id_categoria">
                         
                          <option value="" selected disabled>--Selecione la categoria--</option>
                          @foreach ($categorias as $data)
                            <option value="{{ $data->id }}">{{ $data->nombre }}</option>
                            @endforeach
                        
                          </select>

                        </div>

                      </div>

                      <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3  label-align">Cuenta contable <span
                          class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 ">
                       <a href="#" ><i class="fa fa-plus" aria-hidden="true"></i> Configurar cuenta contable</a>  
                        <br/>
                          <select class="form-control" requered name="id_ventas_contable"> 
                         
                          <option value="" selected disabled>--Selecione la cuenta--</option>
                              <option value="17">Ingreso de actividades ordinarias</option>
                              <option value="18">ventas</option>
                              <option value="19">devolucion de ventas</option>
                              <option value="20">otros ingresos</option>
                              <option value="20">Ingresos financieros</option>
                              <option value="20">Otros ingresos diversos</option>
                        
                          </select>

                        </div>

                      </div>

                      <div class="form-group row">
                     
                                <div id="msg"></div>
                                
                                    <input type="file"  name="file" class="file" accept="image/*" required>
                                    <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Subir imagen" id="file">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse...</button>
                                    </div>
                                    </div>

                                </div>
                                <div class="ml-12 col-sm-12">
                                <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
                    </div>
           

                  </div>
    
                </div>


              </div>
              <!-- /form color picker -->

          

                </div>
              </div>
             
            

<div id="content" class="x_panel" >
              <div class="x_title" >
                <h2>Detalles de inventario</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="row">
      <div class="card-box table-responsive">

          <table id="tablaBodegas" class="table table-striped " style="width:100%">

              <tr>
                  <th>Unidad de medida</th>
                  <th>Costo inicial</th>
                  <th>Bodega</th>
                  <th>Cantidad Inicial</th>
                  <th>Cantidad Minima</th>
                  <th>Cantidad Maxima</th>
                  <th></th>
             </tr>
             <tr>
                  <td>
                          <select class="select2_group form-control" name="unidad_medida[]">
                          <option value="" selected disabled>Seleciona la unidad de medida</option>
                          <option value="1">no aplica</option>
                            <optgroup label="Unidad">
                            <option value="2">unidad</option>
                            <option value="3">servicio</option>
                              <option value="4">pieza</option>
                              <option value="5">miliar</option>
                            </optgroup>
                            <optgroup label="Longitud">
                            <option value="6">centimetro</option>
                            <option value="7">metro</option>
                            <option value="8">pulgada</option>
                            <option value="9">pie</option>
                              <option value="10">centimetro cuadrado</option>
                              <option value="11">centimetro cuadrado</option>
                              <option value="12">metro cuadrado</option>
                              <option value="13">pulgada cuadrada</option>
                            </optgroup>
                            <optgroup label="Volumen">
                              <option value="14">mililitro</option>
                              <option value="15">litro</option>
                              <option value="16">galon</option>
                            
                            </optgroup>
                            <optgroup label="Peso">
                              <option value="17">Gramo</option>
                              <option value="18">Kilogramo</option>
                              <option value="19">Tonelada</option>
                              <option value="20">Libra</option>
                           
                            </optgroup>
                           
                          </select>
                      </td>
                  <td><input class="form-control" type ="number" name="costo_unidad"
                          placeholder="costo" required="required" /></td>
                          <td> <select class="form-control" name="id_producto[]" requered>
                         
                         <option value="" selected disabled>Bodega</option>
                         @foreach ($bodegas as $dat)
                           <option value="{{ $data->id }}">{{ $dat->nombre }}</option>
                           @endforeach
                       
                         </select> </td>
                          <td><input class="form-control" type ="number" name="cantidad_inicial[]"
                          placeholder="Cantidad" required="required" /> </td>
                          <td><input class="form-control" type ="number" name="cantidad_minima[]"
                          placeholder="Cantidad" required="required" /> </td>
                          <td><input class="form-control" type ="number" name="cantidad_maxima[]"
                          placeholder="Cantidad" required="required" /> </td>
                    
           
          </table>
          <a onclick='Nuevo()' class='btn btn-link' title='Nueva bodega' ><i class='fa fa-plus-circle' aria-hidden='true'></i>Agregar bodega</a>
      </div>
</div>


                  </div>

               
                </div>

              
              </div>



     <div id="content" class="x_panel" >
              <div class="x_title" >
                
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="row">
                <div class="col-md-6 col-sm-12  ">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-6 col-sm-12  ">
                <button type="reset" class="btn btn-round btn-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cancelar</font></font></button>

                <button type="Submit" class="btn btn-round btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Guardar y crear nueva</font></font></button>
                <button type="Submit" class="btn btn-round btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Guardar</font></font></button>
                </div>
                </div>
          </div>
     </div>       
     </form>
           
        <!-- /page content -->

@include('footer')
<div class="modalKu"></div>
@include('script')

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); 

   // carga masiva
   $('.modalSubirTrigger').click(function(event){
    event.preventDefault();
        $.ajax({
            url     : "{{url('crear_modal')}}",
            method  : 'POST',
            success : function(response){
                $('.modalKu').html(response);
                $('#exampleModalCenter').modal('show');
            }
        });
  });
    // initialize a validator instance from the "FormValidator" constructor.
    // A "<form>" element is optionally passed as an argument, but is not a must
    var validator = new FormValidator({ "events": ['blur', 'input', 'change'] }, document.forms[0]);
    // on form "submit" event
    document.forms[0].onsubmit = function (e) {
      var submit = true,
        validatorResult = validator.checkAll(this);
      console.log(validatorResult);
      return !!validatorResult.valid;
    };
    // on form "reset" event
    document.forms[0].onreset = function (e) {
      validator.reset();
    };
    // stuff related ONLY for this demo page:
    $('.toggleValidationTooltips').change(function () {
      validator.settings.alerts = !this.checked;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);


///Funcion dinamica para agregar las listas de precios
function Agrega(){
 
 //creamos un objeto tr que anexaremos a nuestra tabla llamada tableProductos
 var TR= document.createElement("tr");
  
 //creamos 4 elementos td en donde iran los datos y uno cuarto donde ira un boton para eliminar
 var TD1=document.createElement("td")
 var TD2=document.createElement("td")
 var TD3=document.createElement("td");
  
 //asignamos los valores a nuestros td por medio del atributo innerHTML, el cual tiene el contenido HTML de un Nodo
 TD1.innerHTML="<select class='select2_multiple form-control'  name='id_lista_precio[]' id='cars'requered > @foreach ($lista_precios as $dati)<option value='{{ $dati->id }}'>{{ $dati->nombre }}</option>@endforeach</select>";

 TD2.innerHTML="<input class='form-control demo colorpicker-element' name='precio_venta[]' type='number' class='number' name='number' requered >";

  
 //A continuación asignamos contenido html a nuestro cuarto td
 //esta es una forma de crear elementos tambien, dando el codigo html a un Nodo
 TD3.innerHTML=" <a onclick='Elimina(this)' class='btn btn-link' title='Eliminar' ><i class='fa fa-close' '></i></a> "
  
 //Ahora proseguimos a agregar los hijos TD al Padre TR
 //Esta es otra manera de crear elementos HTML, por medio de el metodo appendChild
 TR.appendChild(TD1);
 TR.appendChild(TD2);
 TR.appendChild(TD3);
  
 //Por ultimo asignamos nuestro TR a la tabla con id tablaProductos
 document.getElementById("tablaProductos").appendChild(TR)
  
 
 }
 function Elimina(NodoBoton){
  
  //recibimos el boton como parametro, obtendremos el tr que lo contiene de la siguiente manera
  //Como nuestro boton es hijo de un td, y este td de el tr, debemos invocar dos veces parentNode
  //Esto para llegar a tener el TR
  var TR= NodoBoton.parentNode.parentNode;
   
  //ahora que ya tenemos el padre TR, podemos eliminarlo de la siguiente manera
  //junto a todos sus hijos
   
  document.getElementById("tablaProductos").removeChild(TR);
  }
 
//Fin de la listas dinamica

//***Codigo para agregar los item de las bodegas */

function Nuevo(){
 
 //creamos un objeto tr que anexaremos a nuestra tabla llamada tableProductos
 var TR= document.createElement("tr");
  
 //creamos 4 elementos td en donde iran los datos y uno cuarto donde ira un boton para eliminar
 var TD1=document.createElement("td");
 var TD2=document.createElement("td");
 var TD3=document.createElement("td");
 var TD4=document.createElement("td");
 var TD5=document.createElement("td");
 var TD6=document.createElement("td");
 var TD7=document.createElement("td");
  
 //asignamos los valores a nuestros td por medio del atributo innerHTML, el cual tiene el contenido HTML de un Nodo
 TD1.innerHTML="";
 TD2.innerHTML="";
 TD3.innerHTML="<select class='form-control'requered name='unidad_medida[]'><option selected disabled>Bodega</option> @foreach ($bodegas as $dat)<option value='{{ $data->id }}'>{{ $dat->nombre }}</option>@endforeach</select>";
 TD4.innerHTML="<input class='form-control' type ='number' name='cantidad_inicial[]' placeholder='Cantidad' required='required' requered /> ";
 TD5.innerHTML="<input class='form-control' type ='number' name='cantidad_minima[]' placeholder='Cantidad' required='required' requered/> ";
 TD6.innerHTML="<input class='form-control' type ='number' name='cantidad_maxima[]' placeholder='Cantidad' required='required' requered /> ";


  
 //A continuación asignamos contenido html a nuestro cuarto td
 //esta es una forma de crear elementos tambien, dando el codigo html a un Nodo
 TD7.innerHTML=" <a onclick='EliminaR(this)' class='btn btn-link' title='Eliminar' ><i class='fa fa-times' aria-hidden='true'></i></a> "
  
 //Ahora proseguimos a agregar los hijos TD al Padre TR
 //Esta es otra manera de crear elementos HTML, por medio de el metodo appendChild
 TR.appendChild(TD1);
 TR.appendChild(TD2);
 TR.appendChild(TD3);
 TR.appendChild(TD4);
 TR.appendChild(TD5);
 TR.appendChild(TD6);
 TR.appendChild(TD7);
  
 //Por ultimo asignamos nuestro TR a la tabla con id tablaProductos
 document.getElementById("tablaBodegas").appendChild(TR)
  
 
 }
 function EliminaR(NodoBoton){
  
  //recibimos el boton como parametro, obtendremos el tr que lo contiene de la siguiente manera
  //Como nuestro boton es hijo de un td, y este td de el tr, debemos invocar dos veces parentNode
  //Esto para llegar a tener el TR
  var TR= NodoBoton.parentNode.parentNode;
   
  //ahora que ya tenemos el padre TR, podemos eliminarlo de la siguiente manera
  //junto a todos sus hijos
   
  document.getElementById("tablaBodegas").removeChild(TR);
  }
//**Fin del codigo para agragar item bodega */





    
  </script>
<style type="text/css">
                                .file {
                                visibility: hidden;
                                position: absolute;
                                }
</style>
 <script type="text/javascript">
                                $(document).on("click", ".browse", function() {
                                var file = $(this).parents().find(".file");
                                file.trigger("click");
                                });
                                $('input[type="file"]').change(function(e) {
                                var fileName = e.target.files[0].name;
                                $("#file").val(fileName);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    // get loaded data and render thumbnail.
                                    document.getElementById("preview").src = e.target.result;
                                };
                                // read the image file as a data URL.
                                reader.readAsDataURL(this.files[0]);
                                });



//Codigo para mostrar los artulos inventaribales
function showContent() {
        element = document.getElementById("content");
        medida = document.getElementById("medi");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
            medida.style.display='none';
        }
        else {
            element.style.display='none';
            medida.style.display='block';
        }
    }




</script>

</div>
    </div>


    

    </body>
  
</html>