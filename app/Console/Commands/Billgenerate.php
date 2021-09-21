<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Models\Bill;
use Illuminate\Console\Command;

class Billgenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:billgenerate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All Active Member Bill Generate Task';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = Customer::wherestatus(1)->get();
       // dd($users);
        foreach ($users as $customer) {
           Bill::create(['customer_id' => $customer->id,
           'monthlyrent' => $customer->monthlyrent,
           'due' => $customer->due?:0,
           'addicrg' => $customer->addicrg?:0,
           'discount' => $customer->discount?:0,
           'advance' => $customer->advance?:0,
            'vat' => $customer->vat?:0,
           'total' => $customer->total
          
        ]);
        $smsinfo=['adminid'=>$customer->admin_id,'name'=>$customer->customername,'mobile'=>$customer->customermobile,'id'=>$customer->loginid,'billamount'=>$customer->total,'expeirydate'=>$customer->atd_month];
        CommonFx::sentsmsbillcreate($smsinfo);      
            
        }
         
        $this->info('Bill Generate Done');
    
    }
}
