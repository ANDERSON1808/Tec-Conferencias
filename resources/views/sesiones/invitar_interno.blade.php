<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Invitar Usuarios Internos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('invitarInternoSesion') }}" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nombre Conferencia</label>

                        <select class="form-control" onchange="subirSelect(this.value)" name="slcSesion" id="slcSesion" required>
                            <option value="">-- Seleccione la sesion --</option>
                            @foreach ($sesiones as $data)
                            @php
                            $quie_creo= $data->idUser;
                            $visitante = Auth::user()->id;
                            @endphp
                            @if ($quie_creo == $visitante)
                            <option value="{{ $data->id }}">{{ $data->nombre }}</option>
                            @else

                            @endif
                            @endforeach
                        </select>

                    </div>

                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                        <div class="panel">
                            <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse"
                                data-parent="#accordion1" href="#collapseOne1" aria-expanded="true"
                                aria-controls="collapseOne">
                                <center>
                                    <h4 class="panel-title">Invitar usuarios internos</h4>
                                </center>
                            </a>
                            <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <table class="table table-striped" id="tablaProductos">

                                    </table>
                                    <center> <a onclick="Agrega()" class="btn btn-link" id="btnAgregar" title="Agregar"><i
                                                class="fa fa-plus-circle" aria-hidden="true"></i>Nuevo usuario</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
            </div>


            </form>
            <script>
                $(function () {

                            });
                            var contador=0;
                        ///Funcion dinamica para agregar las listas de precios
                        function Agrega() {
                            contador++;
                            console.log("invit=>"+contador);
                            //creamos un objeto tr que anexaremos a nuestra tabla llamada tableProductos
                            var TR = document.createElement("tr");

                            //creamos 4 elementos td en donde iran los datos y uno cuarto donde ira un boton para eliminar
                            var TD1 = document.createElement("td")
                            var TD3 = document.createElement("td");

                            //asignamos los valores a nuestros td por medio del atributo innerHTML, el cual tiene el contenido HTML de un Nodo
                            TD1.innerHTML =
                                "<select class='select2_multiple form-control'  name='usuario[]' id='cars"+contador+"' requered >@foreach ($users as $date)<option value='{{ $date->id }}'>{{  $date->name }}</option> @endforeach</select>";


                            //A continuación asignamos contenido html a nuestro cuarto td
                            //esta es una forma de crear elementos tambien, dando el codigo html a un Nodo
                            TD3.innerHTML =
                                " <a onclick='Elimina(this)' class='btn btn-link' title='Eliminar' ><i class='fa fa-trash' aria-hidden='true'></i></a> "

                            //Ahora proseguimos a agregar los hijos TD al Padre TR
                            //Esta es otra manera de crear elementos HTML, por medio de el metodo appendChild
                            TR.appendChild(TD1);
                            TR.appendChild(TD3);

                            //Por ultimo asignamos nuestro TR a la tabla con id tablaProductos
                            document.getElementById("tablaProductos").appendChild(TR);


                        }

                        function Elimina(NodoBoton) {

                            //recibimos el boton como parametro, obtendremos el tr que lo contiene de la siguiente manera
                            //Como nuestro boton es hijo de un td, y este td de el tr, debemos invocar dos veces parentNode
                            //Esto para llegar a tener el TR
                            var TR = NodoBoton.parentNode.parentNode;

                            //ahora que ya tenemos el padre TR, podemos eliminarlo de la siguiente manera
                            //junto a todos sus hijos

                            document.getElementById("tablaProductos").removeChild(TR);
                        }

                        //Fin de la listas dinamica

            </script>
        </div>
    </div>
</div>
</div>
