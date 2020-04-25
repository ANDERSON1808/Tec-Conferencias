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
        ->where('estado', '=', "1")
        ->get();
       return view('/video/inicio', array('consultaG'=> $consultaG )); 
    }  
    
    public function crear_conferencia(Request $request)
    {
        return view('/video/nueva');
    } 

    public function invitar_usuarios(Request $request)
    {
        $conferencia = DB::table('conferencia')
        ->where('estado', '=', "1")
        ->get();

        $users = DB::table('users')
        ->get();

        return view('/video/invitar_interno', array(
            'conferencia' => $conferencia,
            'users' => $users,
        ));
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
            $user                 = $request->usuario ; 


            $SaveConferencia= array(
                'nombre'             => $Rnombre  ,  
                'descripcion'        => $Rdescripcion,
                'contraseña'         => $Rcontraseña,
                'estado'             => 1,
                'fecha_r'             =>  $date ,
                'conferencia'        => "https://meet.jit.si/$Rnombre",
                'accion'             => "1",
                'creador'             => $user,

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

       $notificacion = DB::table('invitados_conferencia')
                     ->where('estado', '=', "1")
                     ->get();
        return view('/video/online', array(
            'notificacion' => $notificacion, 
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

                
        public function invitarInterno(Request $req)
                {

                    $Rconferencia =      $req ->get('conferencia');
                    $Rusuario     =      $req ->get('usuario');
                    $estado = 1;
                    $rol= 1; 
       
                      if (empty( $Rusuario)){
                        return back()->with('error', 'Upss algo salio mal'); 
                      }else{

                        foreach( $Rusuario as $key => $val){
                            
                            $data = array(
                                "id_conferencia" => $Rconferencia,
                            "cod_usuario" =>  $val,
                            "estado" => $estado,
                            "rol" => $rol
                            );
                            DB::table("invitados_conferencia")->insert( $data);

                      }
                      
                      return back()->with('message', 'Excelente, Fueron enviadas las invitaciones a la conferencia.');
                        } 
                        
         }
         public function notificacion (Request $req)
         {
     
            $notificacion = DB::table('invitados_conferencia')
            ->where('estado', '=', "1")
            ->get();
                 return view('/header', array(
                   'notificacion' => $notificacion, 
             ));
     
         }


         public function invitar_externos(Request $request)
         {

            $id =  $request ->get('id');


             $conferencia = DB::table('conferencia')
             ->where([['id', '=', "$id"],['estado', '=', "1"]])
             ->get();
     
             return view('/video/externos', array(
                 'conferencia' => $conferencia,
             ));
         } 


         public function terminar(Request $request)
         {
        
                 $estado = 2;
                 $id =      $request ->get('id');
    
                 if (!isset($id))
                 {
                    return back()->with('error', 'No cuenta con id'); 

                 } else {
                    DB::table('conferencia')
                    ->where('id',  $id)
                    ->update(['estado' =>   $estado]);
                    
                    DB::table('invitados_conferencia')
                    ->where('id_conferencia',  $id)
                    ->update(['estado' =>   $estado]);

                    $consultaG = DB::table('conferencia')
                    ->get();
                   return view('/video/inicio' ,array('consultaG'=> $consultaG ));
                     
              }
            }

   public function invitacion(Request $request)
       {
                $consultaG = DB::table('conferencia')
                ->where('estado', '=', "1")
                ->get();

                $invitado = DB::table('invitados_conferencia')
                ->where('estado', '=', "1")
                ->get();


               return view('/video/ingreso_invitado', array(
                   'consultaG'=> $consultaG,
                   'invitado'=> $invitado, 
                )); 
       }  

}
