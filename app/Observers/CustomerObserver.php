<?php

namespace App\Observers;
use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Models\Bill;
use App\Models\Collection;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        if($customer->status==1){
            Bill::create(
                ['customer_id' => $customer->id,
                 'monthlyrent' => $customer->monthlyrent?:0,
                 'due' => $customer->due?:0,
                 'addicrg' => $customer->addicrg?:0,
                 'discount' => $customer->discount?:0,
                 'advance' => $customer->advance?:0,
                  'vat' => $customer->vat?:0,
                 'total' => $customer->total?:0,
                 'admin_id' => $customer->admin_id?:0,
                 'user_id' => $customer->user_id?:0
              
            ]);
            $smsinfo=['name'=>$customer->customername,'mobile'=>$customer->customermobile,'id'=>$customer->loginid,'monthlypayment'=>$customer->monthlyrent];
            CommonFx::sentsmscustomer($smsinfo);
         }
         else{
            Bill::create(
                ['customer_id' => $customer->id,
                 'monthlyrent' => $customer->monthlyrent?:0,
                 'due' => $customer->due?:0,
                 'addicrg' => $customer->addicrg?:0,
                 'discount' => $customer->discount?:0,
                 'advance' => $customer->advance?:0,
                  'vat' => $customer->vat?:0,
                 'total' => $customer->total?:0,
                 'admin_id' => $customer->admin_id?:0,
                 'user_id' => $customer->user_id?:0
              
            ]);
         }
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        
    }

    /**
     * Handle the Customer "deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "restored" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function restored(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function forceDeleted(Customer $customer)
    {
        //
    }
}
