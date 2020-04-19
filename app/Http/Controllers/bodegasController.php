<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

use Illuminate\Http\Request;
use App\bodega;

class bodegasController extends Controller
{
    public function index(Request $request)
    {
        $consultaG = DB::table('bodegas')
        ->get();
       return view('bodegas.index', array('consultaG'=> $consultaG )); 
    }
    public function crear_bodega(Request $request)
    {
        return view('/bodegas/moda_nuevo');
    } 

    public function validation(Request $request)
    {
            $return = array();

            $rules = array(
                'nombre'              => 'required',
                'direccion'        	=> 'required',
                'observaciones'        	=> 'required',
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


    public function save_bodega (Request $request)
    {
        try{

            $validasi = $this->validation($request);
          if ($validasi['status'] == 'success')
          {
           

            $Rnombre            = $request->nombre;
            $Rdireccion         = $request->direccion; 
            $Robservaciones     = $request->observaciones; 

            $SaveBodega= array(
                'nombre'             => $Rnombre  ,  
                'direccion'          => $Rdireccion,
                'observaciones'      => $Robservaciones,
                'estado'             => 1,
            ); 

            bodega::insert($SaveBodega);

            return back()->with('message', 'Se ha creado una nueva bodega.');
        }else {
            return $validasi;
          }

        } catch (QueryException $ex) { 
            return back()->with('error', 'Upss lo sentimos algo salio mal'); 
         }

    }

    public function bodega_edit(Request $request)
    {
        $bodega = bodega::find($request->id);
        return view('/bodegas/bodega_edit', array(
            'bodega' => $bodega  
            ));
    }

    public function update(Request $request, $id)
    {

          $bodega = bodega::find($id);
          $bodega->nombre              =  $request->nombre;
          $bodega->direccion           =  $request->direccion;
          $bodega->observaciones       =  $request->observaciones;  
          $bodega->save();

    }

    public function editar_bodega(Request $request, $id)
    {
        try{  

            $validasi = $this->validation($request);
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


         public function modal_delete_bodega(Request $request)
         {
             $bodega = bodega::find($request->id);
             return view('/bodegas/modal_eliminar', array(
                 'bodega' => $bodega  
                 ));
         }
    public function destroy($id)
         {
               $bodega = bodega::find($id);
               if(!$bodega){
                 abort(404);
                 return back()->with('error', 'Upss algo salio mal, abort 404'); 
               }else{
                   return back()->with('message', 'Bodega eliminada!');
                 $bodega->delete();
               }
              
    }
    
     
   public function do_delete_bodega(Request $request)
         {
           $id = $request->id;
           if(empty($id)){
               return back()->with('error', 'Upss algo salio mal'); 
           }else{
            bodega::destroy($id);
               return back()->with('message', 'Bodega eliminada.');
           }
      
   }




}
