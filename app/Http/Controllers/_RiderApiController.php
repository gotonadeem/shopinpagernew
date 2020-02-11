<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\User;
use App\UserKyc;
use App\Order;
use App\Enquiry;
use App\Cms;
use App\UserAddress;
use App\UserLocation;
use App\DeliveryBoySetting;
use App\RiderCommission;
use App\PushNotification;
use DB;
use URL;
use Excel;
use Helper;
use Auth;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
class RiderApiController  extends Controller
{
     public function __construct()
      {
	   parent::__construct(); 
      }
      
	
	//forgot Password...........................................................................
     public function change_password(Request $request)
      {
		$user = array(
            'user_id'    => $request->input('user_id'),
            'old_password'    => $request->input('old_password'),
            'new_password'    => $request->input('new_password'),
        );
        $rules = array(
            'user_id'    =>   'required',
            'old_password'    =>   'required',
            'new_password'    =>   'required',
            );
        $validator = Validator::make($user,$rules);
        if ($validator->fails()) {
             return Response::json(array(
                'status_code' => 0,
                'message' => 'validation error',
                'error_message'=>$validator->errors()->first(),
            ), 200);
        }else{
             if(User::where('id', $request->input('user_id'))->count()>0)
			 {   $usersData=array();
				 if(User::where('id', $request->input('user_id'))->where('simple_pass', $request->input('old_password'))->count()>0)
				 { 
     			 
					 $usersData['password'] =    Hash::make($user['new_password']);
					 $usersData['simple_pass'] =    $user['new_password'];
						$user = User::findOrFail($request->input('user_id'));
						$user->fill($usersData)->save();
						
						 return Response::json(array(
						'status_code' => 1,
						'message' => 'Password has been reset successfully',
						'error_message'=>"Password has been reset successfully",
					  ), 200);
                 }
                 else
				 {
						  return Response::json(array(
						'status_code' => 0,
						'message' => 'Old password does not matched',
						'error_message'=>"Old password does not matched",
					  ), 200);
				 }					 
			 }
             else
			 {
					 return Response::json(array(
					'status_code' => 0,
					'message' => 'User Does not exists',
					'error_message'=>"User Does not exists",
				    ), 200); 
			 }				 
			
        }
    }

	
	//forgot Password...........................................................................
     public function forgot_password(Request $request)
      {
		$otp= rand(123,999).rand(12,99);
        $user = array(
            'otp'    => $otp,
            'mobile'    => $request->input('mobile'),
        );
        $rules = array(
            'mobile'    =>   'required',
            );
        $validator = Validator::make($user,$rules);
        if ($validator->fails()) {
             return Response::json(array(
                'status_code' => 0,
                'message' => 'validation error',
                'error_message'=>$validator->errors()->first(),
            ), 200);
        }else{
			  $data=User::where('mobile', $request->input('mobile'))->pluck('id')->toArray();
			  if(count($data)>0)
			  {
					DB::table('users')->where('mobile', $request->input('mobile'))->update(['otp' =>  $otp]);			
					$mmsg=" Use $otp as one time password(OTP) forgot password.  Do not share this OTP to anyone for security reasons.";
					Helper::send_msg($user['mobile'],$mmsg);	
					return Response::json(array(
						'status_code' => 1,
						'message' => 'successfully resend',
						'otp_code' => $otp,
						'user_id' => $data[0],
						'error_message'=>"Resend successfully",
					), 200);
			  }
			  else
			  {
					return Response::json(array(
						'status_code' => 0,
						'message' => 'Your account does not exists',
						'error_message'=>"Your account does not exists",
					), 200);  
			  }
        }
    }
	
	//forgot Password...........................................................................
     public function reset_password(Request $request)
      {
		$user = array(
            'otp'    => $request->input('otp'),
            'user_id'    => $request->input('user_id'),
            'password'    => $request->input('password'),
        );
        $rules = array(
            'user_id'    =>   'required',
            'password'    =>   'required',
            'otp'    =>   'required',
            );
        $validator = Validator::make($user,$rules);
        if ($validator->fails()) {
             return Response::json(array(
                'status_code' => 0,
                'message' => 'validation error',
                'error_message'=>$validator->errors()->first(),
            ), 200);
        }else{
            //DB::table('users')->where('mobile', $request->input('mobile'))->update(['otp' =>  $otp]);
             if(User::where('otp', $request->input('otp'))->where('id', $request->input('user_id'))->count()>0)
			 {   $usersData=array();
				 $usersData['password'] =    Hash::make($user['password']);
                 $usersData['simple_pass'] =    $user['password'];
			     //User::where('otp', $request->input('otp'))->where('id', $request->input('user_id'))->update($usersData);
				    $user = User::findOrFail($request->input('user_id'));
                    $user->fill($usersData)->save();
					
					 return Response::json(array(
					'status_code' => 1,
					'message' => 'Password has been reset successfully',
					'error_message'=>"Password has been reset successfully",
				  ), 200);				 
			 }
             else
			 {
					 return Response::json(array(
					'status_code' => 0,
					'message' => 'Either does not exists or otp unmatched',
					'error_message'=>"Either does not exists or otp unmatched",
				    ), 200); 
			 }				 
			
        }
    }
  

