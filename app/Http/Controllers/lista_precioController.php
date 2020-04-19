<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

use Illuminate\Http\Request;
use App\lista_precio;

class lista_precioController extends Controller
{
    public function index(Request $request)
    {
        $consultaG = DB::table('lista_precios')
        ->get();
       return view('lista_precios.index', array('consultaG'=> $consultaG )); 
    }  
    public function crear_lista(Request $request)
    {
        return view('/lista_precios/crear_lista');
    } 


    public function validation(Request $request)
    {
            $return = array();

            $rules = array(
                'nombre'              => 'required',
                'tipo'                => 'required',
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


    public function crear_listaP (Request $request)
    {
        try{

            $validasi = $this->validation($request);
          if ($validasi['status'] == 'success')
          {
           

            $Rnombre            = $request->nombre;
            $Rtipo              = $request->tipo; 
            $Rporcentaje        = $request->porcentaje; 

            $SaveLista= array(
                'nombre'             => $Rnombre  ,  
                'tipo'               => $Rtipo,
                'porcentaje'         => $Rporcentaje,
                'estado'             => 1,
            ); 

            lista_precio::insert($SaveLista);

            return back()->with('message', 'Se ha creado una nueva lista de precio.');
        }else {
            return $validasi;
          }

        } catch (QueryException $ex) { 
            return back()->with('error', 'Upss lo sentimos algo salio mal'); 
         }

    }

    public function lista_edit(Request $request)
    {
        $lista_precio = lista_precio::find($request->id);
        return view('/lista_precios/lista_edit', array(
            'lista_precio' => $lista_precio  
            ));
    }


    public function valida_lista(Request $request)
    {
            $return = array();

            $rules = array(
                'nombre'              => 'required',
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

          $lista_precio = lista_precio::find($id);
          $lista_precio->nombre    =  $request->nombre; 
          $lista_precio->save();

    }

    public function editar_lista_precioP(Request $request, $id)
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
             $lista_precio = lista_precio::find($request->id);
             return view('/lista_precios/delete_lista', array(
                 'lista_precio' => $lista_precio  
                 ));
         }
        public function destroy($id)
         {
               $lista_precio = lista_precio::find($id);
               if(!$lista_precio){
                 abort(404);
                 return back()->with('error', 'Upss algo salio mal, abort 404'); 
               }else{
                   return back()->with('message', 'Lista eliminada eliminada!');
                 $lista_precio->delete();
               }

               
              
    }

                public function do_delete_lista(Request $request)
                {
                $id = $request->id;
                if(empty($id)){
                    return back()->with('error', 'Upss algo salio mal'); 
                }else{
                    lista_precio::destroy($id);
                    return back()->with('message', 'Lista de precios eliminada.');
                }
            
                }
                public function lista_principal(Request $request)
                {
                    return back()->with('alerta', 'Lo sentimos, no puede eliminar la lista principal');   
                }
    }
