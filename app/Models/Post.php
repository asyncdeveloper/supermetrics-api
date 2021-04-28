<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent
{

    protected $guarded = [ 'id' ];

    public $timestamps = false;

}
