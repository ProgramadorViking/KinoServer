<?php 

namespace App\Http\Controllers;

use App\Films;
use Illuminate\Http\Request;

class FilmsController extends Controller {


    public function all() {
        return Films::all();
    }

    public function get($id) {
        //TODO: donar una resposta en cas d'error
        return Films::find($id);
    }

    public function add(Request $request) {
        $film = New Films($request->all());
        $film->save();
        //TODO: estandaritzar la resposta, també donar una resposta en cas d'error
        return response()->json("Correct");
    }

    public function put(Request $request, $id) {
        $film=Films::find($id);
        $film->name=$request->name;
        $film->category=$request->category;
        $film->premiere=$request->premiere;
        $film->description=$request->description;
        $film->pegi=$request->pegi;
        $film->duration=$request->duration;
        $film->image=$request->image;
        $film->trailer=$request->trailer;
        $film->updated_at=date_create();
        $film->save();
        //TODO: estandaritzar la resposta, també donar una resposta en cas d'error
        return response()->json("Correct");
    }

    public function last() {
        return Films::orderBy('created_at','desc')->limit(6)->get();
    }
}
