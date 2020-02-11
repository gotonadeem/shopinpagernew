<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\User;
use App\UserKyc;
use App\ReferralSetting;
use Validator;
use Response;
use Session;
use Hash;
use Helper;
use URL;
use DB;
class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function register()
    {
        return view('front.user.register');
    }
	function mobileViewChat()
    {
        return view('front.mobile_view_chat');
    }

    function login(Request $request)
    {
        $checkout = $request->input('checkout');
        if($checkout ==1){
            Session::set('from_checkout',1);
        }else{
            Session::set('from_checkout',0);
        }

        return view('front.user.login');
    }
    function login_user(Request $request)
    {
        $checkoutSession= Session::get('from_checkout');
        $mobile = $request->input('login_mobile');
        $password = $request->input('login_password');

        $data=User::where('mobile',$mobile)->first();
        if($data['banned']==1)
        {

            Session::flash('error_message', 'Your account has been blocked');
            if($checkoutSession == 1){
                return redirect('/user-login?checkout=1');
            }
            return redirect('/user-login');
        }
        else
        {
            if (Auth::attempt(array('mobile' => $mobile,'role_id' =>3, 'password' => $password,'activated'=>1,'banned'=>0))) {

                Session::flash('success_message','Login Successfull !');
                if($checkoutSession == 1){
                    return redirect('/checkout');
                }
                return redirect('/');
            } else {
                Session::flash('error_message', 'Invalid mobile or password');
                if($checkoutSession == 1){
                    return redirect('/user-login?checkout=1');
                }
                return redirect('/user-login');
            }
        }
    }

	function login_popup(Request $request)
    {
        $checkoutSession= Session::get('from_checkout');
        $mobile = $request->input('mobile');
        $password = $request->input('password');

        $data=User::where('mobile',$mobile)->first();
        if($data['banned']==1)
        {

            Session::flash('error_message', 'Your account has been blocked');
            // if($checkoutSession == 1){
                // return redirect('/user-login?checkout=1');
            // }
            // return redirect('/user-login');
        }
        else
        {
            if (Auth::attempt(array('mobile' => $mobile,'role_id' =>3, 'password' => $password,'activated'=>1,'banned'=>0))) {

                 echo json_encode(array(
					   'success' => true,
					   'message'=>"Login successfully"
					));
            } else {
                 echo json_encode(array(
					   'fail' => true,
					   'message'=>"Invalid mobile or password"
					));
            }
        }
    }
    function register_user(Request $request)
    {
        //dd('dsdsd');
        $userData = array(
            'f_name'      => $request->input('fname'),
            'l_name'      => $request->input('lname'),
            'email'       => $request->input('email'),
            'username'    => $request->input('fname')." ".$request->input('lname'),
            'mobile'      => $request->input('mobile'),
            'login_type'  =>'email',
            'role_id'     => 3,

        );
        $rules = array(
            'f_name'      =>  'required|max:20|regex:/^[a-zA-Z .\']+$/',
            'l_name'     =>   'required|max:20|regex:/^[a-zA-Z .\']+$/',
            //'email'     =>    'required|email|unique:users',
            'mobile'    =>    'required|numeric|digits_between:8,10|unique:users,mobile',

        );
        $validator = Validator::make($userData,$rules);
        if($validator->fails())
            return redirect('/register-user')->withInput()->withErrors($validator);

        else {
            //check referral code
            $reffCode = $request->input('reff_code');
            if($reffCode){
                $ifRefExists = User::where('reff_code',$reffCode)->where('is_otp_varified','1')->first();
                if($ifRefExists){
                    $userData['ref_by']= $ifRefExists->reff_code;
                    $userData['referrer_id']= $ifRefExists->id;
                }else{
                    Session::flash('error_message', 'Invalid Referral Code');
                    return redirect ('register-user');
                }

            }
            $userData['otp']= rand(12,66).rand(67,89);
            Session::set('user_data',$userData);
            Session::set('user_mobile',$userData['mobile']);
            $code = $userData['otp'] ;

            $mmsg=" Use ".$userData['otp']." as one time password(OTP) to verify your account.  Do not share this OTP to anyone for security reasons.";
            Helper::send_msg($userData['mobile'],$mmsg);

            /*Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
                $message
                    ->to($emailData['to'])
                    ->from($emailData['from'])
                    ->subject($emailData['subject']);

            });*/
            /* Mail Code End */
            Session::flash('success_message', 'Successfully ! Otp Sent');
            return redirect ('/verify-otp')->with('code',$code);
        }
    }
	
	
	function submit_popup(Request $request)
    {
        //dd('dsdsd');
        $firstName = substr($request->input('fname'),0,2);
		$userData = array(
            'f_name'      => $request->input('fname'),
            'l_name'      => $request->input('lname'),
            'email'       => $request->input('email'),
            'username'    => $request->input('fname')." ".$request->input('lname'),
            'mobile'      => $request->input('mobile'),
            'login_type'  =>'email',
            'role_id'     => 3,
			'reff_code'=> $firstName.Helper::unique_code(4),

        );
        $rules = array(
            'f_name'      =>  'required|max:20|regex:/^[a-zA-Z .\']+$/',
            'l_name'     =>   'required|max:20|regex:/^[a-zA-Z .\']+$/',
            //'email'     =>    'required|email|unique:users',
            'mobile'    =>    'required|numeric|digits_between:8,10|unique:users,mobile',

        );
        $validator = Validator::make($userData,$rules);
        if($validator->fails())
        {    
		   echo json_encode(array(
						   'success' => false,
						   'message'=>"Fill all fields"
						   ));
	     }
        else {
            //check referral code
            $reffCode = $request->input('reff_code');
            if($reffCode){
                $ifRefExists = User::where('reff_code',$reffCode)->where('is_otp_varified','1')->first();
                if($ifRefExists){
                    $userData['ref_by']= $ifRefExists->reff_code;
                    $userData['referrer_id']= $ifRefExists->id;
                }else{
                      
					  echo json_encode(array(
							   'success' => false,
							   'message'=>"ReferralCode does not exists"
							   ));
                   }
            }
			
            $userData['otp']= rand(12,66).rand(67,89);
            Session::set('user_data',$userData);
            Session::set('user_mobile',$userData['mobile']);
            $code = $userData['otp'] ;

            $mmsg=" Use ".$userData['otp']." as one time password(OTP) to verify your account.  Do not share this OTP to anyone for security reasons.";
            Helper::send_msg($userData['mobile'],$mmsg);
            echo json_encode(array(
               'success' => true,
               'otp' =>  $userData['otp'],
               'message'=>"register successfully"
            ));
            /*Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
                $message
                    ->to($emailData['to'])
                    ->from($emailData['from'])
                    ->subject($emailData['subject']);

            });*/
            /* Mail Code End */
            //Session::flash('success_message', 'Successfully ! Otp Sent');
            //return redirect ('/verify-otp')->with('code',$code);
        }
    }

    public function verify_otp_code(){
        return view('front.user.otp_verification');
    }


    function verify_otp(Request $request)
    {
        $data=Session::get('user_data');
        if($data['otp']==$request->input('otp'))
        {
            $referrerId = 0;
            $ref_by = 0;
            if(isset($data['referrer_id'])){
                $referrerId = $data['referrer_id'];
                $ref_by = $data['ref_by'];
            }

            $firstName = substr($data['f_name'], 0, 2);
            $data['reff_code'] = $firstName.Helper::unique_code(4);
            $data['ref_by'] = $ref_by;
            $password = CommonController::str_random(3) . rand(123, 456);
            $data['is_otp_varified'] = '1';
            $data['password'] = Hash::make($password);
            $data['simple_pass'] = $password;
            $obj= new User($data);
            $obj->save();
            if ($obj->id) {
                $data['user_id']=$obj->id;
                $objKyc= new UserKyc($data);
                $objKyc->save();
                $data= User::where('id',$obj->id)->first();
                $mmsg = "Hi " . $data['username']. ", \n  Welcome to Shopinpager\n";
                $mmsg .= "Your Account has been created successfully. Please login using below mobile and password \n";
                $mmsg .= "Your mobile number is: " .$data['mobile'] . "\n\n";
                $mmsg .= "Your Password is : " . $password . "\n\n";

                $mmsg .= "\n\n Thanks Shopinpager";
                Helper::send_msg($data['mobile'],$mmsg);
                 if($referrerId){
                     //update referrer amount wallet balance.....
                     $referreWallet['user_id'] =$referrerId;
                     $referreWallet['ref_id'] =$obj->id;
                     $referreWallet['amount'] = ReferralSetting::first()->referrer_amount;
                     $referreWallet['type'] = 'deposit';
                     $referreWallet['payment_type'] = 'refer_and_earn';
                     DB::table('wallets')->insert($referreWallet);
                     //update referral amount wallet balance.....
                     $referreWallet['user_id'] = $obj->id;
                     $referreWallet['ref_id'] = $referrerId;
                     $referreWallet['amount'] = ReferralSetting::first()->referral_amount;
                     $referreWallet['type'] = 'deposit';
                     $referreWallet['payment_type'] = 'refer_and_earn';
                     DB::table('wallets')->insert($referreWallet);

                 }

                 Auth::login($data);
                //Session::flash('success_message','Account created Successfully !!');
				 echo json_encode(array(
					'success' => true,
					'message'=>"Account created Successfully"
				));
                //return redirect('/');
            }
        }
        else
        {

             //Session::flash('error_message','Invalid OTP!!');
			 echo json_encode(array(
					'fail' =>true,
					'message'=>"Invalid OTP!!"
				));
            //return redirect('/verify-otp');
        }
    }

    function resend_otp()
    {
        $data=Session::get('user_data');
        $mobile=Session::get('user_mobile');
        //dd($data);
        $data['otp']= rand(12,66).rand(67,89);
        Session::set('user_data',$data);
        /*$mmsg=" Use ".$data['otp']." as one time password(OTP) to verify your account.  Do not share this OTP to anyone for security reasons.";
        Helper::send_msg($mobile,$mmsg);*/
        echo json_encode(array(
            'success' => true,
            'otp' =>  $data['otp'],
            'message'=>"Login Successfully"
        ));

        Session::flash('success_message', 'Successfully ! Otp Sent ');
    }


    /*{
        $mobile = $request->input('mobile');
        $user= User::where('mobile',$mobile)->where('role_id','3')->get()->count();
        if($user>0) {
            //
            $userData['otp']= rand(12,66).rand(67,89);
            Session::set('user_data',$userData);
            Session::set('user_mobile',$mobile);
            $mmsg=" Use ".$userData['otp']." as one time password(OTP) to verify your account.  Do not share this OTP to anyone for security reasons.";
            Helper::send_msg($mobile,$mmsg);

            echo json_encode(
                array("success" => true,'otp'=>$userData['otp']));
        } else {
            echo json_encode(
                array("error" => true,'message'=>"User does not exists"));
        }
    }*/



    function verify_login_otp(Request $request)
    {
        $data=Session::get('user_data');
        if($data['otp']==$request->input('otp'))
        {
            $mobile=Session::get('user_mobile');
            $data= User::where('mobile',$mobile)->first();
            Auth::login($data);
            echo json_encode(array(
                'success' => true,
                'message'=>"Login Successfully"
            ));

        }
        else
        {
            echo json_encode(array(
                'fail' => true,
                'message'=>"Invalid OTP"
            ));
        }
    }

    function change_password()
    {
        return view('front.user.change_password');
    }
    function verifyResetMobile(Request $request){

        $mobile = $request->input('mobile');
            $check = User::where('mobile',$mobile)->first();
            if($check){
                $userData['otp']= rand(12,66).rand(67,89);
                $userData['mobile']= $mobile;

                $mmsg=" Use ".$userData['otp']." as one time password(OTP) to verify your account.  Do not share this OTP to anyone for security reasons.";
                Helper::send_msg($mobile,$mmsg);
                Session::set('user_data',$userData);
                Session::flash('success_message', 'Otp sent successfully!');
                return redirect('reset-password-otp-verify');
            }else{
                Session::flash('error_message', 'Invalid mobile number!');
                return redirect('reset-password');
            }

    }
    function passwordOtpVerify()
    {

        return view('front.user.password_otp_verify');
    }
    function resetPasswordOtpVerify(Request $request){
        $otp =$request->input('otp');
        $data=Session::get('user_data');
        $mobile=$data['mobile'];
        if($data['otp']==$otp) {
            $password = CommonController::str_random(3) . rand(123, 456);
            $updateData['password'] = Hash::make($password);
            $updateData['simple_pass'] = $password;
            $response = DB::table('users')->where('mobile', $mobile)->update($updateData);
            if ($response) {

                $data = User::where('mobile', $mobile)->first();
                $mmsg = "Hi " . $data['username'] . ", \n  Welcome to Shopinpager\n";
                $mmsg .= "Your new password. Please login using below password \n";
                $mmsg .= "Your mobile number is: " . $data['mobile'] . "\n\n";
                $mmsg .= "Your Password is : " . $password . "\n\n";
                $mmsg .= "\n\n Thanks Shopinpager";
                Helper::send_msg($data['mobile'], $mmsg);
                Session::flash('success_message', 'Password Send Successfully! Please login');
                return redirect('user-login');
            }
        }else{
            Session::flash('error_message', 'Invalid Otp!');
            return redirect('reset-password-otp-verify');
        }
    }
    public function update_password(Request $request)
    {
        //print_r($request->all()); die;

        $validator = Validator::make($request->all(),
            [
                'new_password' => 'required|min:6|max:20',
                'password_confirmation' => 'required|max:20|min:6',
            ]);
        if ($validator->fails())
        {
            return redirect('change-password')->withInput()->withErrors($validator);
        }
        else
        {
            $user= new User();
            $user->simple_pass =$request->new_password;
            $user->password = Hash::make($request->new_password);
            $user->save();
            Session::flash('success_message', 'Successfully updated password!');
            return redirect('change-password');
        }
    }


    function logout()
    {
        Auth::logout();
        return redirect(URL::to('/'));
    }

    public function sendVerifyLink(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
        ]);

        //check user validations
        if ($validator->fails()) {
            echo json_encode(
                array("error" => true));

        } else {
            $user = User::where('email', $request->email)->first();

            if (!empty($user)) {

                $id = $user->id;
                $link = url('forgot-changepassword/' . encrypt($id));

                /* Mail Code Start */
                $emailData = array(
                    'to' => $request->email,
                    'from' => 'support@saleplus.in',
                    'subject' => 'Reset Password',
                    'view' => 'user.forgot',
                    'content' => "Please click on below URL or paste into your browser to reset your Password \n\n " . $link . "\n" . "\n\nThanks\nAdmin Team"
                );

                Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
                    $message
                        ->to($emailData['to'])
                        ->from($emailData['from'])
                        ->subject($emailData['subject']);
                });
                /* Mail Code End */
                echo json_encode(
                    array("success" => true));
                //Session::flash('success_message', 'An email with the reset password link has been sent to you. Please check your inbox or spam folder');
                //return redirect('admin/forgot-password');
            } else {
                echo json_encode(
                    array("error" => true));
                //Session::flash('error_message', 'This email id is not registered');
                // return redirect('admin/forgot-password');
            }
        }
    }


    public function forgot_changepassword($token) {



        $id = decrypt($token);
        $user = User::find($id);

        if (!empty($user)) {
            Session::set('reset-password', $user->id);
            return view('front.user.forgot_password');
        } else {
            Session::flash('error_message', 'Your link is not verify. Please correct your link..!!');
            return redirect('/');
        }
    }

    public function reset_password(){
    return view('front.user.reset');
 }  




    public function resetPassword(Request $request) {
        $data = $request->all();
        $rules = array(
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        );

        // Create a new validator instance.
        $validator = Validator::make($data, $rules, [
            'password.confirmed' => 'Passwords does not matched.',
        ]);
        $id=Session::get('reset-password');
        if ($validator->passes()) {
            $user = User::find($id);
            $user->password = Hash::make($data['password']);
            $user->simple_pass =$data['password'];
            $user->save();
            // print_r($user_found);exit();
            Session::set('reset-password', '');
            Session::flash('success_message', "Password successfully reset");
            return  redirect()->back();
        }
        Session::flash('error_message', "Please Try Again");
        return redirect()->back()->withErrors($validator);
    }


}
?>