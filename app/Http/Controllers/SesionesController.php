<?php

namespace App\Http\Controllers;

use App\sesiones;
use Illuminate\Http\Request;
use DB;

class SesionesController extends Controller
{


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

    public function online(Request $request, $id)
    {
        if (empty($id))
        {
            return back()->with('error', 'Upss error grave, comuniquese con el proveedor del programa.');
        }else{
            $sesiones = DB::table('sesiones')
            ->where('id', '=', "$id")
            ->get();

            $notificacion = DB::table('invitadosesion')
                ->where('estado', '=', "convocado")
                ->get();

                $iniciar =1;
                DB::table('sesiones')
                            ->where('id',  $id)
                            ->update(['estado' => "finalizado"]);

                return view('/sesiones/online', array(
                'notificacion' => $notificacion,
                'conferencia' => $sesiones,
                ));
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\sesiones  $sesiones
     * @return \Illuminate\Http\Response
     */
    public function get( )
    {
        return DB::table('sesiones')
                ->join("users", "users.id", '=', "sesiones.idUser")
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sesiones  $sesiones
     * @return \Illuminate\Http\Response
     */
    public function edit(sesiones $sesiones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sesiones  $sesiones
     * @return \Illuminate\Http\Response
     */
    public function invitados(Request $request, sesiones $sesiones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sesiones  $sesiones
     * @return \Illuminate\Http\Response
     */
    public function destroy(sesiones $sesiones)
    {
        //
    }
}
