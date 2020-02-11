<?php
namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use App\State;
use App\City;
use Helper;
class CommonController extends Controller
{   
    public function index()
    {
		
    }
	
	 public function get_city(Request $request)
    {
        $id=$request->input('id');
        $city_list= City::where('state_id',$id)->get();
        return view('front.common.state_ajax')->with('state_list',$city_list);
    }
	
	public static function send_mail($emailData)
	{
		 Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
                    $message
                        ->to($emailData['to'])
                        ->from($emailData['from'])
                        ->subject($emailData['subject']);

                });
	}
	public static function send_msg($mobile,$message)
	{
		Helper::send_msg($mobile,$message);
	}
	public static function str_random($length = 16)
	{
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}

}

?>