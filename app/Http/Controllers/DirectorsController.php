<?php 

namespace App\Http\Controllers;

use App\Directors;
use App\FilmsDirectors;
use App\Films;
use Illuminate\Http\Request;

class DirectorsController extends Controller {

    public function all()  {
        return Directors::all();
    }

    public function get($id) {
        //TODO: donar una resposta en cas d'error
        //Tornar també les pelicules...
        $director = Directors::find($id);
        $director->filmography = FilmsDirectors::where('director_id',$director->id)->get();
        return $director;
    }

    public function add(Request $request) {
        $director = New Directors($request->all());
        $director->save();
        //Falta guardar les pelicules
        $filmography = $request->filmography;
        for ($i=0;$i<count($filmography);$i++) {
            $answers[] = [
                'director_id' => $director->id,
                'film_id' => $filmography[$i]
            ];
        }
        FilmsDirectors::insert($answers);
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
        //guardar les pelicules...
        $filmography = $request->filmography;
        for ($i=0;$i<count($filmography);$i++) {
            $answers[] = [
                'director_id' => $director->id,
                'film_id' => $filmography[$i]
            ];
        }
        FilmsDirectors::insert($answers);
        return response()->json("Correct");
    }

    public function withFilms($id) {
        $director = Directors::find($id);
        $filmography = FilmsDirectors::where('director_id',$director->id)->get();
        $films = array();
        for($i=0;$i<count($filmography);$i++) {
            $film = Films::find($filmography[$i]['film_id']);
            array_push($films,$film);
        }
        $director->filmography = $films;
        return $director;
    }

}
