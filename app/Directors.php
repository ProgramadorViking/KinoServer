<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Directors extends Model {

    protected $fillable = [
        'id', 'name', 'image', 'birthday', 'nation'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
