<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Acceso;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $id = $user->id;
        $datos = User::find($id);

        //datos acceso
        $fav = Acceso::where('user_id',$id)->get();
        //fin
        $cantidadFav = count($fav);
        $categorias = $datos->categorias()->orderBy('created_at', 'desc')->get();
        return view('home',[
            'categorias' => $categorias,
            'fav' => $fav,
            'cantidad' => $cantidadFav
        ]);
    }
}
