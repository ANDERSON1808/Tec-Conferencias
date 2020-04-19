<!-- MODAL DELETE -->
<div class="modal" id="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    <form class="formsiswa" action="{{route('do_delete_bodega',$bodega->id)}}" method="post">
      <div class="modal-content">
  
        <div class="modal-body">
        <div class="alert alert-danger alert-dismissible">
               
                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                <input type="hidden" name="nis" value="">
               <p>¿Estás seguro de que deseas eliminar la Bodega {{$bodega->nombre}} ?</p>
              </div>
   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"></i></button>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
          <input type="hidden" name="deletedata" value="{{$bodega->id}}">
        </div>
      </div><!-- /.modal-content -->
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->
<script type="text/javascript">
 $.ajaxSetup({
  headers: {
   'X-CSRF-TOKEN': $('input[name="_token"]').val()
  }
 });
</script>
