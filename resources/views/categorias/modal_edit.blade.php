<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

    <form  action="{{ route('editar',$categorias->id) }}" method="post"   enctype="multipart/form-data">
   
                   
                  <div class="form-group">
                        <label for="exampleFormControlInput1">Categoria</label>
                        <input type="hidden"value="{{ $categorias->id}}" name="id" >
                        <input type="text" class="form-control" value="{{ $categorias->nombre}}" name="nombre" id="nombre" placeholder="nombre de la categoria" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required>{{ $categorias->descripcion}}</textarea>
                    </div>
                   
                    <div class="form-group">
                                <div id="msg"></div>
                                
                                    <input type="file"  name="file" class="file" accept="image/*" required>
                                    <div class="input-group my-3">
                                    <input type="text" class="form-control" value="{{ $categorias->imagen}}" disabled placeholder="Subir imagen" id="file">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse...</button>
                                    </div>
                                    </div>

                                </div>
                                <div class="ml-12 col-sm-12">
                                <img src="{{ asset('/img/'. $categorias->imagen) }}" id="preview" class="img-thumbnail">
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


<style type="text/css">
                                .file {
                                visibility: hidden;
                                position: absolute;
                                }
</style>
 <script type="text/javascript">
                                $(document).on("click", ".browse", function() {
                                var file = $(this).parents().find(".file");
                                file.trigger("click");
                                });
                                $('input[type="file"]').change(function(e) {
                                var fileName = e.target.files[0].name;
                                $("#file").val(fileName);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    // get loaded data and render thumbnail.
                                    document.getElementById("preview").src = e.target.result;
                                };
                                // read the image file as a data URL.
                                reader.readAsDataURL(this.files[0]);
                                });
</script>