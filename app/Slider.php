<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Slider extends Model
{
    protected $fillable = [
        'id',
        'title',
        'images',
        'link',
		'type'
    ];
    protected $table="banners";
	
	function main_category()
	{
		return $this->belongsTo('App\Category','link');
	}
}
