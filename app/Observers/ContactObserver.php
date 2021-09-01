<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\Superadmin;
use App\Notifications\Superadminnotification;

class ContactObserver
{
    /**
     * Handle the Contact "created" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function created(Contact $contact)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/replymail/'.$contact->id) . '">New Email Form ' .$contact->name. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    
}
