<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Session;
use DB;
use Validator;
use App\User;
use App\Cart;
use App\UserKyc;
use Hash;
use Mail;
use App\Helpers\Helper;
use URL;
class SocialLoginController extends Controller
{
    public function __construct()
    {
       parent::__construct();
       // $this->model=$model;
    }

    public function FacebookRegister()
    {
        return \Socialite::driver('facebook')->redirect();
    }
	
	public function FacebookLogin(Request $request)
    {
		
           $system_address= md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
		   $cart_data= Cart::with('cart_product','cart_image')->where('system_address',$system_address)->get();		
        if (isset($request->query()['error'])) {
            return redirect("/");
        } else {
            try {
                $user_data = Socialite::driver('facebook')->user(); 			
				$user['username'] = $user_data->getName();
                $user['email'] = $user_data->getEmail();
                $user['social_id'] = $user_data->getId();
                $user['image']=$user_data->getAvatar();
                $user['login_type'] = "facebook";
                $user['role_id'] = 3;
                $user_kyc['f_name'] =$user_data->getName();
                $existing_user = User::where('social_id', $user['social_id'])->first();
                if (count((array)$existing_user)>0) {	
                    Auth::login($existing_user);
					if(count($cart_data)>0)
					{
						return redirect('checkout');
					}
		            else
					{
				        return redirect("/");
					}
                } else {
                    $object = new User($user);
                    $object->save();
					$user_kyc['user_id']=$object->id;
					$object2 = new UserKyc($user_kyc);
                    $object2->save();
                    Auth::login($object);
                    if(count($cart_data)>0)
					{
						return redirect('checkout');
					}
		            else
					{
				        return redirect("/");
					}
                }
            } catch (\Exception $e) {
				
                return redirect("/");
				
            }
        } 
    }
	
	public function GoogleRegister()
    {
        return \Socialite::driver('google')->redirect();
    }
	
	  public function GoogleLogin(Request $request)
    {
            $system_address= md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
		   $cart_data= Cart::with('cart_product','cart_image')->where('system_address',$system_address)->get();		
      
        if(isset($request->query()['error']))
        {
            return redirect("/");
        }
        else
        {
            try
            {
                $user_data = Socialite::driver('google')->user();
                $user['username']=$user_data->getName();
                $user['email']=$user_data->getEmail();
                $user['social_id']=$user_data->getId();
				$user['login_type'] = "google";
                $user['image']= $user_data->getAvatar();
                $user['role_id']=3;
				$user_kyc['f_name'] =$user_data->getName();
                $existing_user=User::where('social_id',$user['social_id'])->first();
                if(!empty($existing_user))
                {
                    Auth::login($existing_user);
                   if(count($cart_data)>0)
					{
						return redirect('checkout');
					}
		            else
					{
				        return redirect("/");
					}
                }
                else
                {
                    $object=new User($user);
                    $object->save();
					$user_kyc['user_id']=$object->id;
					$object2 = new UserKyc($user_kyc);
                    $object2->save();
                    Auth::login($object);
                    if(count($cart_data)>0)
					{
						return redirect('checkout');
					}
		            else
					{
				        return redirect("/");
					}
                }
            }
            catch(\Exception $e)
            {
                return redirect("/");
            }
        }
    }
	
}