<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

use Illuminate\Http\Request;
use App\productos;

class productoController extends Controller
{
   
    public function index(Request $request)
    {
        $consultaG = DB::table('producto')
        ->get();
       return view('productos.index', array('consultaG'=> $consultaG )); 
    }
    public function add(Request $request)
    {
        //Categorias.
        $categorias = DB::table('categorias')
                     ->where('estado', '=', "1")
                     ->get();
        //Bodega.
        $bodegas = DB::table('bodegas')
        ->where('estado', '=', "1")
        ->get();
        //Lista_precios
        $lista_precios = DB::table('lista_precios')
        ->where('estado', '=', "1")
        ->get();
        //**Unidad del producto */

        //**Cuenta contable */ 
             
        return view('/productos/add', array(
            'categorias' => $categorias, 
            'bodegas' => $bodegas, 
            'lista_precios' => $lista_precios, 
            ));

    }

    public function crear_producto(Request $request)
    {
        $lista_precio = $request->get('id_lista_precio');
        $nombre  = $request->get('nombre');
        $precio_venta  = $request->get('precio_venta');
        $impuesto  = $request->get('impuesto');
        $unidad_medida  = $request->get('unidad_medida');
        $referencia  = $request->get('referencia');
        $descripcion  =  $request->get('descripcion');
        $id_categoria  = $request->get('id_categoria');
        $id_ventas_contable  = $request->get('id_ventas_contable');
        //$file
        $unidad_medida = $request->get('unidad_medida');
        $id_producto = $request->get('id_producto');
        $cantidad_inicial = $request->get('cantidad_inicial');
        $cantidad_minima = $request->get('cantidad_minima');
        $cantidad_maxima = $request->get('cantidad_maxima');

        return array ('lista_precio'=>$lista_precio);
    }

}
