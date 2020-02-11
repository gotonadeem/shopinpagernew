<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Notice;
use App\UserNotice;
use App\SellerNotification;
use DB;
class NotificationController extends Controller
{
    public function __construct()
    {		parent::__construct();
	
    }
    public function index()
    {	
      $sellerNotification= SellerNotification::where('seller_id',Auth::user()->id)->orderBy('id','desc')->paginate(50);		
	   return view('seller.notification.index',compact('sellerNotification'));
	}
}