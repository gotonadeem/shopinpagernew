<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Post extends Authenticatable
{
    protected $fillable = [
        'title', 'description','image',
    ];
}
