<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class rolController extends Controller
{
    public function get()
    {
       return DB::table('roles')
        ->get();
    }
    public function view()
    {
       return  view("usuarios/roles");
    }
}
