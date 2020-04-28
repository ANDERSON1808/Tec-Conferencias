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

    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script src='https://meet.jit.si/external_api.js'> </script>
            <script>
                // $.get("online")

            </script>
            @foreach($conferencia as $client)
            <script>
                $(document).ready(function () {
                    var domain = "meet.jit.si";

                    var options = {
                        roomName: "{{ $client->nombre}}",
                        width: 1000,
                        height: 700,
                        userInfo: {
                            email: 'andersonl@globalsolutionservice.com',
                            displayName: 'ANDERSON LOSADA SILVA'
                        },
                        parentNode: document.querySelector('#meet'),
                        interfaceConfigOverwrite: {
                            filmStripOnly: false
                        },

                    }

                    var api = new JitsiMeetExternalAPI(domain, options);
                    //api . executeCommand ( 'subject' ,  'New Conference Subject' ) ;

                });

            </script>
            @endforeach

            @foreach($conferencia as $client)

            @php
            $verificar = $client->idUser;
            $idRol = Auth::user()->idRol;
            $usuario_encasa = Auth::user()->id;
            @endphp


            @if ( $usuario_encasa )
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                                <div class="input-group">
                                    @if (($idRol=="1" )|| ($idRol=="3" ) || ($idRol=="2" ) )
                                    <form action="{{route('terminarSesion')}}" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" class="form-control" value="{{$client->idUser}}" name="id"
                                            id="id">

                                        <button type="submit" class="btn btn-round btn-danger">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Terminar la Sesion.</font>
                                            </font>
                                        </button>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                                <div class="input-group"> </div>
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
                    <ul class="nav nav-tabs justify-content bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home1" role="tab"
                                aria-controls="home" aria-selected="true">SESION</a>
                        </li>
                        {{-- || ($idRol=="2" ) --}}
                        @if (($idRol=="1" )|| ($idRol=="3" ) )
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab"
                                aria-controls="profile" aria-selected="false">LISTA DE ASISTENCIA</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact1" role="tab"
                                aria-controls="contact" aria-selected="false">TEMAS Y VOTACIONES</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="solicitudportema ">
                                <div class="page-title">
                                    <div id="getTemas" class="">
                                        <label for="slcTema"> Seleccionar un tema</label>
                                        <select class="form-control" id="slcTema" name="slcTema">
                                            <option value="" disabled selected>Seleccionar un Tema</option>
                                        </select>
                                    </div>
                                    <div id="solicitudes" class="solicitudes">

                                        <table id="tblSolicitudPalabra" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Usuario</th>
                                                    <th>Solicitud de palabra</th>
                                                    <th>Estado</th>
                                                    <th>Fecha</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodySolic">


                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="solicitar" class="solicitar ">
                                        <button id="btnSolicitarPalabra" class="btn btn-round btn-danger">
                                            <span style="vertical-align: inherit;">
                                                <span style="vertical-align: inherit;">Solicitar la palabra</span>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="ji" class="title_left">
                                        <h3> <i class="fa fa-video-camera" aria-hidden="true"> En linea </i> <i
                                                class="fa fa-rss" aria-hidden="true"></i></h3>
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
                                        <div class="x_title">
                                            <h2>BIENVENIDOS A LA SESION {{ $client->nombre}} </h2>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <!-- Condiciones que validadn que tipo de pantalla se le muestra al cliente dependiente del rol asignado en la base de datos.-->
                                            @if ($idRol=="1")
                                            <div
                                                style="border: 2px solid # D5CC5A; overflow: hidden; margin: 1px auto; height:100; max-width: 930px; ">
                                                <div id="meet">
                                                </div>
                                            </div>

                                            @elseif ($idRol=="3")
                                            <div
                                                style="border: 2px solid # D5CC5A; overflow: hidden; margin: 1px auto; height:100; max-width: 930px; ">
                                                <div id="meet">
                                                </div>
                                            </div>
                                            @elseif($idRol=="2" )
                                            <div
                                                style="border: 2px solid # D5CC5A; overflow: hidden; margin: 1px auto; height:100; max-width: 930px; ">
                                                <div id="meet">
                                                </div>
                                            </div>
                                            <!--Rol de l usuario administrador-->
                                            @elseif($idRol=="4")
                                            <div id="meet">
                                            </div>

                                            @else
                                            <!--Mensaje de alerta para usuarios no autorizados en la sesesion-->
                                            <script>
                                                window.onload = function () {
                                                    new PNotify({
                                                        title: 'Error.',
                                                        text: 'Lo setimos usted no esta invitado.'
                                                        type: 'error',
                                                        hide: false,
                                                        styling: 'bootstrap3'
                                                    });
                                                };

                                            </script>

                                            @endif
                                            <!--Fin de las conciciones de rol de patalla-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab">


                            <table id="tblSesion" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Asistencia</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodySesion">

                                    @foreach($users as $row)
                                    <tr>
                                        <!-- $row->ftoUser -->
                                        <td><img width="50"
                                                src="{{ asset('gentelella-master/production/images/img.jpg')}}" alt="">
                                            {{ $row->name}}
                                        </td>

                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="{{$row->id}}" name="chkAsistencia"
                                                        class="flat"> Presente
                                                </label>
                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                <h5 id="titleAusentado">Ausentado</h5>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <a id="btnGuardarAsistencia" href="#" title="Guardar asistencias">
                                <button disabled type="button" class="btn btn-round btn-success">
                                    <span style="horizontal-align: inherit;">
                                        <span style="horizontal-align: inherit;">Guardar
                                            Asistencia</span></span></button></a>


                        </div>
                        <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact-tab">
                            <form id="formNuevoTema">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Titulo Tema</label>
                                    <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" required>
                                </div>
                                <input type="hidden" id="sesion" name="sesion" value="{{ $client->id}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 ">Descripcion</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea class="resizable_textarea form-control" id="txtDescripcion"
                                            name="txtDescripcion"
                                            placeholder="Escribir descripcion del tema"></textarea>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" accept="pdf" class="custom-file-input" id="myfile"
                                            name="myfile" required>
                                        <label class="custom-file-label" for="validatedCustomFile">Buscar
                                            archivo...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                </div>
                            </form>

                            <a id="btnGuardarTemaNuevo" title="Nuevo tema">
                                <button type="button" class="btn btn-round btn-success">
                                    <span style="horizontal-align: inherit;">
                                        <span style="horizontal-align: inherit;">Guardar
                                            Tema</span></span></button></a>

                            <table id="tblTemas" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tema</th>
                                        <th>Detalle</th>
                                        <th>Votar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyTema">


                                </tbody>
                            </table>
                            <br><br>
                            <div class="row" id="tblUsuarios">

                            </div>
                        </div>


                    </div>
                    @endif

                    @endforeach
                </div>
            </div>
            <div class="modal fade" id="modalTemas" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Solicitar la palabra</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <select id="slcEst" name="slcEst" class="form-control " required>
                                <option value="" disabled selected>Tipo de solicitud</option>
                                <option value="replica">Replica</option>
                                <option value="general">General</option>
                            </select>
                            <a id="btnActualizarTema" title="Nuevo tema">
                                <button type="button" class="btn btn-round btn-success">
                                    <span style="horizontal-align: inherit;">
                                        <span style="horizontal-align: inherit;">Pedir la palabra
                                        </span></span></button></a>

                        </div>
                    </div>
                </div>
            </div>

            @include('footer')
            <div class="modalKu"></div>
        </div>
    </div>

    @include('script')
    <!-- iCheck -->
    {{-- <script src="../vendors/iCheck/icheck.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $("#btnSolicitarPalabra").click(function () {
                $("#modalTemas").modal("show");
            });
            $("#btnActualizarTema").click(function () {
                $("#modalTemas").modal("hide");
                var idTema = $("#slcTema").val();
                $.post("{{route('postSolicitudPalabra')}}", {
                        estado: $("#slcEst").val(),
                        idTema:idTema
                    })
                    .done(function (data) {
                        var idTema = $("#slcTema").val();
                        getsolicitudesParaHablar(idTema);
                    });


            });
            // .change(function(){

            // });
            $('#tblSesion').DataTable();
            $("#btnGuardarTemaNuevo").click(function (e) {
                var tt = $("#txtTitulo").val();
                var txtDescr = $("#txtDescripcion").val();
                var formData = new FormData(document.getElementById("formNuevoTema"));
                console.log(formData);

                // $.post("{{route('guardarTemaNuevo')}}",(formData))
                console.log($("#formNuevoTema").serialize());
                $.ajax({
                    url: "{{route('guardarTemaNuevo')}}",
                    type: "POST",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function (data) {
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
                        title: 'Tema creado'
                    })
                    getTemas();
                });
            });
            $("#btnGuardarAsistencia").click(function () {
                const usuariosPresentes = [];
                const userAusent = [];
                $("input[name=chkAsistencia]").each(function () {
                    if (this.checked) {
                        usuariosPresentes.push(this.id);
                    } else {
                        userAusent.push(this.id);
                    }
                });
                $.post("{{route('guardarAsist')}}", {
                        usersPresent: usuariosPresentes,
                        userAusent: userAusent,
                        sesion: "{{ $client->id}}"
                    })
                    .done(function () {
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
                            title: 'Lista asistencia guardado'
                        });
                        var elemento = document.getElementById("btnGuardarAsistencia");
                        elemento.className += " invisible";
                    });

            });
            getTemas();

        });

        function getUsuarios(id) {
            $.post("{{route('getUsersConferens')}}", {
                    id: "{{ $client->id}}"
                })
                .done(function (data) {
                    document.getElementById("tblUsuarios").innerHTML = "";
                    var div = $("#tblUsuarios");
                    div.innerHTML = "";
                    $.each(data, function (key, reg) {
                        var votodeusuario = "SIN VOTAR";
                        var disabled = "";
                        if (reg.idVot) {
                            votodeusuario = reg.nombre.toUpperCase();
                            disabled = "disabled";
                        }
                        $("#tblUsuarios").append(' <div class="col-md-55">' +
                            ' <div class="x_content">' +
                            '  <div class="image view view-first">' +
                            '<img style="display: inline;  height: inherit;border-radius: 20%;  " src="{{ asset("gentelella-master/production/images/img.jpg")}}" alt="image">' +
                            ' <div class="mask no-caption">' +
                            ' <div class="tools tools-bottom">' +
                            ' <a href="#"><i class="fa fa-pencil"></i></a>' +
                            ' </div>' +
                            ' </div>' +
                            '</div>' +
                            '<div class="caption">' +
                            ' <p><strong>' + reg.name + '</strong>' +
                            ' </p>' +
                            '     <select class="form-control" ' + disabled + ' id="slcVoto' + reg.id +
                            '" name="slcVoto">' +
                            '            <option value="" disabled selected>Tipo de voto</option>' +
                            '           <option value="1">Positivo</option>' +
                            '           <option value="2">Negativo</option>' +
                            '           <option value="3">Impedido</option>' +
                            '       </select>' +
                            ' <p><strong id="txtVoto' + reg.id + '">VOTO:' + votodeusuario +
                            '</strong>' +
                            ' </p>' +
                            ' </div>' +
                            ' </div>' +
                            ' </div> ' +
                            '</div>');
                        $("#slcVoto" + reg.id).change(function () {
                            $.post("{{route('guardarVoto')}}", {
                                    idUser: reg.id,
                                    idTema: id,
                                    idVoto: this.value
                                })
                                .done(function (data) {
                                    console.log(data);
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        onOpen: (toast) => {
                                            toast.addEventListener('mouseenter',
                                                Swal.stopTimer)
                                            toast.addEventListener('mouseleave',
                                                Swal.resumeTimer)
                                        }
                                    })
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Voto guardado'
                                    });
                                    getUsuarios(id);
                                });
                        });
                    });
                });

        }

        function getTemas() {
            var table = $("#tbodyTema");
            table.innerHTML = "";
            var tableData = "";
            $.post("{{route('getTemas')}}", {
                    sesion: "{{ $client->id}}"
                })
                .done(function (data) {
                    if (!data) {

                        var elemento = document.getElementById("getTemas");
                        elemento.className += " invisible";
                        // $(".getTemas").removeClass("invisible");
                        // $(".solicitudportema").removeClass("invisible");
                        // $(".getTemas").removeAttr("invisible");
                        // $(".solicitudportema").removeAttr("invisible");
                    }
                    $.each(data, function (key, reg) {
                        $("#slcTema").append("<option value='" + reg.id + "'>" + reg.tema + "</option>");
                        if (reg.estado == "convocado") {
                            reg.fechaFinalizado = "N/A";
                        }
                        tableData += '<tr><td>' + reg.tema + '</td><td>' + reg.detalle +
                            '</td>  <td> ' +
                            '   <a href="#tblUsuarios" ' +
                            '       onClick="getUsuarios(' + reg.id + ')"' +
                            '       class="btn btn-outline-success"' +
                            '       title="Editar">' +
                            '       <i class="fa fa-pencil-square-o"' +
                            '           aria-hidden="true">INICIAR VOTACION</i>' +
                            '</td>  <td> ' +
                            '   <a href="#" ' +
                            '       onClick=" modaEditTema(' + reg.id + ')"' +
                            '       class="btn btn-outline-success"' +
                            '       title="Editar">' +
                            '       <i class="fa fa-pencil-square-o"' +
                            '           aria-hidden="true">Editar</i>' +
                            '   </a>' +
                            '   <a href="#" onClick="modaDeleteTema(' + reg.id + ')"' +
                            '   class="btn btn-outline-success"' +
                            '   title="Eliminar">' +
                            '   <i class="fa fa-trash"' +
                            '       aria-hidden="true">Eliminar</i>' +
                            '</a>' +
                            ' </td></tr> ';
                    });

                    table.html(tableData);
                    $('#tblTemas').DataTable();
                    $("#slcTema").change(function () {
                        //       var table = $("#tbodySolic");
                        // table.innerHTML = "";
                        getsolicitudesParaHablar(this.value);
                    });
                });
        }

        function avisoSesion() {
            new PNotify({
                title: "Aviso Importante",
                text: " Lo sentimos la reunion ya fue desarrollada. ",
                styling: "bootstrap3"
            });
        }

        function eliminarSolicitud() {

        }

        function getsolicitudesParaHablar(idTema) {
            $.post("{{route('getSolicitudesPalabra')}}", {
                    idTema: idTema
                })
                .done(function (data) {
                    if (Array.isArray(data) && data.length) {
                        $("#solicitudes").removeClass("invisible");
                        // $("#btnSolicitarPalabra").attr("disabled", true);
                    } else {

                        var elemento = document.getElementById("solicitudes");
                        elemento.className += " invisible";
                    }
                    // $(".solicitudesParaHablar").addClass("invisible");
                    // $(".solicitudesParaHablar").attr("invisible");
                    //                 }else{

                    //             $(".solicitudesParaHablar").removeClass("invisible");
                    //             $(".solicitudesParaHablar").removeAttr("invisible");
                    //                 }

                    var table = $("#tbodySolic");
                    table.innerHTML = "";

                    document.getElementById("tbodySolic").innerHTML = "";
                    // document.getElementById("tblSolicitudPalabra").innerHTML="";
                    var tableData;
                    console.log(data);
                    if (data) {
                        var idUserEnCasa = 0;
                        $.each(data, function (key, reg) {
                            if (reg.idUser == "{{Auth::user()->id}}") {
                                $("#btnSolicitarPalabra").attr("disabled", true);
                                idUserEnCasa = 1;
                            }
                            var invisibleButton = ' <a href="#" onClick="eliminarSolicitud(' + reg.id +
                                ',' + this.value + ')"' +
                                '   class="btn btn-outline-success"' +
                                '   title="Eliminar">' +
                                '   <i class="fa fa-trash"' +
                                '       aria-hidden="true">Eliminar solicitud</i>' +
                                '</a>';
                            // ($idRol == 2)||
                            var idRol = "{{Auth::user()->idRol}}";
                            if ((idRol == "1") || (idRol == "3")) {
                                invisibleButton =
                                    ' <a href="#" onClick="aprobarSolicitud(' + reg.id + ',' + this.value +
                                    ')"' +
                                    '   class="btn btn-outline-success"' +
                                    '   title="Eliminar">' +
                                    '   <i class="glyphicon glyphicon-ok"' +
                                    '       aria-hidden="true">Aprobar solicitud</i>' +
                                    '</a>';
                            }
                            tableData += '<tr><td>' + reg.puesto + '</td><td>' + reg.name +
                                '</td> <td>' + reg.tipo + '</td><td>' + reg.estado + '</td><td>' + reg
                                .fecha +
                                '  <td> ' + invisibleButton +
                                ' </td></tr> ';
                        });
                        table.html(tableData);
                        $('#tblSolicitudPalabra').DataTable();
                    }
                    if (idUserEnCasa == 0) {

                        $("#btnSolicitarPalabra").attr("disabled", false);
                    }
                });
        }

        function aprobarSolicitud(id, idTema) {
            $.post("{{route('aprobarSolicitud')}}", {
                    idUser: id,
                    idTema: idTema
                })
                .done(function (data) {
                    getsolicitudesParaHablar(idTema);
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
                        title: 'Solicitud Aprobada'
                    });
                });
        }

        function modaEditTema(id) {
            $.post("{{route('getEditTema')}}", {
                    id: id
                })
                .done(function (response) {
                    $('.modalKu').html(response);
                    $('#modalEditSesiones').modal('show');
                });
            // $.post("{{route('guardarTemaNuevo')}}", { tt: tt , sesion: "{{ $client->id}}" , txtDescripcion: txtDescr })
            //         })
            //         .done(function () {
            //              $('#modalTemas').modal('show');
            //             const Toast = Swal.mixin({
            //                 toast: true,
            //                 position: 'top-end',
            //                 showConfirmButton: false,
            //                 timer: 3000,
            //                 timerProgressBar: true,
            //                 onOpen: (toast) => {
            //                     toast.addEventListener('mouseenter', Swal.stopTimer)
            //                     toast.addEventListener('mouseleave', Swal.resumeTimer)
            //                 }
            //             })
            //             Toast.fire({
            //                 icon: 'success',
            //                 title: 'Tema actualizado'
            //             });
            //         });
        }

        function modaDeleteTema(id) {
            $.post("{{route('deleteTema')}}", {
                    id: id
                })
                .done(function () {
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
                        title: 'Tema eliminado'
                    });
                    getTemas();
                });
        }

        function modalSubirTrigger(id) {
            event.preventDefault();
            $.ajax({
                url: "{{url('invitar_externos')}}",
                method: 'POST',
                data: {
                    'id': id
                },
                success: function (response) {
                    // console.log(response);
                    $('.modalKu').html(response);
                    $('#exampleModalCenter').modal('show');
                }
            });
        }

    </script>
</body>


</html>

<?php
}
?>
