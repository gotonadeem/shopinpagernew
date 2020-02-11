<?php
namespace App\Http\Controllers;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Auth;
use App\User;
use Session;
use Validator;
use App\Country;
use App\Slider;
use App\Category;
use App\Gallery;
use App\Product;
use App\Banner;
use App\GeneralSetting;
use App\SellerJoinusCms;
use App\State;
use App\Section;
use App\ContactUs;
use App\Question;
use App\MustSee;
use App\Cms;
use App\Faq;
use App\City;
use App\Brand;
use App\AdminNotification;
use Helper;
use App\UserKyc;
use Hash;
use DB;
class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * index()
     * show home page of roommate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Developer :
     */

    public function home(Request $request)
    {
        $slider_list= Slider::with('main_category')->where('status',1)->where('type','slider')->get();
        $firstSlider = Banner::with('main_category')->where('status',1)->where('type','slider_first')->get();
        $secondSlider = Banner::with('main_category')->where('status',1)->where('type','slider_second')->get();
        $thirdSlider = Banner::with('main_category')->where('status',1)->where('type','slider_third')->get();
        $firstBanner = Banner::with('main_category')->where('status',1)->where('type','banner_first')->get();
        $secondBanner = Banner::with('main_category')->where('status',1)->where('type','banner_second')->get();
        $footerBanner = Banner::with('main_category')->where('status',1)->where('is_special',0)->where('type','banner_footer')->orderBy('id','DESC')->take(4)->get();
        $is_special = Banner::with('main_category')->where('status',1)->where('is_special',1)->first();
        $brand = Brand::where('status',1)->where('is_home',1)->get();
        $sessionPincode = session('pincode');
        if($sessionPincode){
            $category = \DB::table("user_kyc")
                ->join('products', 'products.user_id', '=', 'user_kyc.user_id')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->select('categories.id as cat_id','categories.name as cat_name','categories.slug as cat_slug')
                ->whereRaw("find_in_set($sessionPincode,user_kyc.delivery_pincode)")
                ->where('categories.is_home','1')
                ->orderBy('categories.position')->distinct('cat_id')->take(6)->get();
        }else{
            $category = \DB::table("categories")
                ->select('categories.id as cat_id','categories.name as cat_name','categories.slug as cat_slug')
                ->take(6)->get();
        }
        return view('front.index.index', compact('slider_list','firstSlider','secondSlider','thirdSlider','firstBanner','secondBanner','footerBanner','is_special','category','brand'));


    }

    //Added by nadeem, To check delivery pincode at home page.
    public function checkPinAvailability(Request $request){
        try {
            $pincode = $request->input('pincode');
            if(!empty($pincode)){
                $data = \DB::table("users")
                    ->join('user_kyc', 'user_kyc.user_id', '=', 'users.id')
                    //->select('user_id','city_id','state_id')
                    ->whereRaw("find_in_set($pincode,user_kyc.delivery_pincode)")
                    ->where('users.verify_status','verified')
                    ->get();
                if($data){
                    //To get city and state by pincode.
                    $cityStatedata = DB::table('pincodes')
                        ->join('cities', function ($join) use ($pincode) {
                            $join->on('pincodes.city_id', '=', 'cities.id')
                                ->where('pincodes.pincode', '=', $pincode);
                        })
                        ->join('states', 'cities.state_id', '=', 'states.id')
                        ->select('cities.name as city_name', 'cities.id as city_id','states.name as state_name')
                        ->first();

                    if($data){
                        //set data in session
                        $request->session()->put('pincode', $pincode);
                        $request->session()->put('city_id', $cityStatedata->city_id);
                        $request->session()->put('city_name', $cityStatedata->city_name);
                        $request->session()->put('state_name', $cityStatedata->state_name);
                        echo json_encode(array('status'=>true,'message'=>'successfully','city_name'=>$cityStatedata->city_name,'state_name'=>$cityStatedata->state_name));
                    }else{
                        echo json_encode(array('status'=>false,'message'=>'Sorry, city not found.'));
                    }
                }else{
                    echo json_encode(array('status'=>false,'message'=>'Sorry, Delivery is not avaialble at this pincode'));
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    public function index()
    {

        if(Auth::user())
        {
            if(Auth::user()->role_id==3)
            {
                Auth::logout();
                return redirect('seller/login');
            }
            if(Auth::user()->verify_status=="verified"):
                return redirect('seller/dashboard');
            else:
                return redirect('seller/complete-profile');
            endif;
        }
        else
        {
            return view('login.index');
        }
    }

    public function login(Request $request)
    {

        $mobile =$request->input('mobile');
        $password = $request->input('password');
        $data=User::where('mobile',$mobile)->first();
        if($data['banned']==1)
        {
            Session::flash('error_message', 'Your account has been blocked');
            return redirect('/seller/login');
        }
        else
        {
            if (Auth::attempt(array('mobile' => $mobile, 'password' => $password,'activated'=>1,'banned'=>0,'role_id'=>2))) {
                if(Auth::user()->verify_status=="verified"):
                    return redirect('seller/dashboard');
                else:
                    return redirect('seller/complete-profile');
                endif;

            } else {
                Session::flash('error_message', 'Invalid mobile or password');
                return redirect('/seller/login');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        //return redirect(\URL::previous());
        return redirect('/seller/login');
    }


    /*public function open_source()
    {
        $content= Cms::find(2);
       return Response::json(array('status' => 1, 'data'=>$content), 200);
    }*/

    /**
     * termsAndConditions()
     * show terms and condition page of roommate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Developer : Arif Khan
     */
    public function term_condition()
    {
        $content= Cms::find(2);
        return Response::json(array('status' => 1, 'data'=>$content), 200);
    }

    public function about_us()
    {
        $content= Cms::find(7);
        return Response::json(array('status' => 1, 'data'=>$content), 200);
    }

    /**
     * privacyPolicy()
     * show privacy policy page of roommate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Developer : Arif Khan
     */
    public function privacy_policy()
    {
        $content= Cms::find(3);
        return Response::json(array('status' => 1, 'data'=>$content), 200);
        //return view('home.privacy_policy')->with('content',$content);
    }

    /**
     * advancedSearch()
     * @return $this
     */
    public function property_details()
    {
        return view("home.property.details");
    }

    public function subscribe(Request $request)
    {
        $data= $request->all();
        $this->model->setRules();
        $this->rules = $this->model->getRules();
        $validator = Validator::make($request->all(), $this->rules['store']);
        if ($validator->fails()) {
            // print_r($validator->errors()->all());die;
            return redirect('/')
                ->withErrors($validator);
        }else{
            $this->model->save($data);
            // redirect
            Session::flash('success_message', 'Successfully subscribed!');
            return redirect('/');
        }

    }

    public function subscribe_user(Request $request)
    {
        //echo $request->input('email');
        $userData = array(
            'email'     => $request->input( 'email'),

        );
        $rules = array(
            'email'     =>   'required|email|unique:subscribers',

        );
        //print_r($userData);die;
        $validator = Validator::make($userData,$rules);
        if($validator->fails())
            echo json_encode(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        else {
            if (Subscriber::create($userData)) {
                $desc="You have subscribed successfully";
                $subject='Subscribed Successfully!';
                $emailData = array(
                    'to'        => $userData['email'],
                    'from'      => env('MAIL_USERNAME'),
                    'subject'   => $subject,
                    'view'      => 'user.seller.subscribemailview',
                    'content'=>$desc
                );

                try{
                    Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
                        $message
                            ->to($emailData['to'])
                            ->from($emailData['from'])
                            ->subject($emailData['subject']);
                    });

                }catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                }

                echo json_encode(array(
                    'success' => true,
                ));
            }
        }

    }

    public function forget_password()
    {
        return view('user.forget_password');
    }

    public function sendVerifyLink(Request $request)
    {
        $response=array();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        //check user validations
        if ($validator->fails()){
            $response['error_message']='Email is required';
        }
        else
        {
            $user = User::where('email',$request->input('email'))->where('banned','0')->first();
            if(!empty($user))
            {
                $id = $user->email;
                $random_number = rand(1,999999);
                $password_reset_token =  Hash::make($random_number);
                $link = url('seller/forgot-verify?email='.encrypt($id).'&hash='.$password_reset_token);
                $user->reset_password_token = $random_number;
                $user->save();


                /* Mail Code Start */
                $emailData = array(
                    'to'        => $request->email,
                    'from'      => 'Shopinpager@gmail.com',
                    'subject'   => 'Reset Password',
                    'view'      => 'user.password_reset_link',
                    'content'=>"Hi ".$user->fname.", <br><br><br> Please click on below URL or paste into your browser to reset your Password <br><br> ".$link."\n"."<br><br> Thanks <br> Shopinpager Team"
                );

                Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
                    $message
                        ->to($emailData['to'])
                        ->from($emailData['from'])
                        ->subject($emailData['subject']);
                });
                /* Mail Code End */
                Session::flash('success_message','An email with the reset password link has been sent to you. Please check your inbox or spam folder');
                return redirect('seller/forget-password');
            }
            else
            {
                Session::flash('error_message','This email id is not registered');
                return redirect('seller/forget-password');
            }
        }
    }

    public function forgot_verify(Request $request)
    {

        $token = $request->hash;
        $email=decrypt($request->email);
        $user = User::where('email',$email)->first();
        if (Hash::check($user->reset_password_token, $token))
        {
            if (!empty($user)) {
                Session::set('reset-password', $user->id);
                return view('user.reset-password');
            }

        } else {
            Session::flash('error_message','Your link is expired now..!!');
            return redirect('/login');
        }
    }

    public function resetPassword(Request $request)
    {
        $data = $request->all();
        // print_r($data);die;
        $rules = array(
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        );

        // Create a new validator instance.
        $validator = Validator::make($data, $rules,[
            'password.confirmed' => 'Passwords does not matched.',
        ]);

        if ($validator->passes()) {

            $id = Session::get('reset-password');
            $user = User::find($id);
            $user->password = Hash::make($data['password']);
            $user->simple_pass = $data['password'];
            //$user->raw_password = $data['password'];
            $user->reset_password_token = 'Reset';
            $user->save();
            // print_r($user_found);exit();
            Session::set('reset-password', '');
            Session::set('emessage', 'Password successfully reset!');
            Session::flash('success_message', "Password successfully reset!");
            return redirect('/');

        }else{
            Session::flash('error_message', "Please Try Again");
            return redirect()->back()->withErrors($validator);
        }
    }
    public function get_state(Request $request)
    {
        $id=$request->input('id');
        $state_list= State::where('country_id',$id)->get();
        return view('seller.verify.state_ajax')->with('state_list',$state_list);
    }

    public function get_city(Request $request)
    {
        $id=$request->input('id');
        $city_list= City::where('state_id',$id)->where('status',1)->get();
        return view('seller.verify.state_ajax')->with('state_list',$city_list);
    }

    function join_us()
    {
        $countries= Country::where('id','101')->get();
        $state= City::with('state')->where('status',1)->groupBy('state_id')->get();
        $cms = SellerJoinusCms::first();
        return view('home.join_us',compact('countries','state','cms'));
    }

    function join_us_store(Request $request)
    {
        $users=array(
            'username'    => $request->input('name'),
            'mobile'    => $request->input('mobile'),
            'email'    => strtolower($request->input('email')),
            'role_id'     => 2,
        );
        //Added by nadeem
        $fullName = explode(" ", $request->input('name'));
        $num = count($fullName);
        if($num > 1)
        {
            $lastname = array_pop($fullName);
        }
        else
        {
            $lastname = '';
        }

        $firstname = implode(" ", $fullName);
        $user_kyc = array(
            'f_name'     => $firstname,
            'l_name'     => $lastname,
            'gender'     => $request->input('gender'),
            'country_id' => $request->input('country_id'),
            'city_id'    => $request->input('city_id'),
            'state_id'   => $request->input('state_id'),
            'address_2'    => $request->input('address_2'),
            'pincode'    => $request->input('pincode'),
			'business_name'    => $request->input('business_name'),
        );

        $rules = array(
            'name'   =>   'required',
            'mobile'     =>   'required|unique:users,mobile',
            'email'      =>   'required|unique:users,email',
            'pincode'    =>   'required',
            'address_2'    => 'required',
            'city_id'    =>   'required',
            'state_id'   =>   'required',
            'country_id' =>   'required',
        );

        $validator = Validator::make(Input::all(),$rules);
        if ($validator->fails()) {
            return redirect('join-as-seller')->withInput()->withErrors($validator);
        }else{
            $password=str_random(3).rand(123,456);
            $users['password'] =    Hash::make($password);
            $users['simple_pass'] =    $password;
            $user = new User($users);
            $user->save();
            $user_kyc['user_id']= $user->id;
            $userkyc = new UserKyc($user_kyc);
            $userkyc->save();
            //add notification for admin ..........
            $adminnotifyObj = new AdminNotification;
            $adminnotifyObj->int_val = $user->id;//seller  id
            $adminnotifyObj->type = 'seller_join';
            $adminnotifyObj->message = 'New Seller Register';
            $adminnotifyObj->save();

            $mmsg="Hi ".$request->input('name').", \n  Welcome to Shopinpager\n";
            $mmsg.="Your Account has been created successfully. Please login using below mobile and password \n";
            $mmsg.="Your mobile number is: ".($users['mobile'])."\n\n";
            $mmsg.="Your Password is : ".$password."\n\n";
            $mmsg.="Click on Below link to Login As seller \n";
            $mmsg.="https://www.shopinpager.com/seller/login \n";
            $mmsg.="\n\n Thanks Shopinpager";
            Helper::send_msg($users['mobile'],$mmsg);

            $msg="Hi ".$request->input('f_name').", <br><br>   Welcome to Shopinpager<br><br>";
            $msg.="Your Account has been created successfully. Please login using below mobile and password <br>";
            $msg.="Your mobile number is: ".$users['mobile']."<br><br>";
            $msg.="Your Password is : ".$password."<br><br>";
            $msg.="<a href='https://Shopinpager.com/seller/login'>Click</a> on Below link to login <br>";
            $msg.="<a href='https://Shopinpager.com/seller/login'>Login As seller</a><br>";
            $msg.="<br> <br>  Thanks Shopinpager";

            $emailData = array(
                'to'        => array(strtolower($request->input('email'))),
                'from'      => 'support@Shopinpager.in',
                'subject'   => 'Account Created',
                'view'      => 'email.verification-email',
                'content'=>$msg
            );
            Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
             $message
            ->to($emailData['to'])
            ->from($emailData['from'])
            ->subject($emailData['subject']);

            });


            Session::flash('success_message', 'You request has been submitted successfully.We will reach you shortly');
            return redirect("seller/login");
        }

    }
    /* public function seller_otp(){
        return view('home.seller_otp');
    }*/
    function help()
    {
        $must_see= MustSee::get();
        $how_to= Section::get();
        $contact_us= ContactUs::first();
        return view('mobile.help.index',compact('must_see','how_to','contact_us'));
    }

    function rate_list()
    {

        return view('mobile.help.rate');
    }

    function section_details($id)
    {
        $section_details= Section::where('id',$id)->first();
        $faq_list= Faq::with('question')->where('section_id',$id)->get();
        return view('mobile.help.details',compact('faq_list','section_details'));
    }

    function topic_details($id)
    {
        $question_details= Question::with('faq')->where('id',$id)->first();
        return view('mobile.help.inner',compact('question_details'));
    }
    function update_notify_view_status(Request $request){
        $seller_id = $request->input('sellerId');
        $update = DB::table('seller_notifications')->where('seller_id', $seller_id)->update(['status' => 1]);
        echo json_encode(array('status'=>1,'message'=>"updated successfully"));
    }
}