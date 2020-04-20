

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nueva Conferencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

    <form  action="{{ route('editar_conferencia', $conferencia->id) }}" method="post"   enctype="multipart/form-data">
                 
                  <div class="form-group">
                        <label for="exampleFormControlInput1">Nombre Conferencia</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $conferencia->nombre}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea class="form-control" name="descripcion" id="descripcion"   rows="3" required>{{ $conferencia->descripcion}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Fecha de la conferencia</label>
                        <input type="date" value="{{ $conferencia->fecha_r}}" class="form-control" name="date" id="date"  required>
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

