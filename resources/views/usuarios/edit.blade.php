<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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

                <form id="frmActUser" >
                    <input type="hidden" value="" id="idUser" name="idUser" required>
                    <div class="form-group">
                        <label for="slcRoles">Rol:</label>
                        <select id="slcRoles" name="slcRoles" class="form-control " required>
                            <option value="">Seleccionar Rol</option>
                            @foreach ($roles as $data)
                                <option value="{{ $data->id }}">{{ $data->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="slcEst">Estado:</label>
                        <select id="slcEst" name="slcEst"  class="form-control " required>
                            <option value="" disabled selected>Seleccionar Estado</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtNombre">Nombre</label>
                        <input type="text" class="form-control" name="txtNombre" id="txtNombre" value=" " required>
                    </div>
                    <div class="form-group">
                        <label for="txtCorreo">Correo</label>
                        <input type="text" class="form-control" name="txtCorreo" id="txtCorreo" value=" " required>
                    </div>
                    <div class="modal-footer center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSubmit" class="btn btn-primary">Actualizar</button>
                    </div>
            </div>


            </form>


        </div>
    </div>
</div>
</div>
