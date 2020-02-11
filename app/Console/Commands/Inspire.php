<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Helper;
use App\OrderMeta;
use App\Order;
use App\OrderTracking;
use App\PushNotification;
class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

   
	 public function update_order_status()
	{
		//$time= date('h')
		$pdata=PushNotification::where('date',date('Y-m-d'))->where('send_type','later')->first();
			    $data['category_id']= $pdata->category_id;
                $data['redirect_type']= $pdata->redirect_type;
                $data['title']= $pdata->title;
                $data['description']= $pdata->description;
                $data['image']= $pdata->image;
				$token=array();
				DB::table('users')->select('device_token')->where('role_id',3)->chunk(100, function($users) use($token,$data)
				{
					foreach ($users as $user)
					{
						$token[]= $user->device_token;
					}
				});
				Helper::send_push_notification($token,$data);
	}
	
	 
	
    public function handle()
    {
		   $this->update_order_status();
		   //$this->update_dispatched_status();	 					
    }
	
	
	
	
	
}
