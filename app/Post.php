<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name
    protected $table = 'posts';
    //primary key
    public $primaryKey = 'id';
    //time stamps
    public $timeStamps = true;
    //creating relationship
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