	//user login....................................................................................
	    public function api_login(Request $request){
			$input=json_decode($request->getContent(), true);
			     $email = $input['email'];
			     $password = $input['password'];
			     $device_token = $input['device_token'];
		         $data= User::where('email', $email)->where('simple_pass', $password)->where('role_id',4)->first();
				  if(count((array)$data)>0)
				  {
						  if($data['banned']==1)
							{
								 return Response::json(array(
									'status_code' => 0,
									'message' => 'Your account has been blocked or unverified',
									'error_message'=>'Your account has been blocked or unverified',
								), 200);
							}
							else
							{	
						       $query = \DB::table("users")
								->join('user_kyc', 'users.id', '=', 'user_kyc.user_id')
								->select('users.username','users.device_token','users.id','users.mobile','users.unique_code as employee_no','users.email','user_kyc.profile_image','user_kyc.city_id')
								->where('users.id',$data->id)->first();
								
						               DB::table('users')->where('id',$data->id)->update(['device_token'=>$device_token,'login_time'=>date('h:i')]);
										return Response::json(array(
										'status_code' => 1,
										'message' => 'Loggged in successfully',
										'error_message'=>"Loggged in successfully",
										'img_path' => url('/')."/public/admin/uploads/seller/",
										'data'=>$query,
									), 200);
							}
				  }
				  else
				  {
							  return Response::json(array(
								'status_code' => 0,
								'message' => 'Invalid email or password',
								'error_message'=>'Invalid email or password',
								'data'=>null
							), 200);
				  }
        
       
    }
	
	   //user details....................................................................................
	    public function get_user(Request $request){
			$input=json_decode($request->getContent(), true);
			     $user_id = $input['user_id'];
		         $data= User::with('user_kyc')->where('id', $user_id)->first();
                 if(count((array)$data)>0)
				 {					 
				return Response::json(array(
							'status_code' => 1,
							'message' => 'User details',
							'error_message'=>'User details',
							'data'=>$data
 						), 200);
                 }
                 else
                 {
					return Response::json(array(
							'status_code' => 0,
							'message' => 'User details',
							'error_message'=>'User details',
							'data'=>null
 						), 200); 
				 }					 
    }
	
