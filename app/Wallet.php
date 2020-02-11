<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Wallet extends Model
{
	  protected $fillable = ['user_id','ref_id','amount','payment_type','type','order_id','status','merchant_id','payment_mode','status','transaction_id'];
      protected $table="wallets";
      
	  public function user()
      {
        return $this->belongsTo('App\User');
      }

	  public function user_kyc()
      {
        return $this->belongsTo('App\UserKyc','user_id','user_id');
      }
    
}