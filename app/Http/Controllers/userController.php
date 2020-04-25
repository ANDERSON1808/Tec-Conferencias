<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class userController extends Controller
{

    public function users()
    {
       return view('/usuarios/admin' );
    }
    public function get()
    {
        $users = DB::table('users')
       ->leftJoin('roles', 'roles.id', '=', 'users.id')
       ->select('users.created_at','users.id','users.email','users.estado','users.name','users.created_at','roles.id as idrol','roles.nombre')
       ->get();
       return $users;
    }
    public function modal_ver()
    {
        $roles = DB::table('roles')
        ->get();

        return view('/usuarios/edit', array('roles'=>  $roles ));
    }


    public function usersview( )
    {
       return view('/usuarios/admin');
    }
    public function userCrear( )
    {

        $roles = DB::table('roles')
        ->get();

        return view('/usuarios/create', array('roles'=>  $roles ));
    }

    public function delete(Request $req)
    {
        return DB::select('call user_delete(?)',array(  $req->id ));
    }
    public function update(Request $req)
    {
        return DB::select('call user_update(?,?,?,?,?)',array(
           $req->slcRoles, $req->slcEst, $req->txtNombre, $req->txtCorreo, $req->idUser
        ));
    }
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(Request $data)
    {

          $this->validator($data->all())->validate();
        User::create([
            'idRol' =>$data['slcRoles'],
            'name' => $data['name'],
            'email' => $data['email'],
            'estado' =>  $data['slcEst'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
