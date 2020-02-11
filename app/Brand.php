<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
/*use Illuminate\Database\Eloquent\SoftDeletes;*/
class Brand extends Model
{
    protected $fillable = ['name','images','status'];
    protected $hidden = [
        'remember_token',
    ];
    
}