	//get commission....................................................................................
	    public function get_commission(Request $request){
			$input=json_decode($request->getContent(), true);
			     $user_id = $input['user_id'];
		         $deposit= RiderCommission::where('user_id', $user_id)->where('type', 'deposit')->sum('amount');
		         $withdraw= RiderCommission::where('user_id', $user_id)->where('type', 'withdraw')->sum('amount');
                				 
				 return Response::json(array(
							'status_code' => 1,
							'message' => 'User details',
							'error_message'=>'User details',
							'data'=>round($deposit-$withdraw,2),
 						), 200);
               		 
    }
	
	
	//get commission....................................................................................
	    public function get_commission_wallet(Request $request){
			$input=json_decode($request->getContent(), true);
			     $user_id = $input['user_id'];
		         $data= RiderCommission::with("order",'order.seller_kyc','order.address')->where('user_id', $user_id)->get();			 
				 $list=array();
				 $sum= 0;
				 foreach($data as $vs)
				 {
					$array= array();
					$array['user_id']=$vs->user_id;
					$array['amount']=$vs->amount;
					$array['order_id']=$vs->order_id;
					$array['payment_amount']=$vs->payment_amount;
					$array['delivery_time']=$vs->order->delivery_time;
					$array['delivery_date']=$vs->order->delivery_date;
					$array['from_address']=$vs->order->seller_kyc->address_1;
					$array['to_address']=$vs->order->address->house.",".$vs->order->address->landmark.",".$vs->order->address->street.",".$vs->order->address->city.",".$vs->order->address->state;
					$list[]= $array;
					$sum= $sum+$vs->amount;
				 }
				 
				 return Response::json(array(
							'status_code' => 1,
							'total' => $sum,
							'message' => 'User List',
							'error_message'=>'User List',
							'data'=>$list,
 						), 200);
               		 
    }
	//get commission....................................................................................
	public function get_order_history(Request $request){
		$input=json_decode($request->getContent(), true);
		$rider_id = $input['user_id'];
		$data= Order::with('order_meta_data','seller_kyc','address')->where('delivery_boy_id', $rider_id)->get();
		$list=array();
		foreach($data as $vs)
		{
			$array= array();
			$array['user_id']=$vs->user_id;
			$array['order_id']=$vs->order_id;
			$array['total_amount']= sprintf ("%.2f",(float)$vs->total_amount+(float)$vs->shipping_charge);
			$array['payment_mode']= $vs->payment_mode;
			$array['delivery_type']= $vs->delivery_type;
			$array['delivery_time']= $vs->delivery_time;
			$array['delivery_date']= $vs->delivery_date;
			$array['shipped_date']= $vs->shipped_date;
			$array['from_address']= $vs->seller_kyc->address_1;
			$array['to_address']=$vs->address->house.",".$vs->address->landmark.",".$vs->address->street.",".$vs->address->city.",".$vs->address->state;
			$list[]= $array;
		}

		return Response::json(array(
			'status_code' => 1,
			'message' => 'Order List',
			'error_message'=>'Order List',
			'data'=>$list,
		), 200);

	}
	//get commission....................................................................................
	public function get_today_commission(Request $request){
		$input=json_decode($request->getContent(), true);
		$user_id = $input['user_id'];
		$todayDate = date('Y-m-d');
		$data= RiderCommission::with("order",'order.seller_kyc','order.address')->where('user_id', $user_id)->whereDate('created_at','=',$todayDate)->get();
		$list=array();
		$sum= 0;
		foreach($data as $vs)
		{
			$array= array();
			$array['user_id']=$vs->user_id;
			$array['amount']=$vs->amount;
			$array['order_id']=$vs->order_id;
			$array['payment_amount']=$vs->payment_amount;
			$array['delivery_time']=$vs->order->delivery_time;
			$array['delivery_date']=$vs->order->delivery_date;
			$array['from_address']=$vs->order->seller_kyc->address_1;
			$array['to_address']=$vs->order->address->house.",".$vs->order->address->landmark.",".$vs->order->address->street.",".$vs->order->address->city.",".$vs->order->address->state;
			$list[]= $array;
			$sum= $sum+$vs->amount;
		}

		return Response::json(array(
			'status_code' => 1,
			'total' => $sum,
			'message' => 'Payment List',
			'error_message'=>'Payment List',
			'data'=>$list,
		), 200);

	}
	  //get notifications....................................................................................
	    public function get_notifications(Request $request){
			$input=json_decode($request->getContent(), true);
			     $user_id = $input['user_id'];
		         $data= PushNotification::where('user_id', $user_id)->get();			 
				 return Response::json(array(
							'status_code' => 1,
							'message' => 'User details',
							'error_message'=>'User details',
							'data'=>$data,
 						), 200);
               		 
    }
	
	   //change Status...............................................................
	    public function change_status(Request $request){
			$input=json_decode($request->getContent(), true);
			$user_id = $input['user_id'];
		    $response=DB::statement("UPDATE users SET is_active =(CASE WHEN (is_active = 1) THEN '0' ELSE '1' END) where id = $user_id");
		    $user= User::select('is_active')->where('id',$user_id)->first();
				
			return Response::json(array(
							'status_code' => 1,
							'status' => $user->is_active,
							'message' => 'Status has been changed',
							'error_message'=>'Status has been changed',
 						), 200);
               		 
            }

			//change Status.......................................
	    public function dashboard(Request $request){
				$input=json_decode($request->getContent(), true);
				$user_id = $input['user_id'];
				$order= Order::where('delivery_boy_id',$user_id)->where('status','delivered')->orderBy('id','desc')->first();
				$cod_payment= Order::where('delivery_boy_id',$user_id)->where('payment_mode','cod')->where('is_cod_submitted',0)->sum('total_amount');
				$user= User::select('login_time','is_active')->where('id',$user_id)->first();
				$today_orders= Order::where('delivery_boy_id',$user_id)->where(DB::raw("DATE(created_at) = '".date('Y-m-d')."'"))->get()->count();
				$today_payment= Order::select('distance')->where('delivery_boy_id',$user_id)->where(DB::raw("DATE(created_at) = '".date('Y-m-d')."'"))->get();
				$sum=0;
				$data= DeliveryBoySetting::first();
				foreach($today_payment as $vs)
				{
					$sum= $sum+($vs->distance*$data->per_km);
				}
				return Response::json(array(
								'status_code' => 1,
								'current_completed_order' =>$order,
								'login_time' =>$user->login_time,
								'cod_amount' =>sprintf ("%.2f",$cod_payment),
								'today_order_count' =>$today_orders,
								'today_payment' =>$sum,
								'status' =>$user->is_active,
								'message' => 'Status has been changed',
								'error_message'=>'Status has been changed',
							), 200);  		 
            }
			
