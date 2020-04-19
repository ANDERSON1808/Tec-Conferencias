
<!-- MODAL DELETE -->
<div class="modal" id="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    <form class="formsiswa" action="{{route('do_delete',$categorias->id)}}" method="post">
      <div class="modal-content">
  
        <div class="modal-body">
        <div class="alert alert-danger alert-dismissible">
               
                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                <input type="hidden" name="nis" value="">
               <p>¿Estás seguro de que deseas eliminar la categoria {{$categorias->nombre}} ?</p>
              </div>
   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"></i></button>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
          <input type="hidden" name="deletedata" value="{{$categorias->id}}">
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
// ajax untuk delete data
function deleteData(id){
      $.ajax({
        url     : "",
        method  : 'POST',
        data    : {
          'id' : id
        },
        beforeSend: function(objeto){
                $("#result2").html('<img src="lon2.gif" height ="60" width="100"> Cargando...');
              },
        success : function(response){
   
        }
      });
}
// function deleteData(id_delete){
//       $.ajax({
//         url     : "{{url('do_delete')}}",
//         method  : 'POST',
//         data    : {
//           'id_delete' : id_delete
//         },
//         success : function(response){
//           // console.log(response);
//           if (response.status == 'error'){
//             alert('Delete Error');
//           }else{
//             alert('Delete Success!!');
//           }
//         }
//       });
//     }
</script>
