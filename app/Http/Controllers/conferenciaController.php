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
                'date'                => 'required',
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
            $Rcontraseña          = $request->_token ; 
            $date                 = $request->date ; 
            $Rdescripcion         = $request->descripcion ; 

            $SaveConferencia= array(
                'nombre'             => $Rnombre  ,  
                'descripcion'        => $Rdescripcion,
                'contraseña'         => $Rcontraseña,
                'estado'             => 1,
                'fecha_r'             =>  $date ,
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

    public function online(Request $request, $id)
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

    public function modal_ver(Request $request)
    {
        $conferencia = conferencia::find($request->id);
        return view('/video/edit', array(
            'conferencia' => $conferencia  
            ));
    }

    public function valida_lista(Request $request)
    {
            $return = array();

            $rules = array(
                'nombre'              => 'required',
                'descripcion'         => 'required',
                'date'                => 'required',
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


    public function update(Request $request, $id)
    {

          $conferencia = conferencia::find($id);
          $conferencia->nombre    =  $request->nombre; 


         $conferencia->contraseña          = $request->_token ; 
         $conferencia->fecha_r             = $request->date ; 
         $conferencia->descripcion        = $request->descripcion ; 
        $conferencia->save();

    }

    public function editar_conferencia(Request $request, $id)
    {
        try{  

            $validasi = $this->valida_lista($request);
            if ($validasi['status'] == 'success')
            {
              $this->update($request, $id);
        
              return back()->with('message', 'Actualizacion exitosa .');  
            }else {
              return $validasi;
            }
                } catch (QueryException $ex) { 
                  return back()->with('error', 'Upss algo salio mal'); 
              }
              
         }

         public function delete_lista(Request $request)
         {
             $conferencia = conferencia::find($request->id);
             return view('/video/borrar', array(
                 'conferencia' => $conferencia  
                 ));
         }


         public function destroy($id)
         {
               $conferencia = conferencia::find($id);
               if(!$conferencia){
                 abort(404);
                 return back()->with('error', 'Upss algo salio mal, abort 404'); 
               }else{
                   return back()->with('message', 'Conferencia eliminada');
                 $conferencia->delete();
               }

               
              
            }

                public function do_delete(Request $request)
                {
                $id = $request->id;
                if(empty($id)){
                    return back()->with('error', 'Upss algo salio mal'); 
                }else{
                    conferencia::destroy($id);
                    return back()->with('message', 'Videoconferencia eliminada del TEC.');
                }
            
                }


}
