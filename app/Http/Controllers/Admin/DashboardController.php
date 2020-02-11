<?php

namespace App\Http\Controllers\Admin; //admin add

use App\Http\Requests;
use App\Http\Controllers\Controller;   // using controller class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use App\UserKyc;
use App\Admin;
use App\ActivationWallet;
use App\Product;
use App\Payment;
use App\Order;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Activity;
/**
 * Class DashController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**v
     * DashController constructor
     */
    public function __construct()
    {
        //$this->middleware('auth.admin:admin');
    }

    public function index(Request $request)
    {
         $total_users = User::where('role_id',3)->Join('user_kyc', 'user_kyc.user_id', '=', 'users.id')->count();
         $totalActiveUser = User::where('role_id',3)->where('banned',0)->Join('user_kyc', 'user_kyc.user_id', '=', 'users.id')->count();
         $totalInActiveUser = User::where('role_id',3)->where('banned',1)->Join('user_kyc', 'user_kyc.user_id', '=', 'users.id')->count();
         $total_seller = User::where('role_id',2)->count();
         $total_active_seller = User::where('role_id',2)->where('verify_status','verified')->count();
         $new_request_seller = User::where('role_id',2)->where('verify_status','requested')->count();
         $kyc_unvarified_seller = User::where('role_id',2)->where('verify_status','kyc_completed')->count();
         $total_product = Product::count();
         $total_varified_product = Product::where('is_admin_approved',1)->count();
         $total_unVarified_product = Product::where('is_admin_approved',0)->count();
         $totalOrder = Order::count();
         $totalPendingOrder = Order::where('status','pending')->count();
         $totalDeliveredOrder = Order::where('status','delivered')->count();
         $current_day = date("Y-m-d");
         $user_today = User::where('created_at','like', '%'.$current_day.'%')->count();
         $current_month = date("Y-m");
         $user_this_month=User::where('created_at','like', '%'.$current_month.'%')->count();
          return view('admin.dashboard.index')->with('total_users',$total_users)
                                           ->with('user_today',$user_today)
                                           ->with('totalActiveUser',$totalActiveUser)
                                           ->with('totalInActiveUser',$totalInActiveUser)
                                           ->with('user_this_month',$user_this_month)
                                           ->with('total_seller',$total_seller)
                                           ->with('total_active_seller',$total_active_seller)
                                           ->with('new_request_seller',$new_request_seller)
                                           ->with('total_varified_product',$total_varified_product)
                                           ->with('total_unVarified_product',$total_unVarified_product)
                                           ->with('kyc_unvarified_seller',$kyc_unvarified_seller)
                                           ->with('total_product',$total_product)
                                           ->with('totalOrder',$totalOrder)
                                           ->with('totalDeliveredOrder',$totalDeliveredOrder)
                                           ->with('totalPendingOrder',$totalPendingOrder);
    }
	
	public function change_password(){
           return view("admin.dashboard.change_password");
    }
    function updateNotifyViewStatus(Request $request){
        $update = DB::table('admin_notifications')->update(['status' => 1]);
        echo json_encode(array('status'=>1,'message'=>"updated successfully"));
    }
    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'password' => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|max:20|min:6',
                'current_password' => 'required|max:20|min:6',
            ]);
        if ($validator->fails())
        {
            return redirect('admin/change_password')->withInput()->withErrors($validator);
        }
        else
        {
            $user = Admin::where('role',1)->first();
            if (Hash::check($request->current_password, $user->password))
            {
                $user->password = Hash::make($request->password);
                //$user->simple_pass = $request->password;
                $user->save();
                Session::flash('success_message', 'Successfully updated password!');
            }
            else
            {
                Session::flash('error_message', 'Current password is incorrect');
            }
            return redirect('admin/change_password');
        }
    }

    public function change_email(){
        $admin = Admin::where('role',1)->first();
        return view("admin.dashboard.change_email",compact('admin'));
    }

    public function update_email(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
            ]);
        if ($validator->fails())
        {
            return redirect('admin/change-email')->withInput()->withErrors($validator);
        }
        else
        {
            $user = Admin::where('role',1)->first();
                $user->email =$request->input('email');
                $user->save();
                Session::flash('success_message', 'Successfully updated email!');

            return redirect('admin/change-email');
        }
    }

}