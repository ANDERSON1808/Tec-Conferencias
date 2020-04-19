<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

use Illuminate\Http\Request;
use App\conferencia;


class conferenciaController extends Controller
{
    public function conferencia(Request $request)
    {
        $consultaG = DB::table('conferencia')
        ->get();
       return view('/video/inicio', array('consultaG'=> $consultaG )); 
    }  
    
    public function crear_conferencia(Request $request)
    {
        return view('/video/nueva');
    } 


    public function validation(Request $request)
    {
            $return = array();

            $rules = array(
                'nombre'              => 'required',
                'descripcion'         => 'required',
                'contraseña'          => 'required',
                '_token'              => 'required'
            );
                $messages = array(
                    'required'  => 'Este campo debe ser completado.',
                    'integer'   => 'La columna debe contener números.'
                );

                $validator  = Validator::make($request->all(), $rules, $messages);

                if (!$validator->fails()){
                $return['status'] = 'success';
                } else {
                $return['status'] = 'error';
                $return['message'] = $validator->messages();
                }

                return $return;
    }


    public function save (Request $request)
    {
        try{

            $validasi = $this->validation($request);
          if ($validasi['status'] == 'success')
          {
           

            $Rnombre              = $request->nombre;
            $Rcontraseña          = $request->contraseña ; 
            $Rdescripcion         = $request->descripcion ; 

            $SaveConferencia= array(
                'nombre'             => $Rnombre  ,  
                'descripcion'        => $Rdescripcion,
                'contraseña'         => $Rcontraseña,
                'estado'             => 1,
                'conferencia'        => "https://meet.jit.si/$Rnombre",
                'accion'             => "1",

            ); 

            conferencia::insert($SaveConferencia);

            return back()->with('message', 'Se ha creado una nueva sala de conferencia.');
        }else {
            return $validasi;
          }

        } catch (QueryException $ex) { 
            return back()->with('error', 'Upss lo sentimos algo salio mal'); 
         }

    }

    public function modal_ver(Request $request, $id)
    {
        //$categorias = categorias::find($request->id);
     //   $Id= $request->get('id');

        $conferencia = DB::table('conferencia')
                     ->where('id', '=', "$id")
                     ->get();
        return view('/video/online', array(
            'conferencia' => $conferencia, 
            ));

    }


}
