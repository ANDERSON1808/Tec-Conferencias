$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function () { 
    $("#btnGuardarTemaNuevo").click(function (e) { 
       var tt =   $("#txtTitulo").val();
       var txtDescr =   $("#txtDescripcion").val();
    //    {{route('guardarTemaNuevo')}}
        $.post("guardarTemaNuevo", { tt: tt , sesion: "{{ $client->id}}" , txtDescripcion: txtDescr })
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
        // {{route('guardarAsist')}}
        $.post("guardarAsist", { usersPresent: usuariosPresentes, userAusent: userAusent,   sesion: "{{ $client->id}}"
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
function getTemas(){
    // 
$.post("getTemas", { sesion: "{{ $client->id}}" })
    .done( function (data) {
        console.log(data);
        var table = $("#tbodyTemas");
        table.innerHTML = "";
        var tableData;
        $.each(data, function (key, reg) {
            if (reg.estado = "convocado") {
                reg.fechaFinalizado = "N/A";
            }
            // '+reg.id+'
            tableData += '<tr><td>' + reg.tema + '</td><td>' + reg.detalle +
                '</td>  <td> ' +
                '<div class="checkbox">' +
                ' <label>' +
                '<input type="checkbox" class="flat"> Positivo' +
                ' </label>' +
                ' </div>' +  
                '<div class="checkbox">' +
                ' <label>' +
                '<input type="checkbox"    class="flat"> Negativo' +
                ' </label>' +
                ' </div>' + '<div class="checkbox">' +
                ' <label>' +
                '<input type="checkbox"   class="flat"> Impedido' +
                ' </label>' +
                ' </div>' +
              '  <a onClick="modalTemas({{$client->idUser}})" title="Editar"> <button type="button"'+
                                    'class="btn btn-round btn-success"><span'+
                                        'style="horizontal-align: inherit;"><span'+
                                           ' style="horizontal-align: inherit;">LLamar asistencia'+
                                           '  </span></span></button></a>'+
                ' </td></tr> ';
        });
        table.html(tableData);
        $('#tblTemas').DataTable();
    });
}
// carga masiva
function modalTemas(id) {
    $('#modalTemas').modal('show');
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