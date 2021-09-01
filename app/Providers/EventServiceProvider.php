<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Customer;
use App\Observers\UserObserver;
use App\Observers\AdminObserver;
use App\Observers\ContactObserver;
use App\Observers\CategoryObserver;
use App\Observers\CustomerObserver;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Admin::observe(AdminObserver::class);
        Customer::observe(CustomerObserver::class);
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Contact::observe(ContactObserver::class);
      
     
    }
}
