<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Article extends Model
{
    use CrudTrait;
    /*
    	|--------------------------------------------------------------------------
    	| GLOBAL VARIABLES
    	|--------------------------------------------------------------------------
    	*/

    	protected $table = 'articles';
    	protected $primaryKey = 'id';
    	protected $hidden = ['id'];
    	protected $fillable = ['name'];
    	protected $fillable = ['description'];
    	protected $fillable = ['price'];
    	protected $fillable = ['total_in_shelf'];
    	protected $fillable = ['total_in_vault'];
    	public $timestamps = true;

    	/*
    	|--------------------------------------------------------------------------
    	| FUNCTIONS
    	|--------------------------------------------------------------------------
    	*/

    	/*
    	|--------------------------------------------------------------------------
    	| RELATIONS
    	|--------------------------------------------------------------------------
    	*/

    	public function stores()
        {
            return $this->belongsTo('App\Models\Article', 'article_tag');
        }

    	/*
    	|--------------------------------------------------------------------------
    	| SCOPES
    	|--------------------------------------------------------------------------
    	*/

    	/*
    	|--------------------------------------------------------------------------
    	| ACCESORS
    	|--------------------------------------------------------------------------
    	*/

    	/*
    	|--------------------------------------------------------------------------
    	| MUTATORS
    	|--------------------------------------------------------------------------
    	*/
}
