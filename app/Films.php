<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model {

    protected $fillable = [
        'id','name','duration','saga','category','premiere','description','pegi','created_at','updated_at', 'image', 'trailer'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
