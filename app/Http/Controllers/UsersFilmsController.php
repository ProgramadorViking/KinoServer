<?php 

namespace App\Http\Controllers;

use App\UsersFilms;
use Illuminate\Http\Request;

class UsersFilmsController extends Controller {

    public function all() {
        return UsersFilms::all();
    }

    public function getFilm($id) {
        return UsersFilms::where('film_id',$id)->get();
    }

    public function getUser($id) {
        return UsersFilms::where('user_id',$id)->get();
    }

    public function getStat(Request $request, $id) {
        $user_id = $request->user()->id;
        return UsersFilms::where('user_id',$id)->where('film_id',$id)->get();
    }

    public function addStat(Request $request) {
        $item = UsersFilms::firstOrNew(
            ['user_id'=>$request->user_id,
            'film_id'=>$request->film_id],
            ['status'=>$request->status]
        );
        $item->save();
        //return response()->json("Correct");
    }

}
