<?php
// )|| (Auth::user()->idRol!=2)
    if (Auth::guest() ) {
      return url('/auth/login');
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
                            <h3>ADMINISTRAR SESIONES</h3>
                            <p> Editar y asignar sesiones</p>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                                <div class="input-group">
                                    <a href="#" onclick="crearSesion()" class="modalSubirTrigger" data-toggle="modal"
                                        data-target="#exampleModalL"><button class="btn btn-info"><i class="fa fa-plus"
                                                aria-hidden="true"> </i> Crear Sesion.</button></a>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Session::has('message'))
                    <script>
                        window.onload = function () {
                            new PNotify({
                                title: 'Perfecto.',
                                text: '{{ Session::get('
                                message ') }}',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                        };

                    </script>
                    @elseif(Session::has('error'))

                    <script>
                        window.onload = function () {
                            new PNotify({
                                title: 'Error.',
                                text: '{{ Session::get('
                                error ') }}',
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
                                    <a href="#" class="modalInvitar" data-toggle="modal"
                                        data-target="#exampleModal"><button type="button"
                                            class="btn btn-round btn-success"><i class="fa fa-users"
                                                aria-hidden="true"></i> Agendar Usuarios</button></a>


                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-expanded="false"><i class="fa fa-wrench"></i></a>

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


                                                <table id="tblSesion" class="table table-striped table-bordered"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Descripcion</th>
                                                            <th>Creador</th>
                                                            <th>Fecha</th>
                                                            <th>Convocatoría</th>
                                                            <th>Finalizado</th>
                                                            <th>Accion</th>
                                                            <th>Administracion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodySesion">

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

            {{--   --------------------------------------   MODAL --------------------------------------         --}}
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">CREAR SESION.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="frmSesion">
                                <input type="hidden" name="idUser" id="idUser" value="{{ Auth::user()->id  }}">
                                <div class="form-group">
                                    <label for="txtNombre">TIPO SESION</label>
                                    <select class="form-control" id="slcSesion" name="slcSesion">
                                        <option value="" disabled selected>--SELECIONE UN TIPO DE SESION--</option>
                                        <option value="general">GENERAL</option>
                                        <option value="comisiones">COMISION</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="txtNombre">NOMBRE</label>

                                    <input type="text" class="form-control" name="txtNombre" id="txtNombre" value=" "
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="txtDesc">DESCRIPCION</label>
                                    <input type="text" class="form-control" name="txtDesc" id="txtDesc" value=" "
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="txtDesc">FECHA</label>
                                    <input type="date" class="form-control" id="dtFecha" min="2019-09-01"
                                        name="txtfechainicio">


                                </div>
                                <div class="modal-footer center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            {{--   -------------------------------------- FIN MODAL --------------------------------------         --}}
            <!-- /page content -->

            @include('footer')
            <div class="modalKu"></div>
            @include('script')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {

            $('.modalInvitar').click(function (event) {
                $.ajax({
                    url: "{{ url('inviteUserSesion') }}",
                    method: 'POST',
                    success: function (response) {
                        $('.modalKu').html(response);
                        $('#exampleModalCenter').modal('show');
                    }
                });
            });
            verSesiones();
            var fecha = new Date();
            var anio = fecha.getFullYear();
            var dia = fecha.getDate();
            var _mes = fecha.getMonth(); //viene con valores de 0 al 11
            _mes = _mes + 1; //ahora lo tienes de 1 al 12
            if (_mes < 10) //ahora le agregas un 0 para el formato date
            {
                var mes = "0" + _mes;
            } else {
                var mes = _mes.toString;
            }
            document.getElementById("dtFecha").min = anio + '-' + mes + '-' + dia;
            $("#frmSesion")
                .submit(function (e) {
                    e.preventDefault();
                    data = $("#frmSesion").serialize();
                    $.post("createSesion", data)
                        .done(function (data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Nueva sesion creada!'
                            })
                            setTimeout(function () {
                                $('#myModal').modal('hide');
                            }, 1100);
                            verSesiones();
                        });
                });
        });



        function Elimina(NodoBoton) {

            var TR = NodoBoton.parentNode.parentNode;
            document.getElementById("tablaProductos").removeChild(TR);
        }

        function subirSelect(id) {
                var table = $("#tablaProductos");
                table.innerHTML = "";
            $.post("getInvitadoSesion", {
                idSesion: id
            }).done(function (data) {



                var users = data["users"];
                var invitadosSesion = data["invitadosSesion"];
                var option="";
                var TR = document.createElement("tr");
                var TD1 = document.createElement("td")
                var TD3 = document.createElement("td");
                TD3.innerHTML =
                    " <a onclick='Elimina(this)' class='btn btn-link' title='Eliminar' ><i class='fa fa-trash' aria-hidden='true'></i></a> "
                $.each(users, function (key, reg) {
                    option += "<option value=" + reg.id + ">" + reg.name + "</option> ";
                });
                var contador = 0;
               $.each(invitadosSesion, function (key, reg) {
                    contador++;
                   console.log(contador);
                    // option += "<option value=" + reg.id + ">" + reg.name + "</option> ";
                    if(contador=="1"){
                        document.getElementById("headingOne1").click();
                        $("#cars"+reg.idUser).val(reg.idUser);
                        TD1.innerHTML =
                    "<select class='select2_multiple form-control'  name='usuario[]' id='cars"+reg.idUser+"' requered >" +
                    option + "</select>";
                        TR.appendChild(TD1);
                        TR.appendChild(TD3);
                        document.getElementById("tablaProductos").appendChild(TR);
                    }else{
                        $("#cars"+contador).val(reg.idUser);
                        document.getElementById("btnAgregar").click();
                    }
                });
                var contadorcero =0;
                $.each(invitadosSesion, function (key, reg) {
                    contadorcero++;
                    if(contadorcero==contador){
                        console.log(contador);
                        console.log(contadorcero);
                        console.log(idUser);
                        $("#cars"+reg.idUser).val(reg.idUser);
                    } else{
                        $("#cars"+contadorcero).val(reg.idUser);
                    }

                });
            });
        }

        function updateSesion() {
            $.post("{{ route('editSesionpost') }}", ($("#frmSesionUpdate").serialize()))
                .done(function (data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Sesion actualizada!'
                    })
                    verSesiones();
                    $('#modalEditSesiones').modal('hide');
                });
        }

        function getEditSesion(id) {
            $.post("getEditSesion", {
                    id: id
                })
                .done(function (response) {
                    $('.modalKu').html(response);
                    $('#modalEditSesiones').modal('show');
                    $("#btnActualizarSesion").click(function (e) {
                        updateSesion();

                    });
                    var fecha = new Date();
                    var anio = fecha.getFullYear();
                    var dia = fecha.getDate();
                    var _mes = fecha.getMonth(); //viene con valores de 0 al 11
                    _mes = _mes + 1; //ahora lo tienes de 1 al 12
                    if (_mes < 10) //ahora le agregas un 0 para el formato date
                    {
                        var mes = "0" + _mes;
                    } else {
                        var mes = _mes.toString;
                    }
                    document.getElementById("dtFechaAct").min = anio + '-' + mes + '-' + dia;
                });
        }

        function avisoSesion() {
            new PNotify({
                title: "Aviso Importante",
                text: " Lo sentimos la reunion ya fue desarrollada. ",
                styling: "bootstrap3"
            });
        }

        function verSesiones() {
            $.get("getSesiones", function (data) {
                var table = $("#tbodySesion");
                table.innerHTML = "";
                var tableData;
                $.each(data, function (key, reg) {
                    //CODIGO PARA REDIRECCIONAR EN URL HREF:
                    var url = '{{ route("onlineSesionIdControl", ":id") }}';
                    url = url.replace(':id', reg.id);
                    var disable =
                        '<a href="' + url + '"  ' +
                        'class="btn btn-outline-info" title="Iniciar sesion" >' +
                        '<i class="fa fa-video-camera"   aria-hidden="true"> </i></a>';
                    if (reg.estado == "convocado") {
                        reg.fechaFinalizado = "N/A";
                    } else {
                        disable =
                            '<a onclick="avisoSesion()"   class="btn btn-outline-info" title="Iniciar conferencia" disabled >' +
                            '  <i class="fa fa-video-camera" disabled aria-hidden="true">  Iniciar conferencia</i></a>';

                    }
                    tableData += '<tr><td>' + reg.nombre + '</td><td>' + reg.descripcion +
                        '</td>   ' +
                        '<td>' + reg.name + '</td><td>' + reg.fechaSesion + '</td><td>' + reg
                        .fechaCreada + '</td> ' +
                        '<td>' + reg.fechaFinalizado + '</td><td>  ' + disable +
                        '  </td>  ' +
                        '   <td>' +
                        '   <a href="#" onClick="getEditSesion(' + reg.id + ')"' +
                        '   class="btn btn-outline-info"' +
                        '   title="Iniciar conferencia">' +
                        '   <i class="fa fa-pencil-square-o"' +
                        '       aria-hidden="true"></i>' +
                        '</a>' +
                        '   <a href="#" onClick="AlertDelete(' + reg.id + ')"' +
                        '   class="btn btn-outline-info"' +
                        '   title="Iniciar conferencia">' +
                        '   <i class="fa fa-trash"' +
                        '       aria-hidden="true"></i>' +
                        '</a>' +
                        '</button></td></tr> ';
                });
                table.html(tableData);
                $('#tblSesion').DataTable();
            });
        }

        function crearSesion() {
            $('#myModal').modal('show');
        }
        // MODAL DELETE
        function AlertDelete(id) {
            Swal.fire({
                title: 'Desea eliminar la sesion',
                icon: 'question',
                iconHtml: '؟',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                showCloseButton: true
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Eliminado!',
                        'La sesion se elimino correctamente',
                        'success'
                    ).then((result) => {

                        $.ajax({
                            url: "{{url('/deleteSesionpost')}}",
                            method: 'POST',
                            data: {
                                'id': id
                            },
                            success: function (response) {
                                verSesiones();
                            }
                        });

                    })
                }
            })
        }

    </script>
</body>


</html>

<?php
}
?>
