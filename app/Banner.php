<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Banner extends Model
{
    protected $fillable = [
        'id',
        'title',
        'images',
        'link',
		'type',
        'status'
    ];
    protected $table="banners";
	
	function main_category()
	{
		return $this->belongsTo('App\Category','link');
	}
   
}