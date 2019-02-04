<?php 

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

    public function all() {
        return User::all();
    }

    public function get($id) {
        return User::find($id);
    }

    public function put(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = app('hash')->make($request->password);
        $user->updated_at=date_create();
        //TODO: estandaritzar la resposta, també donar una resposta en cas d'error
        return response()->json("Correct");
    }
}
