<?php

namespace App\Http\Controllers;

use App\notification;
use Illuminate\Http\Request;
use DB;
class NotificationController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        return DB::select("SELECT  notificaciones.*  FROM notificaciones WHERE fecha BETWEEN CURDATE() - INTERVAL 10 DAY AND CURDATE() ORDER BY visualizacion DESC");
        // return DB::
        // $not = DB::table("notificaciones")->whereBetween('fecha','  CURDATE() - INTERVAL 30 DAY ',' CURDATE()' )
        // ->get();
        // DB::quer
        // $not = notification::where('notificaciones.fecha ','BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()'     )
        //             ->get();
        // return $not;
    }
    public function cantidadNotSinVer()
    {
        return DB::select("SELECT   COUNT(*) as cantidad  FROM notificaciones   ");
        // return DB::
        // $not = DB::table("notificaciones")->whereBetween('fecha','  CURDATE() - INTERVAL 30 DAY ',' CURDATE()' )
        // ->get();
        // DB::quer
        // $not = notification::where('notificaciones.fecha ','BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()'     )
        //             ->get();
        // return $not;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification $notification)
    {
        //
    }
}
