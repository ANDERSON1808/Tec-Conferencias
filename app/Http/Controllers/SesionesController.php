<?php

namespace App\Http\Controllers;

use App\sesiones;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class SesionesController extends Controller
{

    public function terminarSesion(Request $request)
    {
            $id =      $request ->get('id');

            if (!isset($id))
            {
               return back()->with('error', 'No cuenta con id');

            } else {
               DB::table('sesiones')
               ->where('id',  $id)
               ->update(['estado' =>  "finalizado"]);

               DB::table('invitadosesion')
               ->where('idSesion',  $id)
               ->update(['estado' =>  "finalizado"]);

               $consultaG = DB::table('sesiones')
               ->get();
              return view('/sesiones/online' ,array('sesiones'=> $consultaG ));

         }
       }


       public function invitarInterno(Request $req)
       {
           $Rsesion =      $req ->get('slcSesion');
           $Rusuario     =      $req ->get('usuario');
           $estado = "convocado";
           $rol= 1;

             if (empty( $Rusuario)){
               return back()->with('error', 'Upss algo salio mal');
             }else{

               foreach( $Rusuario as $key => $val){

                   $data = array(
                       "idSesion" => $Rsesion,
                        "idUser" =>  $val,
                        "estado" => $estado
                   );
                   DB::table("invitadosesion")->insert( $data);
             }
             return back()->with('message', 'Excelente, Fueron enviadas las invitaciones a la conferencia.');
               }

}

    public function inviteUserSesion(Request $request)
    {
        $sesiones = DB::table('sesiones')
        ->where('estado', '=', "convocado")
        ->get();

        $users = DB::table('users')
        ->get();

        return view('/sesiones/invitar_interno', array(
            'sesiones' => $sesiones,
            'users' => $users,
        ));
    }


    public function getAsistencia(){
        return  DB::table('users')
        ->join("roles", "roles.id","users.idRol")
        ->where('roles.nombre', '=', "concejal")
        ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {


        $rolUser = DB::table('users')
        ->join("roles", "roles.id","users.idRol")
        ->where('users.id', '=', Auth::user()->id)
        ->select("roles.nombre")
        ->get();

        return view("sesiones/admin",array("idRol"=> $rolUser)) ;
    }
    public function viewParticipacion()
    {
        return view("sesiones/participar");
    }
    public function getInvitadoSesion(Request $req)
    {
        $users = DB::table('users')
        ->select("users.id","users.name")
        ->get();

        $invitadosSesion =   DB::table('invitadosesion')->where("idSesion",$req->idSesion)->get() ;
         return array("users"=>  $users, "invitadosSesion" =>  $invitadosSesion );
    }

    public function onlineSesionControl(Request $req, $id){

    if (empty(  $id))
    {
                return back()->with('error', 'Upss error grave, comuniquese con el proveedor del programa.');
    }else{
        $sesiones = DB::table('sesiones')
        ->where('id', '=', "  $id")
        ->get();

        $notificacion = DB::table('invitadosesion')
            ->where('estado', '=', "convocado")
            ->get();

            $iniciar =1;
            DB::table('sesiones')
                        ->where('id',    $id)
                        ->update(['indicadorInicio' => "activo"]);

                        $users = DB::table('users')
                        ->join("roles", "roles.id","users.idRol")
                        ->leftJoin("lista_asistencia", "lista_asistencia.idUser","users.id")
                        ->select(
                            "users.id","users.name","users.ftoUser", "users.email","users.created_at",
                            "lista_asistencia.estado","roles.nombre")
                        ->where( 'roles.nombre', '=', "concejal")
                        ->groupBy('users.id')
                        ->get();
                        // $idUser = Auth::user()->id;
                        // return redirect()->route('sesionesonline',  array(
                        //     'notificacion' => $notificacion,
                        //     'conferencia' => $sesiones,
                        //     'users' => $users,
            return view('/sesiones/online', array(
            'notificacion' => $notificacion,
            'conferencia' => $sesiones,
            'users' => $users,
            ));

    }
}
    public function online(Request $request, $id)
    {
        if (empty( $id))
    {
        return back()->with('error', 'Upss error grave, comuniquese con el proveedor del programa.');
    }else{
        $sesiones = DB::table('sesiones')
        ->where('id', '=', "$id")
        ->get();

        $notificacion = DB::table('invitadosesion')
            ->where([
                ["estado","presente"],
                ['idSesion', $id],
            ])
            ->get();

            $iniciar =1;
            DB::table('sesiones')
                        ->where('id',  $id)
                        ->update(['indicadorInicio' => "activo"]);

                        $users = DB::table('users')
                        ->join("roles", "roles.id","users.idRol")
                        ->where('roles.nombre', '=', "concejal")
                        ->select("users.*")
                        ->get();

                        // return view('/sesiones/online/',  array(
                        //     'notificacion' => $notificacion,
                        //     'conferencia' => $sesiones,
                        //     'users' => $users,
                        //     ));
            return view('/sesiones/online', array(
            'notificacion' => $notificacion,
            'conferencia' => $sesiones,
            'users' => $users,
            ));

    }
}
    public function deleteSesionpost(Request $req){
        return DB::table('sesiones')->where("id",$req->id)->delete();
    }
    public function editSesionPost(Request $req){
        $data = array(
            "nombre" => $req->txtNombre,
            "descripcion" => $req->txtDesc,
            "fechaSesion" => $req->txtfechainicio,
            "tipoSesion" => $req->slcSesion,
            "estado" => "convocado",
            "linkSesion" => "https//webcomcel.com.co",
            "token" => "adc87hah12iue218as9jdja9d89",
            "fechaFinalizado" => $req->txtfechainicio
        );
        DB::table('sesiones')->where("id",$req->idTema)->update($data);
        return $req;
    }
    public function getEditSesion(Request $req){

        $sesiones = DB::table('sesiones')->where("id",$req->id)->get();

        return view("/sesiones/editSesion" , array( "sesiones" => $sesiones));

    }
    public function getEditTema(Request $req){

  $temas = DB::table('temas')->where(  "id",$req->id)->get();
  return view("/sesiones/editTema" , array( "temas" => $temas));

     }
     //CREAR TEMAS
    public function createTema(Request $req){
        if($req->file('myfile')){
            try{
                    $destinationPath = public_path('/documentos_temas/'.$req->txtTitulo);
                    $archivoNombre = $req->txtTitulo."_" . date('Y-m-d') . ".pdf";
                    $archivo = $req->file('myfile');
                    $archivo->move($destinationPath, $archivoNombre);
                    $destgeneralimgequipo =  $req->txtTitulo."/".$archivoNombre;
                    $data = array(
                        "tema" =>$req->txtTitulo,
                        "detalle" =>$req->txtDescripcion,
                        "idSesion" =>$req->sesion,
                        "linkPdf" =>$destgeneralimgequipo
                    );
                        DB::table('temas')->insert($data);
                        return "sas";
            }catch(QueryException $ex){
                return dd($ex);
            }
        }else{
            $data = array(
                "tema" =>$req->txtTitulo,
                "detalle" =>$req->txtDescripcion,
                "idSesion" =>$req->sesion,
                "linkPdf" =>""
            );
            DB::table('temas')
            ->insert( $data);
            return " tema" ;
        }

 }
          //FIN DE CREAR UN NUEVO TEMA
          //EDITAR TEMA
public function editTema(Request $req){
        if($req->file('myfileEdit')){
            try{
                $destinationPath = public_path('/documentos_temas/' . $req->txtTituloEdit  );
                $archivoNombre = $req->txtTituloEdit."_" . date('Y-m-d') . ".pdf";
                $archivo = $req->file('myfileEdit');
                $archivo->move($destinationPath, $archivoNombre);
                $destgeneralimgequipo =  $req->txtTituloEdit."/".$archivoNombre;
                $data = array(
                    "tema" =>$req->txtTituloEdit,
                    "detalle" =>$req->txtDescripcionEdit,
                    "linkPdf" =>$destgeneralimgequipo,
                );
                DB::table('temas')->where('id',$req->id)->update($data);
                return "actualizado tema";
            }catch(QueryException $ex){
                return dd($ex);
            }
        }else{
            $data = array(
                "tema" =>  $req->txtTituloEdit,
                "detalle" =>$req->txtDescripcionEdit,
            );
            DB::table('temas')
            ->where('id', $req->id)
            ->update( $data);
            return "actualizado tema" ;
        }

 }
 // FIN UPDATE TEMA
 public function deleteTema(Request $req){
        return DB::select('call tema_delete(?)',array(  $req->id ));
 }
public function getTemas(Request $req){
    $temas = DB::table('temas')
   ->where(  "idSesion",$req->sesion)->get();
return $temas;
//    $votos = DB::table('temas')
//    ->join("votacion","votacion.idTema","=","temas.id")
//    ->where("temas.idSesion",$req->sesion)
//    ->select("temas.*", DB::raw("COUNT(votacion.id) as count"))
//    ->groupBy('votacion.id')
//    ->get();

//    return array("temas"=>$temas,"votos"=>$votos);
}

    public function aprobarSolicitud(Request $req){
        $data = array(
            'estado' =>  "aprobado",
            'puesto'=>'0'
        );
        $update = DB::table('solicitudpalabra')->where( "id",$req->idSolicitud )->update( $data);
        $contador = 0;
        foreach($req->userEnEspera as $val){
            if($val!=$req->idSolicitud){
                $contador++;
                 DB::table('solicitudpalabra')->where( "id",$val)->update(['puesto' =>$contador]);
                 DB::table('solicitudpalabra')->where( [["id",$val],["estado","aprobado"]])->update(['estado' =>"finalizado"]);
            }
        }

       return $contador;
    }
    public function getSolicitudesPalabra(Request $req){
        return DB::table('solicitudpalabra')
               ->join("users","users.id","solicitudpalabra.idUser")
               ->join("roles", "roles.id","users.idRol")
               ->where([
                ['solicitudpalabra.idTema',$req->idTema],
            ])->select("users.id","users.name","roles.nombre","solicitudpalabra.*")
        ->get();
    }
    public function postSolicitudPalabra(Request $req){
        try{

        $idUser = Auth::user()->id;
        $ultimopuesto = DB::table('solicitudpalabra')
        ->where([
         ["idTema",$req->idTema],
         ['estado',"denegado"],
     ])
            ->orderByDesc('puesto')
            ->limit(1)
            ->select("solicitudpalabra.*")
        ->get();
        $puesto = 0;
        if($ultimopuesto){
            json_encode($ultimopuesto);

                foreach($ultimopuesto as $obj ){
                    $puesto =  $obj->puesto;
                    $id = $obj->id;
            }

        }

 $data = array(
    "idUser"=>$idUser,
    "idTema"=>$req->idTema,
    "estado"=>"denegado",
    "tipo"=>$req->estado,
    "puesto"=>$puesto+1,
);
 DB::table('solicitudpalabra')->insert(  $data  );


         return "todobien";
       }   catch(QueryException $ex){
             dd($ex);
         }
    }

    public function guardarVoto(Request $req){

        $data = array(
            "idUser"=>$req->idUser,
            "idSesion"=>$req->idSesion,
            "idTema"=>$req->idTema,
            "idVoto"=>$req->idVoto
        );
       return DB::table('votacion')->insert($data);

    }
    public function UserInConferencia(Request $req){
        return DB::select('SELECT users.id as us, users.email , users.name , lista_asistencia.id as asis, lista_asistencia.idUser,'.
         ' lista_asistencia.tipoAsistencia, lista_asistencia.estado, lista_asistencia.idSesion as sesionli,'.
          ' votacion.idSesion as sesionvot, votacion.idVoto as idVot , tipovotacion.nombre,  temas.tema, temas.id as tema FROM users '.
          ' INNER JOIN lista_asistencia ON lista_asistencia.idUser = users.id LEFT JOIN votacion ON votacion.idUser = users.id'.
         ' LEFT JOIN tipovotacion ON tipovotacion.id=votacion.idVoto  LEFT JOIN temas ON temas.id = votacion.idTema'.
         '  WHERE lista_asistencia.idSesion="'.$req->idSesion.'"  AND(temas.id="'.$req->idTema.'" || temas.id IS NULL)');

    }
    public function createAsistencia(Request $req)
    {
        try{
            $userPresent =      $req ->get('usersPresent');
            $usersAusent =      $req ->get('userAusent');
            if($userPresent){
                foreach($userPresent as  $val ){
                    $data = array(
                        "idUser" => $val,
                        "idSesion" => $req->sesion,
                        "tipoAsistencia" => "general",
                        "estado" =>"presente",
                    );
                    DB::table('lista_asistencia')->insert($data);
                }
            }
            if($usersAusent){
                foreach($usersAusent as  $val  ){
                    $data = array(
                        "idUser" =>$val,
                        "idSesion" => $req->sesion,
                        "tipoAsistencia" => "general",
                        "estado" => "ausente"
                    );
                    DB::table('lista_asistencia')->insert($data);
                }
            }
        }catch(QueryException $ex){
            dd($ex->getMessage());
        }
    }
    public function actualizarAsist(Request $req)
    {
        $userPresent =      $req ->get('usersPresent');
        $usersAusent =      $req ->get('userAusent');
        if($userPresent){

            foreach(  $userPresent as  $val ){
                $data = array(
                    "idUser" => $val,
                    "idSesion" => $req->sesion,
                    "tipoAsistencia" => "general",
                    "estado" =>"presente",
                );
                DB::table('lista_asistencia')->update($data);
            }
        }
        if($usersAusent){

            foreach($usersAusent as  $val  ){
                $data = array(
                    "idUser" =>$val,
                    "idSesion" => $req->sesion,
                    "tipoAsistencia" => "general",
                    "estado" => "ausente"
                );
                DB::table('lista_asistencia')->update($data);
            }
        }
        return "llamado a lista" ;
    }

    public function get( )
    {
        // $usuario_encasa = Auth::user()->id;
        return DB::table('sesiones')
                ->join("users", "users.id", '=', "sesiones.idUser")
                // ->where("idUser",$usuario_encasa)
                ->select('sesiones.*', 'users.name' )
                ->get();
    }
    public function getInvited(Request $req )
    {
        return DB::table('sesiones')
                ->join("users", "users.id", '=', "sesiones.idUser")
                ->join("invitadosesion", "invitadosesion.idSesion", '=', "sesiones.id")
                ->select('sesiones.*', 'users.name' )
                ->where("invitadosesion.idUser","=",$req->idUser)
                ->get();


    }
    public function create(Request $req)
    {
        date_default_timezone_set('America/Bogota');
        $date = date("Y-m-d H:i:s");
        $data = array(
            "nombre" => $req->txtNombre,
            "descripcion" => $req->txtDesc,
            "idUser" => $req->idUser,
            "fechaSesion" => $req->txtfechainicio,
            "fechaCreada" => $date,
            "tipoSesion" => $req->slcSesion,
            "estado" => "convocado",
            "linkSesion" => "https//webcomcel.com.co",
            "token" => "adc87hah12iue218as9jdja9d89",
            "fechaFinalizado" => $req->txtfechainicio
        );
        DB::table('sesiones')->insert($data);
    }


    public function modal_asistencia(Request $request)
    {
            $id =  $request ->get('id');

            $concejal = DB::table('users')
            ->where([['id', '=', "$id"],['estado', '=', "activo"]])
            ->get();

        return view('/sesiones/modal_asistente', array(
            'concejal' => $concejal,
        ));
    }

}
