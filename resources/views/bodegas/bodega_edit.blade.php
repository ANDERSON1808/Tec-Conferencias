<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nueva Bodega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

    <form  action="{{ route('editar_bodega',$bodega->id) }}" method="post"   enctype="multipart/form-data">
                 
                  <div class="form-group">
                        <label for="exampleFormControlInput1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $bodega->nombre}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Direccion</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $bodega->direccion}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Observaciones</label>
                        <textarea class="form-control" name="observaciones" id="observaciones" rows="3" required>{{ $bodega->observaciones}}</textarea>
                    </div>
                   

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
      </div>

     
</form>
    </div>
  </div>
</div>
</div>
