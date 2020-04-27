<div class="modal fade" id="modalTemas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
@foreach($temas as $val)
            <form>
                <input type="hidden" value="{{ $val->id}}" id="idTema">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Titulo Tema</label>
                                    <input value="{{ $val->tema}}" type="text" class="form-control" name="txtTitulo" id="txtTitulo" required>
                                </div>
                                 
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 ">Descripcion</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea value="{{ $val->detalle}}" class="resizable_textarea form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Escribir descripcion del tema"></textarea>
                                </div>
                            </div> 
                            </form>
                            @endforeach
                            <a id="btnActualizarTema" title="Nuevo tema">
                                    <button  type="button" class="btn btn-round btn-success">
                                        <span style="horizontal-align: inherit;">
                                            <span style="horizontal-align: inherit;">Actualizar
                                                Tema</span></span></button></a>

        </div>
    </div>
</div>
</div>
