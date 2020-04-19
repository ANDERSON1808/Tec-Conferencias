<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Lista Precios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

    <form  action="{{ route('editar_lista_precioP',$lista_precio->id) }}" method="post"   enctype="multipart/form-data">
                 
                  <div class="col-md-12 col-sm-12 form-group">
                        <label for="exampleFormControlInput1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $lista_precio->nombre}}" id="nombre" required>
                    </div>

@php
$tipo =  $lista_precio->tipo;
@endphp
                    
                    <div align="center" class="form-group">
                        <label for="exampleFormControlInput1">Seleccione el tipo</label>
                    </div>
                    @if ($tipo == 2)
                    <div align="center" class="col-md-6 col-sm-12 form-group"> 
                    <label for="exampleFormControlInput1"> Valor</label>
                    <input disabled  checked="checked" name="tipo" type="radio" value="2"/>
                    </div>

                    <div align="center" class="col-md-6 col-sm-12 form-group"> 
                    <label for="exampleFormControlInput1">  Porcentaje</label>
                    <input disabled  name="tipo" type="radio" value="1"/>
                    </div>

                    @elseif ($tipo == 1) 
                    <div align="center" class="col-md-6 col-sm-12 form-group"> 
                    <label for="exampleFormControlInput1"> Valor</label>
                    <input disabled  name="tipo" type="radio" value="2"/>
                    </div>

                    <div align="center" class="col-md-6 col-sm-12 form-group"> 
                    <label for="exampleFormControlInput1">  Porcentaje</label>
                    <input disabled checked="checked" name="tipo" type="radio" value="1"/>
                    </div>
                    <div id="div1" class="form-group">
                    <label for="exampleFormControlInput1">( % ) Porcentaje</label>
                    <input  disabled type="number" min="0" class="form-control" value="{{ $lista_precio->porcentaje}}" name="porcentaje" id="porcentaje" >
                    </div>
                    @endif

                    
        

                   

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

<script>

                    $(document).ready(function() {
                            $("input[type=radio]").click(function(event){
                                var valor = $(event.target).val();
                                if(valor =="1"){
                                    $("#div1").show();
                                   
                                } else if (valor == "2") {
                                    $("#div1").hide();
                                  
                                } else { 
                                    // Otra cosa
                                }
                            });
                        });
</script>