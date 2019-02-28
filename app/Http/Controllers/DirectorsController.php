<?php 

namespace App\Http\Controllers;

use App\Directors;
use Illuminate\Http\Request;

class DirectorsController extends Controller {

    public function all()  {
        return Directors::all();
    }

    public function get($id) {
        //TODO: donar una resposta en cas d'error
        return Directors::find($id);
    }

    public function add(Request $request) {
        $director = New Directors($request->all());
        $director->save();
        //TODO: estandaritzar la resposta, també donar una resposta en cas d'error
        return response()->json("Correct");
    }

    public function put(Request $request, $id) {
        $director=Directors::find($id);
        $director->name=$request->name;
        $director->image=$request->image;
        $director->birthday=$director->birthday;
        $director->nation=$director->nation;
        $director->save();
        return response()->json("Correct");
    }

}
