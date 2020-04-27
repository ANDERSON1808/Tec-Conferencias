<div class="modal fade" id="modalEditSesiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmSesionUpdate">
                    @foreach($sesiones as $val)
                    @php   
                    $val->fechaSesion = date("Y-m-d", strtotime($val->fechaSesion));
                   
                    @endphp
                    <input type="hidden" value="{{ $val->id}}" id="idTema" name="idTema"> <!--  -->
                    <div class="form-group">
                        <label for="txtNombre">Tipo Sesión</label>
                        <select value="{{ $val->tipoSesion}}" class="form-control" id="slcSesion" name="slcSesion">
                            <option value="" disabled >Seleccione una sesion</option>
                            <option value="general">general</option>
                            <option value="comisiones">comision</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="txtNombre">Nombre</label>

                        <input value="{{ $val->nombre}}" type="text" class="form-control" name="txtNombre" id="txtNombre" value=" " required>
                    </div>
                    <div class="form-group">
                        <label for="txtDesc">Descripcion</label>
                        <input value="{{ $val->descripcion}}" type="text" class="form-control" name="txtDesc" id="txtDesc" value=" " required>
                    </div>
                    <div class="form-group">
                        <label for="txtDesc">Fecha</label>
                        <input value="{{ $val->fechaSesion}}" type="date" class="form-control" id="dtFechaAct" min="2019-09-01" name="txtfechainicio">


                    </div>
            </div>
            @endforeach
            </form>  
            <a id="btnActualizarSesion" title="Nuevo tema">
                <button type="button" class="btn btn-round btn-success">
                    <span style="horizontal-align: inherit;">
                        <span style="horizontal-align: inherit;">Actualizar
                            Sesion</span></span></button></a>

        </div>
    </div>
</div> 
