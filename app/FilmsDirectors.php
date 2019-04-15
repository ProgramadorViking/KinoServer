<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmsDirectors extends Model {

    public $timestamps = false;
    protected $primaryKey = null;
    
    protected $fillable = [
        'film_id','director_id'
    ];

    protected $dates = [];

    public static $rules = [];
}