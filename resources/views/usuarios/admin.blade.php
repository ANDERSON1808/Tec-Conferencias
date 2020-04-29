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
                            <h3>USUARIOS</h3>
                            <p> Crear y modificar datos de usuarios</p>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                                <div class="input-group">
                                    <a href="#" onclick="crearUsuario()" class="modalSubirTrigger" data-toggle="modal"
                                        data-target="#exampleModalL"><button class="btn btn-info"><i class="fa fa-plus"
                                                aria-hidden="true"> Nuevo Usuario</i></button></a>
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


                                                <table id="tblUsers"
                                                    class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>tipo Rol</th>
                                                            <th>Nombre</th>
                                                            <th>Correo</th>
                                                            <th>Estado</th>
                                                            <th>Fecha Creado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyUsers">
                                                        @php
                                                        @endphp

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
     <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            verUsuarios();


            $.ajax({
                url: "{{route('getRoles')}}",
                method: 'GET',
                success: function (data) {
                    // $("#slcRoles").append('<option>city1</option>');


                    // $("#slcRoles").append("<option value=''>Roles..</option>");
                    // // $('#slcRoles').formSelect();
                    // // $('#slcRoles').formSelect();
                    // $('#slcRoles').selectpicker();
                    // $.each(data, function (key, reg) {
                    //     $("#slcRoles").append("<option value=" + reg.id + ">" + reg.nombre +   "</option>");
                    // $("#slcRoles").dropdown();
                    // });
                }
            });
        });
        function verUsuarios(){
            $.ajax({
                url: "getUsers",
                method: 'GET',
                success: function (data) {
                    var table =  $("#tbodyUsers");
                    table.innerHTML = "";
                    var tableData  ;
                    $.each(data,function(key, reg) {
                        tableData +=  '<tr><td>'+reg.nombre+'</td><td>'+ reg.name+'</td> </td> '+
                            ' <td>'+reg.email +'</td><td>'+ reg.estado+'</td> </td> '+'</td><td>'+ reg.created_at+'</td> </td> '+
                        ' <td>'+
                        '   <a href="#" '+
                        '       onClick="modalEdit('+reg.id+','+reg.idRol+',"'+reg.estado+'","'+reg.email+'" ,"'+reg.name+'" )"'+
                        '      '+
                        '       title="Iniciar conferencia">'+
                        '       <i class="fa fa-pencil-square-o"'+
                        '           aria-hidden="true">Editar</i>'+
                        '   </a>'+
                        '   <a href="#" onClick="AlertDelete('+reg.id+')"'+
                            ' '+
                            '   title="Iniciar conferencia">'+
                            '   <i class="fa fa-trash"'+
                            '       aria-hidden="true">Eliminar</i>'+
                            '</a>'+
                        '</button></td></tr> ';
                     });

                    table.html(tableData);
                    $('#tblUsers').DataTable();
                }
            });
        }
        // carga masiva
        // $('.modalSubirTrigger').click(function (event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: "{{url('crear_conferencia')}}",
        //         method: 'POST',
        //         success: function (response) {
        //             $('.modalKu').html(response);
        //             $('#exampleModalCenter').modal('show');
        //         }
        //     });
        // });
        function crearUsuario(){
            $.ajax({
                url: "user_crear",
                method: 'GET',
                success: function (response) {
                    // console.log(response);
                    $('.modalKu').html(response);
                    $('#myModal').modal('show');
                    $("#frmUser").submit(function(e){
                        e.preventDefault();
                        data = $("#frmUser").serialize();
                        $.ajax({
                            url: "createUser",
                            method: 'POST',
                            data:  data ,
                            success: function (data) {
                                if (!data){
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
                                    title: 'Nuevo usuario registrado'
                                    })
                                }else{

                                }
                            }
                        });
                    });
                }
            });
        }
        //modal_edit.
        function modalEdit(id,idRol, estado, email, name) {
            // var idEst =2;
            // if(estado="activo"){
            //    idEst =1;
            // }
            $.ajax({
                url: "{{route('user_ver')}}",
                method: 'GET',
                success: function (response) {
                    // console.log(response);
                    $('.modalKu').html(response);
                    $('#myModal').modal('show');
                    $("#idUser").val(id);
                    $("#txtNombre").val(name);
                    $("#txtCorreo").val(email);
                    $("#slcRoles").val(idRol);
                    $("#slcEst").val(estado);
                    $("#btnSubmit").on('click',function(e){
                data = $("#frmActUser").serialize();
                $.ajax({
                    url: "updateUser",
                    method: 'POST',
                    data:  data ,
                    success: function (data) {
                        console.log(data);
                    }
                });

                e.preventDefault();
            });
                }
            });
        }
        // MODAL DELETE
        function AlertDelete(id) {
            Swal.fire({
                title: 'Eliminar usuario seleccionado',
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
                        'El usuario a sido eliminado correctamente',
                        'success'
                        ).then((result) => {

                        $.ajax({
                            url: "{{url('/delete_user')}}",
                            method: 'POST',
                            data: {
                                'id': id
                            },
                            success: function (response) {
                                verUsuarios();
                            }
                        });

                    })
                    }
                    })
            // }else{
            //   alert('Delete Canceled!');
            // }
        }

    </script>
</body>


</html>

<?php
}
?>
