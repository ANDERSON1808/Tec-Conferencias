<div class="modal fade" id="createTema" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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

                <form id="formNuevoTema">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Titulo Tema</label>
                        <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" required>
                    </div>
                    <input type="hidden" id="sesion" name="sesion" value="">
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
                            <label class="custom-file-label" for="myfile" id="txtImage">Buscar
                                archivo...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <div class="modal-footer center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSubmit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>



        </div>
    </div>
</div>
</div>
