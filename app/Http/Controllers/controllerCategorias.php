<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

use Illuminate\Http\Request;
use App\categorias;
class controllerCategorias extends Controller
{
    public function index(Request $request)
    {
        $consultaG = DB::table('categorias')
        ->get();
       return view('categorias.index', array('consultaG'=> $consultaG )); 
    }
    public function crear_modal(Request $request)
    {
        return view('/categorias/crear_modal');
    }

    public function validation(Request $request)
    {
            $return = array();

            $rules = array(
                'nombre'              => 'required',
                'descripcion'        	=> 'required',
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



    public function save(Request $request)
    {
        try{

            $validasi = $this->validation($request);
          if ($validasi['status'] == 'success')
          {
              //obtenemos el campo file definido en el formulario
            $file = $request->file('file');
            //obtenemos el nombre del archivo
            $imagen = $file->getClientOriginalName();
            $path = public_path().'/img/';

            $Rnombre            = $request->nombre;
            $Rdescripcion       = $request->descripcion; 

            $SaveCategoria= array(
                'nombre'             => $Rnombre  ,  
                'descripcion'        => $Rdescripcion,
                'imagen'             => $imagen,
                'estado'             => 1,
            ); 

            categorias::insert($SaveCategoria);

            $file->move($path, $imagen);
          //  \Storage::disk('local')->put($imagen,  \File::get($file));
            return back()->with('message', 'Se ha creado una nueva categoria.');
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

        $categorias = DB::table('categorias')
                     ->where('id', '=', "$id")
                     ->get();
        return view('/categorias/ver_categoria', array(
            'categorias' => $categorias, 
            ));

    }
    public function modal_edit(Request $request)
    {
        $categorias = categorias::find($request->id);
        return view('/categorias/modal_edit', array(
            'categorias' => $categorias  
            ));
    }
    public function update(Request $request, $id)
    {

            $file = $request->file('file');
            //obtenemos el nombre del archivo
            $imagen = $file->getClientOriginalName();
            $path = public_path().'/img/';

          $categorias = categorias::find($id);
          $categorias->nombre              =  $request->nombre;
          $categorias->descripcion         =  $request->descripcion;
          $categorias->imagen              =  $imagen;  
          $categorias->save();

    }

    public function editar(Request $request, $id)
    {
        try{  
            $file = $request->file('file');
            //obtenemos el nombre del archivo
            $imagen = $file->getClientOriginalName();
            $path = public_path().'/img/';

            $validasi = $this->validation($request);
            if ($validasi['status'] == 'success')
            {
              $this->update($request, $id);
              $file->move($path, $imagen);

              return back()->with('message', 'Actualizacion exitosa.');  
            }else {
              return $validasi;
            }
                } catch (QueryException $ex) { 
                  return back()->with('error', 'Upss algo salio mal'); 
              }
              
         }
         public function bloquedo (Request $request, $id)
         {
                $esta= $request->get('estado');
               $categorias = categorias::find($id);
               $categorias->estado  = $esta;
               $categorias->save();
     
         }
         public function desactivar(Request $request, $id,$estado)
         {
           // $esta= $request->get('estado');
           // $id= $request->get('id');
            
          //  return $esta;
            //try{  
                //$esta= $request->get('estado');
                // if ($esta==2)
                // {
                 //  $this->bloquedo($request, $id);
     
                   //return back()->with('message', 'La categoria fue desactivada');  
               //  }elseif ($esta==1){ 
                
                  //  $this->bloquedo($request, $id);
     
                   // return back()->with('message', 'La categoria fue Activada'); 
               // }else {
                //   return $validasi;
                // }
                   //  } catch (QueryException $ex) { 
                       //return back()->with('error', 'Upss algo salio mal'); 
                   //}
                   
              }

              public function modal_delete(Request $request)
              {
                  $categorias = categorias::find($request->id);
                  return view('/categorias/modal_eliminar', array(
                      'categorias' => $categorias  
                      ));
              }
         public function destroy($id)
              {
                    $categorias = categorias::find($id);
                    if(!$categorias){
                      abort(404);
                      return back()->with('error', 'Upss algo salio mal, abort 404'); 
                    }else{
                        return back()->with('message', 'Cetegoria eliminada!');
                      $categorias->delete();
                    }
                   
         }
          
        public function do_delete(Request $request)
              {
                $id = $request->id;
                if(empty($id)){
                    return back()->with('error', 'Upss algo salio mal'); 
                }else{
                    categorias::destroy($id);
                    return back()->with('message', 'Cetegoria eliminada.');
                }
           
        }

    
}