	    //cod List....................................
	    public function cod_list(Request $request){
				$input=json_decode($request->getContent(), true);
				$user_id = $input['user_id'];
				$cod_payment= Order::with('seller_kyc','address')->where('delivery_boy_id',$user_id)->where('payment_mode','cod')->where('is_cod_submitted',0)->where('status','delivered')->get();
				return Response::json(array(
								'status_code' => 1,
								'cod_list' =>$cod_payment,
								'message' => 'List of Order',
								'error_message'=>'List of Order',
							), 200);
               		 
            }

			//cod List....................................
	    public function accept_order(Request $request){
				$input=json_decode($request->getContent(), true);
				$user_id = $input['user_id'];
				$status = $input['status'];
				$order_id = $input['order_id'];
				$seller_id = $input['seller_id'];
				Db::table('delivery_boy_notifications')->where('delivery_boy_id',$user_id)->where('seller_id',$seller_id)->where('order_id',$order_id)->where('delivery_boy_id',$user_id)->update(['status'=>$status]);
				Db::table('order_metas')->where('seller_id',$seller_id)->where('order_id',$order_id)->update(['delivery_boy_id'=>$user_id]);
				return Response::json(array(
								'status_code' => 1,
								'message' => "Order has been $status successfully",
								'error_message'=>"Order has been $status successfully",
							), 200);
               		 
            }
			
			function get_item_details($id,$seller_id)
			{
				$query = \DB::table("order_metas")->select('product_name','product_image','qty')
								->where('order_id',$id)
								->where('seller_id',$seller_id)->get();
				$dataList=array();
				foreach($query as $vs)
				{
					$data=array();
					$data['product_name']=$vs->product_name;
					$data['product_image']=$vs->product_image;
					$data['qty']=$vs->qty;
					$dataList[]=$data;
				}				
				return 	$dataList;			
			}

			//cod List....................................
	    public function assigned_order(Request $request){
				$input=json_decode($request->getContent(), true);
				$query = \DB::table("delivery_boy_notifications")
								->join('orders', 'orders.id', '=', 'delivery_boy_notifications.order_id')
								->join('user_addresses', 'orders.address_id', '=', 'user_addresses.id')
								->join('user_kyc', 'orders.seller_id', '=', 'user_kyc.user_id')
								->join('users', 'orders.user_id', '=', 'users.id')
								->select('orders.id','orders.order_id','orders.payment_mode','orders.delivery_date','orders.delivery_time','user_kyc.user_id as seller_id','user_kyc.f_name','user_kyc.l_name','user_kyc.address_2',
								'user_addresses.lattitude as user_lat','user_addresses.longitude as user_long','user_addresses.house','user_addresses.pincode','user_addresses.street','user_addresses.city','user_addresses.state','user_kyc.lattitude as seller_lat','user_kyc.longitude as seller_long','users.mobile','users.username as name')
								->where('delivery_boy_notifications.status','accepted')
								->where('delivery_boy_notifications.delivery_boy_id',$input['user_id'])->get();
				$dataList=array();
				foreach($query as $vs)
				{
					$data=array();
					$data['id']=$vs->id;
					$data['order_id']=$vs->order_id;
					$data['payment_mode']=$vs->payment_mode;
					$data['delivery_date']=$vs->delivery_date;
					$data['delivery_time']=$vs->delivery_time;
					$data['seller_name']=$vs->f_name." ".$vs->l_name;
					$data['user_lat']=$vs->user_lat;
					$data['user_long']=$vs->user_long;
					$data['seller_lat']=$vs->seller_lat;
					$data['seller_address']=$vs->address_2;
					$data['seller_long']=$vs->seller_long;
					$data['user_mobile']=$vs->mobile;
					$data['item_details']=$this->get_item_details($vs->id,$vs->seller_id);
					$data['user_name']=$vs->name;
					$data['user_address']=$vs->house.",".$vs->street.",".$vs->pincode.",".$vs->city.",".$vs->state;
					$dataList[]=$data;
				}
				return Response::json(array(
								'status_code' => 1,
								'data' =>$dataList,
								'message' => "List of assigned order",
								'error_message'=>"List of assigned order",
							), 200);
               		 
            }
}
?>