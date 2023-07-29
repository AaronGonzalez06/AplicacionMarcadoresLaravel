<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\User;
use App\Acceso;

class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function categoriaAdd(){

        $user = \Auth::user();
        $id = $user->id;
        $categorias = Categoria::where('user_id', $id)->orderBy('id', 'desc')->get();
        return view('categoria.add',[
            'categorias' => $categorias
        ]);
    }

    public function newCategoria(Request $request){

        $user = \Auth::user();
        $id = $user->id;
        $validate = $this->validate($request, [
            'nombre' => 'required|string|max:255|unique:categorias,name,NULL,id,user_id,'.$id,
            'color' => 'required|string'
        ]);

        $nombre= $request->input('nombre');
        $color= $request->input('color');


        $categoria = new Categoria();
        $categoria->name = $nombre;
        $categoria->color = $color;
        $categoria->user_id = $id;

        $categoria->save();

        return redirect()->route('categoria.add')
                         ->with(['message'=>'Categoría añadida con exito.']);
    }

    public function categoriaMarcadores($id){

        //datos acceso
        $user = \Auth::user();
        $iduser = $user->id;
        $datos = User::find($iduser);
        $fav = Acceso::where('user_id',$iduser)->get();
        $cantidadFav = count($fav);
        //fin

        $categoria = Categoria::find($id);
        $marcadores = $categoria->urls()->orderBy('created_at', 'desc')->get();
        return view('categoria.marcadores', [
            'marcadores' => $marcadores,
            'categoria' => $categoria,
            'fav' => $fav,
            'cantidad' => $cantidadFav
        ]);
    }

    public function delete($id){

        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect()->route('categoria.add')
                         ->with([
                            'message' => 'Categoría eliminada'
                         ]);

    }
}
