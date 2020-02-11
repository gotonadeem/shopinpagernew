<?php
namespace App\Http\Controllers;
use App\User;
use App\UserKyc;
use App\UserNotice;
use App\Notice;
use App\Category;
use App\Cart;
use App\GeneralSetting;
use App\SellerNotification;
use App\UserNotification;
use App\City;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use View;
use Auth;
class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected function __construct()
	{

		//common data for footer section
		$favouritesArray=[0];
		$subCategory=array();
		if(Auth::check())
		{
			$user = Auth::user();
			//dd($user); die;
			$user_info= UserKyc::where('user_id',$user->id)->first();
			$userData= User::where('id',$user->id)->first();
			View::share('user_info',$user_info);

			$notice_count= Notice::get()->count();
			View::share('notice_count',$notice_count);

			$read_count= UserNotice::where('user_id',$user->id)->first();
			View::share('read_count',$read_count);
			//Seller notification
			$notify_count= SellerNotification::where('seller_id',$user->id)->where('status',0)->get()->count();
			View::share('notify_count',$notify_count);
			$After7Days = \Carbon\Carbon::today()->addDays(7);
			$sellerNotification= SellerNotification::where('seller_id',$user->id)->orderBy('id','desc')->whereDate('created_at','<=',$After7Days)->get();
			View::share('sellerNotification',$sellerNotification);

			if($userData->is_clear_notification_date !=null ){
				$userNotifyCount =UserNotification::where('status',1)->whereDate('created_at','>=',$userData->created_at)->where('created_at','>',$userData->is_clear_notification_date)->count();
				//$userNotifydata =UserNotification::where('status',1)->where('created_at','>',$userData->is_clear_notification_date)->get();
			}else{
				$userNotifyCount =UserNotification::where('status',1)->whereDate('created_at','>=',$userData->created_at)->count();
			}
			$userNotifydata =UserNotification::where('status',1)->whereDate('created_at','>=',$userData->created_at)->whereDate('created_at','<=',$After7Days)->get();
			//user notification
			View::share('userNotifyCount',$userNotifyCount);
			View::share('usernotifyData',$userNotifydata);
		}
		$system_address= md5($_SERVER['REMOTE_ADDR'].$_SERVER['SERVER_ADDR'].$_SERVER['SERVER_PORT'].$_SERVER['HTTP_USER_AGENT']);
		$availableCity = \DB::table("cities")
			->join('products', 'products.city_id', '=', 'cities.id')
			->where('cities.status',1)
			->select('cities.*')
			->distinct('cities.id')->get();

		$cart_count= Cart::where('system_address',$system_address)->get()->count();
		$cart_data= Cart::with('cart_product','cart_product.brand','cart_image')->where('system_address',$system_address)->get();
		$setting= GeneralSetting::select('wallet_deduction','saleplus_commission')->first();

		$sessionPincode = session('pincode');
		if($sessionPincode){
			$headerCategory = \DB::table("user_kyc")
				->join('products', 'products.user_id', '=', 'user_kyc.user_id')
				->join('categories', 'categories.id', '=', 'products.category_id')
				->select('categories.id as cat_id','categories.name as cat_name','categories.slug as cat_slug')
				->whereRaw("find_in_set($sessionPincode,user_kyc.delivery_pincode)")
				->distinct('cat_id')->get();
				
				$subCategory = \DB::table("user_kyc")
				->join('products', 'products.user_id', '=', 'user_kyc.user_id')
				->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
				->select('sub_categories.id as cat_id','sub_categories.name as cat_name','sub_categories.slug as cat_slug')
				->whereRaw("find_in_set($sessionPincode,user_kyc.delivery_pincode)")
				->distinct('cat_id')->get();
		}else{
			$headerCategory = \DB::table("categories")
				->select('categories.id as cat_id','categories.name as cat_name','categories.slug as cat_slug')
				->get();
				
			$subCategory = \DB::table("sub_categories")
			->select('sub_categories.id as cat_id','sub_categories.name as cat_name','sub_categories.slug as cat_slug')
			->get();
				
			$superSubCategory = \DB::table("super_sub_categories")
			->select('super_sub_categories.id as cat_id','super_sub_categories.name as cat_name','super_sub_categories.slug as cat_slug')
			->get();
		}

		//View::share('user_notify_count',$userNotifyCount);
		//View::share('userNotifydata',$userNotifydata);
		View::share('cart_count',$cart_count);
		View::share('cart_data',$cart_data);
		View::share('headerCategory',$headerCategory);
		View::share('subCategory',$subCategory);
		View::share('setting',$setting);
		View::share('availableCity',$availableCity);

	}
}
