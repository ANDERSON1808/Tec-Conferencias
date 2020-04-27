<?php

namespace App\Http\Controllers;

use App\sesiones;
use Illuminate\Http\Request;
use DB;
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
        return view("sesiones/admin");
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
                        ->where('roles.nombre', '=', "concejal")
                        ->select("users.*")
                        ->get();

                        // return redirect()->route('sesionesonline',  array(
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
public function editTema(Request $req){
    $data = array(
        "tema" =>  $req->tt,
        "detalle" =>$req->txtDescripcion,
        "linkPdf" =>"asdasd"
    );

    DB::table('temas')
    ->where('id', $req->id)
    ->update( $data);
    return "sesiones/editTema" ;


 }
 public function deleteTema(Request $req){
        return DB::select('call tema_delete(?)',array(  $req->id ));
 }
public function getTemas(Request $req){
   return DB::table('temas')->where(  "idSesion",$req->sesion)->get();
}
    public function createTema(Request $req){
        $data = array(
            "tema" =>  $req->tt,
            "detalle" =>$req->txtDescripcion,
            "idSesion" =>  $req->sesion,
            "linkPdf" =>"asdasd"
        );
        DB::table('temas')->insert($data);
        return "sas";
    }

    public function guardarVoto(Request $req){

        $data = array(
            "idUser"=>$req->idUser,
            "idTema"=>$req->idTema,
            "idVoto"=>$req->idVoto
        );
       return DB::table('votacion')->insert($data);

    }

    public function aprobarSolicitud(Request $req){
        return DB::table('solicitudpalabra')->where([
            ["idTema",$req->idTema],
            ['idUser', $req->idUser],
        ])->update(['estado' =>  "aprobado"]);
    }
    public function getSolicitudesPalabra(Request $req){
        return DB::table('solicitudpalabra')
               ->join("users","users.id","solicitudpalabra.idUser")
        ->where("idTema",$req->idTema)
        ->select("users.id","users.name","solicitudpalabra.*")
        ->get();
    }
    public function postSolicitudPalabra(Request $req){
        $idUser = Auth::user()->id;
        $data = array(
            "idUser"=>$idUser,
            "idTema"=>$req->idTema,
            "estado"=>"denegado",
            "tipo"=>$req->estado,
        );
        return DB::table('solicitudpalabra')->insert(  $data  );
    }
    public function UserInConferencia(Request $req){


       return DB::table('lista_asistencia')
       ->join("users", "users.id","lista_asistencia.idUser")
       ->leftJoin("votacion", "votacion.idUser", "lista_asistencia.idUser")
       ->leftJoin("tipovotacion", "tipovotacion.id", "votacion.idVoto")
       ->where([
            ["lista_asistencia.estado","presente"],
            ['lista_asistencia.idSesion', $req->id],
        ])
        ->select('users.created_at','users.id','users.email','users.estado','users.name','users.created_at','tipovotacion.nombre' ,'tipovotacion.id as idVot' )
        ->get();
    }
    public function createAsistencia(Request $req)
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
        return "llamado a lista" ;
    }
    public function get( )
    {
        $usuario_encasa = Auth::user()->id;
        return DB::table('sesiones')
                ->join("users", "users.id", '=', "sesiones.idUser")
                ->where("idUser",$usuario_encasa)
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
