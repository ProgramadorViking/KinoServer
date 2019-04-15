<?php 

namespace App\Http\Controllers;

use App\UsersFilms;
use App\Films;
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
        return UsersFilms::where('user_id',$user_id)->where('film_id',$id)->get();
    }

    public function addStat(Request $request) {
        $user_id = $request->user()->id;
        $film_id = $request->film_id;
        $status = $request->status;
        //$item = UsersFilms::firstOrNew(
        //    ['user_id'=>$id,
        //    'film_id'=>$request->film_id],
        //    ['status'=>$request->status]
        //);
        //$item->status = $request->status;
        //$item->save();
        $item = UsersFilms::where('user_id', $user_id)->where('film_id', $film_id)->first();
        if ($item === null) {
            $item = New UsersFilms();
            $item->user_id=$user_id;
            $item->film_id=$film_id;
            $item->status=$status;
            $item->save();
        } else {
            $update['status']=$status;
            UsersFilms::where('user_id',$user_id)->where('film_id',$film_id)->update($update);
        }
        return response()->json($item);
    }

    public function views(Request $request) {
        $user_id = $request->user()->id;
        $list = UsersFilms::where('user_id',$user_id)->where('status',2)->limit(6)->pluck('film_id')->toArray();
        $films = Films::whereIn('id',$list)->get();
        return $films;
    }

}
