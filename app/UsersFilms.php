<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersFilms extends Model {

    public $timestamps = false;
    protected $primaryKey = null;

    protected $fillable = [
        'user_id','film_id','status'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
