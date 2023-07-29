<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Url;
use App\User;
use App\Acceso;

class MarcadorController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function marcadorAdd(){

        $user = \Auth::user();
        $id = $user->id;

        $datos = User::find($id);
        $categorias = $datos->categorias;
        return view('marcador.add',[
            'categorias' => $categorias
        ]);
    }

    public function delete($id){

        $marcador = Url::find($id);
        $marcador->delete();

        return redirect()->route('home')
                         ->with([
                            'message' => 'Marcador eliminado'
                         ]);

    }

    public function newMarcador(Request $request){
        
        $user = \Auth::user();
        $id = $user->id;
        $validate = $this->validate($request, [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url' => 'required|url',
            'categoria' => 'required|string'
        ]);
        
        $titulo= $request->input('titulo');
        $descripcion= $request->input('descripcion');
        $urlFormulario= $request->input('url');
        $categoria= $request->input('categoria');

        $marcador = new Url();
        $marcador->titulo = $titulo;
        $marcador->descripcion = $descripcion;
        $marcador->url = $urlFormulario;
        $marcador->categoria_id = $categoria;
        $marcador->save();

        return redirect()->route('marcador.add')
                         ->with(['message'=>'Marcador añadido con exito.']);
    }

    public function EditarMarcador($id){
        //datos marcador
        $url = Url::find($id);

        //categorias
        $userSession = \Auth::user();
        $idUsuario = $userSession->id;

        $user = User::find($idUsuario);
        $categorias = $user->categorias;
        return view('marcador.editar', [
            'url' => $url,
            'categorias' => $categorias,
            'idMarcador' => $id
        ]);
    }

    public function update(Request $request){

        $validate = $this->validate($request, [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url' => 'required|url',
            'categoria' => 'required|string'
        ]);

        $titulo= $request->input('titulo');
        $descripcion= $request->input('descripcion');
        $urlFormulario= $request->input('url');
        $categoria= $request->input('categoria');

        $idMarcador = $request->input('idMarcador');

        $marcador = Url::find($idMarcador);
        $marcador->titulo = $titulo;
        $marcador->descripcion = $descripcion;
        $marcador->url = $urlFormulario;
        $marcador->categoria_id = $categoria;

        $marcador->update();

        return redirect()->route('marcador.editar',['id' => $idMarcador])
                         ->with(['message'=>'Marcador actualizado.']);
    }

    public function ultimosMarcadores(){

        $user = \Auth::user();
        $id = $user->id;
        $datos = User::find($id);

        //datos acceso
        $fav = Acceso::where('user_id',$id)->get();
        $cantidadFav = count($fav);
        //fin

        $categorias = $datos->categorias;
        return view('marcador.listado',[
            'categorias' => $categorias,
            'fav' => $fav,
            'cantidad' => $cantidadFav
        ]);
    }

    public function buscadorMarcadores($titulo = null){
        $user = \Auth::user();
        $id = $user->id;

        //datos acceso
        $fav = Acceso::where('user_id',$id)->get();
        $cantidadFav = count($fav);
        //fin

        if($titulo == null){
            $datos = User::find($id);
            $categorias = $datos->categorias;
            $urls = [];
            foreach($categorias as $categoria){
                foreach($categoria->urls()->orderBy('created_at', 'desc')->get() as $url){
                    $urls[] =$url;
                }
            }
        } else{
            $datos = User::find($id);
            $categorias = $datos->categorias;
            $urls = [];
            foreach($categorias as $categoria){
                foreach($categoria->urls()->where('titulo','LIKE','%'.$titulo.'%')->orderBy('created_at', 'desc')->get() as $url){
                    $urls[] =$url;
                }
            }
        }
        return view('marcador.buscar',[
            'urls' => $urls,
            'fav' => $fav,
            'cantidad' => $cantidadFav
        ]);
    }

    public function addFav($id){

        $user = \Auth::user();
        $idUser = $user->id;

        $datosMarcador = Url::find($id);

        $accesoRapido = new Acceso();
        $accesoRapido->titulo = $datosMarcador->titulo;
        $accesoRapido->descripcion = $datosMarcador->descripcion;
        $accesoRapido->url = $datosMarcador->url;
        //datos categoria
        $accesoRapido->categoria = $datosMarcador->categoria->name;
        $accesoRapido->colorCategoria = $datosMarcador->categoria->color;
        $accesoRapido->categoria_id = $datosMarcador->categoria->id;
        //fin datos categoria
        $accesoRapido->marcador_id = $datosMarcador->id;
        $accesoRapido->user_id = $idUser;
        $accesoRapido->fechaFormateada = $datosMarcador->created_at->format('d-m-Y');
        $accesoRapido->save();


    }

    public function deleteFav($id){

        $user = \Auth::user();
        $idUser = $user->id;

        $datosMarcador = Url::find($id);

        $idMarcador = $datosMarcador->id;

        $fav = Acceso::where('user_id',$idUser)
                       ->where('marcador_id',$idMarcador)
                       ->get();

        var_dump($fav[0]->id);
        
        $fav[0]->delete();

    }

    public function guardado(){

        $user = \Auth::user();
        $id = $user->id;
        $datos = User::find($id);

        //datos acceso
        $fav = Acceso::where('user_id',$id)->orderBy('created_at', 'desc')->get();
        $cantidadFav = count($fav);
        //fin
        return view('marcador.guardado',[
            'fav' => $fav,
            'cantidad' => $cantidadFav
        ]);
    }
}
