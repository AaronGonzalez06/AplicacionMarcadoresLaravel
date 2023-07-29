<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function configuracion(){
        return view('user.configuracion');
    }

    public function update(Request $request){

        $user = \Auth::user();
        $id = $user->id;

        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:50|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //actualizar usuario.
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $user->update();

        return redirect()->route('configuracion')
                         ->with(['message'=>'Cambios realizados correctamente.']);
    }

    public function updatePassword(Request $request){

        $user = \Auth::user();

        $validate = $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);

        $password = $request->input('password');

        $user->password = \Hash::make($password);

        $user->update();

        return redirect()->route('configuracion')
                         ->with(['messagePassword'=>'Nueva contraseña.']);

    }
}
